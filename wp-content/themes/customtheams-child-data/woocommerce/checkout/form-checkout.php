<?php
/**
 *Template Name: Checkout
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package csproject
 */

?>
<div class="checkout-tab">
	<div class="container">
		<div id="address" class=" tab_default_2" style="display: block;">
			<div class="form-container">
				<div class="login-form-container" style="display: contents;">

					<div class="text-title all-label">
						<?php
						if (!defined('ABSPATH')) {
							exit;
						}
						do_action('woocommerce_before_checkout_form', $checkout);
						if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
							echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
							return;
						}
						?>
						<form name="checkout" method="post" class="checkout woocommerce-checkout"
							action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data"
							aria-label="<?php echo esc_attr__('Checkout', 'woocommerce'); ?>">
							<?php if ($checkout->get_checkout_fields()): ?>
								<?php do_action('woocommerce_checkout_before_customer_details'); ?>
								<div class="col2-set" id="customer_details">
									<div class="col-12">
										<?php do_action('woocommerce_checkout_billing'); ?>
									</div>
									<div class="col-12">
										<?php do_action('woocommerce_checkout_shipping'); ?>
									</div>
								</div>
								<?php do_action('woocommerce_checkout_after_customer_details'); ?>
							<?php endif; ?>
							<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
							<h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>
							<?php do_action('woocommerce_checkout_before_order_review'); ?>
							<div id="order_review" class="woocommerce-checkout-review-order">
								<?php do_action('woocommerce_checkout_order_review'); ?>
							</div>
							<?php do_action('woocommerce_checkout_after_order_review'); ?>
						</form>
						<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
/* Мобильный вид: выравнивание, отступы, без картинок, общий вид */
@media only screen and (max-width: 991px) {
	/* Блок оплаты — отступы и общий вид */
	#order_review {
		padding: 20px 16px !important;
	}
	#payment {
		margin-top: 24px !important;
		padding-top: 24px !important;
	}
	#payment ul.wc_payment_methods {
		display: block !important;
		padding: 0 !important;
		margin: 0 0 20px !important;
		list-style: none !important;
	}
	#payment ul.wc_payment_methods > li.wc_payment_method {
		display: flex !important;
		flex-wrap: wrap !important;
		align-items: flex-start !important;
		padding: 16px 0 !important;
		margin: 0 !important;
		border-bottom: 1px solid rgba(0, 0, 0, 0.08);
	}
	#payment ul.wc_payment_methods > li.wc_payment_method:last-of-type {
		border-bottom: none !important;
	}
	/* Выравнивание radio и label по центру по вертикали */
	#payment .wc_payment_method input[type="radio"] {
		flex: 0 0 auto !important;
		width: 20px !important;
		height: 20px !important;
		margin: 0 12px 0 0 !important;
		align-self: center !important;
	}
	#payment .wc_payment_method > label {
		display: flex !important;
		align-items: center !important;
		flex: 1 1 auto !important;
		min-width: 0 !important;
		margin: 0 !important;
		padding: 0 !important;
		font-size: 15px !important;
		line-height: 1.3 !important;
	}
	/* Убрать картинку/логотип способа оплаты на мобильном */
	#payment .wc_payment_method > label img {
		display: none !important;
	}
	/* Плашка с описанием — отступы, общий вид */
	#payment div.payment_box {
		flex: 0 0 100% !important;
		width: 100% !important;
		max-width: 100% !important;
		display: block !important;
		margin: 14px 0 0 0 !important;
		margin-left: 0 !important;
		padding: 16px 18px !important;
		background: #e9e6ed !important;
		border-radius: 10px !important;
		border: none !important;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06) !important;
		box-sizing: border-box !important;
	}
	#payment div.payment_box p {
		margin: 0 !important;
		font-size: 14px !important;
	}
	/* Отступы у блока с кнопкой и политикой */
	#payment .place-order {
		padding-top: 24px !important;
		margin-top: 24px !important;
	}
}
</style>