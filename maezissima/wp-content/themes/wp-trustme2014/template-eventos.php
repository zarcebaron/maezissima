<?php
/*
		Template Name: Eventos

	 * @package WordPress 3.5
	 * @subpackage TrustMe - Responsive WordPress Blog / Magazine Theme
	 * @since TrustMe 1.0

*/

get_header(); ?>
fasdfasdfasf

  <!-- START ARCHIVES CONTENT ENTRY -->
  <div id="content" class="container">

    <!-- CONTENT + RIGHT -->
    <div id="wide-sidebar" class="row-fluid">
      <div class="span8 main-content clearfix">
		  <div class="widget-title"><h3><?php the_title(); ?></h3></div>
			<div class="row-fluid">
		  	  <div class="span12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	

				  <?php the_content(__('Read more...', 'color-theme-framework')); ?>
				  <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'color-theme-framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					
					
				  <div class="divider-1px"></div>	
				  <div class="margin-30b"></div>	
				  				  
				  <!-- /archive-lists -->
				  <div class="row-fluid">
				    <div class="span4 archives-block">
					  <h5><?php _e('Last 30 Posts', 'color-theme-framework') ?></h5>
					  <div class="divider-1px"></div>
					  <ul class="archives">
					    <?php $archive_30 = get_posts('numberposts=10');
					    foreach($archive_30 as $post) : ?>
						  <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
					  	<?php endforeach; ?>
					  </ul>
					</div><!-- /span4 -->
						
					<div class="span4 archives-block">
					  <h5><?php _e('Archives by Month:', 'color-theme-framework') ?></h5>
					  <div class="divider-1px-bg"></div>					  
					  <ul class="archives">
					    <?php wp_get_archives('type=monthly'); ?>
					  </ul>
					</div><!-- /span4 -->

				    <div class="span4 archives-block">
					  <h5><?php _e('Archives by Subject:', 'color-theme-framework') ?></h5>
					  <div class="divider-1px"></div>					  
					  <ul class="archives">
					    <?php wp_list_categories( 'title_li=' ); ?>
					  </ul>
					</div><!-- /span4 -->					
				  <!-- /archive-lists -->
				  </div><!-- row-fluid -->
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
  <!-- END ARCHIVES CONTENT ENTRY -->

<?php get_footer(); ?>