<?php
/**
 * Yandex Split Payment Gateway
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

use YandexPay\Settings\WC_Yandex_Pay_Settings;

/**
 * WooCommerce Payment Gateway class
 */
class WC_Gateway_Yandex_Pay_Split extends WC_Gateway_Yandex_Pay_And_Split {

	/**
	 * Yes or no based on whether the Yandex Pay payment method is enabled.
	 *
	 * @var bool
	 */
	public $main_enabled;

	/**
	 * WC_Gateway_Yandex_Pay_Split constructor.
	 */
	public function __construct() {
		$this->id                 = YANDEX_PAY_AND_SPLIT_PLUGIN_SPLIT_GATEWAY_ID;
		$this->has_fields         = false;
		$this->method_title       = __( 'Yandex Split', 'yandex-pay-and-split' );
		$this->method_description = sprintf(
			/* translators: %s: link to Yandex Pay settings page */
			__(
				'All other general settings can be adjusted <a href="%s">in the Yandex Pay and Split Settings</a>.',
				'yandex-pay-and-split'
			),
			admin_url( 'admin.php?page=yandex-pay-settings' )
		);

		$this->init_form_fields();

		$this->init_settings();

		$main_settings = get_option(
			'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings',
			array()
		);

		$this->main_enabled = 'yes' === ( $main_settings['enabled'] ?? 'no' );
		$this->enabled      = $this->get_option( 'enabled' );

		$main_settings_instance = WC_Yandex_Pay_Settings::get_main_settings();

		$this->title       = $main_settings_instance::get_yandex_pay_split_title();
		$this->description = $main_settings_instance::get_yandex_pay_split_description();
		parent::__construct();
	}

	/**
	 * Initializing plugin configuration fields
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title'   => __( 'Enable/Disable', 'yandex-pay-and-split' ),
				'type'    => 'checkbox',
				'label'   => __( 'Enable Yandex Split', 'yandex-pay-and-split' ),
				'default' => 'no',
			),
		);
	}
}
