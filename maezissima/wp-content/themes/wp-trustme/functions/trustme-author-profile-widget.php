<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Author Profile widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget thats displays info about author post
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'CT_load_author_profile_widgets');

function CT_load_author_profile_widgets()
{
	register_widget('CT_Author_profile_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
	class CT_Author_profile_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function CT_Author_profile_Widget() {
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'ct_author_profile_widget', 'description' => __( 'Author Profile Widget', 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_author_profile_widget' );

		/* Create the widget. */		
		$this->WP_Widget( 'ct_author_profile_widget', 'CT: Author Profile Widget ', $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display video widget
	?>


	<!-- about the author -->			
	<div id="author-info" class="clearfix" itemscope="" itemtype="http://schema.org/Person">
		<div id="author-avatar">
			<?php 
				$user_email = get_the_author_meta( 'user_email' );
    			$hash = md5( strtolower( trim ( $user_email ) ) );
    			echo '<img itemprop="image" style="display:none;" src="http://gravatar.com/avatar/' . $hash .'" alt="" />';
			?>
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 100 ) ); ?>
		</div><!-- #author-avatar -->

		<div id="author-description">
			<meta itemprop="name" content="<?php the_author_meta( 'first_name' ); ?> <?php the_author_meta( 'last_name' ); ?>">
			<meta itemprop="url" content="<?php the_author_meta( 'user_url' ); ?>">
			<meta itemprop="description" content="<?php the_author_meta( 'description' ); ?>">
			<p><?php the_author_meta( 'description' ); ?></p>

			        			<?php
			        			$author = sprintf( '<span class="author vcard"><a style="font-size: 11px;" class="url fn n" href="%1$s" title="%2$s" rel="author">%2$s</a></span>',
									esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
									esc_attr( sprintf( __( 'Ver todos os artigos por %s', 'color-theme-framework' ), get_the_author() ) ),
									get_the_author()
								);
								printf( $author	);
								?>			
		</div><!-- #author-description	-->
	</div><!-- #author-info -->
	
	<?php
		 // Restor original Query & Post Data
		  //wp_reset_query();
		  //wp_reset_postdata();
	  ?>

		<?php
		echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array( 'title' => __( 'About Author' , 'color-theme-framework' ) );
	
	$instance = wp_parse_args( (array) $instance, $defaults );
 ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'color-theme-framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

        		
	<?php
	}
}
?>