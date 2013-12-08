<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Recent Posts Thumbs Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show thumbs for recent posts ( Specified by cat-id ).
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init', 'CT_recentthumbs_load_widgets');

function CT_recentthumbs_load_widgets()
{
	register_widget('CT_recentthumbs_Widget');
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_recentthumbs_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function CT_recentthumbs_Widget()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'ct_recentthumbs_widget', 'description' => __( 'Recent Posts Thumbs Magazine Widget (show recent posts as thumbs).' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_recentthumbs_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'ct_recentthumbs_widget', __( 'CT: Recent Posts Thumbs' , 'color-theme-framework' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$categories = $instance['categories'];
		$posts = $instance['posts'];

		echo $before_widget;

		
		global $post;		
		?>
		

			<?php
			if ($title) {
				 echo $before_title.$title.$after_title;
				
			}
			
			?>

		<div class="row-fluid one-column-widget">
		  <?php
			    $recent_posts = new WP_Query(array(
				  'showposts' => $posts,
				  'post_type' => 'post',
				  'cat' => $categories,
			    ));
			
			  ?>

			  <div class="span12" style="padding-bottom: 0; margin-bottom: 0">
			  	
			    <ul class="widget-one-column-horizontal post-thumbs">

				  <?php while($recent_posts->have_posts()): $recent_posts->the_post();
				  
				  if ( has_post_thumbnail() ) :
				  ?>
					  <li class="clearfix">					  
			    		
				    		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'big-thumbs'); 
				    		
						 ?>	
					 		  <div class="widget-thumb-post">
					 		  
							    <a href='<?php the_permalink(); ?>' class="big-thumb-link" data-placement="top" title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>	
					  		  </div><!-- widget-post-small-thumb -->
					  
						</li>

					<?php
					
					endif;

				    
					endwhile; ?>
				</ul>
			</div><!-- span6 -->
		</div><!-- row-fluid -->
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

		return $instance;
	}


	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance)
	{
		$defaults = array('title' => __( 'Recent Posts Thumbs' , 'color-theme-framework' ), 'post_type' => 'all', 'categories' => 'all', 'posts' => 12 );
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

		
       		
	<?php }
}
?>