<?php
/**
 * Yandex Pay Payment Gateway
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

// phpcs:disable WordPress.Security.NonceVerification.Missing

namespace YandexPay\Assets;

/**
 * Yandex pay assets abstract class
 */
abstract class WC_Yandex_Pay_Assets_Base {

	/**
	 * Asset url prefix
	 */
	public const ASSET_PREFIX = YANDEX_PAY_AND_SPLIT_ASSETS_PREFIX;
	/**
	 * Local assets url
	 */
	public const LOCAL_ASSETS_URL = YANDEX_PAY_AND_SPLIT_PLUGIN_URL;
	/**
	 * Plugin assets version
	 */
	public const VERSION = YANDEX_PAY_AND_SPLIT_PLUGIN_VERSION;

	/**
	 * Registered scripts
	 *
	 * @var array
	 */
	private $scripts = array();
	/**
	 * Registered inline scripts
	 *
	 * @var array
	 */
	private $inline_scripts = array();

	/**
	 * Registered styles
	 *
	 * @var array
	 */
	private $styles = array();

	/**
	 * WC_Yandex_Pay_Assets constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 15 );
	}

	/**
	 * Registers a script for use in the WordPress admin.
	 *
	 * @param string       $handle Name of the script. Should be unique.
	 * @param string       $src    Full URL of the script, or path of the script relative to the WordPress root directory.
	 * @param array        $deps   An array of handles of scripts that this script depends on. Default is an empty array.
	 * @param string|bool  $ver    String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes.
	 *                             If version is set to false, a version number is automatically added equal to current installed WordPress version.
	 *                             If set to null, no version is added.
	 * @param array|string $args   Additional arguments for the script tag. Can be used to set attributes like 'async' or 'defer'.
	 */
	public function register_script( $handle, $src, $deps = array(), $ver = false, $args = array() ) {
		$this->add_script( $this->get_script_handle( $handle ), $src, $deps, $ver, $args );
	}

	/**
	 * Registers a local script with the WordPress script loader.
	 *
	 * @param string       $handle Name of the script. Should be unique.
	 * @param string       $src    Path to the script relative to the local assets URL.
	 * @param array        $deps   An array of registered script handles this script depends on.
	 * @param array|string $args   Additional arguments for the script tag.
	 */
	public function register_local_script( $handle, $src = '', $deps = array(), $args = array() ) {
		$this->register_script( $handle, static::LOCAL_ASSETS_URL . '/assets/js/' . $src, $deps, self::VERSION, $args );
	}

	/**
	 * Registers a style sheet.
	 *
	 * @param string       $handle Name of the style. Should be unique.
	 * @param string       $src    Full URL of the style, or path of the style relative to the WordPress root directory.
	 * @param array|string $deps   An array of handles of styles that this style depends on. Default is an empty array.
	 * @param string|bool  $ver    String specifying style version number, if it has one, which is added to the URL as a query string for cache busting purposes.
	 *                             If version is set to false, a version number is automatically added equal to current installed WordPress version.
	 *                             If set to null, no version is added.
	 * @param string       $media  The media for which this stylesheet has been defined.
	 *                             Accepts media types like 'all', 'print', and 'screen'.
	 */
	public function register_style( $handle, $src = '', $deps = array(), $ver = \false, $media = 'all' ) {
		$this->add_style( $this->get_script_handle( $handle ), $src, $deps, $ver, $media );
	}

	/**
	 * Registers a local style sheet with WordPress.
	 *
	 * @param string       $handle Name of the stylesheet. Should be unique.
	 * @param string       $src    Relative path to the CSS file from the local assets directory.
	 * @param array|string $deps   An array of handles of stylesheets that this stylesheet depends on.
	 * @param string       $media  Media for which this stylesheet has been defined.
	 */
	public function register_local_style( $handle, $src = '', $deps = array(), $media = 'all' ) {
		$this->register_style( $handle, static::LOCAL_ASSETS_URL . '/assets/css/' . $src, $deps, self::VERSION, $media );
	}

	/**
	 * Enqueues a script for use in the WordPress admin area.
	 *
	 * @param string       $handle Name of the script. Should be unique.
	 * @param string       $src    Full URL of the script, or path of the script relative to the WordPress root directory.
	 * @param array        $deps   An array of registered script handles this script depends on.
	 * @param string|bool  $ver    String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes.
	 *                             If version is set to false, a version number is automatically added equal to current installed WordPress version.
	 * @param array|string $args   Additional arguments for the script tag to add. Can be used to set attributes like 'async' or 'defer'.
	 */
	public function enqueue_script( $handle, $src = '', $deps = array(), $ver = false, $args = array() ) {
		$this->add_script( $this->get_script_handle( $handle ), $src, $deps, $ver, $args, true );
	}

	/**
	 * Enqueues a local script with the specified handle, source, dependencies, version, and arguments.
	 *
	 * @param string       $handle Name of the script. Should be unique.
	 * @param string       $src    Path to the script relative to the local assets URL. Defaults to an empty string.
	 * @param array|string $deps   An array of registered script handles this script depends on. Default is an empty array.
	 * @param array        $args   Additional arguments to pass to wp_enqueue_script. Default is an empty array.
	 */
	public function enqueue_local_script( $handle, $src = '', $deps = array(), $args = array() ) {
		$this->enqueue_script( $handle, empty( $src ) ? $src : static::LOCAL_ASSETS_URL . '/assets/js/' . $src, $deps, self::VERSION, $args );
	}

	/**
	 * Enqueues a CSS style.
	 *
	 * @param string      $handle Name of the stylesheet.
	 * @param string      $src    Path to the stylesheet from the root directory of WordPress.
	 * @param array       $deps   An array of handles of scripts that this script depends on.
	 * @param bool|string $ver    String specifying script version number, if it has one, which is added to the URL as a query string for cache busting.
	 * @param string      $media  The media for which this stylesheet has been defined.
	 */
	public function enqueue_style( $handle, $src = '', $deps = array(), $ver = \false, $media = 'all' ) {
		$this->add_style( $this->get_script_handle( $handle ), $src, $deps, $ver, $media, true );
	}

	/**
	 * Enqueues a local stylesheet.
	 *
	 * @param string       $handle Name of the stylesheet.
	 * @param string       $src    Path to the stylesheet relative to the assets directory. Defaults to an empty string.
	 * @param array|string $deps   An array of handles of scripts or stylesheets that this stylesheet depends on. Defaults to an empty array.
	 * @param string       $media  Media for which this stylesheet has been defined. Accepts media types like 'all', 'print', etc. Defaults to 'all'.
	 */
	public function enqueue_local_style( $handle, $src = '', $deps = array(), $media = 'all' ) {
		$this->enqueue_style( $handle, empty( $src ) ? $src : static::LOCAL_ASSETS_URL . '/assets/css/' . $src, $deps, $media );
	}

	/**
	 * Adds an inline script to be enqueued.
	 *
	 * @param string $handle   The handle of the script to which the inline script will be added.
	 * @param string $data     The inline script data to add.
	 * @param string $position The position to add the inline script ('before' or 'after'). Default is 'after'.
	 */
	public function add_inline_script( $handle, $data, $position = 'after' ) {
		$this->inline_scripts[] = array(
			'handle'   => $this->get_script_handle( $handle ),
			'data'     => $data,
			'position' => $position,
		);
	}

	/**
	 * Adds script data as inline JavaScript.
	 *
	 * @param string $handle The handle of the script to which data is being added.
	 * @param string $name   The name under which the data will be accessible in JavaScript.
	 * @param array  $data   The data to be added.
	 */
	public function add_script_data( $handle, $name, $data ) {
		$json = wp_json_encode( $data );
		$this->add_inline_script( $handle, "var {$this->get_script_handle($name)} = $json;", 'before' );
	}

	/**
	 * Enqueues or registers scripts and styles based on the defined properties.
	 *
	 * Iterates over the scripts and styles arrays, enqueuing or registering each script/style.
	 */
	public function enqueue_scripts() {
		foreach ( $this->scripts as $script ) {
			call_user_func(
				$script['enqueue'] ? 'wp_enqueue_script' : 'wp_register_script',
				$script['handle'],
				$script['src'],
				$script['deps'],
				$script['ver'],
				$script['args']
			);
		}
		foreach ( $this->inline_scripts as $script ) {
			wp_add_inline_script( $script['handle'], $script['data'], $script['position'] );
		}
		foreach ( $this->styles as $style ) {
			call_user_func(
				$style['enqueue'] ? 'wp_enqueue_style' : 'wp_register_style',
				$style['handle'],
				$style['src'],
				$style['deps'],
				$style['ver'],
				$style['media']
			);
		}
	}

	/**
	 * Generates a script handle by prefixing it with the asset prefix.
	 *
	 * @param string $handle The original script handle.
	 * @return string The prefixed script handle.
	 */
	protected static function get_script_handle( $handle ) {
		return static::ASSET_PREFIX . '_' . $handle;
	}

	/**
	 * Adds a script to the list of scripts to be registered and optionally enqueued.
	 *
	 * @param string       $handle    Unique handle for the script.
	 * @param string       $src       Full URL to the script file.
	 * @param array|string $deps      Array of script handles this script depends on.
	 * @param string|bool  $ver       Script version number or false if no version.
	 * @param array        $args      Additional arguments for the script.
	 * @param bool         $enqueue   Whether to enqueue the script immediately.
	 */
	private function add_script( $handle, $src = '', $deps = array(), $ver = false, $args = array(), $enqueue = false ) {
		if ( array_key_exists( $handle, $this->scripts ) ) {
			$this->scripts[ $handle ]['enqueue'] = $enqueue;
			return;
		}
		$this->scripts[] = array(
			'handle'  => $handle,
			'src'     => $src,
			'deps'    => $deps,
			'ver'     => $ver,
			'args'    => $args,
			'enqueue' => $enqueue,
		);
	}

	/**
	 * Adds a stylesheet to the list of styles to be enqueued.
	 *
	 * @param string      $handle    Name of the stylesheet. Should be unique.
	 * @param string      $src       Path to the stylesheet from the root directory of WordPress.
	 * @param array       $deps      An array of registered stylesheet handles this stylesheet depends on.
	 * @param bool|string $ver       String specifying stylesheet version number, if it has one, which is added to the URL as a query string for cache busting purposes.
	 *                               If version is set to false, a version number is automatically added equal to current installed WordPress version.
	 * @param string      $media     The media for which this stylesheet has been defined.
	 * @param bool        $enqueue   Whether to enqueue the stylesheet immediately.
	 */
	private function add_style( $handle, $src = '', $deps = array(), $ver = \false, $media = 'all', $enqueue = false ) {
		if ( array_key_exists( $handle, $this->scripts ) ) {
			$this->styles[ $handle ]['enqueue'] = $enqueue;
			return;
		}
		$this->styles[] = array(
			'handle'  => $handle,
			'src'     => $src,
			'deps'    => $deps,
			'ver'     => $ver,
			'media'   => $media,
			'enqueue' => $enqueue,
		);
	}
}
