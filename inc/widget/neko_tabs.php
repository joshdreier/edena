<?php

function neko_tabs_widgetloader()
{
	register_widget('neko_tabs_widget');
}


add_action('widgets_init', 'neko_tabs_widgetloader');

class neko_tabs_widget extends WP_Widget {
	

	function neko_tabs_widget()
	{
		$widget_ops = array('classname' => 'neko_tabs', 'description' => 'Popular posts, recent post and comments.');

		$control_ops = array('id_base' => 'neko_tabs_widget');

		parent::__construct('neko_tabs_widget', '[ NEKO ] Tabs', $widget_ops, $control_ops);
	}
	

	
	function widget($args, $instance)
	{
		extract($args);

		if(!empty($instance['title'])){
			$title = apply_filters('widget_title', $instance['title']);
		}else{$title='';}

		$posts_num = $instance['posts_num'];
		$comments_num = $instance['comments_num'];
		$popular_posts_num = $instance['popular_posts_num'];
		$show_popular_posts = isset($instance['show_popular_posts']) ? true : false;
		$show_recent_posts = isset($instance['show_recent_posts']) ? true : false;
		$show_comments = isset($instance['show_comments']) ? true : false;
		
		// if( strpos($before_widget, 'class') === false ) {
		// 	$before_widget = str_replace('>', 'class="clearfix"', $before_widget);
		// }else {
		// 	$before_widget = str_replace('class="', 'class="clearfix ', $before_widget);
		// }


		echo trim( $before_widget );

		if($title) {
			echo trim( $before_title ).trim( $title ).trim( $after_title );
		}
		?>

		<div class="clearfix">
			<ul class="nav nav-tabs " id="neko_tabs_list">
				<?php
				if($show_popular_posts == true){ 
					echo '<li class="active"><a href="#neko-tabs-1" data-toggle="tab"><i class="icon-star"></i>'.esc_html__( 'Popular', 'neko' ).'</a></li>';
				}
				if($show_recent_posts == true){ 
					$active=($show_popular_posts == false) ? 'class="active"' : '';

					echo '<li '.$active.'><a href="#neko-tabs-2" data-toggle="tab"><i class="icon-edit"></i>'.esc_html__( 'Recents', 'neko' ).'</a></li>';
				}
				if($show_comments == true){
					$active=($show_recent_posts == false && $show_popular_posts == false) ? 'class="active"' : '';
					echo '<li '.$active.'><a href="#neko-tabs-3" data-toggle="tab"><i class="icon-comment"></i>'.esc_html__( 'Comments', 'neko' ).'</a></li>';
				}
				?>	
			</ul>
			<div class="tab-content">
				<?php
				if($show_popular_posts == true) {
					$popular_posts_list = new WP_Query( array( 'posts_per_page'=> $popular_posts_num ,'orderby' => 'comment_count', 'post__not_in' => get_option( 'sticky_posts' ), 'order' => 'DESC' ));
					
					?>
					<div class="tab-pane active" id="neko-tabs-1">
						<?php if($popular_posts_list->have_posts()){ ?>
						<ul class="media-list">
							<?php while($popular_posts_list->have_posts()): $popular_posts_list->the_post(); ?>
								<li class="media">
									<a class="pull-left" href="<?php the_permalink();?>" title="<?php the_title(); ?>">
										<?php if(has_post_thumbnail()){?>
										<?php the_post_thumbnail('img-x-small', array('class' => 'media-object')); ?>
										<?php } else { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/images/no_pic-62x62.jpg" alt="no-pics">
										<?php }  ?>
									</a>
									<div class="media-body">
										<h3><?php the_title(); ?></h3>
										<?php the_excerpt(); ?>
									</div>
								</li>
							<?php endwhile; ?>
						</ul>
						<?php }else{ ?>
							<p><?php esc_html_e('no popular post for now', 'neko'); ?></p>
						<?php } ?>
					</div>
					<?php
			}
			if($show_recent_posts == true){ 

				$active=($show_popular_posts == false) ? 'active' : '';
				$recent_posts_list = new WP_Query( array( 'posts_per_page'=> $posts_num, 'post__not_in' => get_option( 'sticky_posts' )));

				?>
				<div class="tab-pane  <?php echo esc_attr($active); ?>" id="neko-tabs-2">
					<?php if($recent_posts_list->have_posts()){ ?>
					<ul class="media-list">
						<?php while($recent_posts_list->have_posts()): $recent_posts_list->the_post(); ?>
							<li class="media">
								<a class="pull-left" href="<?php the_permalink();?>" title="<?php the_title(); ?>">
									<?php if(has_post_thumbnail()){?>
									<?php the_post_thumbnail('img-x-small', array('class' => 'media-object')); ?>
									<?php } else { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/no_pic-62x62.jpg" alt="no-pics">
									<?php }  ?>
								</a>
								<div class="media-body">
									<h3><span class="date"><?php echo get_the_date(); ?></span> <?php the_title(); ?></h3>
									<?php the_excerpt(); ?>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
					<?php }else{ ?>
						<p><?php esc_html_e('no recent post for now', 'neko'); ?></p>
					<?php } ?>
				</div>
				<?php
		}

		if($show_comments == true){ 

			$active=($show_recent_posts == false && $show_popular_posts == false) ? 'active' : '';
			$comment_list = get_comments(array('number' => $comments_num ));;
			?>

			<div class="tab-pane  <?php echo esc_attr($active); ?>" id="neko-tabs-3">
			<?php if(count($comment_list)>0){ ?>
				<ul class="media-list">
					<?php foreach($comment_list as $comment) : ?>
						<li class="media">

							<div class="media-body">
								<h3><span class="date"><?php echo($comment->comment_date); ?></span></h3>
								<?php echo($comment->comment_content); ?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php }else{ ?>
					<p><?php esc_html_e('no comment for now', 'neko'); ?></p>
				<?php } ?>
			</div>
			

		</div>
	</div>
	<?php  } ?>

	<?php echo wp_kses_post( $after_widget );
}

function update($new_instance, $old_instance)
{	
	$instance['title'] = $new_instance['title'];
	$instance['posts_num'] = $new_instance['posts_num'];
	$instance['comments_num'] = $new_instance['comments_num'];
	$instance['popular_posts_num'] = $new_instance['popular_posts_num'];
	$instance['show_popular_posts'] = $new_instance['show_popular_posts'];
	$instance['show_recent_posts'] = $new_instance['show_recent_posts'];
	$instance['show_comments'] = $new_instance['show_comments'];
	return $instance;
}

function form($instance)
{
	$defaults = array('title'=> 'latest updates', 'popular_posts_num'=> '3', 'posts_num' => 3, 'comments_num' => '3',  'show_popular_posts' => 'on', 'show_recent_posts' => 'on', 'show_comments' => 'on');
	$instance = wp_parse_args((array) $instance, $defaults); ?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title:</label>
		<input class="widefat"  type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	</p>
	<p>
		<input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('show_popular_posts') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_popular_posts') ); ?>" /> 
		<label for="<?php echo esc_attr( $this->get_field_id('show_popular_posts') ); ?>">Display popular posts</label>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id('popular_posts_num') ); ?>">Number of popular posts:</label>
		<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('popular_posts_num') ); ?>" name="<?php echo esc_attr( $this->get_field_name('popular_posts_num') ); ?>" value="<?php echo esc_attr( $instance['popular_posts_num'] ); ?>" />
	</p>
	<p>
		<input class="checkbox" type="checkbox" <?php checked($instance['show_recent_posts'], 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('show_recent_posts') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_recent_posts') ); ?>" /> 
		<label for="<?php echo esc_attr( $this->get_field_id('show_recent_posts') ); ?>">Display recent posts</label>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id('posts_num') ); ?>">Number of recent posts:</label>
		<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('posts_num') ); ?>" name="<?php echo esc_attr( $this->get_field_name('posts_num') ); ?>" value="<?php echo esc_attr( $instance['posts_num'] ); ?>" />
	</p>
	<p>
		<input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo esc_attr( $this->get_field_id('show_comments') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_comments') ); ?>" /> 
		<label for="<?php echo esc_attr( $this->get_field_id('show_comments') ); ?>">Display comments</label>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id('comments_num') ); ?>">Number of comments:</label>
		<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('comments_num') ); ?>" name="<?php echo esc_attr( $this->get_field_name('comments_num') ); ?>" value="<?php echo esc_attr( $instance['comments_num'] ); ?>" />
	</p>

	<?php
}
}

?>