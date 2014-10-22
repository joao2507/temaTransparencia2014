<?php /* Template Name: Despesas - Lei131 - Etidades Diretas */ ?>
<?php get_header(); ?>

        <div id="geral" class="container">
            <div class="thirteen columns">

            <div id="conteudo">
				<?php
        
                $sicoda_path = "/usr/share/sicoda/html";
                $sicoda_db = "lei131";
                $sicoda_db_table = "despesa_lei131";
        
                include("$sicoda_path/sicoda_${sicoda_db_table}_ed.php");
        
                ?>      
            </div>              
            </div>
<?php get_sidebar(); ?>
            <div class="clear"></div>
        </div>
<?php get_footer(); ?>
