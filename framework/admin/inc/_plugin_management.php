<?php 
if ( ! class_exists( 'Neko_Plugin_Management' ) ) :

	/**
	 * Creates the Envato API connection.
	 *
	 * @class Envato_Market_API
	 * @version 1.0.0
	 * @since 1.0.0
	 */
class Neko_Plugin_Management {


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
		 * [neko_plugin_link description]
		 * @param  [type] $item [description]
		 * @return [type]       [description]
		 */
		public function neko_plugin_link( $item ) {
			$installed_plugins = get_plugins();

			$item['sanitized_plugin'] = $item['name'];

		// We have a repo plugin
			if ( ! $item['version'] ) {
				$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
			}

			/* Install */
			if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
				$actions = array(
					'install' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Install %2$s">Install</a>',
						esc_url( wp_nonce_url(
							add_query_arg(
								array(
									'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'        => urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'plugin_source' => urlencode( $item['source'] ),
									'tgmpa-install' => 'install-plugin',
									'return_url'    => 'neko-welcome-page&tab=plugininstall'
									),
								TGM_Plugin_Activation::$instance->get_tgmpa_url()
								),
							'tgmpa-install',
							'tgmpa-nonce'
							) ),
						$item['sanitized_plugin']
						),
					);
			}

			/* Activate */
			elseif ( is_plugin_inactive( $item['file_path'] ) ) {
				$actions = array(
					'activate' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
						esc_url( add_query_arg(
							array(
								'plugin'               => urlencode( $item['slug'] ),
								'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
								'plugin_source'        => urlencode( $item['source'] ),
								'neko-activate'       => 'activate-plugin',
								'neko-activate-nonce' => wp_create_nonce( 'neko-activate' ),
								),
							admin_url( 'themes.php?page=neko-welcome-page&tab=plugininstall' )
							) ),
						$item['sanitized_plugin']
						),
					);
			}

			/* Update */
			elseif ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) && $item['name'] != 'WPBakery Visual Composer' ) {

				$actions = array(
					'update' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Install %2$s">Update</a>',
						wp_nonce_url(
							add_query_arg(
								array(
									'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'        => urlencode( $item['slug'] ),

									'tgmpa-update'  => 'update-plugin',
									'plugin_source' => urlencode( $item['source'] ),
									'version'       => urlencode( $item['version'] ),
									'return_url'    => 'neko-welcome-page&tab=plugininstall'
									),
								TGM_Plugin_Activation::$instance->get_tgmpa_url()
								),
							'tgmpa-update',
							'tgmpa-nonce'
							),
						$item['sanitized_plugin']
						),
					);

				/* Desctivate */
			} elseif ( is_plugin_active( $item['file_path'] ) ) {
				$actions = array(
					'deactivate' => sprintf(
						'<a href="%1$s" class="button button-secondary" title="Deactivate %2$s">Deactivate</a>',
						esc_url( add_query_arg(
							array(
								'plugin'                 => urlencode( $item['slug'] ),
								'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
								'plugin_source'          => urlencode( $item['source'] ),
								'neko-deactivate'       => 'deactivate-plugin',
								'neko-deactivate-nonce' => wp_create_nonce( 'neko-deactivate' ),
								),
							admin_url( 'themes.php?page=neko-welcome-page&tab=plugininstall' )
							) ),
						$item['sanitized_plugin']
						),
					);
			}

			return $actions;
		}		


	} /* END OF CLASS */

	endif;

