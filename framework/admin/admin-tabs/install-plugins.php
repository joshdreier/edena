<div class="neko-tab-content clearfix">
	<h2><?php esc_html_e( 'Plugins Installation', 'neko' ); ?></h2>


	<?php
	printf(
		wp_kses_post(
			__( '<p>
				In order to get the most our of your %1$s you should install the following plugins. This will give you access to the following premium functionalities.
			</p>
			<ul>
				<li>Demo content installer</li>
				<li>Skin management ( import \ export )</li>
				<li>Visual page builder with custom Neko addons</li>		
				<li>Premium Neko Portfolio </li>
				<li>Premium Neko Team </li>
				<li>Premium Neko Pricing table </li>
				<li>Premium Neko Google map</li>								
				<li>Premium Neko slider</li>
			</ul>', 'neko')
			),
			$theme_name
		);
	 ?>

	<div class="theme-browser rendered">
		<div class="themes">
			<?php
			$plugins = TGM_Plugin_Activation::$instance->plugins;
			$installed_plugins = get_plugins();

			//echo '<pre>'; print_r($plugins); echo '</pre>';

			foreach ( $plugins as $keyPlugs => $plugin ) {

				$plugin_status = '';
				$file_path = $plugin['file_path'];
				$plugin_action = neko_admin_management()->pluginsfct()->neko_plugin_link( $plugin );

				?>

				<div class="theme">

					<?php 
					if( 1 == $plugin['required'] ){
						echo '<span class="plugin-required">Required</span>';
					}
					?>


					<div class="theme-screenshot">
						<?php $thumbnail = ( !empty($plugin['neko_thumb']) ) ? $plugin['neko_thumb'] : 'default-plugin-vign.png' ; ?>
						<img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/<?php echo esc_html($thumbnail); ?>" alt="">
					</div>

					<div class="neko-plugin-info">
						<?php if( isset( $installed_plugins[$plugin['file_path']] ) ): ?>
							<?php echo sprintf('%s %s | <a href="%s" target="_blank">%s</a>', __( 'Version:', 'neko' ), $installed_plugins[$plugin['file_path']]['Version'], $installed_plugins[$plugin['file_path']]['AuthorURI'], $installed_plugins[$plugin['file_path']]['Author'] ); ?>
						<?php elseif ( $plugin['source_type'] == 'bundled' ) : ?>
							<?php echo sprintf('%s %s', __( 'Available Version:', 'neko' ), $plugin['version'] ); ?>					
						<?php endif; ?>
					</div>


					<h2 class="theme-name"><?php echo ucfirst($plugin['name']); ?></h2>
					<div class="theme-actions">
						<?php foreach( $plugin_action as $action ) { echo $action; } ?>
					</div>
				</div>
				<?php } ?>
			</div>	
		</div>
	</div>