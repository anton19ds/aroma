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
 * Yandex pay main settings class
 */
class WC_Yandex_Pay_Main_Settings extends WC_Yandex_Pay_Settings_Base {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Retrieves the merchant ID from the settings.
	 *
	 * @return string The merchant ID.
	 */
	public static function get_merchant_id() {
		return self::get_string_option( 'merchant_id' );
	}

	/**
	 * Retrieves the test environment setting.
	 *
	 * @return bool The value of the test environment setting.
	 */
	public static function is_test_environment() {
		return self::get_checkbox_option( 'test_environment' );
	}

	/**
	 * Retrieves the API key from the settings.
	 *
	 * @return string The API key.
	 */
	public static function get_api_key() {
		return self::get_string_option( 'api_key' );
	}

	/**
	 * Retrieves the TTL (Time To Live) setting.
	 *
	 * @return int The TTL value.
	 */
	public static function get_ttl() {
		return self::get_int_option( 'ttl' );
	}

	/**
	 * Retrieves the order status for pending orders.
	 *
	 * @return string The order status for pending orders.
	 */
	public static function get_pending_order_status() {
		return self::get_string_option( 'pending_order_status' );
	}

	/**
	 * Retrieves the order status for successful payments.
	 *
	 * @return string The order status for successful payments.
	 */
	public static function get_success_order_status() {
		return self::get_string_option( 'success_order_status' );
	}

	/**
	 * Retrieves the order status assigned to orders with errors.
	 *
	 * @return string The order status for errored orders.
	 */
	public static function get_error_order_status() {
		return self::get_string_option( 'error_order_status' );
	}

	/**
	 * Retrieves the order status for refunds.
	 *
	 * @return string The order status used for refunds.
	 */
	public static function get_refund_order_status() {
		return self::get_string_option( 'refund_order_status' );
	}

	/**
	 * Retrieves the order status for failed refunds.
	 *
	 * @return string The order status used for failed refunds.
	 */
	/**
	 * Retrieves the order status for refunds.
	 *
	 * @return string The order status used for refunds.
	 */
	public static function get_failed_refund_order_status() {
		return self::get_string_option( 'failed_refund_order_status' );
	}

	/**
	 * Retrieves the purpose setting.
	 *
	 * @return string The value of the purpose setting.
	 */
	public static function get_purpose() {
		return self::get_string_option( 'purpose' );
	}

	/**
	 * Retrieves the card gateway title.
	 *
	 * @return string Card gateway title.
	 */
	public static function get_yandex_pay_card_title() {
		return __( 'With any bank card', 'yandex-pay-and-split' );
	}

	/**
	 * Retrieves the card gateway description.
	 *
	 * @return string Card gateway description.
	 */
	public static function get_yandex_pay_card_description() {
		return __( 'Full payment', 'yandex-pay-and-split' );
	}

	/**
	 * Retrieves the split gateway title.
	 *
	 * @return string Split gateway title.
	 */
	public static function get_yandex_pay_split_title() {
		return __( 'Yandex Split', 'yandex-pay-and-split' );
	}

	/**
	 * Retrieves the split gateway description.
	 *
	 * @return string Split gateway description.
	 */
	public static function get_yandex_pay_split_description() {
		return __( 'Payment in installments', 'yandex-pay-and-split' );
	}
}
