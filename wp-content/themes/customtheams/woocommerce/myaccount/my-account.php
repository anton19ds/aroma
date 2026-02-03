<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */?>
 <div class="gurantee-section breadcrum-banner login-page account height-350">
	<div class="gurantee-section-bg" style="background-image: url('https://www.natureinbottle.com/images/acc.jpg');">
		<div class="gurantee-content custom-dp-font">
			<h1>Account Page</h1>
			<p>Check your purchase history and update your personal details</p>
		</div>
	</div>
</div>


	<?php
do_action( 'woocommerce_account_navigation' ); ?>
 		































<div class="woocommerce-MyAccount-content">
	<?php
		/**
		 * My Account content.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_content' );
	?>
</div>
