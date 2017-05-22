<div class="neko-tab-content">

	<h2><?php esc_html_e( 'Configuration', 'neko' ); ?></h2>

	<?php
	printf(
		wp_kses_post('<p>'.
			__( '
				This section will help you set up your server, php and WordPess correctly. You \'ll find detailed informations on what is required for this theme to work properly.<br/><strong>Make sure everything is ok in "Server configuration check" before going to the next tab</strong>!!
			', 'neko').'</p>'
			)
		);
		?>
	

		<table class="widefat" cellspacing="0">
			<thead>
				<tr>
					<th colspan="3" data-export-label="Server configuration check"><?php esc_html_e( 'Server configuration check', 'neko' ); ?></th>
				</tr>
			</thead>
			<tbody>

				<tr>
				  <td class="result">
				  	<?php
				  	$memory = $this->let_to_num( WP_MEMORY_LIMIT );
				  	echo ( $memory >= 256000000 ) ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>' ;
				  	?>
				  </td>
					<td data-export-label="WP Memory Limit"><?php esc_html_e( 'WP Memory Limit', 'neko' ); ?></td>
					<td><?php
						if ( $memory < 256000000 ) {
							echo '<mark class="error">' . sprintf( wp_kses_post(__( '%s - We recommend setting memory to at least <strong>256MB</strong> of memory limit. Please define memory limit in <strong>wp-config.php</strong> file. To learn how, see: <a href="%s" target="_blank">Increasing memory allocated to PHP.</a>', 'neko' )), size_format( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
						} else {
							echo '<mark class="success">' . size_format( $memory ) . '</mark>';
						}
					?></td>
				</tr>

				<tr>
					<td class="result">
						<?php
						echo class_exists( 'ZipArchive' ) ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>' ;
						?>
					</td>
					<td data-export-label="ZipArchive"><?php esc_html_e( 'ZipArchive', 'neko' ); ?></td>
					<td><?php echo class_exists( 'ZipArchive' ) ? '<mark class="success">Installed</mark>' : '<mark class="error">ZipArchive is not installed on your server, but is required if you need to import demo content. Please contact your hosting provider.</mark>'; ?></td>
				</tr>

				<tr>
					<td class="result">
						<?php
						$maxuploadsize_int =  substr( size_format( wp_max_upload_size() ) , 0, -2 );
						echo ( $maxuploadsize_int >= 25 ) ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>' ;
						?>
					</td>
					<td data-export-label="Max Upload Size"><?php esc_html_e( 'Max Upload Size', 'neko' ); ?></td>
					<td>
					<?php 
					echo ( $maxuploadsize_int >= 25 ) ? '<mark class="success">'.size_format( wp_max_upload_size() ).'</mark>' : '<mark class="error">'.size_format( wp_max_upload_size() ).' Max upload size  is the limit of any single file. It should be at least 25 MB</mark>';
					?>
					</td>
				</tr>

				<?php if ( function_exists( 'ini_get' ) ) { ?>

					<tr>
						<td class="result">
							<?php
							$postmaxsize_int =  substr( ini_get('post_max_size'), 0, -1 );
							echo (  $postmaxsize_int >= 64 ) ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>' ;
							?>
						</td>
						<td data-export-label="PHP Post Max Size"><?php esc_html_e( 'PHP Post Max Size', 'neko' ); ?></td>
						<td>
						<?php 
						echo ( $postmaxsize_int >= 64 ) ? '<mark class="success">'.size_format( $this->let_to_num( ini_get('post_max_size') ) ).'</mark>' : '<mark class="error">'.size_format( $this->let_to_num( ini_get('post_max_size') ) ).' Post max size is the limit of the entire body of the request, which could include multiple files. It should be at least 64 MB. This value must always be higher than max_upload_size </mark>';
						 ?>
						</td>
					</tr>

					<tr>
						<td class="result">
							<?php
							$time_limit = ini_get('max_execution_time');
							echo ( $time_limit >= 300 && $time_limit != 0 )  ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>' ;
							?>
						</td>
						<td data-export-label="PHP Time Limit"><?php esc_html_e( 'PHP Time Limit', 'neko' ); ?></td>
						<td>
							<?php
								

								if ( $time_limit < 300 && $time_limit != 0 ) {
									echo '<mark class="error">' . sprintf( __( '%s - Current time limit is not sufficient, the required time is <strong>300</strong>.<br />See: <a href="%s" target="_blank">Increasing max execution to PHP</a>', 'neko' ), $time_limit, 'http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded' ) . '</mark>';
								} else {
									echo '<mark class="success">' . $time_limit . '</mark>';
								}
							?>
						</td>
					</tr>

					<tr>
						<td class="result">
						<?php
						$registered_navs = get_nav_menu_locations();
						$menu_items_count = array( "0" => "0" );
						foreach( $registered_navs as $handle => $registered_nav ) {
							$menu = wp_get_nav_menu_object( $registered_nav );
							if( $menu ) {
								$menu_items_count[] = $menu->count;
							}
						}

						$max_items = max( $menu_items_count );
						$required_input_vars = $max_items * 12;
						$max_input_vars = ini_get('max_input_vars');
						$required_input_vars = $required_input_vars + ( 500 + 1000 );
						echo ( $max_input_vars >= $required_input_vars )  ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>' ;
						?>
						</td>

						<td data-export-label="PHP Max Input Vars"><?php esc_html_e( 'PHP Max Input Vars', 'neko' ); ?></td>
	

						<td>
							<?php
								if ( $max_input_vars < $required_input_vars ) {
									echo '<mark class="error">' . sprintf( __( '%s - Recommended Value: %s.<br />Max input vars limitation will truncate POST data such as menus. See: <a href="%s" target="_blank">Increasing max input vars limit.</a>', 'neko' ), $max_input_vars, '<strong>' . $required_input_vars . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>';
								} else {
									echo '<mark class="success">' . $max_input_vars . '</mark>';
								}
							?>
						</td>
					</tr>


					<tr>
						<td class="result">
							<?php
							echo '<span class="success dashicons dashicons-yes"></span>' ;
							?>
						</td>
						<td data-export-label="SUHOSIN Installed"><?php esc_html_e( 'SUHOSIN', 'neko' ); ?></td>
						<td>
							<?php 
							echo extension_loaded( 'suhosin' ) ? '<span class="dashicons dashicons-yes"></span> To learn more, see: <a href="http://www.suhosin.org/stories/index.html" target="_blank" title="">'.esc_html__( 'More Information', 'neko' ).'</a>' : esc_html_e( 'Not installed', 'neko' ) ;; 
							?>
						</td>
					</tr>

					<?php if( extension_loaded( 'suhosin' ) ){ ?>
						<tr>
							<td class="result">
						  <?php
							$registered_navs = get_nav_menu_locations();
							$menu_items_count = array( "0" => "0" );
							foreach( $registered_navs as $handle => $registered_nav ) {
								$menu = wp_get_nav_menu_object( $registered_nav );
								if( $menu ) {
									$menu_items_count[] = $menu->count;
								}
							}

							$max_items = max( $menu_items_count );
							//$required_input_vars_post = ini_get( 'suhosin.post.max_vars' );
							$required_input_vars_post = $max_items * 20;
							$max_input_vars = ini_get( 'suhosin.post.max_vars' );
							$required_input_vars_post = $required_input_vars_post + ( 500 + 1000 );

							echo ( $max_input_vars >= $required_input_vars_post )  ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>' ;
							?>
							</td>

							<td data-export-label="Suhosin Post Max Vars"><?php esc_html_e( 'Suhosin Post Max Vars', 'neko' ); ?></td>

							<td><?php
								if ( $max_input_vars < $required_input_vars_post ) {
									echo '<mark class="error">' . sprintf( __( '%s - Recommended Value: %s. Max input vars limitation will truncate POST data such as menus. See: <a href="%s" target="_blank">Increasing max input vars limit.</a>', 'neko' ), $max_input_vars, '<strong>' . ( $required_input_vars_post ) . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>';
								} else {
									echo '<mark class="success">' . $max_input_vars . '</mark>';
								}
							?></td>
						</tr>
						<tr>
							<td class="result">
							<?php
							$registered_navs = get_nav_menu_locations();
							$menu_items_count = array( "0" => "0" );
							foreach( $registered_navs as $handle => $registered_nav ) {
								$menu = wp_get_nav_menu_object( $registered_nav );
								if( $menu ) {
									$menu_items_count[] = $menu->count;
								}
							}

							$max_items = max( $menu_items_count );
							//$required_input_vars_request = ini_get( 'suhosin.request.max_vars' );
							$required_input_vars_request = $max_items * 20;
							$max_input_vars = ini_get( 'suhosin.request.max_vars' );
							$required_input_vars_request = $required_input_vars_request + ( 500 + 1000 );		

							echo ( $max_input_vars >= $required_input_vars_request )  ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>' ;
							?>
							</td>

							<td data-export-label="Suhosin Request Max Vars"><?php esc_html_e( 'Suhosin Request Max Vars', 'neko' ); ?></td>

							<td><?php
								if ( $max_input_vars < $required_input_vars_request ) {
									echo '<mark class="error">' . sprintf( __( '%s - Recommended Value: %s. Max input vars limitation will truncate POST data such as menus. See: <a href="%s" target="_blank">Increasing max input vars limit.</a>', 'neko' ), $max_input_vars, '<strong>' . ( $required_input_vars_request ) . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>';
								} else {
									echo '<mark class="success">' . $max_input_vars . '</mark>';
								}
							?></td>
						</tr>
						<tr>
							<td class="result">
							<?php
							$suhosin_max_value_length = ini_get( "suhosin.post.max_value_length" );
							$recommended_max_value_length = 2000000;

							echo ( $suhosin_max_value_length >= $recommended_max_value_length )  ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>' ;
							?>
							</td>						
							<td data-export-label="Suhosin Post Max Value Length"><?php esc_html_e( 'Suhosin Post Max Value Length', 'neko' ); ?></td>
							<td><?php


								if ( $suhosin_max_value_length < $recommended_max_value_length ) {
									echo '<mark class="error">' . sprintf( __( '%s - Recommended Value: %s.<br />Post Max Value Length limitation may prohibit the Theme Options data from being saved to your database. See: <a href="%s" target="_blank">Suhosin Configuration Info</a>.', 'neko' ), $suhosin_max_value_length, '<strong>' . $recommended_max_value_length . '</strong>', 'http://suhosin.org/stories/configuration.html' ) . '</mark>';
								} else {
									echo '<mark class="success">' . $suhosin_max_value_length . '</mark>';
								}
							?></td>
						</tr>

					<?php } ?>



				<?php }else{ ?>	
						<tr>
							<td colspan="3" ><?php esc_html_e( 'Server information not available. Please check your "php.ini" configuration to allow these informations to be displayed here.', 'neko' ); ?></td>
						</tr>

				<?php } ?>

			</tbody>
		</table>

		<table class="widefat" cellspacing="0">
			<thead>
				<tr>
					<th colspan="3" data-export-label="Advanced configuration"><?php esc_html_e( 'Advanced Configuration', 'neko' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="result"></td>
					<td data-export-label="WP Version"><?php esc_html_e( 'WordPress Version', 'neko' ); ?></td>
					<td><?php bloginfo('version'); ?></td>
				</tr>
				<tr>
					<td class="result"></td>
					<td data-export-label="WP Multisite"><?php esc_html_e( 'WordPress Multisite', 'neko' ); ?></td>
					<td><?php if ( is_multisite() ) esc_html_e( 'Yes', 'neko' ); else esc_html_e( 'No', 'neko' ); ?></td>
				</tr>
				<tr>
					<td class="result"></td>
					<td data-export-label="Server Info"><?php esc_html_e( 'Web server', 'neko' ); ?></td>
					<td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
				</tr>
				<tr>
					<td class="result"></td>
					<td data-export-label="PHP Version"><?php esc_html_e( 'PHP Version', 'neko' ); ?></td>
					<td><?php if ( function_exists( 'phpversion' ) ) echo esc_html( phpversion() ); ?></td>
				</tr>
				<tr>
					<td class="result"></td>
					<td data-export-label="MySQL Version"><?php esc_html_e( 'MySQL Version', 'neko' ); ?></td>
					<td>
						<?php
						global $wpdb;
						echo $wpdb->db_version();
						?>
					</td>
				</tr>
				<tr>
					<td class="result"><?php echo class_exists( 'DOMDocument' ) ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>'; ?></td>
					<td data-export-label="DOMDocument"><?php esc_html_e( 'DOMDocument', 'neko' ); ?></td>
					<td><?php echo class_exists( 'DOMDocument' ) ? '<mark class="success">Ok</mark>' : '<mark class="error">'.esc_html__( 'DOMDocument is not installed on your server, but is required if you need to use the Fusion Page Builder.', 'neko').'</mark>'; ?></td>
				</tr>
				<tr>
					<?php $response = wp_safe_remote_get( 'http://demo.little-neko.com/regularfont.json' , array( 'decompress' => false ) ); ?>
					<td class="result"><?php echo ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>'; ?></td>
					<td data-export-label="WP Remote Get"><?php esc_html_e( 'WP Remote Get', 'neko' ); ?></td>
					<td>
					<?php echo ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) ? '<mark class="success">Ok</mark>' : '<mark class="error">'.esc_html__( 'wp_remote_get() failed. Some theme features may not work. Please contact your hosting provider.', 'neko').'</mark>'; ?>
					</td>
				</tr>
				<tr>
					<?php $response = wp_safe_remote_post( 'http://demo.little-neko.com/regularfont.json' , array( 'decompress' => false ) ); ?>
					<td class="result"><?php echo ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) ? '<span class="success dashicons dashicons-yes"></span>' : '<span class="error dashicons dashicons-no-alt"></span>'; ?></td>
					<td data-export-label="WP Remote Post"><?php esc_html_e( 'WP Remote Post', 'neko' ); ?></td>
					
					<td>
					<?php echo ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) ? '<mark class="success">Ok</mark>' : '<mark class="error">'.esc_html__( 'wp_remote_post() failed. Some theme features may not work. Please contact your hosting provider.', 'neko').'</mark>'; ?>
					</td>
				</tr>
			</tbody>
		</table>
</div>
