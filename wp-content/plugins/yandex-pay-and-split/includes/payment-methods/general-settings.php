<?php
/**
 * General settings for Yandex Pay And Split Gateway.
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

defined( 'ABSPATH' ) || exit();

$general_settings = array(
	'title_merchant'             => array(
		'title' => __( 'Merchant', 'yandex-pay-and-split' ),
		'type'  => 'title',
	),
	'merchant_id'                => array(
		'title'       => __( 'Merchant ID', 'yandex-pay-and-split' ),
		'type'        => 'text',
		'description' => __( 'Your Merchant ID received when registering with Yandex Pay', 'yandex-pay-and-split' ),
		'css'         => 'width: 400px',
		'placeholder' => __( 'Enter the merchant id', 'yandex-pay-and-split' ),
	),
	'api_key'                    => array(
		'title'       => __( 'API-key', 'yandex-pay-and-split' ),
		'type'        => 'text',
		'description' => __( 'API-key from the Yandex Pay personal account', 'yandex-pay-and-split' ),
		'css'         => 'width: 400px',
		'placeholder' => __( 'Enter the api-key', 'yandex-pay-and-split' ),
	),
	'title_other'                => array(
		'title' => __( 'Other', 'yandex-pay-and-split' ),
		'type'  => 'title',
	),
	'test_environment'           => array(
		'title'   => __( 'Testing', 'yandex-pay-and-split' ),
		'type'    => 'checkbox',
		'label'   => __( 'Enable the test environment?', 'yandex-pay-and-split' ),
		'default' => 'no',
	),
	'ttl'                        => array(
		'title'             => __( 'TTL', 'yandex-pay-and-split' ),
		'type'              => 'number',
		'description'       => __( 'From 180 to 604 800 seconds', 'yandex-pay-and-split' ),
		'css'               => 'width: 200px',
		'placeholder'       => __( 'Enter a number', 'yandex-pay-and-split' ),
		'custom_attributes' => array(
			'min' => 180,
			'max' => 604800,
		),
	),
	'title_orders'               => array(
		'title' => __( 'Orders', 'yandex-pay-and-split' ),
		'type'  => 'title',
	),
	'pending_order_status'       => array(
		'title'   => __( 'Pending order status', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => $order_status_options,
		'default' => 'pending',
	),
	'success_order_status'       => array(
		'title'   => __( 'Success order status', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => $order_status_options,
		'default' => 'processing',
	),
	'error_order_status'         => array(
		'title'   => __( 'Error order status', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => $order_status_options,
		'default' => 'failed',
	),
	'refund_order_status'        => array(
		'title'   => __( 'Refund order status', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => $order_status_options,
		'default' => 'refunded',
	),
	'failed_refund_order_status' => array(
		'title'   => __( 'Failed refund order status', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => $order_status_options,
		'default' => 'failed-refund',
	),
	'purpose'                    => array(
		'title'       => __( 'Payment purpose', 'yandex-pay-and-split' ),
		'type'        => 'text',
		'description' => __( 'Purpose of payment', 'yandex-pay-and-split' ),
		'css'         => 'width: 400px',
	),
	'title_button'               => array(
		'title' => __( 'Button', 'yandex-pay-and-split' ),
		'type'  => 'title',
	),
	'use_pay_button'             => array(
		'title'   => __( 'Button type', 'yandex-pay-and-split' ),
		'type'    => 'checkbox',
		'label'   => __( 'Use the Yandex Pay button', 'yandex-pay-and-split' ),
		'default' => 'yes',
	),
	'button_theme'               => array(
		'title'   => __( 'Button theme', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => array(
			'BLACK'          => __( 'Black', 'yandex-pay-and-split' ),
			'WHITE'          => __( 'White', 'yandex-pay-and-split' ),
			'WHITE-OUTLINED' => __( 'WhiteOutlined', 'yandex-pay-and-split' ),
		),
		'default' => 'BLACK',
	),
	'button_width'               => array(
		'title'   => __( 'Button width', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => array(
			'AUTO' => __( 'Auto', 'yandex-pay-and-split' ),
			'MAX'  => __( 'Max', 'yandex-pay-and-split' ),
		),
		'default' => 'MAX',
	),
	'icons_theme'                => array(
		'title'       => __( 'Icons theme', 'yandex-pay-and-split' ),
		'description' => __( 'Choose the theme of the icon displayed next to the name of the payment method on the checkout page', 'yandex-pay-and-split' ),
		'type'        => 'select',
		'options'     => array(
			'light' => __( 'Light', 'yandex-pay-and-split' ),
			'dark'  => __( 'Dark', 'yandex-pay-and-split' ),
			'blank' => __( 'Don\'t use the icon', 'yandex-pay-and-split' ),
		),
		'default'     => 'light',
	),
);

return $general_settings;
