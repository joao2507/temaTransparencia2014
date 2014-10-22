<?php /* Template Name: SECOM  */ ?>
<?php get_header(); ?>

        <div id="geral" class="container">
            <div class="sixteen columns">

            <div id="conteudo">
				<?php
        
                $sicoda_path = "/usr/share/sicoda/html";
                $sicoda_db = "secom";
                $sicoda_db_table = "secom";
        
                include("$sicoda_path/sicoda_${sicoda_db_table}.php");
        
                ?>      
            </div>              
		<?php get_sidebar('horizontal') ?>
            </div>
            <div class="clear"></div>
        </div>
<?php get_footer(); ?>
