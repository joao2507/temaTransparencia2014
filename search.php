<?php get_header(); ?>

        <div id="geral" class="container">
            <div class="thirteen columns">

            <div id="conteudo">
            	<div id="texto_abertura_categoria">
              
                </div>
                <div id="listagem">
					<?php if ( have_posts() ) : ?>
                                    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                                    <?php while(have_posts()): the_post(); ?>
			<article>
            	<header>
                	<h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            	</header>

            	<?php the_excerpt(); ?>

        	</article>
    	<?php endwhile; ?>

                    <?php else : ?>
                                    <div id="post-0" class="post no-results not-found">
                                        <h2 class="entry-title"><?php _e( 'Nothing Found', 'twentyten' ); ?></h2>
                                        <div class="entry-content">
                                            <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
                                            <?php get_search_form(); ?>
                                        </div><!-- .entry-content -->
                                    </div><!-- #post-0 -->
                    <?php endif; ?>
                 </div>
                
            </div>              
            </div>
<?php get_sidebar(); ?>
            <div class="clear"></div>
        </div>
<?php get_footer(); ?>