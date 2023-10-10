<?php

if ( ! function_exists( 'qode_essential_addons_add_import_sub_page_to_list' ) ) {
	/**
	 * Function that add additional sub page item into general page list
	 *
	 * @param array $sub_pages
	 *
	 * @return array
	 */
	function qode_essential_addons_add_import_sub_page_to_list( $sub_pages ) {

		$demos = qode_essential_addons_demos_list();
		if ( ! empty( $demos ) ) {
			$sub_pages[] = 'QodeEssentialAddons_Admin_Page_Import';
		}

		return $sub_pages;
	}

	add_filter( 'qode_essential_addons_filter_add_sub_page', 'qode_essential_addons_add_import_sub_page_to_list' );
}

if ( class_exists( 'QodeEssentialAddons_Admin_Sub_Pages' ) ) {
	class QodeEssentialAddons_Admin_Page_Import extends QodeEssentialAddons_Admin_Sub_Pages {


		public function __construct() {

			parent::__construct();

			add_action( 'qode_essential_addons_action_additional_scripts', array( $this, 'set_additional_scripts' ) );
			add_action( 'wp_ajax_open_demo_single', array( $this, 'open_demo_single' ) );
			add_action( 'wp_ajax_qode_essential_addons_reload_demo_import', array( $this, 'reload_demo_import' ) );
			add_filter( 'admin_body_class', array( $this, 'add_admin_body_classes' ) );

		}

		function add_sub_page() {
			$this->set_base( 'import' );
			$this->set_menu_name( 'qode_essential_addons_import_menu' );
			$this->set_title( esc_html__( 'Import', 'qode-essential-addons' ) );
			$this->set_position( 10 );
		}

		function render() {
			$args                   = $this->get_atts();
			$args['this_object']    = $this;
			$args['holder_classes'] = isset( $_GET['demo-id'] ) ? 'qodef-demo-import-single-opened' : '';
			qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/holder', '', $args );
		}

		function generate_import_list_params() {
			$params                    = array();
			$params['import_title']    = esc_html__( 'Find a Qi demo you wish to import', 'qode-essential-addons' );
			$params['demos']           = qode_essential_addons_demos_list();
			$params['categories']      = qode_essential_addons_demos_list( 'categories' );
			$params['colors']          = qode_essential_addons_demos_list( 'colors' );
			$params['filters']         = $this->filter_list();
			$params['this_object']     = $this;
			$params['page_name']       = $this->get_menu_name();
			$params['enabled_premium'] = apply_filters( 'qode_essential_addons_filter_enabled_premium_plugin', false );
			$params['single_demo']     = isset( $_GET['demo-id'] ) ? $params['demos'][ $_GET['demo-id'] ] : '';
			$params['single_demo_id']  = isset( $_GET['demo-id'] ) ? $_GET['demo-id'] : '';
			$params['content_files']   = isset( $_GET['demo-id'] ) ? $this->count_files( $params['demos'][ $_GET['demo-id'] ] ) : '';

			return $params;
		}

		function get_content() {
			$params = $this->generate_import_list_params();
			qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/content', 'demos', $params );
		}

		function set_additional_scripts() {
			if ( isset( $_GET['page'] ) && $_GET['page'] === $this->get_menu_name() ) {
				wp_enqueue_style( 'swiper', QODE_ESSENTIAL_ADDONS_URL_PATH . '/assets/plugins/swiper/swiper.min.css' );
				wp_enqueue_script( 'isotope', QODE_ESSENTIAL_ADDONS_INC_URL_PATH . '/masonry/assets/js/plugins/isotope.pkgd.min.js', array( 'jquery' ), false, true );
				wp_enqueue_script( 'packery', QODE_ESSENTIAL_ADDONS_INC_URL_PATH . '/masonry/assets/js/plugins/packery-mode.pkgd.min.js', array( 'jquery' ), false, true );
				wp_enqueue_script( 'swiper', QODE_ESSENTIAL_ADDONS_URL_PATH . '/assets/plugins/swiper/swiper.min.js', array( 'jquery' ), false, true );
				wp_enqueue_script( 'easyautocomplete', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/common/assets/plugins/easyautocomplete/jquery.easy-autocomplete.min.js', array( 'jquery' ), false, true );
				wp_enqueue_script( 'qodef-qode-essential-addons-import', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-pages/sub-pages/import/assets/js/import.js', array( 'jquery' ), false, true );
				wp_enqueue_style( 'select2', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/common/assets/plugins/select2/select2.min.css' );
				wp_enqueue_script( 'select2', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/common/assets/plugins/select2/select2.full.min.js', array(), false, true );

				wp_localize_script(
					'qodef-qode-essential-addons-import',
					'qodefAdminImport',
					array(
						'vars' => apply_filters( 'qode_essential_addons_filter_localize_import_js', array() ),
					)
				);
			}
		}

		function add_admin_body_classes( $classes ) {
			if ( isset( $_GET['page'] ) && strpos( $_GET['page'], $this->get_menu_name() ) !== false ) {
				$classes = $classes . ' qodef-framework-admin';
			}

			return $classes;
		}

		function render_filter() {
			$params                = array();
			$params['this_object'] = $this;
			$params['filters']     = $this->filter_list();

			qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH, 'inc/import', 'templates/filter', '', $params );
		}

		function filter_list() {

			$demos       = qode_essential_addons_demos_list();
			$filter_list = array();

			foreach ( $demos as $demo ) {

				if ( isset( $demo['demo_filters'] ) && is_array( $demo['demo_filters'] ) ) {

					foreach ( $demo['demo_filters'] as $filter ) {
						if ( ! in_array( $filter, $filter_list, true ) ) {
							$filter_list[] = $filter;
						}
					}
				}
			}

			return $filter_list;
		}

		function open_demo_single() {
			if ( isset( $_POST ) && ! empty( $_POST ) && '' !== $_POST['demoId'] ) {
				check_ajax_referer( 'qode_essential_addons_demo_import_nonce', 'nonce' );
				$demo_id = $_POST['demoId'];
				$args    = array(
					'demo_id' => $demo_id,
				);

				if ( '' !== $demo_id ) {
					$demos                 = qode_essential_addons_demos_list();
					$demo                  = $demos[ $demo_id ];
					$args['demo']          = $demo;
					$args['demo_key']      = $demo_id;
					$args['content_files'] = $this->count_files( $demos[ $demo_id ] );
					$html                  = qode_essential_addons_framework_get_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/content-single', '', $args );

					qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Demo Opened', 'qode-essential-addons' ), $html );
				}
			}

			wp_die();
		}

		function count_files( $demo ) {

			$files         = array();
			$content_files = 0;
			$other_files   = 0;

			if ( isset( $demo['demo_file_url'] ) ) {

				//posts + terms from xml file
				$content_files += 2;

				//attachments from xml file
				$chunk_files    = QodeEssentialAddons_Framework_Import_General::get_instance()->get_chunk_number();
				$content_files += $chunk_files;
			}
			if ( isset( $demo['demo_widgets_file_url'] ) ) {
				$other_files += 1;
			}
			if ( isset( $demo['demo_settings_page_file_url'] ) ) {
				$other_files += 1;
			}
			if ( isset( $demo['demo_menu_settings_file_url'] ) ) {
				$other_files += 1;
			}
			if ( isset( $demo['demo_import_options'] ) ) {
				$other_files += 1;
			}

			$files['content_files'] = $content_files;
			$files['other_files']   = $other_files;

			return $files;

		}

		function reload_demo_import() {
			check_ajax_referer( 'qode_essential_addons_reload_demo_import', 'nonce' );

			$transients = apply_filters( 'qode_essential_addons_filter_demos_transients', array( 'qode_essential_addons_demos_list_' . str_replace( '.', '_', QODE_ESSENTIAL_ADDONS_VERSION ) ) );

			if ( is_array( $transients ) && count( $transients ) ) {
				foreach ( $transients as $transient_name ) {
					delete_transient( $transient_name );
				}
			}

			$params = $this->generate_import_list_params();

			$html = qode_essential_addons_framework_get_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/demos-import-list', '', $params );

			qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Demos Reloaded', 'qode-essential-addons' ), $html );

			wp_die();
		}

	}
}
