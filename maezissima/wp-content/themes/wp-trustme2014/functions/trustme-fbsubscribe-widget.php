<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Facebook Subscribe Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show subscribe button from facebook.com
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/*
==========================================================================
  Add function to widgets_init that'll load our widget.
==========================================================================  
*/

add_action('widgets_init','CT_fbsubscribe_load_widgets');


function CT_fbsubscribe_load_widgets(){
		register_widget("CT_fb_subscribe_Widget");
}

/*
==========================================================================
  Widget class.
  This class handles everything that needs to be handled with the widget:
  the settings, form, display, and update. 
==========================================================================
*/
class CT_fb_subscribe_Widget extends WP_widget{

	/* Widget setup. */
	function CT_fb_subscribe_Widget(){
		
		/* Widget settings. */		
		$widget_ops = array( 'classname' => 'ct_subscribe_widget', 'description' => __( 'FB Subscribe Widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_subscribe_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'ct_subscribe_widget' , __( 'CT: FB Subscribe' , 'color-theme-framework' ) , $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$profile_url = $instance['profile_url'];
		$layout = $instance['layout'];		
		$show_faces = isset($instance['show_faces']) ? 'true' : 'false';
		$theme_color = $instance['theme_color'];			
		$lang = $instance['lang'];
		

		echo $before_widget;
		?>
			<?php
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			?>
			

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $lang; ?>/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
			
					<div class="fb-subscribe" <?php if($layout=='button_count') echo 'data-layout="button_count"'; if($layout=='box_count') echo 'data-layout="box_count"'; ?> data-href="<?php echo $profile_url; ?>" data-font="arial"  data-show-faces="<?php echo $show_faces; ?>" <?php if( $theme_color == 'dark' ) echo 'data-colorscheme="dark"'; ?> ></div>

					

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
		
		$instance['title'] = strip_tags( $new_instance['title'] );


		$instance['profile_url'] = $new_instance['profile_url'];
		$instance['layout'] = $new_instance['layout'];		
		$instance['show_faces'] = $new_instance['show_faces'];
		$instance['theme_color'] = $new_instance['theme_color'];			
		$instance['lang'] = $new_instance['lang'];		

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
			$defaults = array( 'title'=> __( 'Facebook Subscribe' , 'color-theme-framework' ), 'profile_url' => 'https://facebook.com/envato', 'lang' => 'en_US', 'theme_color' => 'light', 'show_faces' => 'on', 'layout' => 'standard');
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 210px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('profile_url'); ?>"><?php _e( 'Profile URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 210px;" id="<?php echo $this->get_field_id('profile_url'); ?>" name="<?php echo $this->get_field_name('profile_url'); ?>" value="<?php echo $instance['profile_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php _e('Layout Style:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'standard' == $instance['layout'] ) echo 'selected="selected"'; ?>>standard</option>
				<option <?php if ( 'button_count' == $instance['layout'] ) echo 'selected="selected"'; ?>>button_count</option>
				<option <?php if ( 'box_count' == $instance['layout'] ) echo 'selected="selected"'; ?>>box_count</option>				
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'theme_color' ); ?>"><?php _e('Theme Color:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'theme_color' ); ?>" name="<?php echo $this->get_field_name( 'theme_color' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'dark' == $instance['theme_color'] ) echo 'selected="selected"'; ?>>dark</option>
				<option <?php if ( 'light' == $instance['theme_color'] ) echo 'selected="selected"'; ?>>light</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('lang'); ?>"><?php _e( 'Facebook Language:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 60px;" id="<?php echo $this->get_field_id('lang'); ?>" name="<?php echo $this->get_field_name('lang'); ?>" value="<?php echo $instance['lang']; ?>" />
		</p>


		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_faces'], 'on'); ?> id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_faces'); ?>"><?php _e( 'Show Faces' , 'color-theme-framework' ); ?></label>
		</p>

		
		<?php

	}
}
?>