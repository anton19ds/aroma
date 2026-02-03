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

namespace YandexPay\Settings;

/**
 * Yandex pay cashback badge base settings class
 */
class WC_Yandex_Pay_Cashback_Settings_Base extends WC_Yandex_Pay_Badge_Settings {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Checks if the Yandex Pay cashback feature is enabled.
	 *
	 * The feature is considered enabled if both the common settings are enabled
	 * and the 'CARD' payment method is available.
	 *
	 * @return bool True if the Yandex Pay cashback feature is enabled, false otherwise.
	 */
	public static function is_enabled() {
		return WC_Yandex_Pay_Badge_Common_Settings::is_enabled() && in_array( 'CARD', WC_Yandex_Pay_Settings::get_available_payment_methods(), true );
	}

	/**
	 * Generates the option name for cashback settings by prefixing it with 'cashback_'.
	 *
	 * @param string $name The base name of the option.
	 * @return string The full option name with 'cashback_' prefix.
	 */
	protected static function get_option_name( $name ) {
		return 'cashback_' . parent::get_option_name( $name );
	}
}
