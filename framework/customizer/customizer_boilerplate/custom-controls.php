<?php

/**
 * Creates Customizer control for textarea field
 *
 * @link	http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
 * @since	Theme_Customizer_Boilerplate 1.0
 */
class CBP_Customizer_Textarea_Control extends WP_Customize_Control {

	public $type = 'textarea';
	
	public function render_content() {
	?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	<?php
	}
	
}


/**
 * Creates Customizer control for input[type=number] field
 *
 * @since	Theme_Customizer_Boilerplate 1.0
 */
class CBP_Customizer_Number_Control extends WP_Customize_Control {

	public $type = 'number';
	
	public function render_content() {
	?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
		</label>
	<?php
	}
	
}


/**
 * Creates Customizer control for radio replacement images fields
 */
class CBP_Customizer_Images_Radio_Control extends WP_Customize_Control {

	public $type = 'images_radio';
	
	public function render_content() {
		if ( empty( $this->choices ) )
			return;

		$name = '_customize-image-radios-' . $this->id;
		
		/*
		 * Get value of 'choices' array from $options array
		 * This contains paths to images for each option
		 */
		$thsp_cbp_sections = thsp_cbp_get_fields();
		$thsp_cbp_current_section = $thsp_cbp_sections[ $this->section ];
		$thsp_cbp_current_section_fields = $thsp_cbp_current_section['fields'];
		
		/* 
		 * Going through all the fields in this section
		 * and getting the correct one so we could grab its 'choices'
		 */
		foreach ( $thsp_cbp_current_section_fields as $thsp_cbp_current_section_field_key => $thsp_cbp_current_section_field_value ) {
			
			/*
			 * Not the most sophisiticated way to do it
			 * There could be issues if one field has 'something' as ID
			 * and next one has 'somethi'
			 */
			if ( strpos( $this->id, $thsp_cbp_current_section_field_key ) ) {
				$thsp_cbp_current_control_choices = $thsp_cbp_current_section_fields[ $thsp_cbp_current_section_field_key ]['control_args']['choices'];
			}
		}
		?>
		
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php
		foreach ( $this->choices as $value => $label ) {
			?>
			<input id="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" class="image-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
			
			<label for="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>">
				<img src="<?php echo esc_url( $thsp_cbp_current_control_choices[ $value ]['image_src'] ); ?>" alt="<?php echo esc_attr( $label ); ?>" />
			</label>
			<?php
		} // end foreach
	}
	
	public function enqueue() {
		wp_enqueue_style(
			'thsp_customizer_style',
			thsp_cbp_directory_uri() . '/customizer-controls.css'
		);
	}
	
}

class CBP_Customizer_Sub_Title extends WP_Customize_Control {
    public $type = 'sub-title';
    public function render_content() {
    ?>
      <h4 class="customizer-subtitle"><?php echo esc_html( $this->label ); ?></h4>
    <?php
    }

  	public function enqueue() {
		wp_enqueue_style(
			'thsp_customizer_style',
			thsp_cbp_directory_uri() . '/customizer-controls.css'
		);
	}
  }

class CBP_Customizer_Description extends WP_Customize_Control {
    public $type = 'description';
    public function render_content() {
    ?>
      <p class="customizer-description"><?php echo esc_html( $this->label ); ?></p>
    <?php
    }

  	public function enqueue() {
		wp_enqueue_style(
			'thsp_customizer_style',
			thsp_cbp_directory_uri() . '/customizer-controls.css'
		);
	}
}


/**
 * Action hook that allows you to create your own controls
 */
do_action( 'thsp_cbp_custom_controls' );


/*
function neko_add_customizer_boilerplate_comment() {

    class CBP_Customizer_My_Control extends WP_Customize_Control {
    	
        public $type = 'comment'; // Change this
        
        public function render_content() {
            // Control output goes here
        	?>
        	<div class="customize-control-description">
        		<?php echo esc_html( $this->value() ); ?>
        	</div>
        	<?php
        }
        
    }
}
add_action( 'thsp_cbp_custom_controls', 'neko_add_customizer_boilerplate_comment' );
*/