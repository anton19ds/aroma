<?php
/**
 *Template Name: Checkout
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package csproject
 */

 global $woocommerce;

if (!$woocommerce || !$woocommerce->checkout) {
    error_log('WooCommerce checkout не доступен');
    return;
}

$checkout = $woocommerce->checkout;
?>

<?php get_header();?>
<div class="checkout-tab">
	<div class="container">
		<div id="address" class=" tab_default_2" style="display: block;">
			<div class="form-container">
				<div class="login-form-container" style="display: contents;">

					<div class="col-md-12 col-sm-12 col-xs-12 text-title all-label">
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
<style>/* ===== ОСНОВНЫЕ СТИЛИ ФОРМЫ ===== */
.checkout-tab{margin:30px 0 40px 0}.container{max-width:1200px;margin:0 auto;padding:0 20px}.tab_default_2{background:#fff;border:1px solid #e0e0e0;padding:0}.woocommerce-billing-fields h3,.woocommerce-additional-fields h3,#order_review_heading{font-size:18px;font-weight:600;color:#000;margin:0 0 20px;padding:0 0 10px;border-bottom:2px solid #000;text-transform:uppercase;letter-spacing:.5px;font-family:Arial,sans-serif}#order_review_heading{margin-top:40px}.form-row{margin:0 0 20px;padding:0}.form-row label{display:block;font-size:13px;font-weight:600;color:#333;margin:0 0 8px;text-transform:uppercase;letter-spacing:.3px;font-family:Arial,sans-serif}.form-row label .optional{font-weight:400;color:#666;text-transform:none;font-size:12px}.form-row .required{color:red;text-decoration:none;font-weight:700}.woocommerce-input-wrapper{display:block;width:100%}.input-text,textarea,select{width:100%;padding:12px 15px;font-size:14px;color:#000;background:#fff;border:1px solid #ccc;border-radius:0;font-family:Arial,sans-serif;box-sizing:border-box;transition:all .2s ease}.input-text:focus,textarea:focus,select:focus{outline:none;border-color:#000;box-shadow:0 0 0 1px #000}.input-text::placeholder,textarea::placeholder{color:#999;font-style:italic;font-size:13px}.select2-container--default .select2-selection--single{border:1px solid #ccc;border-radius:0;height:42px;padding:0;background:#fff}.select2-container--default .select2-selection--single .select2-selection__rendered{color:#000;line-height:40px;padding:0 15px;font-size:14px;font-family:Arial,sans-serif}.select2-container--default .select2-selection--single .select2-selection__arrow{height:40px;right:10px}.select2-container--default.select2-container--open .select2-selection--single{border-color:#000}.select2-container--default .select2-dropdown{border:1px solid #ccc;border-radius:0;border-top:none}.select2-results__option{padding:8px 15px;font-size:14px;font-family:Arial,sans-serif}.select2-container--default .select2-results__option--highlighted[aria-selected]{background:#000;color:#fff}.col2-set{display:flex;flex-wrap:wrap;margin:0 -15px}.col-12{flex:0 0 100%;max-width:100%;padding:0 15px;box-sizing:border-box}.form-row-first,.form-row-last{width:48%;float:left}.form-row-first{margin-right:4%}.form-row-last{float:right;margin-right:0}.form-row-wide{width:100%;clear:both}.woocommerce-shipping-fields h3{font-size:18px;font-weight:600;color:#000;margin:0 0 15px;text-transform:uppercase;letter-spacing:.5px;font-family:Arial,sans-serif}#ship-to-different-address{margin:0 0 25px}#ship-to-different-address label{font-size:14px;font-weight:600;color:#000;cursor:pointer}#ship-to-different-address input[type=checkbox]{margin-right:10px}#order_review{background:#fff;border:1px solid #e0e0e0;padding:30px;margin-top:20px}.shop_table.woocommerce-checkout-review-order-table{width:100%;border-collapse:collapse;margin:0 0 30px;font-size:14px}.shop_table th{padding:12px 15px;font-weight:600;color:#000;text-align:left;border-bottom:2px solid #000;text-transform:uppercase;letter-spacing:.5px;font-family:Arial,sans-serif;background:#fff}.shop_table td{padding:12px 15px;color:#333;border-bottom:1px solid #e0e0e0;vertical-align:top;background:#fff}.shop_table tfoot tr:last-child th,.shop_table tfoot tr:last-child td{border-bottom:2px solid #000;font-weight:700;color:#000}.cart-subtotal th,.cart-subtotal td{font-weight:600}.order-total th{font-size:16px}.order-total td{font-size:18px;font-weight:700}.woocommerce-Price-amount{font-weight:600;color:#000}#payment{margin-top:30px;padding-top:30px;border-top:2px solid #000}.wc_payment_methods{list-style:none;margin:0 0 20px;padding:0}.wc_payment_method{margin:0 0 15px;padding:0}.wc_payment_method label{font-size:15px;font-weight:600;color:#000;cursor:pointer;display:flex;align-items:center;margin:0 0 5px}.wc_payment_method input[type=radio]{margin-right:10px}.payment_box{background:#f8f8f8;border:1px solid #e0e0e0;padding:15px;margin:10px 0 0;font-size:13px;color:#333;line-height:1.5;font-family:Arial,sans-serif}.payment_box p:last-child{margin-bottom:0}.woocommerce-terms-and-conditions-wrapper{margin:0 0 25px;padding:20px;background:#f8f8f8;border:1px solid #e0e0e0}.woocommerce-privacy-policy-text{font-size:13px;color:#333;line-height:1.5;margin:0 0 15px;font-family:Arial,sans-serif}.woocommerce-terms-and-conditions-link,.woocommerce-privacy-policy-link{color:#000;text-decoration:underline;font-weight:600}.woocommerce-form__label-for-checkbox{font-size:14px;color:#333;display:flex;align-items:flex-start;cursor:pointer;font-family:Arial,sans-serif}.woocommerce-form__label-for-checkbox input[type=checkbox]{margin-right:10px;margin-top:3px}.woocommerce-terms-and-conditions-checkbox-text{line-height:1.4}.place-order{text-align:center;margin-top:30px;padding-top:30px;border-top:2px solid #000}.button.alt{display:inline-block;padding:15px 40px;background:#000;color:#fff;border:2px solid #000;font-size:16px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;cursor:pointer;transition:all .2s ease;font-family:Arial,sans-serif;text-decoration:none;min-width:200px}.button.alt:hover{background:#fff;color:#000;text-decoration:none}.woocommerce-info,.woocommerce-notice{background:#f8f8f8;border:1px solid #e0e0e0;padding:15px;margin:0 0 20px;font-size:13px;color:#333;line-height:1.5;font-family:Arial,sans-serif}.woocommerce-info:before,.woocommerce-notice:before{content:"ℹ️";margin-right:10px}.clear{clear:both}.product-name{width:100%}.woocommerce-terms-and-conditions-checkbox-text{margin-left:15px}.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox{display:flex;flex-direction:row;align-items:center}.woocommerce-invalid #terms{outline:none;margin:0;box-shadow:none;width:20px;position:relative}@media only screen and (max-width:768px){.col2-set{margin:0}.col-12{padding:0;margin-bottom:30px}.form-row-first,.form-row-last{width:100%;float:none;margin-right:0;margin-bottom:15px}#order_review{padding:20px}.shop_table th,.shop_table td{padding:10px;font-size:13px}.button.alt{width:100%;padding:15px 20px}.woocommerce-terms-and-conditions-wrapper{padding:15px}.form-row label{font-size:12px;margin-bottom:5px}.form-row label .optional{font-size:11px}}@media only screen and (max-width:480px){.woocommerce-form__input.woocommerce-form__input-checkbox.input-checkbox{position:relative;width:20px;margin:0}.wc_payment_method.payment_method_intellectmoney,.wc_payment_method.payment_method_bacs{display:block!important}.container{padding:0}.tab_default_2{border:none;border-top:1px solid #e0e0e0;border-bottom:1px solid #e0e0e0}.woocommerce-billing-fields h3,.woocommerce-additional-fields h3,#order_review_heading{font-size:16px}.input-text,textarea,select{padding:10px 12px;font-size:13px}.shop_table{display:block;overflow-x:auto}.wc_payment_method label{font-size:14px;align-items:flex-start}.woocommerce-form__label-for-checkbox{font-size:13px}.place-order{padding-top:20px;margin-top:20px}}@media only screen and (prefers-color-scheme:dark){.tab_default_2,#order_review,.payment_box,.woocommerce-terms-and-conditions-wrapper,.woocommerce-info,.woocommerce-notice{background:#fff;border-color:#ccc}.woocommerce-billing-fields h3,.woocommerce-additional-fields h3,#order_review_heading,.shop_table th,.shop_table tfoot tr:last-child th,.wc_payment_method label,.button.alt{color:#000;border-color:#000}.input-text,textarea,select,.select2-container--default .select2-selection--single{background:#fff;border-color:#ccc;color:#000}.input-text:focus,textarea:focus,select:focus{border-color:#000}.shop_table td,.payment_box,.woocommerce-privacy-policy-text,.woocommerce-form__label-for-checkbox,.woocommerce-terms-and-conditions-checkbox-text{color:#333}.button.alt{background:#000;color:#fff}.button.alt:hover{background:#fff;color:#000}}
</style>
<?php get_footer();?>