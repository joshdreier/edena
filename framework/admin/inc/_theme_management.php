<?php 
if ( ! class_exists( 'Neko_Theme_Management' ) ) :

	/**
	 * Creates the Envato API connection.
	 *
	 * @class Envato_Market_API
	 * @version 1.0.0
	 * @since 1.0.0
	 */
class Neko_Theme_Management {


		/**
		 * The single class instance.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var object
		 */
		private static $_instance = null;

		public $_tfuname          = '';
		public $_tftoken          = '';
		public $_tfpcode          = '';
		public $_registered_theme = '';
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
				self::$_instance->init_globals();
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
			add_action( 'wp_ajax_neko_theme_registration', array( $this, 'neko_theme_registration') );
			add_action( 'wp_ajax_upgrade-theme', array( $this, 'ajax_upgrade_theme' ) );
		}

		/**
		 * Setup the class globals.
		 *
		 * @since 1.0.0
		 * @access private
		 * @codeCoverageIgnore
		 */
		private function init_globals() {
			$this->_tfuname          = get_option( '_tftoken', '' );
			$this->_tftoken          = get_option( '_tftoken', '' );
			$this->_tfpcode          = get_option( '_tfpcode', '' );
			$this->_registered_theme = get_option( '_registered_theme', '' );
		}



		/**
		 * Product registration and auto update
		 * @return [type] [description]
		 */
		public function neko_theme_registration() {

			if (defined('DOING_AJAX') && DOING_AJAX ){

				/* CLEAN OPTIONS IF ALREADY SET */
				delete_option( '_tfuname' );
				delete_option( '_tftoken' );
				delete_option( '_tfpcode' );
				delete_option( '_registered_theme' );

				$data = $_POST;
				$this->_tfuname = !empty( $data['themeforest_username'] ) ? $data['themeforest_username'] : '';
				$this->_tftoken = !empty( $data['themeforest_token'] ) ? $data['themeforest_token'] : '';
				$this->_tfpcode = !empty( $data['themeforest_purchasecode'] ) ? $data['themeforest_purchasecode'] : '';


				/* Check that all required info are here */
				if ( !empty($this->_tfuname) && !empty($this->_tftoken) && !empty($this->_tfpcode) ) {
					
					/* 1 -> check pruchase code */
					$item_by_token = $this->_verifyToken();
					
					/* is not good */
					if( !$item_by_token ){
						echo esc_html__('No purchase belonging to the current user found with that code', 'neko');
					}else{

						/* Set user options after verification */
						add_option( '_tfuname', $this->_tfuname, '', $autoload = 'no' );
						add_option( '_tftoken', $this->_tftoken, '', $autoload = 'no' );
						add_option( '_tfpcode', $this->_tfpcode, '', $autoload = 'no' );

						/* Set registered theme options after verification */
						$registered_theme = $this->normalize_theme( $item_by_token );
						add_option( '_registered_theme', $registered_theme, '', $autoload = 'no' );


						echo $this->build_theme_card($registered_theme);
					}

				}

				die();
			}
		}

		/**
		 * [_verifyToken description]
		 * @return [type] [description]
		 */
		private function _verifyToken(){

			if ( empty( $this->_tfpcode ) ) {
				return false;
			}

			$url = 'https://api.envato.com/v3/market/buyer/purchase?code='.$this->_tfpcode;
			$response = $this->_request( $url );

			if ( is_wp_error( $response ) || empty( $response ) || empty( $response['code'] ) || $response['code'] !== $this->_tfpcode  ) {
				return false;
			}

			return $response;

		}

		/**
		 * calls to the Envato Api 
		 * @param  [type] $url  [description]
		 * @param  array  $args [description]
		 * @return [type]       [description]
		 */
		private function _request( $url, $args = array() ) {

			if ( empty( $this->_tftoken ) ) {
				return false;
			}

			$defaults = array(
				'headers' => array(
					'Authorization' => 'Bearer '.$this->_tftoken,
					),
				'timeout' => 20,
				);

			$args = wp_parse_args( $args, $defaults );


			$token = trim( str_replace( 'Bearer ', '', $args['headers']['Authorization'] ) );
			if ( empty( $token ) ) {
				return new WP_Error( 'api_token_error', esc_html__( 'An API token is required.', 'neko' ) );
			}

			// Make an API request.
			$response = wp_safe_remote_get( esc_url_raw( $url ), $args );

			// Check the response code.
			$response_code    = wp_remote_retrieve_response_code( $response );
			$response_message = wp_remote_retrieve_response_message( $response );

			if ( 200 !== $response_code && ! empty( $response_message ) ) {

				return new WP_Error( $response_code, $response_message );

			} elseif ( 200 !== $response_code ) {

				return new WP_Error( $response_code, esc_html__( 'An unknown API error occurred.', 'neko' ) );

			} else {

				$return = json_decode( wp_remote_retrieve_body( $response ), true );

				if ( null === $return ) {
					return new WP_Error( 'api_error', esc_html__( 'An unknown API error occurred.', 'neko' ) );
				}

				return $return;

			}
		}

		/**
		 * [get_envato_dowload_link description]
		 * @return [type] [description]
		 */
		public function get_envato_dowload_link(){

			if ( empty( $this->_tfpcode ) ) {
				return false;
			}

			$url = 'https://api.envato.com/v3/market/buyer/download?purchase_code='.$this->_tfpcode.'&shorten_url=true';
			$response = $this->_request( $url );

			if ( is_wp_error( $response ) || empty( $response ) || ! empty( $response['error'] ) ) {
				return false;
			}

			if ( ! empty( $response['wordpress_theme'] ) ) {
				return $response['wordpress_theme'];
			}

			return false;

		}





		/**
		 * Normalize a theme.
		 *
		 * @since 1.0.0
		 *
		 * @param  array $theme An array of API request values.
		 * @return array A normalized array of values.
		 */
		private function normalize_theme( $theme ) {
			return array(
				'id' => $theme['item']['id'],
				'name' => $theme['item']['wordpress_theme_metadata']['theme_name'],
				'author' => $theme['item']['wordpress_theme_metadata']['author_name'],
				'version' => $theme['item']['wordpress_theme_metadata']['version'],
				'description' => self::remove_non_unicode( $theme['item']['wordpress_theme_metadata']['description'] ),
				'url' => $theme['item']['url'],
				'author_url' => $theme['item']['author_url'],
				'thumbnail_url' => $theme['item']['previews']['landscape_preview']['landscape_url'],
				'rating' => $theme['item']['rating'],
				);
		}	

		/**
		 * Normalize a theme.
		 *
		 * @since 1.0.0
		 *
		 * @param  array $theme An array of API request values.
		 * @return array A normalized array of values.
		 */
		public function build_theme_card( $theme, $activate_action = false ) {
			$cards = '';

			$cards .= '<div class="theme-browser clearfix registered_theme_wrp"> <div class="themes">';
			
			$cards .= '<div class="theme">';

			$cards .= '<div class="theme-screenshot">';
			$cards .= '<img src="'.$theme['thumbnail_url'].'" alt="">';
			$cards .= '</div>';

			$cards .= '<div class="neko-theme-info">';
			$cards .= esc_html__('Version', 'neko').': '.$theme['version'];
			$cards .= '| <a href="'.$theme['author_url'].'" target="_blank">'.$theme['author'].'</a>';
			$cards .= '</div>';

			$cards .= '<h2 class="theme-name"><a href="'.$theme['url'].'" target="_blank">'.$theme['name'].'</h2></a>';

			/* Update action if not first intall and update is available */

			if( true === $activate_action && current_user_can( 'update_themes' ) ){

				$current_theme = wp_get_theme();
				$installed_theme_version = $current_theme->get( 'Version' );
				$tf_package_version = $this->_retrieve_current_package_version($theme['id']);


				if( version_compare( $installed_theme_version, $tf_package_version, '<' ) ){



					$upgrade_link = add_query_arg( array(
						'action' => 'upgrade-theme',
						'theme'  => esc_attr( 'edena' ),
						), self_admin_url( 'update.php' ) );

					$updateActions['update'] = sprintf(
						'<a class="update-now button button-primary" href="%1$s" aria-label="%2$s" data-name="%3$s %4$s" data-version="%4$s">%5$s</a>',
						wp_nonce_url( $upgrade_link, 'upgrade-theme' ),
						esc_attr__( 'Update %s now', 'neko' ),
						esc_attr( $theme['name'] ),
						esc_attr( $theme['version'] ),
						esc_html__( 'Update Available', 'neko' )
						);




					$cards .= '<div class="theme-actions">';
					$cards .= $updateActions['update'];
					$cards .= '</div>';			
				}

			}

			$cards .= '</div>';
			$cards .= '</div></div>';

			return $cards;

		}	



		/**
		 * Version of the current themeforest package
		 *
		 * @since 1.0.0
		 *
		 * @param string $retval The string to fix.
		 * @return string
		 */
		private function _retrieve_current_package_version( $item_id ) {

			if ( empty( $item_id ) || empty( $this->_tftoken ) ) {
				return false;
			}

			$args = array(
				'headers' => array(
					'Authorization' => 'Bearer '.$this->_tftoken,
					)
				);

			$url = 'https://api.envato.com/v3/market/catalog/item?id='.$item_id;
			$response = $this->_request( $url, $args );

			if ( is_wp_error( $response ) || empty( $response ) ) {
				return false;
			}



			return $response['wordpress_theme_metadata']['version'];
		}







		/**
		 * Remove all non unicode characters in a string
		 *
		 * @since 1.0.0
		 *
		 * @param string $retval The string to fix.
		 * @return string
		 */
		static private function remove_non_unicode( $retval ) {
			return preg_replace( '/[\x00-\x1F\x80-\xFF]/', '', $retval );
		}









	} /* END OF CLASS */

	endif;

