<?php

	if ( isset( $data['ct_theme_color'] ) ) $theme_color = stripslashes ( $data['ct_theme_color'] );
	if ( isset( $data['ct_header_background'] ) ) $top_footer_bg_color = stripslashes ( $data['ct_header_background'] );

	/* Title Color */
	if ( isset( $data['ct_word_title'] ) ) $word_title = stripslashes ( $data['ct_word_title'] );	
	
	/* Background Body */
	if ( isset( $data['ct_bg_color'] ) ) $bg_color = stripslashes ( $data['ct_bg_color'] );	

	if ( isset( $data['ct_bg_upload'] ) ) $bg_upload = stripslashes( $data['ct_bg_upload'] );
	if ( isset( $data['ct_custom_bg'] ) ) $custom_bg = stripslashes( $data['ct_custom_bg'] );	
	if ( isset( $data['ct_body_background'] ) ) $body_background = stripslashes( $data['ct_body_background'] );	

	/* Background Top Block */
	if ( isset( $data['ct_top_bg_color'] ) ) $top_bg_color = stripslashes ( $data['ct_top_bg_color'] );	
	if ( isset( $data['ct_top_bg_upload'] ) ) $top_bg_upload = stripslashes( $data['ct_top_bg_upload'] );
	if ( isset( $data['ct_top_custom_bg'] ) ) $top_custom_bg = stripslashes( $data['ct_top_custom_bg'] );	
	if ( isset( $data['ct_top_body_background'] ) ) $top_body_background = stripslashes( $data['ct_top_body_background'] );	

	/* Background Titles */
	if ( isset( $data['ct_title_bg_color'] ) ) $title_bg_color = stripslashes ( $data['ct_title_bg_color'] );	
	if ( isset( $data['ct_title_bg_upload'] ) ) $title_bg_upload = stripslashes( $data['ct_title_bg_upload'] );
	if ( isset( $data['ct_title_custom_bg'] ) ) $title_custom_bg = stripslashes( $data['ct_title_custom_bg'] );	
	if ( isset( $data['ct_title_background'] ) ) $title_background = stripslashes( $data['ct_title_background'] );	
	
?>

/* Body BG Color */
<?php 
	if ( $bg_color == 'Background Image' ) {
?>
body, .body-class {
	background: url(<?php echo $custom_bg; ?>) left top repeat;
}
<?php } else if( $bg_color == 'Color' ) { ?>
body, .body-class {
	background: none;
	background-color: <?php echo $body_background; ?>
}
<?php } else if ( $bg_color == 'Upload' ) { ?>
body, .body-class {
	background: url(<?php echo $bg_upload; ?>) left top repeat;
	background-color: <?php echo $body_background; ?>
}	
<?php } ?>

/* Top Block BG */
<?php 
	if ( $top_bg_color == 'Background Image' ) {
?>
#top-block-bg {
	background: url(<?php echo $top_custom_bg; ?>) left top repeat;
}
<?php } else if( $top_bg_color == 'Color' ) { ?>
#top-block-bg {
	background: none;
	background-color: <?php echo $top_body_background; ?>
}
<?php } else if ( $top_bg_color == 'Upload' ) { ?>
#top-block-bg {
	background: url(<?php echo $top_bg_upload; ?>) left top repeat;
	background-color: <?php echo $top_body_background; ?>
}	
<?php } ?>

/* Title BG */
<?php 
	if ( $title_bg_color == 'Background Image' ) {
?>
.widget-title {
	background: url(<?php echo $title_custom_bg; ?>) left 4px repeat-x;
}
<?php } else if( $title_bg_color == 'Color' ) { ?>
.widget-title {
	background: none;
	background-color: <?php echo $title_background; ?>
}
<?php } else if ( $title_bg_color == 'Upload' ) { ?>
.widget-title {
	background: url(<?php echo $title_bg_upload; ?>) left 4px repeat-x;
	background-color: <?php echo $title_background; ?>
}	
<?php } ?>



/* Theme Color */
li.current_page_item a, .current_page_item, li.current-menu-parent,.current-menu-parent, .current-menu-ancestor > a, li .current-menu-item,  .current-menu-item a {
	border-bottom-color: <?php echo $theme_color; ?> !important;
}


.author-profile-block {
	border-bottom: 4px solid <?php echo $theme_color; ?> !important;
}
.nav-tabs .active a, .nav-tabs .active a:hover, .nav-tabs li a:hover {
	border-bottom: 4px solid <?php echo $theme_color; ?> !important;
}
.sf-menu a:hover { border-bottom: 5px solid <?php echo $theme_color; ?>; }

.sf-menu ul li:hover { background: <?php echo $theme_color; ?>; }
.widget li.cat-item a, .left-col a, .right-col a, .tweet_text a, .copyright a:hover, .add-info a:hover, .post-title a:hover  { color: <?php echo $theme_color; ?>; }

.category-item a, .title-block .category-item a, .entry-content a, .btn-link {
	color: <?php echo $theme_color; ?>; 
}
.top-img {
	border-bottom: 4px solid <?php echo $theme_color; ?>;
}
span.page-numbers.current, .pagination a:hover, .pagination .current {
	border-bottom: 4px solid <?php echo $theme_color; ?>
}
.colored-title { color: <?php echo $word_title; ?>; }

#footer .widget .tagcloud a[class|="tag-link"]:hover, #footer #entry-post a[rel="tag"]:hover, #footer .tagcloud a[class|="tag-link"]:hover {
	border-bottom-color: <?php echo $theme_color; ?>;
}
.entry-post-category a { color: <?php echo $theme_color; ?>; }
a:hover { color: <?php echo $theme_color; ?>; } 

h2.entry-post-title a:hover { color: <?php echo $theme_color; ?>; }

.tooltip-inner { border-bottom: 2px solid <?php echo $theme_color; ?>; }
.tooltip.top .tooltip-arrow { border-top-color: <?php echo $theme_color; ?>; }

table#wp-calendar td#today { background-color: <?php echo $theme_color; ?>; }

::selection { 	background-color: <?php echo $theme_color; ?> !important; color: #fff	 }

::-moz-selection { 	background-color: <?php echo $theme_color; ?> !important; color: #FFF	 }


/* Theme Color */

.top-menu-block, #bottom-block-bg { background-color: <?php echo $top_footer_bg_color; ?> }

.triangles:after, .triangles:before, .triangles-footer:after{
    background-image: -webkit-linear-gradient(45deg, <?php echo $top_footer_bg_color; ?> 25%, transparent 25%, transparent 75%, <?php echo $top_footer_bg_color; ?> 75%, <?php echo $top_footer_bg_color; ?> ),
                      -webkit-linear-gradient(-45deg, <?php echo $top_footer_bg_color; ?> 25%, transparent 25%, transparent 75%, <?php echo $top_footer_bg_color; ?> 75%, <?php echo $top_footer_bg_color; ?> );
    background-image:    -moz-linear-gradient(45deg, <?php echo $top_footer_bg_color; ?> 25%, transparent 25%, transparent 75%, <?php echo $top_footer_bg_color; ?> 75%, <?php echo $top_footer_bg_color; ?> ),
                         -moz-linear-gradient(-45deg, <?php echo $top_footer_bg_color; ?> 25%, transparent 25%, transparent 75%, <?php echo $top_footer_bg_color; ?> 75%, <?php echo $top_footer_bg_color; ?> );
    background-image:     -ms-linear-gradient(45deg, <?php echo $top_footer_bg_color; ?> 25%, transparent 25%, transparent 75%, <?php echo $top_footer_bg_color; ?> 75%, <?php echo $top_footer_bg_color; ?> ),
                          -ms-linear-gradient(-45deg, <?php echo $top_footer_bg_color; ?> 25%, transparent 25%, transparent 75%, <?php echo $top_footer_bg_color; ?> 75%, <?php echo $top_footer_bg_color; ?> );
    background-image:      -o-linear-gradient(45deg, <?php echo $top_footer_bg_color; ?> 25%, transparent 25%, transparent 75%, <?php echo $top_footer_bg_color; ?> 75%, <?php echo $top_footer_bg_color; ?> ),
                           -o-linear-gradient(-45deg, <?php echo $top_footer_bg_color; ?> 25%, transparent 25%, transparent 75%, <?php echo $top_footer_bg_color; ?> 75%, <?php echo $top_footer_bg_color; ?> );
    background-image:         linear-gradient(45deg, <?php echo $top_footer_bg_color; ?> 25%, transparent 25%, transparent 75%, <?php echo $top_footer_bg_color; ?> 75%, <?php echo $top_footer_bg_color; ?> ),
                              linear-gradient(-45deg, <?php echo $top_footer_bg_color; ?> 25%, transparent 25%, transparent 75%, <?php echo $top_footer_bg_color; ?> 75%, <?php echo $top_footer_bg_color; ?> );
}

.triangles-footer:before, .triangles-footer:after {
    background-image: -webkit-linear-gradient(45deg, <?php echo $top_footer_bg_color; ?> 50%, transparent 50%, transparent 100%, <?php echo $top_footer_bg_color; ?> 100%, <?php echo $top_footer_bg_color; ?> ),
                      -webkit-linear-gradient(135deg, <?php echo $top_footer_bg_color; ?> 50%, transparent 50%, transparent 100%, <?php echo $top_footer_bg_color; ?> 100%, <?php echo $top_footer_bg_color; ?> );

    background-image:     -moz-linear-gradient(-45deg, <?php echo $top_footer_bg_color; ?> 50%, transparent 50%, transparent 100%, <?php echo $top_footer_bg_color; ?> 100%, <?php echo $top_footer_bg_color; ?>), 
    						-moz-linear-gradient(45deg, <?php echo $top_footer_bg_color; ?> 50%, transparent 50%, transparent 100%, <?php echo $top_footer_bg_color; ?> 100%, <?php echo $top_footer_bg_color; ?>);

    background-image:     -ms-linear-gradient(-45deg, <?php echo $top_footer_bg_color; ?> 50%, transparent 50%, transparent 100%, <?php echo $top_footer_bg_color; ?> 100%, <?php echo $top_footer_bg_color; ?>), 
    						-ms-linear-gradient(45deg, <?php echo $top_footer_bg_color; ?> 50%, transparent 50%, transparent 100%, <?php echo $top_footer_bg_color; ?> 100%, <?php echo $top_footer_bg_color; ?>);


    background-image:     -o-linear-gradient(-45deg, <?php echo $top_footer_bg_color; ?> 50%, transparent 50%, transparent 100%, <?php echo $top_footer_bg_color; ?> 100%, <?php echo $top_footer_bg_color; ?>), 
    						-o-linear-gradient(45deg, <?php echo $top_footer_bg_color; ?> 50%, transparent 50%, transparent 100%, <?php echo $top_footer_bg_color; ?> 100%, <?php echo $top_footer_bg_color; ?>);

    background-image:     linear-gradient(-45deg, <?php echo $top_footer_bg_color; ?> 50%, transparent 50%, transparent 100%, <?php echo $top_footer_bg_color; ?> 100%, <?php echo $top_footer_bg_color; ?>), 
    						linear-gradient(45deg, <?php echo $top_footer_bg_color; ?> 50%, transparent 50%, transparent 100%, <?php echo $top_footer_bg_color; ?> 100%, <?php echo $top_footer_bg_color; ?>);
}