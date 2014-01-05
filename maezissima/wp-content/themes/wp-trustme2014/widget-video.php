<?php
	/*
		* 
		* Template File For Format Post: Video ( Used in widgets )
		*
	*/
?>
<?php	
	global $post, $data;
	
	$video_type = get_post_meta( $post->ID, 'ct_mb_post_video_type', true );
	
	if ( !is_single() ) {
		$thumb_type = get_post_meta( $post->ID, 'ct_mb_post_video_thumb', true );
	} else {
		$thumb_type = $data['ct_video_thumb_type'];
	}	
	
	if ( empty($thumb_type) ) { $thumb_type = 'player'; }
										
	$videoid = get_post_meta( $post->ID, 'ct_mb_post_video_file', true );
	$perma_link = get_permalink($post->ID);
	
	if( $videoid != '' ) : ?>
		<div class="single-media-thumb video-post-widget clearfix">

			<?php
				if ( $video_type == 'youtube' ) {
					if ( $thumb_type == 'auto' ) {
						echo '<img src="http://img.youtube.com/vi/' . $videoid . '/0.jpg" alt="'. the_title('','',false) . '" />';
					} 
					else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
							$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-thumb');
							echo '<img src="' . $small_image_url[0] . '" alt="'. the_title('','',false) . '" />';
						}
						else if ( $thumb_type == 'player' ) {
								echo '<iframe src="http://www.youtube.com/embed/' . $videoid .'?rel=0"></iframe>';
							}
							else { 
								echo '<img src="http://img.youtube.com/vi/' . $videoid . '/0.jpg" alt="'. the_title('','',false) . '" />'; 
							}
							
					if ( $thumb_type != 'player' ) {
				  		echo '<div class="mask"><a href="' . $perma_link . '"></a></div>';
				  		echo '<div class="video youtube"><a href="' . $perma_link . '" title="'. __('Watch Youtube Video','color-theme-framework').'"></a></div>';
				  	}
			     } /* end for Youtube */
			            				 
			     else if ( $video_type == 'vimeo' ) {
		         	if ( $thumb_type == 'auto' ) {
			     		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoid.php"));
			     		echo '<img src="' . $hash[0]['thumbnail_large'] . '" alt="'. the_title('','',false) . '" />';
					} 
						else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
							$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-thumb');
							echo '<img src="' . $small_image_url[0] . '" alt="'. the_title('','',false) . '" />';
						}
						else if ( $thumb_type == 'player' ) {
							echo '<iframe src="http://player.vimeo.com/video/' . $videoid . '?title=0&amp;byline=0&amp;portrait=0&amp;"></iframe>';
							}
							else {
			            			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoid.php"));
			            			echo '<img src="' . $hash[0]['thumbnail_large'] . '" alt="'. the_title('','',false) . '" />';
								}
								if ( $thumb_type != 'player' ) {
				  					echo '<div class="mask"><a href="' . $perma_link . '"></a></div>';
					  				echo '<div class="video vimeo"><a href="' . $perma_link . '" title="'. __('Watch Vimeo Video','color-theme-framework').'"></a></div>';
				  				}
			       } /* end for Vimeo */     	
			            				
					elseif ( $video_type == 'dailymotion' ) {
  						if ( $thumb_type == 'auto' ) {
      						echo '<img src="' . getDailyMotionThumb($videoid) . '" alt="'. the_title('','',false) . '" />';
						} 
						else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
								$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-thumb');
								echo '<img src="' . $small_image_url[0] . '" alt="'. the_title('','',false) . '" />';
							}
							else if ( $thumb_type == 'player' ) {
									echo '<iframe src="http://www.dailymotion.com/embed/video/' . $videoid . '"></iframe>';
								}
								else {
            						echo '<img src="' . getDailyMotionThumb($videoid) . '" alt="'. the_title('','',false) . '" />';
								}										
								if ( $thumb_type != 'player' ) {
	  								echo '<div class="mask"><a href="' . $perma_link . '"></a></div>';
		  							echo '<div class="video dailymotion"><a href="' . $perma_link . '" title="'. __('Watch DailyMotion Video','color-theme-framework').'"></a></div>';
	  							}
					 } /* end for Dailymotion */
				 ?>

				 <?php     
				 	if ( has_post_format('video') && ( $videoid != '' ) ) {
				 		echo '<div class="post-format-block" title="'.__('Post format: Video','color-theme-framework').'"><div class="format-video"></div></div>'; 
				 	}
				 ?>  
				 				            				
		</div> <!-- /single-media-thumb-->
	<?php endif; ?>	