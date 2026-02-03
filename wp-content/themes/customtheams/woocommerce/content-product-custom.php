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
		<a class="quick-view" onclick="quickview(<?php echo $product->id?>)">Просмотр</a>
	</div>
</div>