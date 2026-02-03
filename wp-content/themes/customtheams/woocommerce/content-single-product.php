<style type="text/css">
	.review-container h2 {
		font-weight: 500;
		font-size: 32px;
		color: #4b4931;
		text-align: center;
	}

	.rating-home span {
		font-weight: 400;
		color: #4b4931;
	}

	.rating-home {
		display: flex;
		justify-content: center;
		gap: 5px;
	}

	.review-container {
		border-bottom: 2px solid #e2e2e2;
		margin-bottom: 40px;
		padding-bottom: 30px;
	}

	.rating-home i {
		color: #ffdb28;
	}

	.review-content {
		background: #c16970;
	}

	.home-review-grid {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 10px;
		margin-top: 30px;
	}

	.review-content {
		border-radius: 10px;
		padding: 40px 30px 20px 30px;
		text-align: center;
		color: #fff;
	}

	.revicont-star i {
		color: #ffdb28;
	}

	.review-content h3 {
		font-weight: 600;
		font-size: 16px;
		margin-top: 15px;
		margin-bottom: 15px;
	}

	.review-content p {
		font-size: 14px;
		font-style: italic;
		color: #fff;
		line-height: 20px;
	}

	.review-content h4 {
		font-weight: 600;
		font-size: 15px;
		margin-bottom: 0;
	}


	.common-anchor-link {
		background-color: #a96ca9;
		padding: 5px 15px;
		border-radius: 5px;
		color: #fff;
		font-size: 15px;
		font-weight: 600;
		text-align: center;
		display: block;
		margin: 10px auto auto;
		max-width: 120px;
		width: 100%;
		line-height: 21px;
		margin-top: 30px;
	}

	span.qu {
		position: absolute;
		top: 10px;
		left: 10px;
	}

	.review-content {
		position: relative;
	}

	span.qu svg {
		width: 47px;
		height: fit-content;
		transform: rotate(5deg);
	}

	span.qu svg path {
		fill: #fff;
		opacity: .5;
	}
</style>

<style>
	.rotate {
		display: none;
	}


	@media only screen and (min-width: 700px) and (max-width: 1200px) {
		.rotate {
			height: 100vh;
			display: flex;
			justify-content: center;
			gap: 17px;
			align-items: center;
			flex-direction: column;
			position: fixed;
			background: #fff;
			z-index: 99999999999;
			width: 100%;
			left: 0;
		}

		.rotate figure {
			z-index: 9;
		}

		.rotate figure img {
			width: 60%;
			margin: 0 auto;
			display: flex;
			margin-bottom: 20px;
		}



		.rotate h2 {
			width: 50%;
			margin: 0 auto;
			text-align: center;
			font-size: 22px;
			z-index: 9;
			font-weight: 600;
		}

		.rotate h2 {
			font-size: 35px;
			width: 80%;
			line-height: 45px;
		}

		.closeTab svg {
			width: 20px;
			height: 20px;
			position: absolute;
			top: 30px;
			right: 30px;
		}

		.rotate svg {
			width: 20px;
			height: 20px;
			position: absolute;
			top: 30px;
			right: 30px;
		}

		.rotate.closeTabWhole {
			display: none;
		}
	}


	@media only screen and (min-width: 700px) and (max-width: 950px) {

		.rotate figure img {
			width: 40%;
			margin-bottom: 0px;
		}

		.rotate h2 {
			font-size: 25px;
			width: 50%;
			line-height: 30px;
		}

		.closeTab svg {
			width: 20px;
			height: 20px;
			position: absolute;
			top: 30px;
			right: 30px;
		}

		.rotate svg {
			width: 20px;
			height: 20px;
			position: absolute;
			top: 30px;
			right: 30px;
		}

		.rotate.closeTabWhole {
			display: none;
		}
	}


	@media only screen and (min-width: 800px) and (max-width: 850px) {
		.rotate {
			height: 100vh;
			display: flex;
			justify-content: center;
			gap: 17px;
			align-items: center;
			flex-direction: column;
			position: fixed;
			background: #fff;
			z-index: 99999999999;
			width: 100%;
			left: 0;
		}

		.rotate figure {
			z-index: 9;
		}

		.rotate figure img {
			width: 46%;
			margin: 0 auto;
			display: flex;
			margin-bottom: 0px;
		}



		.rotate h2 {
			width: 50%;
			margin: 0 auto;
			text-align: center;
			font-size: 22px;
			z-index: 9;
			font-weight: 600;
		}

		.rotate h2 {
			font-size: 25px;
			width: 80%;
			line-height: 35px;
		}

		.closeTab svg {
			width: 20px;
			height: 20px;
			position: absolute;
			top: 30px;
			right: 30px;
		}

		.rotate svg {
			width: 20px;
			height: 20px;
			position: absolute;
			top: 30px;
			right: 30px;
		}

		.rotate.closeTabWhole {
			display: none;
		}


	}

	.webMaintain .dropdown-menu {
		top: 226px;
	}

	.webMaintain .navigation li:hover .dropdown-menu.mega-dropdown-menu {
		top: 227px;
	}

	.handle-counter input {
		border-bottom: none;
		display: flex;
		align-items: flex-start;
		height: 38px;
	}

	.handle-counter input:last-child {}

	custom-table-row:last-child {}

	.custom-table-row:nth-child(5) input {
		border: none;
	}

	.handle-counter input {
		border-bottom: 0px solid #ddd !important;
	}


	.advance-search.dnone {
		display: none;
	}

	.advance-search {
		background-color: #ffffff;
		position: absolute;
		width: 100%;
		z-index: 99999999;
		top: 137px;
		padding: 40px 150px;
	}

	.as-header {
		display: flex;
		justify-content: space-between;
		margin-bottom: 40px;
	}

	.as-header h4 {
		padding: 0;
		margin: 0;
		font-size: 24px;
		font-family: 'DIN Pro Cond';
		font-weight: bold;
		line-height: 24px;
	}

	.as-header a {
		all: unset !important;
		font-size: 16px !important;
		font-weight: 700 !important;
		text-decoration: none;
		border-bottom: 1px solid #000 !important;
		padding-bottom: 1px !important;
		font-family: 'DIN Pro Cond' !important;
		cursor: pointer !important;
	}

	.as-prodbox {
		display: flex;
		column-gap: 20px;
		align-items: center;
	}

	.as-img {
		width: 127px;
		height: 127px;
		padding: 10px;
		border-radius: 20px;
		background-color: rgb(248, 247, 247);
	}

	.as-img img {
		width: 100%;
		height: 100%;
		object-fit: contain;
		mix-blend-mode: multiply;
	}

	.as-product-show {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		grid-row-gap: 20px;
	}

	.as-prod {
		font-size: 20px;
		font-family: 'DIN Pro Cond';
		font-weight: bold;
		line-height: 24px;
		color: #000;
	}

	.as-price {
		margin: 5px 0 0;
		padding: 0;
		font-size: 17px;
		color: #646355;
		line-height: 20px;
		font-family: 'DIN Pro';
		font-style: italic;
		font-weight: 400;
	}

	.as-product-show a {
		width: fit-content;
	}
</style>
<!-- <link href="https://fonts.cdnfonts.com/css/avenir-next-lt-pro" rel="stylesheet"> -->
<style>
	span.stk.table_text_normal.mob-hide-detail {
		font-weight: 500;
	}

	.custom-table-col2 .span_col1 {
		grid-template-columns: 26% 23% 30%;
	}

	.custom-table-col1 span b {
		font-weight: 600;
		font-family: 'Avenir Next LT Pro', sans-serif !important;
		font-family: 'Conv_Avenir Next LT Pro Condensed', Sans-Serif !important;
		font-family: 'Avenir Next LT Pro' !important;
		src: url(AvenirNextLTPro-BoldCn.woff2) format('woff2'), url(AvenirNextLTPro-BoldCn.woff) format('woff');
		font-weight: 600 !important;
	}

	.product-disp-form .table_text_normal {
		font-family: 'Avenir Next LT Pro', sans-serif !important;
		font-family: 'Conv_Avenir Next LT Pro Condensed', Sans-Serif !important;
	}

	span.stk.table_text_normal.mob-hide-detail {
		font-weight: 400 !important;
		font-family: 'Avenir Next LT Pro', sans-serif !important;
		font-family: 'Conv_Avenir Next LT Pro Condensed', Sans-Serif !important;
	}

	.custom-table-col2 .span_col1 .span_col2 {
		font-weight: 700 !important;
		font-family: 'Avenir Next LT Pro', sans-serif !important;
		font-family: 'Conv_Avenir Next LT Pro Condensed', Sans-Serif !important;
		font-family: 'Avenir Next LT Pro' !important;
		src: url('AvenirNextLTPro-HeavyCn.woff2') format('woff2'),
			url('AvenirNextLTPro-HeavyCn.woff') format('woff');
		font-weight: 900;
	}

	.shortcutboxprice {
		font-family: 'Avenir Next LT Pro', sans-serif !important;
		font-weight: 400;
	}

	.threeboxInner b {
		font-family: 'Avenir Next LT Pro', sans-serif !important;
		font-weight: 600 !important;
	}

	.MobileShows {
		display: none;
	}

	.desktopShows {
		display: block;
	}

	.custom-table-col2 .span_col1 .span_col2 {
		white-space: nowrap;
	}

	.desktop_only.col-md-2.text-left.padding_left_none.table_text_normal {
		margin-left: 10px;
	}

	.weight-table-wrapper tr td .table_text_bold {
		font-family: 'Avenir Next LT Pro' !important;
		src: url(AvenirNextLTPro-BoldCn.woff2) format('woff2'), url(AvenirNextLTPro-BoldCn.woff) format('woff');
		font-weight: 600 !important;
	}

	.weight-table-wrapper tr td .table_text_normal b {
		font-family: 'Avenir Next LT Pro' !important;
		src: url(AvenirNextLTPro-BoldCn.woff2) format('woff2'), url(AvenirNextLTPro-BoldCn.woff) format('woff');
		font-weight: 600 !important;
	}

	.wvc_wrap h3 {
		font-weight: 400;
		line-height: 28px;
		font-size: 24px;
		font-family: 'Source Sans Pro', sans-serif !important;
		font-style: italic;
	}

	.wvc_wrap h4 {
		font-size: 30px;
		font-weight: 700;
		font-family: 'DIN Pro' !important;
		line-height: 34px;
	}

	.wvc_wrap h3 {
		text-transform: unset;
	}

	.custom-table-col2 .span_col1 {
		grid-template-columns: 26% 30% 30%;
	}

	.wvc_wrap h3 {
		font-family: 'Source Sans Pro', sans-serif !important;
		font-style: italic;
		font-size: 24px;
		line-height: 28px;
	}

	.wvc_wrap h4 {
		font-family: 'DIN Pro' !important;
		font-weight: 700;
		line-height: 34px;
		font-size: 30px;
	}

	.desktop_only.col-md-2.text-left.padding_left_none.table_text_normal {
		margin-left: 0;
	}

	.custom-table-col2 .span_col1 {
		grid-template-columns: 26% 19% 34%;
		gap: 10px;
	}

	.custom-table-col2 .span_col1 {
		gap: 40px;
	}

	.product-disp-form .span_col1 span {
		margin-left: -3px;
	}

	.custom-table-col2 .span_col1 .span_col2 {
		text-align: right;
		display: flex;
		justify-content: flex-end;
	}

	.desktop_only.col-md-2.text-left.padding_left_none.table_text_normal {
		margin-left: -36px;
	}

	.handle-counter {
		align-items: center;
	}

	.header_top_notic_bg {
		text-align: center;
		display: flex;
		justify-content: center;
		color: #fff;
		font-family: 'Source Sans Pro', sans-serif;
		font-weight: 500;
		font-size: 18px;
	}

	.header_top_notic_bg {
		background: #b82989;
	}

	@media only screen and (min-width: 300px) and (max-width: 991px) {
		.breadcrum-banner .gurantee-section-bg {
			min-height: 350px !important;
		}

		.breadcrum-banner .gurantee-content {
			height: 100% !important;
		}

		.MobileShows {
			display: block;
		}

		.desktopShows {
			display: none;
		}

		.custom-table-col2 .span_col1 {
			grid-template-columns: 36% 22% 34%;
		}

		.custom-table-col2 .span_col1 .span_col2 {
			text-align: left !important;
			display: block !important;
			margin-left: 7px;
		}

		.handle-counter input {
			border-bottom: 1px solid #ddd !important;
		}

	}
</style>
<?php
$product_id = get_the_ID();
$product = wc_get_product($product_id);
$mainCategory = $product->category_ids;
$category_id = $mainCategory[0];
$taxonomy = 'product_cat';
$category = get_term_by('id', $category_id, $taxonomy);
global $woocommerce;
?>
<div class="gurantee-section breadcrum-banner bigBannerHeight bannerBtm2Line">


	<div class="gurantee-section-bg" style="background-image: url('<?php the_field('wraper_products') ?>');">
		<div class="gurantee-content">
			<h1><?php the_title() ?></h1>
			<p><?php echo $product->short_description ?></p>
		</div>
	</div>
	<div class="bottom-share-prod-wrap DesktopOnly">
		<span class="share-icon">
			<a href="\<?= $category->slug ?>">
				<i class="fa fa-reply" aria-hidden="true"></i>
			</a>
		</span>
		<span class="span-essential-wrap">
			<span class="span-regular"> <?= $category->name ?> </span>
			<span class="span-bold" style="
    text-transform: uppercase;
">
				<span class="bkwardLine">/</span> <?= $product->name ?> </span>
		</span>
	</div>
	<div class="bottom-share-prod-wrap mobileOnly">
		<span class="share-icon">
			<a href="\<?= $category->slug ?>">
				<i class="fa fa-reply" aria-hidden="true"></i>
			</a>
		</span>
		<span class="span-essential-wrap">
			<span class="span-regular"> <?= $category->name ?> </span>
		</span>
	</div>
</div>
<section class="single-prod-info-sect">
	<div class="container custom-container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-prod-wrapper">
					<div class="single-prod-left-wrap">
						<?php

						if ($product) {
							$image_id = $product->get_image_id();
							if ($image_id) {
								$image_url = wp_get_attachment_image_url($image_id, 'full');
								echo '<img class="product-img" src="' . esc_url($image_url) . '" alt="' . get_the_title() . '">';
							}
						}
						?>
						<h4 class="left-cananga"><?php the_field('extr_field') ?></h4>

						<div class="vegan-wrapper">
							<img src="<?= get_template_directory_uri(); ?>/uploads/plogos/organic_1653302425.png"
								alt="100% Vegan">

							<img src="<?= get_template_directory_uri(); ?>/uploads/plogos/icon-organic_1653302029.png"
								alt="Organic">


							<img src="<?= get_template_directory_uri(); ?>/uploads/plogos/Ethically-Sustainably-Sourced.png"
								alt="Sustainably Sourced">
						</div>

						<div class="refrence-wrapper desktopShows">
							<?php $arrayP = get_field('references')?>
							<h2><?php echo $arrayP['title']?></h2>
							<ul>
								<li>
									<span class="ref-left-li-span"><?php echo $arrayP['cas_number_title']?></span>
									<span class="ref-right-li-span"><?php echo $arrayP['cas_number']?></span>
								</li>


								<li>
									<span class="ref-left-li-span"><?php echo $arrayP['einecs_number_title']?></span>
									<span class="ref-right-li-span"><?php echo $arrayP['einecs_number']?></span>
								</li>

								<li>
									<span class="ref-left-li-span"><?php echo $arrayP['product_code_title']?></span>
									<span class="ref-right-li-span"><?php echo $arrayP['product_code']?></span>
								</li>
								<li>
									<span class="ref-left-li-span"><?php echo $arrayP['inci_name_title']?></span>
									<span class="ref-right-li-span"><?php echo $arrayP['inci_name']?></span>
								</li>
							</ul>
						</div>
						<div class="prod-specification desktopShows">
							<ul>
								<li>
									<div class="prod-top-title"><?php the_field('part_used_title')?></div>
									<div class="prod-bottom-title productLeftTable"><?php the_field('part_used') ?>
									</div>
								</li>

								<li>
									<div class="prod-top-title"><?php the_field('synonyms_title')?></div>
									<div class="prod-bottom-title productLeftTable"><?php the_field('synonyms') ?></div>
								</li>
								<li>
									<div class="prod-top-title"><?php the_field('common_names_title')?></div>
									<div class="prod-bottom-title productLeftTable"><?php the_field('common_names') ?>
									</div>
								</li>
								<li>
									<div class="prod-top-title"><?php the_field('origin_title')?></div>
									<div class="prod-bottom-title productLeftTable"><?php the_field('origin') ?></div>
								</li>
								<li>
									<div class="prod-top-title"><?php the_field('note_classification_title')?></div>
									<div class="prod-bottom-title productLeftTable">
										<?php the_field('note_classification') ?>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="single-prod-right-wrap born_none">
						<form class="product-disp-form" action="#" method="post" id="form-tovar-data">
							<input type="hidden" value="<?= $product->id ?>" name="idProd">
							<?php if ($product->children): ?>
								<?php $i = 1; ?>
								<?php foreach ($product->children as $key => $item): ?>
									<?php
									$productChild = wc_get_product($item);
									?>
									<div class="custom-table-row">
										<div class="custom-table-col1">
											<span class="table_text_normal"><?php echo $productChild->name ?></span>
										</div>
										<div class="custom-table-col2">
											<span class="span_col1">
												<?php if(!empty($productChild->sale_price)):?>
												<span class="stk table_text_normal mob-hide-detail">
													<?php echo $productChild->regular_price; ?> ₽
												</span>

												<span class="span_col2">
													<?php echo $productChild->sale_price; ?> ₽
												</span>
												<?php else:?>

													<span class="stk table_text_normal mob-hide-detail">
													</span>
													<span class="span_col2">
													<?php echo $productChild->regular_price; ?> ₽
												</span>
												<?php endif;?>
												<div
													class="desktop_only col-md-2 text-left padding_left_none table_text_normal">
												</div>

											</span>
											<div class="handle-counter" id="handleCounter<?= $i; ?>" data-min="0" data-max="99"
												data-step="1">
												<button type="button" class="counter-minus btn btn-primary">-</button>
												<input data-name="<?= $productChild->id ?>" name="<?= $productChild->id ?>"
													id="qty-<?= $productChild->id ?>" type="text" class="counter-value allquantity" value="0">
												<button type="button" class="counter-plus btn btn-primary">+</button>
											</div>
										</div>
									</div>
									<?php $i++; ?>
								<?php endforeach; ?>
							<?php endif; ?>
							<div class="prod-cart-wrapper">
								<button type="submit" class="" id="sendAjaxreauest">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart </button>
							</div>
						</form>


						<div class="wwp-wrapper">
							<!-- <ul>
								<li>
									<a href="#" data-toggle="modal" data-target="#myModal">[Wholesale Pricing
										Information]</a>
								</li>
								<li>
									<a href="#" data-toggle="modal" data-target="#myModal3">[Weight to volumetric
										Conversion]</a>
								</li>
								<li>
									<a href="#" data-toggle="modal" data-target="#myModal2">[Packaging Information]</a>
								</li>
							</ul> -->
						</div>

						<div class="refrence-wrapper MobileShows">
							<h2>REFERENCES</h2>
							<ul>
								<!-- <li>
									<span class="ref-left-li-span">CAS Number:</span>
									<span class="ref-right-li-span">94350-09-1 ; 958663-49-5</span>
								</li> -->

<!-- 
								<li>
									<span class="ref-left-li-span">EINECS Number:</span>
									<span class="ref-right-li-span">305-227-1</span>
								</li>

								<li>
									<span class="ref-left-li-span">Product Code:</span>
									<span class="ref-right-li-span">PEO1221</span>
								</li>
								<li>
									<span class="ref-left-li-span">INCI Name:</span>
									<span class="ref-right-li-span">Aquilaria malaccensis Wood Oil</span>
								</li> -->
							</ul>
						</div>

						<div class="prod-specification MobileShows">
							<ul>
								<li>
									<div class="prod-top-title">PART USED</div>
									<div class="prod-bottom-title productLeftTable"> <?php the_field('part_used'); ?>
									</div>
								</li>

								<li>
									<div class="prod-top-title">SYNONYMS</div>
									<div class="prod-bottom-title productLeftTable"><?php the_field('synonyms'); ?>
									</div>
								</li>
								<li>
									<div class="prod-top-title">COMMON NAMES</div>
									<div class="prod-bottom-title productLeftTable"><?php the_field('common_names'); ?>
									</div>
								</li>
								<li>
									<div class="prod-top-title">ORIGIN</div>
									<div class="prod-bottom-title productLeftTable"><?php the_field('origin'); ?></div>
								</li>
								<li>
									<div class="prod-top-title">NOTE CLASSIFICATION</div>
									<div class="prod-bottom-title productLeftTable">
										<?php the_field('note_classification'); ?>
									</div>
								</li>
							</ul>
						</div>
						<div class="reported-wrapper">
							<?php echo $product->description ?>
						</div>

						<div class="document-wrapper">
							<h2>Documents</h2>
							<?php if (get_field("file-1-name")): ?>
								<div class="doc-line">
									<div class="pdf-icon-wrap">
										<i class="far fa-file-pdf mob-hide-detail"></i>
										<b> <b><?php the_field("file-1-name") ?></b></b>
									</div>
									<div class="download-right">
										<form action="<?php the_field("file-1") ?>" method="post">
											<input type="hidden" value="<?php the_field("file-1") ?>" name="downloadfile" />
											<input type="hidden" value="<b> <?php the_field("file-1-name") ?> </b>"
												name="downloadfilename" />
											<button type="submit" class="btn btn-default">
												<i class="fa fa-cloud-download" aria-hidden="true"></i> Download
											</button>
										</form>
									</div>
								</div>
							<?php endif; ?>
							<?php if (get_field("file-2-name")): ?>
								<div class="doc-line">
									<div class="pdf-icon-wrap">
										<i class="far fa-file-pdf mob-hide-detail"></i>
										<b> <b><?php the_field("file-2-name") ?></b></b>
									</div>
									<div class="download-right">
										<form action="<?php the_field("file-2") ?>" method="post">
											<input type="hidden" value="<?php the_field("file-2") ?>" name="downloadfile" />
											<input type="hidden" value="<b> <?php the_field("file-2-name") ?> </b>"
												name="downloadfilename" />
											<button type="submit" class="btn btn-default">
												<i class="fa fa-cloud-download" aria-hidden="true"></i> Download
											</button>
										</form>
									</div>
								</div>
							<?php endif; ?>
							<div class="inner-main boxfetchBatch" style="margin-top: 10px;"></div>
							<div style="clear:both"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-md-12">
				<div class="declaration_wrapper">
					<div class="dec-wrap">
						<div class="dec-left">
							Origin Statement </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
									Nature In Bottle certify that the origin of <strong>Agarwood (Oud) Essential
										Oil</strong> is India. </p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/71"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							Cosmetic Declaration </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Nature In Bottle certify that <strong>Agarwood (Oud) Essential Oil</strong> is
									suitable for cosmetic application and is not included in the list of substances
									prohibited in cosmetic products. Neither does it contain parabens, restricted
									preservatives, colorants or UV filters (Annex II - VI of EU Regulation (EC) No
									1223/2009).</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/6"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							Animal Testing </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Nature In Bottle certify that <strong>Agarwood (Oud) Essential Oil</strong> is
									cruelty-free and free of animal testing.<br />
									Nature In Bottle does not conduct or commission animal testing of any cosmetic
									ingredient, raw material, or formulation of any finished product in the context of
									Cosmetics Regulation (EC) 1223/2009. Additionally, we do not buy any ingredient,
									formulation, or product from any supplier or manufacturer that conducted,
									commissioned, or had been a party to Animal Testing. We also encourages customers
									who manufacture cosmetics and skin care products to avoid animal-tested ingredients
									and offer cruelty-free products to their customers.</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/1"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							Vegan Statement </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Nature In Bottle certify that <strong>Agarwood (Oud) Essential Oil</strong> contain
									no animal ingredients or animal by-products, use no animal ingredients or
									by-products in the manufacturing process, nor does the above product come in contact
									with any animal products during storage and transportation.</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/3"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							TSE/BSE Statement </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Nature In Bottle certify that <strong>Agarwood (Oud) Essential Oil</strong> is free
									of Transmissible Spongiform Encephalopathy (TSE) and Bovine Spongiform
									Encephalopathy (BSE). We further declare that this product is Dioxin Free.</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/9"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							Non-GMO Statement </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Nature In Bottle certify that <strong>Agarwood (Oud) Essential Oil</strong> is
									manufactured without the use of genetically modified organisms and without the use
									of raw materials or processing aids containing or derived from genetically modified
									material. As such, <strong>Agarwood (Oud) Essential Oil</strong> should be
									considered non-Genetically Modified in the context with the directives outlined in
									Regulation (EC) No. 1830/2003 and 1829/2003.<br />
									<br />
									Nature In Bottle also declares that <strong>Agarwood (Oud) Essential Oil</strong>
									has not been:<br />
									1) Exposed to Irradiation<br />
									2) Derived from Sewage Sludge<br />
									3) Treated with Ethyl Oxide
								</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/10"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							Gluten Free Statement </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Nature In Bottle can approve that <strong>Agarwood (Oud) Essential Oil</strong> does
									not contain as an ingredient and is not manufactured on processing equipment that
									comes in contact with gluten or products containing gluten.</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/11"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							Melamine Free Statement </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Nature In Bottle confirm that <strong>Agarwood (Oud) Essential Oil</strong> is free
									of any Melamine and hence should be considered to be Melamine-free.</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/14"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							Nanomaterials Declaration </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Nature In Bottle can approve with reference to <strong>Agarwood (Oud) Essential
										Oil</strong> that no Nanomaterials were added at any stage of the
									manufacturing/production process, in accordance with EU Cosmetics Regulation.</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/16"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							California Proposition 65 Declaration </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Nature In Bottle certify that <strong>Agarwood (Oud) Essential Oil</strong> does not
									contain chemicals that are listed on California&#39;s Safe Drinking Water &amp;
									Toxic Enforcement Act of 1986, also commonly known as Proposition 65 (Prop
									65).<br />
									<br />
									Proposition 65, officially known as the Safe Drinking Water and Toxic Enforcement
									Act of 1986, was enacted as a ballot initiative in November 1986. The proposition
									protects the state&#39;s drinking water sources from being contaminated with
									chemicals known to cause cancer, birth defects or other reproductive harm, and
									requires businesses to inform Californians about exposures to such chemicals.<br />
									Proposition 65 requires the state to maintain and update a list of chemicals known
									to the state to cause cancer or reproductive toxicity.<br />
									<br />
									Download the current Proposition 65 List at:<br />
									<i><a href="https://oehha.ca.gov/proposition-65/proposition-65-list"
											target="_blank">https://oehha.ca.gov/proposition-65/proposition-65-list</a></i>
								</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/8"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							REACH Conformance </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Nature In Bottle declare that <strong>Agarwood (Oud) Essential Oil</strong> is
									compliant with the European Union Regulation (EC) 1907/2006 governing the
									Registration, Evaluation, Authorization and Restriction of Chemicals (REACH) and
									does not contain substances above 0.1% weight of a Substance of Very High Concern
									(SVHC) listed in Annex XIV as of July 16, 2019.<br />
									<br />
									Furthermore, <strong>Agarwood (Oud) Essential Oil</strong> is also compliant with
									the European Union Regulation (EC) 1272/2008 Classification, Labeling and Packaging
									of Substances and Mixtures (CLP Regulation) under entries 28 to 30 of Annex XVII of
									REACH, which prohibits the use of carcinogenic, mutagenic or reprotoxic category 1A
									or 1B substances (CMR category 1A or 1B substances) in products supplied to the
									general public.
								</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/13"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							Natural Criteria Statement </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Based on the ISO 16128-1:2016 (Definitions for ingredients) and ISO 16128-2:2017
									(Criteria for ingredients and products), Nature In Bottle can advise that
									<strong>Agarwood (Oud) Essential Oil</strong> would have a Natural Origin Index of 1
									and therefore, could be considered to come under the definition of a &#39;Natural
									Ingredient&#39;.
								</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/15"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							Residual Solvents </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Based on our knowledge of the production process, raw materials and equipments used,
									there is no potential for any residual solvents to be present in <strong>Agarwood
										(Oud) Essential Oil</strong>.</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/7"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							1,4-Dioxane Statement </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									Nature In Bottle certify that <strong>Agarwood (Oud) Essential Oil</strong> is
									compliant with the Senate Bill S4389B&nbsp;<em>An Act to Amend the Environmental
										Conservation Law, in Relation to Prohibiting Household Cleansing Products,
										Cosmetic Products and Personal Care Products that Contain 1,4-Dioxane</em>,
									which limits the trace concentration of 1,4-dioxane to 1 ppm.</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/41"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
					<div class="dec-wrap">
						<div class="dec-left">
							Statement Against Modern Slavery, Forced Labor and Child Labor </div>
						<div class="dec-right">
							<div class="p-cover">
								<p>
								<p>
									As a global corporation engaged in the procurement and sale of goods
									internationally, Nature In Bottle deplores the presence and persistence of Modern
									Slavery, Forced Labor and Child Labor, and takes seriously its responsibility to
									ensure that Modern Slavery, Forced Labor and Child Labor does not take place in its
									supply chain or in any part of its business.<br />
									<br />
									&quot;Modern Slavery&quot; in this statement refers to slavery, forced or compulsory
									labor, trafficking, servitude, and workers who are imprisoned, indentured, or
									bonded.<br />
									<br />
									&quot;Child Labor&quot; refers to work performed by someone under 15 years of age,
									as set forth in the International Labor Organization (ILO) Minimum Age Convention
									No. 138 (unless local minimum age law stipulates a higher age for work or mandatory
									schooling, in which case the higher age would apply).
								</p>
								</p>
								<a href="https://www.natureinbottle.com/home/downloadDeclarationPDF/516/40"
									target="_blank">
									(Download Declaration)
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="cang_sustain_wrap">
					<h4> Sustainable natural ingredients, backed by science </h4>
				</div>
				<div class="cang_bottom_image_wrap">
					<div class="cang_disp_inner">
						<img src="https://www.natureinbottle.com/upload/overview/Perfect-Chemistry-Essential-Oils_1658941628.jpeg"
							alt="THE PERFECT CHEMISTRY">
						<h3> THE PERFECT CHEMISTRY </h3>
						<p>
							Not all essential oils are created equally. We never knowingly compromise by adding
							synthetics, contaminants, or cheap fillers, or by using unethical production practices.
							Through our rigorous process of selecting suppliers and unwavering commitment to stringent
							quality testing, we guarantee every product we sell is 100% pure and authentic.</p>
					</div>
					<div class="cang_disp_inner">
						<img src="https://www.natureinbottle.com/upload/overview/Organic-Sustainable-Oils.jpeg"
							alt="ORGANIC & SUSTAINABLE">
						<h3> ORGANIC & SUSTAINABLE </h3>
						<p>
							We only offer products that are certified organic, wildcrafted in their natural habitat, or
							grown using organic practices in cases where organic certification is unavailable or
							impractical. We rely on our relationships with the distiller/supplier and knowledge of their
							good practices to ensure that the product is free from pesticides and adulteration.</p>
					</div>
					<div class="cang_disp_inner">
						<img src="https://www.natureinbottle.com/upload/overview/Wholesale-Worldwide-Shipping.jpeg"
							alt="WHOLESALE WORLDWIDE SHIPPING">
						<h3> WHOLESALE WORLDWIDE SHIPPING </h3>
						<p>
							We are a non-MLM company, selling online directly to our customers located in over 220
							countries across the world. Our pricing is always wholesale, for every customer - there is
							no need to sign up or become a member to avail the benefits of our wholesale pricing. We
							also provide hugely subsidised rates for international shipping.</p>
					</div>


				</div>
			</div>


		</div> -->
	</div>
</section>




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


<div class="notification-bar sdiv" style="display: none;">
	<div class="successful">
		<h6>
			<i class="fa fa-check" aria-hidden="true"></i>
			<span class="stext">Выбранные товары добавлены в корзину</span>
		</h6>
	</div>

</div>

<?php get_footer(); ?>