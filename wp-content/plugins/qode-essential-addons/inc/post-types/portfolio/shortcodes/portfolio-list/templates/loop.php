<?php

if ( $query_result->have_posts() ) {
	while ( $query_result->have_posts() ) :
		$query_result->the_post();

		$params['image_dimension'] = $this_shortcode->get_list_item_image_dimension( $params );
		$params['item_classes']    = $this_shortcode->get_item_classes( $params );

		echo apply_filters( 'qode_essential_addons_filter_portfolio_list_sc_layout_path', qode_essential_addons_get_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'layouts/' . $layout, '', $params ), $layout, '', $params );
	endwhile; // End of the loop.
} else {
	// Include global posts not found
	qode_essential_addons_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();
