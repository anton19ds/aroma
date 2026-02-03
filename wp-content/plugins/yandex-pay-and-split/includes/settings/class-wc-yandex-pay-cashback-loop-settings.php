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
 * Yandex pay cashback loop badge settings class
 */
class WC_Yandex_Pay_Cashback_Loop_Settings extends WC_Yandex_Pay_Cashback_Settings_Base {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Generates the full option name by prefixing it with 'loop_' and appending the parent option name.
	 *
	 * @param string $name The base option name to be prefixed.
	 * @return string The full option name with the 'loop_' prefix.
	 */
	protected static function get_option_name( $name ) {
		return 'loop_' . parent::get_option_name( $name );
	}
}
