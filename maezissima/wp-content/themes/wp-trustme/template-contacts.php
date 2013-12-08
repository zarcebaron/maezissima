<?php
	/* 
		Template Name: Contact
		
	 * @package WordPress 3.5
	 * @subpackage TrustMe - Responsive WordPress Blog / Magazine Theme
	 * @since TrustMe 1.0
		
	*/

get_header(); ?>


  <!-- START CONTACTS CONTENT ENTRY -->
  <div id="content" class="container">

	  <!-- CONTENT + RIGHT -->
      <div id="wide-sidebar" class="row-fluid">
        <div class="span8 main-content clearfix">

		  <div class="widget-title"><h3><?php the_title(); ?></h3></div>

		<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
			<?php the_content(); ?>
			
			<?php
				$google_maps = stripslashes( $data['ct_google_maps'] );
				
				if ( $google_maps != '' ) echo '<div class="google_maps_block">' . $google_maps . '</div>';
			?>
		<?php
 			endwhile; endif;  
		?>
		
		<script  type="text/javascript">
			jQuery.noConflict()(function($){
			$(document).ready(function ()
		{ 
		    $("#ajax-contact-form").submit(function ()
		    {
		        var str = $(this).serialize();
		        $.ajax(
		        {
		            type: "POST",
		            url: "<?php echo get_template_directory_uri(); ?>/contact.php",
		            data: str,
		            success: function (msg)
		            {
		                $("#note").ajaxComplete(function (event, request, settings)
		                {
		                    if (msg == 'OK') 
		                    {
                        		result = '<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><?php _e('Message was sent to website administrator. Thank you!','color-theme-framework');?></div>';
		                        $("#fields").hide();
		                    }
		                    else
		                    {
		                        result = msg;
		                    }
		                    $(this).html(result);
		                });
		            }
		        });
		        return false;
		    });
		});
		});		
		</script>

		<div class="row-fluid">
              <fieldset class="info_fieldset">
                
                  <div id="note"></div>

                <div id="contacts-form">		
	              <form id="ajax-contact-form" action="javascript:alert('Was send!');" class="clearfix">
	                <div class="span6">
		              <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span><input class="span10" id="contact-name" type="text" title="<?php _e('Your Name','color-theme-framework'); ?>" name="name" required="" placeholder="<?php _e('Your Name','color-theme-framework'); ?>">
                      </div>
		  	          <div class="input-prepend">
                        <span class="add-on"><i class="icon-envelope"></i></span><input class="span10" id="contact-email" type="email" title="<?php _e('Your Email Address','color-theme-framework'); ?>" name="email" required="" placeholder="<?php _e('Your Email Address','color-theme-framework'); ?>">
          	          </div>
		              <div class="input-prepend">
                        <span class="add-on"><i class="icon-share"></i></span><input class="span10" id="contact-url" type="url" title="<?php _e('Your URL','color-theme-framework'); ?>" name="url" placeholder="<?php _e('Your URL','color-theme-framework'); ?>">
                      </div>
		  	          <div class="input-prepend">
                        <span class="add-on"><i class="icon-flag"></i></span><input class="span10" id="contact-subject" type="text" title="<?php _e('Subject','color-theme-framework'); ?>" name="subject" required="" placeholder="<?php _e('Subject','color-theme-framework'); ?>">
          	          </div>
      	  	        </div><!-- span4 -->

	                <div class="span6">
				      <textarea id="textarea" name="message" required placeholder="<?php _e('Type your questions here...','color-theme-framework'); ?>" rows="7" class="span12 contact-textarea"></textarea>
                      <button type="submit" class="btn"><?php _e('Send Message','color-theme-framework'); ?></button>
      	  	        </div><!-- span12 -->

                    <span></span>
	              </form>
			    </div> <!-- end #contact-form -->
			  </fieldset>
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
  <!-- END CONTACTS CONTENT ENTRY -->

<?php get_footer(); ?>