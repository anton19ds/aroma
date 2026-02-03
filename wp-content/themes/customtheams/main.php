<?php
/**
 *Template Name: Main
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package csproject
 */

?>

<?php get_header(); ?>
<div class="">
	<div class="banner slideshow-container`">
		<?php $group = get_field('galerrymainpage');
		foreach ($group as $key => $value):
			?>
			<?php if (!empty($value)): ?>
				<div class="banner-content mySlides fade-effect">
					<a href="#" target="_blank">
						<img src="<?= $value ?>" alt="" title="" class="desktop-show">
					</a>
					<a href="#" target="_blank">
						<img src="<?= $value ?>" alt="" title="" class="mobile-show">
					</a>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<div class="dots-styling">
		<?php
		$i = 1;
		foreach ($group as $key => $value): ?>
			<?php
			if (!empty($value)): ?>
				<!-- <span class="dot active" onclick="currentSlide($i)"></span> -->
				<?php
				$i++;
			endif; ?>
		<?php endforeach; ?>
	</div>
</div>
<div class="banner-bottom-content">
	<div class="container">
		<div class="heading-part">
			<h2> <?php the_field('maintitle'); ?>
			</h2>
			<p><?php the_field('description_1') ?></p>
		</div>
		<img src="<?= get_template_directory_uri(); ?>/images/about-banner.jpg" class="img-responsive" alt="" title="">
	</div>

</div>

<div class="service-container">
	<div class="service-container-grid">
		<?php
		$args = array(
			'taxonomy' => 'product_cat',
		);
		$terms = get_terms($args);
		?>
		<?php foreach ($terms as $item): ?>
			<div class="service-content">
				<figure>
					<?php
					$image_id = get_term_meta($item->term_id, 'thumbnail_id', true);
					if ($image_id) {
						$image = wp_get_attachment_image_url($image_id, "full");
						echo '<img src="' . $image . '" alt=""	title="">';
					} else {
						echo '<img src="http://127.0.0.1/wp-content/uploads/2025/03/Organic-Essential-Oils-Tile-min.jpeg" alt="" title="">';
					}
					?>
				</figure>
				<div class="service-overlay-content">
					<h2><?= $item->name ?> </h2>
					<p><?= $item->description ?></p>
					<a href="/<?= $item->slug ?>" target="_self">В магазин</a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<div class="gurantee-section">
	<div class="gurantee-section-bg"
		style="background-image: url('<?= get_template_directory_uri(); ?>/uploads/homepage051298aa5168_061220240555181733464518.webp');">
		<div class="gurantee-content">
			<h2>
				<?php the_field('titleonblock') ?>
			</h2>
			<h3>
				<?php the_field('descriptiononblock') ?>
			</h3>
			<div class="gurantee-logo">
				<img src="<?= get_template_directory_uri(); ?>/uploads/PUUREPromis.png" alt="" title="">
				<p>
					<?php the_field('paragrafonblock') ?>
				</p>
			</div>
		</div>
	</div>
</div>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.6/assets/owl.carousel.min.css'>
<link rel='stylesheet'
	href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.6/assets/owl.theme.default.min.css'>


<script>
	var slideIndex = 0;
	showSlides();
	function currentSlide(n) {
		if (n > slides.length) { n = 1 }
		else if (n < 1) { n = slides.length }
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";

		}
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		}
		slides[n - 1].style.display = "block";
		dots[n - 1].className += " active";
	}
	function showSlides() {
		var i;
		slides = document.getElementsByClassName("mySlides");
		dots = document.getElementsByClassName("dot");
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		slideIndex++;
		if (slideIndex > slides.length) { slideIndex = 1 }
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		}
		slides[slideIndex - 1].style.display = "block";
		dots[slideIndex - 1].className += " active";
		setTimeout(showSlides, 2000); // Change image every 8 seconds
	}

</script>
<?php
$args = array(
	'taxonomy' => 'product_cat',
	'hide_empty' => false,
);
$product_categories = get_terms($args);
$count = count($product_categories); ?>
<?php get_footer(); ?>
<?php wp_footer(); ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>