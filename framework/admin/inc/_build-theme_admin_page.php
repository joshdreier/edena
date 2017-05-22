<?php 
if ( ! class_exists( 'Neko_Build_Admin_Page' ) ) :

	/**
	 * Creates the Envato API connection.
	 *
	 * @class Envato_Market_API
	 * @version 1.0.0
	 * @since 1.0.0
	 */
class Neko_Build_Admin_Page {


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
		 * Main Envato_Market_API Instance
		 *
		 * Ensures only one instance of this class exists in memory at any one time.
		 *
		 * @see Envato_Market_API()
		 * @uses Envato_Market_API::init_globals() Setup class globals.
		 * @uses Envato_Market_API::init_actions() Setup hooks and actions.
		 *
		 * @since 1.0.0
		 * @static
		 * @return object The one true Envato_Market_API.
		 * @codeCoverageIgnore
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
				self::$_instance->init_actions();
			}
			return self::$_instance;
		}

		/**
		 * A dummy constructor to prevent this class from being loaded more than once.
		 *
		 * @see Envato_Market_API::instance()
		 *
		 * @since 1.0.0
		 * @access private
		 * @codeCoverageIgnore
		 */
		private function __construct() {
			/* We do nothing here! */
		}

		/**
		 * You cannot clone this class.
		 *
		 * @since 1.0.0
		 * @codeCoverageIgnore
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'neko' ), '1.0.0' );
		}

		/**
		 * You cannot unserialize instances of this class.
		 *
		 * @since 1.0.0
		 * @codeCoverageIgnore
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'neko' ), '1.0.0' );
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
			/* Add theme page for activation page */
			add_action('admin_menu',  array( $this, 'neko_add_activation_page') );

			/* Activate and desactivate plugin management from Activation page */
			add_action( 'admin_init', array( $this, 'neko_admin_init') );

			/* Redirecto to actiation page after theme activation */
			$this->redirect_after_theme_activation();		
		}

	/**
	 * Activation and management pages for neko theme
	 * @return [type] [description]
	 */
	public function neko_add_activation_page(){

		$current_theme = wp_get_theme();
		$theme_name = ucfirst( $current_theme->get( 'Name' ) );

		add_theme_page(
			$theme_name, 
			$theme_name, 
			'edit_theme_options', 
			'neko-welcome-page', 
			array( $this, 'neko_build_activation_page' )
			);
	}

	/**
	 * Build acivation page content
	 * @return [type] [description]
	 */
	public function neko_build_activation_page(){

		if (!current_user_can('edit_theme_options')) {
			wp_die('You do not have sufficient permissions to access this page.');
		}

		$current_theme = wp_get_theme();
		$theme_name = ucfirst( $current_theme->get( 'Name' ) );
		$theme_parent_name = '';

		if( is_child_theme() ){
			$theme_parent_name = $current_theme->parent()->Name;
			$theme_version = $current_theme->parent()->Version;
		}else{
			$theme_version = $current_theme->get( 'Version' );
		}


		/* Tabs */
		$tabs = array(
			//'product-registration' => esc_html__('Product registration', 'neko'), 
			'configuration'        => esc_html__('Configuration', 'neko'),
			'plugininstall'        => esc_html__('Install plugins', 'neko'), 
			'documentation'        => esc_html__('Documentation & support', 'neko')
			);

		$active_tab = ( isset( $_GET[ 'tab' ] ) ) ? $_GET[ 'tab' ] : 'configuration' ;
		?>

		<div class="wrap neko-admin-system about-wrap" id="neko-theme-welcome-page">

			<div class="wp-badge vc-page-logo"> <span><?php if( !empty($theme_parent_name) ) { esc_html_e('P Version:', 'neko'); }else{ esc_html_e('Version:', 'neko'); } ?> <?php echo esc_attr($theme_version); ?></span>	</div>

			<h1><?php esc_html_e('Welcome to', 'neko'); ?> <?php echo $theme_name; ?> <?php if( !empty($theme_parent_name) ) { echo '( '. $theme_parent_name .' )'; }?></h1>
			<p class="neko-welcome-message">
				<?php 
				printf( wp_kses_post( __( '<strong>Congratulations!</strong> Your premium Little Neko Theme is correctly installed.<br/>There are some steps you need to take to get the most out of %1$s.<br/>Please navigate through all the sections below and follow instructions to set up your server and all the needed plugins that comes with your new theme.', 'neko' ) ), $theme_name ); 
				?>

			</p>

			<div class="welcome-content">

				<h2 class="nav-tab-wrapper">	
					<?php
					foreach( $tabs as $tab => $name ){
						$class = ( $tab == $active_tab  ) ? ' nav-tab-active' : '';
						echo "<a class='nav-tab$class' href='?page=neko-welcome-page&tab=$tab'>$name</a>";
					}
					?>
				</h2>


				<?php
				if (  $active_tab == 'product-registration' ){
					require_once( get_template_directory() . '/framework/admin/admin-tabs/product-registration.php' );
				}elseif (  $active_tab == 'configuration' ){
					require_once( get_template_directory() . '/framework/admin/admin-tabs/configuration.php' );
				}elseif( $active_tab == 'plugininstall' ){
					require_once( get_template_directory() . '/framework/admin/admin-tabs/install-plugins.php' );
				}elseif( $active_tab == 'documentation' ){
					require_once( get_template_directory() . '/framework/admin/admin-tabs/documentation-support.php' );
				}
				?>

			</div>
		</div>
		<?php
	}

	/**
	 * Actions to run on initial theme activation
	 * @since 3.8.0	 
	 */

		public function neko_admin_init() {

			if ( current_user_can( 'edit_theme_options' ) ) {


				if ( isset( $_GET['neko-deactivate'] ) && $_GET['neko-deactivate'] == 'deactivate-plugin' ) {
					check_admin_referer( 'neko-deactivate', 'neko-deactivate-nonce' );

					$plugins = TGM_Plugin_Activation::$instance->plugins;

					foreach( $plugins as $plugin ) {
						if ( $plugin['slug'] == $_GET['plugin'] ) {
							deactivate_plugins( $plugin['file_path'] );

							wp_redirect( admin_url( 'admin.php?page=neko-welcome-page&tab=plugininstall' ) );
						}
					}
				} if ( isset( $_GET['neko-activate'] ) && $_GET['neko-activate'] == 'activate-plugin' ) {
					check_admin_referer( 'neko-activate', 'neko-activate-nonce' );

					$plugins = TGM_Plugin_Activation::$instance->plugins;

					foreach( $plugins as $plugin ) {
						if ( $plugin['slug'] == $_GET['plugin'] ) {
							activate_plugin( $plugin['file_path'] );

							wp_redirect( admin_url( 'admin.php?page=neko-welcome-page&tab=plugininstall' ) );
							exit;
						}
					}
				}
			}
		}




	/**
	 * [redirect_after_theme_activation description]
	 * @return [type] [description]
	 */
	public function redirect_after_theme_activation(){
		global $pagenow;
		if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
		{
			wp_redirect( admin_url( 'themes.php?page=neko-welcome-page' ) );
			exit;
		}
	}


		/**
		 * [let_to_num description]
		 * @param  [type] $size [description]
		 * @return [type]       [description]
		 */
		public function let_to_num( $size ) {
			$l   = substr( $size, -1 );
			$ret = substr( $size, 0, -1 );
			switch ( strtoupper( $l ) ) {
				case 'P':
				$ret *= 1024;
				case 'T':
				$ret *= 1024;
				case 'G':
				$ret *= 1024;
				case 'M':
				$ret *= 1024;
				case 'K':
				$ret *= 1024;
			}
			return $ret;
		}


} /* END OF CLASS */

endif;
