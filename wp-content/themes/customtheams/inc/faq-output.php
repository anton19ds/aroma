<?php
/**
 * Вывод FAQ секции: если есть данные ACF — из них, иначе из $defaults.
 * $section_key: ключ поля ACF (faq_section_product, faq_section_orders, faq_section_shipping)
 * $defaults: массив [ ['question'=>'', 'answer'=>''] ... ]
 */
if (!isset($section_key) || !isset($defaults)) return;
$items = get_field($section_key, 'option');
if ($items && is_array($items)) {
	foreach ($items as $item) {
		$q = isset($item['question']) ? $item['question'] : '';
		$a = isset($item['answer']) ? $item['answer'] : '';
		if ($q === '' && $a === '') continue;
		?>
		<div class="faq-item">
			<button class="faq-question"><?php echo esc_html($q); ?></button>
			<div class="faq-answer"><?php echo wp_kses_post($a); ?></div>
		</div>
		<?php
	}
} else {
	foreach ($defaults as $item) {
		?>
		<div class="faq-item">
			<button class="faq-question"><?php echo esc_html($item['question']); ?></button>
			<div class="faq-answer"><?php echo wp_kses_post($item['answer']); ?></div>
		</div>
		<?php
	}
}
