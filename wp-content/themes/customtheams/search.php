<?php
/**
 *Template Name: Category
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package csproject
 */

?>
<?php get_header(); ?>

<?php
global $more;
while (have_posts()):
	the_post();
	$more = 1;
	?>
	<div class="gurantee-section breadcrum-banner mobile-margin-ess essent_oilBanner-wrap">
		<div class="gurantee-section-bg"
			style="background-image: url('https://www.natureinbottle.com/upload/pages/Essential-Oils-Organic-NatureInBottle.jpeg');">
			<div class="gurantee-content">
				<h1>
                    Результат поиска:<br>
                    <?php the_title(); ?>
                </h1>
			</div>
		</div>
	</div>
	<div class="product-list-container pb-70 ">
		<div class=" container padding-left-right-15">
			<div class="product-list-grid">
		<!-- content-product			 -->
<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit;

global $product;

if (!is_a($product, WC_Product::class) || !$product->is_visible()) {
	return;
}
?>

<div class="product-list-content">
	<figure class="pimg516 boxloader">
		<?php $post_thumbnail_id = $product->get_image_id(); ?>
		<a href="/product/<?= $product->slug?>" target="_blank">
			<img src="<?php echo wp_get_attachment_url($post_thumbnail_id); ?>" alt="" title="AGARWOOD (OUD) ESSENTIAL OIL">
		</a>
	</figure>
	<div class="product-list-name">
		<div>
			<h2>
				<a href="/product/<?= $product->slug?>"><?php echo $product->name ?></a>
			</h2>
			<h3>
				<a href="/product/<?= $product->slug?>" target="_blank"><?php the_field('extr_field')?></a>
			</h3>
		</div>
		<a class="quick-view" onclick="quickview(<?php echo $product->id?>)">Quick View</a>
	</div>
</div>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
	
	<div class="boxquickview">

	</div>
	<script src="https://www.natureinbottle.com/js/handleCounter.js"></script>
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

<!-- Clients Logo end -->
<?php get_footer(); ?>