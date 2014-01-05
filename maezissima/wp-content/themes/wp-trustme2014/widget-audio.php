<?php
	/*
		* 
		* Template File For Format Post: Audio ( Used in widgets )
		*
	*/
?>



<?php 
	global $data;
							
	$display_content = stripslashes( $data['ct_excerpt_function'] );
	
	$soundcloud = get_post_meta( $post->ID, 'ct_mb_post_soundcloud', true );

?>

<?php if ( $soundcloud != '' ) : ?>
	<div class="single-media-thumb">
		<?php echo $soundcloud; ?>

	  	<?php 
	  		if ( has_post_format('audio') && ( $soundcloud != '' ) ) {
	  			echo '<div class="post-format-block" title="'.__('Post format: Audio','color-theme-framework').'"><div class="format-audio"></div></div>'; 
	  		}	
	  	?>		
		
	</div> <!-- /single-media-thumb -->
<?php endif; ?>	