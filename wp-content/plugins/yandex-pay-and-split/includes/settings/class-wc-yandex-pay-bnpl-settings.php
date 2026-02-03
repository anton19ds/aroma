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
 * Yandex pay bnpl badge settings class
 */
class WC_Yandex_Pay_BNPL_Settings extends WC_Yandex_Pay_Settings_Base {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Checks if the BNPL settings are enabled.
	 *
	 * @return bool True if BNPL is enabled; false otherwise.
	 */
	public static function is_enabled() {
		return static::get_single_page_settings()::is_enabled() || static::get_loop_settings()::is_enabled();
	}

	/**
	 * Returns the class name for single page settings related to Yandex Pay BNPL.
	 *
	 * @return string The fully qualified class name for single page settings.
	 */
	public static function get_single_page_settings() {
		return WC_Yandex_Pay_BNPL_Single_Settings::class;
	}

	/**
	 * Returns the fully qualified class name of the loop settings class.
	 *
	 * @return string The class name of the loop settings as a string.
	 */
	public static function get_loop_settings() {
		return WC_Yandex_Pay_BNPL_Loop_Settings::class;
	}
}
