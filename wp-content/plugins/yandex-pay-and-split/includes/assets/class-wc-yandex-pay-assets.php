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

namespace YandexPay\Assets;

use YandexPay\Settings\WC_Yandex_Pay_Settings;

/**
 * Yandex pay assets class
 */
class WC_Yandex_Pay_Assets extends WC_Yandex_Pay_Assets_Base {

	/**
	 * SDK script handle
	 *
	 * @var string
	 */
	public const SDK_HANDLE = 'sdk';

	/**
	 * Main script handle
	 *
	 * @var string
	 */
	public const MAIN_HANDLE = 'main';

	/**
	 * WC_Yandex_Pay_Assets constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->register_script(
			static::SDK_HANDLE,
			'https://pay.yandex.ru/sdk/v1/pay.js',
			array(),
			self::VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'async',
			),
		);
		add_filter( 'script_loader_tag', array( $this, 'dispatch_sdk_event' ), 10, 2 );

		$this->register_local_script(
			static::MAIN_HANDLE,
			'yandex-pay-and-split.yapay.js',
			self::get_sdk_deps(),
			array(
				'in_footer' => true,
			),
		);

		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets_data' ) );

		$this->register_local_style(
			static::MAIN_HANDLE,
			'yandex-pay-and-split.css',
		);
	}

	/**
	 * Get SDK script dependencies
	 *
	 * @return string[]
	 */
	public static function get_sdk_deps() {
		return array( static::get_script_handle( static::SDK_HANDLE ) );
	}

	/**
	 * Get Main script dependencies
	 *
	 * @return string[]
	 */
	public static function get_main_deps() {
		return array( static::get_script_handle( static::MAIN_HANDLE ) );
	}

	/**
	 * Enqueue SDK script
	 */
	public function enqueue_sdk_script() {
		$this->enqueue_script( static::SDK_HANDLE );
	}

	/**
	 * Enqueue Main script
	 */
	public function enqueue_main_script() {
		$this->enqueue_script( static::MAIN_HANDLE );
	}

	/**
	 * Enqueue Main style
	 */
	public function enqueue_main_style() {
		$this->enqueue_style( static::MAIN_HANDLE );
	}

	/**
	 * Add async attribute to sdk script. After load dispatch event
	 *
	 * @param string $tag script tag.
	 * @param string $handle script handle.
	 * @return string
	 */
	public function dispatch_sdk_event( $tag, $handle ) {
		if ( self::get_script_handle( self::SDK_HANDLE ) !== $handle ) {
			return $tag;
		}
		return str_replace( ' src=', ' async onload="window.dispatchEvent(new Event(\'ya_pay_sdk_loaded\'));" src=', $tag );
	}

	/**
	 * Registers asset data for the Yandex Pay script.
	 *
	 * This method adds necessary session settings as script data under the main handle.
	 */
	public function register_assets_data() {
		$this->add_script_data(
			static::MAIN_HANDLE,
			'session_settings',
			array(
				'env'                     => WC_Yandex_Pay_Settings::get_environment(),
				'language'                => WC_Yandex_Pay_Settings::get_language(),
				'merchantId'              => WC_Yandex_Pay_Settings::get_main_settings()::get_merchant_id(),
				'currencyCode'            => WC_Yandex_Pay_Settings::get_currency(),
				'availablePaymentMethods' => WC_Yandex_Pay_Settings::get_available_payment_methods(),
			),
		);
	}
}
