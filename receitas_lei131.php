<?php /* Template Name: Receitas - Lei131 */ ?>
<?php get_header(); ?>

        <div id="geral" class="container">
            <div class="thirteen columns">

            <div id="conteudo">
				<?php
        
                $sicoda_path = "/usr/share/sicoda/html";
                $sicoda_db = "lei131";
                $sicoda_db_table = "receita_lei131";
        
                include("$sicoda_path/sicoda_${sicoda_db_table}.php");
        
                ?>            
            </div>              
            </div>
<?php get_sidebar(); ?>
            <div class="clear"></div>
        </div>
<?php get_footer(); ?>
