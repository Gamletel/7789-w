<?php
require_once ('woocommerce/hooks.php');

// ================= ACTIONS ====================

add_action( 'pre_get_posts', 'works_per_page' );
function works_per_page( $works ){
    if( !is_admin() && $works->is_main_query() && $works->is_post_type_archive('works')){
        $works->set( 'posts_per_page', 6 );
        $works->set( 'posts_per_archive_page', 6 );
    }
}

// ================= ACTIONS FUNCSTIONS ====================


/*
  PAGINATION
*/
function pagination()
{
    global $wp_query;

    $prev = __('<svg width="31" height="14" viewBox="0 0 31 14" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.58084 13.3331C5.78273 13.5733 6.09369 13.5517 6.27539 13.2848C6.45709 13.018 6.44073 12.607 6.23883 12.3669L2.27342 7.65L30.0082 7.65C30.2798 7.65 30.5 7.35898 30.5 7C30.5 6.64102 30.2798 6.35 30.0082 6.35L2.27342 6.35L6.23883 1.63315C6.44073 1.393 6.45709 0.98201 6.27539 0.715179C6.09369 0.448347 5.78273 0.426717 5.58084 0.666865L0.662804 6.51686C0.559175 6.64013 0.5 6.81573 0.5 7C0.5 7.18427 0.559175 7.35987 0.662804 7.48314L5.58084 13.3331Z" fill="#93ACD9" />
</svg>');
    $next = __('<svg width="31" height="14" viewBox="0 0 31 14" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M25.4192 0.666864C25.2173 0.426716 24.9063 0.448347 24.7246 0.715178C24.5429 0.98201 24.5593 1.393 24.7612 1.63315L28.7266 6.35H0.991803C0.720188 6.35 0.5 6.64102 0.5 7C0.5 7.35898 0.720187 7.65 0.991803 7.65H28.7266L24.7612 12.3669C24.5593 12.607 24.5429 13.018 24.7246 13.2848C24.9063 13.5517 25.2173 13.5733 25.4192 13.3331L30.3372 7.48314C30.4408 7.35987 30.5 7.18427 30.5 7C30.5 6.81573 30.4408 6.64013 30.3372 6.51686L25.4192 0.666864Z" fill="white" />
</svg>');

    $args = array(
        'total' => $wp_query->max_num_pages,
        'current' => max(1, get_query_var('paged')),
        'prev_text' => $prev,
        'next_text' => $next,
        'type' => 'array',
        'end_size' => 1,
        'mid_size' => 1,
    );

    $pag = paginate_links($args);

    if (isset($pag)) {
        if (get_query_var('paged') == 0) {
            array_unshift($pag, '<span class="prev page-numbers disabled">' . $prev . '</span>');
        }
        if ($wp_query->max_num_pages == get_query_var('paged')) {
            array_push($pag, '<span class="next page-numbers disabled">' . $next . '</span>');
        }
        $pag = preg_replace('~/page/1/?([\'"])~', '/"', $pag);

        echo '<div class="nav-links">' . implode("", $pag) . '</div>';
    }
}

// ================= ФИЛЬТРЫ ====================


add_filter('excerpt_more', function($more) {
    return '...';
});
add_filter( 'excerpt_length', function(){
    return 25;
} );


// ================ FUNCSTIONS ===============

/*------- ПОЛУЧЕНИЕ ФОРМЫ ----------*/

function get_form($formname = '', $params = []) {
	$echo = true;
	
	if(array_key_exists('echo', $params)) {
		$echo = $params['echo'];
	}
	
	if(!$formname) {
		if($echo === true) {
			echo 'Форма не найдена!';
			return;
		}else{
			return false;
		}
	}
	
	if($echo) {
		get_template_part('inc/parts/forms/form', $formname, $params);
	}else{
		ob_start();
		get_template_part('inc/parts/forms/form', $formname, $params);
		$out = ob_get_clean();
		return $out;
	}
}


/*-------- ПЕРЕВОД ПОЛЕЙ ---------*/

if( function_exists('GSE') ) {
    GSE()::add_translation('subject','Тема письма');
    GSE()::add_translation('your-name','Имя');
    GSE()::add_translation('your-tel','Телефон');
    GSE()::add_translation('quiz-data','Результаты квиза');
}




// ============== ADD THEME PAGE ===============

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'        => 'Параметры темы',
        'menu_title'        => 'Параметры темы',
        'menu_slug'         => 'gs-theme-params',
        'capability'        => 'manage_options',
        'parent_slug'       => 'themes.php',
        'icon_url'          => 'dashicons-location-alt',
        'redirect'          => false,
        'autoload'          => true,
        'update_button'     => 'Обновить',
        'updated_message'   => 'Параметры темы обновлены',
    ));
}


function theme($type)
{
    $setting = get_field($type,'options');
    if($setting)
    {
        return $setting;
    }
    else
    {
        return '';
    }
}




// =========== РЕГИСТРАЦИЯ БЛОКОВ ===============


add_filter('block_categories_all', 'add_blocks_category', 10 );

function add_blocks_category($categories)
{

    $categories[] = array(
        'slug'  => 'theme-blocks',
        'title' => 'Блоки темы',
        'icon'  => null,
    );

    return $categories;
}

function add_blocks()
{
    $ignore = array('.','..');
    $bpath = __DIR__.'/blocks/';
    $blocks = scandir($bpath);

    foreach ($blocks as $folder)
    {
        if(!in_array($folder, $ignore))
        {
            if(file_exists($bpath.$folder.'/index.php'))
            {
                    // $this->blocks[$folder] = require_once $bpath.$folder.'/index.php';
                require_once $bpath.$folder.'/index.php';

            }
        }
    }
}
add_blocks();

function wide_Setup() {
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'wide_Setup' );
