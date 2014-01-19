<?php
    //If there are related posts.

    if( $query->have_posts() ) {
        echo '<div class="top-related-posts"><div>';
        //echo '<h3>você curte?</h3>'; //*** MODIFY TITLE IF YOU LIKE ***
         
        //loop through the posts and list each until done.
        while ($query->have_posts()) {
            $query->the_post();
        ?>
            <div class="relatedthumb">  
            <a  title='<?php the_title(); ?>' class="big-thumb-link" rel="external" href="<?php the_permalink()?>"><?php //the_post_thumbnail(array(90,90)); ?>  <?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
				<?php //the_title(); ?> 
                
                <p>
                    <?php if (strlen($post->post_title) > 40) {
                        echo substr(the_title($before = '', $after = '', FALSE), 0, 40) . '...'; } else {
                        the_title();
                    } ?>
                </p>
            </a>  
        </div> 
        <?php
        }
        echo '</div></div>';
    }
	wp_reset_query();                      
?> 