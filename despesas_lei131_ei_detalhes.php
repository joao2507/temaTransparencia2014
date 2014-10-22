<?php /* Template Name: Despesas - Lei131 - EI - Detalhes */ ?>
<?php get_header(); ?>

        <div id="geral" class="container">
            <div class="sixteen columns">

            <div id="conteudo">
				<?php
        
                $sicoda_path = "/usr/share/sicoda/html";
                $sicoda_db = "lei131";
                $sicoda_db_table = "despesa_lei131";
        
                include("$sicoda_path/sicoda_${sicoda_db_table}_ei_detalhes.php");
        
                ?>      
            </div>
		<?php get_sidebar('horizontal') ?>              
            </div>
            <div class="clear"></div>
        </div>
<?php get_footer(); ?>
