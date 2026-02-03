<?php
/**
 *
 * @package WordPress
 * @subpackage CustomTheam
 */
add_post_type_support('post', 'maintitle');

add_filter('woocommerce_locate_template', 'debug_woocommerce_templates', 10, 3);
function debug_woocommerce_templates($template, $template_name, $template_path)
{
    error_log("Looking for: $template_name in $template_path");
    error_log("Found at: $template");
    return $template;
}
function my_acf_load_field($field)
{
    $field['required'] = true;
    $field['instructions'] = '<i class="help" title="Instructions here"></i>';
    $field['wrapper']['id'] = 'my-custom-id';
    $field['wrapper']['data-jsify'] = '123';
    $field['wrapper']['title'] = 'Text here';
    return $field;
}

// function themename_enqueue_styles()
// {
    
// }
// add_action('wp_enqueue_scripts', 'themename_enqueue_styles');

add_filter('field/name=event', 'my_acf_load_field');
// правильный способ подключить стили и скрипты
add_action('wp_enqueue_scripts', 'theme_name_scripts');
// add_action('wp_print_styles', 'theme_name_scripts'); // можно использовать этот хук он более поздний
function theme_name_scripts()
{
    wp_enqueue_style('main', get_template_directory_uri() . "/main.css");
    wp_enqueue_style('merge', get_template_directory_uri() . "/merge.css");
    
    wp_enqueue_style('himanshu-style', get_template_directory_uri() . '/himanshu.css', array(), '1.0');
    //wp_enqueue_style('new-style-css', get_template_directory_uri() . '/css/style.css', array(), '1.0');
    wp_enqueue_style('responsive', get_template_directory_uri() . "/responsive.css");
    
    
    
    
    wp_enqueue_style('new-style-ff', get_template_directory_uri() . '/css/stylesheet.css', array(), '1.0');
    wp_enqueue_style('nib', get_template_directory_uri() . '/css/nib.css', array(), '1.0');
    wp_enqueue_style('new-style', get_template_directory_uri() . '/new.css', array(), '1.0');
    wp_enqueue_style('style-name', get_stylesheet_uri());

    //wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_filter('show_admin_bar', '__return_false');

//add_theme_support('menus');
//add_theme_support('mob-menu');


function my_theme_register_nav_menus() {
    register_nav_menus([
        'header_menu'  => 'Меню в шапке',
        'footer_menu'  => 'Меню в подвале',
        'sidebar_menu' => 'Меню в сайдбаре',
        'mob_menu' => 'Мобильное меню',
    ]);
}
add_action('after_setup_theme', 'my_theme_register_nav_menus');

// $walker = new Walker_Nav_Menu;

// $args = array(
// 	'walker' => $walker,
// );

class My_Walker_Nav_Menu_Footer extends Walker_Nav_Menu{

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // отступ в коде
        $display_depth = ($depth + 1); // потому что первый уровень подменю считается как 0
        $classes = [
            'sub-menu',
            ($display_depth % 2 ? '' : ''),
            ($display_depth >= 2 ? '' : ''),
            'menu-depth-' . $display_depth,
        ];
        $class_names = implode(' ', $classes);

        $output .= "\n" . $indent . '<ul class="">' . "\n";
    }
    function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
    {
        $item = $data_object; // используем более описательное имя для использования внутри этого метода.
        $image_id = get_field('icon_menu', $item->ID);
        $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // отступ в коде
        $depth_classes = [
            ($depth == 0 ? 'main-menu-item' : 'box'),
            ($depth >= 2 ? 'sub-sub-menu-item' : ''),
            ($depth % 2 ? 'menu-item-odd' : 'menu-item-even'),
            'menu-item-depth-' . $depth,
        ];
        $depth_class_names = esc_attr(implode(' ', $depth_classes));
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));
        $output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="menu-link ' . ($depth > 0 ? 'sub-menu-link' : 'main-menu-link') . '"';
        if ($depth != 0) {
            $stingPatern = '<a style="text-transform: uppercase;" {ATTRIBUTES}>{TITLE}</a>';
        } else {
            $stingPatern = '<a style="text-transform: uppercase;" {ATTRIBUTES}>{TITLE}</a>';
        }
        $item_output = strtr($stingPatern, [
            '{ATTRIBUTES}' => $attributes,
            '{TITLE}' => apply_filters('the_title', $item->title, $item->ID),
        ]);

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}
/**
 * Пользовательский класс walker для навигационных меню.
 */
class My_Walker_Nav_Menu_Mob extends Walker_Nav_Menu{

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // отступ в коде
        $display_depth = ($depth + 1); // потому что первый уровень подменю считается как 0
        $classes = [
            'sub-menu',
            ($display_depth % 2 ? 'menu-odd' : 'menu-even'),
            ($display_depth >= 2 ? 'sub-sub-menu' : ''),
            'menu-depth-' . $display_depth,
        ];
        $class_names = implode(' ', $classes);

        $output .= "\n" . $indent . '<div class="dropdown-menu mega-dropdown-menu"><div class="container"><div class="tab-content"><div class="tab-pane active"><ul class="nav-list list-inline top_menu_icon_text content">' . "\n";
    }
    function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
    {
        $item = $data_object; // используем более описательное имя для использования внутри этого метода.
        $image_id = get_field('icon_menu', $item->ID);
        $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // отступ в коде
        $depth_classes = [
            ($depth == 0 ? 'main-menu-item' : 'box'),
            ($depth >= 2 ? 'sub-sub-menu-item' : ''),
            ($depth % 2 ? 'menu-item-odd' : 'menu-item-even'),
            'menu-item-depth-' . $depth,
        ];
        $depth_class_names = esc_attr(implode(' ', $depth_classes));
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));
        $output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="menu-link ' . ($depth > 0 ? 'sub-menu-link' : 'main-menu-link') . '"';
        if ($depth != 0) {
            $stingPatern = '<a{ATTRIBUTES}><img src="'.$image_id.'"
													alt="{TITLE}" title="{TITLE}"><span class="top_menu_text">{TITLE}</span></a>';
        } else {
            $stingPatern = '<a{ATTRIBUTES}>{TITLE}</a>';
        }
        $item_output = strtr($stingPatern, [
            '{ATTRIBUTES}' => $attributes,
            '{TITLE}' => apply_filters('the_title', $item->title, $item->ID),
        ]);

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}
class My_Walker_Nav_Menu extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // отступ в коде
        $display_depth = ($depth + 1); // потому что первый уровень подменю считается как 0
        $classes = [
            'sub-menu',
            ($display_depth % 2 ? 'menu-odd' : 'menu-even'),
            ($display_depth >= 2 ? 'sub-sub-menu' : ''),
            'menu-depth-' . $display_depth,
        ];
        $class_names = implode(' ', $classes);

        $output .= "\n" . $indent . '<div class="dropdown-menu mega-dropdown-menu"><div class="container"><div class="tab-content"><div class="tab-pane active"><ul class="nav-list list-inline top_menu_icon_text content">' . "\n";
    }
    function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
    {
        $item = $data_object; // используем более описательное имя для использования внутри этого метода.
        $image_id = get_field('icon_menu', $item->ID);
        $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // отступ в коде
        $depth_classes = [
            ($depth == 0 ? 'main-menu-item' : 'box'),
            ($depth >= 2 ? 'sub-sub-menu-item' : ''),
            ($depth % 2 ? 'menu-item-odd' : 'menu-item-even'),
            'menu-item-depth-' . $depth,
        ];
        $depth_class_names = esc_attr(implode(' ', $depth_classes));
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));
        $output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="menu-link ' . ($depth > 0 ? 'sub-menu-link' : 'main-menu-link') . '"';
        if ($depth != 0) {
            $stingPatern = '<a{ATTRIBUTES}><img src="'.$image_id.'"
													alt="{TITLE}" title="{TITLE}"><span class="top_menu_text">{TITLE}</span></a>';
        } else {
            $stingPatern = '<a{ATTRIBUTES}>{TITLE}</a>';
        }
        $item_output = strtr($stingPatern, [
            '{ATTRIBUTES}' => $attributes,
            '{TITLE}' => apply_filters('the_title', $item->title, $item->ID),
        ]);

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}
function my_scripts_method()
{
    wp_enqueue_script(
        'custom-script',
        get_template_directory_uri() . '/js/custom.js',
        array('jquery'),
        '1.0',
        true // Важный параметр! Указывает, что скрипт нужно добавить в футер
    );
}
add_action('wp_enqueue_scripts', 'my_scripts_method');

// Обработка массового добавления
add_action('wp_ajax_woocommerce_bulk_add_to_cart', 'woocommerce_bulk_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_bulk_add_to_cart', 'woocommerce_bulk_add_to_cart');

function woocommerce_bulk_add_to_cart()
{
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






add_action('init', 'clear_cart_on_click');
function clear_cart_on_click()
{
    if (isset($_GET['clear-cart'])) {
        WC()->cart->empty_cart();
        wc_add_notice(__('Корзина очищена', 'woocommerce'), 'notice');
        wp_safe_redirect(wc_get_cart_url());
        exit;
    }
}


// Добавляем ссылку "Удалить" под каждым товаром
add_action('woocommerce_after_cart_item_name', 'add_remove_item_link', 10, 1);
function add_remove_item_link($cart_item)
{
    $remove_url = wc_get_cart_remove_url($cart_item['key']);
    echo '<a href="' . esc_url($remove_url) . '" class="remove-item-link" style="color: red; display: block; margin-top: 5px;">Удалить</a>';
}


// add_action('wp_footer', 'show_current_template');
// function show_current_template() {
//     if (current_user_can('administrator')) { // Показывать только админам
//         global $template;
//         echo '<div style="position:fixed; bottom:10px; left:10px; background:#fff; padding:5px 10px; border:1px solid #000; z-index:9999;">';
//         echo '<strong>Текущий шаблон:</strong> ' . str_replace(WP_CONTENT_DIR . '/themes/', '', $template);
//         echo '</div>';
//     }
// }


// add_action('wp_footer', 'display_all_loaded_templates', 9999);
// function display_all_loaded_templates() {
//     if (!current_user_can('administrator')) return;

//     echo '<div style="position:fixed;bottom:10px;left:10px;background:#fff;padding:10px;border:2px solid red;z-index:99999;max-height:300px;overflow-y:scroll;">';
//     echo '<h3>Загруженные шаблоны WooCommerce</h3>';
//     echo '<ol>';

//     $included_files = get_included_files();
//     foreach ($included_files as $file) {
//         if (strpos($file, 'woocommerce') !== false || strpos($file, 'WooCommerce') !== false) {
//             echo '<li>' . str_replace(ABSPATH, '', $file) . '</li>';
//         }
//     }

//     echo '</ol>';
//     echo '</div>';
// }

// Удаляем стандартный шорткод
remove_shortcode('products');

// Регистрируем кастомную версию
add_shortcode('products-cat', 'custom_products_shortcode');
function custom_products_shortcode($atts)
{
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

// Редактирование существующих пунктов
add_filter('woocommerce_account_menu_items', 'custom_my_account_menu');
function custom_my_account_menu($items)
{
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
add_filter('woocommerce_login_redirect', 'custom_login_redirect', 10, 2);
function custom_login_redirect($redirect, $user)
{
    if (wc_user_has_role($user, 'customer')) {
        return wc_get_account_endpoint_url('orders'); // Или любой другой endpoint
    }
    return $redirect;
}

add_filter('woocommerce_get_account_endpoint_url', 'change_default_account_page', 10, 2);
function change_default_account_page($url, $endpoint)
{

    if ($endpoint === 'dashboard') {
        // Перенаправляем на страницу заказов вместо дашборда
        return wc_get_account_endpoint_url('orders');

        // Или на любой другой endpoint:
        // return wc_get_account_endpoint_url('wishlist');
    }
    return $url;
}

function get_cross_sell_parents($product_id) {
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











// Функции для работы с количеством товаров в корзине
add_action('wp_ajax_update_cart_quantity', 'update_cart_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'update_cart_quantity');

function update_cart_quantity() {
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

// Модифицируем поле количества
add_filter('woocommerce_cart_item_quantity', 'custom_cart_quantity_field', 10, 3);
function custom_cart_quantity_field($product_quantity, $cart_item_key, $cart_item) {
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

// Подключаем скрипты
add_action('wp_enqueue_scripts', 'cart_quantity_scripts');
function cart_quantity_scripts() {
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
        $cart_item_key = find_cart_item_key_by_product_id($product_id, $variation_id);
        if ($cart_item_key) {
            $result = WC()->cart->set_quantity($cart_item_key, $qti);
            if ($result) {
                wp_send_json_success('Товар удален из корзины');
            }
        }
    wp_send_json_error('Товар не найден в корзине');
}

function find_cart_item_key_by_product_id($product_id, $variation_id = 0) {
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
function disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'disable_comments_post_types_support');

// Закрываем комментарии
function disable_comments_status() {
    return false;
}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);

// Скрываем существующие комментарии
function disable_comments_hide_existing($comments) {
    return array();
}
add_filter('comments_array', 'disable_comments_hide_existing', 10, 2);



add_filter('woocommerce_template_debug_mode', '__return_true');


add_action('admin_bar_menu', function($wp_admin_bar) {
    if (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) {
        global $template;
        $wp_admin_bar->add_node([
            'id'    => 'current_template',
            'title' => 'Шаблон: ' . basename($template),
            'href'  => '#',
            'meta'  => ['title' => 'Текущий шаблон: ' . $template]
        ]);
    }
}, 999);


function truemisha_redirect_to_thank_you() {
 
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
add_action( 'template_redirect', 'truemisha_redirect_to_thank_you' );