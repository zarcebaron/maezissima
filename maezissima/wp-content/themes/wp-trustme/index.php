<?php get_header(); 

global $data, $page, $paged;

?>

<?php 
	$main_layout = stripslashes( $data['ct_main_layout'] );
?>


  <!-- START CONTENT ENTRY -->
  <div id="content" class="container">
  
	<!-- START TOP WIDGETS AREA -->
	<?php
	if ( is_active_sidebar('ct_magazine_top_widgets') ): ?>
	  <div class="row-fluid">
	    <div class="span12">
			<?php
			  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Top Widgets") ) : ?>
			<?php endif; ?>
	    </div> <!-- /span12 -->	
	  </div> <!-- /row-fluid -->
	<?php endif; ?>	
	<!-- END TOP WIDGETS AREA -->
	
	  
    <?php if ( $main_layout == 'c_r' ) : ?>
	  <!-- CONTENT + RIGHT -->
      <div id="wide-sidebar" class="row-fluid">
		<?php
		if ( is_active_sidebar('ct_magazine_center_widgets') ): ?>
        <div class="span8 main-content">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Center Widgets") ) : ?>
		  <?php endif; ?>
		  <div class="clear"></div>
        </div><!-- span8 -->
        <?php endif; ?>
		<?php
		if ( is_active_sidebar('ct_magazine_sidebar') ): ?>
        <div class="span4 r-sidebar right-bg">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span4 -->      
        <?php endif; ?>

      </div><!-- row-fluid -->
	  <!-- END CONTENT + RIGHT -->


    <?php elseif ( $main_layout == 'l_c' ) :	?>
	  <!-- LEFT + CONTENT -->
      <div id="wide-sidebar" class="row-fluid">
		<?php
		if ( is_active_sidebar('ct_magazine_center_widgets') ): ?>       
        <div class="span8 pull-right main-content">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Center Widgets") ) : ?>
		  <?php endif; ?>
        </div><!-- span8 -->
        <?php endif; ?>
		<?php
		if ( is_active_sidebar('ct_magazine_sidebar') ): ?>    
        <div class="span4 pull-left r-sidebar left-bg">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span4 -->
        <?php endif; ?>
      </div><!-- row-fluid -->
	  <!-- END LEFT + CONTENT -->
    <?php endif; ?>
    </div> 


  <!-- END CONTENT ENTRY -->


<?php get_footer(); ?>
