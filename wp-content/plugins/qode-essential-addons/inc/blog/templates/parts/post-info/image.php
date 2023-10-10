<?php if ( has_post_thumbnail() ) { ?>
	<div class="qodef-e-media-image">
		<a itemprop="url" href="<?php the_permalink(); ?>">
			<?php echo qode_essential_addons_get_post_image( get_the_ID() ); ?>
		</a>
		<?php
		// Hook to include additional content after blog post featured image
		do_action( 'qode_essential_addons_action_after_post_thumbnail_image' );
		?>
	</div>
<?php } ?>
