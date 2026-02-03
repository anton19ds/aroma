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
/**
 * Yandex pay fronted payment part render class
 */
class WC_Yandex_Pay_Payment extends WC_Yandex_Pay_Render_Base {

	/**
	 * Button theme
	 *
	 * @var string
	 */
	private $button_theme;
	/**
	 * Button width
	 *
	 * @var string
	 */
	private $button_width;
	/**
	 * Use pay button
	 *
	 * @var bool
	 */
	private $use_pay_button;

	/**
	 * WC_Yandex_Pay_Payment constructor.
	 *
	 * @param WC_Yandex_Pay_Assets $assets assets instance.
	 */
	public function __construct( $assets ) {
		if ( empty( WC_Yandex_Pay_Settings::get_main_settings()::get_merchant_id() ) ) {
			return;
		}
		$checkout_button_settings = WC_Yandex_Pay_Settings::get_checkout_button_settings();
		if ( ! $checkout_button_settings::get_use_pay_button() ) {
			return;
		}
		$this->button_theme = $checkout_button_settings::get_button_theme();
		$this->button_width = $checkout_button_settings::get_button_width();
		parent::__construct( $assets );
	}

	/**
	 * Registers and enqueues necessary assets for the Yandex Pay payment gateway.
	 *
	 * This method checks if the current page is the checkout page and if the Yandex Pay gateway is enabled.
	 */
	public function register_assets() {
		if ( ! is_checkout() || empty( WC_Yandex_Pay_Settings::get_available_payment_methods() ) ) {
			return;
		}

		$this->assets->enqueue_main_style();
		if ( empty( is_wc_endpoint_url( 'order-received' ) ) ) {
			$this->assets->enqueue_local_script( 'checkout_observer' );
		}
		$this->assets->add_script_data(
			$this->assets::MAIN_HANDLE,
			'button_settings',
			array(
				'theme' => $this->button_theme,
				'width' => $this->button_width,
			),
		);
	}

	/**
	 * Initializes WooCommerce hooks for Yandex Pay payment gateway.
	 *
	 * Checks if the Yandex Pay payment gateway is enabled among available gateways.
	 */
	public function init_woocommerce_hooks() {
		if ( empty( WC_Yandex_Pay_Settings::get_available_payment_methods() ) ) {
			return;
		}
		add_filter( 'woocommerce_review_order_before_submit', array( $this, 'add_custom_payment_button_container' ) );
	}

	/**
	 * Adds a container for rendering the pay button to the place order button
	 */
	public function add_custom_payment_button_container() {
		?>
			<div id="yandex-pay-and-split-button-container"></div>
		<?php
	}
}
