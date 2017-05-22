<?php
if (is_admin()){


	if(!function_exists('add_metabox_to_all_posttypes')){
		function add_metabox_to_all_posttypes(){

			$post_types = get_post_types( array( 'public' => true ) );
			$allpost = array();
			foreach ( $post_types as $post_type ) {
				if( 'attachment' !== $post_type && 'revision' !== $post_type && 'nav_menu_item' !== $post_type && 'product' !== $post_type ){
					$allpost[] = $post_type;
				}
			}

			//echo '<pre>'; print_r($allpost); echo '</pre>';
			/** 
			 * prefix of meta keys, optional
			 * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
			 * you also can make prefix empty to disable it
			 */
			$prefix = 'neko_';
			$templateUri = get_template_directory_uri();



			/** 
			 * configure your meta box
			 */
			$config = array(
			'id'             => 'override_headeroptions',      // meta box id, unique per meta box
			'title'          => 'Menu Adjustment',             // meta box title
			'pages'          => $allpost,     	   			   // post types, accept custom post types as well, default is array('post'); optional
			'context'        => 'normal',                      // where the meta box appear: normal (default), advanced, side; optional
			'priority'       => 'high',                        // order of meta box: high (default), low; optional
			'fields'         => array(),                       // list of meta fields (can be added by field arrays)
			'local_images'   => false,                         // Use local or hosted images (meta box images for add/remove)
			'use_with_theme' => $templateUri . '/framework/classes/neko-metabox-generator/engine'
			);

			/**
			 * Initiate your meta box
			 */
			$my_meta =  new Neko_at_Meta_Box($config);

			$title_overrideheaderoption = esc_html__('Main navigation opacity', 'neko');
			$desc_overrideheaderoption  = esc_html__('Adjust main navigation opacity to fit the specific needs of the page', 'neko');
			$default_customizer_options = esc_html__('Default customizer option','neko');


			$my_meta->addSelect(
				$prefix.'overrideheaderoption',
				array(
					'emptylabel'  => $default_customizer_options,
					'transparent' => '0',
					'0.1'         => '0.1',
					'0.2'         => '0.2',
					'0.3'         => '0.3',
					'0.4'         => '0.4',
					'0.5'         => '0.5',
					'0.6'         => '0.6',
					'0.7'         => '0.7',
					'0.8'         => '0.8',
					'0.9'         => '0.9',
					'1'           => '1'
					),
				array(
					'name'=>  $title_overrideheaderoption,
					'desc' => $desc_overrideheaderoption,
					'std'=> array('emptylabel')
					)
				);

			$title_overrideheaderposition = esc_html__('Main navigation position', 'neko');
			$desc_overrideheaderposition  = esc_html__('Adjust main navigation position to fit the specific needs of the page', 'neko');

			$my_meta->addSelect(
				$prefix.'overrideheaderposition',
				array(
					'emptylabel'        => $default_customizer_options,
					'navbar-fixed-top'  => esc_html__('fixed','neko'),
					'navbar-static-top' => esc_html__('static','neko')
					),
				array(
					'name'=>  $title_overrideheaderposition,
					'desc' => $desc_overrideheaderposition,
					'std'=> array('emptylabel')
					)
				);

			/**
			 * Finish Meta Box Declaration
			 */
			$my_meta->Finish();


		} /* End function add to all posttypes */

		add_action ('admin_init','add_metabox_to_all_posttypes', 199);

	} /* End fucntion exists*/

} /* End is admin */