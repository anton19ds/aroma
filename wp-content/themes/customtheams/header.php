<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php the_title(); ?></title>
	<link href="<?= get_template_directory_uri(); ?>/images/favicon.png" rel="shortcut icon" type="image/png">
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
		(function (m, e, t, r, i, k, a) {
			m[i] = m[i] || function () { (m[i].a = m[i].a || []).push(arguments) };
			m[i].l = 1 * new Date();
			for (var j = 0; j < document.scripts.length; j++) { if (document.scripts[j].src === r) { return; } }
			k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
		})(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js?id=105259964', 'ym');

		ym(105259964, 'init', { ssr: true, webvisor: true, clickmap: true, ecommerce: "dataLayer", accurateTrackBounce: true, trackLinks: true });
	</script>
	<noscript>
		<div><img src="https://mc.yandex.ru/watch/105259964" style="position:absolute; left:-9999px;" alt="" /></div>
	</noscript>
	<!-- /Yandex.Metrika counter -->
	<meta name="yandex-verification" content="008d348ef31a977e" />
	<?php wp_head() ?>
</head>

<body>


	<div class="loaderDiv loader" style="display:none;">
		<div class="dimmer">
			<div class="spinner">
				<div class="rect1"></div>
				<div class="rect2"></div>
				<div class="rect3"></div>
				<div class="rect4"></div>
				<div class="rect5"></div>
			</div>
		</div>
	</div> <!-- Top Bar section start -->

	<input type="hidden" id="totalproduct" value="0" />
	<div class="logo-section ">
		<div class="container">
			<div class="logo-search-account-container">
				<div class="logo-container">
					<a href="<?php echo home_url(); ?>">
						<img src="<?= get_template_directory_uri(); ?>/images/logoSite.png" alt="" title="">
					</a>
				</div>
				<div class="search-section">
					<form role="search" method="get" action="<?php echo home_url('/'); ?>">
						<input type="search" name="s" id="myInput" value="" placeholder="Поиск elixir-aroma.ru">
						<button type="submit">
							<i class="fa fa-search" aria-hidden="true"></i></button>
					</form>
				</div>
				<div class="loginCart-section">
					<div class="login">
						<a href="/my-account/"><img src="<?= get_template_directory_uri(); ?>/images/status.png" alt=""
								title="">Войти</a>
					</div>

					<?php woocommerce_mini_cart(); ?>
				</div>
			</div>
			<div class="mobile-search-3bar">
				<div class="mobileNewSearch">
					<form role="search" method="get" action="<?php echo home_url('/'); ?>">
						<input type="text" name="s" id="myInput" value="" placeholder="Поиск elixir-aroma.ru"><i
							class="fa fa-search" aria-hidden="true"></i>
					</form>
				</div>
				<div class="btn-block-s">
					<button type="button" class="navbar-toggle" data-toggle="collapse"
						data-target="#bs-megadropdown-tabs" onclick="openNav();" aria-expanded="true">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<button type="button" class="navbar-toggle closeToggle" data-toggle="collapse"
						data-target="#bs-megadropdown-tabs" onclick="openNav();" aria-expanded="true">
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="menu-mobile-nav mobile-nav-hide">
		<?php
		$args2 = array_merge([
			'container' => 'div',
			'container_id' => 'top-navigation-primary-mob',
			'container_class' => 'top-navigation-mob',
			'menu_class' => '',
			'echo' => false,
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth' => 10,
			'theme_location' => 'mob_menu',
			'walker' => new My_Walker_Nav_Menu_Mob()
		]);
		echo wp_nav_menu($args2);
		; ?>
	</div>
	<div class="navigation">
		<div class="container">
			<?php
			$args = array_merge([
				'container' => 'div',
				'container_id' => 'top-navigation-primary',
				'container_class' => 'top-navigation',
				'menu_class' => 'menu main-menu menu-depth-0 menu-even',
				'echo' => false,
				'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth' => 10,
				'theme_location' => 'header_menu',
				'walker' => new My_Walker_Nav_Menu()
			], $args);
			echo wp_nav_menu($args);
			; ?>
		</div>
	</div>
	<style>
		.gurantee-content h2 {
			font-family: 'DIN Pro';
			font-size: 36px;
			line-height: 45px;
			font-weight: 700;
		}

		@media only screen and (min-width: 300px) and (max-width: 991px) {
			.home-review-grid {
				grid-template-columns: repeat(1, 1fr);
			}
		}
	</style>
	<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/modal.less">
	<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/com.less">


	<script>
		function openNav() {
			document.getElementsByClassName('menu-mobile-nav').classList.add('show');
		}
		function closeNav() {
			document.getElementsByClassName('menu-mobile-nav').classList.remove('show');
		}
	</script>