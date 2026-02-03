<?php
/**
 *Template Name: Contact Us
 *
 */
?>
<?php get_header(); ?>

<div class="gurantee-section breadcrum-banner mobile-margin-ess essent_oilBanner-wrap">
	<div class="gurantee-section-bg"
		style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/photo/Essential-Oils-Organic-NatureInBottle.jpeg');">
		<div class="gurantee-content">
			<h2><?php the_title(); ?></h2>
			<p>
				<?php the_content(); ?>
			</p>
		</div>
	</div>
</div>


<section class="contactus-sect">
	<div class="container">
		<div class="row">
			<div class="col-md-4 contact-leftside">
				<div class="call-box">
					<h4>Позвонить нам:</h4>
					<div class="call-info">
						<b>
							<?php the_field('phone')?>
							<!--<span class="toll-mark">(TOLLFREE)</span>-->
						</b>
					</div>
				</div>

				<div class="email-box">
					<h4>Написать нам:</h4>
					<div class="email-info">
						<b>
							<a href="mailto:<?php the_field('email')?>"><?php the_field('email')?></a>
						</b>
					</div>
				</div>

				<div class="chat-box">
					<h4>Чат с нами:</h4>
					<div class="chat-info">
						<span>
							<img src="<?php echo get_template_directory_uri(); ?>/images/photo/Whatsapp_Icon.png"
								alt="WhatsApp">
							<a href="https://wa.me/18887555274" target="_blank">Message us on Whatsapp</a>
						</span>
					</div>
				</div>


			</div>

			<div class="col-md-8 contact-rightside">

				<div class="alert alert-success d-flex1 align-items-center stext" role="alert" style="display:none;">
				</div>

				
					<div class="row">
						<?php echo do_shortcode('[contact-form-7 id="7f1c604" title="Contact form 1"]'); ?>

					</div>

			</div>

		</div>

		<div class="row">
			<div class="flag-wrapper">

				<div class="flag-card">
					<img src="<?php echo get_template_directory_uri(); ?>/images/photo/united-states.png" alt="">
					<h3>Telegram</h3>
				</div>

				<div class="flag-card">
					<img src="<?php echo get_template_directory_uri(); ?>/images/photo/european-union.png" alt="">
					<h3>Whatsapp</h3>
				</div>


				<div class="flag-card">
					<img src="<?php echo get_template_directory_uri(); ?>/images/photo/india.png" alt="">
					<h3>Email</h3>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();