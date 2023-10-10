<?php
$button_text = apply_filters( 'qode_essential_addons_filter_welcome_premium_box_link_text', esc_html__( 'Upgrade Now', 'qode-essential-addons' ) );
$button_link = apply_filters( 'qode_essential_addons_filter_welcome_premium_box_link', 'https://qodeinteractive.com/qi-theme/' );
$button_link = add_query_arg(
	array(
		'utm_source' => 'dash',
		'utm_medium' => 'qodeessential',
		'utm_campaign' => 'welcome',
	),
	$button_link
);
?>
<div class="qodef-section-box qodef-section-qi-theme-premium">
	<div class="qodef-section-box-image">
		<img src="<?php echo esc_url( QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-pages/assets/img/qi-theme-premium.png' ); ?>" alt="<?php esc_attr_e( 'Import Demos', 'qode-essential-addons' ); ?>" />
	</div>
	<div class="qodef-section-box-content">
		<h2><?php esc_html_e( 'Qi Theme Premium', 'qode-essential-addons' ); ?></h2>
		<p class="qodef-large"><?php esc_html_e( 'With more demos & enhanced options', 'qode-essential-addons' ); ?></p>
		<a class="qodef-btn qodef-btn-solid" target="_blank" href="<?php echo esc_url( $button_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
	</div>
</div>
