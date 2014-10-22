<?php get_header(); ?>

        <div id="geral" class="container">
            <div class="thirteen columns">

            <div id="conteudo">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="titulos">.: <?php the_title(); ?></div>	
                    <div class="descricao_texto">
                        <?php the_content('<p class="serif">' . __('Read the rest of this page &raquo;', 'kubrick') . '</p>'); ?>
                        <?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'kubrick') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                        <h7><i><?php the_date('d/m/Y');?></i></h7>
                    </div>
                    <div class="comentarios">
                        <?php comments_template(); ?>
                    </div>
                <?php endwhile; endif; ?>               
            </div>               
            </div>
<?php get_sidebar(); ?>
            <div class="clear"></div>
        </div>
<?php get_footer(); ?>