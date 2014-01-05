<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Tabbed Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show recent posts and comments.
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/



/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'CT_tabbed_widget' );

function CT_tabbed_widget() {
	register_widget( 'CT_Tabbed' );
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Tabbed extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function  CT_Tabbed() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ct-tabbed-widget', 'description' => __( 'A widget that show popular posts' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct-tabbed-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'ct-tabbed-widget', __('CT: Tabbed Widget', 'color-theme-framework'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		
		global $wpdb;
		$time_id = rand();

		/* Our variables from the widget settings. */
		$title = $instance['title'];
		$title2 = $instance['title2'];
		$num_posts = $instance['num_posts'];
		$categories = $instance['categories'];
		$show_image = isset($instance['show_image']) ? 'true' : 'false';
		$theme_orderby = $instance['theme_orderby'];
		$show_comments = isset($instance['show_comments']) ? 'true' : 'false';
		$show_date = isset($instance['show_date']) ? 'true' : 'false';
		$show_category = isset($instance['show_category']) ? 'true' : 'false';
		$show_avatar = isset($instance['show_avatar']) ? 'true' : 'false';
		$num_comments = $instance['num_comments'];
		$comment_len = $instance['comment_len'];

echo $before_widget;
		/* Before widget (defined by themes). */
		echo "\n<!-- START POPULAR POSTS WIDGETS -->\n";

		/* Display the widget title if one was input (before and after defined by themes). */
		?>
			
		<?php 
			global $post, $data;

				$recent_posts = new WP_Query(array(
					'showposts' => $num_posts,
					'cat' => $categories,
				));		


		$recent_comments = get_comments( array(
    		'number'    => $num_comments,
    		'status'    => 'approve'
		) );
		?>


		<!-- Tabs -->
		<section id="ct-tabs-<?php echo $time_id; ?>" class="ct-tabs">
        	<ul id="ctTab-<?php echo $time_id; ?>" class="nav nav-tabs">
            	<li class="active">
            		<a href="#ct-posts" data-toggle="tab"><?php echo $title; ?></a>
            	</li>

            	<li class="">
	            	<a href="#ct-comments" data-toggle="tab"><?php echo $title2; ?></a>
            	</li>
         	</ul>

          	<div id="ctTabContent-<?php echo $time_id; ?>" class="tab-content">
            	
          		<!-- Start Recent Posts -->
            	<div class="tab-pane fade active in" id="ct-posts">
					<ul class="widget-one-column-horizontal recent-widget-<?php echo $time_id; ?>">
					
						<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
					  <li class="clearfix">					  
						<?php if( $show_image == 'true' ): ?>
						  <?php if(has_post_thumbnail()): ?>
				    		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-thumb'); 
				    		if ( $image[1] == 50 && $image[2] == 50 ) : //if has generated thumb ?>
					 		  <div class="widget-thumb">
								
								<?php							
						 		  	$format = get_post_format();

					 		  		if ( false === $format ) { 
					 		  			echo '<div class="widget-thumb-format-standard"></div>';
					 		  		} else {
							 		  	if ( $format == 'video' ) echo '<div class="widget-thumb-format-video"></div>';
							 		  	if ( $format == 'gallery' ) echo '<div class="widget-thumb-format-gallery"></div>';						 		  	
							 		  	if ( $format == 'audio' ) echo '<div class="widget-thumb-format-audio"></div>';						 		  	
							 		  	if ( $format == 'image' ) echo '<div class="widget-thumb-format-image"></div>';						 		  	
						 		  	}

					 		  	
						 		?>  	
							    <a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
					  		  </div><!-- widget-thumb -->
							<?php else : // else use standard 150x150 thumb
			  		  		  $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?>
					 	 	  <div class="widget-thumb">
								<?php							
						 		  	$format = get_post_format();

					 		  		if ( false === $format ) { 
					 		  			echo '<div class="widget-thumb-format-standard"></div>';
					 		  		} else {
							 		  	if ( $format == 'video' ) echo '<div class="widget-thumb-format-video"></div>';
							 		  	if ( $format == 'gallery' ) echo '<div class="widget-thumb-format-gallery"></div>';						 		  	
							 		  	if ( $format == 'audio' ) echo '<div class="widget-thumb-format-audio"></div>';						 		  	
							 		  	if ( $format == 'image' ) echo '<div class="widget-thumb-format-image"></div>';						 		  	
						 		  	}

						 		?>  	
					 	 	  
							    <a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
					  		  </div><!-- widget-post-small-thumb -->
					  		<?php endif; ?>
						  <?php endif; ?><!-- has_post_thumbnail -->
						<?php endif; ?><!-- show_image -->

			<!-- Start ENTRY INFO POST -->
			<div class="entry-info-post<?php if ( !has_post_thumbnail() || $show_image == 'false' ) echo ' no-margin'; ?>">
			
			<?php
			$post_type = get_post_meta($post->ID, 'ct_post_type', true);
			if( $post_type == '' ) $post_type = 'standard_post';

			if ( $post_type == 'review_post' ) 
			{			
				get_template_part('rating' , 'system' );								
			}	
			else 
				if ( $post_type == 'standard_post' && $show_category == 'true' ) : ?>	
				<span class="entry-post-category">
				  	<?php	  
				  		$category = get_the_category(); 
						$category_id = get_cat_ID( $category[0]->cat_name ); 
						$category_link = get_category_link( $category_id ); 
					?>					  		

				  		<a href="<?php echo $category_link ?>" title="<?php echo __('Ver todos ('.$category[0]->count.') em ', 'color-theme-framework'); echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name ?></a>							  	

				</span>  
				<?php endif; ?>
				
				
				<div class="post-title">
						  <a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><?php the_title(); ?></a>
				</div><!-- post-title -->
						

				<?php if ( $show_date == 'true' ) : ?>
				  <span class="date-ico">
				  	<?php the_time('d F, Y'); ?>
				  </span><!-- date-ico -->						

			  
				<?php endif; ?>
				
				<?php if ( $show_comments == 'true' ) : ?>				
<?php
echo '<span class="comments-ico">';				 
       comments_popup_link( __( 'sem comentários' , 'color-theme-framework' ) , __( '1 comment' , 'color-theme-framework' ) , __( '% comments' , 'color-theme-framework' ) , '', __( 'Comments are off' , 'color-theme-framework' ) ); 

echo '</span>';
?>
				<?php endif; ?>
				
				</div> <!-- /entry-info-post -->	
			</li>
						<?php endwhile; ?>
					</ul>
            	</div><!-- .tab-pane -->


				<!-- Start Recent Comments -->
            	<div class="tab-pane fade" id="ct-comments">
					<ul class="recent-comments-widget recent-widget-<?php echo $time_id; ?>">
						<?php foreach( $recent_comments as $comment ) { ?>
							<li class="clearfix">
								<?php
								if( $show_avatar == 'true' ) {
									echo '<div class="widget-thumb">'."\n";
									echo get_avatar( $comment, $size='50', $default='' );
									echo '</div><!-- widget-thumb -->'."\n";
								} ?>
					
								<div class="entry-info-post<?php if ( $show_avatar == 'false' ) echo ' no-margin'; ?>">
									<span class="meta-comment-by">
										<?php echo dp_get_author($comment); ?> said </span><br/>
							 			<a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>">
										<?php		 
											echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len ) ) . ' ...'; 
										?>
									</a>

									<div class="meta">
			  							<span class="date-ico" title="Date">
			  								<?php comment_date( 'd F, Y', $comment->comment_ID ); ?>
	            						</span>
									</div> <!-- /meta -->
										
						  		</div> <!-- /entry-info-post -->				
							</li> 
						<?php } ?>
					</ul><!-- .recent-comments-widget -->
            	</div><!-- .tab-pane -->
          	</div><!-- .tab-content -->
    	</section>







		<?php
		/* After widget (defined by themes). */
		echo $after_widget;

	 	// Restor original Query & Post Data
		wp_reset_query();
		wp_reset_postdata();		
		}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['title2'] = strip_tags( $new_instance['title2'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['num_posts'] = $new_instance['num_posts'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['theme_orderby'] = $new_instance['theme_orderby'];
		$instance['show_comments'] = $new_instance['show_comments'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_category'] = $new_instance['show_category'];
		$instance['show_avatar'] = $new_instance['show_avatar'];
		$instance['num_comments'] = $new_instance['num_comments'];
		$instance['comment_len'] = $new_instance['comment_len'];

		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __( 'Recent Posts' , 'color-theme-framework' ),
			'title2' => __( 'Recent Comments' , 'color-theme-framework' ),
			'num_posts' => 4,
			'categories' => 'all',
			'show_image'=>'on', 
			'show_comments'=>'on',
			'show_date'=>'on',
			'show_category' => 'on',
			'show_avatar'=>'on',
			'num_comments' => 4,
			'comment_len' => 70,
			'theme_orderby' => 'comments'
		);

		$instance = wp_parse_args((array) $instance, $defaults); 
 ?>

	
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title1:' , 'color-theme-framework' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('title2'); ?>"><?php _e( 'Title2:' , 'color-theme-framework' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" value="<?php echo $instance['title2']; ?>" />
		</p>		
	
		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
		</p>


		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e( 'Show thumbnail image' , 'color-theme-framework' ); ?></label>
		</p>

		<p style="margin-top: 20px;">
			<label style="font-weight: bold;"><?php _e( 'Post meta info' , 'color-theme-framework' ); ?></label>
		</p>


		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo $this->get_field_id('show_comments'); ?>" name="<?php echo $this->get_field_name('show_comments'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_comments'); ?>"><?php _e( 'Show comments' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show date' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_category'], 'on'); ?> id="<?php echo $this->get_field_id('show_category'); ?>" name="<?php echo $this->get_field_name('show_category'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_category'); ?>"><?php _e( 'Show category' , 'color-theme-framework' ); ?></label>
		</p>


		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category:' , 'color-theme-framework' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ( 'all' == $instance['categories'] ) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
				<?php foreach( $categories as $category ) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>


		<p style="margin-top: 30px;">
			<label style="font-weight: bold;"><?php _e( 'Recent Comment Settings' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_avatar'], 'on'); ?> id="<?php echo $this->get_field_id('show_avatar'); ?>" name="<?php echo $this->get_field_name('show_avatar'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_avatar'); ?>"><?php _e( 'Show avatar' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_comments'); ?>"><?php _e( 'Number of comments:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('num_comments'); ?>" name="<?php echo $this->get_field_name('num_comments'); ?>" value="<?php echo $instance['num_comments']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('comment_len'); ?>"><?php _e( 'Comments lenght:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="300" class="widefat" id="<?php echo $this->get_field_id('comment_len'); ?>" name="<?php echo $this->get_field_name('comment_len'); ?>" value="<?php echo $instance['comment_len']; ?>" />
		</p>

	<?php 
	}
}

?>