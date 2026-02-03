<?php
/**
 * Widget settings for Yandex Pay And Split Gateway.
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

defined( 'ABSPATH' ) || exit();

$settings = array(
	'title'       => array(
		'title' => __( 'Widgets', 'yandex-pay-and-split' ),
		'type'  => 'title',
	),
	'enabled'     => array(
		'title'   => __( 'Enable/Disable', 'yandex-pay-and-split' ),
		'type'    => 'checkbox',
		'label'   => __( 'Enable widgets', 'yandex-pay-and-split' ),
		'default' => 'no',
	),
	'theme'       => array(
		'title'   => __( 'Theme', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => array(
			'LIGHT' => __( 'Light', 'yandex-pay-and-split' ),
			'DARK'  => __( 'Dark', 'yandex-pay-and-split' ),
		),
		'default' => 'LIGHT',
	),
	'padding'     => array(
		'title'   => __( 'Padding', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => array(
			'default' => __( 'Default', 'yandex-pay-and-split' ),
			'none'    => __( 'None', 'yandex-pay-and-split' ),
		),
		'default' => 'default',
	),
	'size'        => array(
		'title'   => __( 'Size', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => array(
			'small'  => __( 'Small', 'yandex-pay-and-split' ),
			'medium' => __( 'Medium', 'yandex-pay-and-split' ),
		),
		'default' => 'medium',
	),
	'outlined'    => array(
		'title'   => __( 'Outline', 'yandex-pay-and-split' ),
		'type'    => 'checkbox',
		'label'   => __( 'Outline', 'yandex-pay-and-split' ),
		'default' => 'no',
	),
	'background'  => array(
		'title'   => __( 'Background', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => array(
			'default'     => __( 'Default', 'yandex-pay-and-split' ),
			'saturated'   => __( 'Saturated', 'yandex-pay-and-split' ),
			'transparent' => __( 'Transparent', 'yandex-pay-and-split' ),
		),
		'default' => 'default',
	),
	'hide_header' => array(
		'title'   => __( 'Hide header', 'yandex-pay-and-split' ),
		'type'    => 'checkbox',
		'label'   => __( 'Hide header', 'yandex-pay-and-split' ),
		'default' => 'no',
	),
);
return array_combine(
	array_map(
		static function ( $setting ) {
			return 'widget_' . $setting;
		},
		array_keys( $settings ),
	),
	array_values( $settings )
);
