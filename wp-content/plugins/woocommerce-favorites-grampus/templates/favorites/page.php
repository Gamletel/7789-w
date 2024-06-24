<?php
global $wp_query;

get_header();

$products = WCFAVORITES()->get_products();

$totalPrices = 0;
$totalOldPrices = 0;
?>
<div class="favorites-page woocommerce">
    <div class="container">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
            <?php if (function_exists('bcn_display')) {
                bcn_display();
            } ?>
        </div>
        <h1 class="page-title">
            <?php the_title(); ?>
        </h1>
        <?php if ($products) { ?>
            <div class="favorites-wrapper">
                <div class="items-wrapper">
                    <?php foreach ($products as $item) {
                        $product = wc_get_product($item);
                        $minOrder = 1;
                        if ($product->is_type('simple')) {
                            $totalPrices += $product->get_price() * $minOrder;
                        }
                        if ($product->is_type('simple')) {
                            if ($product->is_on_sale()) {
                                $totalOldPrices += $product->get_regular_price() * $minOrder;
                            } else {
                                $totalOldPrices += $product->get_price() * $minOrder;
                            }
                        }
                        ?>
                        <div
                            class="item-product <?php if ($product->is_on_sale()) { ?> on-sale<?php } else { ?> no-sale <?php } ?>">
                            <img src="<?= get_the_post_thumbnail_url($item, 'full'); ?>" alt="" class="item-image">
                            <?php
                            $in_favorites = WCFAVORITES()->check_item($product->get_id());
                            $text = get_option('favorites_single_product_text', 'В избранные');
                            ?>
                            <button type="button" data-product_id="<?= $product->get_id() ?>" class="favorites single_add_to_favorites_button ajax_add_to_favorites button alt <?php if ($in_favorites) {
                                  echo 'added';
                              } ?>" aria-label="<?= $text ?>">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.34255 7.77789C3.5687 7.23192 3.90017 6.73584 4.31804 6.31798C4.7359 5.90011 5.23198 5.56864 5.77795 5.34249C6.32392 5.11634 6.90909 4.99994 7.50004 4.99994C8.09099 4.99994 8.67616 5.11634 9.22213 5.34249C9.7681 5.56864 10.2642 5.90011 10.682 6.31798L12 7.63598L13.318 6.31798C14.162 5.47406 15.3066 4.99995 16.5 4.99995C17.6935 4.99995 18.8381 5.47406 19.682 6.31798C20.526 7.1619 21.0001 8.3065 21.0001 9.49998C21.0001 10.6935 20.526 11.8381 19.682 12.682L12 20.364L4.31804 12.682C3.90017 12.2641 3.5687 11.768 3.34255 11.2221C3.1164 10.6761 3 10.0909 3 9.49998C3 8.90902 3.1164 8.32386 3.34255 7.77789Z"
                                        fill="white" stroke="#1E293B" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </button>

                            <?php if ($product->is_type('simple')) { ?>
                                <div class="item__bottom">
                                    <a href="<?= get_permalink($item); ?>" class="item-title">
                                        <?= $product->get_title(); ?>
                                    </a>

                                    <form action="<?= get_permalink(get_the_ID()); ?>" class="cart" method="post"
                                        enctype="multipart/form-data">
                                        <?php if ($product->get_price()) {
                                            do_action('woocommerce_before_add_to_cart_quantity');

                                            // woocommerce_quantity_input(
                                            //     array(
                                            //         'min_value' => $minOrder,
                                            //         'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                                            //         'input_value' => $minOrder,
                                            //     )
                                            // );
                            
                                            do_action('woocommerce_after_add_to_cart_quantity');
                                        }
                                        ?>
                                        <a class="bodym" href="<?= get_permalink($item); ?>">Подробнее</a>
                                        <div class="btns">
                                            <span class="btn invert price">
                                                <?php
                                                global $product;

                                                $sale_p = $product->get_sale_price();
                                                $reg_p = $product->get_regular_price();

                                                if ('' === $product->get_price()) {
                                                    $price = apply_filters('woocommerce_empty_price_html', '', $this);
                                                } else if ($product->is_on_sale()) {
                                                    $price = "<span class='price__regular-crossed'>" . wc_price($reg_p) . "</span> <span class='price__sale'>" . wc_price($sale_p) . "</span>";
                                                } else {
                                                    $price = "<span class='price__regular'>" . wc_price($reg_p) . "</span>";
                                                }

                                                echo $price;
                                                ?>
                                            </span>

                                            <button type="submit" name="add-to-cart"
                                                value="<?php echo esc_attr($product->get_id()); ?>"
                                                class="btn single_add_to_cart_button ajax_add_to_cart_button button alt"
                                                data-modal="fastbuy">
                                                Купить
                                            </button>
                                        </div>

                                    </form>

                                </div>

                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <?php /* <div class="info-wrapper">
                <div class="item-info count">
                    <div class="item-title">
                        Товаров в избранном
                    </div>
                    <div class="item-value">
                        <?= WCFAVORITES()->count_items(); ?>
                    </div>
                </div>

                <div class="item-info total">
                    <div class="item-title">
                        Итого
                    </div>
                    <div class="item-value">
                        <span>
                            <?= wc_price($totalPrices); ?>
                        </span>
                    </div>
                </div>
                <!-- <form action="<?= get_permalink(get_the_ID()); ?>">
                        <button type="submit" class="clear-fav" name="clear-fav">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.75">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3846 8.71994C19.7976 8.75394 20.1056 9.11494 20.0726 9.52795C20.0666 9.59594 19.5246 16.3069 19.2126 19.1219C19.0186 20.8689 17.8646 21.9319 16.1226 21.9639C14.7896 21.9869 13.5036 21.9999 12.2466 21.9999C10.8916 21.9999 9.5706 21.9849 8.2636 21.9579C6.5916 21.9249 5.4346 20.8409 5.2456 19.1289C4.9306 16.2889 4.3916 9.59494 4.3866 9.52795C4.3526 9.11494 4.6606 8.75294 5.0736 8.71994C5.4806 8.70894 5.8486 8.99495 5.8816 9.40695C5.88479 9.45035 6.10514 12.184 6.34526 14.8887L6.39349 15.4284C6.51443 16.7728 6.63703 18.0646 6.7366 18.9639C6.8436 19.9369 7.3686 20.4389 8.2946 20.4579C10.7946 20.5109 13.3456 20.5139 16.0956 20.4639C17.0796 20.4449 17.6116 19.9529 17.7216 18.9569C18.0316 16.1629 18.5716 9.47495 18.5776 9.40695C18.6106 8.99495 18.9756 8.70694 19.3846 8.71994ZM14.3454 2.00024C15.2634 2.00024 16.0704 2.61924 16.3074 3.50624L16.5614 4.76724C16.6435 5.18062 17.0062 5.4825 17.4263 5.48913L20.708 5.48924C21.122 5.48924 21.458 5.82524 21.458 6.23924C21.458 6.65324 21.122 6.98924 20.708 6.98924L17.4556 6.98909C17.4505 6.98919 17.4455 6.98924 17.4404 6.98924L17.416 6.98824L7.04162 6.98912C7.03355 6.9892 7.02548 6.98924 7.0174 6.98924L7.002 6.98824L3.75 6.98924C3.336 6.98924 3 6.65324 3 6.23924C3 5.82524 3.336 5.48924 3.75 5.48924L7.031 5.48824L7.13202 5.48185C7.50831 5.43303 7.82104 5.14724 7.8974 4.76724L8.1404 3.55124C8.3874 2.61924 9.1944 2.00024 10.1124 2.00024H14.3454ZM14.3454 3.50024H10.1124C9.8724 3.50024 9.6614 3.66124 9.6004 3.89224L9.3674 5.06224C9.33779 5.21044 9.29467 5.35326 9.23948 5.48951H15.2186C15.1634 5.35326 15.1201 5.21044 15.0904 5.06224L14.8474 3.84624C14.7964 3.66124 14.5854 3.50024 14.3454 3.50024Z" fill="#B7BDC5"/>
                                </g>
                            </svg>
                            Очистить избранное
                        </button>
                    </form> -->
                    </div>
                    */?>
            </div>
        <?php } else { ?>
            <div class="not-founded">
                Товаров в избранном нет!
            </div>
        <?php } ?>
    </div>
</div>

<div id="go-top-btn">
    <?= inline('assets/images/sharik.svg'); ?>
</div>

<script>
    jQuery(function ($) {
        $('body').on('removed_from_favorites', function () {
            location.reload();
        });
    });
</script>
<?php
get_footer();