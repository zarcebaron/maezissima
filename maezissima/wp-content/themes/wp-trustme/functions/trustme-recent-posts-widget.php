<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Recent Posts Widget For Sidebar
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show recent posts
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'CT_posts_load_widgets' );

function CT_posts_load_widgets()
{
	register_widget('CT_Recent_Posts_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Recent_Posts_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function CT_Recent_Posts_Widget()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'ct_posts_widget', 'description' => __( 'Display Recent Posts by Categories' , 'color-theme-framework' ) );
		
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_posts_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'ct_posts_widget', __( 'CT: Recent Posts' , 'color-theme-framework' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$categories = $instance['categories'];
		$num_posts = $instance['num_posts'];

		$show_image = isset($instance['show_image']) ? 'true' : 'false';
		$show_category = isset($instance['show_category']) ? 'true' : 'false';
		$show_date = isset($instance['show_date']) ? 'true' : 'false';		
		$show_comments = isset($instance['show_comments']) ? 'true' : 'false';				

		
		echo $before_widget;

		?>
		<!-- BEGIN WIDGET -->

			<?php
			if ($title) {
				 echo $before_title.$title.$after_title;
				
			}
			
			?>
		
		<?php 
			global $post, $data;

			  $recent_posts = new WP_Query(array('showposts' => $num_posts, 'post_type' => 'post', 'cat' => $categories));
				$counter = 1;
		?>
	
		<ul class="recent-post-widget">
				  <?php while($recent_posts->have_posts()): $recent_posts->the_post();
				    if( $counter >= 1 ) { ?>
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
				 
				
				<!-- Post Title -->
				  <div class="post-title"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></div><!-- post-title -->


				
				<?php if ( $show_date == 'true' ) : ?>
				  <span class="date-ico"><?php the_time('d F, Y'); ?></span><!-- meta-time -->						
				<?php endif; ?>
				  				  
				  <div class="meta-comments">
				  <?php
				  	if ( $show_comments == 'true' ) : 
						echo '<span class="comments-ico">';				 
					   comments_popup_link( __( 'sem comentários' , 'color-theme-framework' ) , __( '1 comment' , 'color-theme-framework' ) , __( '% comments' , 'color-theme-framework' ) , '', __( 'Comments are off' , 'color-theme-framework' ) ); 
						echo '</span>';
					endif;	
					?>
				  </div><!-- meta-comments -->

</div> <!-- /entry-info-post -->

			</li>

					<?php
					}
				    $counter++;
					endwhile; ?>
		</ul><!-- recent-post-widget -->

		
	<?php
		 // Restor original Query & Post Data
		  wp_reset_query();
		  wp_reset_postdata();
	  ?>

		<?php
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['num_posts'] = $new_instance['num_posts'];

		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_category'] = $new_instance['show_category'];
		$instance['blank_thumb'] = $new_instance['blank_thumb'];
		$instance['show_date'] = $new_instance['show_date'];		
		$instance['show_comments'] = $new_instance['show_comments'];				
				
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
		$defaults = array('title' => __( 'Recent Posts' , 'color-theme-framework' ) , 'categories' => 'all', 'num_posts' => 4, 'show_image' => 'on', 'show_category' => 'on', 'show_comments' => 'on', 'show_date' => 'on' );
		$instance = wp_parse_args((array) $instance, $defaults);
 ?>

		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
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

		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e( 'Show thumbnail image' , 'color-theme-framework' ); ?></label>
		</p>


		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_category'], 'on'); ?> id="<?php echo $this->get_field_id('show_category'); ?>" name="<?php echo $this->get_field_name('show_category'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_category'); ?>"><?php _e( 'Show post category' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo $this->get_field_id('show_comments'); ?>" name="<?php echo $this->get_field_name('show_comments'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_comments'); ?>"><?php _e( 'Show comments for posts' , 'color-theme-framework' ); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show date for posts' , 'color-theme-framework' ); ?></label>
		</p>
        		
	<?php 
	}
}
?>