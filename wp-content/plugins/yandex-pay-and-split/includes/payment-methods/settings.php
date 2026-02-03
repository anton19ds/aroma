<?php
/**
 * Settings for Yandex Pay And Split Gateway.
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

defined( 'ABSPATH' ) || exit();

$pay_settings = array(
	'enabled' => array(
		'title'   => __( 'Enable/Disable', 'yandex-pay-and-split' ),
		'type'    => 'checkbox',
		'label'   => __( 'Enable Yandex Pay', 'yandex-pay-and-split' ),
		'default' => 'no',
	),
);

return $pay_settings;
