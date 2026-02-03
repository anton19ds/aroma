<?php
/**
 * Yandex Split Payment Gateway
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

namespace YandexPay\Lib;

/**
 * Logger lib class
 */
class Logger {

	/**
	 * Instance of logger
	 *
	 * @var WC_Logger
	 */
	private $logger;

	/**
	 * Contruct of Logger instance
	 *
	 * @param WC_Logger $logger instance of logger.
	 */
	public function __construct( $logger ) {
		$this->logger = $logger;
	}

	/**
	 * Initialize of WC logger instance
	 */
	/**
	 * Logging Errors
	 *
	 * @param string $message message for log.
	 * @param array  $context context for log.
	 */
	public function error( $message, $context = array() ) {
		$this->logger->error( $message, $context );
	}
}
