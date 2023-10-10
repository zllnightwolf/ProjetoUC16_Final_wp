<?php
$subtitle_tag = qode_essential_addons_get_post_value_through_levels( 'qodef_page_subtitle_tag' );

if ( ! empty( $subtitle ) ) {
	?>
	<<?php echo esc_attr( $subtitle_tag ); ?> class="qodef-m-subtitle"><?php echo wp_kses_post( $subtitle ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
<?php } ?>
