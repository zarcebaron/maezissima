<?php
/*
	 * The template for displaying content in the template-blog.php template

	 * @package WordPress 3.5
	 * @subpackage TrustMe - Responsive WordPress Blog / Magazine Theme
	 * @since TrustMe 1.0
 
*/
?>

<?php
  global $data;

  global $more;
  
  $more = 0;	
	
  $show_date = stripslashes( $data['ct_blog_show_meta']['date'] );
  $show_author = stripslashes( $data['ct_blog_show_meta']['author'] );  
  
  $blog_type = stripslashes( $data['ct_blog_type'] ); 
 
  // Only for Demo 
/*  $title = get_the_title();
  

  if ( $title == 'Blog: Chessboard' ) { 
  	$blog_type = 'Chessboard'; 
  }
  if ( $title == 'Blog: Left Media' ) { 
  	$blog_type = 'Left Media'; 
  }
  if ( $title == 'Blog: Full Media' ) { 
  	$blog_type = 'Full Media'; 
  }
  
  */
  
  $blog_content = stripslashes( $data['ct_excerpt_function'] );   

?>
<?php 
	if ( get_query_var('paged') ) {
    	$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
	    $paged = 1;
	}
										
?>
<?php query_posts( 'post_type=apoiadores'); ?>

<div id="entry-blog">

    <div class="box-title">
        <!--<h1></h1>-->
        <h1><span>apoiadores</span></h1>
    </div>	
           <!-- Begin Navigation -->
		<?php if (function_exists("pagination")) {
		    pagination();
		} ?>
		<!-- End Navigation -->
    
	<div id="entry-post" class="clearfix">		
	<?php
	$left_right = 1;
			
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
  	    setPostViews(get_the_ID()); ?>
    

			
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

		
			<div class="span4" <?php if ( $blog_type == 'Chessboard' ) { if( $left_right%2 == 0 ) { echo 'style="float: right"'; } } ?> >

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

				</div> <!-- /span6 -->				
	
	
	<div class="<?php if (has_post_thumbnail() || ( !has_post_thumbnail() && has_post_format('video') || has_post_format('gallery')) ) echo 'span8'; else echo 'span12'; ?>" <?php if ( $blog_type == 'Chessboard' ) { if( $left_right%2 == 0 ) { echo 'style="float: left; margin-left: 0"'; }} ?>>
	
				  

			  		<div class="clear"></div>
			  		

				  <h3 class="entry-title" style="margin-bottom:5px"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h3>

    <div class="info-partner" style="float:none;margin:0">
        <label>Telefone </label><p><?php the_field('telefone'); ?> | <a href="<?php the_permalink(); ?>" style="font-size:11px">+ informações</a></p>
    </div>  

				    <?php 
				    $excerpt = get_the_excerpt();
				    if ( $blog_content == 'Content' ) {	
						the_content( '', FALSE, '' );
				    }	
				    else if ( $blog_content == 'Excerpt' && $excerpt != '' ){
					  the_excerpt('',FALSE,'');
				    } ?>
                 
				    
				    <div class="clear"></div>

	</div> <!-- /title-block -->
</div> <!-- /span6 -->
	<?php
		$left_right++;
	?>	
	<?php 
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

				  <div class="title-block <?php if ( ( $show_date == false ) and ( $show_author == false ) ) echo 'no-bottom-mp';?>">
					<?php 
			  		  $category = get_the_category(); 
			   		  $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id );
					
					?>

			  		<span class="category-item"><a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo __('Ver todos em ', 'color-theme-framework'); echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></span>
			  		
			  		<div class="clear"></div>

					<?php if ( $show_date == true ) : ?><span class="date-ico"><?php the_time('j \d\e F \d\e Y'); ?></span><?php endif; ?>
					<?php if ( $show_author == true ) : ?><span class="user-ico">postado por <?php echo the_author_link(); ?></span><?php endif; ?>

<?php
	$post_type = get_post_meta($post->ID, 'ct_post_type', true);
	if( $post_type == '' ) $post_type = 'standard_post';
	
			if ( $post_type == 'review_post' ) 
			{		
				if ( ( $show_date == false ) and ( $show_author == false ) ) {
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


				  <h3 class="entry-title full-media-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h3>




		
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
			  

				    <?php 
				    $excerpt = get_the_excerpt();
				    if ( $blog_content == 'Content' ) {	
						the_content( '', FALSE, '' );
				    }	
				    else if ( $blog_content == 'Excerpt' && $excerpt != '' ){
					  the_excerpt('',FALSE,'');
				    } ?>
				    
				    <div class="clear"></div>
		
		</div> <!-- /span12 -->
		
	</div> <!-- /row-fluid -->
	
	<?php endif; ?>
			  
	</article><!-- post-ID -->
 						
				<?php
			  			endwhile;  
					endif;  
				?>		


		</div> <!-- post-entry -->
</div>		

	    <!-- Begin Navigation -->
		<?php if (function_exists("pagination")) {
		    pagination();
		} ?>
		<!-- End Navigation -->