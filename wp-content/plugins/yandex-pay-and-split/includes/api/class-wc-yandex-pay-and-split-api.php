<?php
/**
 * Yandex Pay And Split Api
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

/**
 * WooCommerce Yandex Pay Api class
 */
class WC_Yandex_Pay_And_Split_Api {

	/**
	 * Yandex pay endpoint url
	 *
	 * @var string
	 */
	private const PAY_URL = 'https://pay.yandex.ru/';

	/**
	 * Sandbox endpoint url
	 *
	 * @var string
	 */
	private const SANDBOX_URL = 'https://sandbox.pay.yandex.ru/';

	/**
	 * Yandex pay endpoint url
	 *
	 * @var string
	 */
	private $url;

	/**
	 * Merchant id
	 *
	 * @var string
	 */
	private $merchant_id;

	/**
	 * Api key
	 *
	 * @var string
	 */
	private $api_key;

	/**
	 * WC_Yandex_Pay_And_Split_Api constructor.
	 *
	 * @param string $url Yandex pay endpoint url.
	 * @param string $merchant_id Merchant id.
	 * @param string $api_key Api key.
	 */
	public function __construct( $url, $merchant_id, $api_key ) {
		$this->url         = $url;
		$this->merchant_id = $merchant_id;
		$this->api_key     = $api_key;
	}


	/**
	 * Returns the yandex pay domain
	 *
	 * @return string
	 */
	public static function get_yandex_pay_url() {
		return static::PAY_URL;
	}

	/**
	 * Returns the yandex pay domain
	 *
	 * @return string
	 */
	public static function get_sandbox_url() {
		return static::SANDBOX_URL;
	}

	/**
	 * Validate merchant api request token
	 *
	 * @param string $token JWT token.
	 *
	 * @return array
	 */
	public function validate_token( $token ) {
		if ( ! isset( $token ) ) {
			return array(
				'status'  => 'fail',
				'message' => 'No JWT',
			);
		}

		$response = wp_remote_get( $this->get_url( 'api/jwks' ) );

		if ( ! is_wp_error( $response ) ) {
			$keys_data = json_decode( wp_remote_retrieve_body( $response ), true );

			try {
				$keys    = YandexPayAndSplit\JWT\JWK::parseJWKSet( $keys_data );
				$payload = YandexPayAndSplit\JWT\JWT::decode( $token, $keys );
			} catch ( \Exception $e ) {
				return array(
					'status'  => 'fail',
					'message' => $e->getMessage(),
				);
			}

            // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			if ( $payload->merchantId === $this->merchant_id ) {
				return array(
					'status'  => 'success',
					'payload' => json_decode( wp_json_encode( $payload ), true ),
				);
			} else {
				return array(
					'status'  => 'fail',
					'message' => 'Merchant id incorrect',
				);
			}
		} else {
			return array(
				'status'  => 'fail',
				'message' => "Couldn\'t connect to the Yandex Pay api",
			);
		}
	}

	/**
	 * Sends a request to create a new order via the Yandex Pay and Split API.
	 *
	 * @param array $payload The data payload to be sent in the request body, typically containing order details.
	 * @return array|WP_Error The response from the remote API, or a WP_Error object if the request fails.
	 */
	public function create_order( $payload ) {
		return wp_remote_post(
			$this->get_url( 'api/merchant/v1/orders' ),
			array(
				'headers' => $this->get_base_headers(),
				'body'    => wp_json_encode( $payload ),
			)
		);
	}

	/**
	 * Process a refund for a specified order via the payment gateway.
	 *
	 * @param int   $operation_id Unique identifier for the refund operation.
	 * @param int   $order_id The ID of the order being refunded.
	 * @param float $amount The amount to be refunded.
	 * @param array $items List of items included in the refund. Each item must contain 'productId', optionally 'quantity', and 'price'.
	 * @return array|WP_Error The response from the remote API or a WP_Error if the request fails.
	 */
	public function refund_order( $operation_id, $order_id, $amount, $items ) {

		$payload = array(
			'targetCart'          => array(
				'items' => array_map(
					static function ( $item ) {
						$data = array(
							'productId' => (string) $item['productId'],
						);
						if ( isset( $item['quantity'] ) ) {
							$data['quantityCount'] = (string) $item['quantity'];
						}
						if ( isset( $item['price'] ) ) {
							$data['price'] = (string) $item['price'];
						}
						return $data;
					},
					$items
				),
			),
			'refundAmount'        => $amount,
			'externalOperationId' => (string) $operation_id,
		);

		return wp_remote_post(
			$this->get_url( "api/merchant/v2/orders/{$order_id}/refund" ),
			array(
				'headers' => $this->get_base_headers(),
				'body'    => wp_json_encode( $payload ),
			)
		);
	}

	/**
	 * Constructs the full URL by appending a route to the base URL.
	 *
	 * @param string $route The API route to append to the base URL.
	 * @return string The complete URL formed by combining the base URL and the provided route.
	 */
	private function get_url( $route ) {
		return $this->url . $route;
	}

	/**
	 * Retrieves the base HTTP headers to be used in API requests.
	 *
	 * @return array An associative array containing the default headers
	 */
	private function get_base_headers() {
		return array(
			'Content-Type'  => 'application/json',
			'Authorization' => 'Api-key ' . $this->api_key,
		);
	}
}
