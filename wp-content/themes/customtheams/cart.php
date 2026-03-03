<?php
/**
 * Template Name: Cart
 * Страница корзины с формой купона.
 */
defined( 'ABSPATH' ) || exit;
get_header();

$theme_uri = get_template_directory_uri();
?>
<style>
	/* Banner */
	.breadcrum-banner .gurantee-section-bg { min-height: 350px; }
	.breadcrum-banner .gurantee-content { height: 350px !important; min-height: 350px !important; }

	/* Product detail */
	.product-detail .img-remove-wrapper .prod-img-wrapper img { width: 100px; height: 100px; margin-bottom: 0; }
	.product-detail .img-remove-wrapper .prod-img-wrapper { background: none; }
	.prod-img-wrapper { margin-right: 0; }
	.img-remove-wrapper { display: flex; flex-direction: column; align-items: center; justify-content: center; }
	.prod-title-sub-wgt-offer-wrapper { grid-row-gap: 0; }
	.custom-shopcart-table .product-detail p { margin-bottom: 7px; }

	/* Typography — единая толщина шрифта, пробелы */
	.cart-wrapper {
		font-weight: 400 !important;
	}
	.cart-wrapper .kg-span,
	.cart-wrapper span.prod-offer-wrap .kg-span,
	.cart-wrapper span.prod-offer-wrap,
	.cart-wrapper span.prod-offer-wrap b,
	.cart-wrapper span.prod-incl,
	.cart-wrapper table tbody tr td,
	.cart-wrapper .subtol-wrap,
	.cart-wrapper .total-price,
	.cart-wrapper .nos-span { font-family: 'Avenir Next LT Pro', sans-serif !important; font-weight: 400 !important; }
	.cart-wrapper .woocommerce-remove-coupon {
		font-weight: 400 !important;
		text-decoration: underline;
	}
	.cart-wrapper .prod-incl { white-space: pre; }
	.cart-wrapper .total-row .subtol-wrap span { margin-right: 0.5em; }
	.cart-wrapper .total-row .total-price { margin-left: 0.5em; }
	.cart-wrapper .total-price .amount { margin-left: 0.2em; }
	p.cart_empty_msg { font-size: 18px; color: #6c684a; text-align: center; font-weight: 600; }
	p.free_ship_dis { font-size: 17px; line-height: 26px; }

	/* Buttons */
	.new__buton__remove {
		color: #fff !important;
		background-color: #d9534f;
		border-color: #d9534f;
		padding: 2px 15px 3px;
		border-radius: 2px;
		margin-top: 3px;
		display: block;
		width: fit-content;
		font-size: 15px;
	}

	/* Totals */
	.total-wrapper { height: auto; }
	.total-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; gap: 1em; }
	.total-row:last-child { margin-bottom: 0; }
	td.tot-val-mob-hide { color: #6c684a !important; }

	/* Coupon form */
	.coupon-wrapper { display: flex; flex-wrap: wrap; align-items: center; gap: 20px; margin-top: 20px; }
	.coupon-wrapper .cart-start-btn-wrap { margin-left: auto; }
	.coupon-wrapper .coupon-input-btn,
	.coupon-wrapper .cart-coupon-form-wrap { margin-top: 0; }
	.coupon-input-btn,
	.cart-coupon-form-wrap { display: flex; justify-content: space-between; }
	.coupon-input-btn form,
	.cart-coupon-form { display: flex !important; justify-content: flex-start; gap: 10px; margin-bottom: 0; align-items: center; }
	.cart-coupon-input {
		min-width: 200px;
		padding: 10px 14px;
		font-size: 14px;
		font-family: 'Avenir Next LT Pro', sans-serif;
		border: 1px solid #ccc;
		border-radius: 2px;
		color: #333;
	}
	.cart-coupon-input:focus { outline: none; border-color: #6c684a; }
	.cart-coupon-btn {
		padding: 10px 20px;
		font-size: 14px;
		font-family: 'Avenir Next LT Pro', sans-serif;
		font-weight: 600;
		background: #6c684a;
		color: #fff !important;
		border: none;
		border-radius: 2px;
		cursor: pointer;
		white-space: nowrap;
	}
	.cart-coupon-btn:hover { background: #5a5640; color: #fff !important; }
	.coupon-input-btn form button { width: 184px; }

	@media only screen and (min-width: 300px) and (max-width: 991px) {
		.coupon-wrapper {
			flex-direction: column;
			align-items: stretch;
		}

		.coupon-input-btn form,
		.cart-coupon-form {
			flex-direction: column;
			gap: 10px;
			align-items: stretch;
		}

		.coupon-input-btn,
		.cart-coupon-form-wrap {
			display: block;
		}

		.cart-coupon-input {
			min-width: 0;
			width: 100%;
		}

		.coupon-input-btn form button,
		.cart-coupon-btn {
			width: 100%;
		}

		.coupon-wrapper .coupon-input-btn {
			display: block;
		}

		.coupon-wrapper .cart-coupon-form-wrap {
			order: 0;
		}

		span.tot-val-desk-hide {
			text-shadow: none;
			font-family: 'Avenir Next LT Pro' !important;
			src: url(AvenirNextLTPro-HeavyCn.woff2) format('woff2'), url(AvenirNextLTPro-HeavyCn.woff) format('woff');
			font-weight: 600 !important;
			color: #6c684a;
			text-shadow: none !important;
		}

		.coupon-input-btn {
			grid-row-gap: 20px;
		}

		.table {
			margin-bottom: 5px;
		}

		.coupon-input-btn {
			margin-top: 15px;
		}

		.coupon-input-btn {
			grid-row-gap: 50px;
		}

		.kg-span {
			font-weight: 600 !important;
			font-family: 'Conv_Avenir Next LT Pro Condensed', Sans-Serif !important;
		}

		span.prod-offer-wrap .kg-span { font-family: 'Conv_Avenir Next LT Pro Condensed', Sans-Serif !important; }
	}
</style>
<?php do_action( 'woocommerce_before_cart' ); ?>
<div class="gurantee-section breadcrum-banner shopping-section h-350">
	<div class="gurantee-section-bg"
		style="background-image: url('https://elixir-aroma.ru/wp-content/uploads/2026/02/order-banner.webp">
		<div class="gurantee-content">
			<h1>Корзина</h1>
		</div>
	</div>
</div>
<div class="cart-wrapper">
	<div class="container" id="AppendCartSection">
		<div class="cart-start-btn-wrap">
			<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Продолжить покупки</a>
			<a href="?clear-cart" class="button">
				<i class="fa fa-trash" aria-hidden="true"></i>
				<?php esc_html_e('Очистить корзину', 'woocommerce'); ?>
			</a>
		</div>
		<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
			<?php do_action('woocommerce_before_cart_table'); ?>
			<table class="table custom-shopcart-table">
				<thead>
					<tr>
						<th>Товары</th>
						<th>Цена</th>
						<th>Итого</th>
					</tr>
				</thead>
				<tbody>
					<?php do_action('woocommerce_before_cart_contents'); ?>
					<?php
					foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
						$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
						$valueSize = get_field('size', $product_id);
						$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
						if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
							$product = wc_get_product($_product->id);
							$name_parent = get_cross_sell_parents($_product->id);
							$product_link = get_permalink($name_parent->id);
							$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
							?>
							<tr>
								<td>
									<div class="product-detail">
										<div class="img-remove-wrapper">
											<?php $image_url = wp_get_attachment_image_url(get_post_thumbnail_id($product_id), 'full'); ?>
											<a href="<?= esc_url($product_permalink) ?>" class="prod-img-wrapper"><img
													src="<?= $image_url ?>" alt=""></a>
										</div>
										<div class="prod-title-sub-wgt-offer-wrapper">
											<div class="prod-title-subtitle">
												<a href="<?= $product_link ?>">
													<?= $product_name ?>
												</a>
												<p class="product-heading"><?= $name_parent->name ?> (<?= $product->sku ?>)</p>
											</div>
											<div class="prod-wgt-offer-Wrap">

												<div>
													<?php if ($valueSize): ?>
														<span class="prod-size-wrap">Size:</span>
														<span class="prod-offer-wrap">
															<?= $valueSize ?>
														</span>
													<?php endif; ?>
												</div>
												<?php
												if ($_product->is_sold_individually()) {
													$min_quantity = 1;
													$max_quantity = 1;
												} else {
													$min_quantity = 0;
													$max_quantity = $_product->get_max_purchase_quantity();
												}

												$product_quantity = woocommerce_quantity_input(
													array(
														'input_name' => "cart[{$cart_item_key}][qty]",
														'input_value' => $cart_item['quantity'],
														'max_value' => $max_quantity,
														'min_value' => $min_quantity,
														'product_name' => $product_name,
													),
													$_product,
													false
												);
												?>
												<?php
												echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
													'woocommerce_cart_item_remove_link',
													sprintf(
														'<a href="%s" class="mob-hide new_buton_remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Удалить</a>',
														esc_url(wc_get_cart_remove_url($cart_item_key)),
														/* translators: %s is the product name */
														esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
														esc_attr($product_id),
														esc_attr($_product->get_sku())
													),
													$cart_item_key
												);
												?>
												</a>
											</div>
										</div>
									</div>
								</td>
								<td>
									<div class="flex-height-fix">
										<div class="prod-price-wrapper">
											<span class="nos-span"> Nos. </span>
											<div class="table_col3">
												<div class="handle-counter" id="handleCounter<?= $product_id ?>">
													<button class="counter-minus left-counter-btn"
														onclick="javascript:setQty(<?= $product_id ?>,'remove',<?= $cart_item['quantity'] ?>,'small')">-</button>
													<input value="<?= $cart_item['quantity'] ?>" id="qty<?= $product_id ?>_qa"
														type="text" readonly="readonly" class="qty-value">
													<button class="counter-plus right-counter-btn"
														onclick="javascript:setQty(<?= $product_id ?>,'add',<?= $cart_item['quantity'] ?>,'small')">+</button>
												</div>
												<?php //print_r($cart_item) ?>
											</div>
											<span class="prod-incl"><?php echo esc_html_x( '×', 'quantity times price', 'woocommerce' ); ?> <?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
											?></span>
											<span class="tot-val-desk-hide"><?php echo wp_kses_post( wc_price( $cart_item['line_total'] ) ); ?></span>
										</div>
									</div>
								</td>
								<td class="tot-val-mob-hide" id="priseC<?php echo esc_attr( $product_id ); ?>">
									<?php echo wp_kses_post( wc_price( $cart_item['line_total'] ) ); ?></td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
			<?php do_action('woocommerce_after_cart_table'); ?>
		</form>
		<div class="total-wrapper">
			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<div class="total-row cart-coupon-discount">
					<div class="subtol-wrap"><span><?php wc_cart_totals_coupon_label( $coupon ); ?></span></div>
					<div class="total-price"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
				</div>
			<?php endforeach; ?>
			<div class="total-row">
				<div class="subtol-wrap"><span>Итого</span></div>
				<div class="total-price"><span> <?php echo wp_kses_post( WC()->cart->get_cart_total() ); ?></span></div>
			</div>
		</div>
		<div class="coupon-wrapper">
			<?php if ( wc_coupons_enabled() ) : ?>
				<div class="coupon-input-btn cart-coupon-form-wrap">
					<form class="cart-coupon-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
						<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Промокод:', 'woocommerce' ); ?></label>
						<input type="text" name="coupon_code" class="input-text cart-coupon-input" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Введите промокод', 'woocommerce' ); ?>" />
						<button type="submit" class="button cart-coupon-btn" name="apply_coupon" value="<?php esc_attr_e( 'Применить', 'woocommerce' ); ?>"><?php esc_html_e( 'Применить', 'woocommerce' ); ?></button>
					</form>
				</div>
			<?php endif; ?>
			<div class="coupon-input-btn">
				<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-btn">Оформить заказ</a>
			</div>
			<div class="cart-start-btn-wrap">
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
					<i class="fa fa-arrow-left" aria-hidden="true"></i> Вернуться к покупкам
				</a>
			</div>
		</div>
	</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
<?php get_footer(); ?>


<script>
	function setQty(pid, action, product_variant_id, ptype) {
		event.preventDefault();
		ptype = (ptype && ptype !== '') ? ptype : 'small';
		var inputBoxID = "qty" + pid + "_qa";
		var currQty = (document.getElementById(inputBoxID).value) * 1;
		var bulk;
		var products = [];
		if (action === 'add') {
			bulk = 'woocommerce_bulk_add_to_cart';
			products.push({
				product_id: pid,
				quantity: 1
			});
		} else {
			bulk = 'remove_from_cart_by_product_id';
			var newQty = currQty - 1;
			products.push({
				product_id: pid,
				quantity: newQty
			});
		}
		jQuery.ajax({
			type: 'POST',
			url: wc_add_to_cart_params.ajax_url,
			data: {
				action: bulk,
				products: products
			},
			success: function (response) {
				jQuery.ajax({
					url: '/wp-json/wc/store/v1/cart',
					method: 'GET',
					success: function (cart) {
						jQuery('.total-price .woocommerce-Price-amount.amount').html((cart.totals.total_price / 100).toFixed(2).replace('.', ',') + cart.totals.currency_suffix);
						jQuery.each(cart.items, function (i, item) {
							jQuery('#qty' + item.id + '_qa').val(item.quantity);
							jQuery('#priseC' + item.id).html((item.totals.line_total / 100).toFixed(2).replace('.', ',') + item.totals.currency_suffix);
						});
					}
				});
			},
			error: function () {}
		});
		return false;
	}
</script>