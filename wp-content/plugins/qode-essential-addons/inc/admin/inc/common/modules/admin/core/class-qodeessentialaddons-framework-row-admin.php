<?php

class QodeEssentialAddons_Framework_Row_Admin extends QodeEssentialAddons_Framework_Row {

	function __construct( $params ) {
		parent::__construct( $params );
	}

	function add_repeater_element( $params ) {
		$params['type']          = 'admin';
		$params['default_value'] = isset( $params['default_value'] ) ? $params['default_value'] : '';
		$params['scope']         = $this->get_scope();
		$admin_option            = qode_essential_addons_framework_get_framework_root()->get_admin_option( $this->get_scope() );
		$admin_option->set_option( $params['name'], $params['default_value'], 'repeater' );

		return parent::add_repeater_element( $params );
	}

	function add_field_element( $params ) {
		$params['type']          = 'admin';
		$params['default_value'] = isset( $params['default_value'] ) ? $params['default_value'] : '';
		$params['scope']         = $this->get_scope();
		$admin_option            = qode_essential_addons_framework_get_framework_root()->get_admin_option( $this->get_scope() );
		$admin_option->set_option( $params['name'], $params['default_value'], 'repeater' );
		parent::add_field_element( $params );
	}
}
