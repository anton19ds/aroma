<div class="client-section">
	<div class="container">
		<div class="client-logo">
			<?php $pdata = get_field('sertifikats', 126);
			foreach($pdata as $item):?>
			<?php if(!empty($item['img']) && !empty($item['file']))?>
			<figure class=" ">
				<a href="<?php echo $item['file']?>" target="_blank">
					<img src="<?php echo $item['img']?>"
						class="img-responsive" alt="">
				</a>
			</figure>
			<?php endforeach;?>
		</div>
	</div>
</div>
<style>
	.notification-bar {
		-webkit-animation-duration: 1s;
		-moz-animation-duration: 1s;
		-o-animation-duration: 1s;
		animation-duration: 1s;
		-webkit-animation-fill-mode: both;
		-moz-animation-fill-mode: both;
		-o-animation-fill-mode: both;
		animation-fill-mode: both;
		-webkit-animation-name: slideOutUp;
		animation-name: slideOutUp;
		position: fixed;
		z-index: 10000000;
		top: 0;
		width: 100%;
	}

	.successful {
		background: #4caf50;
		position: relative;
		height: 60px;
	}

	.successful h6 {
		font-size: 18px;
		font-weight: normal;
		color: #fff;
		margin: 0px;
		line-height: 60px
	}

	.successful h6 .fa {
		padding-right: 10px;
		font-size: 22px;
		float: left;
		background: #388E3C;
		padding: 5px;
		line-height: 50px;
		width: 65px;
		text-align: center;
		margin-right: 20px;
	}

	.failed {
		background: #ef3c4c;
		position: relative;
		height: 60px;
	}

	.failed h6 {
		font-size: 18px;
		font-weight: normal;
		color: #fff;
		margin: 0px;
		line-height: 60px
	}

	.failed h6 .fa {
		padding-right: 10px;
		font-size: 22px;
		float: left;
		background: #d64351;
		padding: 5px;
		line-height: 50px;
		width: 65px;
		text-align: center;
		margin-right: 20px;
	}

	.notification-bar.error {
		-webkit-animation-duration: 1s;
		-moz-animation-duration: 1s;
		-o-animation-duration: 1s;
		animation-duration: 1s;
		-webkit-animation-fill-mode: both;
		-moz-animation-fill-mode: both;
		-o-animation-fill-mode: both;
		animation-fill-mode: both;
		-webkit-animation-name: slideInDown;
		animation-name: slideInDown;
		z-index: 100000;
		background: rgba(255, 87, 107, .95);
		top: 0px !important;
	}

	.notification-bar {
		-webkit-animation-duration: 1s;
		-moz-animation-duration: 1s;
		-o-animation-duration: 1s;
		animation-duration: 1s;
		-webkit-animation-fill-mode: both;
		-moz-animation-fill-mode: both;
		-o-animation-fill-mode: both;
		animation-fill-mode: both;
		-webkit-animation-name: slideOutUp;
		animation-name: slideOutUp;
		position: fixed;
		z-index: 10000;
		padding: 0.5em .5em .5em .5em;
		color: white;
		width: 100%;
		color: #fff;
	}

	.error {
		border: 2px solid #ff576b;

	}

	.successful .cross,
	.failed .cross {
		position: absolute;
		right: 2%;
		top: 30%;
	}

	/* Footer: wholesale price request form */
	.footer-wholesale {
		max-width: 420px;
	}
	.footer-wholesale form {
		display: flex;
		gap: 10px;
		align-items: center;
		flex-wrap: nowrap;
	}
	.footer-wholesale input[type="email"] {
		flex: 1 1 auto;
		min-width: 0;
		height: 40px;
		padding: 0 12px;
		border: 1px solid #d5d5d5;
		border-radius: 2px;
		font-size: 14px;
	}
	.footer-wholesale button {
		flex: 0 0 auto;
		height: 40px;
		padding: 0 18px;
		border: 1px solid #6c684a;
		background: #6c684a;
		color: #fff;
		border-radius: 2px;
		cursor: pointer;
		white-space: nowrap;
	}
	.footer-wholesale button:hover {
		background: #5a5640;
		border-color: #5a5640;
	}
	.footer-wholesale .footer-wholesale-hint {
		margin-top: 10px;
		font-size: 13px;
		color: #666;
		line-height: 1.4;
	}
	.footer-wholesale .footer-wholesale-msg {
		margin-top: 10px;
		font-size: 13px;
		line-height: 1.4;
	}
	.footer-wholesale .footer-wholesale-msg--success { color: #2e7d32; }
	.footer-wholesale .footer-wholesale-msg--error { color: #c62828; }
</style>
<footer>
	<div class="container">
		<?php $group = get_field('footer_block', 126) ?>
		<div class="certificate-grid">
			<div class="certificate-content pink-color">
				<figure>
					<img src="<?= get_template_directory_uri(); ?>/uploads/images/2.webp"
						alt="" title="" />
				</figure>
				<div class="contentRightCertify">
					<h2>
						<a href="<?= (isset($group['left_block']['link_left_block']['url']) ? $group['left_block']['link_left_block']['url'] : '')  ?>" target="_blank"
							class="foot-Click">
							<?= $group['left_block']['title_left_block'] ?>
						</a>
					</h2>
					<p>
						<?= $group['left_block']['text_left_block'] ?>
					</p>
					<a href="<?= (isset($group['left_block']['link_left_block']['url']) ? $group['left_block']['link_left_block']['url'] : '')  ?>" target="_blank" class="" style="">
						<?= (isset($group['left_block']['link_left_block']['title']) ? $group['left_block']['link_left_block']['title'] : '') ?>
					</a>
				</div>
			</div>
			<div class="certificate-content orange-color">
				<figure>
					<img src="<?= get_template_directory_uri(); ?>/uploads/images/1.webp"
						alt="" title="" />
				</figure>
				<div class="contentRightCertify">
					<h2>
						<a href="<?= isset($group['right_block']['link_right_block']['url']) ? $group['right_block']['link_right_block']['url'] : ''; ?>" target="_blank"
							class="foot-Click">
							<?= $group['right_block']['title_right_block'] ?>
						</a>
					</h2>
					<p>
						<?= $group['right_block']['text_right_block'] ?>
					</p>
					<a href="<?= isset($group['right_block']['link_right_block']['url']) ? $group['right_block']['link_right_block']['url'] : ''; ?>" target="_blank" class="" style="">
						<?= isset($group['right_block']['link_right_block']['title']) ? $group['right_block']['link_right_block']['title'] : ''; ?>
					</a>
				</div>
			</div>

		</div>
		<div class="contact-details">
			<div class="footer-wholesale" id="wholesale-price-request">
				<h2>ОПТОВЫЙ ПРАЙС</h2>
				<form id="wholesale-price-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
					<input type="hidden" name="action" value="customtheams_wholesale_price_request" />
					<?php echo wp_kses_post( wp_nonce_field( 'customtheams_wholesale_price_request', '_wpnonce', true, false ) ); ?>
					<input type="email" name="email" placeholder="Введите Email" required />
					<button type="submit" id="wholesale-price-submit">Запросить</button>
				</form>
				<p class="footer-wholesale-hint">Отправим прайс-лист на вашу почту. Менеджер может уточнить детали по email.</p>
				<div id="wholesale-form-msg" class="footer-wholesale-msg" aria-live="polite" style="display: none;"></div>
			</div>
			<script>
			(function() {
				var form = document.getElementById('wholesale-price-form');
				var msgEl = document.getElementById('wholesale-form-msg');
				var submitBtn = document.getElementById('wholesale-price-submit');
				if (!form || !msgEl) return;
				form.addEventListener('submit', function(e) {
					e.preventDefault();
					var email = form.querySelector('input[name="email"]');
					if (!email || !email.value.trim()) return;
					msgEl.style.display = 'none';
					msgEl.className = 'footer-wholesale-msg';
					msgEl.textContent = '';
					submitBtn.disabled = true;
					var body = new FormData(form);
					fetch(form.action, {
						method: 'POST',
						body: body,
						credentials: 'same-origin'
					})
					.then(function(r) { return r.json(); })
					.then(function(data) {
						if (data.success && data.data && data.data.message) {
							msgEl.textContent = data.data.message;
							msgEl.className = 'footer-wholesale-msg footer-wholesale-msg--success';
							form.reset();
						} else {
							msgEl.textContent = (data.data && data.data.message) ? data.data.message : 'Не удалось отправить запрос. Попробуйте ещё раз.';
							msgEl.className = 'footer-wholesale-msg footer-wholesale-msg--error';
						}
						msgEl.style.display = 'block';
					})
					.catch(function() {
						msgEl.textContent = 'Ошибка сети. Попробуйте ещё раз.';
						msgEl.className = 'footer-wholesale-msg footer-wholesale-msg--error';
						msgEl.style.display = 'block';
					})
					.finally(function() { submitBtn.disabled = false; });
				});
			})();
			</script>
			<div class="home-contact-us">
				<h2><?php echo get_field('title_contact_us', 126)?></h2>
				<div class="">
					<?php echo get_field('contact_footer', 126) ?>
				</div>
			</div>
			<div class="footer-world">
				<h2><?php echo get_field('worldwide_shipping', 126)?></h2>
				<img src="<?php echo get_template_directory_uri(); ?>/images/photo/map.png" alt="" title="">
				<h3><?php echo get_field('text_after_map', 126)?></h3>
				
			</div>
		</div>
		<div class="prd-cate-abt">
			<div class="product-category">
				<div class="product-cate-image">
					<img src="<?php echo get_template_directory_uri(); ?>/images/photo/puure-promise.png" alt="" title="">
				</div>
				<div class="product-cate-cnt">
					<h2>Категории продуктов</h2>
					<div class="product-cate-cnt-ul">
						<ul class=" ">
							<?php
							$args = array(
								'taxonomy' => 'product_cat',
							);
							$terms = get_terms($args);
							?>
							<?php foreach ($terms as $item): ?>
								<li>
									<a href="/<?php echo $item->slug ?>" style="text-transform: uppercase;"
										target="_self"><?php echo $item->name ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="product-cate-abt">
				<div>
					<h2>О нас</h2>
					<?php
					 $args3 = array_merge([
					 	'container' => 'ul',
					 	'container_id' => 'top-navigation-primary-mob',
					 	'container_class' => 'top-navigation-mob',
					 	'menu_class' => '',
					 	'echo' => false,
					 	'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					 	'depth' => 10,
					 	'theme_location' => 'footer_menu',
					 	'walker' => new My_Walker_Nav_Menu_Footer()
					 ]);
					 echo wp_nav_menu($args3);
					 ; ?>

				</div>
				<div class="mobile-footer-flex">
					<img src="<?php echo get_template_directory_uri(); ?>/images/photo/90-days.png" alt="" title="">
					<img src="<?php echo get_template_directory_uri(); ?>/images/photo/puure-promise.png" alt="" title=""
						class="mobile-show">
				</div>
			</div>
		</div>


		<div class="footer-para">
			<p><?php echo get_field('disclaimer', 126) ?></p>
		</div>
		<div class="copyright">
			<div class="" style="width: 100%;">
				<div class="copyright-middle">
					<p>ИП ПОПРАВКА АНДРЕЙ ГЕННАДИЕВИЧ <br> ИНН: 390517799836 ОГРНИП: 319392600042620</p>
				</div>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
<style>
	#myModal5 {
		background: #0000008c;
	}
</style>
<script>
	//jQuery(document).ready(function ($) {
	function quickview(pid) {
		jQuery(".boxquickview").html('<center style="position: fixed;top: 0;background: #9b9191a3;width: 100%;height: 1500px;"><img src="<?php echo get_template_directory_uri(); ?>/images/photo/loader.gif" style="width: 45px;margin-top: 20%;" /></center>');
		var pid = pid;
		if (pid == '' || pid == undefined || pid == '0') {
			return false;
		}

		jQuery.ajax({
			type: "POST",
			url: "/ajax-custom-page/",
			data: {
				pid: pid,
				data: "view"
			},
			success: function (data) {
				//alert(data);								
				jQuery(".boxquickview").html(data);
				jQuery("body").addClass("modal-open").css({
					"position": "relative",
					"min-height": "100%",
					"top": "0px",
					"padding-right": "15px",
				});
				jQuery('.handle-counter').each(function () {
					const $counter = jQuery(this);
					const $value = $counter.find('.counter-value');
					const $plusBtn = $counter.find('.counter-plus');
					const $minusBtn = $counter.find('.counter-minus');
					// Получаем настройки из data-атрибутов или используем значения по умолчанию
					const min = parseInt($counter.data('min')) || 0;
					const max = parseInt($counter.data('max')) || Infinity;
					const step = parseInt($counter.data('step')) || 1;
					let currentValue = 0;
					// Обновляем отображаемое значение
					function updateValue() {
						$value.val(currentValue);
					}
					// Обработчик для кнопки "+"
					$plusBtn.on("click", function () {
						console.log(currentValue);
						if (currentValue + step <= max) {
							currentValue += step;
							updateValue();
						}
					});
					// Обработчик для кнопки "-"
					$minusBtn.on("click", function () {
						if (currentValue - step >= min) {
							currentValue -= step;
							updateValue();
						}
					});
					// Инициализация начального значения
					updateValue();
				});
			}
		});

	}
	//});
</script>
</body>

</html>