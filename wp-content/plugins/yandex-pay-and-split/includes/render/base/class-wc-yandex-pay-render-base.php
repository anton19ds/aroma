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

namespace YandexPay\Render\Base;

use YandexPay\Assets\WC_Yandex_Pay_Assets;

/**
 * Yandex Pay Render abstract class
 */
abstract class WC_Yandex_Pay_Render_Base {

	/**
	 * Assets
	 *
	 * @var WC_Yandex_Pay_Assets
	 */
	protected $assets;

	/**
	 * WC_Yandex_Pay_Render_Base constructor.
	 *
	 * @param WC_Yandex_Pay_Assets $assets assets instance.
	 */
	public function __construct( $assets ) {
		$this->assets = $assets;
		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ), 10 );
		add_action( 'init', array( $this, 'init_woocommerce_hooks' ) );
	}

	/**
	 * Register render class assets
	 */
	public function register_assets() {
	}

	/**
	 * Init WooCommerce hooks
	 */
	public function init_woocommerce_hooks() {
	}

	/**
	 * Get product object.
	 *
	 * @return WC_Product
	 */
	protected function get_product() {
		global $product;

		if ( ! ( $product instanceof \WC_Product ) ) {
			return wc_get_product( get_the_ID() );
		}

		return $product;
	}

	/**
	 * Checks if the product is purchasable.
	 *
	 * @param WC_Product $product The product object to check.
	 * @return bool True if the product is purchasable; otherwise, false.
	 */
	protected function is_product_is_purchasable( $product ) {
		return ( $product->is_purchasable() || $product->is_type( 'grouped' ) ) && $product->is_in_stock();
	}

	/**
	 * Checks if the product quantity feature exists.
	 *
	 * @param WC_Product $product The product object to check.
	 * @return bool True if the product quantity field exists; otherwise, false.
	 */
	protected function is_product_quantity_exists( $product ) {
		return $this->is_product_is_purchasable( $product ) && ! $product->is_sold_individually();
	}
}
