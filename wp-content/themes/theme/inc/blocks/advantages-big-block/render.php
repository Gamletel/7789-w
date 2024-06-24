<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$advantages_style = $args['advantages_style'] ?? get_field('advantages_style');
$advantages = $args['advantages'] ?? get_field('advantages');
?>
<?php if (!empty($advantages)) { ?>
    <div id="advantages-big-block" class="block-margin block-padding <?= $classes; ?> <?= $align; ?>">
        <div class="container">
            <?php if ($block_title) { ?>
                <h2 class="block-title"><?= $block_title; ?></h2>
            <?php } ?>

            <div class="advantages">
                <?php foreach ($advantages as $advantage) {
                    $icon = wp_get_attachment_image_url($advantage['icon'], 'wide');
                    $title = $advantage['title'];
                    $subtitle = $advantage['subtitle'];
                    ?>
                    <div class="advantage advantage-<?= $advantages_style; ?>">
                        <div class="advantage__head">
                            <?php if ($icon) { ?>
                                <div class="advantage__icon">
                                    <img src="<?= $icon; ?>" alt="" class="style-svg">
                                </div>
                            <?php } ?>

                            <?php if ($title) { ?>
                                <div class="advantage__title p1"><?= $title; ?></div>
                            <?php } ?>
                        </div>

                        <?php if ($subtitle) { ?>
                            <div class="advantage__subtitle p4"><?= $subtitle; ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
