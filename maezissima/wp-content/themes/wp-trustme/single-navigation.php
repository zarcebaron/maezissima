<?php
/*
*	==================================================
*		Template For Single Navigation
*	==================================================
*/
?>

				<?php if( get_previous_post() || get_next_post() )  { ?>	
					<!-- Begin Navigation -->
					<div class="single-post-navigation <?php if ( is_active_sidebar('ct_single_after_widgets') ) { echo 'margin-bottom'; } ?>">
						
						<div class="prev-left" >
							<?php if( get_previous_post() ) : ?>
								<?php previous_post_link('<div class="prev-arrow" title="' .__( 'Ir para o post anterior' , 'color-theme-framework' ). '"><span class="arrow-prev-ico"></span>%link</div>') ?>
							<?php endif; ?>					
						</div> <!-- /prev-left -->
						
						<div class="next-right" >
							<?php if( get_next_post() ) : ?>
								<?php next_post_link('<div class="next-arrow" title="' .__( 'Ir para o próximo post' , 'color-theme-framework' ). '"><span class="arrow-next-ico"></span>%link</div>') ?>
							<?php endif; ?>					
						</div> <!-- /next-right -->
						<div class="clear"></div>
					</div> <!-- /single-post-navigation -->
				 <?php } ?>	
