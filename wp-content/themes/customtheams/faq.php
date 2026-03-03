<?php
/**
 * Template Name: FAQ page
 * Форма обратной связи с капчей и отправкой на почту.
 */
?>

<?php get_header(); ?>

<?php
$faq_banner_title = get_field('faq_banner_title');
$faq_banner_subtitle = get_field('faq_banner_subtitle');
if (!$faq_banner_title)
     $faq_banner_title = 'FAQ';
if (!$faq_banner_subtitle)
     $faq_banner_subtitle = 'Frequently Asked Questions';
?>
<div class="bannerContainer inner-banner faqhb">
     <div class="bannerItem">
          <h2><?php echo esc_html($faq_banner_title); ?></h2>
          <p><?php echo esc_html($faq_banner_subtitle); ?></p>
     </div>
</div>
<section class="faq-sect">
     <div class="container">
          <div class="faq-wrap">
               <div class="faq-tabs">
                    <?php
                    $faq_tabs = get_field('faq_tabs', 'option');
                    $tab_ids = array('product', 'orders', 'shipping');
                    $tab_defaults = array(
                         array('label' => 'ДОСТАВКА И ВОЗВРАТЫ', 'img' => get_template_directory_uri().'/images/f1.png'),
                         array('label' => 'ЗАКАЗЫ И ПЛАТЕЖИ', 'img' => get_template_directory_uri().'/images/f2.png'),
                         array('label' => 'ТОВАР И ЦЕНЫ', 'img' => get_template_directory_uri().'/images/f3.png'),
                    );
                    for ($i = 0; $i < 3; $i++) {
                         $tab_id = $tab_ids[$i];
                         $label = $tab_defaults[$i]['label'];
                         $img_src = $tab_defaults[$i]['img'];
                         if ($faq_tabs && isset($faq_tabs[$i])) {
                              $t = $faq_tabs[$i];
                              if (!empty($t['label']))
                                   $label = $t['label'];
                              if (!empty($t['image'])) {
                                   if (is_array($t['image']) && isset($t['image']['url']))
                                        $img_src = $t['image']['url'];
                                   elseif (is_numeric($t['image']))
                                        $img_src = wp_get_attachment_image_url($t['image'], 'full');
                                   else
                                        $img_src = $t['image'];
                              }
                         }
                         $active = ($i === 0) ? ' active' : '';
                         ?>
                         <button type="button" class="faq-tab<?php echo $active; ?>"
                              data-faq-tab="<?php echo esc_attr($tab_id); ?>">
                              <img src="<?php echo esc_url($img_src); ?>" alt="">
                              <span><?php echo esc_html($label); ?></span>
                         </button>
                    <?php } ?>
               </div>
               <div id="product" class="faq-content">
                    <?php $prod = get_field('del') ?>
                    <?php foreach ($prod as $item): ?>
                         <div class="faq-item">
                              <button class="faq-question"><?= $item['title']?></button>
                              <div class="faq-answer">
                                   <p><?= $item['text']?></p>
                              </div>
                         </div>
                    <?php endforeach; ?>


               </div>
               <div id="orders" class="faq-content" hidden>
                    <?php $pay = get_field('pay') ?>
                    <?php foreach ($pay as $item): ?>
                         <div class="faq-item">
                              <button class="faq-question"><?= $item['title']?></button>
                              <div class="faq-answer">
                                   <p><?= $item['text']?></p>
                              </div>
                         </div>
                    <?php endforeach; ?>
               </div>
               <div id="shipping" class="faq-content" hidden>
                    <?php $pay = get_field('prod') ?>
                    <?php foreach ($pay as $item): ?>
                         <div class="faq-item">
                              <button class="faq-question"><?= $item['title']?></button>
                              <div class="faq-answer">
                                   <p><?= $item['text']?></p>
                              </div>
                         </div>
                    <?php endforeach; ?>
               </div>
          </div>
     </div>
</section>
<style>
     .faq-answer {
          display: grid;
          grid-template-rows: 0fr;
          transition: grid-template-rows 0.3s ease;
          overflow: hidden;
     }

     .faq-answer.open {
          grid-template-rows: 1fr;
     }

     .faq-answer>* {
          min-height: 0;
          overflow: hidden;
     }

     .faq-question {
          width: 100%;
          text-align: left;
          cursor: pointer;
          position: relative;
     }

     .faq-question::after {
          content: '+';
          position: absolute;
          right: 0;
          transition: transform 0.3s ease;
     }

     .faq-item:has(.faq-answer.open) .faq-question::after {
          transform: rotate(45deg);
     }
</style>
<script>
     (function () {
          var wrap = document.querySelector('.faq-wrap');
          if (!wrap) return;

          // Переключение табов (Product / Orders / Shipping)
          wrap.addEventListener('click', function (e) {
               var btn = e.target.closest('.faq-tab');
               if (!btn) return;
               var tabId = btn.getAttribute('data-faq-tab');
               if (!tabId) return;
               wrap.querySelectorAll('.faq-tab').forEach(function (t) { t.classList.remove('active'); });
               btn.classList.add('active');
               wrap.querySelectorAll('.faq-content').forEach(function (panel) {
                    panel.hidden = panel.id !== tabId;
               });
          });

          // Аккордеон: клик по .faq-question открывает/закрывает .faq-answer
          wrap.addEventListener('click', function (e) {
               var question = e.target.closest('.faq-question');
               if (!question) return;
               var item = question.closest('.faq-item');
               var content = question.closest('.faq-content');
               var answer = item ? item.querySelector('.faq-answer') : null;
               if (!answer) return;

               var isOpen = answer.classList.contains('open');
               // Закрыть все ответы в текущей вкладке
               content.querySelectorAll('.faq-answer.open').forEach(function (a) {
                    a.classList.remove('open');
               });
               content.querySelectorAll('.faq-question').forEach(function (q) {
                    q.classList.remove('active');
               });
               // Открыть текущий, если был закрыт
               if (!isOpen) {
                    answer.classList.add('open');
                    question.classList.add('active');
               }
          });
     })();
</script>
<?php get_footer(); ?>