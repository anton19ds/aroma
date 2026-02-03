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
 * Yandex pay checkout button settings class
 */
class WC_Yandex_Pay_Checkout_Button_Settings extends WC_Yandex_Pay_Settings_Base {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Retrieves the status of the use pay button option.
	 *
	 * @return bool True if the pay button should be used, false otherwise.
	 */
	public static function get_use_pay_button() {
		return self::get_checkbox_option( 'use_pay_button' );
	}

	/**
	 * Retrieves the theme of the checkout button.
	 *
	 * @return string The theme of the checkout button.
	 */
	public static function get_button_theme() {
		return self::get_string_option( 'button_theme' );
	}

	/**
	 * Retrieves the width of the Yandex Pay checkout button.
	 *
	 * @return string The width of the button as a string.
	 */
	public static function get_button_width() {
		return self::get_string_option( 'button_width' );
	}

	/**
	 * Retrieves the current icons theme setting.
	 *
	 * @return string The current icons theme setting.
	 */
	public static function get_icons_theme() {
		return self::get_string_option( 'icons_theme' );
	}
}
