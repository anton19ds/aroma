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
 * Yandex pay bnpl single page badge settings class
 */
class WC_Yandex_Pay_BNPL_Single_Settings extends WC_Yandex_Pay_BNPL_Settings_Base {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Gets the option name prefixed with 'single_'.
	 *
	 * @param string $name The original option name to be prefixed.
	 * @return string The prefixed option name.
	 */
	protected static function get_option_name( $name ) {
		return 'single_' . parent::get_option_name( $name );
	}
}
