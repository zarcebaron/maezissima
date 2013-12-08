<?php
/*
	 Template Name: Sitemap

	 * @package WordPress 3.5
	 * @subpackage TrustMe - Responsive WordPress Blog / Magazine Theme
	 * @since TrustMe 1.0

*/

get_header(); ?>


  <!-- START SITEMAP CONTENT ENTRY -->
  <div id="content" class="container">

    <!-- CONTENT + RIGHT -->
    <div id="wide-sidebar" class="row-fluid">
      <div class="span8 main-content clearfix">
		  <div class="widget-title"><h3><?php the_title(); ?></h3></div>
    		<div class="entry-sitemap">

			  <div class="divider-1px-bg"></div>	    		
      		  <h4 id="posts"><?php _e( 'Posts' , 'color-theme-framework' ); ?></h4>
      		  <ul class="posts-name">
        	    <?php
			      // Add categories seprated with comma (,) you'd like to hide to display on sitemap
				  $cats = get_categories('exclude=');
				  foreach ($cats as $cat) {
  				    echo "<li><h5>".$cat->cat_name."</h5>";
  				    echo "<ul>";
  				    query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
  				    while(have_posts()) {
    				  the_post();
    				  $category = get_the_category();
    				  // Only display a post link once, even if it's in multiple categories
    				  if ($category[0]->cat_ID == $cat->cat_ID) {
      				    echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
    				  }
  				    }
  				    echo "</ul>";
  				    echo "</li>";
				  }
			    ?>
      		  </ul>
				
			  <div class="divider-1px-bg"></div>	
			  
			  <!-- Display Categories -->
      		  <h4><?php _e( 'Categories' , 'color-theme-framework' ); ?></h4>
      		  <ul class="category-name">
        		<?php 
				  $catrssimg = "/img/icons/rss16x16.png";
            	  $catrssurl = get_template_directory_uri() . $catrssimg;        
        		  wp_list_categories("sort_column=name&feed_image=$catrssurl&optioncount=1&hierarchical=0");
        		?>
      		  </ul>

			  <div class="divider-1px-bg"></div>				
			  <!-- Display Pages -->
      		  <h4 id="pages"><?php _e ( 'Pages' , 'color-theme-framework' ); ?></h4>
      		  <ul class="pages-name">
        		<?php
				  // Add pages seprated with comma[,] that you'd like to hide to display on sitemap
				  wp_list_pages(
  					array(
    					'exclude' => '',
    					'title_li' => '',
  						 )
				  );
				?>
      		  </ul>
    		</div><!-- entry-sitemap -->
			<?php wp_reset_query();  ?>
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
  <!-- END SITEMAP CONTENT ENTRY -->

<?php get_footer(); ?>