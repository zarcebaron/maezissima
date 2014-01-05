<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Related Posts Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show Related posts( Specified by tags ).
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/



/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'CT_related_posts_widget' );

function CT_related_posts_widget() {
	register_widget( 'CT_Related_Posts' );
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Related_Posts extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function  CT_Related_Posts() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ct_relatedposts_widget', 'description' => __( 'A widget that show related posts' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_relatedposts_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'ct_relatedposts_widget', __('CT: Related Posts', 'color-theme-framework'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('Related Posts', $instance['title'] );
		$num_posts = $instance['num_posts'];



		/* Before widget (defined by themes). */
		echo $before_widget;

		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}

		/* Display the widget title if one was input (before and after defined by themes). */
		?>

		<?php 
		  global $post;
		  $tags = get_the_tags(); 
		  if( $tags): ?>
					
   		    <?php $related_posts = get_related_posts( $post->ID, $tags, $num_posts); ?>
							
						
			<ul class="related-posts-single clearfix">
			  <?php while($related_posts->have_posts()): $related_posts->the_post(); ?>
			    <?php if(has_post_thumbnail()): ?>
			      <li>
					<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?></a>
  	  		  	  </li>
				<?php endif; ?>
			  <?php endwhile; ?>
			</ul><!-- related-posts-single -->
			
			<?php if ($related_posts->have_posts()) echo ''; 
			  else echo __('Sem posts relacionados','color-theme-framework'); ?>
		  <?php endif; ?>
		
		<?php wp_reset_query(); ?>

<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_posts'] = $new_instance['num_posts'];
		
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
		$defaults = array('title' => __( 'Related Posts' , 'color-theme-framework' ) , 'num_posts' => 4, 'show_image' => 'off', 'show_comments' => 'on');
		$instance = wp_parse_args((array) $instance, $defaults);
	?>

		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
	
		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts to show:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
		</p>
		
	
	<?php 
	}
}

?>