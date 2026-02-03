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
 * Yandex pay bnpl badge base settings class
 */
class WC_Yandex_Pay_BNPL_Settings_Base extends WC_Yandex_Pay_Badge_Settings {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Checks if the Yandex Pay BNPL settings are enabled.
	 *
	 * @return bool True if Yandex Pay Badge Common Settings are enabled and 'SPLIT' is one of the available payment methods, false otherwise.
	 */
	public static function is_enabled() {
		return WC_Yandex_Pay_Badge_Common_Settings::is_enabled() && in_array( 'SPLIT', WC_Yandex_Pay_Settings::get_available_payment_methods(), true );
	}

	/**
	 * Generates the option name for Yandex Pay BNPL settings by prefixing it with 'bnpl_'.
	 *
	 * @param string $name The base option name.
	 * @return string The full option name with 'bnpl_' prefix.
	 */
	protected static function get_option_name( $name ) {
		return 'bnpl_' . parent::get_option_name( $name );
	}
}
