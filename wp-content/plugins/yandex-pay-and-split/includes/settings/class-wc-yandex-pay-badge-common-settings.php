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
 * Yandex pay badge common settings class
 */
class WC_Yandex_Pay_Badge_Common_Settings extends WC_Yandex_Pay_Badge_Settings {

	protected const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Checks if the Yandex Pay badge is enabled.
	 *
	 * @return bool True if the badge is enabled, false otherwise.
	 */
	public static function is_enabled() {
		return self::get_checkbox_option( 'enabled' );
	}
}
