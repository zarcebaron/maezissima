<?php get_header(); ?>

  <!-- START 404 CONTENT ENTRY -->
  <div id="content" class="container">

    <div id="wide-sidebar" class="row-fluid">
        <div class="span12 main-content">
	     <h1 class="title-error"><?php _e( '404' , 'color-theme-framework' ); ?></h1>
         <div class="error-disclaimer">
             <h2>Ops! Página não encontrada.</h2>
             <p>Não tem problema. Utilize a busca para encontrar o que deseja ou siga navegando pelo nosso site!</p>
         </div>
	     
	     <div class="divider-1px"></div>
	     <div class="margin-30b"></div>
	     
	    <div class="row-fluid">	     
	     <div class="span3"><div id="search-block"><?php get_search_form(); ?></div><!-- /search-block --></div><!-- span3 -->
   	     <div class="span3"><div class="tagcloud"><?php wp_tag_cloud('number=30&orderby=count'); ?></div><!-- tagcloud --></div><!-- span9 -->
				    <div class="span3">
					  <h5><?php _e('Últimos 10 Posts', 'color-theme-framework') ?></h5>
					  <ul class="archives">
					    <?php $archive_30 = get_posts('numberposts=10');
					    foreach($archive_30 as $post) : ?>
						  <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
					  	<?php endforeach; ?>
					  </ul>
					</div><!-- /span3 -->
						
				    <div class="span3">
					  <h5><?php _e('Categorias', 'color-theme-framework') ?></h5>
					  <ul class="archives">
					    <?php wp_list_categories( 'title_li=' ); ?>
					  </ul>
					</div><!-- /span3 -->
                    <?php

				
					 ?>					
   	     
    </div><!-- row-fluid -->
      </div><!-- span12 -->
    </div><!-- row-fluid -->
  </div> <!-- #content -->
  <!-- END 404 ENTRY -->

<?php get_footer(); ?>