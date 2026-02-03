<?php
/**
 * Yandex Pay And Split
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

use YandexPay\Assets\WC_Yandex_Pay_Assets;
use YandexPay\Lib\Logger;
use YandexPay\Render\WC_Yandex_Pay_Render;
use YandexPay\Settings\WC_Yandex_Pay_Admin_Settings;

/**
 * WooCommerce Yandex Pay and Split class
 */
class WC_Yandex_Pay_And_Split {

	/**
	 * Yandex Pay class instance
	 *
	 * @var static
	 */
	private static $instance = null;

	/**
	 * Logger instance
	 *
	 * @var WC_Logger
	 */
	public $logger;

	/**
	 * Render instance
	 *
	 * @var WC_Yandex_Pay_Render
	 */
	private $render;

	/**
	 * Assets instance
	 *
	 * @var WC_Yandex_Pay_Assets
	 */
	private $assets;

	/**
	 * Adds localization download after installing the theme
	 */
	public static function init_translation() {
		add_action(
			'after_setup_theme',
			function () {
				load_plugin_textdomain(
					'yandex-pay-and-split',
					false,
					dirname( YANDEX_PAY_AND_SPLIT_PLUGIN_BASE ) . '/i18n/languages'
				);
			}
		);
	}

	/**
	 * Gets the instance via lazy initialization (created on first usage)
	 *
	 * @return static class instance.
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * WC_Yandex_Pay_And_Split constructor.
	 */
	private function __construct() {
		$this->load();

		add_action( 'template_redirect', array( $this, 'set_default_gateway' ) );

		add_action( 'woocommerce_blocks_loaded', array( $this, 'add_gateway_blocks_support' ) );

		add_filter( 'woocommerce_payment_gateways', array( $this, 'add_gateways' ) );

		add_filter(
			'plugin_action_links_' . YANDEX_PAY_AND_SPLIT_PLUGIN_BASE,
			array(
				$this,
				'plugin_action_links',
			)
		);
		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );

		add_filter(
			'woocommerce_my_account_my_orders_actions',
			array( $this, 'remove_repeat_pay_button' ),
			10,
			2
		);

		add_action( 'init', array( $this, 'register_order_statuses' ) );
		add_filter( 'wc_order_statuses', array( $this, 'add_order_statuses_to_list' ) );

		$this->logger = new Logger( wc_get_logger() );
		$this->assets = new WC_Yandex_Pay_Assets();
		$this->render = new WC_Yandex_Pay_Render( $this->assets );

		new WC_Yandex_Pay_Admin_Settings();
	}

	/**
	 * Return Assets instance
	 *
	 * @return WC_Yandex_Pay_Assets
	 */
	public function get_assets() {
		return $this->assets;
	}

	/**
	 * Checks whether the payment method is enabled by id and sets it as default
	 *
	 * @param string $id payment gateway id.
	 *
	 * @return bool default payment method installation success flag.
	 */
	private function chose_payment_method( $id ) {
		$settings = get_option( 'woocommerce_' . $id . '_settings' );

		if ( is_array( $settings ) && isset( $settings['enabled'] ) && 'yes' === $settings['enabled'] ) {
			WC()->session->set( 'chosen_payment_method', $id );

			return true;
		}

		return false;
	}

	/**
	 * Sets the default payment method (Yandex Pay or Yandex Split)
	 */
	public function set_default_gateway() {
		if ( is_checkout() && ! is_wc_endpoint_url() ) {
			if ( $this->chose_payment_method( YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID ) ) {
				return;
			}

			if ( $this->chose_payment_method( YANDEX_PAY_AND_SPLIT_PLUGIN_SPLIT_GATEWAY_ID ) ) {
				return;
			}
		}
	}

	/**
	 * Adds blocks support for our gateways
	 */
	public function add_gateway_blocks_support() {
		if (
			! class_exists(
				'Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType'
			) ||
			! YANDEX_PAY_AND_SPLIT_IS_BLOCKS_SUPPORTS
		) {
			return;
		}

		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR . '/includes/payment-methods/class-wc-yandex-pay-and-split-gateway-blocks-support.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR . '/includes/payment-methods/class-wc-yandex-pay-card-gateway-blocks-support.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR . '/includes/payment-methods/class-wc-yandex-pay-split-gateway-blocks-support.php';

		add_action(
			'woocommerce_blocks_payment_method_type_registration',
			function ( Automattic\WooCommerce\Blocks\Payments\PaymentMethodRegistry $payment_method_registry ) {
				$payment_method_registry->register( new WC_Yandex_Pay_Card_Gateway_Blocks_Support() );
				$payment_method_registry->register( new WC_Yandex_Pay_Split_Gateway_Blocks_Support() );
			}
		);
	}

	/**
	 * Adds our gateways to the general list
	 *
	 * @param mixed $gateways payment gateways list.
	 *
	 * @return mixed updated payment gateways list.
	 */
	public function add_gateways( $gateways ) {
		$gateways[] = 'WC_Gateway_Yandex_Pay_Card';
		$gateways[] = 'WC_Gateway_Yandex_Pay_Split';

		return $gateways;
	}

	/**
	 * Registers custom WooCommerce order statuses for failed refunds.
	 */
	public function register_order_statuses() {
		register_post_status(
			'wc-failed-refund',
			array(
				'label'                     => __( 'Failed refund', 'yandex-pay-and-split' ),
				'public'                    => true,
				'show_in_admin_status_list' => true,
				/* translators: %s is replaced with the number of orders */
				'label_count'               => _n_noop( 'Failed refund (%s)', 'Failed refund (%s)', 'yandex-pay-and-split' ),
			)
		);
	}

	/**
	 * Adds custom order statuses to the provided list of base order statuses.
	 *
	 * @param array $base_statuses The list of existing order statuses.
	 * @return array The updated list of order statuses with custom ones added.
	 */
	public function add_order_statuses_to_list( $base_statuses ) {
		$result = array();

		foreach ( $base_statuses as $id => $label ) {

			$result[ $id ] = $label;

			if ( 'wc-failed' === $id ) {
				$result['wc-failed-refund'] = __( 'Failed refund', 'yandex-pay-and-split' );
			}
		}

		return $result;
	}


	/**
	 * Render setting link in our plugin row
	 *
	 * @param array|string[] $links Array of links.
	 *
	 * @return array|string[] Updated array of links.
	 */
	public function plugin_action_links( $links ) {
		$new_links = array();

		$settings_link = esc_url(
			add_query_arg(
				array(
					'page' => 'yandex-pay-settings',
				),
				admin_url( 'admin.php' )
			)
		);

		$new_links['settings'] = sprintf(
			'<a href="%1$s" title="%2$s">%2$s</a>',
			$settings_link,
			esc_attr__( 'Settings', 'yandex-pay-and-split' )
		);

		return array_merge( $new_links, $links );
	}

	/**
	 * Render documentation link in our plugin row
	 *
	 * @param array|string[] $links Array of links.
	 * @param string         $file The path to the plugin file.
	 *
	 * @return array|string[] Updated array of links.
	 */
	public function plugin_row_meta( $links, $file ) {
		if ( YANDEX_PAY_AND_SPLIT_PLUGIN_BASE === $file ) {
			$documentation_url = add_query_arg(
				array(
					'utm_source'   => 'wp-admin-plugins',
					'utm_medium'   => 'row-meta-link',
					'utm_campaign' => YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID,
				),
				'https://pay.yandex.ru/docs/ru/cms/wordpress/'
			);

			$row_meta['documentation'] = sprintf(
				'<a target="_blank" href="%1$s" title="%2$s">%2$s</a>',
				esc_url( $documentation_url ),
				esc_html__( 'Read Documentation', 'yandex-pay-and-split' )
			);

			return array_merge( $links, $row_meta );
		}

		return (array) $links;
	}

	/**
	 * Removes the repeat payment button for orders paid using the Yandex Pay and Split payment gateway in the order list
	 *
	 * @param array     $actions Array of actions (buttons).
	 * @param \WC_Order $order WooCommerce order entity.
	 *
	 * @return array Updated array of actions (buttons).
	 */
	public function remove_repeat_pay_button( $actions, $order ) {
		if (
			in_array(
				$order->get_payment_method(),
				array(
					YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID,
					YANDEX_PAY_AND_SPLIT_PLUGIN_SPLIT_GATEWAY_ID,
				),
				true
			)
		) {
			$status = $order->get_status();

			if ( in_array( $status, array( 'pending', 'failed' ), true ) ) {
				unset( $actions['pay'] );

				if ( 'failed' === $status ) {
					unset( $actions['cancel'] );
				}
			}
		}

		return $actions;
	}

	/**
	 * Prevent from being unserialized (which would create a second instance of it)
	 *
	 * @throws Exception Cannot unserialize singleton.
	 */
	public function __wakeup() {
		throw new Exception( 'Cannot unserialize singleton' );
	}

	/**
	 * Load all plugin files from include
	 */
	private static function load() {
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR . '/vendor/autoload.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR . '/lib/class-logger.php';

		self::load_helpers();
		self::load_settings();
		self::load_frontend();
		self::load_payment();
	}

	/**
	 * Load all helpers
	 */
	private static function load_helpers() {
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/api/class-wc-yandex-pay-and-split-api.php';

		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/assets/class-wc-yandex-pay-assets-base.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/assets/class-wc-yandex-pay-assets.php';
	}

	/**
	 * Load all payment methods
	 */
	private static function load_payment() {
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/payment-methods/class-wc-gateway-yandex-pay-and-split.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/payment-methods/class-wc-gateway-yandex-pay-card.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/payment-methods/class-wc-gateway-yandex-pay-split.php';
	}

	/**
	 * Load all render classes
	 */
	private static function load_frontend() {
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/render/base/class-wc-yandex-pay-render-base.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/render/class-wc-yandex-pay-render.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/render/payment/class-wc-yandex-pay-payment.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/render/badges/class-wc-yandex-pay-badges.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/render/widget/class-wc-yandex-pay-widgets.php';
	}

	/**
	 * Load all settings classes
	 */
	private static function load_settings() {
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-settings-base.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-main-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-checkout-button-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-badge-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-badge-common-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-bnpl-settings-base.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-bnpl-loop-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-bnpl-single-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-bnpl-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-cashback-settings-base.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-cashback-loop-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-admin-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-cashback-single-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-cashback-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-widget-settings.php';
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/settings/class-wc-yandex-pay-settings.php';
	}
}
