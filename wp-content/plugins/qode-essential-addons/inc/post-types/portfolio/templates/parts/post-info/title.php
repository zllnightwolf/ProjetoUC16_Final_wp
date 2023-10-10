<?php
$title_tag_meta = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_single_title_tag' );
$title_tag      = ! empty( $title_tag_meta ) ? esc_attr( $title_tag_meta ) : 'h1';
?>
<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title qodef-portfolio-title"><?php the_title(); ?></<?php echo esc_attr( $title_tag ); ?>>
