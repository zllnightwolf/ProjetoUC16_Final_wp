<?php

if ( ! class_exists( 'QodeEssentialAddons_Contact_Form_7' ) ) {
	class QodeEssentialAddons_Contact_Form_7 {
		private static $instance;

		public function __construct() {

			if ( qode_essential_addons_framework_is_installed( 'contact_form_7' ) ) {
				// Init
				$this->init();
			}
		}

		/**
		 * @return QodeEssentialAddons_Contact_Form_7
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init() {

			// Include helper functions
			include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/contact-form-7/helper.php';

			// Include options
			include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/contact-form-7/dashboard/admin/contact-form-7-options.php';
		}
	}

	QodeEssentialAddons_Contact_Form_7::get_instance();
}
