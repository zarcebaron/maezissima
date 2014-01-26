<?php
/*
	 * The template for displaying content in the single.php template

	 * @package WordPress 3.5
	 * @subpackage TrustMe - Responsive WordPress Blog / Magazine Theme
	 * @since TrustMe 1.0
 
*/
?>

<?php
  global $data;

  $featured_image_post = stripslashes( $data['ct_featured_image_post'] );
  $disqus_shortname = stripslashes( $data['ct_disqus_shortname'] );
  $facebook_appid = stripslashes( $data['ct_facebook_appid'] );
  $show_date = stripslashes( $data['ct_blog_show_meta']['date'] );
  $show_author = stripslashes( $data['ct_blog_show_meta']['author'] );  
  
  $single_nav = stripslashes( $data['ct_single_nav'] );
?>

  <div class="row-fluid">
    <div class="span12">
	  <div id="entry-post" class="clearfix">		
	    <?php 
		  if ( have_posts() ) : while ( have_posts() ) : the_post(); 
       	    setPostViews(get_the_ID()); 
			
			$post_type = get_post_meta($post->ID, 'ct_post_type', true);
			if( $post_type == '' ) $post_type = 'standard_post';
			?>

       	    <?php if ($post_type == 'standard_post') : ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class("single-media-blocks"); ?> itemscope itemtype="http://schema.org/BlogPosting">
			<?php else: ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class("single-media-blocks"); ?> itemscope itemtype="http://data-vocabulary.org/Review">
			<?php endif; ?>
		

				<?php 
					if ( $single_nav == 'Top' ) {
						get_template_part( 'single' , 'navigation' );
					}
				?>

           
            <?php
	$post_type = get_post_meta($post->ID, 'ct_post_type', true);
	if( $post_type == '' ) $post_type = 'standard_post';
	
			if ( $post_type == 'review_post' ) 
			{		
				echo '<div class="rating-stars" style="margin-top: 5px">';	
				get_template_part('rating' , 'system' );								
				echo '</div>';
			}
			?>
                <div class="clear"></div>
                
       	    <?php if ($post_type == 'standard_post') : ?>
				<h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
			<?php else: ?>
				<h1 class="entry-title" itemprop="itemreviewed"><?php the_title(); ?></h1>
				<meta itemprop="reviewer" content="<?php the_author(); ?>">
			<?php endif; ?>
            
            <?php //echo '<h2>'.get_the_excerpt().'</h2>'; ?></p>
          
			<?php if($post->post_excerpt) {
				echo '<p class="excerpt">'.get_the_excerpt().'</p>';
			} ?>


            
			  
			
<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Image or Standard  
-----------------------------------------------------------------------------------------------------------------							
*/
?>

	

			  <?php 
	            if ( $featured_image_post == 'Show' ) :

					$format = get_post_format();				  
					
					if ( false === $format || has_post_format('image') ) :
	 			
	 			?>

					<?php 
                    if ( in_category( 'Tirinhas' )) {
                   
                    } else {?>              

					  <!-- start post thumb -->
				    <div class="single-media-thumb entry-thumb">

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
		                  $small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-thumb');
		                  $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                    	  <a data-rel="prettyPhoto" href="<?php echo $large_image_url[0]; ?>"><img itemprop="image" src="<?php echo $small_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
					  <?php } ?>
                      
					  <div class="featured-caption"><?php the_post_thumbnail_caption();?></div>
                      
				    </div> <!-- /entry-thumb -->
                    <?php } ?>
			  	  <?php  endif; 
				endif; ?>

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

			<div class="clear"></div>
            
            <div class="title-block">
				<?php
                $categories = get_the_category();
                $separator = ',&nbsp;&nbsp;';
                $output = '';
				?>
                <span class="category-item">
                <?php
                if($categories){
                    foreach($categories as $category) {
                        $output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "Ver todos em %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
                    }
                echo trim($output, $separator);
                }
                ?>
                </span>
                
				<?php 
		  		  //$category = get_the_category(); 
		   		  //$category_id = get_cat_ID( $category[0]->cat_name ); 
		   		  //$category_link = get_category_link( $category_id );
				?>
<!--
		  		<span class="category-item">
		  			<a href="<?php //echo esc_url( $category_link ); ?>" title="<?php //echo __('Ver todos ('.$category[0]->count.') posts in ', 'color-theme-framework'); echo //$category[0]->cat_name; ?>"><?php //echo $category[0]->cat_name; ?></a></span>-->
				
				<div class="clear"></div>
				<?php 
                  if ( $show_date == true ) :
				?>
					  <!-- <span class="date-ico"><?php the_time('j \d\e F \d\e Y'); ?></span> -->
					  <meta itemprop="datePublished" content="<?php the_time('j \d\e F \d\e Y'); ?>"><span class="date-ico updated"><?php the_time('j \d\e F \d\e Y'); ?></span>
				<?php endif; ?>
				<?php 
					if ( $show_author == true ) :
				?>	
                <!--		
				<span class="meta-author user-ico" <?php //if ( $show_date == false ) echo 'style="margin-left: -4px"'; ?>><?php// _e('por ','color-theme-framework'); echo the_author_link(); ?></span>-->
                
                <span class="meta-author user-ico" style="margin-left: -4px";>
					<?php 
                        if ( function_exists( 'coauthors_posts_links' ) ) {
                            coauthors_posts_links();
                        } else {
                            the_author_posts_link();
                        }
                    ?>
                </span>
                
                
				<?php endif; ?>
				
				<div class="clear"></div>

				
			  </div> <!-- /title-block -->
              
              <div class="single-social">

				<!--<div style="margin-right:30px" class="fb-like" data-width="450" data-layout="button_count" data-show-faces="false" data-send="false"></div> -->
                <div style="margin-right:30px" class="fb-like" data-width="450" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
              
                <!-- Posicione esta tag onde você deseja que o botão +1 apareça. -->
                <div class="g-plusone"></div>
                
                <!-- Posicione esta tag depois da última tag do botão +1. -->
                <script type="text/javascript">
                  window.___gcfg = {lang: 'pt-BR'};
                
                  (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                  })();
                </script>
                
                 <a href="https://twitter.com/share" class="twitter-share-button" data-via="maezissima" data-lang="pt">Tweetar</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                 
             
              </div>
              
             
<?php						
/*
-----------------------------------------------------------------------------------------------------------------						
		CONTENT
-----------------------------------------------------------------------------------------------------------------							
*/
?>
				<?php
					$post_type = get_post_meta($post->ID, 'ct_post_type', true);
					if( $post_type == '' ) $post_type = 'standard_post';			
				?>
				
				<?php if( $post_type == 'review_post' ) : ?>
			  	<div class="review-block">
			  		<div class="overall_score">
			  			
			  			<?php 
			  				$p_ID = get_the_ID();
			  				
			  				$overall_name = get_post_meta( $p_ID, 'ct_over_name', true); 
			  				$overall_score = get_post_meta( $p_ID, 'ct_over_score', true); 

							// Criteria #1 and Score #1
			  				$c1_name = get_post_meta( $p_ID, 'ct_criteria1_name', true); 			  				
			  				$c1_score = get_post_meta( $p_ID, 'ct_criteria1_score', true); 			  							  				

							// Criteria #2 and Score #2
			  				$c2_name = get_post_meta( $p_ID, 'ct_criteria2_name', true); 			  				
			  				$c2_score = get_post_meta( $p_ID, 'ct_criteria2_score', true); 			  							  				

							// Criteria #3 and Score #3
			  				$c3_name = get_post_meta( $p_ID, 'ct_criteria3_name', true); 			  				
			  				$c3_score = get_post_meta( $p_ID, 'ct_criteria3_score', true); 			  							  				

							// Criteria #4 and Score #4
			  				$c4_name = get_post_meta( $p_ID, 'ct_criteria4_name', true); 			  				
			  				$c4_score = get_post_meta( $p_ID, 'ct_criteria4_score', true); 			  							  				

							// Criteria #5 and Score #5
			  				$c5_name = get_post_meta( $p_ID, 'ct_criteria5_name', true); 			  				
			  				$c5_score = get_post_meta( $p_ID, 'ct_criteria5_score', true); 			  							  				

							// Criteria #5 and Score #5
							$summary = get_post_meta( $p_ID, 'ct_summary', true); 			  							  							  				
			  				
			  				echo '<span class="score_name">' . $overall_name . '</span>'; 
			  				echo '<span class="score_value colored-title" itemprop="rating">' . $overall_score . '</span>'; 

			  				
			  			?>
			  			<ul class="score-list">
			  				<?php if ( !empty($c1_name) ): ?>
			  				<li class="clearfix">
			  					<?php 
			  						echo '<span class="criteria_name">' . $c1_name . '</span>';
									echo '<div class="rating-stars">';
										echo ct_get_single_rating ( $c1_score, $p_ID );
									echo '</div>';	
								?>			  				
			  				</li>
			  				<?php endif;?>
			  				<?php if ( !empty($c2_name) ): ?>
			  				<li class="clearfix">
			  					<div class="row-fluid">
			  					<?php 
			  						echo '<span class="criteria_name">' . $c2_name . '</span>';

									echo '<div class="rating-stars">';
										echo ct_get_single_rating ( $c2_score, $p_ID );
									echo '</div>';	
								?>			  			
								</div>	
			  				</li>
			  				<?php endif;?>
			  				<?php if ( !empty($c3_name) ): ?>
			  				<li class="clearfix">
			  					<?php 
			  						echo '<span class="criteria_name">' . $c3_name . '</span>';
									echo '<div class="rating-stars">';
										echo ct_get_single_rating ( $c3_score, $p_ID );
									echo '</div>';	
								?>			  				
			  				</li>
			  				<?php endif;?>
			  				<?php if ( !empty($c4_name) ): ?>
			  				<li class="clearfix">
			  					<?php 
			  						echo '<span class="criteria_name">' . $c4_name . '</span>';
									echo '<div class="rating-stars">';
										echo ct_get_single_rating ( $c4_score, $p_ID );
									echo '</div>';	
								?>			  				
			  				</li>
			  				<?php endif;?>
			  				<?php if ( !empty($c5_name) ): ?>
			  				<li class="clearfix">
			  					<?php 
			  						echo '<span class="criteria_name">' . $c5_name . '</span>';
									echo '<div class="rating-stars">';
										echo ct_get_single_rating ( $c5_score, $p_ID );
									echo '</div>';	
								?>			  				
			  				</li>
			  				<?php endif;?>
			  				<?php if ( $summary != '' ) : ?>
			  				<li class="clearfix summary-review" itemprop="summary">
			  					<?php echo $summary; ?>
			  				</li>
			  				<?php endif; ?>
			  				
			  				
			  			</ul> <!-- /score-list -->
			  			<div class="clear"></div>
			  		</div>	<!-- /overall_score -->	 
			  	</div>	<!-- /review-block -->
				<?php endif; //review_post ?>
				
				<?php
					/* 
					*	=========================================
					*			Show Post Content
					*	=========================================
					*/
				
				?>


			  <div class="entry-content" itemprop="articleBody">
			  	<?php the_content(); ?>
			  </div> <!-- /entry-content -->
				
			  <div class="margin-30b"></div>
              <div class="divider-1px"></div>
				<?php
					/* 
					*	=========================================
					*			Show Post Tags
					*	=========================================
					*/
				
				?>			  
			  <div class="entry-tags clearfix">
			    <?php the_tags('','' ,'' ); ?>
			    <meta itemprop="keywords" content="<?php echo strip_tags(get_the_tag_list('',', ','')); ?>">
			  </div><!-- entry-tags -->
		  
			  <div class="margin-30b"></div>										


          <?php if ( is_active_sidebar('ct_single_after_content_widgets') ): ?>
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Single After Content Widgets") ) : ?>
		  	    <?php endif; ?>
		  <?php endif; ?>

			  <div class="margin-30b"></div>													  	
				<?php 
					if ( $single_nav == 'After Content' ) {
						get_template_part( 'single' , 'navigation' );
						echo '<div class="margin-45b"></div>';
					}
				?>
			  
			  <?php wp_link_pages(); ?>
				
                <div class="fbcomments">
                    <?php //echo do_shortcode('[fbcomments url="" width="550" count="off" num="3" url="http://www.maezissima.com.br" href="http://www.maezissima.com.br"]'); ?>
                    <div class="fb-comments" data-href="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" data-width="550" data-num-posts="10"></div>
                </div>

			  <div id="entry-comments" class="clearfix">
				<?php 
					/* 
					*	=========================================
					*			Get Comments Template
					*	=========================================
					*/
					comments_template(); 
				?>							


				<?php
					/* 
					*	=========================================
					*			If Comments == Facebook
					*	=========================================
					*/
				
				?>
						<?php if ($data['ct_comments_type']['facebook'] == true && $facebook_appid != '') { ?>
					    		<div class="post-title" style="margin-top:40px;">
					    			<h4 style="border-top: 1px solid #EBECED; padding-top: 10px;">
					    				<?php _e('Facebook Comments','color-theme-framework'); ?>
					    			</h4>
					    		</div><!-- post-title -->
					    		
					    		<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="2" data-width="470"></div><!-- fb-comments -->
					    		
								<div id="fb-root"></div><!-- fb-root -->
								
								<script>(function(d, s, id) {
								  var js, fjs = d.getElementsByTagName(s)[0];
								  if (d.getElementById(id)) return;
								  js = d.createElement(s); js.id = id;
								  js.src = <?php echo '"//connect.facebook.net/en_GB/all.js#xfbml=1&appId=' . $facebook_appid . '"'; ?>; ;
								  fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>
						<?php } ?>
						
				<?php
					/* 
					*	=========================================
					*			If Comments == Disqus
					*	=========================================
					*/
				
				?>

		<?php if ($data['ct_comments_type']['disqus'] == true && $disqus_shortname != '') { ?>
        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = <?php echo json_encode($disqus_shortname); ?>; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
      								
		<?php } ?>

	</div><!-- entry-comments -->
	</article><!-- post-ID -->
 						
				<?php
			  			endwhile;  
					endif;  
				?>		

				<?php 
					if ( $single_nav == 'Bottom' ) {
						get_template_part( 'single' , 'navigation' );
					}
				?>

	

		</div> <!-- post-entry -->
	  </div><!-- span12 -->
	</div><!-- row-fluid -->