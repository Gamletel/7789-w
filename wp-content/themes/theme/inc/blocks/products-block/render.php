<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$products = $args['products'] ?? get_field('products');
if (!is_product()) {
    $archive_link = "/shop";
}
?>
<?php if (!empty($products)) { ?>
    <div id="products-block" class="block-margin block-padding <?= $classes; ?> <?= $align; ?>">
        <div class="container">
            <?php if ($block_title) { ?>
                <h2 class="block-title"><?= $block_title; ?></h2>
            <?php } ?>

            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($products as $item) { ?>
                        <div class="swiper-slide">
                            <?php $product = wc_get_product($item);

                            $post_object = get_post($product->get_id());

                            setup_postdata($GLOBALS['post'] =& $post_object);

                            wc_get_template_part('content', 'product'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="swiper-additionals">
                <div class="swiper-controls">
                    <div class="swiper-btn-prev"><?= inline('assets/images/swiper-btn.svg'); ?></div>

                    <div class="swiper-pagination"></div>

                    <div class="swiper-btn-next"><?= inline('assets/images/swiper-btn.svg'); ?></div>
                </div>

                <?php if (!is_product()) { ?>
                    <a href="/shop" class="btn-accent">Перейти в каталог</a>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
