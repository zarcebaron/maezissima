<?php
	/* 
		Template Name: Contact Duplo
		
	 * @package WordPress 3.5
	 * @subpackage TrustMe - Responsive WordPress Blog / Magazine Theme
	 * @since TrustMe 1.0
		
	*/

get_header(); ?>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
(function ($) {
	$(function() {
	$( "#tabs" ).tabs();
	});
}(jQuery));	
</script>

  <!-- START CONTACTS CONTENT ENTRY -->
  <div id="content" class="container">

	  <!-- CONTENT + RIGHT -->
      <div id="wide-sidebar" class="row-fluid">
        <div class="span8 main-content clearfix">

		  <!--<div class="widget-title"><h3><?php //the_title(); ?></h3></div>-->
          <div class="box-title"><h1><?php the_title(); ?></h1></div>
          
          
          
          
          
          
        <div id="tabs" class="entry-content">
          <ul>
            <li><a href="#tabs-1">Contato</a></li>
            <li><a href="#tabs-2">Participar</a></li>
          </ul>
          <div id="tabs-1">
            <p>Dúvidas, sugestões, dicas e até reclamações são sempre bem-vindas. Se preferir, pode encaminhar um e- mail diretamente para <strong>contato@maezissima.com.br</strong>.</p>

<p><i>Caso deseje enviar seu depoimento, clique na aba <strong>Participar</strong> acima.</i></p>
			
           <?php echo do_shortcode('[easy_contact_forms fid=3]'); ?> 
          </div>
          
          <div id="tabs-2">

			<p>Participe da roda de conversa do Mãezíssima! Vamos mostrar o lado real dessa experiência maluca que é ter um filho. Envie para nós o seu relato!</p>

            
            <?php echo do_shortcode('[easy_contact_forms fid=5]'); ?>
          </div>
        </div>          


		
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