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
 * Yandex Pay Settings class
 */
class WC_Yandex_Pay_Settings extends WC_Yandex_Pay_Settings_Base {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Cached available payment methods
	 *
	 * @var array
	 */
	private static $available_methods = null;

	/**
	 * Get main settings class
	 *
	 * @return string
	 */
	public static function get_main_settings() {
		return WC_Yandex_Pay_Main_Settings::class;
	}

	/**
	 * Returns the class name for BNPL settings.
	 *
	 * @return string The class name for BNPL settings.
	 */
	public static function get_badge_bnpl_settings() {
		return WC_Yandex_Pay_BNPL_Settings::class;
	}

	/**
	 * Returns the class name for badge cashback settings.
	 *
	 * @return string The class name for badge cashback settings.
	 */
	public static function get_badge_cashback_settings() {
		return WC_Yandex_Pay_Cashback_Settings::class;
	}

	/**
	 * Get checkout button settings class
	 *
	 * @return string
	 */
	public static function get_checkout_button_settings() {
		return WC_Yandex_Pay_Checkout_Button_Settings::class;
	}

	/**
	 * Returns the class name of the widget settings.
	 *
	 * @return string
	 */
	public static function get_widget_settings() {
		return WC_Yandex_Pay_Widget_Settings::class;
	}

	/**
	 * Retrieves the available payment methods for Yandex Pay and Split.
	 *
	 * @return array An array containing the available payment methods.
	 */
	public static function get_available_payment_methods() {
		if ( null !== self::$available_methods ) {
			return self::$available_methods;
		}
		$gateways = WC()->payment_gateways->get_available_payment_gateways();

		self::$available_methods = array();
		if ( array_key_exists( YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID, $gateways ) ) {
			self::$available_methods[] = 'CARD';
		}

		if ( array_key_exists( YANDEX_PAY_AND_SPLIT_PLUGIN_SPLIT_GATEWAY_ID, $gateways ) ) {
			self::$available_methods[] = 'SPLIT';
		}
		return self::$available_methods;
	}

	/**
	 * Get environment API URL
	 *
	 * @return string
	 */
	public static function get_api_url() {
		return self::get_main_settings()::is_test_environment()
		? \WC_Yandex_Pay_And_Split_Api::get_sandbox_url()
		: \WC_Yandex_Pay_And_Split_Api::get_yandex_pay_url();
	}

	/**
	 * Get environment
	 *
	 * @return string
	 */
	public static function get_environment() {
		return self::get_main_settings()::is_test_environment()
		? 'SANDBOX'
		: 'PRODUCTION';
	}

	/**
	 * Get system language
	 *
	 * @return string
	 */
	public static function get_language() {
		return get_locale() === 'ru_RU' ? 'ru' : 'en';
	}

	/**
	 * Get system currency
	 *
	 * @return string
	 */
	public static function get_currency() {
		return get_woocommerce_currency();
	}
}
