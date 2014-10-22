<?php get_header(); ?>

        <div id="geral" class="container">
            <div class="thirteen columns">

            <div id="conteudo">
            	<div id="texto_abertura_categoria">
              		<p>Neste link você poderá conferir os principais projetos já elaborados ou em execução por parte da Prefeitura de João Pessoa e que estão previstos no Plano de Metas 2013-2016.</p>
                </div>
                <div id="listagem">                               
                    <?php query_posts('posts_per_page=20&category_name=projetos-planoseprojetos'); remove_filter ('the_excerpt', 'wpautop'); ?>            
                    <?php if (have_posts()) : ?>
                    <div class="titulocategoria">.: <?php single_cat_title(); ?></div>
                    <?php while (have_posts()) : the_post(); ?>
                    <div class="titulos"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                    <time datetime="<?php the_time('Y-m-d H:i:s');  ?>">Publicado em <?php the_time('d F, Y');  ?></time>
                    <p><?php the_excerpt();  ?></p>
                    <?php endwhile; ?>
                    <?php endif; ?>                    
                 </div>
                
            </div>              
            </div>
<?php get_sidebar(); ?>
            <div class="clear"></div>
        </div>
<?php get_footer(); ?>