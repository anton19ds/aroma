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

namespace YandexPay\Render\Badges;

use YandexPay\Render\Base\WC_Yandex_Pay_Render_Base;
use YandexPay\Settings\WC_Yandex_Pay_Settings;
use YandexPay\Settings\WC_Yandex_Pay_BNPL_Settings;
use YandexPay\Settings\WC_Yandex_Pay_Cashback_Settings;
/**
 * Yandex pay frontend bage part render class
 */
class WC_Yandex_Pay_Badges extends WC_Yandex_Pay_Render_Base {

	/**
	 * Merchant id
	 *
	 * @var string
	 */
	private $merchant_id;
	/**
	 * Is testing environment
	 *
	 * @var bool
	 */
	private $is_testing;
	/**
	 * BNPL settings
	 *
	 * @var WC_Yandex_Pay_BNPL_Settings
	 */
	private $bnpl_settings;
	/**
	 * Cashback settings
	 *
	 * @var WC_Yandex_Pay_Cashback_Settings
	 */
	private $cashback_settings;
	/**
	 * WC_Yandex_Pay_Badges constructor.
	 *
	 * @param WC_Yandex_Pay_Assets $assets Assets instance.
	 */
	public function __construct( $assets ) {
		$this->merchant_id = WC_Yandex_Pay_Settings::get_main_settings()::get_merchant_id();
		if ( ! $this->merchant_id ) {
			return;
		}

		$this->is_testing        = WC_Yandex_Pay_Settings::get_main_settings()::is_test_environment();
		$this->bnpl_settings     = WC_Yandex_Pay_Settings::get_badge_bnpl_settings();
		$this->cashback_settings = WC_Yandex_Pay_Settings::get_badge_cashback_settings();

		parent::__construct( $assets );
	}

	/**
	 * Registers and enqueues necessary assets for the WC Yandex Pay badges.
	 */
	public function register_assets() {
		if ( ! $this->bnpl_settings::is_enabled() && ! $this->cashback_settings::is_enabled() ) {
			return;
		}

		$this->assets->enqueue_sdk_script();
		$this->assets->enqueue_main_style();

		if ( $this->is_testing ) {
			$this->assets->add_inline_script(
				$this->assets::SDK_HANDLE,
				'window.__YAPAY_BADGE_SANDBOX = true;',
				'before'
			);
		}

		if ( ! is_product() ) {
			return;
		}

		$product = $this->get_product();

		if ( $this->is_product_quantity_exists( $product ) ) {
			if ( $product->is_type( 'variable' ) ) {
				$this->assets->enqueue_local_script( 'variable_product_observer' );
			} else {
				$this->assets->enqueue_local_script( 'simple_product_observer' );
			}
		}
	}

	/**
	 * Initializes WooCommerce hooks for rendering badges.
	 *
	 * Adds actions to render BNPL and cashback badges if their respective settings are enabled.
	 */
	public function init_woocommerce_hooks() {
		if ( $this->bnpl_settings::is_enabled() ) {
			add_action( 'yandex_pay_badges', array( $this, 'render_bnpl_badge_tag' ), 15, 1 );
		}
		if ( $this->cashback_settings::is_enabled() ) {
			add_action( 'yandex_pay_badges', array( $this, 'render_cashback_badge_tag' ), 15, 1 );
		}
		add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'render_badges' ), 15 );
		add_action( 'woocommerce_single_product_summary', array( $this, 'render_single_product_badges' ), 15 );
	}

	/**
	 * Renders the Yandex Pay badges on product pages.
	 *
	 * @param string $type The type of badges to render.
	 * @param array  $classes Optional additional CSS classes for the badges container.
	 */
	public function render_badges( $type = 'loop', $classes = array() ) {
		$product = $this->get_product();

		if ( ! has_action( 'yandex_pay_badges' ) || ! $this->is_product_is_purchasable( $product ) ) {
			return;
		}
		$type         = empty( $type ) ? 'loop' : $type;
		$classes_html = empty( $classes ) ? '' : ' ' . implode( ' ', $classes );
		?>
			<div class="yandex-pay-badges<?php echo esc_attr( $classes_html ); ?>">
				<?php do_action( 'yandex_pay_badges', $type ); ?>
			</div>
		<?php
	}

	/**
	 * Renders badges for a single product page.
	 */
	public function render_single_product_badges() {
		$this->render_badges( 'single', array( 'single-product-badges' ) );
	}

	/**
	 * Renders the BNPL badge tag for a product.
	 *
	 * @param string $type The type of badge to render.
	 */
	public function render_bnpl_badge_tag( $type ) {
		$settings = 'loop' === $type
			? $this->bnpl_settings::get_loop_settings()
			: $this->bnpl_settings::get_single_page_settings();
		$this->render_badge_tag( 'bnpl', $settings );
	}

	/**
	 * Renders the Yandex Pay cashback badge tag for a product.
	 *
	 * @param string $type The type of badge to render.
	 */
	public function render_cashback_badge_tag( $type ) {
		$settings = 'loop' === $type
			? $this->cashback_settings::get_loop_settings()
			: $this->cashback_settings::get_single_page_settings();
		$this->render_badge_tag( 'cashback', $settings );
	}

	/**
	 * Renders a Yandex Pay badge tag with specified type and settings.
	 *
	 * @param string $type The type of the badge to render.
	 * @param object $settings The settings object used to determine badge appearance.
	 * @return void Outputs the HTML for the Yandex Pay badge directly to the page.
	 */
	protected function render_badge_tag( $type, $settings ) {
		$product = $this->get_product();

		?>
			<yandex-pay-badge
				type="<?php echo esc_attr( $type ); ?>"
				amount="<?php echo esc_attr( $product->get_price() ); ?>"
				size="<?php echo esc_attr( $settings::get_size() ); ?>"
				variant="<?php echo esc_attr( $settings::get_variant() ); ?>"
				color="<?php echo esc_attr( $settings::get_color() ); ?>"
				align="<?php echo esc_attr( $settings::get_align() ); ?>"
				theme="<?php echo esc_attr( $settings::get_theme() ); ?>"
				merchant-id="<?php echo esc_attr( $this->merchant_id ); ?>"
			></yandex-pay-badge>
		<?php
	}
}
