<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT ADS 300x250 Sidebar Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show ADS in Sidebar ( img width: 300px; img height: 250px ).
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','CT_ads300x250_load_widgets');


function CT_ads300x250_load_widgets(){
		register_widget("CT_Ads300x250_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Ads300x250_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_Ads300x250_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname' => 'ct_ads300x250_widget', 'description' => __( 'Ads 300x250 for sidebar widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_ads300x250_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'ct_ads300x250_widget', __( 'CT: Ads 300x250' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$link = $instance['link'];
		$image = $instance['image'];
		
		echo $before_widget;
		?>

		<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}
		?>
		
		<?php
			if($image) {	
			?>				
			<div class="ads300-thumb">
				<a target="_blank" href="<?php echo $link; ?>">
					<img src="<?php echo $image; ?>" alt="" />
				</a>
			</div> <!-- /ads300-thumb -->
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
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];		
		$instance['link'] = $new_instance['link'];
		$instance['image'] = $new_instance['image'];
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		?>
		<?php
			$defaults = array( 'title' => __( 'ADS300', 'color-theme-framework' ), 'link' => '' , 'image' => '' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e( 'Link Url:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo $instance['link']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e( 'Image Url:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $instance['image']; ?>" />
		</p>
		<?php

	}
}
?>