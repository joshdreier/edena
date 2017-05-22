<?php

add_action( 'tgmpa_register', 'neko_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function neko_register_required_plugins( $return_plugin_array = false) {

	$plugins = array(	

		array(
			'name'               => 'Neko core plugin',
			'slug'               => 'neko-core',
			'source'             => get_template_directory() . '/inc/plugins/neko-core.zip',
			'version'            => '1.0.2',
			'force_activation'   => false,
			'force_deactivation' => false,
			'required'           => true,
			'neko_thumb'         => 'neko-core.png'
			),	

		array(
			'name'               => 'Post Types Order',
			'slug'               => 'post-types-order',
			'version'            => '1.8.9.2',
			'force_activation'   => false,
			'force_deactivation' => false,
			'required'           => true,
			'neko_thumb'         => 'post-types-order.png'
			),


		array(
			'name'             => 'Neko Portfolio',
			'slug'             => 'neko-portfolio',
			'version'          => '1.0.1',
			'force_activation' => false,
			'required'         => false,
			'source'           => get_template_directory() . '/inc/plugins/neko-portfolio.zip',
			'neko_thumb'       => 'neko-portfolio.png'
			),

		array(
			'name'             => 'Neko Pricing tables',
			'slug'             => 'neko-pricing-tables',
			'version'          => '1.1.1',
			'force_activation' => false,
			'required'         => false,
			'source'           => get_template_directory() .'/inc/plugins/neko-pricing-tables.zip',
			'neko_thumb'       => 'neko-pricing-tables.png'
			),

		array(
			'name'             => 'Neko slider',
			'slug'             => 'neko-slider',
			'version'          => '1.0.2',
			'force_activation' => false,
			'required'         => false,
			'source'           => get_template_directory() .'/inc/plugins/neko-slider.zip',
			'neko_thumb'       => 'neko-slider.png'
			),

		array(
			'name'             => 'Neko Team',
			'slug'             => 'neko-team',
			'force_activation' => false,
			'version'          => '1.0.1',
			'required'         => false,
			'source'           => get_template_directory() .'/inc/plugins/neko-team.zip',
			'neko_thumb'       => 'neko-team.png'
			),

		array(
			'name'             => 'Neko Gmap',
			'slug'             => 'neko-gmap',
			'force_activation' => false,
			'version'          => '1.0.2',
			'required'         => false,
			'source'           => get_template_directory() .'/inc/plugins/neko-gmap.zip',
			'neko_thumb'       => 'neko-gmap.png'
			),
		
		array(
			'name'             => 'Neko Vc Addons',
			'slug'             => 'neko-vcaddons',
			'force_activation' => false,
			'version'          => '1.0.2',
			'required'         => false,
			'source'           => get_template_directory() .'/inc/plugins/neko-vcaddons.zip',
			'neko_thumb'       => 'neko-vcaddons.png'
			),


		array(
			'name'               => 'Visual Composer Clipboard',
			'slug'               => 'vc_clipboard',
			'source'             => get_template_directory() . '/inc/plugins/vc_clipboard.zip',
			'version'            => '3.24',
			'force_activation'   => false,
			'force_deactivation' => false,
			'required'           => false,
			'neko_thumb'         => 'vc-clipboard.png'
			),	

		array(
			'name'               => 'Contact Form 7',
			'slug'               => 'contact-form-7',
			'version'            => '4.4.2',
			'force_activation'   => false,
			'force_deactivation' => false,
			'required'           => false,
			'neko_thumb'         => 'contact-form-7.png'
			),

		array(
			'name'               => 'Slider Revolution',
			'slug'               => 'revslider',
			'version'            => '5.2.6',
			'force_activation'   => false,
			'force_deactivation' => false,
			'required'           => false,
			'source'             => get_template_directory() . '/inc/plugins/revslider.zip',
			'neko_thumb'         => 'revslider.png'
			),

		array(
			'name'               => 'WPBakery Visual Composer',
			'slug'               => 'js_composer',
			'source'             => get_template_directory() . '/inc/plugins/js_composer.zip',
			'version'            => '4.12',
			'force_activation'   => false,
			'force_deactivation' => false,
			'required'           => true,
			'neko_thumb'         => 'js-composer.png'
			),

		array(
			'name'               => 'Woocommerce',
			'slug'               => 'woocommerce',
			'version'            => '2.6.1',
			'force_activation'   => false,
			'force_deactivation' => false,
			'required'           => false,
			'neko_thumb'         => 'woocommerce.png'
			),

		array(
			'name'               => 'TweetScroll Widget',
			'slug'               => 'tweetscroll-widget',
			'version'            => '1.3.7',
			'force_activation'   => false,
			'force_deactivation' => false,
			'required'           => false,
			'neko_thumb'         => 'tweetscroll-widget.png'
			),

		array(
			'name'               => 'flickr badges widget',
			'slug'               => 'flickr-badges-widget',
			'version'            => '1.2.9',
			'force_activation'   => false,
			'force_deactivation' => false,
			'required'           => false,
			'neko_thumb'         => 'flickr-badges-widget.png'
			),
		);


$config = array(
	'default_path' => '',
	'parent_slug'  => 'themes.php',
	'menu'         => 'install-required-plugins',
	'dismissable'  => true,
	'has_notices'  => true,
	'strings'	   => array(
		'page_title'                      => esc_html__( 'Install Required Plugins', 'neko' ),
		'menu_title'                      => esc_html__( 'Install Plugins', 'neko' ),
		'installing'                      => esc_html__( 'Installing Plugin: %s', 'neko' ),
		'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'neko' ),
		'notice_can_install_required'     => _n_noop(
			'This theme requires the following plugin: %1$s.',
			'This theme requires the following plugins: %1$s.',
			'neko'
			),
		'notice_can_install_recommended'  => _n_noop(
			'This theme recommends the following plugin: %1$s.',
			'This theme recommends the following plugins: %1$s.',
			'neko'
			),
		'notice_cannot_install'           => _n_noop(
			'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
			'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
			'neko'
			),
		'notice_ask_to_update'            => _n_noop(
			'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
			'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
			'neko'
			),
		'notice_ask_to_update_maybe'      => _n_noop(
			'There is an update available for: %1$s.',
			'There are updates available for the following plugins: %1$s.',
			'neko'
			),
		'notice_cannot_update'            => _n_noop(
			'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
			'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
			'neko'
			),
		'notice_can_activate_required'    => _n_noop(
			'The following required plugin is currently inactive: %1$s.',
			'The following required plugins are currently inactive: %1$s.',
			'neko'
			),
		'notice_can_activate_recommended' => _n_noop(
			'The following recommended plugin is currently inactive: %1$s.',
			'The following recommended plugins are currently inactive: %1$s.',
			'neko'
			),
		'notice_cannot_activate'          => _n_noop(
			'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
			'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
			'neko'
			),
		'install_link'                    => _n_noop(
			'Begin installing plugin',
			'Begin installing plugins',
			'neko'
			),
		'update_link'                     => _n_noop(
			'Begin updating plugin',
			'Begin updating plugins',
			'neko'
			),
		'activate_link'                   => _n_noop(
			'Begin activating plugin',
			'Begin activating plugins',
			'neko'
			),
		'return'                          => esc_html__( 'Return to Required Plugins Installer', 'neko' ),
		'dashboard'                       => esc_html__( 'Return to the dashboard', 'neko' ),
		'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'neko' ),
		'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'neko' ),
		'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'neko' ),
		'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'neko' ),
		'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'neko' ),
		'dismiss'                         => esc_html__( 'Dismiss this notice', 'neko' ),
		'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'neko' ),
		)

);

if(false == $return_plugin_array){
	tgmpa( $plugins, $config );
}else{
	return $plugins;
}

}