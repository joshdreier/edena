<?php 
if ( ! class_exists( 'Neko_Admin_Addons' ) ) :

	/**
	 * Creates the Envato API connection.
	 *
	 * @class Envato_Market_API
	 * @version 1.0.0
	 * @since 1.0.0
	 */
class Neko_Admin_Addons {


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
		add_action( 'show_user_profile', array( $this, 'user_profile_fields') );
		add_action( 'edit_user_profile', array( $this, 'user_profile_fields') );
		add_action( 'personal_options_update',  array( $this, 'extra_user_profile_fields') );
		add_action( 'edit_user_profile_update',  array( $this, 'extra_user_profile_fields') );

		add_filter( 'user_contactmethods', array( $this, 'add_to_author_profile' ), 10, 1);

	}


	/**
	 * [user_profile_fields description]
	 * @param  [type] $user [description]
	 * @return [type]       [description]
	 */
	public function user_profile_fields( $user ) {
		/* INIT */
		$user_profile_fields = '';


		$user_profile_fields .= '
		<h3>'.esc_html_e("Custom Social network informations", "neko").'</h3>
		<div class="custom-network-main-wrapper">';

			$array_custom_field = get_the_author_meta( 'custom_network', $user->ID );
			if(empty($array_custom_field)){ 

				$user_profile_fields .= '
				<div class="custom-network-wrapper">
					<table class="form-table">
						<tbody class="custom-network-body">
							<tr>
								<th><label for="address">'.esc_html__("Network name", "neko").'</label></th>
								<td>
									<input type="text" name="custom_network[0][name]" id="address" value="" class="regular-text" /><br />
									<span class="description">'.esc_html__("Please enter the name of your social network.", "neko").'</span>
									<button class="delete-bloc button-secondary"  type="button">'.esc_html__('Delete', 'neko').'</button>
								</td>
							</tr>
							<tr>
								<th><label for="address">'.esc_html__("Network url", "neko").'</label></th>
								<td>
									<input type="text" name="custom_network[0][url]" id="address" value="" class="regular-text" /><br />
									<span class="description">'.esc_html__("Please enter the url of your social network.", "neko").'</span>
								</td>
							</tr>
							<tr>
								<th><label for="address">'.esc_html__("Network icon", "neko").'</label></th>
								<td>
									<input type="text" name="custom_network[0][icon]" id="address" value="" class="regular-text" /><br />
									<span class="description">
										'.esc_html__("Please enter the icon of your social network.", "neko").'
										<a href="'.get_stylesheet_directory_uri().'/font-icons/neko-social-icons/demo.html" target="_blank">
											'.esc_html__('click here to see a list of all font icons available in your neko theme', 'neko').'
										</a>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>';

			} else {
				foreach ($array_custom_field as $key => $value) {

					$user_profile_fields .= '
					<div class="custom-network-wrapper">
						<table class="form-table">
							<tbody class="custom-network-body">
								<tr>
									<th><label>'.esc_html__("Network name", "neko").'</label></th>
									<td class="td-relative">
										<input type="text" name="custom_network['.esc_attr($key).'][name]"  value="'.esc_attr( $value['name'] ).'" class="regular-text" /><br />
										<span class="description">'.esc_html__("Please enter the name of your social network.", "neko").'</span>
										<button class="delete-bloc button-secondary"  type="button">'.esc_html__('Delete', 'neko').'</button>
									</td>
								</tr>

								<tr>
									<th><label>'.esc_html__("Network url", "neko").'</label></th>
									<td>
										<input type="text" name="custom_network['.esc_attr($key).'][url]"  value="'.esc_attr( $value['url'] ).'" class="regular-text" /><br />
										<span class="description">'.esc_html__("Please enter the url of your social network.", "neko").'</span>
									</td>
								</tr>

								<tr>
									<th><label>'.esc_html__("Network icon", "neko").'</label></th>
									<td>
										<input type="text" name="custom_network['.esc_attr($key).'][icon]"  value="'.esc_attr( $value['icon'] ).'" class="regular-text" /><br />
										<span class="description">
											'.esc_html__("Please enter the icon of your social network.", "neko").'
											<a href="'.get_stylesheet_directory_uri().'/font-icons/neko-social-icons/demo.html" target="_blank">
												'.esc_html__('click here to see a list of all font icons available in your neko theme', 'neko').'
											</a>
										</span>
									</td>
								</tr>

							</tbody>

						</table>
					</div>';
				}

			}

			$user_profile_fields .= '
		</div>
		<div id="add-custom-network">
			<button class="button button-secondary" id="">add a custom network</button>
		</div>';

		echo $user_profile_fields;
	}



	/**
	 * [user_profile_fields description]
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	public function extra_user_profile_fields( $user_id ) {
		if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
		update_user_meta( $user_id, 'custom_network', $_POST['custom_network'] );
	}	



	public function add_to_author_profile( $contactmethods ) {

		$contactmethods['rss_url']            = esc_html__('RSS URL', 'neko');
		$contactmethods['google_profile']     = esc_html__('Google Profile URL', 'neko');
		$contactmethods['twitter_profile']    = esc_html__('Twitter Profile URL', 'neko');
		$contactmethods['facebook_profile']   = esc_html__('Facebook Profile URL', 'neko');
		$contactmethods['linkedin_profile']   = esc_html__('Linkedin Profile URL', 'neko');
		$contactmethods['github_profile']     = esc_html__('Github Profile URL', 'neko');
		$contactmethods['flickr_profile']     = esc_html__('Flickr Profile URL', 'neko');
		$contactmethods['dribbble_profile']   = esc_html__('Dribbble Profile URL', 'neko');
		$contactmethods['tumblr_profile']     = esc_html__('Tumblr Profile URL', 'neko');
		$contactmethods['reddit_profile']     = esc_html__('Reddit Profile URL', 'neko');
		$contactmethods['deviantart_profile'] = esc_html__('Deviantart Profile URL', 'neko');
		$contactmethods['vimeo_profile']      = esc_html__('Vimeo Profile URL', 'neko');
		$contactmethods['youtube_profile']    = esc_html__('Youtube Profile URL', 'neko');

		return $contactmethods;
	}


	} /* END OF CLASS */

	endif;
