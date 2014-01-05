	<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

get_header(); ?>


  <!-- START PAGE CONTENT ENTRY -->
  <div id="content" class="container">

    <!-- CONTENT + RIGHT -->
    <div id="wide-sidebar" class="row-fluid">
      <div class="span8 main-content clearfix">
		  <!--<div class="widget-title"><h3><?php //the_title(); ?></h3></div>-->
          <div class="box-title"><h1><?php the_title(); ?></h1></div>
		  <?php $text = get_post_meta($post->ID,'_custom_page_desc',true);
		  if ( $text != '' ) : ?>
		    <div class="page-desc"><?php echo $text; ?></div>
		  <?php endif; ?>
			<div class="row-fluid">
		  	  <div class="span12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
				  <div class="entry-content">
					  <?php the_content(); ?>
				  </div> <!-- /entry-content -->
				  <?php //comments_template( '', true ); ?>
				<?php endwhile; endif; ?>
			  </div><!-- /span12 -->
			</div><!-- row-fluid -->
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
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')){ } ?>
 	<?php } ?>
        <?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')){ } ?>
    <?php } ?>
    </div><!-- span4 -->
    
      </div><!-- row-fluid -->
	  <!-- END CONTENT + RIGHT -->

  </div> <!-- #content -->
  <!-- END PAGE CONTENT ENTRY -->

<?php get_footer(); ?>