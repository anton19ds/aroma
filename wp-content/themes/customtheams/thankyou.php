<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */
/**
 *Template Name: Thanc
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package csproject
 */
defined('ABSPATH') || exit;
?>
<?php get_header(); ?>
<?php $order = wc_get_order($_GET['order_id']); ?>
<div class="woocommerce-order">

	<?php
	if ($order):

		do_action('woocommerce_before_thankyou', $order->get_id());
		?>

		<?php if ($order->has_status('failed')): ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
				<?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?>
			</p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
					class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
				<?php if (is_user_logged_in()): ?>
					<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
						class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
				<?php endif; ?>
			</p>

		<?php else: ?>

			<?php wc_get_template('checkout/order-received.php', array('order' => $order)); ?>
			<div class="container">
				<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

					<li class="woocommerce-order-overview__order order">
						<?php esc_html_e('Order number:', 'woocommerce'); ?>
						<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
					</li>

					<li class="woocommerce-order-overview__date date">
						<?php esc_html_e('Date:', 'woocommerce'); ?>
						<strong><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
					</li>

					<?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()): ?>
						<li class="woocommerce-order-overview__email email">
							<?php esc_html_e('Email:', 'woocommerce'); ?>
							<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
						</li>
					<?php endif; ?>

					<li class="woocommerce-order-overview__total total">
						<?php esc_html_e('Total:', 'woocommerce'); ?>
						<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
					</li>

					<?php if ($order->get_payment_method_title()): ?>
						<li class="woocommerce-order-overview__payment-method method">
							<?php esc_html_e('Payment method:', 'woocommerce'); ?>
							<strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
						</li>
					<?php endif; ?>

				</ul>
			</div>
		<?php endif; ?>
		<div class="container">
			<div class="block-b">
				<p>Здесь текст платежных данных</p>
				<p>>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id fugiat officiis sit, libero
					vel accusamus ratione sequi ipsam modi? Reiciendis natus nisi eum nihil asperiores laboriosam provident
					placeat quo reprehenderit.</p>
				<p>>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id fugiat officiis sit, libero
					vel accusamus ratione sequi ipsam modi? Reiciendis natus nisi eum nihil asperiores laboriosam provident
					placeat quo reprehenderit.</p>
			</div>
		</div>

		<?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>

		<?php do_action('woocommerce_thankyou', $order->get_id()); ?>
	</div <?php else: ?> 	<?php wc_get_template('checkout/order-received.php', array('order' => false)); ?> <?php endif; ?>
	</div>



	<style>
/* ===== ОСНОВНЫЕ СТИЛИ СТРАНИЦЫ ===== */
.woocommerce-order {
    background: #ffffff;
    min-height: 100vh;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ===== ЗАГОЛОВОК УСПЕХА ===== */
.checkout-tab {
    margin: 40px 0 30px 0;
    background: #ffffff;
    border-bottom: 1px solid #e0e0e0;
}

.tab_default_2 {
    padding: 30px 0;
    text-align: center;
}

.tab_default_2 h2 {
    font-size: 28px;
    font-weight: 600;
    color: #000000;
    margin: 0;
    padding: 0;
    font-family: Georgia, 'Times New Roman', serif;
    line-height: 1.4;
}

/* ===== ОБЗОР ЗАКАЗА (верхний список) ===== */
.woocommerce-order-overview {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 0 0 40px 0;
    padding: 0;
    list-style: none;
    background: #ffffff;
    border: 1px solid #e0e0e0;
    border-bottom: 2px solid #000000;
}

.woocommerce-order-overview li {
    flex: 1 0 200px;
    padding: 25px 30px;
    margin: 0;
    border-right: 1px solid #e0e0e0;
    border-bottom: 1px solid #e0e0e0;
    box-sizing: border-box;
    min-height: 90px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.woocommerce-order-overview li:last-child {
    border-right: none;
}

.woocommerce-order-overview li:nth-last-child(-n+2) {
    border-bottom: none;
}

.woocommerce-order-overview__order,
.woocommerce-order-overview__date,
.woocommerce-order-overview__email,
.woocommerce-order-overview__total,
.woocommerce-order-overview__payment-method {
    font-size: 14px;
    color: #333333;
    line-height: 1.6;
    font-family: Arial, sans-serif;
}

.woocommerce-order-overview li strong {
    font-size: 16px;
    font-weight: 600;
    color: #000000;
    margin-top: 5px;
    display: block;
    font-family: Arial, sans-serif;
}

.woocommerce-order-overview__total strong .woocommerce-Price-amount {
    font-size: 18px;
    color: #000000;
}

/* ===== БЛОК С ПЛАТЕЖНЫМИ ДАННЫМИ ===== */
.block-b {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    padding: 30px;
    margin: 0 0 40px 0;
}

.block-b p {
    font-size: 14px;
    color: #333333;
    line-height: 1.6;
    margin: 0 0 15px 0;
    font-family: Arial, sans-serif;
}

.block-b p:last-child {
    margin-bottom: 0;
}

/* ===== ДЕТАЛИ ЗАКАЗА (таблица) ===== */
.woocommerce-order-details {
    margin: 0 0 40px 0;
    padding: 0;
    background: #ffffff;
    border: 1px solid #e0e0e0;
}

.woocommerce-order-details__title {
    font-size: 24px;
    font-weight: 600;
    color: #000000;
    margin: 0;
    padding: 25px 30px;
    border-bottom: 1px solid #e0e0e0;
    background: #ffffff;
    font-family: Georgia, 'Times New Roman', serif;
}

/* Стили таблицы */
.woocommerce-table.order_details {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
    background: white;
    font-size: 14px;
}

/* Шапка таблицы */
.woocommerce-table.order_details thead {
    background: #ffffff;
    border-bottom: 2px solid #000000;
}

.woocommerce-table.order_details thead tr {
    border: none;
}

.woocommerce-table.order_details thead th {
    padding: 18px 30px;
    font-size: 14px;
    font-weight: 600;
    color: #000000;
    text-align: left;
    border: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-family: Arial, sans-serif;
    background: #ffffff;
}

/* Тело таблицы */
.woocommerce-table.order_details tbody tr {
    border-bottom: 1px solid #e0e0e0;
    transition: background-color 0.2s ease;
    background: #ffffff;
}

.woocommerce-table.order_details tbody tr:hover {
    background-color: #f8f8f8;
}

.woocommerce-table.order_details tbody tr:last-child {
    border-bottom: none;
}

.woocommerce-table.order_details tbody td {
    padding: 20px 30px;
    color: #333333;
    border: none;
    vertical-align: middle;
    line-height: 1.5;
    background: #ffffff;
}

.woocommerce-table__product-name {
    font-weight: 500;
    color: #000000;
}

.woocommerce-table__product-name .product-quantity {
    font-weight: 400;
    color: #666666;
    font-size: 13px;
    margin-left: 8px;
}

.woocommerce-Price-amount {
    font-weight: 600;
    color: #000000;
}

.woocommerce-Price-currencySymbol {
    color: #000000;
}

/* Подвал таблицы */
.woocommerce-table.order_details tfoot {
    background: #ffffff;
}

.woocommerce-table.order_details tfoot tr {
    border-top: 1px solid #e0e0e0;
    background: #ffffff;
}

.woocommerce-table.order_details tfoot tr:last-child {
    border-top: 2px solid #000000;
    background: #ffffff;
}

.woocommerce-table.order_details tfoot th {
    padding: 18px 30px;
    font-size: 14px;
    font-weight: 600;
    color: #333333;
    text-align: left;
    border: none;
    width: 40%;
    background: #ffffff;
    font-family: Arial, sans-serif;
}

.woocommerce-table.order_details tfoot td {
    padding: 18px 30px;
    font-size: 14px;
    font-weight: 600;
    color: #000000;
    border: none;
    background: #ffffff;
    text-align: right;
}

/* Особые стили для итоговой строки */
.woocommerce-table.order_details tfoot tr:last-child th {
    color: #000000;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    background: #ffffff;
}

.woocommerce-table.order_details tfoot tr:last-child td {
    color: #000000;
    font-size: 16px;
    font-weight: 700;
    background: #ffffff;
}

/* Стили для кнопок действий */
.order-actions--heading {
    color: #333333;
    font-weight: 600;
    font-size: 14px;
    font-family: Arial, sans-serif;
    background: #ffffff;
}

.order-actions-button {
    display: inline-block;
    padding: 10px 25px;
    background: #ffffff;
    color: #000000;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s ease;
    border: 1px solid #000000;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-family: Arial, sans-serif;
}

.order-actions-button:hover {
    background: #000000;
    color: #ffffff;
    text-decoration: none;
}

.order-actions-button.view {
    background: #ffffff;
    border-color: #333333;
    color: #333333;
}

.order-actions-button.view:hover {
    background: #333333;
    color: #ffffff;
}

/* ===== ПЛАТЕЖНЫЙ АДРЕС ===== */
.woocommerce-customer-details {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    padding: 0;
    margin: 0 0 60px 0;
}

.woocommerce-column__title {
    font-size: 24px;
    font-weight: 600;
    color: #000000;
    margin: 0;
    padding: 25px 30px;
    border-bottom: 1px solid #e0e0e0;
    background: #ffffff;
    font-family: Georgia, 'Times New Roman', serif;
}

.woocommerce-customer-details address {
    font-size: 14px;
    color: #333333;
    line-height: 1.6;
    padding: 30px;
    margin: 0;
    font-style: normal;
    font-family: Arial, sans-serif;
    background: #ffffff;
}

.woocommerce-customer-details--phone,
.woocommerce-customer-details--email {
    margin: 15px 0 0 0;
    padding: 0;
    font-size: 14px;
    color: #333333;
}

.woocommerce-customer-details--phone:before {
    content: "Телефон: ";
    font-weight: 600;
    color: #000000;
}

.woocommerce-customer-details--email:before {
    content: "Email: ";
    font-weight: 600;
    color: #000000;
}

/* ===== АДАПТИВНОСТЬ ===== */
@media (max-width: 992px) {
    .woocommerce-order-overview li {
        flex: 1 0 45%;
        border-right: none;
    }
    
    .woocommerce-order-overview li:nth-child(even) {
        border-right: none;
    }
    
    .woocommerce-order-overview li:nth-last-child(-n+3) {
        border-bottom: 1px solid #e0e0e0;
    }
    
    .woocommerce-order-overview li:nth-last-child(-n+1) {
        border-bottom: none;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }
    
    .tab_default_2 h2 {
        font-size: 24px;
    }
    
    .woocommerce-order-overview {
        flex-direction: column;
        border: 1px solid #e0e0e0;
    }
    
    .woocommerce-order-overview li {
        flex: 1 0 100%;
        border-right: none;
        border-bottom: 1px solid #e0e0e0;
        padding: 20px;
    }
    
    .woocommerce-order-overview li:last-child {
        border-bottom: none;
    }
    
    .block-b {
        padding: 20px;
    }
    
    /* Адаптация таблицы */
    .woocommerce-table.order_details,
    .woocommerce-table.order_details thead,
    .woocommerce-table.order_details tbody,
    .woocommerce-table.order_details th,
    .woocommerce-table.order_details td,
    .woocommerce-table.order_details tr {
        display: block;
        background: #ffffff;
    }
    
    .woocommerce-table.order_details thead {
        display: none;
        background: #ffffff;
    }
    
    .woocommerce-table.order_details tbody tr {
        display: flex;
        flex-direction: column;
        background: #ffffff;
        margin-bottom: 0;
        padding: 20px;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .woocommerce-table.order_details tbody tr:last-child {
        border-bottom: none;
    }
    
    .woocommerce-table.order_details tbody td {
        padding: 12px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #f0f0f0;
        background: #ffffff;
    }
    
    .woocommerce-table.order_details tbody td:last-child {
        border-bottom: none;
    }
    
    .woocommerce-table.order_details tbody td:before {
        content: attr(data-label);
        font-weight: 600;
        color: #000000;
        margin-right: 15px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-family: Arial, sans-serif;
        min-width: 80px;
        background: #ffffff;
    }
    
    /* Подвал таблицы на мобильных */
    .woocommerce-table.order_details tfoot tr {
        display: flex;
        flex-direction: column;
        background: #ffffff;
        margin-bottom: 0;
        padding: 20px;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .woocommerce-table.order_details tfoot tr:last-child {
        border-bottom: 2px solid #000000;
        background: #ffffff;
    }
    
    .woocommerce-table.order_details tfoot th,
    .woocommerce-table.order_details tfoot td {
        padding: 12px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        border-bottom: 1px solid #f0f0f0;
        text-align: left;
        background: #ffffff;
    }
    
    .woocommerce-table.order_details tfoot th:before,
    .woocommerce-table.order_details tfoot td:before {
        content: attr(data-label);
        font-weight: 600;
        color: #000000;
        margin-right: 15px;
        font-size: 13px;
        min-width: 80px;
        background: #ffffff;
    }
    
    .woocommerce-table.order_details tfoot tr:last-child th,
    .woocommerce-table.order_details tfoot tr:last-child td {
        border-bottom: none;
        background: #ffffff;
    }
    
    .order-actions-button {
        width: 100%;
        text-align: center;
        margin-top: 10px;
        background: #ffffff;
    }
    
    .order-actions--heading {
        display: none;
    }
    
    /* Адрес на мобильных */
    .woocommerce-customer-details address {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .tab_default_2 {
        padding: 20px 0;
    }
    
    .tab_default_2 h2 {
        font-size: 20px;
        padding: 0 10px;
    }
    
    .woocommerce-order-overview li {
        padding: 15px;
    }
    
    .block-b {
        padding: 15px;
    }
    
    .woocommerce-order-details__title,
    .woocommerce-column__title {
        font-size: 20px;
        padding: 20px;
    }
    
    .woocommerce-table.order_details tbody tr,
    .woocommerce-table.order_details tfoot tr {
        padding: 15px;
        background: #ffffff;
    }
    
    .woocommerce-table.order_details tbody td,
    .woocommerce-table.order_details tfoot th,
    .woocommerce-table.order_details tfoot td {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
        padding: 10px 0;
        background: #ffffff;
    }
    
    .woocommerce-table.order_details tbody td:before,
    .woocommerce-table.order_details tfoot th:before,
    .woocommerce-table.order_details tfoot td:before {
        margin-right: 0;
        margin-bottom: 5px;
        font-size: 12px;
        min-width: auto;
        background: #ffffff;
    }
    
    .order-actions-button {
        padding: 12px 20px;
        font-size: 13px;
    }
}

/* ===== ТЕМНАЯ ТЕМА ===== */
@media (prefers-color-scheme: dark) {
    .woocommerce-order {
        background: #ffffff;
    }
    
    .checkout-tab,
    .block-b,
    .woocommerce-order-details,
    .woocommerce-customer-details {
        background: #ffffff;
        border-color: #cccccc;
    }
    
    .tab_default_2 h2,
    .woocommerce-order-details__title,
    .woocommerce-column__title {
        color: #000000;
        background: #ffffff;
    }
    
    .woocommerce-order-overview {
        background: #ffffff;
        border-color: #cccccc;
    }
    
    .woocommerce-order-overview li {
        border-color: #cccccc;
        background: #ffffff;
    }
    
    .woocommerce-order-overview__order,
    .woocommerce-order-overview__date,
    .woocommerce-order-overview__email,
    .woocommerce-order-overview__total,
    .woocommerce-order-overview__payment-method,
    .block-b p,
    .woocommerce-customer-details address,
    .woocommerce-customer-details--phone,
    .woocommerce-customer-details--email {
        color: #333333;
    }
    
    .woocommerce-order-overview li strong,
    .woocommerce-table__product-name,
    .woocommerce-Price-amount,
    .woocommerce-order-overview__total strong .woocommerce-Price-amount {
        color: #000000;
    }
    
    .woocommerce-customer-details--phone:before,
    .woocommerce-customer-details--email:before {
        color: #000000;
    }
}

/* ===== ПЕЧАТЬ ===== */
@media print {
    .woocommerce-order {
        background: white !important;
    }
    
    .container {
        max-width: 100%;
        padding: 0;
    }
    
    .checkout-tab,
    .block-b,
    .woocommerce-order-details,
    .woocommerce-customer-details,
    .woocommerce-order-overview {
        border: 1px solid #000000 !important;
        background: white !important;
        box-shadow: none !important;
    }
    
    .order-actions-button {
        display: none;
    }
    
    * {
        color: #000000 !important;
    }
}
	</style>
<?php get_footer() ?>