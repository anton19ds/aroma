<?php
/**
 * Badges settings for Yandex Pay And Split Gateway.
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

defined( 'ABSPATH' ) || exit();

$base_badge_settings = array(
	'theme' => array(
		'title'   => __( 'Theme', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => array(
			'light' => __( 'Light', 'yandex-pay-and-split' ),
			'dark'  => __( 'Dark', 'yandex-pay-and-split' ),
		),
		'default' => 'light',
	),
	'size'  => array(
		'title'   => __( 'Size', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => array(
			's' => __( 'Small', 'yandex-pay-and-split' ),
			'm' => __( 'Medium', 'yandex-pay-and-split' ),
			'l' => __( 'Large', 'yandex-pay-and-split' ),
		),
		'default' => 's',
	),
	'align' => array(
		'title'   => __( 'Align', 'yandex-pay-and-split' ),
		'type'    => 'select',
		'options' => array(
			'left'   => __( 'Left', 'yandex-pay-and-split' ),
			'center' => __( 'Center', 'yandex-pay-and-split' ),
			'right'  => __( 'Right', 'yandex-pay-and-split' ),
		),
		'default' => 'left',
	),
);

$badge_common_settings = array(
	'badge_title'   => array(
		'title' => __( 'Badges', 'yandex-pay-and-split' ),
		'type'  => 'title',
	),
	'badge_enabled' => array(
		'title'   => __( 'Enable badges', 'yandex-pay-and-split' ),
		'type'    => 'checkbox',
		'label'   => __( 'Enable badges', 'yandex-pay-and-split' ),
		'default' => 'no',
	),
);

$badge_bnpl_settings = array_merge(
	array(
		'title'   => array(
			'title' => __( 'Badge BNPL', 'yandex-pay-and-split' ),
			'type'  => 'title',
		),
		'color'   => array(
			'title'   => __( 'Color', 'yandex-pay-and-split' ),
			'type'    => 'select',
			'options' => array(
				'primary'     => __( 'Primary', 'yandex-pay-and-split' ),
				'green'       => __( 'Green', 'yandex-pay-and-split' ),
				'gray'        => __( 'Gray', 'yandex-pay-and-split' ),
				'transparent' => __( 'Transparent', 'yandex-pay-and-split' ),
			),
			'default' => 'primary',
		),
		'variant' => array(
			'title'   => __( 'Variant', 'yandex-pay-and-split' ),
			'type'    => 'select',
			'options' => array(
				'detailed' => __( 'Detailed', 'yandex-pay-and-split' ),
				'simple'   => __( 'Simple', 'yandex-pay-and-split' ),
			),
			'default' => 'detailed',
		),
	),
	$base_badge_settings,
);

$badge_bnpl_settings = array_combine(
	array_map(
		function ( $key ) {
			return 'bnpl_badge_' . $key;
		},
		array_keys( $badge_bnpl_settings ),
	),
	array_values( $badge_bnpl_settings ),
);

$badge_cashback_settings = array_merge(
	array(
		'title'   => array(
			'title' => __( 'Badge cashback', 'yandex-pay-and-split' ),
			'type'  => 'title',
		),
		'color'   => array(
			'title'   => __( 'Color', 'yandex-pay-and-split' ),
			'type'    => 'select',
			'options' => array(
				'primary'     => __( 'Primary', 'yandex-pay-and-split' ),
				'gray'        => __( 'Gray', 'yandex-pay-and-split' ),
				'transparent' => __( 'Transparent', 'yandex-pay-and-split' ),
			),
		),
		'variant' => array(
			'title'   => __( 'Variant', 'yandex-pay-and-split' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'yandex-pay-and-split' ),
				'compact' => __( 'Compact', 'yandex-pay-and-split' ),
			),
		),
	),
	$base_badge_settings,
);

$badge_cashback_settings = array_combine(
	array_map(
		function ( $key ) {
			return 'cashback_badge_' . $key;
		},
		array_keys( $badge_cashback_settings ),
	),
	array_values( $badge_cashback_settings ),
);

$badge_settings            = array_merge( $badge_bnpl_settings, $badge_cashback_settings );
$duplicated_badge_settings = array_merge(
	array(
		'loop_badge_title' => array(
			'title' => __( 'Badge loop settings', 'yandex-pay-and-split' ),
			'type'  => 'title',
		),
	),
	array_combine(
		array_map(
			function ( $key ) {
				return 'loop_' . $key;
			},
			array_keys( $badge_settings ),
		),
		array_values( $badge_settings ),
	),
	array(
		'single_badge_title' => array(
			'title' => __( 'Badge single page settings', 'yandex-pay-and-split' ),
			'type'  => 'title',
		),
	),
	array_combine(
		array_map(
			function ( $key ) {
				return 'single_' . $key;
			},
			array_keys( $badge_settings ),
		),
		array_values( $badge_settings ),
	),
);

return array_merge( $badge_common_settings, $duplicated_badge_settings );
