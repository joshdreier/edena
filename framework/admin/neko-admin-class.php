<?php
if ( ! defined( 'ABSPATH' ) ) { exit; /* Exit if accessed directly */ }


if ( ! class_exists( 'Neko_Admin' ) ) :

/**
 * A class to manage various stuff in the WordPress admin area.
 *
 * @package Neko Framework
 * @subpackage Includes
 * @since 1.1.1
 */
class Neko_Admin {

	/**
	 * The single class instance.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var object
	 */
	private static $_instance = null;


	/**
	 * Main Neko_Admin Instance
	 *
	 * Ensures only one instance of this class exists in memory at any one time.
	 *
	 * @since 1.0.0
	 * @static
	 * @return object The one true Neko_Admin.
	 * @LittleNeko
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
			self::$_instance->init_includes();
			self::$_instance->init_actions();		
		}
		return self::$_instance;
	}

	/**
	 * class constructor
	 *
	 * @since 1.0.0
	 */
	private function __construct() {
		/* We do nothing here! */
	}

	/**
	 * You cannot clone this class.
	 *
	 * @since 1.0.0
	 * @LittleNeko
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'neko' ), '1.0.0' );
	}

	/**
	 * You cannot unserialize instances of this class.
	 *
	 * @since 1.0.0
	 * @LittleNeko
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'neko' ), '1.0.0' );
	}	


	/**
	 * Neko admin styles
	 *
	 * @since 1.0.0
	 * @return [type] [description]
	 */
	public function neko_admin_style(){
		wp_enqueue_style( 'neko-custom-font-icon', get_template_directory_uri().'/font-icons/custom-icons/css/custom-icons.css');
		wp_enqueue_style( 'neko-admin-css', get_template_directory_uri().'/framework/admin/css/neko-admin.css');
	}


	/**
	 * Neko admin scripts
	 * @return [type] [description]
	 */
	public function neko_admin_scripts(){
		wp_enqueue_script( 'neko-admin-js', get_template_directory_uri().'/framework/admin/js/neko-admin.js', array( 'jquery' ), '1.0', true);
	}



	/**
	 * Include required files.
	 *
	 * @since 1.0.0
	 * @access private
	 * @codeCoverageIgnore
	 */
	private function init_includes() {
		require get_template_directory() . '/framework/admin/inc/_build-theme_admin_page.php';
		require get_template_directory() . '/framework/admin/inc/_plugin_management.php';
		require get_template_directory() . '/framework/admin/inc/_theme_management.php';
		require get_template_directory() . '/framework/admin/inc/_admin_addons.php';
	}


	/**
	 * Setup the hooks, actions and filters.
	 *
	 * @uses add_action() To add actions.
	 * @uses add_filter() To add filters.
	 *
	 * @since 1.0.0
	 * @access private
	 * @codeCoverageIgnore
	 */
	private function init_actions() {

		/* Admin sctips and styles */
		add_action( 'admin_enqueue_scripts', array( $this, 'neko_admin_style') );	
		add_action( 'admin_enqueue_scripts', array( $this, 'neko_admin_scripts') );

		add_action( 'init', array( $this, 'adminpagefct') );
		add_action( 'init', array( $this, 'pluginsfct') );
		add_action( 'init', array( $this, 'themefct') );
		add_action( 'init', array( $this, 'adminAddnsfct') );

		/* TODO ADD USER OPTIONS HERE TOO FROM neko_actions.php and neko_filters.php */

	}

	/**
	 * Build admin page.
	 *
	 * @since 1.0.0
	 *
	 * @return Envato_Market_Admin
	 */
	public function adminpagefct() {
		return Neko_Build_Admin_Page::instance();
	}


	/**
	 * plugin management.
	 *
	 * @since 1.0.0
	 *
	 * @return Envato_Market_Admin
	 */
	public function pluginsfct() {
		return Neko_Plugin_Management::instance();
	}

	/**
	 * theme management.
	 *
	 * @since 1.0.0
	 *
	 * @return Envato_Market_Admin
	 */
	public function themefct() {
		return Neko_Theme_Management::instance();
	}

	/**
	 * admin addons.
	 *
	 * @since 1.0.0
	 *
	 * @return Envato_Market_Admin
	 */
	public function adminAddnsfct() {
		return Neko_Admin_Addons::instance();
	}

} /* END OF CLASS */

endif; /* END OF CLASS EXISTANCE CHECK */


if ( ! function_exists( 'neko_admin_management' ) ) :
	/**
	 * The main function responsible for returning the one true
	 * Envato_Market Instance to functions everywhere.
	 *
	 * Use this function like you would a global variable, except
	 * without needing to declare the global.
	 *
	 * Example: <?php $envato_market = envato_market(); ?>
	 *
	 * @since 1.0.0
	 * @return Envato_Market The one true Envato_Market Instance
	 */
function neko_admin_management() {
	return Neko_Admin::instance();
}
endif;

/**
 * Loads the main instance of Envato_Market to prevent
 * the need to use globals.
 *
 * @since 1.0.0
 * @return object Envato_Market
 */
add_action( 'after_setup_theme', 'neko_admin_management', 11 );



