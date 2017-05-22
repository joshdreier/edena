<?php
/**
 * Image widget admin template
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

	$id_prefix = $this->get_field_id('');
?>
<div class="uploader clearfix">
	<input type="submit" class="button" name="<?php echo  esc_attr( $this->get_field_name('uploader_button') ); ?>" id="<?php echo  esc_attr( $this->get_field_id('uploader_button') ); ?>" value="<?php esc_html_e('Select an Image', 'neko'); ?>" onclick="imageWidget.uploader( '<?php echo esc_js( $this->id ); ?>', '<?php echo esc_js( $id_prefix ); ?>' ); return false;" />
	<div class="neko_about_preview" id="<?php echo esc_attr( $this->get_field_id('preview') ); ?>">
		<?php echo trim( $this->get_image_html($instance, false) ); ?>
	</div>
	<input type="hidden" id="<?php echo esc_attr( $this->get_field_id('attachment_id') ); ?>" name="<?php echo  esc_attr( $this->get_field_name('attachment_id') ); ?>" value="<?php echo abs($instance['attachment_id']); ?>" />
	<input type="hidden" id="<?php echo esc_attr(  $this->get_field_id('imageurl') ); ?>" name="<?php echo  esc_attr( $this->get_field_name('imageurl') ); ?>" value="<?php echo esc_attr( $instance['imageurl'] ); ?>" />
</div>


<div class="clearfix" id="<?php echo  esc_attr( $this->get_field_id('fields') ); ?>" <?php if ( empty($instance['attachment_id']) && empty($instance['imageurl']) ) { ?>style="display:none;"<?php } ?>>

	<p><label for="<?php echo  esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title', 'neko'); ?>:</label>
		<input class="widefat" id="<?php echo  esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo  esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['title'])); ?>" /></p>

	
	<p><label for="<?php echo esc_attr( $this->get_field_id('description') ); ?>"><?php esc_html_e('About text', 'neko'); ?>:</label>
	<textarea rows="8" class="widefat" id="<?php echo  esc_attr( $this->get_field_id('description') ); ?>" name="<?php echo  esc_attr( $this->get_field_name('description') ); ?>"><?php echo format_to_edit($instance['description']); ?></textarea></p>
	


	<?php
	// Backwards compatibility prior to storing attachment ids
	?>
	<div id="<?php echo  esc_attr( $this->get_field_id('custom_size_selector') ); ?>" <?php if ( empty($instance['attachment_id']) && !empty($instance['imageurl']) ) { $instance['size'] = self::CUSTOM_IMAGE_SIZE_SLUG; ?>style="display:block;"<?php } ?>>
		<p><label for="<?php echo  esc_attr( $this->get_field_id('size') ); ?>"><?php esc_html_e('Size', 'neko'); ?>:</label>
			<select name="<?php echo  esc_attr( $this->get_field_name('size') ); ?>" id="<?php echo  esc_attr( $this->get_field_id('size') ); ?>" onChange="imageWidget.toggleSizes( '<?php echo esc_js( $this->id ); ?>', '<?php echo esc_js( $id_prefix ); ?>' );">
				<?php

				// for all sizes
				$all_size = neko_get_image_sizes();
				$activated_sizes = array(
					'full'            => esc_html__('Full Size', 'neko'),
					'img-xx-large-ms' => esc_html__('Custom Large', 'neko'),
					'img-medium-ms'   => esc_html__('Custom Medium', 'neko'),
					'img-small-ms'    => esc_html__('Custom Small', 'neko'),
					'thumbnail'       => esc_html__('Thumbnail', 'neko'),
					'medium'          => esc_html__('Medium', 'neko'),
					'large'           => esc_html__('Large', 'neko'),
				);

				foreach ($activated_sizes as $key => $value) {

					if('full' !== $key){

						$width = $all_size[$key]['width'];
						$height = (!empty($all_size[$key]['height']))?$all_size[$key]['height']:'auto'; 
						$possible_sizes[$key] = $value.' ('.$width.' * '.$height.')';

					}else{
						$possible_sizes[$key] = $value;
					}

				}
	
				$possible_sizes[self::CUSTOM_IMAGE_SIZE_SLUG] = esc_html__('Custom', 'neko');

				foreach( $possible_sizes as $size_key => $size_label ) { ?>
					<option value="<?php echo  esc_attr( $size_key ); ?>"<?php selected( $instance['size'], $size_key ); ?>><?php echo trim( $size_label ); ?></option>
				<?php } ?>

			</select>
		</p>
	</div>

	<div id="<?php echo  esc_attr( $this->get_field_id('custom_size_fields') ); ?>" <?php if ( empty($instance['size']) || $instance['size']!=self::CUSTOM_IMAGE_SIZE_SLUG ) { ?>style="display:none;"<?php } ?>>

		<input type="hidden" id="<?php echo  esc_attr( $this->get_field_id('aspect_ratio') ); ?>" name="<?php echo  esc_attr( $this->get_field_name('aspect_ratio') ); ?>" value="<?php echo  esc_attr( $this->get_image_aspect_ratio( $instance ) ); ?>" />

		<p>
			<label for="<?php echo  esc_attr( $this->get_field_id('width') ); ?>"><?php esc_html_e('Width', 'neko'); ?>:</label>
			<input id="<?php echo  esc_attr( $this->get_field_id('width') ); ?>" name="<?php echo  esc_attr( $this->get_field_name('width') ); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['width'])); ?>" onchange="imageWidget.changeImgWidth( '<?php echo esc_js( $this->id ); ?>', '<?php echo esc_js( $id_prefix ); ?>' )" size="3" /><span> px</span>
			<span> * </span>
			<label for="<?php echo esc_attr( $this->get_field_id('height') ); ?>"><?php esc_html_e('Height', 'neko'); ?> :</label>
			<input id="<?php echo esc_attr( $this->get_field_id('height') ); ?>" name="<?php echo esc_attr( $this->get_field_name('height') ); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['height'])); ?>" onchange="imageWidget.changeImgHeight( '<?php echo esc_js( $this->id ); ?>', '<?php echo esc_js( $id_prefix ); ?>' )" size="3"/><span> px</span>
		</p>

	</div>

	<p><label for="<?php echo esc_attr( $this->get_field_id('align') ); ?>"><?php esc_html_e('Align', 'neko'); ?>:</label>
	<select name="<?php echo esc_attr( $this->get_field_name('align') ); ?>" id="<?php echo esc_attr( $this->get_field_id('align') ); ?>">
		<option value="none"<?php selected( $instance['align'], 'none' ); ?>><?php esc_html_e('none', 'neko'); ?></option>
		<option value="left"<?php selected( $instance['align'], 'left' ); ?>><?php esc_html_e('left', 'neko'); ?></option>
		<option value="center"<?php selected( $instance['align'], 'center' ); ?>><?php esc_html_e('center', 'neko'); ?></option>
		<option value="right"<?php selected( $instance['align'], 'right' ); ?>><?php esc_html_e('right', 'neko'); ?></option>
	</select></p>
</div>