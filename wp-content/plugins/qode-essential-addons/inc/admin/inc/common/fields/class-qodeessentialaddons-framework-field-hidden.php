<?php

class QodeEssentialAddons_Framework_Field_Hidden extends QodeEssentialAddons_Framework_Field_Type {

	public function render_field() { ?>
		<?php if ( ! empty( $this->args['custom_class'] ) ) : ?>
			<div <?php qode_essential_addons_framework_class_attribute( $this->args['custom_class'] ); ?>>
		<?php endif; ?>
		<input type="hidden" <?php echo qode_essential_addons_framework_get_inline_attrs( $this->data_attrs ); ?> class="qodef-field qodef-input" name="<?php echo esc_attr( $this->name ); ?>"
			   value="
			   <?php
				echo esc_attr( esc_html( $this->params['value'] ) );
				?>
				"
			<?php
			if ( isset( $this->args['readonly'] ) ) {
				   echo ' readonly';
			}
			?>
		/>
		<?php if ( ! empty( $this->args['custom_class'] ) ) : ?>
			</div>
			<?php
		endif;
	}
}
