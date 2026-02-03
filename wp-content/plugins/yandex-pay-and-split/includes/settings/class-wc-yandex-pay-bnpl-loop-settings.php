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
 * Yandex pay bnpl loop badge settings class
 */
class WC_Yandex_Pay_BNPL_Loop_Settings extends WC_Yandex_Pay_BNPL_Settings_Base {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Generates the full option name for a setting by prepending 'loop_' to the base option name.
	 *
	 * @param string $name The base name of the option.
	 * @return string The full option name with 'loop_' prefix.
	 */
	protected static function get_option_name( $name ) {
		return 'loop_' . parent::get_option_name( $name );
	}
}
