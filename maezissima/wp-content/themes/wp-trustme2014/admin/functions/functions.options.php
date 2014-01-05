<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		
		$shortname = "ct";
		
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
		    }

		$categories_tmp = array_unshift($of_categories, "all categories");    


		
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);

		
		$favico_urls = get_template_directory_uri().'/img';

		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/img/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/img/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
//		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
//		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 



/*
======================================================================================= 
*/

// Type of Logo ( image or text )
$ct_logotype = array ( "image" , "text" );

$comments_type = array(
    "facebook" => "Facebook",
    "disqus" => "Disqus",
);

$blog_show_meta = array(
    "date" => "Date",
    "author" => "Author"
);

$post_content_excerpt = array ( "Content" , "Excerpt" );
$post_video_thumb = array ( "featured", "player" );

$ct_show_hide = array( "Show" , "Hide" );
$ct_yes_no = array( "Yes" , "No" );

$theme_bg_color = array ( "Background Image" , "Color", "Upload" );
$theme_bg_attachment = array ( "Scroll" , "Fixed" );
$show_top_banner = array ( "Upload" , "Code", "None" );

$single_navigation = array ( "Top" , "After Content" , "Bottom" );

$footer_columns = array ( "1 Column" , "2 Columns" , "3 Columns" , "4 Columns"  );

$ct_blog_types = array ( "Chessboard" , "Left Media" , "Full Media" );
/*
=======================================================================================
*/		
/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

$prefix = 'ct_';

// Set the Options Array
global $of_options;
$of_options = array();


/*
=====================================================================================================================
					GENERAL SETTINGS
=====================================================================================================================	
*/

$of_options[] = array( "name" => __( "General Settings" , "color-theme-framework" ),
					"type" => "heading");

$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( "name" => "Select a layout",
					"desc" => "Select main content and sidebar alignment.",
					"id" =>  $shortname . "_main_layout",
					"std" => "c_r",
					"type" => "images",
					"options" => array(
						'c_r' => $url . '2cr.png',  // content + right
						'l_c' => $url . '2cl.png'  // left + content
						)
					);

$of_options[] = array( "name" => __( "Number of Columns in Footer" , "color-theme-framework" ),
					"desc" => __( "Select number of footer columns" , "color-theme-framework" ),
					"id" => $shortname . "_footer_columns",
					"std" => "4 Columns",
					"type" => "select",
					"options" => $footer_columns);
				
$of_options[] = array( "name" => __("Type of Logo","color-theme-framework"),
					   "desc" => __("Select your logo type ( Image or Text )" , "color-theme-framework"),
					   "id" => $shortname . "_type_logo",
					   "std" => "image",
					   "type" => "select",
					   "options" => $ct_logotype); 

									
$of_options[] = array( "name" => __( "Logo Upload" , "color-theme-framework" ),
					"desc" => __( "Upload images using the native media uploader, or define the URL directly" , "color-theme-framework" ),
					"id" => $shortname . "_logo_upload",
					"std" => get_template_directory_uri() . "/img/logo.png",
					"type" => "upload");

$of_options[] = array( "name" => __( "Logo Text" , "color-theme-framework" ),
					"desc" => __( "Enter text for logo" , "color-theme-framework" ),
					"id" => $shortname . "_logo_text",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __( "Logo Slogan" , "color-theme-framework" ),
					"desc" => __( "Enter text for logo slogan" , "color-theme-framework" ),
					"id" => $shortname . "_logo_slogan",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __( "Custom Favicon" , "color-theme-framework" ),
					"desc" => __( "Upload a 16px x 16px Png/Gif image that will represent your website's favicon." , "color-theme-framework" ),
					"id" => $shortname . "_custom_favicon",
					"std" => $favico_urls . "/favicon.ico",
					"type" => "upload"); 

$of_options[] = array( "name" => __( "Tracking Code" , "color-theme-framework" ),
					"desc" => __( "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme." , "color-theme-framework" ),
					"id" => $shortname . "_google_analytics",
					"std" => "",
					"type" => "textarea");        


$of_options[] = array( "name" => __( "Google Fonts Link Stylesheet" , "color-theme-framework" ),
					"desc" => __( "Paste code for stylesheet from Google Fonts" , "color-theme-framework" ),
					"id" => $shortname . "_google_stylesheet",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => __( "Google Fonts Family" , "color-theme-framework" ),
					"desc" => __( "Paste code for Fonts from Google" , "color-theme-framework" ),
					"id" => $shortname . "_google_fontfamily",
					"std" => "",
					"type" => "text");



/*
=====================================================================================================================
					STYLING OPTIONS
=====================================================================================================================	
*/
					
$of_options[] = array( "name" => "Styling Options",
					"type" => "heading");

$of_options[] = array( "name" =>  __( "Scheme Color" , "color-theme-framework"),
					"desc" => __("Pick a color scheme (default: #7d9dab)" , "color-theme-framework"),
					"id" => $shortname . "_theme_color",
					"std" => "#7d9dab",
					"type" => "color");
					

$of_options[] = array( "name" =>  __( "Color For The First Word in Title" , "color-theme-framework"),
					"desc" => __("Pick a color (default: #98ab41)" , "color-theme-framework"),
					"id" => $shortname . "_word_title",
					"std" => "#98ab41",
					"type" => "color");


$of_options[] = array( "name" =>  __( "Top Menu background & Footer background color" , "color-theme-framework" ),
					"desc" => __( "Pick a background color (default: #2D2D2D)." , "color-theme-framework" ), 
					"id" => $shortname . "_header_background",
					"std" => "#2D2D2D",
					"type" => "color");

$of_options[] = array( "name" => __( "Use Background Image / BG Color / Upload Your Image (Body)" , "color-theme-framework" ),
					"desc" => __( "Select the type of usage background for Body" , "color-theme-framework" ),
					"id" => $shortname . "_bg_color",
					"std" => 'Background Image',
					"type" => "select",
					"options" => $theme_bg_color);

$of_options[] = array( "name" =>  __( "Body Background Color" , "color-theme-framework" ),
					"desc" => __( "Pick a background color (default: #f7ede4)." , "color-theme-framework" ), 
					"id" => $shortname . "_body_background",
					"std" => "#f7ede4",
					"type" => "color");

$of_options[] = array( "name" => __( "Image Upload For background" , "color-theme-framework" ),
					"desc" => __( "Upload images for background using the native media uploader, or define the URL directly" , "color-theme-framework" ),
					"id" => $shortname . "_bg_upload",
					"std" => $bg_images_url . "bg01.jpg",
					"type" => "upload");


$of_options[] = array( "name" => __( "Background Images" , "color-theme-framework" ),
					"desc" => __( "Select a background pattern." , "color-theme-framework" ),
					"id" => $shortname . "_custom_bg",
					"std" => $bg_images_url."bg38.jpg",
					"type" => "tiles",
					"options" => $bg_images,
					);		


$of_options[] = array( "name" => __( "Use Background Image / BG Color / Upload Your Image for Top Block (Header)" , "color-theme-framework" ),
					"desc" => __( "Select the type of usage background for Header" , "color-theme-framework" ),
					"id" => $shortname . "_top_bg_color",
					"std" => 'Background Image',
					"type" => "select",
					"options" => $theme_bg_color);

$of_options[] = array( "name" =>  __( "Top Block Background Color" , "color-theme-framework" ),
					"desc" => __( "Pick a background color (default: #2D2D2D)." , "color-theme-framework" ), 
					"id" => $shortname . "_top_body_background",
					"std" => "#2D2D2D",
					"type" => "color");

$of_options[] = array( "name" => __( "Image Upload For Top Block Background" , "color-theme-framework" ),
					"desc" => __( "Upload images for background using the native media uploader, or define the URL directly" , "color-theme-framework" ),
					"id" => $shortname . "_top_bg_upload",
					"std" => $bg_images_url . "bg01.jpg",
					"type" => "upload");


$of_options[] = array( "name" => __( "Background Images for Top Block" , "color-theme-framework" ),
					"desc" => __( "Select a background pattern for Top Block." , "color-theme-framework" ),
					"id" => $shortname . "_top_custom_bg",
					"std" => $bg_images_url."bg38.jpg",
					"type" => "tiles",
					"options" => $bg_images,
					);		


/*
=====================================================================================================================
					Title Options
=====================================================================================================================	
*/

$of_options[] = array( "name" => __( "Widget Title Options" , "color-theme-framework" ),
					"type" => "heading");

$of_options[] = array( "name" => __( "Use Background Image / BG Color / Upload Your Image for Widget Titles" , "color-theme-framework" ),
					"desc" => __( "Select the type of usage background for Widget Titles" , "color-theme-framework" ),
					"id" => $shortname . "_title_bg_color",
					"std" => 'Background Image',
					"type" => "select",
					"options" => $theme_bg_color);

$of_options[] = array( "name" =>  __( "Widget Title Background Color" , "color-theme-framework" ),
					"desc" => __( "Pick a background color (default: #FFFFFF)." , "color-theme-framework" ), 
					"id" => $shortname . "_title_background",
					"std" => "#FFFFFF",
					"type" => "color");

$of_options[] = array( "name" => __( "Image Upload For Widget Title" , "color-theme-framework" ),
					"desc" => __( "Upload images for background using the native media uploader, or define the URL directly" , "color-theme-framework" ),
					"id" => $shortname . "_title_bg_upload",
					"std" => "",
					"type" => "upload");


$of_options[] = array( "name" => __( "Background Images for Top Block" , "color-theme-framework" ),
					"desc" => __( "Select a background pattern for Top Block." , "color-theme-framework" ),
					"id" => $shortname . "_title_custom_bg",
					"std" => $bg_images_url."widget-title.png",
					"type" => "tiles",
					"options" => $bg_images,
					);		

/*
=====================================================================================================================
					Blog Options
=====================================================================================================================	
*/


$of_options[] = array( "name" => __( "Blog and Pages Options" , "color-theme-framework" ),
					"type" => "heading");

$of_options[] = array( "name" => __( "Select a Blog type" , "color-theme-framework" ),
					"desc" => __( "You can choose from three types of blog" , "color-theme-framework" ),
					"id" => $shortname . "_blog_type",
					"std" => 'Chessboard',
					"type" => "select",
					"options" => $ct_blog_types);


$of_options[] = array( "name" => __( "Select a layout for Single post template" , "color-theme-framework" ),
					"desc" => "Select single post content and sidebars alignment.",
					"id" =>  $shortname . "_single_layout",
					"std" => "c_r",
					"type" => "images",
					"options" => array(
						'c_r' => $url . '2cr.png',  // content + right
						'l_c' => $url . '2cl.png'  // left + content
						)
					);
					
$of_options[] = array( "name" => __( "Select a layout for Blog template" , "color-theme-framework" ),
					"desc" => "Select blog content and sidebars alignment.",
					"id" =>  $shortname . "_blog_layout",
					"std" => "c_r",
					"type" => "images",
					"options" => array(
						'c_r' => $url . '2cr.png',  // content + right
						'l_c' => $url . '2cl.png'  // left + content
						)
					);					

$of_options[] = array( "name" => __( "Select a layout for Category/Search/Tag/Author/Archive templates" , "color-theme-framework" ),
					"desc" => "Select content and sidebars alignment.",
					"id" =>  $shortname . "_category_layout",
					"std" => "c_r",
					"type" => "images",
					"options" => array(
						'c_r' => $url . '2cr.png',  // content + right
						'l_c' => $url . '2cl.png'  // left + content
						)
					);

$of_options[] = array( "name" => __( "Select a type for Category/Search/Tag/Author/Archive and other templates" , "color-theme-framework" ),
					"desc" => __( "You can choose type for category/search/tag/author/archive pages " , "color-theme-framework" ),
					"id" => $shortname . "_category_type",
					"std" => 'Chessboard',
					"type" => "select",
					"options" => $ct_blog_types);
					

$of_options[] = array( "name" => __("Position for Single Post Navigation","color-theme-framework"),
					   "desc" => __("Select your position" , "color-theme-framework"),
					   "id" => $shortname . "_single_nav",
					   "std" => "Bottom",
					   "type" => "select",
					   "options" => $single_navigation); 


$of_options[] = array( 
    				"name" => __( "Show/Hide blog and category meta" , "color-theme-framework" ),
   					"desc" => "",
    				"id" => $shortname . "_blog_show_meta",
    				"std" => array("date","author"),
    				"type" => "multicheck",
    				"options" => $blog_show_meta);

$of_options[] = array( "name" => __( "Thumb type for video posts" , "color-theme-framework" ),
					"desc" => __( "Select a thumb type for video posts" , "color-theme-framework" ),
					"id" => $shortname . "_video_thumb_type",
					"std" => "player",
					"type" => "select",
					"options" => $post_video_thumb
					);

$of_options[] = array( "name" => __( "Use Excerpt or Content Function?" , "color-theme-framework" ),
					"desc" => __( "Select a Excerpt (automatically) or Content (More tag)" , "color-theme-framework" ),
					"id" => $shortname . "_excerpt_function",
					"std" => "Excerpt",
					"type" => "select",
					"options" => $post_content_excerpt
					);

$of_options[] = array( "name" => __( "Featured image" , "color-theme-framework" ),
					"desc" => __( "Show or Hide featured image in the single post" , "color-theme-framework" ),
					"id" => $shortname . "_featured_image_post",
					"std" => 'Show',
					"type" => "select",
					"options" => $ct_show_hide);

$of_options[] = array( 
    				"name" => __( "Choose the comments type" , "color-theme-framework" ),
   					"desc" => "",
    				"id" => $shortname . "_comments_type",
    				"std" => array("facebook","disqus"),
    				"type" => "multicheck",
    				"options" => $comments_type);

$of_options[] = array( "name" =>  __( "Facebook App ID" , "color-theme-framework"),
					"desc" => __("Enter the Facebook App ID of your app (required if Facebook comments type selected)" , "color-theme-framework"),
					"id" => $shortname . "_facebook_appid",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" =>  __( "Disqus shortname " , "color-theme-framework"),
					"desc" => __("Enter the your website's shortname (required if Disqus comments type selected)" , "color-theme-framework"),
					"id" => $shortname . "_disqus_shortname",
					"std" => "",
					"type" => "text");



/*
=====================================================================================================================
					Ads &Banner Settings
=====================================================================================================================	
*/
$of_options[] = array( "name" => __( "Ads Banner Settings" , "color-theme-framework" ),
					"type" => "heading");

$of_options[] = array( "name" => __( "Show banner: " , "color-theme-framework" ),
					"desc" => __( "Show or hide banner" , "color-theme-framework" ),
					"id" => $shortname . "_top_banner",
					"std" => 'Code',
					"type" => "select",
					"options" => $show_top_banner);

$of_options[] = array( "name" => __( "Site Header Banner Upload" , "color-theme-framework" ),
					"desc" => __( "Upload images using the native media uploader, or define the URL directly" , "color-theme-framework" ),
					"id" => $shortname . "_banner_upload",
					"std" => get_template_directory_uri() . "/img/banner.png",
					"type" => "upload");

$of_options[] = array( "name" => __( "Site Header Banner URL" , "color-theme-framework" ),
					"desc" => __( "Enter clickthrough url for banner in top section" , "color-theme-framework" ),
					"id" => $shortname . "_banner_link",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __( "Site Header Ads\Banner Code" , "color-theme-framework" ),
					"desc" => __( "Paste your Google Adsense (or other) code here." , "color-theme-framework" ),
					"id" => $shortname . "_banner_code",
					"std" => "<a href=\"https://www.tweaky.com/?invite=1f3fafd2e6a448c9\"><img src=\"https://d1zu5lttu3m0bt.cloudfront.net/assets/af_img/lb_01-99ca231cc21e111add6e18edb6062fb7.gif\"></img></a>",
					"type" => "textarea");


					
					
/*
=====================================================================================================================
					Social Settings
=====================================================================================================================	
*/

$of_options[] = array( "name" => __( "Social Services Settings" , "color-theme-framework" ),
					"type" => "heading");

$of_options[] = array( "name" => __( "Facebook" , "color-theme-framework" ),
					"desc" => __( "Enter url for facebook in top section" , "color-theme-framework" ),
					"id" => $shortname . "_facebook_link",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( "name" => __( "Twitter" , "color-theme-framework" ),
					"desc" => __( "Enter url for twitter in top section" , "color-theme-framework" ),
					"id" => $shortname . "_twitter_link",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __( "Skype" , "color-theme-framework" ),
					"desc" => __( "Enter url for skype in top section" , "color-theme-framework" ),
					"id" => $shortname . "_skype_link",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __( "Google" , "color-theme-framework" ),
					"desc" => __( "Enter url for google in top section" , "color-theme-framework" ),
					"id" => $shortname . "_google_link",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __( "Subscribe via RSS" , "color-theme-framework" ),
					"desc" => __( "Enter url for RSS in top section" , "color-theme-framework" ),
					"id" => $shortname . "_rss_link",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __( "Subscribe via Email" , "color-theme-framework" ),
					"desc" => __( "Enter url for email subscribe in top section" , "color-theme-framework" ),
					"id" => $shortname . "_email_link",
					"std" => "",
					"type" => "text");
					
/*
=====================================================================================================================
					Twitter Settings
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Twitter Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array( "name"		=> "OAuth Settings",
					"desc"			=> "",
					"id"			=> "introduction_oauth_settings",
					"std"			=> "<h3 style=\"margin: 0;\">OAuth Settings</h3> Visit <a target=\"_target\" href=\"https://dev.twitter.com/apps/\" title=\"Twitter\" rel=\"nofollow\">this link</a> in a new tab, sign in with your account, click on \"Create a new application\" and create your own keys in case you don't have already.",
					"icon"			=> true,
					"type"			=> "info"
				);

$of_options[] = array(	"name"		=> __( "Consumer Key:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Consumer Key" , "color-theme-framework" ),
						"id"		=> "{$prefix}consumer_key",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Consumer Secret:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Consumer Key" , "color-theme-framework" ),
						"id"		=> "{$prefix}consumer_secret",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Access Token:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Consumer Key" , "color-theme-framework" ),
						"id"		=> "{$prefix}user_token",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Access Token Secret:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Consumer Key" , "color-theme-framework" ),
						"id"		=> "{$prefix}user_secret",
						"std"		=> "",
						"type"		=> "text"
				);


/*
=====================================================================================================================
					Copyrights
=====================================================================================================================	
*/
$of_options[] = array( "name" => __( "Copyrights" , "color-theme-framework" ),
					"type" => "heading");

$of_options[] = array( "name" => __( "Google Maps for Contacts Page Template" , "color-theme-framework" ), 
                    "desc" => __( "Paste Google Maps Code" , "color-theme-framework" ), 
                    "id" => $shortname . "_google_maps",
                    "std" => '',
                    "type" => "textarea");

$of_options[] = array( "name" => __( "Copyrights for Footer" , "color-theme-framework" ), 
                    "desc" => __( "Enter your copyrights" , "color-theme-framework" ), 
                    "id" => $shortname . "_copyrights",
                    "std" => '&copy Copyright 2013. Powered by  <a href="http://wordpress.org/">WordPress</a><br />
<a href="https://github.com/sy4mil/Options-Framework">Slightly Modified Options Framework</a> by <a href="http://themeforest.net/user/SyamilMJ">Syamil MJ</a>',
                    "type" => "textarea");

$of_options[] = array( "name" => __( "Additional info for Footer" , "color-theme-framework" ), 
                    "desc" => __( "Additional info (text or banner)" , "color-theme-framework" ), 
                    "id" => $shortname . "_add_copyrights",
                    "std" => '<a href="http://themeforest.net/user/ZERGE?ref=zerge">TrustMe</a> Theme by <a href="http://color-theme.com/">Color Theme</a>',
                    "type" => "textarea");
                    

					
// Backup Options
$of_options[] = array( "name" => __( "Backup Options" , "color-theme-framework" ),
					"type" => "heading");
					
$of_options[] = array( "name" => __( "Backup and Restore Options" , "color-theme-framework" ),
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => __( "Transfer Theme Options Data" , "color-theme-framework" ),
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);
					
	}
}
?>
