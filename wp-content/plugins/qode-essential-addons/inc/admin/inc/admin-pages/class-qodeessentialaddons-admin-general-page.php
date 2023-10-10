<?php

if ( ! class_exists( 'QodeEssentialAddons_Admin_General_Page' ) ) {
	class QodeEssentialAddons_Admin_General_Page {

		private static $instance;
		private $menu_name;
		private $menu_title;
		private $sub_pages;
		private $transient;

		function __construct() {

			$this->menu_name  = QODE_ESSENTIAL_ADDONS_GENERAL_MENU_NAME;
			$this->menu_title = esc_html__( 'Qode Essential Addons', 'qode-essential-addons' );
//			$this->transient = 'qode_essential_addons_set_redirect';

			add_action( 'init', array( $this, 'register_sub_pages' ) ); // action is init because of shortcode register on init - 0
			add_action( 'admin_menu', array( $this, 'dashboard_add_page' ) );

			add_filter( 'admin_body_class', array( $this, 'add_admin_body_classes' ) );

		}

		/**
		 * @return QodeEssentialAddons_Admin_General_Page
		 */
		public static function get_instance() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function set_sub_pages( QodeEssentialAddons_Admin_Sub_Pages $sub_page ) {
			$this->sub_pages[ $sub_page->get_position() ] = $sub_page;
		}

		function get_sub_pages() {
			return $this->sub_pages;
		}

		function get_menu_name() {
			return $this->menu_name;
		}

		function get_menu_title() {
			return $this->menu_title;
		}

		function dashboard_add_page() {

			$page = add_menu_page(
				$this->get_menu_title(),
				$this->get_menu_title(),
				'edit_theme_options',
				$this->get_menu_name(),
				null,
				QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/common/modules/admin/assets/img/admin-logo-icon.png',
				998
			);

			add_action( 'load-' . $page, array( $this, 'load_admin_css' ) );

			$subpages_array = $this->get_sub_pages();

			ksort( $subpages_array );
			foreach ( $subpages_array as $sub_page => $sub_page_value ) {

				$sub_page_instance = add_submenu_page(
					$this->get_menu_name(),
					$sub_page_value->get_title(),
					$sub_page_value->get_title(),
					'edit_theme_options',
					$sub_page_value->get_menu_name(),
					array( $sub_page_value, 'render' ),
					$sub_page_value->get_position()
				);

				add_action( 'load-' . $sub_page_instance, array( $this, 'load_admin_css' ) );
			}
		}

		function get_header( $object = null ) {

			$object = ! empty( $object ) ? $object : $this;

			$args = array(
				'menu_slug'  => $object->get_menu_name(),
				'menu_title' => $object->get_title(),
				'menu_url'   => admin_url( 'admin.php?page=' . $this->get_menu_name() ),
			);

			qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'templates/header', '', $args );
		}

		function get_footer() {
			qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'templates/footer' );
		}

		function get_sidebar() {
			qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'templates/sidebar' );
		}

		function get_content() {

			$args = array();
			qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'templates/general', '', $args );
		}

		function render() {

			$args                = array();
			$args['this_object'] = $this;
			qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'templates/holder', '', $args );
		}

		function register_sub_pages() {
			$sub_pages = apply_filters( 'qode_essential_addons_filter_add_sub_page', $sub_pages = array() );

			if ( ! empty( $sub_pages ) ) {
				foreach ( $sub_pages as $sub_page ) {
					$sub_object = new $sub_page();
					$this->set_sub_pages( $sub_object );
				}
			}
		}

		function load_admin_css() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		function enqueue_styles() {
			wp_enqueue_style( 'qode-essential-addons-dashboard-style', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-pages/assets/css/dashboard.min.css' );
		}

		function enqueue_scripts() {
			wp_enqueue_script( 'qode-essential-addons-framework-script', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-pages/assets/js/dashboard.min.js', array( 'jquery' ), false, true );

			do_action( 'qode_essential_addons_action_additional_scripts' );

		}

		function add_admin_body_classes( $classes ) {

			$pages = $this->get_all_dashboard_names();

			if ( isset( $_GET['page'] ) && in_array( $_GET['page'], $pages, true ) ) {
				$classes = $classes . ' qodef-qode-essential-addons';
			}

			return $classes;
		}


		function get_all_dashboard_names() {

			$pages = array(
				$this->get_menu_name(),
			);

			foreach ( $this->sub_pages as $sub_page ) {
				$pages[] = $sub_page->get_menu_name();
			}

			return $pages;
		}


	}
}

QodeEssentialAddons_Admin_General_Page::get_instance();
