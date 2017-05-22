	<div class="neko-tab-content">
		<h2><?php esc_html_e( 'Documentation', 'neko' ); ?></h2>	
		<p>
		<?php
			printf(
				wp_kses_post(
					__(
						'Your premium Little Neko theme %1$s comes with a premium documentation as well.<br/> 
						This doc will help you get started in no time. You\'ll find everything you need to know to customize your posts and pages with no coding backgournd.<br/> 
					  We have created a set of options and custom addons to help you build the website you\'ve always desired.<br/><br/> 
					  %2$s', 'neko'
					)
				),
				$theme_name,
				'<a href="http://demo.little-neko.com/'.strtolower($theme_name).'-theme/documentation/" title="'.$theme_name.' documentation" target="_blank" class="button button-primary">The documentation</a>'
				);
		?>
		</p>
		<br/><br/>
		<h2>Support</h2>
		<p>
		<?php
			printf(
				wp_kses_post(
					__(
						'We also provide premium support for our beloved users. Feel free to ask our moderators and community for help.<br/>
						We will do our best to assist you with any issues/bugs related to the use of our themes and templates.<br/>
						Register first and ask your question and be sure that our team will be by your side every step of the way.<br/><br/> 
					  %1$s', 'neko'
					)
				),
				'<a href="http://support.little-neko.com/wp-login.php?action=register" title="Little neko support forum" target="_blank" class="button button-primary">register for support</a>'
				);
		?>
		</p>


	</div>