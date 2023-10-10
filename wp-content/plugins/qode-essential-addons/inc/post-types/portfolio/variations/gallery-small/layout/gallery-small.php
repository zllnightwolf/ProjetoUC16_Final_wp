<?php
// Hook to include additional content before portfolio single item
do_action( 'qode_essential_addons_action_before_portfolio_single_item' );
?>
	<article <?php post_class( 'qodef-portfolio-single-item qodef-variations--small qodef-e' ); ?>>
		<div class="qodef-e-inner">
			<div class="qodef-e-content qodef-grid qodef-layout--columns qodef-col-split--8-4 <?php echo qode_essential_addons_get_grid_gutter_classes(); ?>">
				<div class="qodef-grid-inner">
					<div class="qodef-grid-item">
						<div class="qodef-media">
							<?php qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/post-info/media', 'gallery' ); ?>
						</div>
					</div>
					<div class="qodef-grid-item">
						<?php qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/post-info/title' ); ?>
						<?php qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
						<div class="qodef-portfolio-info">
							<?php qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/post-info/custom-fields' ); ?>
							<?php qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/post-info/categories' ); ?>
							<?php qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/post-info/tags' ); ?>
							<?php qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/post-info/date' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php
// Hook to include additional content after portfolio single item
do_action( 'qode_essential_addons_action_after_portfolio_single_item' );
?>
