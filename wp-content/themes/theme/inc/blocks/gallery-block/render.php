<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$images = get_field('images');
?>
<?php if (!empty($images)) { ?>
    <div id="gallery-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <div class="container">
            <?php if ($block_title) { ?>
                <h2 class="block-title"><?= $block_title; ?></h2>
            <?php } ?>
        </div>

        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($images as $image) {
                    $image_full = wp_get_attachment_image_url($image, 'full');
                    $image_wide = wp_get_attachment_image_url($image, 'wide');
                    ?>
                    <div class="swiper-slide">
                        <div class="image" data-fancybox='gallery' data-src='<?= $image_full; ?>'><img
                                    src="<?= $image_wide; ?>" alt=""></div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="container">
            <div class="swiper-additionals">
                <div class="swiper-btn-prev"><?= inline('assets/images/swiper-btn.svg'); ?></div>

                <div class="swiper-pagination"></div>

                <div class="swiper-btn-next"><?= inline('assets/images/swiper-btn.svg'); ?></div>
            </div>
        </div>
    </div>
<?php } ?>
