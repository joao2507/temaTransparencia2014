<?php /* Template Name: Servidores - Lista */ ?>
<?php get_header(); ?>

        <div id="geral" class="container">
            <div class="thirteen columns">

            <div id="conteudo">
		<?php
        
                $sicoda_path = "/usr/share/sicoda/html";
                $sicoda_db = "servidores_lista";
                $sicoda_db_table = "servidores_lista";
        
                include("$sicoda_path/sicoda_${sicoda_db_table}.php");
        
                ?>      
            </div>              
            </div>
<?php get_sidebar(); ?>
            <div class="clear"></div>
        </div>
<?php get_footer(); ?>
