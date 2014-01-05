<?php get_header(); ?>

  <!-- START SINGLE CONTENT ENTRY -->
  <div id="content" class="container">
<?php
function the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<span>'.$thumbnail_image[0]->post_excerpt.'</span>';
  }
}

//Usage - the_post_thumbnail_caption();
?>  
<?php
/************* CODE BLOCK1 (BASED ON ALL COMMON TAGS) *************
* @Author: Boutros AbiChedid
* @Credit: http://bacsoftwareconsulting.com/blog/
* @Date:   May 24, 2011
* Tested on WordPress version 3.1.2
* @Description: Code that shows other "Related Posts" to a post 
* based on ALL COMMON tags.
*******************************************************************/
 
//Retrieve the list of tags for a post.
$tags = wp_get_post_tags($post->ID);
 
//If tags exist for the post.
if ($tags) {
    $tag_ids = array();
    //retrieve the tag_ids for the post.
    foreach($tags as $each_tag)
        $tag_ids[] = $each_tag->term_id;
     
    //WP_Query arguments.
    $args = array(
        'tag__in' => $tag_ids, //An array of tag IDs to be included.
        'post__not_in' => array($post->ID), //An array of post IDs to be excluded from the results.
        'orderby'=> 'rand', //Lists Related posts Randomly. *** MODIFY IF YOU LIKE ***
		//'orderby'=> 'cres', //Lists Related posts Crescent.
        'showposts' => 6, //*** MODIFY TO WHAT YOU LIKE.***  Number of related posts to show.
        //'caller_get_posts' => 1 //*** USE THIS IF YOU ARE RUNNING WordPress Version < 3.1 ***
        'ignore_sticky_posts' => 1 //*** USE THIS for WordPress Version >= 3.1 ***
    );
     
    //WP_Query is a class defined in wp-includes/query.php
    $query = new WP_Query($args);
     
    //If there are related posts.
    if( $query->have_posts() ) {
        echo '<div class="top-related-posts"><div>';
        //echo '<h3>você curte?</h3>'; //*** MODIFY TITLE IF YOU LIKE ***
         
        //loop through the posts and list each until done.
        while ($query->have_posts()) {
            $query->the_post();
        ?>
            <div class="relatedthumb">  
            <a  title='<?php the_title(); ?>' class="big-thumb-link" rel="external" href="<?php the_permalink()?>"><?php //the_post_thumbnail(array(90,90)); ?>  <?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
				<?php //the_title(); ?> 
                
                <p>
                    <?php if (strlen($post->post_title) > 40) {
                        echo substr(the_title($before = '', $after = '', FALSE), 0, 40) . '...'; } else {
                        the_title();
                    } ?>
                </p>
            </a>  
        </div> 
        <?php
        }
        echo '</div></div>';
    }
}
//Destroy the previous query. This is a MUST, otherwise you will get the WRONG comments
//(comments assigned to the wrong post), and sometimes categories and tags are for the wrong post.
wp_reset_query();                      
?>      
	<?php
	if ( is_active_sidebar('ct_single_top_widgets') ): ?>
	<!-- START TOP SINGLE WIDGETS AREA -->
	  <div class="row-fluid">
	    <div class="span12">
			<?php
			  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Single Top Widgets") ) : ?>
			<?php endif; ?>
	    </div> <!-- /span12 -->	
	  </div> <!-- /row-fluid -->
	<!-- END TOP SINGLE WIDGETS AREA -->
	<?php endif; ?>	

<?php 
	global $data;
	$single_layout = stripslashes( $data['ct_single_layout'] );
?>

	  <?php if ( $single_layout == 'c_r' ) :	?>
	  <!-- CONTENT + RIGHT -->
      <div id="wide-sidebar" class="row-fluid">
      
        <div class="span8 main-content">

            <?php if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('<p id="breadcrumbs">','</p>');
} ?> 

          <?php if ( is_active_sidebar('ct_single_before_widgets') ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Single Before Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
          <div class="row-fluid">
            <div class="span12">
		  	  <?php get_template_part( 'content', 'single-bodega' ); ?>
            </div><!-- span12 -->

          </div><!-- row-fluid -->
          <?php if ( is_active_sidebar('ct_single_after_widgets') ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Single After Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
        </div><!-- span8 -->

	    <div class="span4 r-sidebar right-bg">
	 <?php 
		 	global $wp_query; 
		 	$postid = $wp_query->post->ID; 
		 	$cus = get_post_meta($postid, 'sbg_selected_sidebar_replacement', true);
		 ?>
	
		<?php if ($cus != '') { ?>
        <?php if ($cus[0] != '0') { ?>
             <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar($cus[0])){ } ?>
	<?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Single Sidebar')){ } ?>
 	<?php } ?>
        <?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Single Sidebar')){ } ?>
    <?php } ?>
	    </div><!-- span4 -->                  
        
      </div><!-- row-fluid -->
	  <!-- END CONTENT + RIGHT -->


    <?php elseif ( $single_layout == 'l_c' ) :	?>
	  <!-- LEFT + CONTENT -->
      <div id="wide-sidebar" class="row-fluid">


        <div class="span8 pull-right main-content">
          <?php if ( is_active_sidebar('ct_single_before_widgets') ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Single Before Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
          <div class="row-fluid">
            <div class="span12">
		  	  <?php get_template_part( 'content', 'single' ); ?>
            </div><!-- span12 -->
          </div><!-- row-fluid -->
          <?php if ( is_active_sidebar('ct_single_after_widgets') ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Single After Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
        </div><!-- span8 -->


	    <div class="span4 pull-left r-sidebar right-bg">
	 <?php 
		 	global $wp_query; 
		 	$postid = $wp_query->post->ID; 
		 	$cus = get_post_meta($postid, 'sbg_selected_sidebar_replacement', true);
		 ?>
	
		<?php if ($cus != '') { ?>
        <?php if ($cus[0] != '0') { ?>
             <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar($cus[0])){ } ?>
	<?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Single Sidebar')){ } ?>
 	<?php } ?>
        <?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Single Sidebar')){ } ?>
    <?php } ?>
	    </div><!-- span4 -->                  
       

      </div><!-- row-fluid -->
	  <!-- END LEFT + CONTENT -->
    <?php endif; ?>
    
  </div> <!-- #content -->
  <!-- END CONTENT ENTRY -->

<?php get_footer(); ?>