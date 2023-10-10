<?php

if ( ! function_exists( 'qode_essential_addons_add_page_title_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_page_title_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'title',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Title', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Title Options', 'qode-essential-addons' ),
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_title',
					'title'         => esc_html__( 'Enable Page Title', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Use this option to choose whether page titles are enabled or disabled by default', 'qode-essential-addons' ),
					'default_value' => 'yes',
				)
			);

			$page_title_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_title_section',
					'title'      => esc_html__( 'Title Area', 'qode-essential-addons' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_title' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_title_layout',
					'title'         => esc_html__( 'Title Layout', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose a title layout', 'qode-essential-addons' ),
					'options'       => apply_filters( 'qode_essential_addons_filter_title_layout_options', array() ),
					'default_value' => 'standard',
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_page_title_area_in_grid',
					'title'         => esc_html__( 'Page Title In Grid', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enabling this option will set page title area to be in grid', 'qode-essential-addons' ),
					'default_value' => 'yes',
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_height',
					'title'       => esc_html__( 'Height', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set title height', 'qode-essential-addons' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_height_on_smaller_screens',
					'title'       => esc_html__( 'Height on Smaller Screens', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set title height for smaller screens with active mobile header', 'qode-essential-addons' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$page_title_side_padding_row = $page_title_section->add_row_element(
				array(
					'name' => 'qodef_title_side_padding_row',
				)
			);

			$page_title_side_padding_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_side_padding',
					'title'       => esc_html__( 'Title Side Padding', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set title side padding', 'qode-essential-addons' ),
					'args'        => array(
						'suffix'    => esc_html__( 'px or %', 'qode-essential-addons' ),
						'col_width' => 4,
					),
				)
			);

			$page_title_side_padding_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_side_padding_mobile',
					'title'       => esc_html__( 'Title Side Padding Mobile', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set title height for smaller screens with active mobile header', 'qode-essential-addons' ),
					'args'        => array(
						'suffix'    => esc_html__( 'px or %', 'qode-essential-addons' ),
						'col_width' => 4,
					),
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_title_background_color',
					'title'       => esc_html__( 'Background Color', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a background color for title areas', 'qode-essential-addons' ),
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_title_background_image',
					'title'       => esc_html__( 'Background Image', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a default background image for title areas', 'qode-essential-addons' ),
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_page_title_background_image_behavior',
					'title'      => esc_html__( 'Background Image Behavior', 'qode-essential-addons' ),
					'options'    => array(
						''           => esc_html__( 'Default', 'qode-essential-addons' ),
						'responsive' => esc_html__( 'Set Responsive Image', 'qode-essential-addons' ),
					),
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_title_border_color',
					'title'       => esc_html__( 'Bottom Border Color', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a default page title bottom border color', 'qode-essential-addons' ),
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_border_width',
					'title'       => esc_html__( 'Bottom Border Width', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a width for the page title bottom border', 'qode-essential-addons' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_title_border_style',
					'title'       => esc_html__( 'Bottom Border Style', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose page title bottom border style', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'border_style' ),
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_page_title_color',
					'title'      => esc_html__( 'Title Color', 'qode-essential-addons' ),
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_tag',
					'title'         => esc_html__( 'Title Tag', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'title_tag', false ),
					'default_value' => 'h1',
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_text_alignment',
					'title'         => esc_html__( 'Text Alignment', 'qode-essential-addons' ),
					'options'       => array(
						'left'   => esc_html__( 'Left', 'qode-essential-addons' ),
						'center' => esc_html__( 'Center', 'qode-essential-addons' ),
						'right'  => esc_html__( 'Right', 'qode-essential-addons' ),
					),
					'default_value' => 'left',
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_vertical_text_alignment',
					'title'         => esc_html__( 'Vertical Text Alignment', 'qode-essential-addons' ),
					'options'       => array(
						'header-bottom' => esc_html__( 'From Bottom of Header', 'qode-essential-addons' ),
						'window-top'    => esc_html__( 'From Window Top', 'qode-essential-addons' ),
					),
					'default_value' => 'header-bottom',
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_breadcrumbs_tag',
					'title'         => esc_html__( 'Breadcrumbs Tag', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enabling this option will set breadcrumbs tag', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'title_tag', false ),
					'dependency'    => array(
						'show' => array(
							'qodef_title_layout' => array(
								'values'        => array( 'breadcrumbs' ),
								'default_value' => '',
							),
						),
					),
					'default_value' => 'h5',
				)
			);

			// Hook to include additional options after module options
			do_action( 'qode_essential_addons_action_after_page_title_options_map', $page_title_section );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_page_title_options', qode_essential_addons_get_admin_options_map_position( 'title' ) );
}
