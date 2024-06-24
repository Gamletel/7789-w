<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align   = (isset($block['align']) && !empty($block['align'])) ? 'align'.$block['align'] : '';

$block_title = get_field('block_title');
$advantages = get_field('advantages');
?>
<?php if (!empty($advantages)) {?>
<div id="advantages-block" class="block-margin <?=$classes;?> <?=$align;?>">
    <div class="container">
        <?php if ($block_title) {?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <div class="advantages">
            <?php foreach ($advantages as $advantage) {
                $title = $advantage['title'];
                $subtitle = $advantage['subtitle'];
                ?>
                <div class="advantage">
                    <?php if ($title) {?>
                        <div class="advantage__title p6"><?= $title; ?></div>
                    <?php } ?>
                    
                    <?php if ($subtitle) {?>
                        <div class="advantage__subtitle nums"><?= $subtitle; ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
