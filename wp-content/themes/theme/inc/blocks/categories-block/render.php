<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$categories = get_field('categories');
?>
<?php if (!empty($categories)) { ?>
    <div id="categories-block" class="block-margin block-padding <?= $classes; ?> <?= $align; ?>">
        <div class="container">
            <?php if ($block_title) { ?>
                <h2 class="block-title"><?= $block_title; ?></h2>
            <?php } ?>

            <div class="archive__holder-categories">
                <?php
                wc_get_template('loop/loop-start.php');

                foreach ($categories as $item) {
                    $category = get_term($item);

                    wc_get_template(
                        'content-product_cat.php',
                        array(
                            'category' => $category,
                        )
                    );
                }

                wc_get_template('loop/loop-end.php');
                ?>
            </div>
        </div>
    </div>
<?php } ?>
