<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class QodeEssentialAddons_Admin_Sub_Pages {
	private $base;
	private $menu_name;
	private $title;
	private $position;
	private $atts = array();

	public function __construct() {
		$this->add_sub_page();
	}

	abstract public function add_sub_page();

	function get_base() {
		return $this->base;
	}

	function set_base( $base ) {
		$this->base = $base;
	}

	function get_menu_name() {
		return $this->menu_name;
	}

	function set_menu_name( $menu_name ) {
		$this->menu_name = $menu_name;
	}

	function get_title() {
		return $this->title;
	}

	function set_title( $title ) {
		$this->title = $title;
	}

	function get_position() {
		return $this->position;
	}

	function set_position( $position ) {
		$this->position = $position;
	}

	function get_atts() {
		return $this->atts;
	}

	function set_atts( $atts ) {
		$this->atts = $atts;
	}

	function render() {
		$args                = $this->get_atts();
		$args['this_object'] = $this;
		qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'templates/holder', '', $args );
	}

	function get_header() {
		$object = ! empty( $object ) ? $object : $this;

		$args = array(
			'menu_slug'  => $object->get_menu_name(),
			'menu_title' => $object->get_title(),
			'menu_url'   => admin_url( 'admin.php?page=' . QodeEssentialAddons_Admin_General_Page::get_instance()->get_menu_name() ),
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
		qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/admin-pages', 'sub-pages/' . $this->get_base(), 'templates/' . $this->get_base(), '', $this->get_atts() );
	}
}
