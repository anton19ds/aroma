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
 * Yandex pay cashback single page badge settings class
 */
class WC_Yandex_Pay_Cashback_Single_Settings extends WC_Yandex_Pay_Cashback_Settings_Base {

	/**
	 * Gets the option name prefixed with 'single_'.
	 *
	 * @param string $name The base option name to be modified.
	 * @return string The modified option name with 'single_' prefix.
	 */
	protected static function get_option_name( $name ) {
		return 'single_' . parent::get_option_name( $name );
	}
}
