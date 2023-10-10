<div class="qodef-filter-holder-top">
	<?php //the_q_template_part( 'post-types/demo/shortcodes/demo-list', 'templates/parts/mobile-filter-opener', '', $params ); ?>
	<div class="qodef-filter-group qodef-filter-status">
		<a href="javascript:void(0)" class="qodef-filter-item qodef-demos-current" data-filter-title="all" data-filter=""><?php esc_html_e( 'All', 'the-q' ); ?></a>
		<a href="javascript:void(0)" class="qodef-filter-item" data-taxonomy='status' data-filter-title="Free" data-filter=".demo-status-free">Free</a>
		<a href="javascript:void(0)" class="qodef-filter-item" data-taxonomy='status' data-filter-title="Premium" data-filter=".demo-status-premium">Premium</a>
	</div>
	<div class="qodef-filter-number-of-results"></div>
	<div class="qodef-filter-search">
		<input type="text" class="quicksearch" placeholder="<?php esc_attr_e( 'Search demos by keyword...', 'qode-essential-addons' ); ?>"/>
	</div>
</div>
