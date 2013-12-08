<?php
	/*
		* 
		* Template File For Format Post: Gallery ( Used in widgets )
		*
	*/
?>


<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Gallery
-----------------------------------------------------------------------------------------------------------------							
*/
?>
		<div class="single-media-thumb">

		
<?php
	global $data, $post;
	$time_id = rand();
?>


	<script type="text/javascript">
	/* <![CDATA[ */
	jQuery.noConflict()(function($){
	   	$(window).load(function () {	    
			$('#slider-<?php echo $time_id; ?>').flexslider({
			    animation: "fade",
				directionNav: true,
				controlNav: false,
				slideshow: false,
				smoothHeight: true
			});

   		});
	});
   	/* ]]> */
	</script>

			<!-- Start FlexSlider -->
			<div id="slider-<?php echo $time_id; ?>" class="entry-gallery flexslider clearfix">
				  <ul class="slides clearfix">
				<?php
				    global $wpdb, $post;
			    
				    $meta = get_post_meta(get_the_ID(), 'ct_plupload', false);

				    if (!is_array($meta)) $meta = (array) $meta;
					    if (!empty($meta)) {
						    $meta = implode(',', $meta);
			
						    $images = $wpdb->get_col("
							    SELECT ID FROM $wpdb->posts
							    WHERE post_type = 'attachment'
							    AND ID in ($meta)
							    ORDER BY menu_order ASC
						    ");

					    foreach ($images as $att) {
						    $src = wp_get_attachment_image_src($att, 'slider-thumb');		    
						    $src = $src[0];
			    ?>
				    <li>
						<img src="<?php echo $src; ?>" alt="<?php the_title(); ?>">
						<div class="mask"><a href="<?php echo $src; ?>" data-rel="prettyPhoto[gal]"></a></div>
				    </li>
			    <?php
					    } 
				} 
			?>
				  </ul>
			</div> <!-- /flexSlider -->		
							
					<?php
				       	 if ( has_post_format('gallery') && ( $src != '' )  ) {
				       	 	echo '<div class="post-format-block" title="'.__('Post format: Gallery','color-theme-framework').'"><div class="format-gallery"></div></div>'; 	
				       	 }
				    ?>   	 				      

			</div> <!-- /single-media-thumb -->

<div class="clear"></div>

