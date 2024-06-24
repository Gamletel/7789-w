<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Theme
 */

get_header();
?>

    <main id="primary" class="archive archive-works">
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>

            <h1 class="page-title">
                Портфолио
            </h1>

            <div class="archive__wrapper block-margin">
                <?php if (have_posts()) { ?>

                    <div class="archive__holder">
                        <?php
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();
                            get_template_part('templates/work-card');

                        endwhile; ?>
                    </div>

                    <?php

                    pagination();

                } else {

                    get_template_part('template-parts/content', 'none');

                }
                ?>
            </div>
        </div>
        <div class="container-wide">
            <?php
            $archive_works_footer_form_block = theme('archive_works_footer_form_block');
            get_template_part('inc/blocks/form-block/render',
                null,
                array(
                    'block_title' => $archive_works_footer_form_block['block_title'],
                    'subtitle' => $archive_works_footer_form_block['subtitle'],
                    'image' => $archive_works_footer_form_block['image'],
                ));
            wp_enqueue_style('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.css', array(), 2);
            wp_enqueue_script('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.js', array(), 2); ?>
        </div>

    </main><!-- #main -->

<?php
// get_sidebar();
get_footer();
