<?php
	global $data;
?>
<?php
	/*
	----------------------------------------------------
			Start Footer
	----------------------------------------------------				
	*/
?>
	<?php wp_head(); ?>	

	<footer id="footer" itemscope="" itemtype="http://schema.org/WPFooter">
		  

  	  <!-- START COPYRIGHT -->	
	  <div id="bottom-block-bg">
	    <div class="container">
			  <div class="row-fluid footer-info">
				  <?php
				    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) : ?>
				  <?php endif; ?>
			  </div> <!-- /row-fluid -->
			
						<div class="row-fluid margin-45t copyright-block">
						    <div class="span4">
	  					  		<div class="copyright">
								  <p><?php echo stripslashes( $data['ct_copyrights'] ); ?></p>
						  		</div> <!-- /copyright -->
						    </div><!-- span4 -->
						    <div class="span8">
  						  		<div class="add-info">
					      			<p><?php echo stripslashes( $data['ct_add_copyrights'] ); ?></p>
						  		</div> <!-- /add-info -->		    
		    				<div> <!-- /span8 -->
		    			</div> <!-- /row-fluid -->	
			    </div><!-- span8 -->
			  </div><!-- row -->
			  	
	    </div><!-- container -->
	  </div><!-- bottom-block-bg -->
	  
			  
	</footer>

<?php wp_footer(); ?>

<script type="text/javascript">
setTimeout(function(){var a=document.createElement("script");
var b=document.getElementsByTagName("script")[0];
a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0018/2229.js?"+Math.floor(new Date().getTime()/3600000);
a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
</script>

</body>

</html>


