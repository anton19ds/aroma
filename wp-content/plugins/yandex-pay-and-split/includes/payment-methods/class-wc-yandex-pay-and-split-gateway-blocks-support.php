<?php
/**
 * Yandex Pay And Split Abstract Blocks Support Payment Gateway
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;
use YandexPay\Settings\WC_Yandex_Pay_Settings;
use YandexPay\Settings\WC_Yandex_Pay_Settings_Base;

/**
 * WooCommerce Payment Gateway blocks support abstract class
 */
abstract class WC_Yandex_Pay_And_Split_Gateway_Blocks_Support extends AbstractPaymentMethodType {

	/**
	 * Payment method (card or split)
	 *
	 * @var string
	 */
	private $payment_method;

	/**
	 * Plugin main settings instance
	 *
	 * @var string
	 */
	protected $main_settings;

	/**
	 * Current payment gateway
	 *
	 * @var \WC_Payment_Gateway
	 */
	private $gateway;

	/**
	 * Data to display on client
	 *
	 * @var array
	 */
	protected $payment_method_data = array();

	/**
	 * Initializes instance of blocks support class
	 */
	public function initialize() {
		$name_parts           = explode( '-', $this->name );
		$this->payment_method = $name_parts[ count( $name_parts ) - 1 ];

		$this->main_settings = WC_Yandex_Pay_Settings::get_main_settings();
		$this->settings      = WC_Yandex_Pay_Settings_Base::get_options();

		$gateways      = WC()->payment_gateways->payment_gateways();
		$this->gateway = $gateways[ $this->name ];
	}

	/**
	 * Connects JS files that contain the client part of the integration
	 *
	 * @return array
	 */
	public function get_payment_method_script_handles() {
		$script_name = 'wc-yandex-pay-and-split-' . $this->payment_method . '-blocks-integration';

		$script_src =
			YANDEX_PAY_AND_SPLIT_PLUGIN_URL .
			'/assets/js/yandex-pay-' .
			$this->payment_method .
			'-blocks-support.yapay.js';

		wp_register_script(
			$script_name,
			$script_src,
			array( 'wc-blocks-registry', 'wc-settings', 'wp-element', 'wp-html-entities' ),
			YANDEX_PAY_AND_SPLIT_PLUGIN_VERSION,
			true
		);

		return array( $script_name );
	}

	/**
	 * Returns the type of payment method
	 *
	 * @return string
	 */
	private function get_payment_method_type() {
		return 'card' === $this->payment_method ? 'pay' : 'split';
	}

	/**
	 * Returns a string with a link to the payment method icon, if the icons are enabled
	 *
	 * @return string
	 */
	private function get_payment_method_icon() {
		$theme = wc_clean( wp_unslash( $this->settings['icons_theme'] ) );

		$icon = '';

		if ( 'blank' !== $theme ) {
			$type   = $this->get_payment_method_type();
			$locale = 'ru_RU' === get_locale() ? 'ru' : 'en';

			$icon = YANDEX_PAY_AND_SPLIT_PLUGIN_URL .
				'/assets/icons/' .
				$type .
				'_' .
				$theme .
				'_' .
				$locale .
				'.svg';
		}

		return $icon;
	}

	/**
	 * Provides all the necessary data what going to use on the front-end as an associative array
	 *
	 * @return array
	 */
	public function get_payment_method_data() {
		$icon = $this->get_payment_method_icon();

		if ( ! empty( $icon ) ) {
			$this->payment_method_data['icon'] = $icon;
		}

		$this->payment_method_data['supports'] = array_filter(
			$this->gateway->supports,
			array(
				$this->gateway,
				'supports',
			)
		);

		return $this->payment_method_data;
	}
}
