<?php global $data; ?>

					<?php if ( ( stripslashes( $data['ct_facebook_link'] ) != '' ) || ( stripslashes( $data['ct_twitter_link'] ) != '' ) || ( stripslashes( $data['ct_skype_link'] ) != '' ) || ( stripslashes( $data['ct_google_link'] ) != '' ) || ( stripslashes( $data['ct_rss_link'] ) != '' ) || ( stripslashes( $data['ct_email_link'] ) != '' )) : ?>					
					<div class="span3">
						<ul id="social-icons">
						<?php if ( stripslashes( $data['ct_facebook_link'] ) != '' ) : ?>
							<li><a href="<?php echo stripslashes( $data['ct_facebook_link'] ); ?>" target="_blank" title="<?php _e( 'Nosso Facebook' , 'color-theme-framework' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/facebook.png" alt="" /></a></li>
						<?php endif; ?>	
						
						<?php if ( stripslashes( $data['ct_twitter_link'] ) != '' ) : ?>						
							<li><a href="<?php echo stripslashes( $data['ct_twitter_link'] ); ?>" target="_blank" title="<?php _e( 'Nosso Twitter' , 'color-theme-framework' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter.png" alt="" /></a></li>
						<?php endif; ?>	

						<?php if ( stripslashes( $data['ct_skype_link'] ) != '' ) : ?>						
							<li><a href="<?php echo stripslashes( $data['ct_skype_link'] ); ?>" target="_blank" title="<?php _e( 'Nosso Skype' , 'color-theme-framework' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/skype.png" alt="" /></a></li>						
						<?php endif; ?>

						<?php if ( stripslashes( $data['ct_google_link'] ) != '' ) : ?>								
							<li><a href="<?php echo stripslashes( $data['ct_google_link'] ); ?>" target="_blank" title="<?php _e( 'Nosso Google Plus' , 'color-theme-framework' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/google.png" alt="" /></a></li>						
						<?php endif; ?>

						<?php if ( stripslashes( $data['ct_rss_link'] ) != '' ) : ?>														
							<li><a href="<?php echo stripslashes( $data['ct_rss_link'] ); ?>" target="_blank" title="<?php _e( 'Inscreva-se via RSS' , 'color-theme-framework' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/rss.png" alt="" /></a></li>	
						<?php endif; ?>

						<?php if ( stripslashes( $data['ct_email_link'] ) != '' ) : ?>																		
							<li><a href="<?php echo stripslashes( $data['ct_email_link'] ); ?>" target="_self" title="<?php _e( 'Fale conosco via Email' , 'color-theme-framework' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/email.png" alt="" /></a></li>													
						<?php endif; ?>	
						</ul>
					</div> <!-- /span3 -->

					<?php endif; ?>