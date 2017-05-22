<?php
$user_token       = get_option( '_tftoken', '' );
$user_name        = get_option( '_tfuname', '' );
$user_pcode       = get_option( '_tfpcode', '' );
$registered_theme = get_option( '_registered_theme', '' );
?>

<div class="neko-tab-content">
	<h3><?php esc_html_e( 'Global OAuth Personal Token', 'neko'); ?></h3>
	<p>
		<?php esc_html_e( 'OAuth is a protocol that lets external apps request authorization to private details in a user\'s Envato Market account without entering their password. This is preferred over Basic Authentication because tokens can be limited to specific types of data, and can be revoked by users at any time.', 'neko' ); 
		?>
	</p>

	<p>
		<?php printf( esc_html__( 'You will need to %s, and then insert it below.', 'neko' ), '<a href="https://build.envato.com/create-token/?purchase:download=t&purchase:verify=t&purchase:list=t&purchase:history=t" target="_blank">' . esc_html__( 'generate a personal token', 'neko' ) . '</a>' ); 
		?>
	</p>
	<br/><br/>

	<form id="neko-theme-registration-frm">
		<input type="hidden" name="action" value="neko_theme_registration" />
		<div class="field-wrapper clearfix">

			<div class="frm-group">
				<label><?php esc_html_e( 'Themeforest Personal Token', 'neko' ); ?></label>
				<input type="text" name="themeforest_token" id="themeforest_token" placeholder="<?php esc_html_e( 'Enter your personal token', 'neko' ); ?>" value="<?php echo $user_token ?>" />	
			</div>		

			<div class="frm-group">
				<label><?php esc_html_e( 'Themeforest Username', 'neko' ); ?></label>
				<input type="text" name="themeforest_username" id="themeforest_username" placeholder="<?php esc_html_e( 'Themeforest Username', 'neko' ); ?>" value="<?php echo $user_name ?>" />
			</div>

			<div class="frm-group">	
				<label><?php esc_html_e( 'Themeforest Purchase Code', 'neko' ); ?></label>
				<input type="text" name="themeforest_purchasecode" id="themeforest_purchasecode" placeholder="<?php esc_html_e( 'Enter Themeforest Purchase Code', 'neko' ); ?>" value="<?php echo $user_pcode ?>" />
			</div>

		</div>
		<button type="button" id="neko-theme-registration-btn" class="button button-large button-primary"><?php esc_html_e( 'Save changes', 'neko' ); ?></button>
	</form>


	<div id="neko-registration-result">
	<?php 
	if( !empty($registered_theme) ) :  
		echo neko_admin_management()->themefct()->build_theme_card( $theme = $registered_theme, $activate_action = true ); 
	endif; 
	?>
	</div>
</div>