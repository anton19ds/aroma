123123123
<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
do_action('woocommerce_cart_is_empty');

if (wc_get_page_id('shop') > 0): ?>
	<p class="return-to-shop">
		<a class="button wc-backward<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
			href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
			<?php
			/**
			 * Filter "Return To Shop" text.
			 *
			 * @since 4.6.0
			 * @param string $default_text Default text.
			 */
			echo esc_html(apply_filters('woocommerce_return_to_shop_text', __('Return to shop', 'woocommerce')));
			?>
		</a>
	</p>
<?php endif; ?>


<div class="gurantee-section breadcrum-banner shopping-section h-350">
	<div class="gurantee-section-bg"
		style="background-image: url('https://www.natureinbottle.com/images/order-banner.jpg');">
		<div class="gurantee-content">
			<h1>Shopping Cart</h1>
			<p>Items currently in your shopping cart</p>
		</div>
	</div>
</div>

<div class="cart-wrapper">
	<div class="container" id="AppendCartSection">
		<div class="cart-start-btn-wrap">
			<a href="/">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Continue Shopping </a>
		</div>
		<hr />
		<p class="cart_empty_msg">YOUR CART IS EMPTY</p>
	</div>
</div>
<script type="text/javascript">
	function validate_coupon() {
		var coupon_box = $('#coupon_box').val();
		if (coupon_box == '') {
			alert('Please Provide Coupon Code');
			return false;
		}
	}
</script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.6/assets/owl.carousel.min.css'>
<link rel='stylesheet'
	href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.6/assets/owl.theme.default.min.css'>
<style>
	.review-content p {
		font-weight: 400;
	}

	.rating-home span {
		font-size: 15px;
	}

	.common-anchor-link:hover {
		color: #fff;
	}

	.owl-carousel .owl-stage {
		display: flex;
	}

	.owl-carousel .owl-item {
		display: flex;
		flex: 1 0 auto;
	}

	.owl-carousel .thumbnail {
		display: flex;
		flex-direction: column;
		margin: 0 15px;
	}

	.owl-carousel .thumbnail .caption {
		display: flex;
		flex: 1 0 auto;
		flex-direction: column;
	}

	.owl-carousel .thumbnail .caption .flex-text {
		flex-grow: 1;
	}

	.owl-dots {
		display: none !important;
	}

	.successful h6 {
		< !--justify-content: center;
		-->< !--align-items: center;
		-->width: 90%;
	}

	@media (min-width: 768px) {
		.successful h6 {
			font-size: 17px !important;
			line-height: 53px !important;
			display: flex;
		}

	}

	@media (max-width: 767px) {
		.successful h6 {
			font-size: 14px !important;
			line-height: 19px !important;
			padding: 10px 22px 10px 10px;
		}

		.successful h6 .fa,
		.failed h6 .fa {
			display: none;
		}

		.successful,
		.failed {
			height: auto !important;
		}

		.failed {
			display: block;
		}

		.failed h6 {
			font-size: 14px !important;
			line-height: 19px !important;
			padding: 1px 22px 10px 10px;
		}
	}
</style>