<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT 1 Column Horizontal  Magazine Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show recent posts by categories
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/

/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init', 'CT_1_1column_load_widgets');

function CT_1_1column_load_widgets()
{
	register_widget('CT_1_1Column_Widget');
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_1_1Column_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function CT_1_1Column_Widget()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'ct_1_1column_widget', 'description' => __( '1 Column Horizontal Magazine Widget (show recent posts).' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_1_1column_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'ct_1_1column_widget', __( 'CT: 1 Column Horizontal Magazine Widget' , 'color-theme-framework' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$show_image = isset($instance['show_image']) ? 'true' : 'false';
		$show_date = isset($instance['show_date']) ? 'true' : 'false';		
		$show_comments = isset($instance['show_comments']) ? 'true' : 'false';				
		$show_category = isset($instance['show_category']) ? 'true' : 'false';						
		$show_excerpt = isset($instance['show_excerpt']) ? 'true' : 'false';				

		echo $before_widget;

		
		global $post;		
		?>
		

			<?php
			if ($title) {
				 echo $before_title.$title.$after_title;
				
			}
			
			?>
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => 1,
				'post_type' => 'post',
				'cat' => $categories,
			));
			?>

			<div class="row-fluid one-column-widget">
			  <div class="span6">
				<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
				  <?php 
					  if ( has_post_format ( 'video' ) ) { 
							get_template_part( 'widget' , 'video' );			
						} 
				   ?>
						
					<?php 
						if ( has_post_format( 'gallery' ) ) {
							get_template_part( 'widget' , 'gallery' );
						} 
					?>

					<?php 
						if ( has_post_format( 'audio' ) ) {
							get_template_part( 'widget' , 'audio' );											
						} 
					?>
						
					<?php 

				    if( has_post_thumbnail() && !has_post_format('gallery') && !has_post_format('video') && !has_post_format('audio') ) : ?>
				    <div class="single-media-thumb">
					<?php
								

							$format = get_post_format();

							if ( false === $format ) 
							{
								echo '<div class="post-format-block" title="'.__('Post format: Standard','color-theme-framework').'"><div class="format-standard"></div></div>';								
							} 
							else 
				      		  if ( has_post_format('image') ) 
				      		  {
				      		  	echo '<div class="post-format-block" title="'.__('Post format: Image','color-theme-framework').'"><div class="format-image"></div></div>';
				      		  }	 				      				      

						?>	
 				      
					
				      <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider-thumb'); ?>	
					  <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
				    </div><!-- single-media-thumb -->
			      <?php endif; ?>
		</div> <!-- /span6 -->			      
		
		
		<div class="span6">
			<div class="meta">

				<?php if ( $show_comments == 'true') : ?>				  
					<span class="small-comments-ico">
  					  <?php comments_popup_link(__('0','color-theme-framework'),__('1','color-theme-framework'),__('%','color-theme-framework'));; ?>
					</span><!-- meta-comments -->
				<?php endif; ?>
			
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
						$category_link = get_category_link( $category_id );		?>		  		
				  		<a href="<?php echo $category_link ?>" title="<?php echo __('Ver todos ('.$category[0]->count.') em ', 'color-theme-framework'); echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name ?></a>							  	

				</span> <!-- /entry-post-category -->  
				<?php endif; ?>
								    
				  </div><!-- meta -->
				  
				  <h2 class="entry-post-title">
				  	<a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><?php the_title(); ?></a>
				  </h2>
				  
				  <div class="clear"></div>
				  
		 			<?php if ( $show_date == 'true' ) : ?>
						  <span class="date-ico">
						  	<?php the_time('d F, Y'); ?>
						  </span><!-- big-date -->
						  <div class="clear"></div>
						  <div class="margin-5b"></div>
					<?php endif; ?>  

				  	<?php if ( $show_excerpt == 'true' ) : ?>	
					  	<p><?php echo get_the_excerpt(); ?></p>
				  	<?php endif; ?>
	 
				<?php endwhile; ?>
				<div class="clear"></div>

			  </div><!-- span6 -->


				<div class="clear"></div>
			  <?php
			    $recent_posts = new WP_Query(array(
				  'showposts' => $posts,
				  'post_type' => 'post',
				  'cat' => $categories,
			    ));
			
				$counter = 0;
			  ?>

		  <div class="divider-1px no-margin-bottom"></div>
			  	
			  	<?php $li_count = 1; ?>
			  	
				  <?php while($recent_posts->have_posts()): $recent_posts->the_post();
				    if($counter >= 1 ) { ?>

					<?php if( $li_count%2 == 0 ) { ?>
						<div class="row-fluid">
					<?php } ?>	
				    
					  <div class="<?php if( $li_count%2 == 0 ) echo 'span6 left-list clearfix'; else echo 'span6 right-list clearfix';  ?>" >					  
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

				</span> <!-- /entry-post-category -->  
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
			</div>

					<?php
					}
				    $counter++;
				    $li_count++; 
				    ?>
	<?php if( $li_count%2 == 0 ) { ?>
		</div><!-- span12 -->				     
	<?php } ?>
					<?php endwhile; ?>
	<?php if( $li_count%2 != 0 ) { ?>
		</div><!-- span12 -->				     
	<?php } ?>

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
		
		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_date'] = $new_instance['show_date'];				
		$instance['show_comments'] = $new_instance['show_comments'];						
		$instance['show_category'] = $new_instance['show_category'];								
		$instance['show_excerpt'] = $new_instance['show_excerpt'];						
		return $instance;
	}


	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance)
	{
		$defaults = array('title' => __( 'Recent Posts' , 'color-theme-framework' ), 'post_type' => 'all', 'categories' => 'all', 'posts' => 5, 'show_image'=>'on', 'show_comments'=>'on', 'show_date'=>'on' , 'show_big_icons'=>'on', 'show_icons'=>'on', 'show_category'=>'on', 'show_excerpt'=>'on' );
		$instance = wp_parse_args((array) $instance, $defaults); 
 ?>

		
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category:' , 'color-theme-framework' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
			
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo $this->get_field_id('show_comments'); ?>" name="<?php echo $this->get_field_name('show_comments'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_comments'); ?>"><?php _e( 'Show comments for posts' , 'color-theme-framework' ); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show date for posts' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_category'], 'on'); ?> id="<?php echo $this->get_field_id('show_category'); ?>" name="<?php echo $this->get_field_name('show_category'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_category'); ?>"><?php _e( 'Show category for posts' , 'color-theme-framework' ); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e( 'Show thumbnail image' , 'color-theme-framework' ); ?></label>
		</p>


		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_excerpt'], 'on'); ?> id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e( 'Show excerpt for first post' , 'color-theme-framework' ); ?></label>
		</p>
        		
	<?php }
}
?>