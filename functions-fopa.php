<?php
setlocale(LC_TIME, 'pt_BR.utf8');
date_default_timezone_set('America/Recife');
define('TEMPLATE_URL', get_bloginfo('template_url'));
define('HOME_URL', get_bloginfo('siteurl'));
define('HOME_NAME', get_bloginfo('name'));
wp_enqueue_script('jquery');


$NTO['TARGET_BLANK'] = array('target' => '_blank');

$NTO['deny'] = array(0);

remove_action('wp_head', 'wp_generator'); // Retira a informação da versão do WordPress

$role = get_role('editor');
$role->add_cap('edit_theme_options');
$role->add_cap('manage_polls');

//PERMITIR MAIS TAGS HTML NO EDITOR
function fb_change_mce_options($initArray) {
    $ext = 'pre[id|name|class|style],iframe[align|longdesc| name|width|height|frameborder|scrolling|marginheight| marginwidth|src]';

    if (isset($initArray['extended_valid_elements'])) {
        $initArray['extended_valid_elements'] .= ',' . $ext;
    } else {
        $initArray['extended_valid_elements'] = $ext;
    }

    return $initArray;
}

add_filter('tiny_mce_before_init', 'fb_change_mce_options');

function addDeny() {
    global $post, $NTO;
    $id = $post->ID;
    if ($id != null)
        $NTO['deny'][] = $id;
}

function the_metakey($key) {
    echo get_the_metakey($key);
}

function get_the_metakey($key) {
    global $post;
    return get_post_meta($post->ID, $key, true);
}

function getPhoto($id, $size) {
    $img = wp_get_attachment_image_src($id, $size);
    return parse_url($img[0], PHP_URL_PATH);
}

function geraLink($link, $label, $htmlOptions = array(), $echo = TRUE) {
    $htmlOptions = arraytostr($htmlOptions);
    $link = "<a href='{$link}'{$htmlOptions}>{$label}</a>";
    if ($echo)
        echo $link;
    else
        return $link;
}

function geraImg($src, $text, $echo = TRUE, $htmlOptions = array()) {
    $htmlOptions = arraytostr($htmlOptions);
    $img = "<img src='{$src}'{$htmlOptions} alt='{$text}' title='{$text}' />";
    if ($echo)
        echo $img;
    else
        return $img;
}

function d($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function arraytostr($array) {
    foreach ($array as $key => $value) {
        $out .= " {$key}='{$value}'";
    }
    return $out;
}

function fopa_pagination($center = FALSE) {
    if ($center)
        echo '<center>';
    if (function_exists('wp_pagenavi'))
        wp_pagenavi();
    if ($center)
        echo '</center>';
}

function fopa_human_diff() {
    return human_time_diff(get_the_time('U'), current_time('timestamp'));
}

function custom_attachment_fields_to_edit($form_fields, $post) {

    $form_fields["image_url"] = '';
    $form_fields["url"] = '';

    $form_fields["url"]["input"] = "hidden";
    $form_fields["url"]["value"] = getPhoto($post->ID, 'large');

    return $form_fields;
}

//add_filter("attachment_fields_to_edit", "custom_attachment_fields_to_edit", null, 2);

function remove_footer_admin() {
    echo 'Desenvolvido por Bossa Criativa';
}

add_filter('admin_footer_text', 'remove_footer_admin');

add_filter('wpseo_use_page_analysis', '__return_false');

function showMessage($message, $errormsg = false) {
    if ($errormsg) {
        echo '<div id="message" class="error">';
    } else {
        echo '<div id="message" class="updated fade">';
    }
    echo "<p><strong>$message</strong></p></div>";
}

// Add the posts and pages columns filter. They can both use the same function.
add_filter('manage_posts_columns', 'tcb_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'tcb_add_post_thumbnail_column', 5);

// Add the column
function tcb_add_post_thumbnail_column($cols) {
    $cols['tcb_post_thumb'] = __('Imagem');
    $cols['_hits'] = __('Visitas');
    return $cols;
}

// Hook into the posts an pages column managing. Sharing function callback again.
add_action('manage_posts_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);

// Grab featured-thumbnail size post thumbnail and display it.
function tcb_display_post_thumbnail_column($col, $id) {
    global $post;
    switch ($col) {
        case '_hits':
            the_metakey('_hits');
            break;
        case 'tcb_post_thumb':
            if ($post->post_type == 'post' || $post->post_type == 'page') {
                if (has_post_thumbnail($post->ID)) {
                    $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
                } else {
                    $attachments = get_children(array(
                        'post_parent' => $id,
                        'post_status' => 'inherit',
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'numberposts' => 1
                    ));
                    $attachment = array_shift($attachments);
                    $img = wp_get_attachment_image_src($attachment->ID, 'thumbnail');
                }
                geraImg($img[0], $attachment->post_title);
            }

            break;

        case 'custom-fields':
            break;
    }
}

function the_imagem($size, $class = '') {
    global $post;
    the_post_thumbnail($size, array('title' => $post->title, 'alt' => $post->title, 'class' => $class));
}

function has_doc() {
    global $post;
    $doc = get_post_meta($post->ID, 'doc', true);
    return (empty($doc)) ? (false) : (true);
}

function has_audio() {
    global $post;
    $audios = get_post_meta($post->ID, 'audios', true);
    if (!empty($audios))
        return true;

    $audiosLista = getAudios($post->ID);
    if (!empty($audiosLista))
        return true;
    return false;
}

function has_image() {
    global $post;
    $imagens = getImagens($post->ID);
    return (empty($imagens)) ? (false) : (true);
}

function has_video() {
    global $post;
    $videos = getVidYoutube($post->post_content);
    return (empty($videos)) ? (false) : (true);
}

function getThumbs($IdParent) {
    $attachments = get_children(array(
        'post_parent' => $IdParent,
        'post_status' => 'inherit',
        'post_type' => 'attachment',
        'post_mime_type' => 'image'
    ));

    $aux['count'] = count($attachments);

    foreach ($attachments as $id => $a) {
        $img = wp_get_attachment_image_src($id, 'full');
        if ($img[1] >= $img[2])
            $aux['horizontal'][] = $id;
        else
            $aux['vertical'][] = $id;
    }
    return $aux;
}

function getImagens($IdParent) {
    $attachments = get_children(array(
        'post_parent' => $IdParent,
        'post_status' => 'inherit',
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'orderby' => 'rand'
    ));
    $aux = array();

    foreach ($attachments as $a) {
        $aux[$a->ID]['titulo'] = $a->post_title;
        $aux[$a->ID]['id'] = $a->ID;
    }
    return $aux;
}

function getAudios($IdParent) {
    $attachments = get_children(array(
        'post_parent' => $IdParent,
        'post_status' => 'inherit',
        'post_type' => 'attachment',
        'post_mime_type' => 'audio',
        'orderby' => 'rand'
    ));
    $aux = array();

    foreach ($attachments as $a) {
        $aux[$a->ID]['url'] = $a->guid;
    }
    return $aux;
}

function getThumb($IdParent) {
    $attachments = get_children(array(
        'post_parent' => $IdParent,
        'post_status' => 'inherit',
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'numberposts' => 1
    ));

    $aux['count'] = count($attachments);

    foreach ($attachments as $id => $a) {
        $img = wp_get_attachment_image_src($id, 'thumbnail');
    }
    return $img[0];
}

function get_page_by_slug($page_slug, $output = OBJECT, $post_type = 'page') {
    global $wpdb;
    $page = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= %s AND post_status = 'publish'", $page_slug, $post_type));
    if ($page)
        return get_post($page, $output);
    return null;
}

function get_the_content_with_formatting($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

function filtro_mes_ano($url) {
    ?>
    <form action="<?= HOME_URL . '/' . $url ?>">
        Mês: 
        <select name="mes" id="mes">
            <option value="0">Escolha um mês</option>
            <?php
            $mes = (isset($_GET['mes'])) ? ($_GET['mes']) : (date('m'));
            for ($i = 1; $i <= 12; $i++) {
                $sel = ($mes == $i) ? ("selected='selected'") : ('');
                echo "<option " . $sel . " value='" . $i . "'>" . str_pad($i, 2, '0', STR_PAD_LEFT) . "</option>\n";
            }
            ?>
        </select>
        Ano:
        <select name="ano" id="ano">
            <option value="0">Escolha um ano</option>
            <?php
            $atual = date('Y');
            $ano = (isset($_GET['ano'])) ? ( $_GET['ano']) : ( $atual );
            for ($i = 2013; $i <= $atual; $i++) {
                $sel = ($ano == $i) ? ("selected='selected'") : ('');
                echo "<option " . $sel . " value='" . $i . "'>" . $i . "</option>\n";
            }
            ?>
        </select>
        <input type="submit" value="Filtrar" />

        <?php if (!empty($_GET['mes']) && !empty($_GET['ano'])): ?>
            <a href='<?= HOME_URL . '/' . $url ?>'>Limpar Filtro</a>
        <?php endif ?>
    </form>
    <?php
}

function get_mes_extenso($mes) {
    $mes2 = str_pad($mes, 2, '0', STR_PAD_LEFT);
    switch ($mes2) {
        case "01": $mes = "janeiro";
            break;
        case "02": $mes = "fevereiro";
            break;
        case "03": $mes = "março";
            break;
        case "04": $mes = "abril";
            break;
        case "05": $mes = "maio";
            break;
        case "06": $mes = "junho";
            break;
        case "07": $mes = "julho";
            break;
        case "08": $mes = "agosto";
            break;
        case "09": $mes = "setembro";
            break;
        case "10": $mes = "outubro";
            break;
        case "11": $mes = "novembro";
            break;
        case "12": $mes = "dezembro";
            break;
    }

    return $mes;
}

function posts_relacionados($count = 3) {

    global $post, $wpdb, $table_prefix;

// Processa titulo
    $words = explode(' ', $post->post_title);
    if (count($words) > 0 && $words != false):
        foreach ($words as $word) {
            if (strlen($word) > 4)
                $termos .= $word . "|";
        }
    endif;


// Processa tags
    $tags = get_the_tags($post->ID);
    if (count($tags) > 0 && $tags != false):
        foreach ($tags as $tag) {
            $termos .= $tag->name . "|";
        }
    endif;

// Processa categoria
    $cats = get_the_category($post->ID);
    if (count($cats) > 0 && $cats != false):
        foreach ($cats as $cat) {
            $cat_ids .= $cat->term_id . ",";
        }
    endif;

    $termos = substr($termos, 0, -1);
    $cat_ids = substr($cat_ids, 0, -1);

// Saída
//print "<h3>$heading</h3>";
//print "<ul>";
    $query = "
SELECT DISTINCT {$table_prefix}posts.guid,{$table_prefix}posts.post_title,{$table_prefix}posts.ID, {$table_prefix}posts.post_date
FROM {$table_prefix}posts 
INNER JOIN {$table_prefix}term_relationships ON {$table_prefix}posts.ID = {$table_prefix}term_relationships.object_id
INNER JOIN {$table_prefix}term_taxonomy ON {$table_prefix}term_relationships.term_taxonomy_id = {$table_prefix}term_taxonomy.term_taxonomy_id
INNER JOIN {$table_prefix}terms ON {$table_prefix}term_taxonomy.term_id = {$table_prefix}terms.term_id
WHERE 
MATCH({$table_prefix}posts.post_title, {$table_prefix}posts.post_content) AGAINST('{$termos}' IN BOOLEAN MODE)
AND {$table_prefix}posts.post_status = 'publish'
AND {$table_prefix}posts.post_type = 'post'
AND {$table_prefix}posts.ID <> {$post->ID}
AND {$table_prefix}terms.term_id IN (" . $cat_ids . ")
AND $wpdb->term_taxonomy.taxonomy = 'category'
ORDER BY {$table_prefix}posts.post_date DESC 
LIMIT {$count}";

    $res = $wpdb->get_results($query);
    $c = 1;
    foreach ($res as $post) {
        $last = ($c == $count) ? ('last') : ('');
        $out .= "<li class='{$last}'>";
        if (has_post_thumbnail()) {
            $out .= "
<a href='{$post->guid}'>" . get_the_post_thumbnail($post->ID, 'box-6', array('class' => 'left')) . "</a>
<span class='data'>" . strftime('%d de %B de %G - %Hh%M', strtotime($post->post_date)) . "</span>
<h4 class='titulo'><a href='{$post->guid}'>" . $post->post_title . "</a></h4><div class='clear'></div>
</li>";
        } else {
            add_filter('excerpt_length', 'excerpt_relacionadas');
            $out .= "
<span class='data'>" . strftime('%d de %B de %G - %Hh%M', strtotime($post->post_date)) . "</span>
<h4 class='titulo'><a href='{$post->guid}'>" . $post->post_title . "</a></h4>
<p>" . get_the_excerpt() . "</p>
</li>";
        }
        $c++;
    }
    return $out;
}

function excerpt_relacionadas($length) {
    return 30;
}

function get_category_thumbnail($category_id, $imagesize = 'thumbnail', $metakey) {
    //_wpfifc_taxonomy_term_8_thumbnail_id_
    if (empty($metakey)) {
        $thumbnail_id = get_option('_wpfifc_taxonomy_term_' . $category_id . '_thumbnail_id_');
    } else {
        //category_8_imagem_maior
        $thumbnail_id = get_option($metakey);
    }
    $image = wp_get_attachment_image_src($thumbnail_id, $imagesize);
    if ($image)
        return $image[0];
    return '';
}

function the_category_thumbnail($category_id, $imagesize = 'thumbnail', $htmlOptions = array(), $metakey = null) {
    $img = get_category_thumbnail($category_id, $imagesize, $metakey);
    if(!empty($img)){
        echo '<img src="' . get_category_thumbnail($category_id, $imagesize, $metakey) . '" ' . arraytostr($htmlOptions) . ' />';
    }else echo '';
}

function word_count() {
    $content = get_post_field('post_content', $post->ID);
    $word_count = str_word_count(strip_tags($content));
    return $word_count;
}

function get_the_videolink($cat = 'mais-tv'){
    global $post;
    return HOME_URL.'/categoria/'.$cat.'/#!/'.$post->ID.'-'.$post->post_name;
}

function the_videolink(){
    echo get_the_videolink();
}

function get_the_slug(){
    global $post;
    return $post->post_name;
}

function the_slug(){
    echo get_the_slug();
}
?>