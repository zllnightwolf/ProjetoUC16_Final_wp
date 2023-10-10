<?php

$product = qode_essential_addons_woo_get_global_product();

if ( ! empty( $product ) && 'no' !== get_option( 'woocommerce_enable_review_rating' ) ) {
	$rating = $product->get_average_rating();

	if ( ! empty( $rating ) && 'no' !== $show_rating ) { ?>
		<div class="qodef-woo-ratings qodef-m" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_rating_styles( $params ) ); ?>><?php echo qode_essential_addons_woo_product_get_rating_html( '', $rating, 0 ); ?></div>
	<?php }
} ?>
