<?php

class QodeEssentialAddons_Admin_Notice {
	private static $instance;

	public $plugin_slug = 'qode-essential-addons';

	public $plugin_name = 'Qode Essential Addons';


	function __construct() {

		// Include scripts for plugin notice
		add_action( 'admin_enqueue_scripts', array( $this, 'register_script' ) );

		// Add plugin deactivation notice
		add_action( 'current_screen', array( $this, 'add_deactivation_notice' ) );

		// Function that handles plugin notice
		add_action( 'wp_ajax_qode_essential_addons_deactivation', array( $this, 'handle_deactivation' ) );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function register_script() {
		wp_register_script( 'qode-essential-addons-notice', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-notice/assets/js/admin-notice.min.js', array( 'jquery' ), false, false );
		wp_register_style( 'qode-essential-addons-notice', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-notice/assets/css/admin-notice.min.css' );
	}

	public function add_deactivation_notice() {
		if ( ! $this->is_plugins_screen() ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'load_deactivation_module' ) );
	}

	public function load_deactivation_module() {
		add_action( 'admin_footer', array( $this, 'print_deactivation_form' ) );

		wp_enqueue_script( 'qode-essential-addons-notice' );
		wp_enqueue_style( 'qode-essential-addons-notice' );
	}

	public function print_deactivation_form() {
		$params['plugin_slug'] = str_replace( '-', '_', $this->plugin_slug );
		$params['plugin_name'] = $this->plugin_name;

		qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-notice', 'templates/admin-deactivation-form', '', $params );
	}

	private function is_plugins_screen() {
		return in_array( get_current_screen()->id, array( 'plugins', 'plugins-network' ) );
	}

	public function handle_deactivation() {
		check_ajax_referer( 'qode-essential-addons-deactivation-nonce', 'nonce' );

		$data = array(
			'plugin' => $this->plugin_slug,
			'site_lang' => get_bloginfo( 'language' ),
			'reason' => $_POST['reason'],
			'reason_additional_info' => $_POST['additionalInfo'],
			'date' => date( 'Y-m-d H:i:s' )
		);

        $request_handler_url = 'https://api.qodeinteractive.com/plugin-deactivation-feedback.php';

		$response = wp_remote_post(
			$request_handler_url,
			array(
				'body' => $data,
			)
		);

		$response_body = json_decode( wp_remote_retrieve_body( $response ) );

		if ( $response_body->success ) {
			qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Thank you for the feedback!', 'qode-essential-addons' ) );
		} else {
			qode_essential_addons_framework_get_ajax_status( 'fail', esc_html__( 'Something went wrong with sending feedback.', 'qode-essential-addons' ) );
		}
	}
}

QodeEssentialAddons_Admin_Notice::get_instance();
