<?php
/**
 * Yandex Pay Payment Gateway
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

// phpcs:disable WordPress.Security.NonceVerification.Missing

namespace YandexPay\Render\Payment;

use YandexPay\Render\Base\WC_Yandex_Pay_Render_Base;
use YandexPay\Settings\WC_Yandex_Pay_Settings;
use YandexPay\Settings\WC_Yandex_Pay_Widget_Settings;
use YandexPay\Settings\WC_Yandex_Pay_Badge_Common_Settings;
/**
 * Yandex pay fronted widgets part render class
 */
class WC_Yandex_Pay_Widgets extends WC_Yandex_Pay_Render_Base {

	/**
	 * All payment gateways
	 *
	 * @var string[]
	 */
	public const YANDEX_PAYMENT_GATEWAY_IDS = array(
		YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID,
		YANDEX_PAY_AND_SPLIT_PLUGIN_SPLIT_GATEWAY_ID,
	);

	/**
	 * Widget settings
	 *
	 * @var WC_Yandex_Pay_Widget_Settings
	 */
	private $widget_settings;
	/**
	 * WC_Yandex_Pay_Payment constructor.
	 *
	 * @param WC_Yandex_Pay_Assets $assets assets instance.
	 */
	public function __construct( $assets ) {
		if ( empty( WC_Yandex_Pay_Settings::get_main_settings()::get_merchant_id() ) ) {
			return;
		}
		$this->widget_settings = WC_Yandex_Pay_Settings::get_widget_settings();
		if ( ! $this->widget_settings::is_enabled() ) {
			return;
		}
		parent::__construct( $assets );
	}

	/**
	 * Registers and enqueues necessary assets for the Yandex Pay payment gateway.
	 *
	 * This method checks if the current page is the checkout page and if the Yandex Pay gateway is enabled.
	 */
	public function register_assets() {
		if (
			( ! is_product() && ! is_checkout() ) ||
			empty( WC_Yandex_Pay_Settings::get_available_payment_methods() ) ||
			( is_product() && WC_Yandex_Pay_Badge_Common_Settings::is_enabled() )
		) {
			return;
		}

		if ( is_checkout() && empty( is_wc_endpoint_url( 'order-received' ) ) ) {
			$this->assets->enqueue_local_script( 'checkout_observer' );
		} elseif ( is_product() ) {
			$product = $this->get_product();

			if ( $this->is_product_quantity_exists( $product ) ) {
				if ( $product->is_type( 'variable' ) ) {
					$this->assets->enqueue_local_script( 'variable_product_observer' );
				} else {
					$this->assets->enqueue_local_script( 'simple_product_observer' );
				}
			}
		}

		$this->assets->add_script_data(
			$this->assets::MAIN_HANDLE,
			'widget_settings',
			array(
				'widgetType'       => 'Ultimate',
				'widgetTheme'      => $this->widget_settings::get_theme(),
				'widgetSize'       => $this->widget_settings::get_size(),
				'widgetBackground' => $this->widget_settings::get_background(),
				'withOutline'      => $this->widget_settings::is_outlined(),
				'hideWidgetHeader' => $this->widget_settings::is_hide_header(),
				'padding'          => $this->widget_settings::get_padding(),

			),
		);
	}

	/**
	 * Initializes WooCommerce hooks for Yandex Pay payment gateway.
	 *
	 * Checks if the Yandex Pay payment gateway is enabled among available gateways.
	 */
	public function init_woocommerce_hooks() {
		if ( ! WC_Yandex_Pay_Badge_Common_Settings::is_enabled() ) {
			add_action( 'woocommerce_single_product_summary', array( $this, 'add_widget_to_product_page' ), 15 );
		}
		add_filter( 'woocommerce_gateway_description', array( $this, 'add_widget_to_gateway' ), 10, 2 );
	}

	/**
	 * Renders the container for the Yandex Pay and Split widget.
	 */
	public function render_widget_container() {
		?>
		<div class="yandex-pay-and-split_widget_container"></div>
		<?php
	}

	/**
	 * Adds a Yandex Pay widget to the specified gateway description if the gateway ID matches Yandex Payment Gateway IDs.
	 *
	 * @param string $description The current description of the gateway.
	 * @param string $gateway_id The ID of the gateway to which the widget should be added.
	 * @return string The updated description of the gateway with the Yandex Pay widget added.
	 */
	public function add_widget_to_gateway( $description, $gateway_id ) {
		if ( ! in_array( $gateway_id, self::YANDEX_PAYMENT_GATEWAY_IDS, true ) ) {
			return;
		}

		ob_start();
		$this->render_widget_container();
		$description .= ob_get_clean();

		return $description;
	}

	/**
	 * Adds the widget to the product page if the product is purchasable.
	 */
	public function add_widget_to_product_page() {
		$product = $this->get_product();

		if ( ! $this->is_product_is_purchasable( $product ) ) {
			return;
		}
		$this->render_widget_container();
	}
}
