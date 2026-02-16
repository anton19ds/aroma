<?php
/**
 * Checkout coupon form
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) {
	return;
}

?>
<div class="woocommerce-form-coupon-toggle">
	<?php
	wc_print_notice(
		apply_filters(
			'woocommerce_checkout_coupon_message',
			esc_html__( 'Есть промокод?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Нажмите, чтобы ввести код', 'woocommerce' ) . '</a>'
		),
		'notice'
	);
	?>
</div>

<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

	<p><?php esc_html_e( 'Если у вас есть промокод, введите его ниже.', 'woocommerce' ); ?></p>

	<p class="form-row form-row-first">
		<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Промокод:', 'woocommerce' ); ?></label>
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Код промокода', 'woocommerce' ); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-last">
		<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Применить промокод', 'woocommerce' ); ?>"><?php esc_html_e( 'Применить промокод', 'woocommerce' ); ?></button>
	</p>

	<div class="clear"></div>
</form>
