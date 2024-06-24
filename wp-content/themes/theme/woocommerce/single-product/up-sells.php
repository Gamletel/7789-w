<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if ($upsells) : ?>

    <?php get_template_part('inc/blocks/products-block/render',
        null,
        array(
            'block_title' => "Дополнительно рекомендуем",
            'products' => $upsells,
        ));
    wp_enqueue_style('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.css', array(), 2);
    wp_enqueue_script('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.js', array(), 2); ?>

<?php
endif;

wp_reset_postdata();
