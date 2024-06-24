<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$image = wp_get_attachment_image_url(get_field('image'), 'full');
$advantages = get_field('advantages');
$text = get_field('text');
$link_btn = get_field('link_btn');
$link_btn_text = $link_btn['text'];
$link_btn_link = $link_btn['link'];
?>
<div id="about-big-block" class="block-margin block-padding <?= $classes; ?> <?= $align; ?>">
    <div class="container">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <?php if ($image) { ?>
            <div class="block__image"><img src="<?= $image; ?>" alt=""></div>
        <?php } ?>

        <?php if (!empty($advantages) || $text) { ?>
            <div class="block__bottom">
                <?php if (!empty($advantages)) { ?>
                    <?php foreach ($advantages as $advantage) {
                        $title = $advantage['title'];
                        $subtitle = $advantage['subtitle'];
                        ?>
                        <div class="advantage">
                            <?php if ($title) { ?>
                                <div class="advantage__title p6"><?= $title; ?></div>
                            <?php } ?>

                            <?php if ($subtitle) { ?>
                                <div class="advantage__subtitle nums"><?= $subtitle; ?></div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>

                <?php if ($text) { ?>
                    <div class="block__text">
                        <div class="text-block p4"><?= $text; ?></div>

                        <?php if ($link_btn_link && $link_btn_text) { ?>
                            <a href="<?= $link_btn_link; ?>" class="block__link link">
                                <?= inline('assets/images/link.svg'); ?>

                                <span class="text">
                                    <?= $link_btn_text; ?>
                                </span>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>