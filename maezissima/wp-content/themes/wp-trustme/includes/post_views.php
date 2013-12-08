<?php 

/**
*	This is function gets the post views and display it in admin panel.	
*/
function getPostViews( $postID ){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count. __(' views','color-theme-framework');
}
function setPostViews($postID) {
if (!current_user_can('administrator') ) :
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
endif;
}

add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);

function posts_column_views($defaults){
    $defaults['post_views'] = __( 'Views' , 'color-theme-framework' );
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
    if( $column_name === 'post_views' ) {
        echo getPostViews( get_the_ID() );
    }
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);




/*--------------------------------------------------- CUSTOM BOXES FOR POSTS ----------------------------------------------------------------------------------------------*/
// Add the Meta Box  
function add_custom_post_meta_box() {  
    add_meta_box(  
        'custom_post_meta_box', // $id  
        'Parameters for Selected Post Format', // $title  
        'show_custom_post_meta_box', // $callback  
        'post', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_custom_post_meta_box');

					
$video_type = array (
					array(
						'label' => 'Vimeo',
						'value' => 'vimeo'
					),

					array(
						'label' => 'Youtube',
						'value' => 'youtube'
					),

					array(
						'label' => 'Dailymotion',
						'value' => 'dailymotion'
					),
		
				);



$thumb_type = array (
					array(
						'label' => 'Auto',
						'value' => 'auto'
					),

					array(
						'label' => 'Featured',
						'value' => 'featured'
					),
					
					array(
						'label' => 'Player',
						'value' => 'player'
					),					
		
				);
				
$badge_type = array (
					array(
						'label' => 'None',
						'value' => 'none'
					),
					array(
						'label' => 'New',
						'value' => 'new'
					),
					array(
						'label' => 'Freebie',
						'value' => 'freebie'
					),
					array(
						'label' => 'Featured',
						'value' => 'featured'
					),
					array(
						'label' => 'Hot',
						'value' => 'hot'
					),
					array(
						'label' => 'Starred',
						'value' => 'starred'
					),
					array(
						'label' => 'Advertisement',
						'value' => 'adv'
					),
				);

$post_view_title = array (
					array(
						'label' => 'Show',
						'value' => 'show'
					),
					array(
						'label' => 'Hide',
						'value' => 'hide'
					),
				);

$post_view_date = array (
					array(
						'label' => 'Show',
						'value' => 'show'
					),
					array(
						'label' => 'Hide',
						'value' => 'hide'
					),
				);

$post_view_likeview = array (
					array(
						'label' => 'Show',
						'value' => 'show'
					),
					array(
						'label' => 'Hide',
						'value' => 'hide'
					),
				);

$post_view_category = array (
					array(
						'label' => 'Show',
						'value' => 'show'
					),
					array(
						'label' => 'Hide',
						'value' => 'hide'
					),
				);

				
		
    // Field Array  
    $prefix = 'ct';  
    $custom_post_meta_fields = array(  

         array(  
            'label'=> __( 'Video Post Format' , 'color-theme-framework' ),  
            'desc'  => __( 'Add video ID from Vimeo or Youtube. Examples: vimeo - 29017795 / youtube - WhBoR_tgXCI' , 'color-theme-framework' ),  
            'id'    => $prefix.'_mb_video_info_box',  
            'type'  => 'info-box-post-format',
        ), 
        

        array(  
            'label'=> __( 'Video Type' , 'color-theme-framework' ),  
            'desc'  => '',
            'id'    => $prefix.'_mb_post_video_type',  
            'type'  => 'select',
            'show' => 'true',
            'options' => $video_type,
        ),  
        array(  
            'label'=> __( 'Video ID' , 'color-theme-framework' ),  
            'desc'  => '',  
            'id'    => $prefix.'_mb_post_video_file',  
            'show' => 'true',
            'type'  => 'text',
        ), 
        array(  
            'label'=> __( 'Type of Video Thumb ( Auto generated from video service or use featured image ) ' , 'color-theme-framework' ),  
            'desc'  => '',  
            'id'    => $prefix.'_mb_post_video_thumb',
            'type'  => 'select',
            'show' => 'true',
            'options' => $thumb_type,
        ),        

           array(  
            'label'=> __( 'Audio Post Format' , 'color-theme-framework' ),  
            'desc'  => __( 'Paste embed code from Sound Cloud service' , 'color-theme-framework' ),  
            'id'    => $prefix.'_mb_audio_info_box',  
            'type'  => 'info-box-post-format',
        ), 
        array(  
            'label'=> __( 'Sound Cloud' , 'color-theme-framework' ),  
            'desc'  => '',  
            'id'    => $prefix.'_mb_post_soundcloud',  
            'show' => 'true',
            'type'  => 'textarea',
        ) 

        	
  );  
	
	
	
	// The Callback  
	function show_custom_post_meta_box() {  
		global $custom_post_meta_fields, $post;  
		
		
		
		// Use nonce for verification  
		echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  			
  
	    // Begin the field table and loop  
	    echo '<div id="meta-options" class="form-table clearfix" style="margin-bottom: 20px; min-height: 220px; padding-bottom:20px;">';  

	    foreach ($custom_post_meta_fields as $field) {  
	        // get value of this field if it exists for this post  
	        $meta = get_post_meta($post->ID, $field['id'], true);  

	        // begin a table row with  
	        echo ' 
                <div style="margin-left: 20px">';  
                switch($field['type']) {  
                        // text  
					    case 'text':  
					    	if ( $field['show'] == 'false' ) echo '<div class="hidden-field">'; 
					    	if ( $field['show'] == 'true' ) echo '<div class="showed-field">'; 
					    
							echo '<span class="description">'.$field['label'].'</span>';					    
					        echo '<input type="text"  name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" class="custom-text" />'; 
					    echo '</div>';				              
					    break;  
	
					    // textarea  
					    case 'textarea':  
				            echo '<span class="description">'.$field['label'].'</span>';  
					        echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>'; 

					    break;  

					    // info box  
					    case 'info-box': 	
					    	echo '<div class="clear"></div>'; 					    	
					        echo '<div class="info_box"><h4 style="margin-top:0; padding-top:0; margin-bottom: 10px; padding-bottom: 0">'.$field['label'].'</h4>'.$field['desc'].'</div>';  
					    	echo '<div class="clear"></div>'; 					    						        
					    break;  

					    // info box post format  
					    case 'info-box-post-format': 	
					    	echo '<div class="clear"></div>'; 					    	
					        echo '<div class="info_box infobox_post_format"><h4 style="margin-top:0; padding-top:0; margin-bottom: 10px; padding-bottom: 0">'.$field['label'].'</h4>'.$field['desc'].'</div>';  
					    	echo '<div class="clear"></div>'; 					    						        
					    break;  


					    // checkbox  
					    case 'checkbox':  					    
						    echo '<div class="clear"></div>'; 
					        echo '<div class="check-hide"><input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/> 
				            <label for="'.$field['id'].'">'.$field['label'].'</label></div>'; 
				            echo '<div style="margin-bottom: 30px"></div>';
					    break;  
	
					    // select  
					    case 'select':
					    	if ( $field['show'] == 'false' ) echo '<div class="hidden-field">'; 
					    	if ( $field['show'] == 'true' ) echo '<div class="showed-field">'; 
					    						    	
					    	echo '<span class="description">'.$field['label'].'</span>';  
					        echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';  

					        foreach ($field['options'] as $option) {  
					            echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
				        }  
					    echo '</select>';  
					    echo '</div>';
					    break;  	
					    
					   
					    
					    case 'additional':
					    	echo '<div class="clear"></div>';
					    	echo '<div style="border-top: 1px dashed #ccc;border-bottom: 1px dashed #ccc; padding: 15px 0; margin-bottom: 15px; height:40px; width:90%"><span class="description">' . $field['label'] . ' </span></div>';
					    break;
	
                } //end switch  
    		    echo '</div>';  
    		} // end foreach  
    		
    echo '</div>'; // end table
    echo '<input id="original_publish" type="hidden" value="Save" name="original_publish">';
	echo '<input id="publish" class="button-save" type="submit" value="Save" accesskey="p" tabindex="5" name="save">';  

    echo '<div class="clear"></div>';
}  



function save_custom_post_meta($post_id) {  
    
    global $custom_post_meta_fields;  
  
    // verify nonce  
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))  
        return $post_id;  
    
    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    
    // check permissions  

    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
  


    // loop through fields and save the data  
    foreach ($custom_post_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
    
	    if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
    
    
   /*   	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) )
			delete_post_meta($post_id, $key); 
		
		update_post_meta($post_id, $key, $value); 
		
		
	} */
	return $post_id;

}  
add_action('save_post', 'save_custom_post_meta'); 

// Better has an underscore as last sign
$prefix = 'ct_';

global $meta_boxes;



// 2nd meta box
$meta_boxes[] = array(
	'title' => 'Settings for Post as Review',
	'id' => 'color_id',
	'fields' => array(
		// SELECT BOX
		array(
			'name'     => 'Type of Post?',
			'id'       => "{$prefix}post_type",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'standard_post' => 'Standard Post',
				'review_post' => 'Review Post',
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
		),

		// COLOR
		array(
			'name' => 'Choose color for Stars',
			'id'   => "{$prefix}stars_color",
			'std' => "#dd0c0c",
			'type' => 'color',
		),	
		
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Overall Score Name',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}over_name",
			// Field description (optional)
			'desc'  => 'Enter name for Overall Score',
			'type'  => 'text',
			// Default value (optional)
			'std'   => 'Overall Score',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
		),	

		// SELECT BOX
		array(
			'name'     => 'Overall Score ( Choose a number between 0.5 to 5 )',
			'id'       => "{$prefix}over_score",
			'type'     => 'select',
			'options'  => array(
				'0' => '0',
				'0.5' => '0.5',
				'1' => '1',				
				'1.5' => '1.5',				
				'2' => '2',				
				'2.5' => '2.5',
				'3' => '3',
				'3.5' => '3.5',
				'4' => '4',												
				'4.5' => '4.5',								
				'5' => '5',								
			),
			'multiple' => false,
		),

/*
// CRITERIA 1	
*/
		array(
			'name'  => 'Criteria #1 Name',
			'id'    => "{$prefix}criteria1_name",
			'desc'  => 'Enter name for Criteria #1',
			'type'  => 'text',
			'std'   => 'Criteria #1',
			'clone' => false,
		),	

		array(
			'name'     => 'Criteria #1 Score',
			'id'       => "{$prefix}criteria1_score",
			'type'     => 'select',
			'options'  => array(
				'0' => '0',
				'0.5' => '0.5',
				'1' => '1',				
				'1.5' => '1.5',				
				'2' => '2',				
				'2.5' => '2.5',
				'3' => '3',
				'3.5' => '3.5',
				'4' => '4',												
				'4.5' => '4.5',								
				'5' => '5',								
			),
			'multiple' => false,
		),

/*
// CRITERIA 2	
*/
		array(
			'name'  => 'Criteria #2 Name',
			'id'    => "{$prefix}criteria2_name",
			'desc'  => 'Enter name for Criteria #2',
			'type'  => 'text',
			'std'   => 'Criteria #2',
			'clone' => false,
		),	

		array(
			'name'     => 'Criteria #2 Score',
			'id'       => "{$prefix}criteria2_score",
			'type'     => 'select',
			'options'  => array(
				'0' => '0',
				'0.5' => '0.5',
				'1' => '1',				
				'1.5' => '1.5',				
				'2' => '2',				
				'2.5' => '2.5',
				'3' => '3',
				'3.5' => '3.5',
				'4' => '4',												
				'4.5' => '4.5',								
				'5' => '5',								
			),
			'multiple' => false,
		),

/*
// CRITERIA 3	
*/
		array(
			'name'  => 'Criteria #3 Name',
			'id'    => "{$prefix}criteria3_name",
			'desc'  => 'Enter name for Criteria #3',
			'type'  => 'text',
			'std'   => 'Criteria #3',
			'clone' => false,
		),	

		array(
			'name'     => 'Criteria #3 Score',
			'id'       => "{$prefix}criteria3_score",
			'type'     => 'select',
			'options'  => array(
				'0' => '0',
				'0.5' => '0.5',
				'1' => '1',				
				'1.5' => '1.5',				
				'2' => '2',				
				'2.5' => '2.5',
				'3' => '3',
				'3.5' => '3.5',
				'4' => '4',												
				'4.5' => '4.5',								
				'5' => '5',								
			),
			'multiple' => false,
		),

/*
// CRITERIA 4	
*/
		array(
			'name'  => 'Criteria #4 Name',
			'id'    => "{$prefix}criteria4_name",
			'desc'  => 'Enter name for Criteria #4',
			'type'  => 'text',
			'std'   => 'Criteria #4',
			'clone' => false,
		),	

		array(
			'name'     => 'Criteria #4 Score',
			'id'       => "{$prefix}criteria4_score",
			'type'     => 'select',
			'options'  => array(
				'0' => '0',
				'0.5' => '0.5',
				'1' => '1',				
				'1.5' => '1.5',				
				'2' => '2',				
				'2.5' => '2.5',
				'3' => '3',
				'3.5' => '3.5',
				'4' => '4',												
				'4.5' => '4.5',								
				'5' => '5',								
			),
			'multiple' => false,
		),
/*
// CRITERIA 5	
*/
		array(
			'name'  => 'Criteria #5 Name',
			'id'    => "{$prefix}criteria5_name",
			'desc'  => 'Enter name for Criteria #5',
			'type'  => 'text',
			'std'   => 'Criteria #5',
			'clone' => false,
		),	

		array(
			'name'     => 'Criteria #5 Score',
			'id'       => "{$prefix}criteria5_score",
			'type'     => 'select',
			'options'  => array(
				'0' => '0',
				'0.5' => '0.5',
				'1' => '1',				
				'1.5' => '1.5',				
				'2' => '2',				
				'2.5' => '2.5',
				'3' => '3',
				'3.5' => '3.5',
				'4' => '4',												
				'4.5' => '4.5',								
				'5' => '5',								
			),
			'multiple' => false,
		),

		// TEXTAREA
		array(
			'name' => 'Summary',
			'desc' => 'Enter your text',
			'id'   => "{$prefix}summary",
			'type' => 'textarea',
			'cols' => '20',
			'rows' => '3',
		),
			
	)
);


// 2nd meta box
$meta_boxes[] = array(
	'title' => 'Post Format: Gallery',

	'fields' => array(
		// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
		array(
			'name'             => 'Add Images for Gallery',
			'id'               => "{$prefix}plupload",
			'type'             => 'thickbox_image',
			/*'max_file_uploads' => 20,*/
		),

		
	)
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function ct_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'ct_register_meta_boxes' );