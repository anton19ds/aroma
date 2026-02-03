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
 * Yandex pay widget settings class
 */
class WC_Yandex_Pay_Widget_Settings extends WC_Yandex_Pay_Settings_Base {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Checks if the Yandex Pay widget is enabled.
	 *
	 * @return bool True if the widget is enabled, false otherwise.
	 */
	public static function is_enabled() {
		return self::get_checkbox_option( 'enabled' );
	}

	/**
	 * Retrieves the theme setting.
	 *
	 * @return string The current theme setting.
	 */
	public static function get_theme() {
		return self::get_string_option( 'theme' );
	}

	/**
	 * Retrieves the padding setting.
	 *
	 * @return string The padding setting value.
	 */
	public static function get_padding() {
		return self::get_string_option( 'padding' );
	}

	/**
	 * Retrieves the size setting for the Yandex Pay widget.
	 *
	 * @return string The size setting value.
	 */
	public static function get_size() {
		return self::get_string_option( 'size' );
	}

	/**
	 * Checks if the outlined option is enabled.
	 *
	 * @return bool True if the outlined option is enabled, false otherwise.
	 */
	public static function is_outlined() {
		return self::get_checkbox_option( 'outlined' );
	}

	/**
	 * Retrieves the background setting.
	 *
	 * @return string The value of the background setting.
	 */
	public static function get_background() {
		return self::get_string_option( 'background' );
	}

	/**
	 * Checks if the header should be hidden based on the checkbox option.
	 *
	 * @return bool True if the header should be hidden, false otherwise.
	 */
	public static function is_hide_header() {
		return self::get_checkbox_option( 'hide_header' );
	}

	/**
	 * Generates the option name for the widget setting.
	 *
	 * @param string $name The base name of the option.
	 * @return string The full option name prefixed with 'widget_'.
	 */
	protected static function get_option_name( $name ) {
		return 'widget_' . $name;
	}
}
