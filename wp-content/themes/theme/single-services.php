<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme
 */

$title = get_the_title();
$thumbnail = get_the_post_thumbnail_url($post, 'full');
$columns = get_field('columns');

get_header();
?>

    <main id="primary" class="site-main">
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>

            <h1 class="page-title"><?= $title; ?></h1>
        </div>

        <div class="container-wide">
            <div class="container">
                <div class="single-services__info block-margin">
                    <?php if ($thumbnail) { ?>
                        <div class="single-services__thumbnail"><img src="<?= $thumbnail; ?>" alt=""></div>
                    <?php } ?>

                    <?php if (!empty($columns)) { ?>
                        <div class="single-services__columns">
                            <?php foreach ($columns as $column) {
                                $title = $column['title'];
                                $text = $column['text'];
                                $btn = $column['btn'];
                                $btn_type = $btn['type'];
                                ?>
                                <div class="column">
                                    <?php if ($title) { ?>
                                        <h3 class="column__title"><?= $title; ?></h3>
                                    <?php } ?>

                                    <?php if ($text) { ?>
                                        <div class="column__text text-block p4"><?= $text; ?></div>
                                    <?php } ?>

                                    <?php switch ($btn_type) {
                                        case 'none':
                                            break;
                                        case 'modal':
                                            $text = $btn['text'];
                                            if ($text) { ?>
                                                <div class="column__btn btn" data-modal="callback"><?= $text; ?></div>
                                            <?php }
                                            break;
                                        case 'link':
                                            $text = $btn['text'];
                                            $link = $btn['link'];
                                            if ($text && $link) { ?>
                                                <a href="<?= $link; ?>" class="column__btn btn"><?= $text; ?></a>
                                            <?php }
                                            break;
                                    } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="content">
                <?php the_content(); ?>
            </div>
        </div>
    </main><!-- #main -->

<?php
get_footer();
