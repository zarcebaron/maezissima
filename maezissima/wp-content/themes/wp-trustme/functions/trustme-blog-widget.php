<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Blog Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show posts as Blog.
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','CT_blog_load_widgets');


function CT_blog_load_widgets(){
		register_widget("CT_blog_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_blog_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_blog_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname' => 'ct_blog_widget', 'description' => __( 'Blog Widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_blog_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'ct_blog_widget', __( 'CT: Blog Widget' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);	
		
		$num_posts = $instance['num_posts'];
		$title = $instance['title'];
		$blog_type = $instance['blog_type'];				
		$show_content = $instance['show_content'];
		$show_date = isset($instance['show_date']) ? 'true' : 'false';
		$show_author = isset($instance['show_author']) ? 'true' : 'false';
		$show_media = isset($instance['show_media']) ? 'true' : 'false';		
		$thumb_type = $instance['thumb_type'];

		
		/* Before widget (defined by themes). */
		echo $before_widget;
				
	?>

<?php

	global $data, $post, $wp_query;
	

	if ( get_query_var('paged') ) {
      $paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
	  $paged = get_query_var('page');
	} else {
	  $paged = 1;
	}

	
	

 ?>


		  <?php if ( $title ){ echo $before_title . $title . $after_title; }
		  
			echo '<div id="entry-blog">';

?>


<?php
		    $recent_posts = new WP_Query(array(
				'posts_per_page' => $num_posts,
				'paged' => $paged,
				'post_type' => 'post',
			));

			// Post Media Position
			$left_right = 1;
			
if ( $recent_posts->have_posts() ) : while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry-post'); ?>>	
	<?php 
		/*
		*	===================================================================
		*		If blog_type == 'Chessboard' and 'Left Media'
		*	===================================================================
		*/
		if ( $blog_type != 'Full Media' ) :
	?>	

	<div class="row-fluid">			

		<?php if ( has_post_thumbnail() && $show_media == 'true' ) : ?>
		
			<div class="span6" <?php if ( $blog_type == 'Chessboard' ) { if( $left_right%2 == 0 ) { echo 'style="float: right"'; } } ?> >

				<?php
					$format = get_post_format();		
				?>	
	 			  <?php if ( has_post_format ( 'image' ) or ( false === $format ) ) { ?>
				  <!-- start post thumb -->
				  <div class="entry-thumb single-media-thumb">
				  		<?php
			

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

 					  <?php
						if ( has_post_thumbnail() && $show_media == 'true' ) { 
		                 $small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-thumb'); ?>  
                    	 <a href="<?php echo the_permalink(); ?>"><img src="<?php echo $small_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
					    <?php } ?>
				  </div> <!-- /entry-thumb -->
			  	  <?php } ?>

				  <div class="entry-content">

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
				  
				  </div><!-- entry-content -->

				</div> <!-- /span6 -->				
	
	<?php endif; ?>
	
	<div class="<?php if (has_post_thumbnail() && $show_media == 'true' ) echo 'span6'; else echo 'span12'; ?>" <?php if ( $blog_type == 'Chessboard' ) { if( $left_right%2 == 0 ) { echo 'style="float: left; margin-left: 0"'; }} ?>>


				  <div class="title-block <?php if ( ( $show_date == 'false' ) and ( $show_author == 'false' ) ) echo 'no-bottom-mp';?>">
					<?php 
			  		  $category = get_the_category(); 
			   		  $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id );
					
					?>

			  		<span class="category-item"><a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo __('Ver todos em ', 'color-theme-framework'); echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></span>
			  		
			  		<div class="clear"></div>

					<?php if ( $show_date == 'true' ) : ?><span class="date-ico"><?php the_time('j \d\e F \d\e Y'); ?></span><?php endif; ?>
					<?php if ( $show_author == 'true' ) : ?><span class="user-ico" <?php if ( $show_date == 'false' ) echo 'style="margin-left: -4px"'; ?>>postado por <?php echo the_author_link(); ?></span><?php endif; ?>

<?php
	$post_type = get_post_meta($post->ID, 'ct_post_type', true);
	if( $post_type == '' ) $post_type = 'standard_post';
	
			if ( $post_type == 'review_post' ) 
			{		
				if ( ( $show_date == 'false' ) and ( $show_author == 'false' ) ) {
					echo '<div class="rating-stars" style="margin-top: -16px">';					
				} else {
					echo '<div class="rating-stars" style="margin-top: 5px">';	
				}	

				get_template_part('rating' , 'system' );								
				echo '</div>';
			}
			?>


				  </div> <!-- /title-block -->

			  		<div class="clear"></div>
			  		<div class="divider-1px"></div>



				  <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h3>


				    <?php 
				    $excerpt = get_the_excerpt();
				    if ( $show_content == 'content' ) {	
						the_content( '', FALSE, '' );
				    }	
				    else if ( $show_content == 'excerpt' && $excerpt != '' ){
					  the_excerpt('',FALSE,'');
				    } ?>
				    
				    <div class="clear"></div>

	</div>


</div>
				<?php
					$left_right++;
				?>	
	<?php 
		/*
		*	===================================================================
		*		If blog_type == 'Chessboard' and 'Left Media'
		*	===================================================================
		*/
		endif;
	?>	
	


	<?php 
		/*
		*	===================================================================
		*		If blog_type == 'Full Media'
		*	===================================================================
		*/
		if ( $blog_type == 'Full Media' ) :
	?>	
	<div class="row-fluid">
	
		<div class="span12">

				  <div class="title-block <?php if ( ( $show_date == 'false' ) and ( $show_author == 'false' ) ) echo 'no-bottom-mp';?>">
					<?php 
			  		  $category = get_the_category(); 
			   		  $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id );
					
					?>

			  		<span class="category-item"><a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo __('Ver todos em ', 'color-theme-framework'); echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></span>
			  		
			  		<div class="clear"></div>

					<?php if ( $show_date == 'true' ) : ?><span class="date-ico"><?php the_time('j \d\e F \d\e Y'); ?></span><?php endif; ?>
					<?php if ( $show_author == 'true' ) : ?><span class="user-ico">postado por <?php echo the_author_link(); ?></span><?php endif; ?>

<?php
	$post_type = get_post_meta($post->ID, 'ct_post_type', true);
	if( $post_type == '' ) $post_type = 'standard_post';
	
			if ( $post_type == 'review_post' ) 
			{		
				if ( ( $show_date == 'false' ) and ( $show_author == 'false' ) ) {
					echo '<div class="rating-stars" style="margin-top: -16px">';					
				} else {
					echo '<div class="rating-stars" style="margin-top: 5px">';	
				}	
				get_template_part('rating' , 'system' );								
				echo '</div>';
			}
			?>
			
				  </div> <!-- /title-block -->

			  		<div class="clear"></div>
			  		<div class="divider-1px"></div>



				  <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h3>




		<?php if ( has_post_thumbnail() || $show_media == 'true' ) : ?>
		
				<?php
					$format = get_post_format();		
				?>	
	 			  <?php if ( has_post_format ( 'image' ) or ( false === $format ) ) { ?>
				  <!-- start post thumb -->
				  <div class="entry-thumb single-media-thumb">
				  		<?php
			

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

 					  <?php
						if ( has_post_thumbnail() ) { 
		                 $small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-thumb'); ?>  
                    	 <a href="<?php echo the_permalink(); ?>"><img src="<?php echo $small_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
					    <?php } ?>
				  </div> <!-- /entry-thumb -->
			  	  <?php } ?>

				  <div class="entry-content">

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
				  
				  </div><!-- entry-content -->
			  
			<?php endif; ?>
				    <?php 
				    $excerpt = get_the_excerpt();
				    if ( $show_content == 'content' ) {	
						the_content( '', FALSE, '' );
				    }	
				    else if ( $show_content == 'excerpt' && $excerpt != '' ){
					  the_excerpt('',FALSE,'');
				    } ?>
				    
				    <div class="clear"></div>
		
		</div> <!-- /span12 -->
		
	</div> <!-- /row-fluid -->
	
	<?php endif; ?>
	 
				</article> <!-- /post ID -->

			<?php endwhile; endif;  

?>

		<!-- After widget (defined by themes). -->
		</div><!-- entry-blog -->


			  		
	    <!-- Begin Navigation -->
		<?php if (function_exists("pagination")) {
		    pagination();
		} ?>
		<!-- End Navigation -->
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

		$instance['num_posts'] = $new_instance['num_posts'];
		$instance['title'] = $new_instance['title'];
		$instance['blog_type'] = $new_instance['blog_type'];		
		$instance['show_content'] = $new_instance['show_content'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_author'] = $new_instance['show_author'];
		$instance['show_media'] = $new_instance['show_media'];		
		$instance['thumb_type'] = $new_instance['thumb_type'];


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
			$defaults = array( 'title' => __( 'From Blog', 'color-theme-framework' ), 'show_media' =>'on', 'num_posts' => '3', 'show_content' => 'excerpt', 'show_date' =>'on', 'show_author' => 'off', 'blog_type' => 'Chessboard' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'blog_type' ); ?>"><?php _e('Select type of the Blog:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'blog_type' ); ?>" name="<?php echo $this->get_field_name( 'blog_type' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'Cheassboard' == $instance['blog_type'] ) echo 'selected="selected"'; ?>>Chessboard</option>
				<option <?php if ( 'Left Media' == $instance['blog_type'] ) echo 'selected="selected"'; ?>>Left Media</option>
				<option <?php if ( 'Full Media' == $instance['blog_type'] ) echo 'selected="selected"'; ?>>Full Media</option>				
			</select>
		</p>		

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_media'], 'on'); ?> id="<?php echo $this->get_field_id('show_media'); ?>" name="<?php echo $this->get_field_name('show_media'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_media'); ?>"><?php _e( 'Show media in posts' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show date' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_author'], 'on'); ?> id="<?php echo $this->get_field_id('show_author'); ?>" name="<?php echo $this->get_field_name('show_author'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_author'); ?>"><?php _e( 'Show author' , 'color-theme-framework' ); ?></label>
		</p>


		<p>
			<label for="<?php echo $this->get_field_id( 'show_content' ); ?>"><?php _e('Select a Excerpt (automatically) or Content (More tag):', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'show_content' ); ?>" name="<?php echo $this->get_field_name( 'show_content' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'excerpt' == $instance['show_content'] ) echo 'selected="selected"'; ?>>excerpt</option>
				<option <?php if ( 'content' == $instance['show_content'] ) echo 'selected="selected"'; ?>>content</option>
			</select>
		</p>		
		<?php

	}
}
?>