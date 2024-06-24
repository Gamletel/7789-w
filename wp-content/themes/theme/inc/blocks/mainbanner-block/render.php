<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align   = (isset($block['align']) && !empty($block['align'])) ? 'align'.$block['align'] : '';

$block_title = get_field('block_title');
$subtitle = get_field('subtitle');
$btn = get_field('btn');
$btn_type = $btn['type'];
$icon = wp_get_attachment_image_url(get_field('icon'), 'full');
$image = wp_get_attachment_image_url(get_field('image'), 'full');
?>
<div id="mainbanner-block" class="block-margin <?=$classes;?> <?=$align;?>">
        <div class="banner__main">
            <?php if ($icon) { ?>
                <div class="banner__icon"><img src="<?= $icon; ?>" alt="" class="style-svg">
                </div>
            <?php } ?>

            <div class="banner__content">
                <div class="content-wrapper">
                    <?php if ($block_title) { ?>
                        <h1 class="banner__title"><?= $block_title; ?></h1>
                    <?php } ?>

                    <?php if ($subtitle) { ?>
                        <div class="banner__subtitle p2"><?= $subtitle; ?></div>
                    <?php } ?>

                    <?php switch ($btn_type) {
                        case 'none':
                            break;
                        case 'modal':
                            $text = $btn['text'];
                            if ($text) { ?>
                                <div class="banner__btn btn" data-modal="callback"><?= $text; ?></div>
                            <?php }
                            break;
                        case 'link':
                            $text = $btn['text'];
                            $link = $btn['link'];
                            if ($text && $link) { ?>
                                <a href="<?= $link; ?>" class="banner__btn btn"><?= $text; ?></a>
                            <?php }
                            break;
                    } ?>
                </div>
            </div>
        </div>

        <?php if ($image) { ?>
            <div class="banner__image"><img src="<?= $image; ?>" alt=""></div>
        <?php } ?>
</div>