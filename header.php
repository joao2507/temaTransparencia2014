<?php
?><!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6" lang="pt-br"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="pt-br"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="pt-br"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="pt-br"> <!--<![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="http://transparencia.joaopessoa.pb.gov.br/wp-content/themes/portal2013/tooltip.js"></script>
   
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' ); 
wp_head(); ?>

        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="PMJP - Setransp - DPGI">

        

        <link rel="stylesheet" media="all" href="<?php bloginfo( 'template_directory' ); ?>/stylesheets/base.css">
        <link rel="stylesheet" media="all" href="<?php bloginfo( 'template_directory' ); ?>/stylesheets/skeleton.css">
        <link rel="stylesheet" media="all" href="<?php bloginfo( 'template_directory' ); ?>/stylesheets/layout.css">

        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="<?php bloginfo( 'template_directory' ); ?>/images/favicon.png">
        <link rel="apple-touch-icon" href="<?php bloginfo( 'template_directory' ); ?>/images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo( 'template_directory' ); ?>/images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo( 'template_directory' ); ?>/images/apple-touch-icon-114x114.png">
	<?php wp_head() ?>
    </head>
    <body>
        <header id="principal">
            <div class="container">
                <div class="five columns">
                    <h1><a href="/">Portal da transparencia</a></h1>
                </div>
                <div class="three columns">
                    <span class="logo-pmjp"><a href="http://www.joaopessoa.pb.gov.br">Portal da prefeitura de joao pessoa pmjp</a></span>
                </div>
                <div class="eight columns omega">
                    <div class="banner fullbanner">
						<?php echo adrotate_group(1); ?>                   
                    </div>
                </div>
                <div class="clear"></div>
                <section id="search">
                      <form role="search" method="get" id="searchform" action="/">
                      <input type="text" class="text" id="s" name="s" size="100%" value="<?php _e("Digite aqui o que você procura em nosso portal e tecle Enter"); ?>" onfocus="if (this.value == '<?php _e("Digite aqui o que você procura em nosso portal e tecle Enter"); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Digite aqui o que você procura em nosso portal e tecle Enter"); ?>';}" />
                      </form>

                    </section>
                <div class="clear"></div>
                <div id="navbar" class="sixteen column">
                    
                    <ul id="menu-superior" class="columns alpha omega">
                        <li><a href="http://www.joaopessoa.pb.gov.br/secretarias/setransp/">A Setransp</a></li>
                        <li><a href="./?cat=47">Orçamento Municipal</a></li>
                        <li><a href="http://200.164.108.163:9673/sapl/generico/norma_juridica_pesquisar_proc?incluir=0&lst_tip_norma=1&txt_numero=&txt_ano=&lst_assunto_norma=&dt_norma=&dt_norma2=&dt_public=&dt_public2=&txt_assunto=&rd_ordenacao=1">Legislação</a></li>
			<li><a href="http://www.portalelmar.com.br/transparencia/?e=101095">Câmara Municipal</a></li>
                        <li><a href="./?page_id=595">Fale Conosco</a></li>
                    </ul>                   
                    <!--<div class="icon-twitter three"><a href="http://twitter.com/pmjpsetransp">twitter @setransp</a></div>-->
		</div>
                   <div class="clear"></div>					
			<ul id="menu-mini" class="columns alpha omega">
				<li><a href="http://transparencia.joaopessoa.pb.gov.br/sact" target="_blank">SIC</a></li>
				<li><a href="/?p=554">Perguntas Frequentes</a></li>
				<li><a href="/?p=556">Glossário</a></li>
				<li><a href="/?page_id=927">Manual de Navegação</a></li>
			</ul>
		<div class="clear"></div>
            </div>
        </header>
	<div class="clear"></div>