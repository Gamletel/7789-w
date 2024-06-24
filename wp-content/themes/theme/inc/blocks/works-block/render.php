<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$block_subtitle = get_field('block_subtitle');
$show_all = get_field('show_all');
if ($show_all) {
    $works = get_posts([
        'post_type' => 'works',
        'numberposts' => -1
    ]);
} else {
    $works = get_field('works');
}
$archive_link = get_post_type_archive_link('works');
?>
<?php if (!empty($works)) { ?>
    <div id="works-block" class="block-margin block-padding <?= $classes; ?> <?= $align; ?>">
        <div class="container">
            <?php if ($block_title) { ?>
                <div class="block-title">
                    <h2><?= $block_title; ?></h2>

                    <?php if ($block_subtitle) { ?>
                        <div class="block__subtitle p4"><?= $block_subtitle; ?></div>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($works as $work) {
                        setup_postdata($GLOBALS['post'] = $work);
                        ?>
                        <div class="swiper-slide">
                            <?php get_template_part('templates/work-card') ?>
                        </div>
                    <?php }
                    wp_reset_postdata(); ?>
                </div>
            </div>

            <div class="swiper-additionals">
                <div class="swiper-controls">
                    <div class="swiper-btn-prev"><?= inline('assets/images/swiper-btn.svg'); ?></div>

                    <div class="swiper-pagination"></div>

                    <div class="swiper-btn-next"><?= inline('assets/images/swiper-btn.svg'); ?></div>
                </div>

                <a href="<?= $archive_link; ?>" class="btn-accent">Смотреть все</a>
            </div>
        </div>
    </div>
<?php } ?>
