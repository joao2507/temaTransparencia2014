<?php get_header(); ?>

        <div id="geral" class="container">
            <div class="thirteen columns">

            <div id="conteudo">
                <div id="listagem">
                    <?php if (have_posts()) : ?>
                    <div class="titulocategoria">.: <?php single_cat_title(); ?></div>
                    <?php while (have_posts()) : the_post(); ?>
                    <div class="titulos"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                    <time datetime="<?php the_time('Y-m-d H:i:s');  ?>">Publicado em <?php the_time('d/m/Y');  ?></time>
                    <p><?php the_excerpt();  ?></p>
                    <?php endwhile; ?>
                    <?php endif; ?>
                 </div>
               
                 <div id="paginacao">
                    <?php if(function_exists('wp_paginate')) {wp_paginate();} ?>
                 </div>            
            </div>                
            </div>
<?php get_sidebar(); ?>
            <div class="clear"></div>
        </div>
<?php get_footer(); ?>