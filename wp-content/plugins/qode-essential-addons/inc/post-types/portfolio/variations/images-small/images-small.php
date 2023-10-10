<?php

if ( ! function_exists( 'qode_essential_addons_add_portfolio_single_variation_images_small' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function qode_essential_addons_add_portfolio_single_variation_images_small( $variations ) {
		$variations['images-small'] = esc_html__( 'Images - Small', 'qode-essential-addons' );

		return $variations;
	}

	add_filter( 'qode_essential_addons_filter_portfolio_single_layout_options', 'qode_essential_addons_add_portfolio_single_variation_images_small' );
}
