<?php
/**
 *Template Name: Шаблон страниц
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package csproject
 */
?>

<?php
get_header(); ?>

<div class="gurantee-section breadcrum-banner custom-blend-cover">
	
	<div class="gurantee-section-bg"
		style="background-image: url('<?= the_field('wraper')?>');">
		<div class="gurantee-content custom-dp-font">
			<h1>
				<font dir="auto" style="vertical-align: inherit;">
					<font dir="auto" style="vertical-align: inherit;"><?php echo the_title()?></font>
				</font>
			</h1>
			<p>
				<font dir="auto" style="vertical-align: inherit;">
					<font dir="auto" style="vertical-align: inherit;"><?= the_field('description')?></font>
				</font>
			</p>
		</div>
	</div>
	<div class="bottom-share-prod-wrap">
		<span class="share-icon">
			<a href="javascript:void(0);" onclick="goBack();">
				<i class="fa fa-reply" aria-hidden="true"></i>
			</a>
		</span>
		<span class="span-essential-wrap">
			<span class="span-regular">
				<font dir="auto" style="vertical-align: inherit;">
					<font dir="auto" style="vertical-align: inherit;"><?php echo the_title()?></font>
				</font>
			</span>
		</span>
	</div>
</div>
<section class="main-bgd">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
				global $more;
				while (have_posts()):
					the_post();
					$more = 1; // отображаем полностью всё содержимое поста
					//the_title(); // эта функция выводит заголовок
					the_content(); // выводим контент
				endwhile;
				?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
?>