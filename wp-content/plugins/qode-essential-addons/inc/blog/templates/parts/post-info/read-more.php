<?php if ( ! post_password_required() ) { ?>
	<div class="qodef-e-read-more" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_read_more_styles( $params ) ); ?>>
		<a itemprop="url" class="qodef-e-read-more-link" href="<?php the_permalink(); ?>">
			<?php echo ( esc_html__( 'Read more', 'qode-essential-addons' ) . qode_essential_addons_get_svg_icon( 'button-arrow', 'qodef-theme-button-icon' ) ); ?>
		</a>
	</div>
<?php } ?>
