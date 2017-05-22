<?php

function neko_contact_widgetloader()
{
	register_widget('neko_contact_widget');
}


add_action('widgets_init', 'neko_contact_widgetloader');

class neko_contact_widget extends WP_Widget {
	
	private $contact_infos=array('title','company', 'address', 'phone', 'fax');


	
	function neko_contact_widget()
	{
		$widget_ops = array('classname' => 'neko_contact', 'description' => 'Contact infos, social icons links');

		$control_ops = array('id_base' => 'neko_contact_widget');

		parent::__construct('neko_contact_widget', '[ NEKO ] Contact infos', $widget_ops, $control_ops);
	}
	
	
	function widget($args, $instance)
	{
		extract($args);
		$title = ( !empty($instance['title']) )?apply_filters('widget_title', $instance['title']):'';


		echo trim( $before_widget );

		if($title) {
			echo trim( $before_title ).trim( $title ).trim( $after_title );
		}
		$wp_user = get_userdata($instance['user-contact']);
		if (!empty($instance['company']) || !empty($instance['address']) || !empty($instance['phone']) || !empty($instance['fax'])  || !empty($wp_user) ){
			

			if (!empty($instance['icon-type']) && $instance['icon-type']=='on'){
				$icon_type='icon-rounded icon-small';
			}
			
			echo '<address>';
			foreach($this->contact_infos as $value){

				if (!empty($instance[$value]) && $value=='title'){

				} else if (!empty($instance[$value]) && $value=='company'){

					echo '<span class="contact-'.$value.'">'.$instance[$value].'</span>';

				}else{

					if (!empty($instance[$value])){
						echo '<span class="contact-'.$value.'">'.$instance[$value].'</span>';
					}

				}
			}

			$wp_user = get_userdata($instance['user-contact']);
			if(!empty($wp_user) && !empty($instance['activate-email']) && 1 == $instance['activate-email']){
				$wp_user_email = $wp_user->user_email;
				if(!empty($wp_user_email)){
					echo '<span class="contact-email">';
					echo '<a href="mailto:'.$wp_user_email.'">'.$wp_user_email.'</a></span>';
				}		
			}


			echo '</address>';
		}

		if (!empty($instance['user-contact'])){

			$class_icon_size    =' '.$instance['icon-size'];
			$class_icon_rounded =(!empty($instance['icon-type']) && $instance['icon-type']=='on')?'icon-rounded':'';

			echo neko_socialbar($instance['user-contact'], $class_icon_size, $class_icon_rounded);

		}

		echo trim( $after_widget );
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		foreach($this->contact_infos as $value){
			$instance[$value] = $new_instance[$value];
		}

		$instance['activate-email'] = $new_instance['activate-email'];
		$instance['user-contact']   = $new_instance['user-contact'];
		$instance['icon-type']      = $new_instance['icon-type'];
		$instance['icon-size']      = $new_instance['icon-size'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array(
			'title' => 'Contact Infos',
			'company' => '',
			'address' => '',
			'phone' => '',
			'fax' => '',
			'activate-email' => '',
			'user-contact' => '',
			'icon-type' => 'on',
			'icon-size'=>'standard'
			);

			$instance = wp_parse_args((array) $instance, $defaults); ?>


			<?php
			foreach($this->contact_infos as $value){
				if ($value=='address'){

					echo '<p>
					<label for="'.$this->get_field_id($value).'">'.ucfirst($value).':</label>
					<textarea class="widefat" id="'.$this->get_field_id($value).'" name="'.$this->get_field_name($value).'" rows="5">'.$instance[$value].'</textarea>
					</p>';

			}else{

				echo '<p>
				<label for="'.$this->get_field_id($value).'">'.ucfirst($value).':</label>
				<input class="widefat" type="text" id="'.$this->get_field_id($value).'" name="'.$this->get_field_name($value).'" value="'.$instance[$value].'" />
				</p>';
		}
	}
	?>


	<h3><?php esc_html_e('Select a user', 'neko'); ?></h3>


	<p><?php esc_html_e('Select user from which social network informations and email will be used', 'neko'); ?></p>
	<select id="<?php echo esc_attr( $this->get_field_id('user-contact') ); ?>" name="<?php echo esc_attr( $this->get_field_name('user-contact') ); ?>">
		<option value="0">&mdash; <?php esc_html_e('select a user', 'neko'); ?> &mdash;</option>
		<?php
		$all_users = get_users(array( 'fields' => array( 'display_name', 'ID')));
		foreach ($all_users as $key => $value) {
			$selected = ($instance['user-contact'] == $value->ID)?'selected="selected"':'';
			echo '<option value="'.$value->ID.'" '.$selected.' >'.$value->display_name.'</option>';
		}
		?>
	</select>&nbsp;&nbsp;&nbsp;

	<label for="<?php esc_attr( $this->get_field_id('activate-email') ); ?>"><?php esc_html_e('Display user email', 'neko'); ?>&nbsp;
	<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id('activate-email') ); ?>" name="<?php echo esc_attr( $this->get_field_name('activate-email') ); ?>" value="1" <?php checked( $instance['activate-email'], '1', true ); ?>/></label>

	<h3><?php esc_html_e('Icons Style', 'neko'); ?></h3>

	<p>
		<input class="checkbox" type="checkbox" <?php checked($instance['icon-type'], 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('icon-type') ); ?>" name="<?php echo esc_attr( $this->get_field_name('icon-type') ); ?>" /> 
		<label for="<?php echo esc_attr( $this->get_field_id('icon-type') ); ?>">Icon rounded</label>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id('icon-size') ); ?>">Icon size</label>
		<select class="select" id="<?php echo esc_attr( $this->get_field_id('icon-size') ); ?>" name="<?php echo esc_attr( $this->get_field_name('icon-size') ); ?>">
			<option value='' <?php echo ($instance['icon-size']=='')?'selected="selected"':''; ?> >Standard</option>
			<option value='icon-big' <?php echo ($instance['icon-size']=='icon-big')?'selected="selected"':''; ?> >Big</option>
			<option value='icon-medium' <?php echo ($instance['icon-size']=='icon-medium')?'selected="selected"':''; ?>>Medium</option>
			<option value='icon-small' <?php echo ($instance['icon-size']=='icon-small')?'selected="selected"':''; ?>>Small</option>
		</select>
	</p>

	<?php
}
}

?>