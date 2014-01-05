<?php
	/* 
		Template Name: Full Width Page
		
	 * @package WordPress 3.5
	 * @subpackage TrustMe - Responsive WordPress Blog / Magazine Theme
	 * @since TrustMe 1.0
		
	*/

get_header(); ?>

  <!-- START FULL WIDTH PAGE CONTENT ENTRY -->
  <div id="content" class="container">

    <div id="wide-sidebar" class="row-fluid">
      <div class="span12 main-content">
		  <!--<div class="widget-title"><h3><?php //the_title(); ?></h3></div>-->
          <div class="box-title"><h1><?php the_title(); ?></h1></div>
		  <?php $text = get_post_meta($post->ID,'_custom_page_desc',true);
		  if ( $text != '' ) : ?>
		    <div class="page-desc"><?php echo $text; ?></div>
		  <?php endif; ?>
			<div class="row-fluid">
		  	  <div class="span12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
				  <?php the_content(); ?>
				<?php endwhile; endif; ?>
			  </div><!-- /span12 -->
			</div><!-- row-fluid -->
        </div><!-- span12 -->
      </div><!-- row-fluid -->
  </div> <!-- #content -->
  <!-- END FULL WIDTH PAGE CONTENT ENTRY -->

<?php get_footer(); ?>