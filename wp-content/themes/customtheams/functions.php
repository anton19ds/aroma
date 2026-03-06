<?php
/**
 * Theme Functions and Definitions
 *
 * @package WordPress
 * @subpackage CustomTheam
 */

// =============================================================================
// ENV & Mail
// =============================================================================

/**
 * Загружает переменные окружения из .env в putenv и $_ENV.
 */
function customtheams_load_env() {
	$env_path = get_template_directory() . '/.env';
	if ( ! file_exists( $env_path ) ) {
		return;
	}
	$lines = file( $env_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
	if ( ! $lines ) {
		return;
	}
	foreach ( $lines as $line ) {
		$line = trim( $line );
		if ( $line === '' || strpos( $line, '#' ) === 0 ) {
			continue;
		}
		if ( strpos( $line, '=' ) === false ) {
			continue;
		}
		list( $key, $value ) = explode( '=', $line, 2 );
		$key   = trim( $key );
		$value = trim( $value, " \t\n\r\0\x0B\"'" );
		if ( ! getenv( $key ) ) {
			putenv( "$key=$value" );
			$_ENV[ $key ] = $value;
		}
	}
}
customtheams_load_env();

/**
 * Настраивает PHPMailer для SMTP из .env.
 */
add_action( 'phpmailer_init', 'customtheams_phpmailer_smtp' );
function customtheams_phpmailer_smtp( $phpmailer ) {
	$host = getenv( 'MAIL_HOST' );
	if ( empty( $host ) ) {
		return;
	}
	$phpmailer->isSMTP();
	$phpmailer->Host       = $host;
	$phpmailer->Port       = (int) getenv( 'MAIL_PORT' ) ?: 587;
	$phpmailer->SMTPAuth   = ! empty( getenv( 'MAIL_USERNAME' ) );
	$phpmailer->Username   = getenv( 'MAIL_USERNAME' ) ?: '';
	$phpmailer->Password   = getenv( 'MAIL_PASSWORD' ) ?: '';
	$phpmailer->SMTPSecure = getenv( 'MAIL_ENCRYPTION' ) ?: 'tls';
	$phpmailer->From       = getenv( 'MAIL_FROM_ADDRESS' ) ?: get_option( 'admin_email' );
	$phpmailer->FromName   = getenv( 'MAIL_FROM_NAME' ) ?: get_bloginfo( 'name' );
}

add_post_type_support( 'post', 'maintitle' );

// =============================================================================
// ACF & Debug (шаблоны WooCommerce)
// =============================================================================

add_filter( 'woocommerce_locate_template', 'customtheams_debug_woocommerce_templates', 10, 3 );
function customtheams_debug_woocommerce_templates( $template, $template_name, $template_path ) {
	error_log( "WooCommerce template: $template_name in $template_path -> $template" );
	return $template;
}

add_filter( 'field/name=event', 'customtheams_acf_load_field' );
function customtheams_acf_load_field( $field ) {
    $field['required'] = true;
    $field['instructions'] = '<i class="help" title="Instructions here"></i>';
    $field['wrapper']['id'] = 'my-custom-id';
    $field['wrapper']['data-jsify'] = '123';
	$field['wrapper']['title'] = 'Text here';
	return $field;
}

// =============================================================================
// Styles & Scripts
// =============================================================================

add_action( 'wp_enqueue_scripts', 'customtheams_enqueue_assets' );
function customtheams_enqueue_assets() {
	$theme_uri = get_template_directory_uri();
	wp_enqueue_style( 'main', $theme_uri . '/main.css' );
	wp_enqueue_style( 'merge', $theme_uri . '/merge.css' );
	wp_enqueue_style( 'himanshu-style', $theme_uri . '/himanshu.css', array(), '1.0' );
	wp_enqueue_style( 'responsive', $theme_uri . '/responsive.css' );
	wp_enqueue_style( 'new-style-ff', $theme_uri . '/css/stylesheet.css', array(), '1.0' );
	wp_enqueue_style( 'nib', $theme_uri . '/css/nib.css', array(), '1.0' );
	if ( function_exists( 'is_account_page' ) && is_account_page() ) {
		wp_enqueue_style( 'elixir-myaccount-orders', $theme_uri . '/css/elixir-myaccount-orders.css', array(), '1.0' );
	}
	wp_enqueue_style( 'new-style', $theme_uri . '/new.css', array(), '1.0' );
	wp_enqueue_style( 'style-name', get_stylesheet_uri() );
	if ( function_exists( 'is_checkout' ) && is_checkout() && ! is_wc_endpoint_url() ) {
		wp_enqueue_style( 'customtheams-checkout-mobile-payment', $theme_uri . '/css/checkout-mobile-payment.css', array( 'style-name' ), '1.0' );
	}
}

add_filter( 'show_admin_bar', '__return_false' );

/**
 * Включает использование купонов при оформлении заказа (если отключены в настройках WooCommerce).
 * Купоны: WooCommerce → Настройки → Общие → «Включить купоны».
 */
add_filter( 'woocommerce_coupons_enabled', 'customtheams_enable_checkout_coupons' );

// =============================================================================
// Footer: wholesale price request form -> email to admin
// =============================================================================

add_action( 'admin_post_nopriv_customtheams_wholesale_price_request', 'customtheams_handle_wholesale_price_request' );
add_action( 'admin_post_customtheams_wholesale_price_request', 'customtheams_handle_wholesale_price_request' );
function customtheams_handle_wholesale_price_request() {
	$redirect = wp_get_referer();
	if ( empty( $redirect ) ) {
		$redirect = home_url( '/' );
	}
	$redirect = remove_query_arg( array( 'wholesale_request' ), $redirect );

	$nonce = isset( $_POST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'customtheams_wholesale_price_request' ) ) {
		wp_safe_redirect( add_query_arg( 'wholesale_request', 'failed', $redirect ) . '#wholesale-price-request' );
		exit;
	}

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	if ( empty( $email ) || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'wholesale_request', 'failed', $redirect ) . '#wholesale-price-request' );
		exit;
	}

	$admin_email = get_option( 'admin_email' );
	$site_name = wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES );
	$subject = sprintf( '[%s] Запрос оптового прайса', $site_name );

	$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$ua = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';

	$message_lines = array(
		'Запрос оптового прайса',
		'',
		'Email: ' . $email,
		'Страница: ' . $redirect,
		'Дата: ' . wp_date( 'Y-m-d H:i:s' ),
		'IP: ' . $ip,
		'User-Agent: ' . $ua,
	);
	$message = implode( "\n", $message_lines );

	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $email,
	);

	$sent = wp_mail( $admin_email, $subject, $message, $headers );

	wp_safe_redirect( add_query_arg( 'wholesale_request', $sent ? 'success' : 'failed', $redirect ) . '#wholesale-price-request' );
	exit;
}

// =============================================================================
// WooCommerce: Payment flow (default bacs, online pay on thank you)
// =============================================================================

add_filter( 'woocommerce_default_gateway', function( $default ) {
	// По умолчанию оформляем заказ как "Прямой банковский перевод".
	if ( function_exists( 'is_checkout' ) && is_checkout() && ! is_checkout_pay_page() ) {
		return 'bacs';
	}
	return $default;
} );

add_filter( 'woocommerce_checkout_posted_data', function( $data ) {
	// Если на странице checkout скрыт выбор способов оплаты, подставляем bacs.
	if ( function_exists( 'is_checkout' ) && is_checkout() && ! is_checkout_pay_page() ) {
		if ( empty( $data['payment_method'] ) ) {
			$data['payment_method'] = 'bacs';
		}
	}
	return $data;
} );

add_filter( 'woocommerce_available_payment_gateways', function( $gateways ) {
	// На checkout показываем/используем только bacs.
	if ( function_exists( 'is_checkout' ) && is_checkout() && ! is_checkout_pay_page() ) {
		if ( isset( $gateways['bacs'] ) ) {
			if ( WC()->session ) {
				WC()->session->set( 'chosen_payment_method', 'bacs' );
			}
			return array( 'bacs' => $gateways['bacs'] );
		}
	}

	// На странице оплаты заказа (order-pay) показываем только IntellectMoney.
	if ( function_exists( 'is_checkout_pay_page' ) && is_checkout_pay_page() ) {
		if ( isset( $gateways['intellectmoney'] ) ) {
			if ( WC()->session ) {
				WC()->session->set( 'chosen_payment_method', 'intellectmoney' );
			}
			return array( 'intellectmoney' => $gateways['intellectmoney'] );
		}
	}

	return $gateways;
}, 20 );

add_action( 'template_redirect', function() {
	// Если пришли на order-pay со служебным параметром — выбираем IntellectMoney.
	if ( function_exists( 'is_checkout_pay_page' ) && is_checkout_pay_page() ) {
		$pay_with = isset( $_GET['pay_with'] ) ? sanitize_text_field( wp_unslash( $_GET['pay_with'] ) ) : '';
		if ( $pay_with === 'intellectmoney' && WC()->session ) {
			WC()->session->set( 'chosen_payment_method', 'intellectmoney' );
		}
	}
} );

add_action( 'woocommerce_thankyou', function( $order_id ) {
	// Для bacs переводим заказ в pending, чтобы был доступен "Оплатить" (order-pay).
	$order = wc_get_order( $order_id );
	if ( ! $order ) {
		return;
	}
	if ( $order->get_payment_method() !== 'bacs' ) {
		return;
	}
	// pending/failed — статусы, при которых Woo считает, что заказ можно оплатить.
	if ( $order->has_status( array( 'on-hold' ) ) ) {
		$order->update_status( 'pending', 'Переведено в ожидание оплаты для возможности оплаты онлайн.', true );
	}
}, 5 );

add_filter( 'woocommerce_cart_totals_coupon_html', 'customtheams_cart_coupon_remove_brackets', 10, 3 );
function customtheams_cart_coupon_remove_brackets( $coupon_html, $coupon, $discount_amount_html ) {
	$coupon_html = str_replace( array( '[Убрать]', '[Remove]', '[Удалить]' ), array( 'Убрать', 'Remove', 'Удалить' ), $coupon_html );
	return $coupon_html;
}

add_filter( 'woocommerce_gateway_description', 'customtheams_bacs_checkout_description', 10, 2 );
function customtheams_bacs_checkout_description( $description, $gateway_id ) {
	if ( $gateway_id === 'bacs' ) {
		return 'Оплату нужно направлять на наш банковский счет. Заказ будет отправлен после поступления средств на наш счёт. Указывайте номер заказа в подписи к платежу.';
	}
	return $description;
}

function customtheams_enable_checkout_coupons( $enabled ) {
	if ( is_checkout() || is_cart() ) {
		return true;
	}
	return $enabled;
}

// =============================================================================
// WooCommerce: Order Emails & Telegram
// =============================================================================

/**
 * Отправка письма покупателю с содержимым заказа после оформления.
 * WooCommerce по умолчанию отправляет письма при статусах "processing" и "on-hold".
 * Для статуса "pending" (ожидание оплаты) письмо не отправляется — добавляем его.
 */
add_action( 'woocommerce_order_status_pending', 'elixir_send_order_email_to_customer_on_pending', 10, 2 );
function elixir_send_order_email_to_customer_on_pending( $order_id, $order = null ) {
	if ( ! $order ) {
		$order = wc_get_order( $order_id );
	}
	if ( ! $order || ! is_a( $order, 'WC_Order' ) ) {
		return;
	}
	$mailer = WC()->mailer();
	$emails = $mailer->get_emails();
	if ( isset( $emails['WC_Email_Customer_On_Hold_Order'] ) && $emails['WC_Email_Customer_On_Hold_Order']->is_enabled() ) {
		$emails['WC_Email_Customer_On_Hold_Order']->trigger( $order_id, $order );
	}
}

/**
 * Отправка уведомления о заказе в Telegram при оформлении.
 * Требует в .env: TELEGRAM_BOT_TOKEN и TELEGRAM_CHAT_ID (несколько чатов через запятую)
 */
add_action( 'woocommerce_new_order', 'elixir_send_order_to_telegram', 10, 2 );
function customtheams_telegram_clean_price( $price_html ) {
	$price = wp_strip_all_tags( (string) $price_html );
	$price = html_entity_decode( $price, ENT_QUOTES, 'UTF-8' );
	// WooCommerce часто вставляет неразрывный пробел между суммой и валютой.
	$price = str_replace( "\xc2\xa0", ' ', $price );
	$price = preg_replace( '/\s+/u', ' ', $price );
	return trim( $price );
}
function elixir_send_order_to_telegram( $order_id, $order = null ) {
	//$token = getenv( 'TELEGRAM_BOT_TOKEN' );
	$chat_ids_raw = get_field('chat_id',126);
	$token = get_field('telegram_token',126);
	// getenv( 'TELEGRAM_CHAT_ID' );
	if ( empty( $token ) || empty( $chat_ids_raw ) ) {
		return;
	}
	$chat_ids = array_map( 'trim', array_filter( explode( ',', $chat_ids_raw ) ) );
	if ( empty( $chat_ids ) ) {
		return;
	}
	if ( ! $order ) {
		$order = wc_get_order( $order_id );
	}
	if ( ! $order || ! is_a( $order, 'WC_Order' ) ) {
		return;
	}

	$items_lines = array();
	foreach ( $order->get_items() as $item ) {
		$product = $item->get_product();
		$name = $item->get_name();
		$qty = (int) $item->get_quantity();
		$total = customtheams_telegram_clean_price( wc_price( $item->get_total() + $item->get_total_tax() ) );
		$parent_label = '';
		if ( $product && is_callable( 'get_cross_sell_parents' ) ) {
			$parent = get_cross_sell_parents( $product->get_id() );
			if ( $parent && is_a( $parent, 'WC_Product' ) ) {
				$parent_label = esc_html( $parent->get_name() ) . ' — ';
			}
		}
		$items_lines[] = sprintf( '• %s%s × %d — %s', $parent_label, esc_html( $name ), $qty, $total );
	}
	$items_block = implode( "\n", $items_lines );

	$shipping = $order->has_shipping_address() ? $order->get_formatted_shipping_address() : $order->get_formatted_billing_address();
	$shipping_plain = esc_html( preg_replace( '#<br\s*/?>#i', "\n", $shipping ) );
	$payment = $order->get_payment_method_title();

	$msg = "🛒 <b>Новый заказ #" . esc_html( $order->get_order_number() ) . "</b>\n\n";
	$msg .= "<b>Покупатель:</b>\n";
	$msg .= "ФИО: " . esc_html( trim( $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() ) ) . "\n";
	$msg .= "Телефон: " . esc_html( $order->get_billing_phone() ) . "\n";
	$msg .= "E-Mail: " . esc_html( $order->get_billing_email() ) . "\n\n";
	$msg .= "<b>Адрес доставки:</b>\n" . $shipping_plain . "\n\n";
	$msg .= "<b>Товары:</b>\n" . $items_block . "\n\n";

	$shipping_total = (float) $order->get_shipping_total();
	if ( $shipping_total > 0 ) {
		$msg .= "<b>Доставка:</b> " . customtheams_telegram_clean_price( wc_price( $shipping_total ) ) . "\n";
	}
	$coupon_items = $order->get_items( 'coupon' );
	if ( ! empty( $coupon_items ) ) {
		foreach ( $coupon_items as $coupon_item ) {
			$code = $coupon_item->get_code();
			$discount = (float) $coupon_item->get_discount_amount() + (float) $coupon_item->get_discount_tax();
			$discount_formatted = $discount > 0 ? ' (-' . customtheams_telegram_clean_price( wc_price( $discount ) ) . ')' : '';
			$msg .= "<b>Промокод:</b> " . esc_html( $code ) . $discount_formatted . "\n";
		}
	} elseif ( $order->get_discount_total() > 0 ) {
		$coupons = $order->get_coupon_codes();
		if ( ! empty( $coupons ) ) {
			$msg .= "<b>Промокод:</b> " . esc_html( implode( ', ', $coupons ) ) . ' (-' . customtheams_telegram_clean_price( wc_price( $order->get_discount_total() + $order->get_discount_tax() ) ) . ")\n";
		}
	}
	$msg .= "\n<b>Итого:</b> " . customtheams_telegram_clean_price( $order->get_formatted_order_total() ) . "\n";
	$msg .= "<b>Оплата:</b> " . esc_html( $payment ? $payment : '—' ) . "\n";
	$msg .= "<b>Статус:</b> " . esc_html( wc_get_order_status_name( $order->get_status() ) );

	$url = 'https://api.telegram.org/bot' . $token . '/sendMessage';
	foreach ( $chat_ids as $chat_id ) {
		$body = array(
			'chat_id'                  => $chat_id,
			'text'                     => $msg,
			'parse_mode'               => 'HTML',
			'disable_web_page_preview' => true,
		);

		wp_remote_post( $url, array(
			'body' => $body,
			'timeout' => 15,
			'blocking' => false,
		) );
	}
}

// =============================================================================
// Menus & Navigation
// =============================================================================

add_action( 'after_setup_theme', 'customtheams_register_nav_menus' );
function customtheams_register_nav_menus() {
	register_nav_menus( array(
		'header_menu'  => 'Меню в шапке',
		'footer_menu'  => 'Меню в подвале',
		'sidebar_menu' => 'Меню в сайдбаре',
		'mob_menu'     => 'Мобильное меню',
	) );
}

class My_Walker_Nav_Menu_Footer extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
		$output .= "\n" . $indent . '<ul class="">' . "\n";
	}

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item = $data_object;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
		$depth_classes = array(
			( 0 === $depth ? 'main-menu-item' : 'box' ),
			( $depth >= 2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth,
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
		$output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		$link_template = '<a style="text-transform: uppercase;" {ATTRIBUTES}>{TITLE}</a>';
		$item_output   = strtr( $link_template, array(
			'{ATTRIBUTES}' => $attributes,
			'{TITLE}'      => apply_filters( 'the_title', $item->title, $item->ID ),
		) );
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
class My_Walker_Nav_Menu_Mob extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
		$output .= "\n" . $indent . '<div class="dropdown-menu mega-dropdown-menu"><div class="container"><div class="tab-content"><div class="tab-pane active"><ul class="nav-list list-inline top_menu_icon_text content">' . "\n";
	}

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item    = $data_object;
		$image_id = get_field( 'icon_menu', $item->ID );
		$indent  = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
		$depth_classes = array(
			( 0 === $depth ? 'main-menu-item' : 'box' ),
			( $depth >= 2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth,
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
		$output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		if ( 0 !== $depth ) {
			$link_template = '<a{ATTRIBUTES}><img src="' . esc_url( $image_id ) . '" alt="{TITLE}" title="{TITLE}"><span class="top_menu_text">{TITLE}</span></a>';
		} else {
			$link_template = '<a{ATTRIBUTES}>{TITLE}</a>';
		}
		$item_output = strtr( $link_template, array(
			'{ATTRIBUTES}' => $attributes,
			'{TITLE}'      => apply_filters( 'the_title', $item->title, $item->ID ),
		) );
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
class My_Walker_Nav_Menu extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
		$output .= "\n" . $indent . '<div class="dropdown-menu mega-dropdown-menu"><div class="container"><div class="tab-content"><div class="tab-pane active"><ul class="nav-list list-inline top_menu_icon_text content">' . "\n";
	}

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item     = $data_object;
		$image_id = get_field( 'icon_menu', $item->ID );
		$indent   = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
		$depth_classes = array(
			( 0 === $depth ? 'main-menu-item' : 'box' ),
			( $depth >= 2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth,
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
		$output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		if ( 0 !== $depth ) {
			$link_template = '<a{ATTRIBUTES}><img src="' . esc_url( $image_id ) . '" alt="{TITLE}" title="{TITLE}"><span class="top_menu_text">{TITLE}</span></a>';
		} else {
			$link_template = '<a{ATTRIBUTES}>{TITLE}</a>';
		}
		$item_output = strtr( $link_template, array(
			'{ATTRIBUTES}' => $attributes,
			'{TITLE}'      => apply_filters( 'the_title', $item->title, $item->ID ),
		) );
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// =============================================================================
// Scripts
// =============================================================================
add_action( 'wp_enqueue_scripts', 'customtheams_enqueue_custom_script' );
function customtheams_enqueue_custom_script() {
	wp_enqueue_script(
		'custom-script',
		get_template_directory_uri() . '/js/custom.js',
		array( 'jquery' ),
		'1.0',
		true
	);
}

// =============================================================================
// WooCommerce: Cart & AJAX
// =============================================================================
add_action( 'wp_ajax_woocommerce_bulk_add_to_cart', 'customtheams_woocommerce_bulk_add_to_cart' );
add_action( 'wp_ajax_nopriv_woocommerce_bulk_add_to_cart', 'customtheams_woocommerce_bulk_add_to_cart' );

function customtheams_woocommerce_bulk_add_to_cart() {
    $products = isset($_POST['products']) ? $_POST['products'] : array();
    $added = 0;
    $errors = array();
    if (empty($products)) {
        wp_send_json_error(array('message' => 'Не выбраны товары для добавления'));
    }
    foreach ($products as $item) {
        $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($item['product_id']));
        $quantity = empty($item['quantity']) ? 1 : wc_stock_amount($item['quantity']);
        $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
        $product_status = get_post_status($product_id);
        if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {
            $added++;
        } else {
            $product = wc_get_product($product_id);
            $errors[] = sprintf(__('Не удалось добавить "%s"', 'woocommerce'), $product->get_name());
        }
    }
    if ($added > 0) {
        $message = sprintf(_n('%s товар добавлен', '%s товара(ов) добавлено', $added, 'woocommerce'), $added);
        if (!empty($errors)) {
            $message .= '<br>' . implode('<br>', $errors);
        }
        WC_AJAX::get_refreshed_fragments();
        wp_send_json_success(array(
            'message' => $message,
            'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array())
        ));
    } else {
        wp_send_json_error(array(
            'message' => implode('<br>', $errors)
        ));
    }
}






add_action( 'init', 'customtheams_clear_cart_on_click' );
function customtheams_clear_cart_on_click() {
    if (isset($_GET['clear-cart'])) {
        WC()->cart->empty_cart();
        wc_add_notice(__('Корзина очищена', 'woocommerce'), 'notice');
        wp_safe_redirect(wc_get_cart_url());
        exit;
    }
}


add_action( 'woocommerce_after_cart_item_name', 'customtheams_add_remove_item_link', 10, 1 );
function customtheams_add_remove_item_link( $cart_item ) {
    $remove_url = wc_get_cart_remove_url($cart_item['key']);
    echo '<a href="' . esc_url($remove_url) . '" class="remove-item-link" style="color: red; display: block; margin-top: 5px;">Удалить</a>';
}


// Shortcodes
remove_shortcode( 'products' );
add_shortcode( 'products-cat', 'customtheams_products_shortcode' );
function customtheams_products_shortcode( $atts ) {
    $atts = shortcode_atts(array(
        'category' => '',
        'limit' => 100,
        'columns' => 4,
        'orderby' => 'title',
        'order' => 'ASC'
    ), $atts);

    ob_start();

    // Собираем аргументы запроса
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $atts['limit'],
        'orderby' => $atts['orderby'],
        'order' => $atts['order']
    );

    // Добавляем фильтр по категории если указан
    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => explode(',', $atts['category'])
            )
        );
    }


    $products = new WP_Query($args);

    // Кастомный вывод
    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            wc_get_template_part('content', 'product-custom');
        }
    }

    wp_reset_postdata();
    return ob_get_clean();
}

// =============================================================================
// WooCommerce: My Account
// =============================================================================

add_filter( 'woocommerce_account_menu_items', 'customtheams_my_account_menu' );
function customtheams_my_account_menu( $items ) {
    unset($items['downloads']); // Удаляем раздел "Загрузки"

    // Изменяем порядок и названия
    return array(
        //'dashboard'       => __('Личный кабинет', 'woocommerce'),
        'orders' => __('Мои заказы', 'woocommerce'),
        'edit-address' => __('Адреса доставки', 'woocommerce'),
        'edit-account' => __('Настройки профиля', 'woocommerce'),
        'customer-logout' => __('Выход', 'woocommerce')
    );
}
add_filter( 'woocommerce_login_redirect', 'customtheams_login_redirect', 10, 2 );
function customtheams_login_redirect( $redirect, $user ) {
    if (wc_user_has_role($user, 'customer')) {
        return wc_get_account_endpoint_url('orders'); // Или любой другой endpoint
    }
    return $redirect;
}

add_filter( 'woocommerce_get_account_endpoint_url', 'customtheams_change_default_account_page', 10, 2 );
function customtheams_change_default_account_page( $url, $endpoint ) {

    if ($endpoint === 'dashboard') {
        // Перенаправляем на страницу заказов вместо дашборда
        return wc_get_account_endpoint_url('orders');

        // Или на любой другой endpoint:
        // return wc_get_account_endpoint_url('wishlist');
    }
    return $url;
}

// =============================================================================
// WooCommerce: Products
// =============================================================================

function get_cross_sell_parents( $product_id ) {
    if (!$product_id) return array();
    
    global $wpdb;
    //return $wpdb->esc_like($product_id);
    
    $parent_ids = $wpdb->get_col($wpdb->prepare("
        SELECT post_id 
        FROM {$wpdb->postmeta} 
        WHERE meta_key = '_children' 
        AND meta_value LIKE %s
    ", '%' . $wpdb->esc_like($product_id) . '%'));
    //return $parent_ids;
    // Фильтруем правильные ID
    $valid_parents = '';
    //return $parent_ids;
    foreach ($parent_ids as $parent_id) {
        $product = wc_get_product($parent_id);
        $valid_parents = $product;
    }
    
    return $valid_parents;
}











// =============================================================================
// Cart Quantity & Remove
// =============================================================================

add_action( 'wp_ajax_update_cart_quantity', 'customtheams_update_cart_quantity' );
add_action( 'wp_ajax_nopriv_update_cart_quantity', 'customtheams_update_cart_quantity' );

function customtheams_update_cart_quantity() {
    if (!wp_verify_nonce($_POST['nonce'], 'cart_nonce')) {
        wp_die('Security check failed');
    }
    
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);
    
    if ($quantity > 0) {
        WC()->cart->set_quantity($cart_item_key, $quantity);
    }
    
    $response = array(
        'success' => true,
        'subtotal' => WC()->cart->get_cart_subtotal(),
        'total' => WC()->cart->get_cart_total(),
        'cart_count' => WC()->cart->get_cart_contents_count()
    );
    
    wp_send_json($response);
}

add_filter( 'woocommerce_cart_item_quantity', 'customtheams_cart_quantity_field', 10, 3 );
function customtheams_cart_quantity_field( $product_quantity, $cart_item_key, $cart_item ) {
    $min_quantity = 1;
    $max_quantity = $cart_item['data']->get_max_purchase_quantity() ?: 999;
    
    $product_quantity = '
    <div class="quantity-wrapper" data-cart-item-key="' . esc_attr($cart_item_key) . '">
        <div class="quantity-input">
            <button type="button" class="quantity-btn quantity-minus">-</button>
            <input type="number" 
                   class="qty" 
                   name="cart[' . esc_attr($cart_item_key) . '][qty]" 
                   value="' . esc_attr($cart_item['quantity']) . '" 
                   min="' . esc_attr($min_quantity) . '" 
                   max="' . esc_attr($max_quantity) . '"
                   data-key="' . esc_attr($cart_item_key) . '">
            <button type="button" class="quantity-btn quantity-plus">+</button>
        </div>
    </div>';
    
    return $product_quantity;
}

add_action( 'wp_enqueue_scripts', 'customtheams_cart_quantity_scripts' );
function customtheams_cart_quantity_scripts() {
    if (is_cart()) {
        wp_enqueue_script('cart-quantity', get_template_directory_uri() . '/js/cart-quantity.js', array('jquery'), '1.0', true);
        wp_localize_script('cart-quantity', 'cart_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('cart_nonce')
        ));
        
        // Добавляем стили
        wp_add_inline_style('woocommerce-general', '
            .quantity-wrapper {
                display: flex;
                align-items: center;
            }
            .quantity-input {
                display: flex;
                align-items: center;
            }
            .qty {
                width: 60px;
                text-align: center;
                margin: 0 5px;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 3px;
            }
            .quantity-btn {
                background: #f8f8f8;
                border: 1px solid #ddd;
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                border-radius: 3px;
                transition: all 0.3s ease;
            }
            .quantity-btn:hover {
                background: #e8e8e8;
            }
            .cart-updating {
                opacity: 0.6;
                pointer-events: none;
            }
        ');
    }
}




add_action('wp_ajax_remove_from_cart_by_product_id', 'remove_from_cart_by_product_id');
add_action('wp_ajax_nopriv_remove_from_cart_by_product_id', 'remove_from_cart_by_product_id');

function remove_from_cart_by_product_id() {
    $product_id = intval($_POST['products'][0]['product_id']);
    $qti = intval($_POST['products'][0]['quantity']);
    $variation_id = isset($_POST['variation_id']) ? intval($_POST['variation_id']) : 0;
        $cart_item_key = customtheams_find_cart_item_key_by_product_id( $product_id, $variation_id );
        if ($cart_item_key) {
            $result = WC()->cart->set_quantity($cart_item_key, $qti);
            if ($result) {
                wp_send_json_success('Товар удален из корзины');
            }
        }
    wp_send_json_error('Товар не найден в корзине');
}

function customtheams_find_cart_item_key_by_product_id( $product_id, $variation_id = 0 ) {
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            if ($cart_item['product_id'] == $product_id) {
                return $cart_item_key;
            }
    }
    return false;
}

// add_action('init', function() {
//     pll_register_string('quick_view', 'Quick View', 'Woocomerse');
//     pll_register_string('checkout', 'Checkout', 'Woocomerse');
//     pll_register_string('continue_shopping', 'Continue Shopping', 'Woocomerse');
//     pll_register_string('product', 'Product', 'Woocomerse');
//     pll_register_string('price', 'Price', 'Woocomerse');
//     pll_register_string('total', 'Total', 'Woocomerse');
//     pll_register_string('remove', 'Remove', 'Woocomerse');
//     pll_register_string('subtotal', 'Subtotal', 'Woocomerse');
//     pll_register_string('shopping_cart', 'Shopping Cart', 'Woocomerse');
//     pll_register_string('in_cart', 'in Cart', 'Woocomerse');
//     pll_register_string('about', 'About', 'Woocomerse');
//     pll_register_string('product_categories', 'Product Categories', 'Woocomerse');
//     pll_register_string('dis_tov', 'dis_tov', 'Woocomerse');
// });


//admin-eroma


// Отключаем комментарии для всех типов записей
function customtheams_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action( 'admin_init', 'customtheams_disable_comments_post_types_support' );

function customtheams_disable_comments_status() {
    return false;
}
add_filter( 'comments_open', 'customtheams_disable_comments_status', 20, 2 );
add_filter( 'pings_open', 'customtheams_disable_comments_status', 20, 2 );

function customtheams_disable_comments_hide_existing( $comments ) {
    return array();
}
add_filter( 'comments_array', 'customtheams_disable_comments_hide_existing', 10, 2 );

// =============================================================================
// Debug & Admin
// =============================================================================

add_filter( 'woocommerce_template_debug_mode', '__return_true' );

add_action( 'admin_bar_menu', function( $wp_admin_bar ) {
    if (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) {
        global $template;
        $wp_admin_bar->add_node([
            'id'    => 'current_template',
            'title' => 'Шаблон: ' . basename($template),
            'href'  => '#',
            'meta'  => ['title' => 'Текущий шаблон: ' . $template]
        ]);
    }
}, 999 );

// =============================================================================
// Thank You Redirect
// =============================================================================

add_action( 'template_redirect', 'customtheams_redirect_to_thank_you' );
function customtheams_redirect_to_thank_you() {
 
	// если не страница "Заказ принят", то ничего не делаем
	if( ! is_order_received_page() ) {
		return;
	}
 
	// Получаем order_id разными способами
	$order_id = 0;
	
	// Способ 1: Из URL (например, /checkout/order-received/55369/)
	if (preg_match('/order-received\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
		$order_id = $matches[1];
	}
	// Способ 2: Из GET параметра 'key'
	elseif( isset( $_GET['key'] ) ) {
		$order_id = wc_get_order_id_by_order_key( $_GET['key'] );
		$order = wc_get_order( $order_id );
		// не редиректим зафейленные заказы
		if( $order->has_status( 'failed' ) ) {
			return;
		}
	}
	
	// Если ID не найден, выходим
	if( ! $order_id ) {
		return;
	}
	
	// Редирект с order_id в URL
	wp_redirect( site_url( 'new-thank-you/?order_id=' . $order_id ) );
	exit;
 
}

