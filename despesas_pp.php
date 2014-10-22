<?php get_header(); ?>

        <div id="geral" class="container">
            <div class="thirteen columns">

            <div id="conteudo">
				<?php
        
                $sicoda_path = "/usr/share/sicoda/html";
                $sicoda_db = "despesas";
        
                include("$sicoda_path/sicoda_${sicoda_db}_cp.php");
        
                ?>         
            </div>              
            </div>
<?php get_sidebar(); ?>
            <div class="clear"></div>
        </div>
<?php get_footer(); ?>