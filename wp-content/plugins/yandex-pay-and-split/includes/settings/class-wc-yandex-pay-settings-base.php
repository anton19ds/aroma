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
 * Yandex pay settings abstract class
 */
abstract class WC_Yandex_Pay_Settings_Base {

	/**
	 * The name of the options array.
	 */
	protected const OPTIONS_NAME = '';

	/**
	 * The cached options array.
	 *
	 * @var array|null
	 */
	private static $options = null;

	/**
	 * Retrieves the value of a checkbox option as a boolean.
	 *
	 * @param string $name The name of the option to retrieve.
	 * @return bool True if the option is set to 'yes', false otherwise.
	 */
	protected static function get_checkbox_option( $name ) {
		return 'yes' === static::get_option( $name, 'no' );
	}

	/**
	 * Retrieves a string option by its name.
	 *
	 * @param string $name The name of the option to retrieve.
	 * @return string The value of the option, or an empty string if the option is not set.
	 */
	protected static function get_string_option( $name ) {
		return static::get_option( $name, '' );
	}

	/**
	 * Retrieves an integer option value by name.
	 *
	 * @param string $name The name of the option to retrieve.
	 * @return int The integer value of the option, or 0 if the option is not set.
	 */
	protected static function get_int_option( $name ) {
		return intval( static::get_option( $name, 0 ) );
	}

	/**
	 * Retrieves the value of a specific option.
	 *
	 * @param string $name          The name of the option to retrieve.
	 * @param mixed  $default_value The default value to return if the option is not found.
	 * @return mixed The value of the option if it exists; otherwise, the default value.
	 */
	protected static function get_option( $name, $default_value = null ) {
		return static::get_options()[ static::get_option_name( $name ) ] ?? $default_value;
	}

	/**
	 * Returns the option name.
	 *
	 * @param string $name The name of the option.
	 * @return string The option name.
	 */
	protected static function get_option_name( $name ) {
		return $name;
	}

	/**
	 * Retrieves the options stored in the database for this settings class.
	 *
	 * @return array The options array.
	 */
	public static function get_options() {
		if ( null !== self::$options ) {
			return self::$options;
		}
		self::$options = get_option( static::OPTIONS_NAME );
		return self::$options;
	}
}
