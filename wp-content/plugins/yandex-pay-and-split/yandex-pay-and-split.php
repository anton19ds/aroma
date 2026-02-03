<?php
/**
 * Plugin Name: Yandex Pay and Split
 * Plugin URI: https://wordpress.org/plugins/yandex-pay-and-split/
 * Description: The official Yandex Pay and Split module for WooCommerce
 * Author: Yandex LLC
 * Author URI: https://pay.yandex.ru
 * Version: 1.1.2
 * Requires at least: 6.0
 * Requires PHP: 7.3
 * WC requires at least: 7.7.2
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: yandex-pay-and-split
 * Domain Path: /i18n/languages/
 *
 * @package WooCommerce\Classes\Payment
 */

/*
	Copyright (C) 2000 - 2025 Yandex LLC

	This program is free software: you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation, either version 2
	of the License, or any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
*/

defined( 'ABSPATH' ) || exit();

defined( 'YANDEX_PAY_AND_SPLIT_ASSETS_PREFIX' ) ||
	define( 'YANDEX_PAY_AND_SPLIT_ASSETS_PREFIX', 'yandex_pay_and_split' );
defined( 'YANDEX_PAY_AND_SPLIT_PLUGIN_VERSION' ) ||
	define( 'YANDEX_PAY_AND_SPLIT_PLUGIN_VERSION', '1.1.2' );
defined( 'YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID' ) ||
	define( 'YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID', 'yandex-pay-and-split-card' );
defined( 'YANDEX_PAY_AND_SPLIT_PLUGIN_SPLIT_GATEWAY_ID' ) ||
	define( 'YANDEX_PAY_AND_SPLIT_PLUGIN_SPLIT_GATEWAY_ID', 'yandex-pay-and-split-split' );
defined( 'YANDEX_PAY_AND_SPLIT_PLUGIN_DIR' ) || define( 'YANDEX_PAY_AND_SPLIT_PLUGIN_DIR', __DIR__ );
defined( 'YANDEX_PAY_AND_SPLIT_PLUGIN_BASE' ) ||
	define( 'YANDEX_PAY_AND_SPLIT_PLUGIN_BASE', plugin_basename( __FILE__ ) );
defined( 'YANDEX_PAY_AND_SPLIT_PLUGIN_URL' ) ||
	define( 'YANDEX_PAY_AND_SPLIT_PLUGIN_URL', plugins_url( '', __FILE__ ) );
defined( 'YANDEX_PAY_AND_SPLIT_MIN_WC_VERSION' ) ||
	define( 'YANDEX_PAY_AND_SPLIT_MIN_WC_VERSION', '7.7.2' );
defined( 'YANDEX_PAY_AND_SPLIT_MIN_PHP_VERSION' ) ||
	define( 'YANDEX_PAY_AND_SPLIT_MIN_PHP_VERSION', '7.3.0' );
defined( 'YANDEX_PAY_LOG_SOURCE' ) || define( 'YANDEX_PAY_LOG_SOURCE', 'yandex_pay' );
defined( 'YANDEX_SPLIT_LOG_SOURCE' ) || define( 'YANDEX_SPLIT_LOG_SOURCE', 'yandex_split' );

defined( 'YANDEX_PAY_AND_SPLIT_IS_BLOCKS_SUPPORTS' ) || define( 'YANDEX_PAY_AND_SPLIT_IS_BLOCKS_SUPPORTS', false );

/**
 * Checks whether WooCommerce is installed and compatible by version
 *
 * @return bool WooCommerce version comparing flag.
 */
function yandex_pay_and_split_check_wc_compare() {
	if (
		! class_exists( 'WooCommerce' ) ||
		version_compare( WC()->version, YANDEX_PAY_AND_SPLIT_MIN_WC_VERSION, '<' )
	) {
		return false;
	}

	return true;
}

/**
 * Checks PHP is compatible by version
 *
 * @return bool PHP version comparing flag.
 */
function yandex_pay_and_split_check_php_compare() {
	if ( version_compare( phpversion(), YANDEX_PAY_AND_SPLIT_MIN_PHP_VERSION, '<' ) ) {
		return false;
	}

	return true;
}

/**
 * Displays a notification for administrator
 *
 * @param string $message message for render in admin notice.
 */
function yandex_pay_and_split_render_admin_notice( $message ) {
	echo '<div class="notice notice-error is-dismissible"><p>' . esc_html( $message ) . '</p></div>';
}

add_action(
	'admin_notices',
	function () {
		if ( ! yandex_pay_and_split_check_wc_compare() ) {
			yandex_pay_and_split_render_admin_notice(
				sprintf(
				/* translators: 1) required WooCommerce version */
					__(
						'Yandex Pay and Split for WooCommerce payment gateway requires WooCommerce version %s or higher to work properly. Please update WooCommerce to use this plugin.',
						'yandex-pay-and-split'
					),
					YANDEX_PAY_AND_SPLIT_MIN_WC_VERSION
				)
			);
		}

		if ( ! yandex_pay_and_split_check_php_compare() ) {
			yandex_pay_and_split_render_admin_notice(
				sprintf(
				/* translators: 1) required PHP version */
					__(
						'Yandex Pay and Split for WooCommerce payment gateway requires PHP version %s or higher to work properly. Please update PHP to use this plugin.',
						'yandex-pay-and-split'
					),
					YANDEX_PAY_AND_SPLIT_MIN_PHP_VERSION
				)
			);
		}
	}
);

add_action(
	'plugins_loaded',
	function () {
		require_once YANDEX_PAY_AND_SPLIT_PLUGIN_DIR . '/includes/class-wc-yandex-pay-and-split.php';

		if (
		! in_array(
			'woocommerce/woocommerce.php',
			apply_filters( 'active_plugins', get_option( 'active_plugins' ) ),
			true
		)
		) {
			return;
		}

		WC_Yandex_Pay_And_Split::init_translation();

		if ( ! yandex_pay_and_split_check_wc_compare() ) {
			return;
		}

		return WC_Yandex_Pay_And_Split::get_instance();
	},
	5
);
