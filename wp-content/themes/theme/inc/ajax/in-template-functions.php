<?php
add_action('wp_ajax_load_something', 'load_something');
add_action('wp_ajax_nopriv_load_something', 'load_something');

function load_something()
{
    $args = array(
        'post_type' => 'post_type',
        'posts_per_page' => -1,
    );

    $my_posts = get_posts($args);

    if (!empty($my_posts) && is_array($my_posts)) {
        foreach ($my_posts as $my_post) {
            get_template_part('/inc/ajax/something-ajax', 'item', array('item' => $my_post));
        }
    } else {
        ?>
        <?php
    }

    wp_die(); // Завершаем выполнение скрипта
}