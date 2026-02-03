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
<div class="notification-bar sdiv success" style="display: none;">
	<div class="successful">
		<h6>
			<i class="fa fa-check" aria-hidden="true"></i>
			<span class="stext">Выбранные товары добавлены в корзину</span>
		</h6>
	</div>

</div>
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
				<h1><?php the_title(); ?></h1>
				<p><?php the_field('description_category') ?></p>
			</div>
		</div>
	</div>
	<div class="product-list-container pb-70 ">
		<div class=" container padding-left-right-15">
			<div class="product-list-grid">
				<?php the_content()?>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
	
	<div class="boxquickview">

	</div>
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