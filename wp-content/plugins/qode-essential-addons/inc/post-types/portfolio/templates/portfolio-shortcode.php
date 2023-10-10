<div class="qodef-grid-item">
	<?php
		$queried_tax = get_queried_object();
		$tax         = ! empty( $queried_tax->taxonomy ) ? $queried_tax->taxonomy : '';
		$tax_slug    = ! empty( $queried_tax->slug ) ? $queried_tax->slug : '';

		qode_essential_addons_generate_portfolio_archive_with_shortcode( $tax, $tax_slug );
	?>
</div>
