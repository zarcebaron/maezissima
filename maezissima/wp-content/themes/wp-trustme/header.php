<!DOCTYPE html>
<!-- A ZERGE design (http://www.color-theme.com - http://themeforest.net/user/ZERGE) - Proudly powered by WordPress (http://wordpress.org) -->

<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>


    <?php global $data; ?>
        
	<title><?php wp_title( '|', true, 'right' ); ?></title>
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta property="fb:app_id" content="{306499332820130}">
	<!-- Mobile Specific Metas  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="U1FoSu0pcKNyGTLrrKLCtXQvwNgiQE2a1opyTJKaRqM" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 
	<link rel="author" href="https://plus.google.com/107228938743142434794?/rel=author"/>
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo stripslashes( $data['ct_custom_favicon'] ); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-responsive.css">

</head>

<body <?php body_class('body-class'); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=306499332820130";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Start Top Content -->

	<p class="testp"></p>
  <div id="header" itemscope itemtype="http://schema.org/WPHeader" >

    	<div class="top-menu-block">
    		<div class="container">
    			<div class="row-fluid">

	<?php if ( ( stripslashes( $data['ct_facebook_link'] ) == '' ) && ( stripslashes( $data['ct_twitter_link'] ) == '' ) && ( stripslashes( $data['ct_skype_link'] ) == '' ) && ( stripslashes( $data['ct_google_link'] ) == '' ) && ( stripslashes( $data['ct_rss_link'] ) == '' ) && ( stripslashes( $data['ct_email_link'] ) == '' )) { ?>		    	
				<div class="span12">
			<?php } else { ?>										
    				<div class="span9">
    		<?php } ?>		
    				
			    	<?php if ( has_nav_menu('secondary_menu') ) wp_nav_menu( array('theme_location' => 'secondary_menu', 'menu_class' => 'sf-menu add-nav')); ?>		    	
			    	</div> <!-- /span9 -->
					
					<?php get_template_part( 'social' , 'icons' ); ?>

		    	</div>
	    	</div>
    	</div>

    <!-- START TOP BLOCK -->
    <div id="top-block-bg" class="" data-speed="-1.5">
    	
  	  <div class="container">
        <div class="row-fluid">
          <div class="span4 logo-block">
      	  	    <div class="row-fluid">
    	    	  <div class="span12">
				    <div id="logo">
		  			  <?php $logo_type = stripslashes( $data['ct_type_logo'] );  			
						if ( $logo_type == "image" ) { 
							if ( is_front_page() ) {
						?>
								<a onclick="_gaq.push(['_trackEvent', 'Click', 'Click Home', 'Clicks no logo da home']);" href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes( $data['ct_logo_upload'] ) ?>" alt="" /></a>
							<?php } else { ?>
							<a href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes( $data['ct_logo_upload'] ) ?>" alt="" /></a>
						<?php } 
						} ?>
				
						<?php
						if ( $logo_type == "text" ) { ?>
							<span class="logo-slogan"><?php echo stripslashes( $data['ct_logo_slogan'] ); ?></span>

							<?php if ( is_front_page() ) { ?>
								<h1><a href="<?php echo home_url(); ?>"><?php echo stripslashes( $data['ct_logo_text'] ); ?></a></h1>
							<?php } else { ?>
								<h2><a href="<?php echo home_url(); ?>"><?php echo stripslashes( $data['ct_logo_text'] ); ?></a></h2>
							<?php }  ?>
							
					  <?php }	?>
				    </div> <!-- #logo -->
    	    	  </div><!-- /span12 -->
    	  	    </div><!-- /row-fluid -->
          </div><!-- /span3 -->
          
        </div><!-- /row-fluid -->


	  </div><!-- /container --> 
      <?php //include('badge.php'); ?>     
    </div><!-- /top-block-bg -->	
   
        <?php include('photo-credit.php'); ?>
          <!-- START MAIN MENU -->
  <div id="mainmenu-block-bg">
	<div class="container">
	  <div class="row-fluid">
	    <div class="span12 bg_menu">	  
		  <div class="navigation">
		    <div id="menu">
		  	  <?php 
				if ( has_nav_menu('main_menu') ) wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'sf-menu')); 					
			  ?>             
		    </div> <!-- /menu -->
		  </div>  <!-- /navigation -->
		</div> <!-- /span12 -->
         <ul class="nav-categories clearfix">
                  <?php $args = array(
                    'show_option_all'    => '',
                    'orderby'            => 'name',
                    'order'              => 'ASC',
                    'style'              => 'list',
                    'show_count'         => 0,
                    'hide_empty'         => 1,
                    'use_desc_for_title' => 1,
                    'child_of'           => 0,
                    'feed'               => '',
                    'feed_type'          => '',
                    'feed_image'         => '',
                    'exclude'            => '1,14,17,18,19,20,50,64,138',
                    'exclude_tree'       => '',
                    'include'            => '',
                    'hierarchical'       => 1,
                    'title_li'           => __( '' ),
                    'show_option_none'   => __('No categories'),
                    'number'             => null,
                    'echo'               => 1,
                    'depth'              => 0,
                    'current_category'   => 1,
                    'pad_counts'         => 0,
                    'taxonomy'           => 'category',
                    'walker'             => null
					); ?>
					<?php wp_list_categories($args); ?> 
                </ul> 
      </div><!-- /row-fluid -->
  	</div> <!-- container -->
  </div> <!-- mainmenu-block-bg -->	    
    <!-- END TOP BLOCK -->
	<div style="clear:both"></div>
  </div> <!-- #header -->
