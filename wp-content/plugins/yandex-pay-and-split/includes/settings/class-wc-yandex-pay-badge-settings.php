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
 * Yandex pay badge settings class
 */
class WC_Yandex_Pay_Badge_Settings extends WC_Yandex_Pay_Settings_Base {

	/**
	 * Retrieves the theme setting for Yandex Pay badge.
	 *
	 * @return mixed The value of the theme setting.
	 */
	public static function get_theme() {
		return self::get_option( 'theme' );
	}

	/**
	 * Retrieves the size setting for the Yandex Pay badge.
	 *
	 * @return mixed The size setting value.
	 */
	public static function get_size() {
		return self::get_option( 'size' );
	}

	/**
	 * Retrieves the alignment setting for the Yandex Pay badge.
	 *
	 * @return mixed The alignment setting value.
	 */
	public static function get_align() {
		return self::get_option( 'align' );
	}

	/**
	 * Retrieves the color setting for the Yandex Pay badge.
	 *
	 * @return mixed The color value as retrieved from the options.
	 */
	public static function get_color() {
		return self::get_option( 'color' );
	}

	/**
	 * Retrieves the variant setting for Yandex Pay badge.
	 *
	 * @return mixed The value of the 'variant' option.
	 */
	public static function get_variant() {
		return self::get_option( 'variant' );
	}

	/**
	 * Retrieves the position setting for the Yandex Pay badge.
	 *
	 * @return mixed The position setting value.
	 */
	public static function get_position() {
		return self::get_option( 'position' );
	}

	/**
	 * Generates the option name for badge settings by prefixing it with 'badge_'.
	 *
	 * @param string $name The base name of the option.
	 * @return string The full option name with 'badge_' prefix.
	 */
	protected static function get_option_name( $name ) {
		return 'badge_' . parent::get_option_name( $name );
	}
}
