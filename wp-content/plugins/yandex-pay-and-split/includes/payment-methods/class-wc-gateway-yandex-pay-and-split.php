<?php
/**
 * Yandex Pay And Split Abstract Payment Gateway
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

use YandexPay\Lib\Logger;
use YandexPay\Settings\WC_Yandex_Pay_Settings;

// phpcs:disable WordPress.Security.NonceVerification.Recommended
// phpcs:disable WordPress.Security.NonceVerification.Missing

/**
 * WooCommerce Payment Gateway abstract class
 */
abstract class WC_Gateway_Yandex_Pay_And_Split extends WC_Payment_Gateway {

	/**
	 * Flag of test environment
	 *
	 * @var bool
	 */
	public $test_environment;

	/**
	 * Merchant ID
	 *
	 * @var string
	 */
	public $merchant_id;

	/**
	 * API-key
	 *
	 * @var string
	 */
	public $api_key;

	/**
	 * Time to live of the payment form
	 *
	 * @var string
	 */
	public $ttl;

	/**
	 * The status value set during creation
	 *
	 * @var string
	 */
	public $pending_order_status;

	/**
	 * The status value set after successful payment
	 *
	 * @var string
	 */
	public $success_order_status;

	/**
	 * The status value set after failed payment
	 *
	 * @var string
	 */
	public $error_order_status;

	/**
	 * The status value set when the payment was refunded
	 *
	 * @var string
	 */
	public $refund_order_status;

	/**
	 * The status value set when error happended by refund
	 *
	 * @var string
	 */
	public $error_refund_order_status;

	/**
	 * Payment purpose
	 *
	 * @var string
	 */
	public $purpose;

	/**
	 * Icon theme of names of payment methods
	 *
	 * @var string
	 */
	public $icons_theme;

	/**
	 * Instance of Logger
	 *
	 * @var Logger
	 */
	public $logger;

	/**
	 * Flag of hooks loaded
	 *
	 * @var bool
	 */
	private static $hooks_loaded = false;

	/**
	 * The api instance
	 *
	 * @var WC_Yandex_Pay_And_Split_API
	 */
	private $api;

	/**
	 * WC_Gateway_Yandex_Pay_And_Split constructor.
	 */
	public function __construct() {
		add_action( 'before_woocommerce_init', array( $this, 'declare_block_support' ) );

		$this->logger = new Logger( wc_get_logger() );

		$main_settings            = WC_Yandex_Pay_Settings::get_main_settings();
		$checkout_button_settings = WC_Yandex_Pay_Settings::get_checkout_button_settings();

		$this->enabled                   = $this->get_option( 'enabled' );
		$this->test_environment          = $main_settings::is_test_environment();
		$this->merchant_id               = $main_settings::get_merchant_id();
		$this->api_key                   = $main_settings::get_api_key();
		$this->ttl                       = $main_settings::get_ttl();
		$this->pending_order_status      = $main_settings::get_pending_order_status();
		$this->success_order_status      = $main_settings::get_success_order_status();
		$this->error_order_status        = $main_settings::get_error_order_status();
		$this->refund_order_status       = $main_settings::get_refund_order_status();
		$this->error_refund_order_status = $main_settings::get_failed_refund_order_status();
		$this->purpose                   = $main_settings::get_purpose();
		$this->icons_theme               = $checkout_button_settings::get_icons_theme();
		$this->supports                  = array( 'products', 'refunds' );
		$this->api                       = new WC_Yandex_Pay_And_Split_API(
			$this->test_environment ? WC_Yandex_Pay_And_Split_Api::get_sandbox_url() : WC_Yandex_Pay_And_Split_Api::get_yandex_pay_url(),
			$this->merchant_id,
			$this->test_environment ? $this->merchant_id : $this->api_key
		);

		if ( $this->test_environment ) {
			$this->description .=
				' ' .
				sprintf(
					/* translators: link to the testing documentation */
					__(
						'SANDBOX ENABLED. You can use sandbox testing data only. See the <a href="%s">Yandex Pay testing guide</a> for more details.',
						'yandex-pay-and-split'
					),
					'https://pay.yandex.ru/docs/ru/testing'
				);
			$this->description = trim( $this->description );
		}

		if ( $this->is_available() && ! self::$hooks_loaded ) {
			self::$hooks_loaded = true;

			add_action( 'woocommerce_api_yandex-pay-and-split/v1/webhook', array( $this, 'webhook' ) );
		}

		add_filter( 'woocommerce_gateway_icon', array( $this, 'gateway_icon_connecting' ), 10, 2 );

		add_action(
			'woocommerce_update_options_payment_gateways_' . $this->id,
			array(
				$this,
				'process_admin_options',
			)
		);
		add_action( 'woocommerce_create_refund', array( $this, 'update_metata_of_hand_refund' ), 10, 2 );
	}

	/**
	 * Determines whether the payment gateway is compatible with WooCommerce Checkout block
	 */
	public function declare_block_support() {
		if (
			class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) &&
			YANDEX_PAY_AND_SPLIT_IS_BLOCKS_SUPPORTS
		) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility(
				'cart_checkout_blocks',
				__FILE__,
				true // true (compatible, default) or false (not compatible).
			);
		}
	}

	/**
	 * Connects icon to payment method name on checkout page
	 *
	 * @param string $icon Gateway icon.
	 * @param string $id Gateway ID.
	 *
	 * @return string
	 */
	public function gateway_icon_connecting( $icon, $id ) {
		$theme = wc_clean( wp_unslash( $this->icons_theme ) );

		if ( 'blank' === $theme ) {
			return $icon;
		}

		$locale = 'ru_RU' === get_locale() ? 'ru' : 'en';
		$style  = '" style="margin-left: 5px; margin-bottom: -4px;" > '; // Magic numbers.

		$prefix  = '<img src="' . YANDEX_PAY_AND_SPLIT_PLUGIN_URL . '/assets/icons/';
		$postfix = $theme . '_' . $locale . '.svg' . $style;

		if ( YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID === $id ) {
			return $prefix . 'pay_' . $postfix;
		} elseif ( YANDEX_PAY_AND_SPLIT_PLUGIN_SPLIT_GATEWAY_ID === $id ) {
			return $prefix . 'split_' . $postfix;
		} else {
			return $icon;
		}
	}

	/**
	 * Generating a message about an unconfigured plugin
	 */
	public function plugin_not_configured_message() {
		$id = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_';

		if (
			isset( $_POST[ $id . 'merchant_id' ] ) &&
			! empty( sanitize_text_field( wp_unslash( $_POST[ $id . 'merchant_id' ] ) ) ) &&
			isset( $_POST[ $id . 'api_key' ] ) &&
			! empty( sanitize_text_field( wp_unslash( $_POST[ $id . 'api_key' ] ) ) )
		) {
			return;
		}

		echo '<div class="error"><p><strong>' .
			esc_html__( 'Yandex Pay and Split payment gateway disabled', 'yandex-pay-and-split' ) .
			'</strong>: ' .
			esc_html__( 'You must fill the "Merchant ID" and "API-key".', 'yandex-pay-and-split' ) .
			'</p></div>';
	}

	/**
	 * Checks if the payment gateway requires setup.
	 *
	 * @return bool True if the merchant ID or API key is missing, indicating setup is needed; otherwise, false.
	 */
	public function needs_setup() {
		return empty( $this->merchant_id ) || empty( $this->api_key );
	}

	/**
	 * Checking the availability of the plugin payment methods
	 *
	 * @return bool
	 */
	public function is_available() {
		return parent::is_available() && ! $this->needs_setup();
	}

	/**
	 * Build the Yandex Pay order.
	 *
	 * @param bool|\WC_Order|\WC_Order_Refund $order WooCommerce order entity.
	 *
	 * @return array
	 */
	private function get_order( $order ) {

		$cart_items = $this->get_cart_items( $order->get_items( array( 'line_item', 'shipping' ) ) );

		$address = $this->get_shipping_address( $order );

		$metadata_format = 'cms_name:%s;cms_version:%s;version:%s';
		$metadata        = sprintf( $metadata_format, 'WordPress', $GLOBALS['wp_version'], YANDEX_PAY_AND_SPLIT_PLUGIN_VERSION );

		$order_data = array(
			'availablePaymentMethods' => array(
				'yandex-pay-and-split-card' === $order->get_payment_method() ? 'CARD' : 'SPLIT',
			),
			'cart'                    => array(
				'items' => array_values( $cart_items ),
				'total' => array(
					'amount' => $order->get_total(),
				),
			),
			'currencyCode'            => get_woocommerce_currency(),
			'isPrepayment'            => false,
			'metadata'                => $metadata,
			'orderId'                 => (string) $order->get_id(),
			'orderSource'             => 'CMS_PLUGIN',
			'redirectUrls'            => array(
				'onError'   => wc_get_account_endpoint_url( 'orders' ),
				'onSuccess' => $this->get_return_url( $order ),
				'onAbort'   => wc_get_page_permalink( 'checkout' ),
			),
			'billingPhone'            => $order->get_billing_phone(),
			'risk'                    => array(
				'shippingAddress' => $address,
				'shippingPhone'   => $order->get_shipping_phone(),
			),
			'purpose'                 => $this->purpose,
		);

		if ( '' !== $this->ttl ) {
			$order_data['ttl'] = $this->ttl;
		}

		return $order_data;
	}

	/**
	 * Process the payment and return the result.
	 *
	 * @param int $order_id Order ID.
	 *
	 * @return array
	 */
	public function process_payment( $order_id ) {
		$order = wc_get_order( $order_id );

		$payload = $this->get_order( $order );

		$response = $this->api->create_order( $payload );

		$result = array(
			'result' => 'success',
		);

		if ( ! is_wp_error( $response ) ) {
			$response_body = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( 'success' === $response_body['status'] ) {
				if ( 'pending' !== $this->pending_order_status ) {
					$order->update_status( $this->pending_order_status );
				}
				WC()->cart->empty_cart();

				$result['redirect'] = $response_body['data']['paymentUrl'];
				return $result;
			}
			$this->logger->error(
				'Yandex api error',
				array(
					'order'     => $order,
					'response'  => $response_body,
					'backtrace' => true,
				)
			);
			wc_add_notice( __( 'Something was wrong', 'yandex-pay-and-split' ), 'error' );
		} else {
			wc_add_notice( __( 'Couldn\'t connect to the Yandex Pay api', 'yandex-pay-and-split' ), 'error' );
		}
		$result['result'] = 'failure';
		return $result;
	}

	/**
	 * Processes a refund for a given order via Yandex Pay & Split.
	 *
	 * @param int        $order_id The ID of the order to refund.
	 * @param float|null $amount The amount to be refunded.
	 * @param string     $reason The reason for the refund.
	 * @return bool|WP_Error True on success or WP_Error on failure.
	 */
	public function process_refund( $order_id, $amount = null, $reason = '' ) {
		$order = wc_get_order( $order_id );

		$active_refunds = $this->get_refunds( $order, true );
		if ( count( $active_refunds ) > 1 ) {
			return new WP_Error( 'yandex_pay_and_split_refund_error', __( 'Only one refund is allowed at a time', 'yandex-pay-and-split' ) );
		}
		$active_refund       = end( $active_refunds );
		$refund_operation_id = $active_refund->get_id();

		$current_cart_items = $this->get_cart_with_refunds( $order );
		$changed_item_ids   = $this->get_refunded_item_ids( $active_refund );

		$refund_items = array();

		foreach ( $current_cart_items as $item_id => $item ) {
			if ( ( ( $item['quantity'] ?? 0 ) > 0 && ( $item['price'] ?? 0 ) > 0 ) || array_key_exists( $item_id, $changed_item_ids ) ) {
				$refund_items[] = $item;
			}
		}

		$response = $this->api->refund_order(
			$refund_operation_id,
			(string) $order->get_id(),
			$amount ?? 0,
			$refund_items
		);

		if ( ! is_wp_error( $response ) ) {
			$response_body = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( 'success' === $response_body['status'] ) {
				$operation = $response_body['data']['operation'];
				if ( 'FAIL' === $operation['status'] ) {
					return new WP_Error( 'yandex_pay_and_split_refund_error', $operation['reason'] );
				}

				return true;
			} elseif ( 'fail' === $response_body['status'] ) {
				$this->logger->error(
					'Yandex api error',
					array(
						'order'        => $order,
						'responseCode' => $response_body['reasonCode'],
						'backtrace'    => true,
					)
				);
				return new WP_Error( 'yandex_pay_and_split_refund_error', $response_body['reason'] );
			}
		}

		return new WP_Error( 'yandex_pay_and_split_refund_error', __( 'Couldn\'t refund the order', 'yandex-pay-and-split' ) );
	}

	/**
	 * Updates meta data of a refund to indicate it was processed via the Yandex Pay and Split gateway.
	 *
	 * @param WC_Order_Refund $refund The refund object.
	 * @param array           $args   Refund arguments.
	 */
	public function update_metata_of_hand_refund( $refund, $args ) {
		if ( ! $args['refund_payment'] ) {
			return;
		}

		$order = wc_get_order( $refund->get_parent_id() );
		if ( $order->get_payment_method() !== $this->id ) {
			return;
		}

		$refund->update_meta_data( '_yandex_pay_and_split_refund_via_gateway', true );
	}

	/**
	 * The router for receiving webhook requests
	 *
	 * @return array
	 */
	public function webhook() {
		$body = sanitize_text_field( wp_unslash( file_get_contents( 'php://input' ) ) );

		$validated_token = $this->api->validate_token( $body );

		if ( 'success' !== $validated_token['status'] ) {
			$response = rest_ensure_response(
				array(
					'status'     => 'fail',
					'reasonCode' => 'FORBIDDEN',
					'reason'     => $validated_token['message'],
				)
			);
			$response->set_status( 403 );

			return $response;
		}

		$new_order_status = '';

		if ( 'ORDER_STATUS_UPDATED' === $validated_token['payload']['event'] ) {
			$ya_pay_order = $validated_token['payload']['order'];
			$order        = wc_get_order( $ya_pay_order['orderId'] );

			$new_order_status = '';

			switch ( $ya_pay_order['paymentStatus'] ) {
				case 'CAPTURED':
					$new_order_status = $this->success_order_status;
					break;
				case 'FAILED':
					$new_order_status = $this->error_order_status;
					break;
				case 'REFUNDED':
					$new_order_status = $this->refund_order_status;
					break;
			}
		} elseif ( 'OPERATION_STATUS_UPDATED' === $validated_token['payload']['event'] ) {
			$ya_pay_operation = $validated_token['payload']['operation'];
			$order_id_parts   = explode( '.', $ya_pay_operation['orderId'] );
			$order            = wc_get_order( end( $order_id_parts ) );

			if ( 'REFUND' === $ya_pay_operation['operationType'] ) {

				switch ( $ya_pay_operation['status'] ) {
					case 'FAIL':
						$new_order_status = $this->error_refund_order_status;
						break;
				}
			}
		}

		if ( ! empty( $new_order_status ) ) {
			try {
				if ( $this->success_order_status === $new_order_status ) {
					do_action( 'woocommerce_pre_payment_complete', $order->get_id(), '' );

					if ( ! $order->get_date_paid( 'edit' ) ) {
						$order->set_date_paid( time() );
					}

					$order->update_status( $new_order_status );

					do_action( 'woocommerce_payment_complete', $order->get_id(), '' );
				} else {
					$order->update_status( $new_order_status );
				}
			} catch ( Exception $e ) {
				$this->logger->error(
					sprintf( 'Error changing status for order #%d', $order->get_id() ),
					array(
						'order'     => $order,
						'error'     => $e,
						'backtrace' => true,
					)
				);

				$order->add_order_note(
					__( 'Order status change event failed.', 'yandex-pay-and-split' ) .
						' ' .
						$e->getMessage()
				);

				$response = rest_ensure_response(
					array(
						'status'     => 'fail',
						'reasonCode' => 'OTHER',
						'reason'     => 'Order status change event failed. ' . $e->getMessage(),
					)
				);
				$response->set_status( 500 );

				return $response;
			}
		}

		return array(
			'status' => 'success',
		);
	}

	/**
	 * Checks whether the payment method can be enabled.
	 *
	 * Checks whether the merchant ID and API key are configured. Otherwise, it throws an exception and adds an error message.
	 *
	 * @return string The validated merchant ID value.
	 * @throws Exception If the merchant ID or API key are not configured.
	 */
	public function check_plugin_enabling_possibility() {
		return $this->needs_setup();
	}

	/**
	 * Validates the 'enabled' field for the Yandex Pay gateway method.
	 *
	 * Checks if the gateway needs setup and throws an exception if it does.
	 *
	 * @param string $key   The field key.
	 * @param mixed  $value The field value.
	 * @return mixed The validated field value.
	 * @throws Exception If the gateway needs setup and is enabled.
	 */
	public function validate_enabled_field( $key, $value ) {
		if ( $value && $this->check_plugin_enabling_possibility() ) {
			$expection = new Exception( __( 'Set up Yandex Pay gateway method first.', 'yandex-pay-and-split' ) );
			WC_Admin_Settings::add_error( $expection->getMessage() );
			throw $expection;
		}

		return $this->validate_checkbox_field( $key, $value );
	}

	/**
	 * Gets the total refunded quantity for a specific order item.
	 *
	 * @param WC_Order      $order The order containing the item.
	 * @param WC_Order_Item $item The order item to check for refunds.
	 * @return int The total quantity that has been refunded for the item.
	 */
	protected function get_qty_refunded_for_item( $order, $item ) {
		$qty = 0;
		foreach ( $this->get_refunds( $order ) as $refund ) {
			foreach ( $refund->get_items( $item->get_type() ) as $refunded_item ) {
				if ( absint( $refunded_item->get_meta( '_refunded_item_id' ) ) === $item->get_id() ) {
					$qty += $refunded_item->get_quantity();
				}
			}
		}
		return $qty * -1;
	}

	/**
	 * Calculates the total amount refunded for a specific order item.
	 *
	 * @param WC_Order      $order The order object containing the item.
	 * @param WC_Order_Item $item The order item to calculate the total refund for.
	 * @return float The total amount refunded for the item
	 */
	protected function get_total_refunded_for_item( $order, $item ) {
		$total = 0;
		foreach ( $this->get_refunds( $order ) as $refund ) {
			foreach ( $refund->get_items( $item->get_type() ) as $refunded_item ) {
				if ( absint( $refunded_item->get_meta( '_refunded_item_id' ) ) === $item->get_id() ) {
					$total += $refunded_item->get_total();
				}
			}
		}
		return $total * -1;
	}

	/**
	 * Retrieves refunds for the given order that were processed via Yandex Pay and Split.
	 *
	 * @param WC_Order $order The order to retrieve refunds for.
	 * @param bool     $only_processing If true, returns only refunds that haven't been processed by a payment gateway.
	 * @return array List of refunds matching the criteria.
	 */
	protected function get_refunds( $order, $only_processing = false ) {
		$refunds = array();
		foreach ( $order->get_refunds() as $refund ) {
			if ( $refund->get_meta( '_yandex_pay_and_split_refund_via_gateway', true ) && ( ! $only_processing || ! $refund->get_refunded_payment() ) ) {
				$refunds[] = $refund;
			}
		}
		return $refunds;
	}

	/**
	 * Retrieves the IDs of the items included in a refund, including both line items and shipping items.
	 *
	 * @param WC_Order_Refund $refund The refund object to extract items from.
	 * @return array An array of item IDs from the refund.
	 */
	protected function get_refunded_item_ids( $refund ) {
		return array_map(
			array( $this, 'get_order_item_id' ),
			array_values( $refund->get_items( array( 'line_item', 'shipping' ) ) )
		);
	}

	/**
	 * Generates a cart array containing remaining items and their quantities after considering refunds.
	 *
	 * @param WC_Order $order The order object to process.
	 * @return array An array of cart items, each with its remaining quantity, price, and product ID.
	 */
	protected function get_cart_with_refunds( $order ) {
		$cart_items = array();
		foreach ( $order->get_items( array( 'line_item', 'shipping' ) ) as $item ) {
			if ( $item->get_total() <= 0 ) {
				continue;
			}
			$product_id     = $this->get_order_item_id( $item );
			$refunded_total = $this->get_total_refunded_for_item( $order, $item );
			switch ( $item->get_type() ) {
				case 'line_item':
					$refunded_qty = $this->get_qty_refunded_for_item( $order, $item );
					break;
				case 'shipping':
					$refunded_qty = 0;
					break;
			}
			$remain_quantity = $item->get_quantity() - $refunded_qty;

			$result = array();
			if ( $remain_quantity > 0 ) {
				$remain_total = $item->get_total() - $refunded_total;
				$result       = array(
					'quantity' => $remain_quantity,
					'price'    => $remain_total / $remain_quantity,
				);
			} else {
				$result = array(
					'quantity' => 0,
				);
			}
			$result['productId'] = $product_id;

			$cart_items[ $product_id ] = $result;
		}
		return $cart_items;
	}

	/**
	 * Retrieves the order item ID based on its type and properties.
	 *
	 * @param WC_Order_Item $item The order item object to process.
	 * @return string|null The calculated order item ID or null if the item type is not recognized.
	 */
	protected function get_order_item_id( $item ) {
		switch ( $item->get_type() ) {
			case 'line_item':
				return (string) ( $item->get_variation_id() ? $item->get_variation_id() : $item->get_product_id() );
			case 'shipping':
				return "shipping-{$item->get_instance_id()}";
		}
		return null;
	}

	/**
	 * Extracts and formats ordered items (products or shipping) from an order for payment processing.
	 *
	 * @param WC_Order_Item[] $order_items Array of WC_Order_Item objects to process.
	 * @return array Formatted cart items for payment gateway.
	 */
	protected function get_cart_items( $order_items ) {
		$cart_items = array();
		foreach ( $order_items as $item ) {
			if ( $item->get_total() <= 0 ) {
				continue;
			}

			$result = array(
				'quantity' => array(
					'count' => $item->get_quantity(),
				),
				'total'    => (string) $item->get_total(),
			);

			$typed_results = array();
			switch ( $item->get_type() ) {
				case 'shipping':
					$typed_results = array(
						'productId' => "shipping-{$item->get_instance_id()}",
						'title'     => $item->get_method_title(),
					);
					break;
				case 'line_item':
					$product       = $item->get_product();
					$typed_results = array(
						'productId'   => (string) ( $item->get_variation_id() ? $item->get_variation_id() : $item->get_product_id() ),
						'quantity'    => array(
							'available' => $product->get_stock_quantity(),
						),
						'title'       => $product->get_title(),
						'description' => $product->get_description(),
					);
					break;
			}
			$cart_items[ $typed_results['productId'] ] = array_merge_recursive( $result, $typed_results );
		}
		return $cart_items;
	}


	/**
	 * Retrieves the formatted shipping or billing address from the given order.
	 *
	 * If the order has a shipping address, it will be used; otherwise, the billing address is used.
	 *
	 * @param WC_Order $order The order to retrieve the address from.
	 * @return string The formatted address string containing country, city, and street addresses.
	 */
	protected function get_shipping_address( $order ) {
		$address      = $order->has_shipping_address() ? 'shipping' : 'billing';
		$address_data = $order->get_address( $address );

		return WC()->countries->countries[ $address_data['country'] ] .
				', ' .
				$address_data['city'] .
				', ' .
				$address_data['address_1'] .
				' ' .
				$address_data['address_2'];
	}
}
