<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.2.0
 */

defined( 'ABSPATH' ) || exit;

$totals = $order->get_order_item_totals(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
?>

<div class="gurantee-section breadcrum-banner shopping-section h-350">
	<div class="gurantee-section-bg" style="background-image: url('https://elixir-aroma.ru/wp-content/uploads/2026/02/order-banner.webp">
		<div class="gurantee-content">
			<h1>Оплата заказа</h1>
		</div>
	</div>
</div>
<section class="main-bgd">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
<form id="order_review" method="post" class="form-pay-order-review">

	<table class="shop_table form-pay-shop-table">
		<thead>
			<tr>
				<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-qty-total"><?php esc_html_e( 'Qty', 'woocommerce' ); ?> / <?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php if ( count( $order->get_items() ) > 0 ) : ?>
				<?php foreach ( $order->get_items() as $item_id => $item ) : ?>
					<?php
					if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
						continue;
					}
					$product = $item->get_product();
					$item_name = $item->get_name();
					$parent_label = '';
					if ( $product && is_callable( 'get_cross_sell_parents' ) ) {
						$parent = get_cross_sell_parents( $product->get_id() );
						if ( $parent && is_a( $parent, 'WC_Product' ) ) {
							$parent_label = esc_html( $parent->get_name() ) . ' — ';
						}
					}
					?>
					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
						<td class="product-name">
							<?php
								echo wp_kses_post( $parent_label . apply_filters( 'woocommerce_order_item_name', $item_name, $item, false ) );

								do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

								wc_display_item_meta( $item );

								do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
							?>
						</td>
						<td class="product-qty-total">
							<strong class="product-quantity"><?php echo sprintf( '&times;&nbsp;%s', esc_html( $item->get_quantity() ) ); ?></strong>
							<span class="form-pay-line-price"><?php echo wp_kses_post( $order->get_formatted_line_subtotal( $item ) ); ?></span>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<?php if ( $totals ) : ?>
				<?php foreach ( $totals as $total ) : ?>
					<tr>
						<th scope="row"><?php echo $total['label']; ?></th><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<td class="product-total"><?php echo $total['value']; ?></td><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tfoot>
	</table>

	<?php
	/**
	 * Triggered from within the checkout/form-pay.php template, immediately before the payment section.
	 *
	 * @since 8.2.0
	 */
	do_action( 'woocommerce_pay_order_before_payment' ); 
	?>

	<div id="payment">
		<?php if ( $order->needs_payment() ) : ?>
			<ul class="wc_payment_methods payment_methods methods">
				<?php
				if ( ! empty( $available_gateways ) ) {
					foreach ( $available_gateways as $gateway ) {
						wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
					}
				} else {
					echo '<li>';
					wc_print_notice( apply_filters( 'woocommerce_no_available_payment_methods_message', esc_html__( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) ), 'notice' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment
					echo '</li>';
				}
				?>
			</ul>
		<?php endif; ?>
		<div class="form-row">
			<input type="hidden" name="woocommerce_pay" value="1" />

			<?php wc_get_template( 'checkout/terms.php' ); ?>

			<?php do_action( 'woocommerce_pay_order_before_submit' ); ?>

			<?php echo apply_filters( 'woocommerce_pay_order_button_html', '<button type="submit" class="button alt' . esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ) . '" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

			<?php do_action( 'woocommerce_pay_order_after_submit' ); ?>

			<?php wp_nonce_field( 'woocommerce-pay', 'woocommerce-pay-nonce' ); ?>
		</div>
	</div>
</form>
</div></div></div></section>
<style>
	#order_review{
		margin-top: 40px;
	}
/* Таблица оплаты заказа: 2 колонки, колонка товара продлена, без отдельного «Итого» в шапке */
.form-pay-order-review .form-pay-shop-table {
	table-layout: fixed;
	width: 100%;
	border-collapse: collapse;
}
.form-pay-order-review .form-pay-shop-table thead th {
	padding: 12px 15px;
	text-align: left;
	border-bottom: 2px solid #ddd;
	font-weight: 600;
}
.form-pay-order-review .form-pay-shop-table .product-name {
	width: 70%;
	min-width: 0;
	padding: 12px 15px;
	border-bottom: 1px solid #eee;
	vertical-align: top;
}
.form-pay-order-review .form-pay-shop-table .product-qty-total {
	width: 100%;
	flex-direction: column;
	padding: 12px 15px;
	text-align: right;
	border-bottom: 1px solid #eee;
	vertical-align: top;
}
.form-pay-order-review .form-pay-shop-table .product-qty-total .product-quantity {
	display: block;
}
.form-pay-order-review .form-pay-shop-table .product-qty-total .form-pay-line-price {
	display: block;
	font-weight: 600;
	margin-top: 4px;
}
.form-pay-order-review .form-pay-shop-table tfoot th {
	padding: 10px 15px;
	text-align: left;
	border-top: 1px solid #eee;
	font-weight: 600;
}
.form-pay-order-review .form-pay-shop-table tfoot td.product-total {
	padding: 10px 15px;
	text-align: right;
	border-top: 1px solid #eee;
}
.form-pay-order-review .form-pay-shop-table tfoot tr:last-child th,
.form-pay-order-review .form-pay-shop-table tfoot tr:last-child td {
	border-top-width: 2px;
	border-top-color: #333;
	font-weight: 700;
}
.wc_payment_method.payment_method_intellectmoney label,
#payment_method_intellectmoney{
	opacity: 0;
	height: 0;
}
.wc_payment_methods.payment_methods.methods li{
	flex-direction: column;
}
.client-section{
	margin-top: 0;
}
</style>