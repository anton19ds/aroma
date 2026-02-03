<?php
/**
 * Yandex Pay And Split Admin Settings
 *
 * @author ООО «Яндекс»
 * @copyright (C) 2000 - 2025 Yandex LLC
 * @version 1.1.2
 *
 * @package WooCommerce\Classes\Payment
 */

// phpcs:disable WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended

namespace YandexPay\Settings;

defined( 'ABSPATH' ) || exit();

/**
 * WooCommerce Yandex Pay And Split Admin Settings class
 */
class WC_Yandex_Pay_Admin_Settings {

	private const OPTIONS_NAME = 'woocommerce_' . YANDEX_PAY_AND_SPLIT_PLUGIN_CARD_GATEWAY_ID . '_settings';

	/**
	 * Current active tab
	 *
	 * @var string
	 */
	private static $current_tab = 'general';

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	/**
	 * Add admin menu under WooCommerce
	 */
	public function add_admin_menu() {
		add_submenu_page(
			'woocommerce',
			esc_html__( 'Yandex Pay and Split Settings', 'yandex-pay-and-split' ),
			esc_html__( 'Yandex Pay and Split', 'yandex-pay-and-split' ),
			'manage_woocommerce', // phpcs:ignore WordPress.WP.Capabilities.Unknown
			'yandex-pay-settings',
			array( $this, 'settings_page' )
		);
	}

	/**
	 * Admin initialization
	 */
	public function admin_init() {
		self::$current_tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'general';

		if ( isset( $_GET['page'] ) && 'yandex-pay-settings' === $_GET['page'] ) {
			$this->handle_form_submission();
		}
	}

	/**
	 * Handle form submission
	 */
	private function handle_form_submission() {
		if ( isset( $_POST['submit'] ) && isset( $_POST['yandex_pay_settings_nonce'] ) ) {
			if ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['yandex_pay_settings_nonce'] ) ), 'yandex_pay_settings' ) ) {
				$this->save_settings();
			}
		}
	}

	/**
	 * Get current settings from database
	 *
	 * @return array
	 */
	private function get_current_settings() {
		$options = get_option( self::OPTIONS_NAME, array() );
		return is_array( $options ) ? $options : array();
	}

	/**
	 * Save settings to database
	 */
	private function save_settings() {
		$current_settings = $this->get_current_settings();
		$tab              = self::$current_tab;

		$new_settings = array();
		$errors       = array();

		foreach ( $this->get_tab_fields( $tab ) as $field_key => $field ) {
			if ( isset( $_POST[ $field_key ] ) ) {
				$value = sanitize_text_field( wp_unslash( $_POST[ $field_key ] ) );
				if ( 'checkbox' === $field['type'] ) {
					$value = '1' === $value ? 'yes' : 'no';
				}

				$validation_error = $this->validate_field( $field_key, $value );
				if ( $validation_error ) {
					$errors[] = $validation_error;
				}

				$new_settings[ $field_key ] = $value;
			} elseif ( isset( $field['type'] ) && 'checkbox' === $field['type'] ) {
				$new_settings[ $field_key ] = 'no';
			}
		}

		if ( ! empty( $errors ) ) {
			add_action(
				'admin_notices',
				function () use ( $errors ) {
					foreach ( $errors as $error ) {
						echo '<div class="notice notice-error is-dismissible"><p>' .
						esc_html( $error ) .
						'</p></div>';
					}
				}
			);
			return;
		}

		$updated_settings = array_merge( $current_settings, $new_settings );
		update_option( self::OPTIONS_NAME, $updated_settings );

		add_action(
			'admin_notices',
			function () {
				echo '<div class="notice notice-success is-dismissible"><p>' .
				esc_html__( 'Settings saved successfully!', 'yandex-pay-and-split' ) .
				'</p></div>';
			}
		);
	}

	/**
	 * Validate individual field values
	 *
	 * @param string $field_key The field key.
	 * @param string $value The field value.
	 * @return string|false Error message or false if valid
	 */
	private function validate_field( $field_key, $value ) {
		switch ( $field_key ) {
			case 'merchant_id':
				if ( empty( $value ) ) {
					return __( 'Merchant id should be filled.', 'yandex-pay-and-split' );
				}
				break;

			case 'api_key':
				if ( empty( $value ) ) {
					return __( 'Api key should be filled.', 'yandex-pay-and-split' );
				}
				break;
		}

		return false;
	}

	/**
	 * Get fields for specific tab
	 *
	 * @param string $tab Tab name.
	 * @return array
	 */
	private function get_tab_fields( $tab ) {
		switch ( $tab ) {
			case 'general':
				return $this->get_general_fields();
			case 'badges':
				return $this->get_badges_fields();
			case 'widgets':
				return $this->get_widgets_fields();
			default:
				return array();
		}
	}

	/**
	 * Prepare order status options with correct keys (without 'wc-' prefix)
	 *
	 * @return array
	 */
	private function prepare_order_status_options() {
		$raw_statuses = wc_get_order_statuses();
		return array_combine(
			array_map(
				static function ( $key ) {
					return substr( $key, strlen( 'wc-' ) );
				},
				array_keys( $raw_statuses )
			),
			array_values( $raw_statuses )
		);
	}

	/**
	 * Get General tab fields
	 *
	 * @return array
	 */
	private function get_general_fields() {
		$order_status_options = $this->prepare_order_status_options();

		$general_settings = include YANDEX_PAY_AND_SPLIT_PLUGIN_DIR . '/includes/payment-methods/general-settings.php';
		return $general_settings;
	}

	/**
	 * Get Badges tab fields
	 *
	 * @return array
	 */
	private function get_badges_fields() {
		$badges_settings = include YANDEX_PAY_AND_SPLIT_PLUGIN_DIR . '/includes/payment-methods/badges-settings.php';
		return $badges_settings;
	}

	/**
	 * Get Widgets tab fields
	 *
	 * @return array
	 */
	private function get_widgets_fields() {
		$widget_settings = include YANDEX_PAY_AND_SPLIT_PLUGIN_DIR . '/includes/payment-methods/widget-settings.php';
		return $widget_settings;
	}

	/**
	 * Render settings page
	 */
	public function settings_page() {
		$current_settings = $this->get_current_settings();
		$tabs             = array(
			'general' => __( 'General', 'yandex-pay-and-split' ),
			'badges'  => __( 'Badge Settings', 'yandex-pay-and-split' ),
			'widgets' => __( 'Widget Settings', 'yandex-pay-and-split' ),
		);
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<!-- Tabs Navigation -->
			<nav class="nav-tab-wrapper">
				<?php foreach ( $tabs as $tab_key => $tab_title ) : ?>
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=yandex-pay-settings&tab=' . $tab_key ) ); ?>"
						class="nav-tab <?php echo ( self::$current_tab === $tab_key ) ? 'nav-tab-active' : ''; ?>">
						<?php echo esc_html( $tab_title ); ?>
					</a>
				<?php endforeach; ?>
			</nav>

			<!-- Settings Form -->
			<div class="tab-content">
				<form method="post" action="<?php echo esc_url( admin_url( 'admin.php?page=yandex-pay-settings&tab=' . self::$current_tab ) ); ?>">
					<?php wp_nonce_field( 'yandex_pay_settings', 'yandex_pay_settings_nonce' ); ?>

					<table class="form-table">
						<?php $this->render_fields( $this->get_tab_fields( self::$current_tab ), $current_settings ); ?>
					</table>

					<?php submit_button(); ?>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Render form fields
	 *
	 * @param array $fields Fields to render.
	 * @param array $current_settings Current settings values.
	 */
	private function render_fields( $fields, $current_settings ) {
		foreach ( $fields as $field_key => $field ) {
			$current_value = isset( $current_settings[ $field_key ] ) ? $current_settings[ $field_key ] : ( $field['default'] ?? '' );

			switch ( $field['type'] ) {
				case 'title':
					?>
					<tr>
						<th colspan="2">
							<h3><?php echo esc_html( $field['title'] ); ?></h3>
						</th>
					</tr>
					<?php
					break;

				case 'text':
				case 'number':
					?>
					<tr>
						<th scope="row">
							<label for="<?php echo esc_attr( $field_key ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
						</th>
						<td>
							<input
								type="<?php echo esc_attr( $field['type'] ); ?>"
								id="<?php echo esc_attr( $field_key ); ?>"
								name="<?php echo esc_attr( $field_key ); ?>"
								value="<?php echo esc_attr( $current_value ); ?>"
								placeholder="<?php echo esc_attr( $field['placeholder'] ?? '' ); ?>"
								style="<?php echo esc_attr( $field['css'] ?? '' ); ?>"
								<?php if ( isset( $field['custom_attributes'] ) ) : ?>
									<?php foreach ( $field['custom_attributes'] as $attr_key => $attr_value ) : ?>
										<?php echo esc_attr( $attr_key ) . '="' . esc_attr( $attr_value ) . '"'; ?>
									<?php endforeach; ?>
								<?php endif; ?>
							/>
							<?php if ( isset( $field['description'] ) ) : ?>
								<p class="description"><?php echo esc_html( $field['description'] ); ?></p>
							<?php endif; ?>
						</td>
					</tr>
					<?php
					break;

				case 'checkbox':
					?>
					<tr>
						<th scope="row"><?php echo esc_html( $field['title'] ); ?></th>
						<td>
							<label>
								<input
									type="checkbox"
									id="<?php echo esc_attr( $field_key ); ?>"
									name="<?php echo esc_attr( $field_key ); ?>"
									value="1"
									<?php checked( $current_value, 'yes' ); ?>
								/>
								<?php echo esc_html( $field['label'] ?? '' ); ?>
							</label>
							<?php if ( isset( $field['description'] ) ) : ?>
								<p class="description"><?php echo esc_html( $field['description'] ); ?></p>
							<?php endif; ?>
						</td>
					</tr>
					<?php
					break;

				case 'select':
					?>
					<tr>
						<th scope="row">
							<label for="<?php echo esc_attr( $field_key ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
						</th>
						<td>
							<select id="<?php echo esc_attr( $field_key ); ?>" name="<?php echo esc_attr( $field_key ); ?>">
								<?php foreach ( $field['options'] as $option_key => $option_title ) : ?>
									<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $current_value, $option_key ); ?>>
										<?php echo esc_html( $option_title ); ?>
									</option>
								<?php endforeach; ?>
							</select>
							<?php if ( isset( $field['description'] ) ) : ?>
								<p class="description"><?php echo esc_html( $field['description'] ); ?></p>
							<?php endif; ?>
						</td>
					</tr>
					<?php
					break;
			}
		}
	}
}
