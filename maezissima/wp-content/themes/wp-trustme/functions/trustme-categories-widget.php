<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Categories Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget thats displays your projects from flickr.com
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'CT_load_categories_widgets');

function CT_load_categories_widgets()
{
	register_widget('CT_Categories_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
	class CT_Categories_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function CT_Categories_Widget() {
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'ct_categories_widget', 'description' => __( 'Categories Widget', 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_categories_widget' );

		/* Create the widget. */		
		$this->WP_Widget( 'ct_categories_widget', __( 'CT: Categories Widget' , 'color-theme-framework' ), $widget_ops);
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

	<?php
	  $cat_left = '';
	  $cat_right = '';
	  $cats = explode("<br />",wp_list_categories('title_li=&echo=0&depth=1&style=none'));
 	  $cat_n = count($cats) - 1;
 	  for ($i=0;$i<$cat_n;$i++):
	    if ($i<$cat_n/2):
		  $cat_left = $cat_left.'<li>'.$cats[$i].'</li>';
		elseif ($i>=$cat_n/2):
		  $cat_right = $cat_right.'<li>'.$cats[$i].'</li>';
		endif;
	  endfor;
	?>
	
	<div class="row-fluid">
	  <div class="span6">
		<ul class="left-col">
	  	  <?php echo $cat_left;?>
		</ul><!-- left-col -->
	  </div><!-- span6 -->
	  <div class="span6">
		<ul class="right-col">
	  	  <?php echo $cat_right;?>
		</ul><!-- right-col -->
	  </div><!-- span6 -->
	</div><!-- row-fluid -->
	
	<?php

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array( 'title' => __( 'Categories' , 'color-theme-framework' ) );
	
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