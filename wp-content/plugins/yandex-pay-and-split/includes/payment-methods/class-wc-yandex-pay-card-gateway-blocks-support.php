<?php
/**
 * Yandex Pay Blocks Support Card Payment Gateway
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

/**
 * WooCommerce Card Payment Gateway blocks support class
 */
final class WC_Yandex_Pay_Card_Gateway_Blocks_Support extends WC_Yandex_Pay_And_Split_Gateway_Blocks_Support {

	/**
	 * Payment method name defined by payment methods extending this class.
	 *
	 * @var string
	 */
	protected $name = 'yandex-pay-and-split-card';

	/**
	 * Provides all the necessary data what going to use on the front-end as an associative array
	 *
	 * @return array
	 */
	public function get_payment_method_data() {
		$this->payment_method_data['title']       = $this->main_settings::get_yandex_pay_card_title();
		$this->payment_method_data['description'] = $this->main_settings::get_yandex_pay_card_description();

		return parent::get_payment_method_data();
	}
}
