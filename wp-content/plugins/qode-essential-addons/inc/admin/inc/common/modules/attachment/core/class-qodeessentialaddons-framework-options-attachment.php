<?php

class QodeEssentialAddons_Framework_Options_Attachment extends QodeEssentialAddons_Framework_Options {

	public function __construct() {
		parent::__construct();

		add_action( 'init', array( $this, 'init_media_fields' ) );
		add_action( 'attachment_fields_to_edit', array( $this, 'add_media_custom_fields' ), 10, 2 );
		add_filter( 'attachment_fields_to_save', array( $this, 'save_media_custom_fields' ), 10, 2 );
	}

	function init_media_fields() {
		do_action( 'qode_essential_addons_action_framework_custom_media_fields' );
	}

	function add_media_custom_fields( $form_fields, $post = null ) {
		foreach ( $this->get_child_elements() as $key => $child ) {
			$form_fields = array_merge( $form_fields, $child->display_field_element( $post ) );
		}

		return $form_fields;
	}

	function save_media_custom_fields( $post, $attachment ) {
		foreach ( $this->get_child_elements() as $child ) {
			$child->save_field_element( $post, $attachment );
		}

		return $post;
	}
}
