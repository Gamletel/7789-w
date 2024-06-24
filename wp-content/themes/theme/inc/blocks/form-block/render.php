<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$subtitle = $args['subtitle'] ?? get_field('subtitle');
$image = $args['image'] ?? get_field('image');
if ($image) {
    $image_url = wp_get_attachment_image_url($image, 'full');
}
?>
<div id="form-block" class="block-margin <?= $classes; ?> alignwide">
    <div class="container">
        <div class="block__content">
            <?php if ($block_title) { ?>
                <h2 class="block-title"><?= $block_title; ?></h2>
            <?php } ?>

            <?php if ($subtitle) { ?>
                <div class="block__subtitle p4"><?= $subtitle; ?></div>
            <?php } ?>

            <?php get_form('callback-block') ?>
        </div>

        <?php if ($image) { ?>
            <div class="block__image">
                <img src="<?= $image_url; ?>" alt="">
            </div>
        <?php } ?>
    </div>
</div>