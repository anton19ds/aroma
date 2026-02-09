<?php
/**
 *Template Name: Pure
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package csproject
 */
?>
<?php get_header();?>
<div class="puure-promise-cont-cover heroImg">
	<div class="container puure-promise-wrapper">
		<?php
		$hero_title = get_field('pure_hero_title');
		$hero_subtitle = get_field('pure_hero_subtitle');
		?>
		<h1><?php echo $hero_title ? esc_html($hero_title) : 'P.U.U.R.E. ОБЕЩАНИЕ !'; ?></h1>
		<h4><?php echo $hero_subtitle ? esc_html($hero_subtitle) : 'чистый • натуральный • терапевтический'; ?></h4>
	</div>
</div>
<div class="timeline-cover">
	<div class="container">
		<div class="timeline-header-wrap">
			<?php
			$section1_title = get_field('pure_section1_title');
			$section1_description = get_field('pure_section1_description');
			?>
			<h2>
				<?php echo $section1_title ? wp_kses_post($section1_title) : '<strong>P</strong>URE AND AUTHENTIC (ЧИСТЫЙ И АУТЕНТИЧНЫЙ)'; ?>
			</h2>
			<p><?php echo $section1_description ? wp_kses_post($section1_description) : 'Благодаря нашему тщательному процессу отбора поставщиков и непоколебимой приверженности строгому тестированию качества мы гарантируем, что каждый продукт, который мы продаем, на 100% чист и аутентичен. Мы приняли строгий стандарт контроля качества, чтобы обеспечить соответствие нашей продукции строгим спецификациям. Мы никогда не компрометируем наши продукты, добавляя синтетику, загрязнители или дешевые наполнители, или используя неэтичные методы производства.'; ?></p>
		</div>
		<div class="timeline-grid-wrapper">
			<?php
			$section1_items = get_field('pure_section1_items');
			if ($section1_items && is_array($section1_items)) {
				foreach ($section1_items as $item) {
					$item_image = isset($item['image']) ? $item['image'] : '';
					$item_title = isset($item['title']) ? $item['title'] : '';
					$item_text = isset($item['text']) ? $item['text'] : '';
					$item_class = isset($item['class']) ? $item['class'] : '';
					$item_standards = isset($item['standards']) ? $item['standards'] : '';
					
					// Получаем URL изображения
					if (is_array($item_image) && isset($item_image['url'])) {
						$image_url = $item_image['url'];
					} elseif (is_numeric($item_image)) {
						$image_url = wp_get_attachment_image_url($item_image, 'full');
					} else {
						$image_url = $item_image;
					}
					
					if (!$image_url) {
						$image_url = get_template_directory_uri() . '/images/sourcing_through_vetted_suppliers.jpg';
					}
					?>
					<div class="timeline-img-detail-wrap">
						<div class="timeline-img">
							<img alt="<?php echo esc_attr($item_title); ?>" src="<?php echo esc_url($image_url); ?>">
						</div>
						<div class="timeline-detail <?php echo esc_attr($item_class); ?>">
							<h3><?php echo esc_html($item_title); ?></h3>
							<p><?php echo wp_kses_post($item_text); ?></p>
							<?php if ($item_standards): ?>
								<div class="qs-point">
									<?php echo wp_kses_post($item_standards); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php
				}
			} else {
				// Значения по умолчанию
				$default_items = array(
					array(
						'image' => get_template_directory_uri() . '/images/sourcing_through_vetted_suppliers.jpg',
						'title' => 'Закупка у проверенных поставщиков',
						'text' => 'У нас есть прямые закупочные отношения с тщательно проверенной сетью сборщиков, фермеров, дистилляторов и наиболее авторитетных сертифицированных поставщиков из <b>более чем 65 различных стран</b> по всему миру. Все наши производители посвящены чистоте и выращивают или собирают дикорастущие растения, выращенные с использованием органических методов земледелия. Они должны соответствовать строгим, непоколебимым эталонам качества, прежде чем мы рассмотрим возможность покупки у них.'
					),
					array(
						'image' => get_template_directory_uri() . '/images/quality_standards.jpg',
						'title' => 'Стандарты качества',
						'text' => 'В рамках нашей Глобальной программы соответствия качеству Nature In Bottle и все наши партнеры сертифицированы по следующим стандартам качества и сертификатам:',
						'class' => 'qs-wrap',
						'standards' => '<strong>• ISO 9001:2015</strong><strong>• WHO-GMP</strong><strong>• HACCP</strong><strong>• HALAL</strong><strong>• KOSHER</strong>'
					),
					array(
						'image' => get_template_directory_uri() . '/images/complete_quality_control.jpg',
						'title' => 'Полный контроль качества',
						'text' => 'Хотя качество нашей продукции начинается в полях, оно подтверждается в наших современных лабораториях. Наш расширенный Центр контроля качества и дистрибуции в Нью-Дели, Индия, представляет собой современное предприятие, где мы проводим множественные выборочные проверки, чтобы убедиться, что наши масла и ингредиенты соответствуют самым высоким стандартам качества. Наши процедуры тестирования проверяются независимой и аккредитованной сторонней лабораторией и тщательно изучаются нашим штатным химиком для максимального обеспечения качества.'
					)
				);
				foreach ($default_items as $item) {
					?>
					<div class="timeline-img-detail-wrap">
						<div class="timeline-img">
							<img alt="<?php echo esc_attr($item['title']); ?>" src="<?php echo esc_url($item['image']); ?>">
						</div>
						<div class="timeline-detail <?php echo isset($item['class']) ? esc_attr($item['class']) : ''; ?>">
							<h3><?php echo esc_html($item['title']); ?></h3>
							<p><?php echo wp_kses_post($item['text']); ?></p>
							<?php if (isset($item['standards'])): ?>
								<div class="qs-point">
									<?php echo wp_kses_post($item['standards']); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
<div class="timeline-cover grey-color">
	<div class="container">
		<div class="timeline-header-wrap">
			<?php
			$section2_title = get_field('pure_section2_title');
			$section2_description = get_field('pure_section2_description');
			?>
			<h2>
				<?php echo $section2_title ? wp_kses_post($section2_title) : '<strong>U</strong>NIVERSALLY ACCEPTED QUALITY (УНИВЕРСАЛЬНО ПРИНЯТОЕ КАЧЕСТВО)'; ?>
			</h2>
			<p><?php echo $section2_description ? wp_kses_post($section2_description) : 'Наш высококвалифицированный, опытный научный персонал использует передовые методы тестирования, чтобы помочь гарантировать, что продукты соответствуют нашим высоким стандартам. Наша команда контроля качества использует ряд физических, химических и микробиологических научных тестов для измерения точных компонентов и свойств нашей продукции. Поскольку чистота и аутентичность имеют первостепенное значение в Nature In Bottle, наша техническая команда регулярно разрабатывает новые методы тестирования, чтобы помочь обеспечить качество всех наших продуктов.'; ?></p>
		</div>
		<div class="timeline-grid-wrapper">
			<?php
			$section2_items = get_field('pure_section2_items');
			if ($section2_items && is_array($section2_items)) {
				foreach ($section2_items as $item) {
					$item_image = isset($item['image']) ? $item['image'] : '';
					$item_title = isset($item['title']) ? $item['title'] : '';
					$item_text = isset($item['text']) ? $item['text'] : '';
					
					// Получаем URL изображения
					if (is_array($item_image) && isset($item_image['url'])) {
						$image_url = $item_image['url'];
					} elseif (is_numeric($item_image)) {
						$image_url = wp_get_attachment_image_url($item_image, 'full');
					} else {
						$image_url = $item_image;
					}
					
					if (!$image_url) {
						$image_url = get_template_directory_uri() . '/images/gas_chromatography_and_mass_apectrometry_analysis.jpg';
					}
					?>
					<div class="timeline-img-detail-wrap">
						<div class="timeline-img">
							<img alt="<?php echo esc_attr($item_title); ?>" src="<?php echo esc_url($image_url); ?>">
						</div>
						<div class="timeline-detail">
							<h3><?php echo esc_html($item_title); ?></h3>
							<p><?php echo wp_kses_post($item_text); ?></p>
						</div>
					</div>
					<?php
				}
			} else {
				// Значения по умолчанию
				$default_items = array(
					array(
						'image' => get_template_directory_uri() . '/images/gas_chromatography_and_mass_apectrometry_analysis.jpg',
						'title' => 'Газовая хроматография и масс-спектрометрия (ГХ/МС)',
						'text' => '<b>Газовая хроматография (ГХ)</b> — это метод разделения летучих соединений в эфирных маслах на отдельные компоненты и создания линейного графика, отображающего эти компоненты. <b>Масс-спектрометрия (МС)</b> идентифицирует каждый из этих компонентов и их процентное содержание. Точный анализ химических компонентов, предоставляемый нам отчетами ГХ/МС, помогает нам убедиться, что химический состав тестируемого образца соответствует ожидаемому химическому профилю, и определить, было ли эфирное масло подвергнуто фальсификации.'
					),
					array(
						'image' => get_template_directory_uri() . '/images/organoleptic_testing.jpg',
						'title' => 'Органолептическое тестирование',
						'text' => 'Наш опытный штатный химик вручную оценивает внешний вид, аромат и цвет каждого из наших эфирных масел и ингредиентов, чтобы получить немедленные подсказки о приемлемости продукта. Продукты должны пройти проверку их физических свойств (внешний вид, запах, консистенция и т.д.) перед утверждением для этапа розлива. Натуральные масла с необычным запахом, неравномерной консистенцией или странным цветом указывают на проблему и немедленно отклоняются.'
					),
					array(
						'image' => get_template_directory_uri() . '/images/complete_quality_control.jpg',
						'title' => 'Удельный вес, коэффициент преломления и оптическое вращение',
						'text' => 'Все наши партии масел и натуральных ингредиентов также тестируются на следующие физические параметры: <b>Оптическое вращение</b> (тест на хиральность путем измерения степени изгиба света, создаваемого ориентацией молекул), <b>Удельный вес</b> (соотношение объема к весу) и <b>Коэффициент преломления</b> (измерение того, как свет распространяется через определенное вещество) — чтобы убедиться, что образец эфирного масла или натурального ингредиента соответствует нашим установленным стандартам.'
					),
					array(
						'image' => get_template_directory_uri() . '/images/contamination_testing.jpg',
						'title' => 'Тестирование на загрязнение',
						'text' => 'Все наши партии эфирных масел и натуральных косметических ингредиентов анализируются экспертами-микробиологами на наличие биоопасных микроорганизмов (грибков, бактерий, вирусов и плесени), тяжелых металлов и пестицидов. Эти тесты проводятся на всех продуктах, поступающих на производственное предприятие, а также на готовой продукции перед отправкой, чтобы гарантировать, что продукт не был загрязнен во время хранения или фасовки.'
					)
				);
				foreach ($default_items as $item) {
					?>
					<div class="timeline-img-detail-wrap">
						<div class="timeline-img">
							<img alt="<?php echo esc_attr($item['title']); ?>" src="<?php echo esc_url($item['image']); ?>">
						</div>
						<div class="timeline-detail">
							<h3><?php echo esc_html($item['title']); ?></h3>
							<p><?php echo wp_kses_post($item['text']); ?></p>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
<?php
$banner1_title = get_field('pure_banner1_title');
$banner1_image = get_field('pure_banner1_image');
$banner1_text = get_field('pure_banner1_text');

if (!$banner1_title) $banner1_title = '<strong class="banner-text-bold">U</strong>NMATCHED PRICING (НЕСРАВНЕННЫЕ ЦЕНЫ)';
if (!$banner1_image) {
	$banner1_image_url = get_template_directory_uri() . '/images/Best-Price.png';
} else {
	if (is_array($banner1_image) && isset($banner1_image['url'])) {
		$banner1_image_url = $banner1_image['url'];
	} elseif (is_numeric($banner1_image)) {
		$banner1_image_url = wp_get_attachment_image_url($banner1_image, 'full');
	} else {
		$banner1_image_url = $banner1_image;
	}
}
if (!$banner1_text) $banner1_text = 'Мы — компания <strong>не MLM</strong>, продающая онлайн напрямую потребителю, поэтому у нас нет посредников. Наши цены <strong>всегда оптовые</strong>, для <strong>каждого клиента</strong> — наше намерение всегда заключалось в том, чтобы обеспечить доступность эфирных масел и натуральных косметических ингредиентов высшего качества для всех — от новых ремесленников с начинающимся бизнесом до устоявшихся профессиональных производителей косметики.';
?>
<div class="banner-with-content-wrap">
	<div class="banner-inside-detl-wrap">
		<h3 class="banner-text">
			<?php echo wp_kses_post($banner1_title); ?>
		</h3>
		<div class="banner-img-text">
			<img alt="" src="<?php echo esc_url($banner1_image_url); ?>">
			<div class="we-non-mlm"><?php echo wp_kses_post($banner1_text); ?></div>
		</div>
	</div>
</div>
<?php
$banner2_title = get_field('pure_banner2_title');
$banner2_bg_image = get_field('pure_banner2_bg_image');
$banner2_image = get_field('pure_banner2_image');
$banner2_text = get_field('pure_banner2_text');

if (!$banner2_title) $banner2_title = '<strong class="banner-text-bold">R</strong>ELIABLE CUSTOMER SERVICE (НАДЕЖНОЕ ОБСЛУЖИВАНИЕ КЛИЕНТОВ)';
if (!$banner2_bg_image) {
	$banner2_bg_image_url = get_template_directory_uri() . '/images/reliable_customer_service_background.jpg';
} else {
	if (is_array($banner2_bg_image) && isset($banner2_bg_image['url'])) {
		$banner2_bg_image_url = $banner2_bg_image['url'];
	} elseif (is_numeric($banner2_bg_image)) {
		$banner2_bg_image_url = wp_get_attachment_image_url($banner2_bg_image, 'full');
	} else {
		$banner2_bg_image_url = $banner2_bg_image;
	}
}
if (!$banner2_image) {
	$banner2_image_url = get_template_directory_uri() . '/images/90_dAYS_money_back.png';
} else {
	if (is_array($banner2_image) && isset($banner2_image['url'])) {
		$banner2_image_url = $banner2_image['url'];
	} elseif (is_numeric($banner2_image)) {
		$banner2_image_url = wp_get_attachment_image_url($banner2_image, 'full');
	} else {
		$banner2_image_url = $banner2_image;
	}
}
if (!$banner2_text) $banner2_text = 'Наша гарантия возврата денег в течение 90 дней демонстрирует нашу уверенность в качестве нашей продукции. Мы понимаем, что покупатели хотят быть уверены в том, что покупают, поэтому мы стремимся к полному удовлетворению потребностей наших клиентов. Если вы недовольны своей покупкой по какой-либо причине, мы сделаем все возможное, чтобы решить проблему к вашему удовлетворению. Мы также предлагаем бесплатные образцы большинства наших продуктов, чтобы вы могли попробовать перед покупкой.';
?>
<div class="banner-with-content-wrap" style="background-image: url(<?php echo esc_url($banner2_bg_image_url); ?>);">
	<div class="banner-inside-detl-wrap">
		<h3 class="banner-text">
			<?php echo wp_kses_post($banner2_title); ?>
		</h3>
		<div class="banner-img-text">
			<img alt="" src="<?php echo esc_url($banner2_image_url); ?>">
			<div class="we-non-mlm"><?php echo wp_kses_post($banner2_text); ?></div>
		</div>
	</div>
</div>


<!-- Остальной код JavaScript остается без изменений -->
 
<?php get_footer();?>