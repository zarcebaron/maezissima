<?php
/**
 * Slightly Modified Options Framework
*/
require_once ('admin/index.php');

global $data;
/*=======================================
    Preparing the Theme For Localization
=======================================*/

add_action('after_setup_theme', 'ct_theme_setup');
if ( !function_exists( 'ct_theme_setup' ) ) {	
  function ct_theme_setup(){
	load_theme_textdomain( 'color-theme-framework', get_template_directory() . '/languages' );
	
  	/* Configure WP 2.9+ Thumbnails ---------------------------------------------*/
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   

	add_image_size( 'small-thumb', 50, 50, true );		// widget thumbs	
	add_image_size( 'carousel-thumb', 144, 100, true );	// carousel thumbs	
	add_image_size( 'slider-thumb', 708, 404, true );	// slider thumbs	
	add_image_size( 'big-thumbs', 100, 87, true ); 
  }
}

//require_once('woosidebars/woosidebars.php');
/*=======================================
	Add WP Menu Support
=======================================*/

function register_ct_menu() { 
  register_nav_menus(
    array(
      'main_menu' => __( 'main navigation' , 'color-theme-framework' ),
      'secondary_menu' => __( 'additional navigation' , 'color-theme-framework' )
    )
  );
}

add_action( 'init', 'register_ct_menu' ); 


function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


/*=======================================
	Register Sidebar
=======================================*/

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Magazine Top Widgets' , 'color-theme-framework' ),
		'id' => 'ct_magazine_top_widgets',
        'before_widget' => '<div class="widget clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Magazine Center Widgets' , 'color-theme-framework' ),
		'id' => 'ct_magazine_center_widgets',		
        'before_widget' => '<div class="widget box-content clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div><!-- widget-title -->',
    ));


if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Magazine Sidebar' , 'color-theme-framework' ),
		'id' => 'ct_magazine_sidebar',				
        'before_widget' => '<div class="widget box-content-sidebar clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div><!-- widget-title -->',
    ));

// ##########  SINGLE POST WIDGETS   #############
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Single Top Widgets' , 'color-theme-framework' ),
		'id' => 'ct_single_top_widgets',				
        'before_widget' => '<div class="widget clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Single Before Widgets' , 'color-theme-framework' ),
		'id' => 'ct_single_before_widgets',		
        'before_widget' => '<div class="widget box-content clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Single After Content Widgets' , 'color-theme-framework' ),
		'id' => 'ct_single_after_content_widgets',		
        'before_widget' => '<div class="widget box-content clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Single After Widgets' , 'color-theme-framework' ),
		'id' => 'ct_single_after_widgets',				
        'before_widget' => '<div class="widget box-content clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div><!-- widget-title -->',
    ));    


if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Single Sidebar' , 'color-theme-framework' ),
		'id' => 'ct_single_sidebar',				
        'before_widget' => '<div class="widget box-content-sidebar clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div><!-- widget-title -->',
    ));    
  

// ##########  CATEGORY WIDGETS   #############
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Category Top Widgets' , 'color-theme-framework' ),
		'id' => 'ct_category_top_widgets',
        'before_widget' => '<div class="widget clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Category Before Widgets' , 'color-theme-framework' ),
		'id' => 'ct_category_before_widgets',		
        'before_widget' => '<div class="widget box-content clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Category After Widgets' , 'color-theme-framework' ),
		'id' => 'ct_category_after_widgets',		
        'before_widget' => '<div class="widget box-content clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));    

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Category Sidebar' , 'color-theme-framework' ),
		'id' => 'ct_category_sidebar',		
        'before_widget' => '<div class="widget box-content-sidebar clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div><!-- widget-title -->',
    ));


// ##########  BLOG WIDGETS   #############
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Blog Top Widgets' , 'color-theme-framework' ),
		'id' => 'ct_blog_top_widgets',
        'before_widget' => '<div class="widget clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Blog Before Widgets' , 'color-theme-framework' ),
		'id' => 'ct_blog_before_widgets',		
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Blog After Widgets' , 'color-theme-framework' ),
		'id' => 'ct_blog_after_widgets',		
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));    

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Blog Sidebar' , 'color-theme-framework' ),
		'id' => 'ct_blog_sidebar',				
        'before_widget' => '<div class="widget box-content-sidebar clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div><!-- widget-title -->',
    ));
  

$footer_columns = $data['ct_footer_columns'];

switch( $footer_columns ) {
	case '1 Column':
		$footer_columns = 12;
		break;

	case '2 Columns':
		$footer_columns = 6;
		break;

	case '3 Columns':
		$footer_columns = 4;
		break;
		
	case '4 Columns':
		$footer_columns = 3;
		break;
		
}

// ##########  FOOTER WIDGETS   #############
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => __( 'Footer' , 'color-theme-framework' ),
        'before_widget' => '<div class="span'.$footer_columns.'"><div class="widget margin-45t clearfix">',
        'after_widget' => '</div><!-- .widget --></div><!-- span3 -->',
        'before_title' => '<div class="footer-widget-title"><h3>',
        'after_title' => '</h3></div><!-- widget-title -->',
));


if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => __( 'Sidebar Widgets' , 'color-theme-framework' ),
		'id' => 'ct_sidebar_widgets',				
        'before_widget' => '<div class="widget box-content-sidebar clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div><!-- widget-title -->',
    ));



/*-----------------------------------------------------------------------------------*/
/* Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_wp_title' ) ) {
    function ct_wp_title( $title, $sep ) {
        global $paged, $page;

        if ( is_feed() )
            return $title;

        // Add the site name.
        $title .= get_bloginfo( 'name' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";

        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', 'color-theme-framework' ), max( $paged, $page ) );

        return $title;
    }
    add_filter( 'wp_title', 'ct_wp_title', 10, 2 );
}


/*=======================================
            Thumbnail Column
=======================================*/
// Add the posts and pages columns filter. They can both use the same function.
add_filter('manage_posts_columns', 'tcb_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'tcb_add_post_thumbnail_column', 5);

// Add the column
function tcb_add_post_thumbnail_column($cols){
  $cols['tcb_post_thumb'] = __('Featured', 'color-theme-framework');
  return $cols;
}

// Hook into the posts an pages column managing. Sharing function callback again.
add_action('manage_posts_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);

// Grab featured-thumbnail size post thumbnail and display it.
function tcb_display_post_thumbnail_column($col, $id){

        $width = (int) 50;
        $height = (int) 50;
  switch($col){
    case 'tcb_post_thumb':
      if( function_exists('the_post_thumbnail') )
        echo the_post_thumbnail( array($width, $height) );
      else
        echo 'Not supported in theme';
      break;
  }
}



/*=======================================
	Content Width and Excerpt Redeclared
=======================================*/
if ( !isset( $content_width ) ) 
    $content_width = 980;

// Remove rel attribute from the category list
function remove_category_list_rel($output)
{
  $output = str_replace(' rel="category"', '', $output);
  return $output;
}

add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');

remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );

add_theme_support( 'automatic-feed-links' );

function new_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');


function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');



/*-----------------------------------------------------------------------------------*/
/*  This will add rel=lightbox[postid] to the href of the image link
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_add_prettyphoto_rel' ) ) {
    function ct_add_prettyphoto_rel ($content)
    {   
        global $post;
        $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
        $replacement = '<a$1href=$2$3.$4$5 rel="prettyphoto['.$post->ID.']"$6>$7</a>';
        $content = preg_replace($pattern, $replacement, $content);
        return $content;
    }
    add_filter('the_content', 'ct_add_prettyphoto_rel', 12);
}



/*
============================================================================
	*
	* Google Fonts
	*
============================================================================	
*/

if ( ! function_exists( 'ct_google_fonts' ) ) {
		function ct_google_fonts() {
			global $data;
			
			if ( isset( $data['ct_google_stylesheet'] ) ) 
			{
				if ( stripslashes( $data['ct_google_stylesheet'] ) != ''  ) {
					echo stripslashes( $data['ct_google_stylesheet'] );
					
					echo '<style type="text/css">h1,h2,h3,h4,h5,h6 { ';
					echo stripslashes( $data['ct_google_fontfamily'] );
					echo '}</style>';
				}			
			}


}
}

add_action('wp_head','ct_google_fonts');


if ( ! function_exists( 'ct_ie_fix' ) ) {
		function ct_ie_fix() {

    echo '<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->';
    echo '<!--[if lt IE 9]>';
      echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
	  echo '<script src="'. get_template_directory_uri(). '/js/respond.min.js"></script>';              
    echo '<![endif]-->';

		
	}
}
add_action('wp_head','ct_ie_fix');

/*
============================================================================
	*
	* Google Analytics
	*
============================================================================	
*/


if ( ! function_exists ( 'ct_func_google' ) ) {
	function ct_func_google() {
		global $data;
		echo stripslashes ( $data['ct_google_analytics'] );
	}
}

add_action('wp_footer', 'ct_func_google');

/*=======================================
	Add Admin Bar only for Editors
=======================================*/

if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}

//add_filter('show_admin_bar', '__return_false');


/*=======================================
	Show Featured Images in RSS Feed
 =======================================*/

function featuredtoRSS($content) {
  global $post;
  if ( has_post_thumbnail( $post->ID ) ){
    $content = '<div>' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
  }
  return $content;
}
 
add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');


/*=======================================
	Post Formats
=======================================*/

add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );


/*=======================================
	Enable Shortcodes In Sidebar Widgets
=======================================*/

add_filter('widget_text', 'do_shortcode');


/*=======================================
	Include jQuery Libraries
=======================================*/

add_action('wp_enqueue_scripts', 'ct_scripts_method');

if ( !function_exists( 'ct_scripts_method' ) ) {
function ct_scripts_method() {

	//enqueue jquery
	wp_enqueue_script('jquery');

	if( !is_admin() ) {
	
		global $data;

		/* Super Fish JS */
		wp_register_script('super-fish',get_template_directory_uri().'/js/superfish.js',false, null , true);
		wp_enqueue_script('super-fish',array('jquery'));	

		/* Jquery-Easing */
		wp_register_script('jquery-easing',get_template_directory_uri().'/js/jquery.easing.1.3.js',false, null , true);
		wp_enqueue_script('jquery-easing',array('jquery'));	

		/* Google Prettify */
		wp_register_script('google-prettify',get_template_directory_uri().'/js/prettify.js',false, null , true);
		wp_enqueue_script('google-prettify',array('jquery'));
		
		/* Flex Slider */
		wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
		wp_enqueue_script('flex-min-jquery',array('jquery'));	

		/* Prettyphoto */
		wp_register_script('prettyphoto-js',get_template_directory_uri().'/js/jquery.prettyphoto.js',false, null , true);
		wp_enqueue_script('prettyphoto-js',array('jquery'));


		/* To Top */
		wp_register_script('scrolltopcontrol-js',get_template_directory_uri().'/js/scrolltopcontrol.js',false, null , true);
		wp_enqueue_script('scrolltopcontrol-js',array('jquery'));

		/* Bootstrap */
		wp_register_script('jquery-bootstrap',get_template_directory_uri().'/js/bootstrap.js',false, null , true);
		wp_enqueue_script('jquery-bootstrap',array('jquery'));


		/* Custom JS */
		wp_register_script('custom-js',get_template_directory_uri().'/js/custom.js',false, null , true);
		wp_enqueue_script('custom-js',array('jquery'));
		
	
	} /* End Include jQuery Libraries */
  }
}


add_action( 'init', 'ct_register_styles' );
 
if ( !function_exists( 'ct_register_styles' ) ) {
	function ct_register_styles() {
		if ( !is_admin() ) { // we do not want this to load in the dashboard

			//wp_register_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css', '', '', 'all' );
			//wp_enqueue_style( 'bootstrap' );

			//wp_register_style( 'bootstrap-responsive', get_template_directory_uri().'/css/bootstrap-responsive.css', '', '', 'all' );
			//wp_enqueue_style( 'bootstrap-responsive' );

			wp_register_style( 'style', get_stylesheet_directory_uri().'/style.css', '', '', 'all' );
			wp_enqueue_style( 'style' );

			wp_register_style( 'prettyPhoto-css', get_template_directory_uri().'/css/prettyphoto.css', '', '', 'all' );
			wp_enqueue_style( 'prettyPhoto-css' );

			//wp_register_style( 'custom-options', get_template_directory_uri().'/css/options.css', '', '', 'all' );
			//wp_enqueue_style( 'custom-options' );

			if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
		}
	}
}


add_action( 'init', 'wap8_google_fonts' );
 
if ( !function_exists( 'wap8_google_fonts' ) ) {
	function wap8_google_fonts() {
		if ( !is_admin() ) { // we do not want this to load in the dashboard
			// register Google Fonts stylesheet
			wp_register_style( 'oswald_google-fonts', 'http://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext', '', '', 'screen' );
 
			// enqueue Google Fonts stylesheet
			wp_enqueue_style( 'oswald_google-fonts' );
		}
	}
}


// Related Post
function get_related_posts($post_id, $tags = array(), $posts_number_display) {
	$query = new WP_Query();
	
	$post_types = get_post_types();
	unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
	
	if($tags) {
		foreach($tags as $tag) {
			$tagsA[] = $tag->term_id;
		}
	}
	$query = new WP_Query( array('showposts' => $posts_number_display,'post_type' => $post_types,'post__not_in' => array($post_id),'tag__in' => $tagsA,'ignore_sticky_posts' => 1,
	));
  	return $query;
}



function pagination($pages = '', $range = 4)
{ 
     $showitems = ($range * 2)+1; 
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }  
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination clearfix\"><span>Página ".$paged." de ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; Primeira</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Anterior</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Próxima &rsaquo;</a>"; 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Última &raquo;</a>";
         echo "</div>\n";
     }
}



function upload_styles_post() {
	wp_enqueue_style('thickbox');
	wp_enqueue_style( 'style-metabox-admin',get_template_directory_uri().'/admin/assets/css/metabox-options.css','','','all');
}

add_action('admin_print_styles', 'upload_styles_post'); 

// Removes title attribute from categories lists
function wp_list_categories_remove_title_attributes($output) {
    $output = preg_replace('` title="(.+)"`', '', $output);
    return $output;
}
add_filter('wp_list_categories', 'wp_list_categories_remove_title_attributes');

// Get DailyMotion Thumbnail
function getDailyMotionThumb( $id ) {
	if ( ! function_exists( 'curl_init' ) ) {
		return null;
	} else {
		$ch = curl_init();
		$videoinfo_url = "https://api.dailymotion.com/video/$id?fields=thumbnail_url";
		curl_setopt( $ch, CURLOPT_URL, $videoinfo_url );
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_FAILONERROR, true ); // Return an error for curl_error() processing if HTTP response code >= 400
		$output = curl_exec( $ch );
		$output = json_decode( $output );
		$output = $output->thumbnail_url;
		if ( curl_error( $ch ) != null ) {
			$output = new WP_Error( 'dailymotion_info_retrieval', __( 'Error retrieving video information from the URL','color-theme-framework') . '<a href="' . $videoinfo_url . '">' . $videoinfo_url . '</a>.<br /><a href="http://curl.haxx.se/libcurl/c/libcurl-errors.html">Libcurl error</a> ' . curl_errno( $ch ) . ': <code>' . curl_error( $ch ) . '</code>. If opening that URL in your web browser returns anything else than an error page, the problem may be related to your web server and might be something your host administrator can solve.' );
		}
		curl_close( $ch ); // Moved here to allow curl_error() operation above. Was previously below curl_exec() call.
		return $output;
	}
};


function ct_get_post_count() {
	 $res_search = &new WP_Query("showposts=-1");
	 $count = $res_search->post_count;

	 return $count; 
	     
	 wp_reset_query();
	 unset($res_search, $count);
}



// Add Widgets
include("functions/trustme-popular-post-widget.php");
include("functions/trustme-news-ticker-widget.php");
include("functions/trustme-slider-widget.php");
include("functions/trustme-1-column-vert-magazine-widget.php");
include("functions/trustme-1-column-horiz-magazine-widget.php");
include("functions/trustme-2-columns-magazine-widget.php");
include("functions/trustme-3-columns-magazine-widget.php");
include("functions/trustme-ads728x90-widget.php");
include("functions/trustme-ads300x250-widget.php");
include("functions/trustme-4ads125x125-widget.php");
include("functions/trustme-flickr-widget.php");
include("functions/trustme-fbsubscribe-widget.php");
include("functions/trustme-fblikebox-widget.php");
include("functions/trustme-twitter-widget.php");
include("functions/trustme-categories-widget.php");
include("functions/trustme-recent-posts-widget.php");
include("functions/trustme-recent-posts-thumbs-widget.php");
include("functions/trustme-tabs-widget.php");
include("functions/trustme-social-counter-widget.php");
include("functions/trustme-sharethis-widget.php");
include("functions/trustme-search-widget.php");
include("functions/trustme-related-posts-widget.php");
include("functions/trustme-blog-widget.php");
include("functions/trustme-author-profile-widget.php");


include("meta-box/meta-box.php");

/* Create Social User Information */
include("includes/sidebar_generator.php");

/* Create Post Views in admin panel */
include("includes/post_views.php");

/* AJAX Thumbnail Rebuild */
require_once ('includes/ajax-thumbnail-rebuild.php');

/* Update notifier */
include("includes/update-notifier.php");

/* Get Shortcodes */
include("includes/shortcodes.php");

/* Update notifier */
require_once ("includes/update-notifier.php");
// ****************************************************
// Custom Page Description field below post/page editor
// ****************************************************
add_action('admin_menu', 'custom_page_desc');
add_action('save_post', 'save_custom_page_desc');

function custom_page_desc() {
	add_meta_box('custom_page_desc', 'Add Page description <small>(if left empty, the first 200 characters of the excerpt will be used)</small>', 'custom_page_desc_input_function', 'page', 'normal', 'high');
}

function custom_page_desc_input_function() {
	global $post;
	echo '<input type="hidden" name="custom_page_desc_input_hidden" id="custom_page_desc_input_hidden" value="'.wp_create_nonce('custom-page-desc-nonce').'" />';
	echo '<input type="text" name="custom_page_desc_input" id="custom_page_desc_input" style="width:100%;" value="'.get_post_meta($post->ID,'_custom_page_desc',true).'" />';
}

function save_custom_page_desc($post_id) {
	if (!wp_verify_nonce($_POST['custom_page_desc_input_hidden'], 'custom-page-desc-nonce')) return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	$customMetaDesc = $_POST['custom_page_desc_input'];
	update_post_meta($post_id, '_custom_page_desc', $customMetaDesc);
}



// Get author for comment
function dp_get_author($comment) {
    $author = "";
    if ( empty($comment->comment_author) )
        $author = __('Anonymous', 'color-theme-framework');
    else
        $author = $comment->comment_author;
    return $author;
} 



function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>


  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

    <div id="comment-<?php comment_ID(); ?>" class="first-comment">
   
      <?php if ($comment->comment_approved == '0') : ?>
   	    <em><?php _e( 'Your comment is awaiting moderation.' , 'color-theme-framework' ); ?></em>
   	  <?php endif; ?>
   	  

   	  
	  <div class="entry-comment-meta">
	  
	  	<div style="width:60px; float:left;display:block;margin-right:10px;">
			<?php echo get_avatar($comment,$size='50',$default='' ); ?>	  	
	  	</div>
	  	<div style="float:left;display:block">
	    <div class="comment-author-link user-ico">
	      <?php comment_author_link(); ?>
		</div><!-- comment-author-link -->
		
		<div class="comment-date-link comment-date-ico" style="clear:both">
		  <?php echo get_comment_date('F d, Y g:i:s a'); ?>
		</div><!-- comment-date-link -->

  	  </div>
  	  
		<div class="clear"></div>
		<?php comment_text() ?>

	  </div><!-- entry-comment-meta -->

	
		
      <div class="replay-buttton">	
	    <?php comment_reply_link(array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>	
	  </div><!-- replay-buttton -->
	  		<div class="clear"></div>
    </div> <!-- end #comment-ID -->
  <?php
}


/*=======================================
		SOCIAL COUNTER FUNCTIONS
=======================================*/

	function ct_curl_subscribers_text_counter( $xml_url ) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $xml_url);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	function ct_yt_count( $username ) { 
		try {
			@$xmlData = @ct_curl_subscribers_text_counter('http://gdata.youtube.com/feeds/api/users/' . strtolower($username)); 
			@$xmlData = str_replace('yt:', 'yt', $xmlData); 
			@$xml = new SimpleXMLElement($xmlData); 
			@$ytCount['yt_count'] = ( string ) $xml->ytstatistics['subscriberCount'];
			@$ytCount['page_url'] = "http://www.youtube.com/user/".$username;
		} catch (Exception $e) {
			$ytCount['yt_count'] = 0;
			$ytCount['page_url'] = "http://www.youtube.com";
		}
		return($ytCount); 
	} 

	function ct_followers_count( $twitter_id ) {
		try {
			@$url = "https://api.twitter.com/1/users/show.json?screen_name=".$twitter_id;
			@$reply = json_decode(@ct_curl_subscribers_text_counter($url));
			@$twitter['followers_count'] = $reply->followers_count;
		} catch (Exception $e) {
			$twitter['followers_count'] = '0';
		}
		return $twitter;
	}

/*
============================================================================
	*
	* Get Single Star Rating
	*
============================================================================	
*/

function ct_get_single_rating( $score_value, $local_ID ) {

	$stars_color = get_post_meta( $local_ID , 'ct_stars_color', true);			
	if ( $stars_color == '' ) $stars_color = '#DD0C0C';

	switch( $score_value ) {
		case 0:
			$score = 'zero';
			break;
		case 0.5:
			$score = 'zero_half';
			break;
		case 1:
			$score = 'one';
			break;
		case 1.5:
			$score = 'one_half';
			break;
		case 2:
			$score = 'two';
			break;
		case 2.5:
			$score = 'two_half';
			break;
		case 3:
			$score = 'three';
			break;
		case 3.5:
			$score = 'three_half';
			break;
		case 4:
			$score = 'four';
			break;
		case 4.5:
			$score = 'four_half';
			break;
		case 5:
			$score = 'five';
			break;
				
			}		
			return '<div class="rating ' . $score . '" title="'.__('Review Post','color-theme-framework').'" style="background-color:'. $stars_color . '"></div>';			
}

// Custom WordPress Login Logo
function login_css() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/css/login.css' );
}
add_action('login_head', 'login_css');

/* Disable WordPress Admin Bar for all users but admins. */
  show_admin_bar(false);
  
/* CUSTOM POST TYPE - APOIADORES */
/*
add_action( 'init', 'create_my_post_types' );

function create_my_post_types() {
	register_post_type( 'parceiros', 
		array(
			'labels' => array(
				'name' => __( 'Parceiros' ),
				'singular_name' => __( 'Parceiro' ),
				'add_new' => __( 'Add Novo' ),
				'add_new_item' => __( 'Add New Parceiro' ),
				'edit' => __( 'Editar' ),
				'edit_item' => __( 'Editar Parceiro' ),
				'new_item' => __( 'Novo Parceiro' ),
				'view' => __( 'Ver Parceiro' ),
				'view_item' => __( 'Ver Parceiro' ),
				'search_items' => __( 'Buscar Parceiro' ),
				'not_found' => __( 'Nenhum Parceiro encontrado' ),
				'not_found_in_trash' => __( 'Nenhum Parceiro encontrado no Lixo' ),
				'parent' => __( 'Parent Parceiro' ),
				'description' => __( 'O Parceiro é quem faz o Mãezíssima possível, através de patrocínios e incentivos.' ),				
			),
			'public' => true,
			'show_ui' => true,
			'menu_position' => 20,
			'hierarchical' => true,
			'supports' => array( 'title','editor','excerpt','revisions','custom-fields','thumbnail','author','page-attributes','post-formats' ),
			
		)
	);
}  
//'trackbacks','comments','custom-fields',