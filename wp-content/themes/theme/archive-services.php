<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Theme
 */

$archive_services_title = theme('archive_services_title');
$archive_services_subtitle = theme('archive_services_subtitle');
$archive_services_icon = wp_get_attachment_image_url(theme('archive_services_icon'), 'full');
$archive_services_image = wp_get_attachment_image_url(theme('archive_services_image'), 'full');

$terms = get_terms([
    'taxonomy' => 'services_categories',
    'hide_empty' => false,
]);

get_header();
?>

    <main id="primary" class="archive archive-services">
        <div class="container-wide">
            <div class="archive-services__banner block-margin block-padding">
                <div class="banner__main">
                    <?php if ($archive_services_icon) { ?>
                        <div class="banner__icon"><img src="<?= $archive_services_icon; ?>" alt="" class="style-svg">
                        </div>
                    <?php } ?>

                    <div class="banner__content">
                        <div class="content-wrapper">
                            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                                <?php if (function_exists('bcn_display')) {
                                    bcn_display();
                                } ?>
                            </div>

                            <?php if ($archive_services_title) { ?>
                                <h1 class="banner__title"><?= $archive_services_title; ?></h1>
                            <?php } ?>

                            <?php if ($archive_services_subtitle) { ?>
                                <div class="banner__subtitle p2"><?= $archive_services_subtitle; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if ($archive_services_image) { ?>
                    <div class="banner__image"><img src="<?= $archive_services_image; ?>" alt=""></div>
                <?php } ?>
            </div>

            <div class="container block-margin">
                <?php if (!empty($terms)) { ?>
                    <div class="archive__terms">
                        <?php foreach ($terms as $key => $term) {
                            $index = $key+1;
                            $name = $term->name;
                            $slug = $term->slug;
                            $posts = get_posts([
                                'post_type' => 'services',
                                'numberposts' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'services_categories',
                                        'field' => 'slug',
                                        'terms' => $slug
                                    )
                                )
                            ]);
                            ?>
                            <div class="term block-padding block-margin <?php if($index%4==0 || $index%5==0 && $index != 1){ echo'term-mini'; } ?>">
                                <h2 class="term__title block-title"><?= $name; ?></h2>

                                <?php if (!empty($posts)) { ?>
                                    <div class="term__posts">
                                        <?php foreach ($posts as $item) {
                                            setup_postdata($GLOBALS['post'] = $item);
                                            get_template_part('templates/service-card');
                                        } wp_reset_postdata();?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>

            <?php
            $archive_services_form_block = theme('archive_services_form_block');
            get_template_part('inc/blocks/form-block/render',
                null,
                array(
                    'block_title' => $archive_services_form_block['block_title'],
                    'subtitle' => $archive_services_form_block['subtitle'],
                    'image' => $archive_services_form_block['image'],
                ));
            wp_enqueue_style('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.css', array(), 2);
            wp_enqueue_script('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.js', array(), 2); ?>
        </div>

    </main><!-- #main -->

<?php
// get_sidebar();
get_footer();
