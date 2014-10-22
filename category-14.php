<?php get_header(); ?>

        <div id="geral" class="container">
            <div class="thirteen columns">

            <div id="conteudo">
            	<div id="texto_abertura_categoria">
              
                </div>
                <div id="listagem">
						<?php query_posts('posts_per_page=1&category_name=fiscal_abertura'); remove_filter ('the_excerpt', 'wpautop'); ?>
                        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                        <div class="titulocategoria">.: Educação Fiscal</div>	        
                            <h1><?php the_title(); ?></h1>
                            <p><?php the_content(); ?></p>
                            <br/>    
                        <?php endwhile; ?>
                        <?php endif; ?>                
   
                    <?php query_posts('posts_per_page=5&category_name=noti-educ-fiscal'); remove_filter ('the_excerpt', 'wpautop'); ?>            
                    <?php if (have_posts()) : ?>
                    <div class="titulocategoria">.: <?php single_cat_title(); ?></div>
                    <?php while (have_posts()) : the_post(); ?>
                    <div class="titulos"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                 </div>
                
            </div>              
            </div>
<?php get_sidebar(); ?>
            <div class="clear"></div>
        </div>
<?php get_footer(); ?>