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

namespace YandexPay\Render;

use YandexPay\Render\Badges\WC_Yandex_Pay_Badges;
use YandexPay\Render\Base\WC_Yandex_Pay_Render_Base;
use YandexPay\Render\Payment\WC_Yandex_Pay_Payment;
use YandexPay\Render\Payment\WC_Yandex_Pay_Widgets;

/**
 * Yandex pay frontend render class
 */
class WC_Yandex_Pay_Render extends WC_Yandex_Pay_Render_Base {

	/**
	 * Payment frontend renderer
	 *
	 * @var WC_Yandex_Pay_Payment
	 */
	public $payment;

	/**
	 * Badges frontend renderer
	 *
	 * @var WC_Yandex_Pay_Badges
	 */
	public $badges;

	/**
	 * Widgets frontend renderer
	 *
	 * @var WC_Yandex_Pay_Widgets
	 */
	public $widgets;

	/**
	 * WC_Yandex_Pay_Render constructor.
	 *
	 * @param WC_Yandex_Pay_Assets $assets assets instance.
	 */
	public function __construct( $assets ) {
		$this->payment = new WC_Yandex_Pay_Payment( $assets );
		$this->badges  = new WC_Yandex_Pay_Badges( $assets );
		$this->widgets = new WC_Yandex_Pay_Widgets( $assets );

		parent::__construct( $assets );
	}

	/**
	 * Registers local scripts required for Yandex Pay functionality.
	 */
	public function register_assets() {
		$this->assets->register_local_script(
			'checkout_observer',
			'yandex-pay-and-split-observer.yapay.js',
			array_merge( array( 'jquery' ), $this->assets->get_main_deps() ),
			array(
				'in_footer' => true,
				'strategy'  => 'async',
			),
		);

		if ( ! is_product() ) {
			return;
		}
		$this->assets->register_local_script(
			'simple_product_observer',
			'yandex-pay-and-split-simple-product-observer.yapay.js',
			array_merge( array( 'jquery' ), $this->assets->get_main_deps() ),
			array(
				'in_footer' => true,
				'strategy'  => 'async',
			),
		);
		$this->assets->register_local_script(
			'variable_product_observer',
			'yandex-pay-and-split-variable-product-observer.yapay.js',
			array_merge( array( 'jquery' ), $this->assets->get_main_deps() ),
			array(
				'in_footer' => true,
				'strategy'  => 'async',
			),
		);
		$product_data = $this->get_product_data();
		$this->assets->add_script_data(
			'simple_product_observer',
			'product_data',
			$product_data,
		);
		$this->assets->add_script_data(
			'variable_product_observer',
			'product_data',
			$product_data,
		);
	}

	/**
	 * Initializes WooCommerce hooks for Yandex Pay.
	 */
	public function init_woocommerce_hooks() {
		add_action( 'woocommerce_after_order_notes', array( $this, 'add_checkout_hidden_total_amount_field' ) );
	}

	/**
	 * Adds a hidden input field to the checkout form containing the total amount.
	 *
	 * @param WC_Checkout $checkout The checkout instance.
	 */
	public function add_checkout_hidden_total_amount_field( $checkout ) {
		$total_amount = (string) WC()->cart->get_total( '' );
		?>
		<input type="hidden" class="input-hidden" name="yandex_pay_total_amount" id="yandex-pay-total-amount" value="<?php echo esc_attr( $total_amount ); ?>">
		<?php
	}

	/**
	 * Adds product data for Yandex Pay.
	 *
	 * @return array
	 */
	public function get_product_data() {
		$product = $this->get_product();

		if ( ( ! $product->is_purchasable() && ! $product->is_type( 'grouped' ) ) || ! $product->is_in_stock() ) {
			return null;
		}

		$product_data = array(
			'prices'    => array(
				'default'                   => floatval( $product->get_price() ),
				(string) $product->get_id() => floatval( $product->get_price() ),
			),
			'productId' => (string) $product->get_id(),
		);
		$children     = array();
		switch ( $product->get_type() ) {
			case 'grouped':
				$children = array_map( 'wc_get_product', $product->get_children() );
				break;
			case 'variable':
				$children = $product->get_available_variations( 'object' );
				break;
		}
		foreach ( $children as $child ) {
			$product_data['prices'][ (string) $child->get_id() ] = floatval( $child->get_price() );
		}
		return $product_data;
	}
}
