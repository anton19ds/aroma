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
 * Yandex pay cashback badge settings class
 */
class WC_Yandex_Pay_Cashback_Settings extends WC_Yandex_Pay_Badge_Settings {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Checks if the cashback feature is enabled.
	 *
	 * @return bool True if cashback is enabled in either context, false otherwise.
	 */
	public static function is_enabled() {
		return static::get_single_page_settings()::is_enabled() || static::get_loop_settings()::is_enabled();
	}

	/**
	 * Returns the class name for the single page settings related to Yandex Pay Cashback.
	 *
	 * @return string The fully qualified class name for the single settings class.
	 */
	public static function get_single_page_settings() {
		return WC_Yandex_Pay_Cashback_Single_Settings::class;
	}

	/**
	 * Retrieves the class name for the loop settings.
	 *
	 * @return string The fully qualified class name for loop settings class.
	 */
	public static function get_loop_settings() {
		return WC_Yandex_Pay_Cashback_Loop_Settings::class;
	}
}
