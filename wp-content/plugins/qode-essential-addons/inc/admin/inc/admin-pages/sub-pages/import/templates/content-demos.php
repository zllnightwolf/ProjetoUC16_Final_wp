<div class="qodef-import-demos">
	<div class="qodef-import-top">
		<div class="qodef-import-top-title-holder">
			<h1><?php echo esc_html( $import_title ); ?></h1>
		</div>
		<div class="qodef-import-top-actions-holder">
			<a href="#" class="qodef-import-top-button qodef-import-top-reload-button">
				<span><?php echo esc_html__( 'Reload', 'qi-templates' ); ?></span>
				<svg x="0px" y="0px" width="16.497px" height="14.063px" viewBox="0 0 16.497 14.063" enable-background="new 0 0 16.497 14.063" xml:space="preserve">
						<g>
							<path d="M16.242,6.223L13.5,8.965c-0.141,0.141-0.329,0.211-0.563,0.211c-0.234,0-0.422-0.07-0.563-0.211L9.668,6.223
								c-0.329-0.375-0.329-0.75,0-1.125c0.375-0.328,0.75-0.328,1.125,0l1.512,1.512c-0.118-1.406-0.691-2.602-1.723-3.586
								C9.55,2.039,8.332,1.547,6.926,1.547c-1.477,0-2.737,0.533-3.779,1.6C2.104,4.213,1.582,5.508,1.582,7.031
								c0,1.524,0.521,2.818,1.564,3.885c1.042,1.067,2.314,1.6,3.814,1.6c1.078,0,2.086-0.316,3.023-0.949
								c0.188-0.141,0.387-0.193,0.598-0.158s0.375,0.146,0.492,0.334c0.304,0.422,0.246,0.786-0.176,1.09
								c-1.172,0.821-2.484,1.23-3.938,1.23c-1.922,0-3.563-0.686-4.922-2.057C0.68,10.635,0,8.977,0,7.031
								c0-1.945,0.68-3.604,2.039-4.975C3.398,0.686,5.039,0,6.961,0c1.781,0,3.334,0.61,4.658,1.828c1.324,1.219,2.068,2.73,2.232,4.535
								l1.23-1.266c0.375-0.328,0.75-0.328,1.125,0C16.582,5.473,16.594,5.848,16.242,6.223z"></path>
						</g>
					</svg>
			</a>
			
			<?php wp_nonce_field( 'qode_essential_addons_reload_demo_import', 'qode_essential_addons_reload_demo_import' ); ?>
		</div>
	</div>
	<div class="qodef-import-demos-inner">
		<?php qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/demos-import-list', '', $params ); ?>
	</div>
</div>

<div class="qodef-demo-single">
	<?php
	if ( isset( $single_demo ) && '' !== $single_demo ) {
		echo qode_essential_addons_framework_get_template_part(
			QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc',
			'admin-pages',
			'sub-pages/import/templates/content-single',
			'',
			array(
				'demo'          => $single_demo,
				'demo_key'      => $single_demo_id,
				'content_files' => $content_files,
			)
		);
	}
	?>
</div>

