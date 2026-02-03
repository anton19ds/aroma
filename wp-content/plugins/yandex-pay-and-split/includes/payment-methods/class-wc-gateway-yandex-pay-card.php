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

use YandexPay\Settings\WC_Yandex_Pay_Settings;

/**
 * WooCommerce Payment Gateway class
 */
class WC_Gateway_Yandex_Pay_Card extends WC_Gateway_Yandex_Pay_And_Split {

	/**
	 * WC_Gateway_Yandex_Pay_Card constructor.
	 */
	public function __construct() {
		$this->id                 = YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID;
		$this->has_fields         = false;
		$this->method_title       = __( 'Yandex Pay', 'yandex-pay-and-split' );
		$this->method_description = sprintf(
			/* translators: %s: link to Yandex Pay settings page */
			__(
				'The official Yandex Pay and Split module for WooCommerce. Configure additional settings in %s.',
				'yandex-pay-and-split'
			),
			'<a href="' . admin_url( 'admin.php?page=yandex-pay-settings' ) . '">' . __( 'Yandex Pay and Split Settings', 'yandex-pay-and-split' ) . '</a>'
		);

		$this->init_form_fields();

		$this->init_settings();

		$main_settings_instance = WC_Yandex_Pay_Settings::get_main_settings();

		$this->title       = $main_settings_instance::get_yandex_pay_card_title();
		$this->description = $main_settings_instance::get_yandex_pay_card_description();

		parent::__construct();
	}

	/**
	 * Initializing plugin configuration fields
	 */
	public function init_form_fields() {
		$this->form_fields = include YANDEX_PAY_AND_SPLIT_PLUGIN_DIR .
			'/includes/payment-methods/settings.php';
	}

	/**
	 * Validates the merchant ID field.
	 *
	 * Checks if the merchant ID is provided. Throws an exception and adds an error message if it is empty.
	 *
	 * @param string $key   The field key.
	 * @param string $value The merchant ID value to validate.
	 * @return string The validated merchant ID value.
	 * @throws Exception If the merchant ID is empty.
	 */
	public function validate_merchant_id_field( $key, $value ) {

		if ( empty( $value ) ) {
			$expection = new Exception( __( 'Merchant id should be filled.', 'yandex-pay-and-split' ) );
			WC_Admin_Settings::add_error( $expection->getMessage() );
			throw $expection;
		}

		return $value;
	}

	/**
	 * Validates the API key field.
	 *
	 * Checks if the provided API key is not empty. If it is empty, an error message is added and an exception is thrown.
	 *
	 * @param string $key   The key identifier for the API key field.
	 * @param string $value The value of the API key field to validate.
	 * @return string The validated API key value.
	 * @throws Exception If the API key is empty.
	 */
	public function validate_api_key_field( $key, $value ) {

		if ( empty( $value ) ) {
			$expection = new Exception( __( 'Api key should be filled.', 'yandex-pay-and-split' ) );
			WC_Admin_Settings::add_error( $expection->getMessage() );
			throw $expection;
		}

		return $value;
	}
}
