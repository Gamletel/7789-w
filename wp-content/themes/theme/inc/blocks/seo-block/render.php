<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$text = $args['text'] ?? get_field('text');
$image = $args['image'] ?? get_field('image');
if ($image) {
    $image_url = wp_get_attachment_image_url($image, 'wide');
}
?>
<?php if ($text) { ?>
    <div id="seo-block" class="block-margin <?= $classes; ?>">
        <div class="container">
            <div class="block__content">
                <?php if ($image) { ?>
                    <div class="block__image">
                        <img src="<?= $image_url; ?>" alt="">
                    </div>
                <?php } ?>

                <div class="block__content-wrapper">
                    <?php if ($block_title) { ?>
                        <h2 class="block-title"><?= $block_title; ?></h2>
                    <?php } ?>

                    <div class="block__text text-block p4 simple-scroll-block"><?= $text; ?></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
