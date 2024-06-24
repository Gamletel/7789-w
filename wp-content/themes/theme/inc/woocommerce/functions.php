<?php

class WooThemeFunctions
{
    /*
     * WC GLOBAL
     */
    function change_existing_currency_symbol($currency_symbol, $currency)
    {
        switch ($currency) {
            case 'RUB':
                $currency_symbol = 'руб';
                break;
        }
        return $currency_symbol;
    }

    public function error_fade_out()
    {
        // если находимся не на странице оформления заказа, то ничего не делаем
        if (!is_checkout()) {
            return;
        }

        wc_enqueue_js("
		$( document.body ).on( 'checkout_error', function(){
			setTimeout( function(){
				$('.woocommerce-error').fadeOut( 300 );
			}, 2000);
		})
	");
    }

    public function wc_refresh_mini_cart_count($fragments)
    {
        ob_start();
        $products_count = WC()->cart->get_cart_contents_count();
        if ($products_count > 99) {
            $products_count = '99+';
        }
        ?>
        <div id="cart-count">
            <?php echo $products_count; ?>
        </div>
        <?php
        $fragments['#cart-count'] = ob_get_clean();
        return $fragments;
    }

    public function woo_custom_cart_button_text()
    {
        return __('В корзину', 'woocommerce');
    }

    function custom_sale_price($price, $product)
    {
        if ($product->is_type('variable')) {
            $price = '';
            return $price = '
<div class="product-price">
    <div class="price">
        <div class="regular-price main-price">
        от ' . wc_price($product->get_price()) . '
        </div>
    </div>
</div>';
        }
        if ($product->is_on_sale()) {
            $sale_price = $product->get_sale_price();
            $regular_price = $product->get_regular_price();
            return '
<div class="product-price">
    <div class="price">
        <div class="regular-price additional-price">' . wc_price($regular_price) . '</div>
        
        <div class="sale-price main-price">' . wc_price($sale_price) . '</div>
    </div>
</div>';
        } else {
            $regular_price = $product->get_regular_price();
            if ($regular_price > 0) {
                return '
<div class="product-price">
    <div class="price">
        <div class="regular-price main-price">' . wc_price($regular_price) . '</div>
    </div>
</div>';
            } else {
                return '
<div class="product-price">
    <div class="price">
        <div class="regular-price main-price">по запросу</div>
    </div>
</div>';
            }
        }
    }


    function custom_variable_product_price($price, $product)
    {
        $prices = $product->get_variation_prices('min', true);
        $maxprices = $product->get_variation_price('max', true);
        $min_price = current($prices['price']);
        //$max_price = current( $maxprices['price'] );
        $minPrice = sprintf(__('От %1$s <br>', 'woocommerce'), wc_price($min_price));
        $maxPrice = sprintf(__('до %1$s', 'woocommerce'), wc_price($maxprices));
        return $minPrice . ' ' . $maxPrice;
    }

    public function custom_breadcrumbs()
    {
        ?>
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>
        </div>
    <?php }

    public function register_my_widgets()
    {
        register_sidebar(
            array(
                'name' => 'Фильтр товаров',
                'id' => "sidebar-shop",
                'description' => '',
                'class' => '',
                'before_sidebar' => '',
                'after_sidebar' => '',
            )
        );
    }

    /*
     * CATEGORY-CARD
     */

    public function remove_count()
    {
        $html = '';
        return $html;
    }

    public function category_image_wrapper($category)
    {
        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
        $image = wp_get_attachment_image_src($thumbnail_id, 'full');
        $image = $image[0];
        $image = str_replace(' ', '%20', $image);
        ?>
        <div class="image-wrapper">
            <img src="<?= esc_url($image); ?>" alt="">
        </div>
        <?php
    }

    public function open_category_content_wrapper()
    {
        ?>
        <div class="product-category__content">
    <?php }

    public function close_category_content_wrapper()
    {
        ?>
        </div>
    <?php }

    public function category_content($category)
    {
        $changed_title = get_field('changed_title', $category);
        $args = array(
            'hierarchical' => 1,
            'show_option_none' => '',
            'hide_empty' => 0,
            'parent' => $category->term_id,
            'taxonomy' => 'product_cat'
        );
        $terms = get_categories($args);
        ?>
        <div class="product-category__title">
            <?php if ($changed_title) { ?>
                <h2 class="woocommerce-loop-category__title"><?= $changed_title; ?></h2>
            <?php } else { ?>
                <?php woocommerce_template_loop_category_title($category); ?>
            <?php } ?>
        </div>

        <div class="product-category__bottom">
            <div class="links">
                <?php if (!empty($terms) && count($terms) <= 3) { ?>
                    <?php foreach ($terms as $item) {
                        $term = get_term($item);
                        ?>
                        <a href="<?= get_term_link($term); ?>" class="link white">
                            <?= inline('assets/images/link.svg'); ?>

                            <span class="text"><?= $term->name; ?></span>
                        </a>
                    <?php } ?>
                <?php } else {
                    ?>
                    <a href="<?= get_term_link($category->term_id); ?>" class="link white">
                        <?= inline('assets/images/link.svg'); ?>

                        <span class="text">Подробнее</span>
                    </a>
                    <?php
                } ?>
            </div>

            <?php $this->category_image_wrapper($category); ?>
        </div>
        <?php
    }

    public function custom_category_top_part($category)
    {
        $shortDescription = get_field('s-description', $category);
        ?>
        <div class="category-top">
            <h4 class="woocommerce-loop-category__title">
                <?php
                echo esc_html($category->name);
                if ($category->count > 0) {
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo apply_filters('woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html($category->count) . ')</mark>', $category);
                }
                ?>
            </h4>

            <div class="btn-main disabled-color">
                Подробнее
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L16 12L9 19" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>
            <?php
            if ($shortDescription) { ?>
                <div class="short-descr">
                    <?php echo $shortDescription; ?>
                </div>
                <?php
            } ?>
        </div>
        <?php
    }

    /*
     * ARCHIVE-PRODUCT
     */

    public function open_archive_products_bottom_part()
    {
        ?>
        <div class="archive__bottom-part">
        <?php
    }

    public function close_archive_products_bottom_part()
    {
        ?>
        </div>
        <?php
    }

    public function custom_woocommerce_result_count($str, $total, $per_page, $current_page)
    {
        // Пример изменения текста
        $new_str = sprintf('Всего позиций: %d', $total);
        return $new_str;
    }

    public function pp_custom_scripts_enqueue()
    {

        $theme = wp_get_theme(); // Get the current theme version numbers for bumping scripts to load

        // Make sure jQuery is being enqueued, otherwise you will need to do this.

        // Register custom scripts
        wp_register_script('woocommerce_load_more', get_theme_file_uri() . '/assets/js/loadmore-products.js', array('jquery'), $theme['Version'], true); // Register script with depenancies and version in the footer

        // Enqueue scripts
        wp_enqueue_script('woocommerce_load_more');


        global $wp_query; // Make sure important query information is available

        // Use wp_localize_script to output some variables in the html of each WordPress page
        // These variables/parameters are accessible to the load_more.js file we enqueued above
        $localize_var_args = array(
            'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
            'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
            'max_page' => $wp_query->max_num_pages,
            'ajaxurl' => admin_url('admin-ajax.php')

        );
        wp_localize_script('woocommerce_load_more', 'wp_js_vars', $localize_var_args);

    }

    public function pp_loadmore_ajax_handler()
    {

        // prepare our arguments for the query
        $args = json_decode(stripslashes($_POST['query']), true);
        $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
        $args['post_status'] = 'publish';


        query_posts($args);

        if (have_posts()) :

            // run the loop
            while (have_posts()): the_post();

                wc_get_template_part('content', 'product');  // As we are loaded Woocommerce products we use wc_get_template_part
                //echo '<p>'.get_the_title().'</p>'; // for the test purposes comment the line above and uncomment the below one

            endwhile;

        endif;
        die; // Exit the script, wp_reset_query() required!

    }

    public function pp_woocommerce_products_load_more()
    {
        global $wp_query;

        if ($wp_query->max_num_pages > 1) {
            echo '<div id="pp_loadmore_products" class="btn-mini transparent" style="margin: 40px auto 0px;">Показать еще</div>';
        }

    }

    public function products_per_page($cols)
    {
        return 6;
    }

    function wp_kama_woocommerce_show_page_title_filter($title)
    {

        if (is_product_category() || is_product_taxonomy()) {
            return false;
        } else {
            return true;
        }
    }

    public function archive_category_banner()
    {
        if (is_product_taxonomy()) {
            $query_id = get_queried_object_id();
            $term = get_term($query_id);
            $term_id = $term->term_id;
            $title = $term->name;
            $banner_description = get_field('banner_description', $term);
            $thumbnail_id = get_term_meta($term_id, 'thumbnail_id', true);
            $image_url = wp_get_attachment_url($thumbnail_id);

            $subcategories = get_terms(array(
                'hide_empty' => false,
                'taxonomy' => 'product_cat',
                'parent' => $query_id,
            ));
            ?>
            <div class="header__main-banner">
                <h1 class="main-banner__title page-title">
                    <?= $title; ?>
                </h1>

                <div class="main-banner__content block-padding">
                    <?php if ($banner_description) { ?>
                        <div class="main-banner__description text-block p4">
                            <?= $banner_description; ?>
                        </div>
                    <?php } ?>

                    <?php if ($image_url) { ?>
                        <div class="main-banner__image">
                            <img src="<?= $image_url; ?>" alt="">
                        </div>
                    <?php } ?>
                </div>
            </div>


            <?php if (!empty($subcategories)) { ?>
                <div class="header__subcategories">
                    <?php foreach ($subcategories as $item) {
                        $link = get_term_link($item);
                        $name = $item->name;
                        $thumbnail_id = get_term_meta($item->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_url($thumbnail_id);
                        ?>
                        <a href="<?= $link; ?>" class="subcategory">
                            <div class="subcategory__head">
                                <?php if ($image) { ?>
                                    <div class="subcategory__thumbnail">
                                        <img src="<?= $image; ?>" alt="" class="style-svg">
                                    </div>
                                <?php } ?>

                                <div class="subcategory__arrow">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M15.4998 1.125C15.4998 0.95924 15.434 0.800269 15.3168 0.683058C15.1995 0.565848 15.0406 0.5 14.8748 0.5H7.37481C7.20905 0.5 7.05008 0.565848 6.93287 0.683058C6.81566 0.800269 6.74981 0.95924 6.74981 1.125C6.74981 1.29076 6.81566 1.44973 6.93287 1.56694C7.05008 1.68415 7.20905 1.75 7.37481 1.75H13.3661L0.682313 14.4325C0.624203 14.4906 0.578108 14.5596 0.546659 14.6355C0.51521 14.7114 0.499023 14.7928 0.499023 14.875C0.499023 14.9572 0.51521 15.0386 0.546659 15.1145C0.578108 15.1904 0.624203 15.2594 0.682313 15.3175C0.740423 15.3756 0.809409 15.4217 0.885334 15.4532C0.961258 15.4846 1.04263 15.5008 1.12481 15.5008C1.20699 15.5008 1.28837 15.4846 1.36429 15.4532C1.44022 15.4217 1.5092 15.3756 1.56731 15.3175L14.2498 2.63375V8.625C14.2498 8.79076 14.3157 8.94973 14.4329 9.06694C14.5501 9.18415 14.7091 9.25 14.8748 9.25C15.0406 9.25 15.1995 9.18415 15.3168 9.06694C15.434 8.94973 15.4998 8.79076 15.4998 8.625V1.125Z"
                                              fill="#93ACD9"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="subcategory__name p5">
                                <?php echo $name; ?>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php
        }
    }

    public function archive_categories()
    {
        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'parent' => 0
        ]);
        ?>
        <?php if (!is_product_taxonomy()) { ?>
        <?php if (!empty($categories) && is_array($categories)) { ?>
            <div class="archive__categories block-margin">
                <?php foreach ($categories as $item) {
                    get_template_part('templates/product-cat', null, array('item' => $item));
                } ?>
            </div>
        <?php } ?>
    <?php }
    }

    public function archive_subcategories()
    {
        if (!is_shop()) {
            $query_id = get_queried_object_id();
            $term = get_term($query_id);
            $terms = get_terms(array(
                'taxonomy' => 'product_cat',
                'parent' => $query_id,
                'hide_empty' => false,
            ));

            get_template_part('inc/blocks/categories-block/render',
                null,
                array('terms' => $terms,
                ));
            wp_enqueue_style('categories-block', get_template_directory_uri() . '/inc/blocks/categories-block/block.css', array(), 2);
            wp_enqueue_script('categories-block', get_template_directory_uri() . '/inc/blocks/categories-block/block.js', array(), 2);
        }
    }

    public function archive_products_title()
    {
        echo '<div class="container">
                <h1 class="page-title">
                    Каталог
                </h1>
              </div>';
    }

    public function archive_products_advantages()
    {
        $archive_products_advantages = theme('archive_products_advantages');
        if (is_product_category()) {
            ?>
            <div class="container">
                <?php get_template_part('inc/blocks/advantages-v2-block/render',
                    null,
                    array('advantages' => $archive_products_advantages['advantages'],
                        'image_1' => $archive_products_advantages['image_1'],
                        'image_2' => $archive_products_advantages['image_2'],
                    ));
                wp_enqueue_style('advantages-v2-block', get_template_directory_uri() . '/inc/blocks/advantages-v2-block/block.css', array(), 2);
                wp_enqueue_script('advantages-v2-block', get_template_directory_uri() . '/inc/blocks/advantages-v2-block/block.js', array(), 2);
                ?>
            </div>
            <?php
        }
    }

    public function archive_products_additional_blocks()
    {

        $footer_advantages_block = theme('archive_products_footer_advantages_block');
        $footer_form_block = theme('archive_products_footer_form_block');
        if (is_product_category()) {
            $query_id = get_queried_object();
            $footer_seo_block = get_field('seo-block', $query_id);
        }
        if (is_shop() || is_product_category()) {

            ?>

            <div class="catalog__additional-blocks">
            <?php
            if (is_product_category()) {
                get_template_part('inc/blocks/advantages-big-block/render',
                    null,
                    array(
                        'block_title' => $footer_advantages_block['block_title'],
                        'advantages_style' => $footer_advantages_block['advantages_style'],
                        'advantages' => $footer_advantages_block['advantages'],
                    ));
                wp_enqueue_style('advantages-big-block', get_template_directory_uri() . '/inc/blocks/advantages-big-block/block.css', array(), 2);
                wp_enqueue_script('advantages-big-block', get_template_directory_uri() . '/inc/blocks/advantages-big-block/block.js', array(), 2);
            }

            get_template_part('inc/blocks/form-block/render',
                null,
                array(
                    'block_title' => $footer_form_block['block_title'],
                    'subtitle' => $footer_form_block['subtitle'],
                    'image' => $footer_form_block['image'],
                ));
            wp_enqueue_style('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.css', array(), 2);
            wp_enqueue_script('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.js', array(), 2);

            if (is_product_category()) {
                get_template_part('inc/blocks/seo-block/render',
                    null,
                    array(
                        'block_title' => $footer_seo_block['block_title'],
                        'text' => $footer_seo_block['text'],
                        'image' => $footer_seo_block['image'],
                    ));
                wp_enqueue_style('seo-block', get_template_directory_uri() . '/inc/blocks/seo-block/block.css', array(), 2);
                wp_enqueue_script('seo-block', get_template_directory_uri() . '/inc/blocks/seo-block/block.js', array(), 2);
            }
        }
        ?>
        </div>
        <?php
    }

    /*
     * PRODUCT-CARD
     */
    public function open_product_card_top_part()
    { ?>
        <div class="product-card__top">
    <?php }

    public function product_card_tags()
    {
        global $product;
        $terms = get_terms([
            'taxonomy' => 'product_tag',
            'include' => $product->get_tag_ids()
        ]);
        ?>
        <?php if ($terms) { ?>
        <div class="product-card__tags tags">
            <?php foreach ($terms as $term) {
                $name = $term->name;
                ?>
                <div class="tag"><?= $name; ?></div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php }

    public function close_product_card_top_part()
    { ?>
        </div>
    <?php }

    public function product_card_top_part()
    {
        global $product;
        $thumbnail = woocommerce_get_product_thumbnail('full');
        ?>
        <div class="product-card__top">
            <div class="product-card__thumbnail">
                <?= $thumbnail; ?>
            </div>
        </div>
        <?php
    }

    public function product_card_bottom_part()
    {
        global $product;
        ?>
        <div class="product-card__bottom">
            <?php woocommerce_template_loop_product_title(); ?>

            <div class="product-card__price">
                <div class="price__title p6">Стоимость</div>
                <?= $product->get_price_html(); ?>

                <div class="price__bottom">
                    <div class="btn" data-modal="callback">Оставить заявку</div>
                </div>
            </div>
        </div>
    <?php }

    function wp_kama_woocommerce_product_add_to_cart_text_filter($__, $that)
    {
        global $product;

        if ($product->is_type('simple')) {
            $that = 'В корзину';
        } else {
            $that = 'Перейти';
        }
        return $that;
    }

    /*
     * PRODUCT-PAGE
     */
    public function show_custom_title()
    {
        global $product;
        echo '<h1 class="single-product__title">' . get_the_title($product->get_id()) . '</h1>';
    }

    public function show_nutritional_value()
    {
        global $product;
        $nutritional_value = get_field('nutritional_value', $product->get_id());

        if (!empty($nutritional_value) ?? is_array($nutritional_value)) {
            ?>
            <div class="single-product__nutritional_values">
                <h5 class="nutritional_values__title">Пищевая ценность на 100г продукта:</h5>

                <div class="nutritional_values__wrapper">
                    <?php foreach ($nutritional_value as $item) {
                        $name = $item['name'];
                        $value = $item['value'];
                        ?>
                        <div class="item">
                            <?php if ($name) { ?>
                                <div class="item__name p3"><?= $name; ?></div>
                            <?php } ?>

                            <?php if ($value) { ?>
                                <div class="item__value"><?= $value; ?></div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
    }

    public function show_short_description()
    {
        global $product;
        $short_description = get_field('short_description');
        $description_columns = get_field('description_columns');
        ?>
        <?php if ($short_description) { ?>
        <div class="single-product__short-description">
            <div class="text-block p4">
                <?= $short_description; ?>
            </div>

            <?php if (!empty($description_columns)) { ?>
                <div class="readmore-btn" data-tab="description">Читать далее</div>
            <?php } ?>
        </div>
    <?php }
    }

    public function show_mini_attributes()
    {
        global $product;
        $mini_attributes = get_field('mini_attributes');
        ?>
        <?php if (!empty($mini_attributes)) { ?>
        <div class="single-product__mini-attributes">
            <h4 class="mini-attributes__title p3">Основные характеристики:</h4>

            <div class="mini-attributes__wrapper">
                <?php foreach ($mini_attributes as $item) {
                    $name = $item['name'];
                    $value = $item['value'];
                    ?>
                    <div class="attribute">
                        <?php if ($name) { ?>
                            <div class="attribute__name p4"><?= $name; ?></div>
                        <?php } ?>

                        <?php if ($value) { ?>
                            <div class="attribute__value p4"><?= $value; ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>

            <div class="mini-attributes__readmore readmore-btn" data-tab="attributes">Все характеристики</div>
        </div>
    <?php }
    }

    public function custom_product_swiper()
    {
        global $product;

        $thumbnail = woocommerce_get_product_thumbnail('full');
        $thumbnail_wide = woocommerce_get_product_thumbnail('wide');
        $gallery = $product->get_gallery_image_ids();
        ?>

        <div class="single-product__gallery">
            <div class="swiper main-swiper">
                <div class="swiper-wrapper">
                    <?php if ($thumbnail) { ?>
                        <div class="swiper-slide">
                            <div class="image" data-fancybox='gallery-product-thumbnail' data-src='<?= $thumbnail; ?>'>
                                <?= $thumbnail_wide; ?>

                                <div class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_115_1759)">
                                            <path d="M16.25 8.125C16.25 9.91797 15.668 11.5742 14.6875 12.918L19.6328 17.8672C20.1211 18.3555 20.1211 19.1484 19.6328 19.6367C19.1445 20.125 18.3516 20.125 17.8633 19.6367L12.918 14.6875C11.5742 15.6719 9.91797 16.25 8.125 16.25C3.63672 16.25 0 12.6133 0 8.125C0 3.63672 3.63672 0 8.125 0C12.6133 0 16.25 3.63672 16.25 8.125ZM8.125 13.75C8.86369 13.75 9.59514 13.6045 10.2776 13.3218C10.9601 13.0391 11.5801 12.6248 12.1025 12.1025C12.6248 11.5801 13.0391 10.9601 13.3218 10.2776C13.6045 9.59514 13.75 8.86369 13.75 8.125C13.75 7.38631 13.6045 6.65486 13.3218 5.97241C13.0391 5.28995 12.6248 4.66985 12.1025 4.14752C11.5801 3.62519 10.9601 3.21086 10.2776 2.92818C9.59514 2.64549 8.86369 2.5 8.125 2.5C7.38631 2.5 6.65486 2.64549 5.97241 2.92818C5.28995 3.21086 4.66985 3.62519 4.14752 4.14752C3.62519 4.66985 3.21086 5.28995 2.92818 5.97241C2.64549 6.65486 2.5 7.38631 2.5 8.125C2.5 8.86369 2.64549 9.59514 2.92818 10.2776C3.21086 10.9601 3.62519 11.5801 4.14752 12.1025C4.66985 12.6248 5.28995 13.0391 5.97241 13.3218C6.65486 13.6045 7.38631 13.75 8.125 13.75Z"
                                                  fill="#979CA4"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_115_1759">
                                                <rect width="20" height="20" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!empty($gallery)) { ?>
                        <?php foreach ($gallery as $image) {
                            $image_full = wp_get_attachment_image_url($image, 'full');
                            $image_wide = wp_get_attachment_image_url($image, 'wide');
                            ?>
                            <div class="swiper-slide">
                                <div class="image" data-fancybox='gallery-product-thumbnail'
                                     data-src='<?= $image_full; ?>'>
                                    <img src="<?= $image_wide; ?>" alt="">

                                    <div class="icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_115_1759)">
                                                <path d="M16.25 8.125C16.25 9.91797 15.668 11.5742 14.6875 12.918L19.6328 17.8672C20.1211 18.3555 20.1211 19.1484 19.6328 19.6367C19.1445 20.125 18.3516 20.125 17.8633 19.6367L12.918 14.6875C11.5742 15.6719 9.91797 16.25 8.125 16.25C3.63672 16.25 0 12.6133 0 8.125C0 3.63672 3.63672 0 8.125 0C12.6133 0 16.25 3.63672 16.25 8.125ZM8.125 13.75C8.86369 13.75 9.59514 13.6045 10.2776 13.3218C10.9601 13.0391 11.5801 12.6248 12.1025 12.1025C12.6248 11.5801 13.0391 10.9601 13.3218 10.2776C13.6045 9.59514 13.75 8.86369 13.75 8.125C13.75 7.38631 13.6045 6.65486 13.3218 5.97241C13.0391 5.28995 12.6248 4.66985 12.1025 4.14752C11.5801 3.62519 10.9601 3.21086 10.2776 2.92818C9.59514 2.64549 8.86369 2.5 8.125 2.5C7.38631 2.5 6.65486 2.64549 5.97241 2.92818C5.28995 3.21086 4.66985 3.62519 4.14752 4.14752C3.62519 4.66985 3.21086 5.28995 2.92818 5.97241C2.64549 6.65486 2.5 7.38631 2.5 8.125C2.5 8.86369 2.64549 9.59514 2.92818 10.2776C3.21086 10.9601 3.62519 11.5801 4.14752 12.1025C4.66985 12.6248 5.28995 13.0391 5.97241 13.3218C6.65486 13.6045 7.38631 13.75 8.125 13.75Z"
                                                      fill="#979CA4"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_115_1759">
                                                    <rect width="20" height="20" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <div class="additional-swiper">
                <div class="swiper-btn-mini-prev">
                    <svg width="10" height="19" viewBox="0 0 10 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M0.207895 10.0173C0.141376 9.94946 0.0886001 9.86882 0.0525909 9.78005C0.0165817 9.69128 -0.00195313 9.59611 -0.00195312 9.5C-0.00195313 9.40389 0.0165817 9.30872 0.0525909 9.21995C0.0886001 9.13118 0.141376 9.05054 0.207895 8.98267L8.77932 0.214285C8.91345 0.0770793 9.09536 0 9.28504 0C9.47472 0 9.65663 0.0770793 9.79075 0.214285C9.92488 0.351491 10.0002 0.537583 10.0002 0.731621C10.0002 0.925659 9.92488 1.11175 9.79075 1.24895L1.72361 9.5L9.79075 17.751C9.92488 17.8882 10.0002 18.0743 10.0002 18.2684C10.0002 18.4624 9.92488 18.6485 9.79075 18.7857C9.65663 18.9229 9.47472 19 9.28504 19C9.09536 19 8.91345 18.9229 8.77932 18.7857L0.207895 10.0173Z"
                              fill="#979CA4"/>
                    </svg>
                </div>

                <div class="swiper thumbs-swiper">
                    <div class="swiper-wrapper">
                        <?php if ($thumbnail) { ?>
                            <div class="swiper-slide">
                                <div class="image">
                                    <?= $thumbnail_wide; ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (!empty($gallery)) { ?>
                            <?php foreach ($gallery as $image) {
                                $image_wide = wp_get_attachment_image_url($image, 'wide');
                                ?>
                                <div class="swiper-slide">
                                    <div class="image">
                                        <img src="<?= $image_wide; ?>" alt="">
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>

                <div class="swiper-btn-mini-next">
                    <svg width="10" height="19" viewBox="0 0 10 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M9.79015 8.98267C9.85667 9.05054 9.90945 9.13118 9.94546 9.21995C9.98147 9.30872 10 9.40389 10 9.5C10 9.59611 9.98147 9.69128 9.94546 9.78005C9.90945 9.86882 9.85667 9.94946 9.79015 10.0173L1.21872 18.7857C1.0846 18.9229 0.902688 19 0.713008 19C0.523329 19 0.341417 18.9229 0.207294 18.7857C0.0731697 18.6485 -0.00217915 18.4624 -0.00217915 18.2684C-0.00217915 18.0743 0.0731697 17.8883 0.207294 17.751L8.27444 9.5L0.207294 1.24896C0.0731697 1.11175 -0.00217915 0.925659 -0.00217915 0.731621C-0.00217915 0.537583 0.0731697 0.351493 0.207294 0.214287C0.341417 0.0770813 0.523329 0 0.713008 0C0.902688 0 1.0846 0.0770813 1.21872 0.214287L9.79015 8.98267Z"
                              fill="#979CA4"/>
                    </svg>
                </div>
            </div>
        </div>
        <?php
    }

    public function open_product_main_info()
    { ?>
        <div class="single-product__main-info">
    <?php }

    public function close_product_main_info()
    {
        ?>
        </div>
    <?php }

    public function product_info()
    {
        global $product;
        $price = $product->get_price();
        $salePrice = $product->get_sale_price();
        ?>
        <div class="single-product__info">
            <div class="single-product__info-bottom">

                <div class="single-product__btns <?php if ($product->is_type('simple')) {
                    echo 'single-product__btns-simple';
                } ?>">
                    <?= $product->get_price_html(); ?>

                    <div class="btn" data-modal="callback">Оставить заявку</div>
                </div>
            </div>
        </div>
        <?php
    }

    public function top_row()
    {
        global $product;
        $terms = get_terms([
            'taxonomy' => 'product_tag',
            'include' => $product->get_tag_ids()
        ]);
        ?>
        <div class="top-row">
            <?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
                <span class="sku_wrapper p3"><?php esc_html_e('SKU:', 'woocommerce'); ?> <span
                            class="sku p3"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></span></span>
            <?php endif; ?>

            <?php if ($terms) { ?>
                <div class="tags">
                    <?php foreach ($terms as $term) {
                        $name = $term->name;
                        ?>
                        <div class="tag"><?= $name; ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php }

    public function additional_attributes()
    {
        global $product;
        $additional_attributes = get_field('additional_attributes', $product->get_id());
        if ($additional_attributes) { ?>
            <div class="additional-attributes">
                <?php foreach ($additional_attributes as $item) {
                    $icon = wp_get_attachment_image_url($item['icon'], 'full');
                    $value = $item['value'];
                    ?>
                    <div class="additional-attribute">
                        <?php if ($icon) { ?>
                            <img src="<?= $icon; ?>" alt="" class="style-svg">
                        <?php } ?>

                        <?php if ($value) { ?>
                            <div class="p2"><?= $value; ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php }
    }

    public function show_additional_options()
    {
        global $product;
        $additional_options = get_field('additional_options', $product->get_id());
        if ($additional_options) { ?>
            <div class="additional-options">
                <div class="p2 additional-options__title">Дополнительные опции</div>

                <div class="additional-options__wrapper">
                    <?php foreach ($additional_options as $key => $option) {
                        $name = $option['name'];
                        ?>
                        <div class="additional-option">
                            <input type="checkbox" name="additional-option" id="additional-option-<?= $key; ?>"
                                   class="additional-option__checkbox">

                            <label class="p2 additional-option__title"
                                   for="additional-option-<?= $key; ?>">
                                <div class="additional-option__checkbox-custom">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="7" viewBox="0 0 9 7"
                                         fill="none">
                                        <path d="M1 3.50002L3.33348 6L8 1" stroke="#34A0E1" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                <?= $name; ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php }

    public function show_variation_title()
    {
        echo '<div class="p2 variation-price-title">Стоимость</div>';
    }

    public function woocommerce_custom_single_add_to_cart_text()
    {
        return __('Добавить в корзину', 'woocommerce');
    }

    public function add_to_favorite_btn()
    {
        global $product;
        $in_favorites = WCFAVORITES()->check_item($product->get_id());
        $text = get_option('favorites_category_product_text', 'В избранные');
        ?>

        <button type="button" data-product_id="<?= $product->get_id() ?>"
                class="favorites ajax_add_to_favorites btn-circle card <?php if ($in_favorites) {
                    echo 'added';
                } ?>" aria-label="<?= $text ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M19.0714 13.1421L13.4146 18.799C12.6335 19.58 11.3672 19.58 10.5862 18.799L4.92931 13.1421C2.97669 11.1895 2.97669 8.02369 4.92931 6.07107C6.88193 4.11845 10.0478 4.11845 12.0004 6.07107C13.953 4.11845 17.1188 4.11845 19.0714 6.07107C21.0241 8.02369 21.0241 11.1895 19.0714 13.1421Z"
                      stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    <?php }

    public function product_bottom_info()
    {
        global $product;

        $description_columns = get_field('description_columns', $product->get_id());
        $attributes = $product->get_attributes();
        $files = get_field('files', $product->get_id());
        ?>
        <?php if (!empty($description_columns) || !empty($attributes) || !empty($files)) { ?>
        <div class="single-product__bottom-info block-margin">
            <div class="container">
                <div class="tabs">
                    <?php if (!empty($description_columns)) { ?>
                        <div class="tab p3" data-product-tab="description">Описание</div>
                    <?php } ?>

                    <?php if (!empty($attributes)) { ?>
                        <div class="tab p3" data-product-tab="attributes">Характеристики</div>
                    <?php } ?>

                    <?php if (!empty($files)) { ?>
                        <div class="tab p3" data-product-tab="files">Документация</div>
                    <?php } ?>
                </div>

                <div class="content">
                    <?php if (!empty($description_columns)) { ?>
                        <div class="single-product__description single-product__tab-content"
                             data-product-tab="description">
                            <div class="description__columns">
                                <?php foreach ($description_columns as $column) {
                                    $text = $column['text'];
                                    ?>
                                    <div class="column">
                                        <div class="text-block p4">
                                            <?= $text; ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!empty($attributes)) { ?>
                        <div class="single-product__attributes single-product__tab-content"
                             data-product-tab="attributes">
                            <?php wc_display_product_attributes($product); ?>
                        </div>
                    <?php } ?>

                    <?php if (!empty($files)) { ?>
                        <div class="single-product__tab-content" data-product-tab="files">
                            <div class="single-product__files">
                                <?php foreach ($files as $file) {
                                    $name = $file['name'];
                                    $file_link = $file['file'];
                                    $headers = get_headers($file_link, 1);
                                    $file_size = $headers['Content-Length'];
                                    $file_size_kb = $file_size / 1024;

                                    ?>
                                    <a href="<?= $file_link; ?>" class="file">
                                        <div class="file__icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.7509 17.2499C12.7509 17.4488 12.6719 17.6396 12.5313 17.7802C12.3906 17.9209 12.1999 17.9999 12.0009 17.9999C11.802 17.9999 11.6113 17.9209 11.4706 17.7802C11.33 17.6396 11.2509 17.4488 11.2509 17.2499V11.5604L9.53195 13.2809C9.39112 13.4217 9.20011 13.5008 9.00095 13.5008C8.80178 13.5008 8.61078 13.4217 8.46995 13.2809C8.32912 13.14 8.25 12.949 8.25 12.7499C8.25 12.5507 8.32912 12.3597 8.46995 12.2189L11.4699 9.21888C11.5396 9.14903 11.6224 9.09362 11.7135 9.05581C11.8046 9.018 11.9023 8.99854 12.0009 8.99854C12.0996 8.99854 12.1973 9.018 12.2884 9.05581C12.3795 9.09362 12.4623 9.14903 12.5319 9.21888L15.5319 12.2189C15.6728 12.3597 15.7519 12.5507 15.7519 12.7499C15.7519 12.949 15.6728 13.14 15.5319 13.2809C15.3911 13.4217 15.2001 13.5008 15.0009 13.5008C14.8018 13.5008 14.6108 13.4217 14.4699 13.2809L12.7509 11.5604V17.2499Z"
                                                      fill="#979CA4"/>
                                                <path d="M21 21V6.75L14.25 0H6C5.20435 0 4.44129 0.316071 3.87868 0.87868C3.31607 1.44129 3 2.20435 3 3V21C3 21.7956 3.31607 22.5587 3.87868 23.1213C4.44129 23.6839 5.20435 24 6 24H18C18.7956 24 19.5587 23.6839 20.1213 23.1213C20.6839 22.5587 21 21.7956 21 21ZM14.25 4.5C14.25 5.09674 14.4871 5.66903 14.909 6.09099C15.331 6.51295 15.9033 6.75 16.5 6.75H19.5V21C19.5 21.3978 19.342 21.7794 19.0607 22.0607C18.7794 22.342 18.3978 22.5 18 22.5H6C5.60218 22.5 5.22064 22.342 4.93934 22.0607C4.65804 21.7794 4.5 21.3978 4.5 21V3C4.5 2.60218 4.65804 2.22064 4.93934 1.93934C5.22064 1.65804 5.60218 1.5 6 1.5H14.25V4.5Z"
                                                      fill="#979CA4"/>
                                            </svg>
                                        </div>

                                        <div class="file__info">
                                            <?php if ($name) { ?>
                                                <div class="file__name p5"><?= $name; ?></div>
                                            <?php } ?>

                                            <div class="file__size p6">
                                                <?php echo number_format($file_size_kb, 2) . ' KB'; ?>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php }

    public function product_additional_blocks()
    {
        global $product;
        $steps_block = theme('product_footer_steps_block');
        $form_block = theme('product_footer_form_block');
        $related_products = wc_get_related_products($product, 4);
        ?>
        <div class="product__additional-blocks">
            <?php
            get_template_part('inc/blocks/steps-block/render',
                null,
                array(
                    'block_title' => $steps_block['block_title'],
                    'steps' => $steps_block['steps'],
                ));
            wp_enqueue_style('steps-block', get_template_directory_uri() . '/inc/blocks/steps-block/block.css', array(), 2);
            wp_enqueue_script('steps-block', get_template_directory_uri() . '/inc/blocks/steps-block/block.js', array(), 2);

            get_template_part('inc/blocks/form-block/render',
                null,
                array(
                    'block_title' => $form_block['block_title'],
                    'subtitle' => $form_block['subtitle'],
                    'image' => $form_block['image'],
                ));
            wp_enqueue_style('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.css', array(), 2);
            wp_enqueue_script('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.js', array(), 2);

            get_template_part('inc/blocks/products-block/render',
                null,
                array('block_title' => 'Дополнительно рекомендуем',
                    'products' => $related_products,
                ));
            wp_enqueue_style('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.css', array(), 2);
            wp_enqueue_script('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.js', array(), 2);
            ?>
        </div>
    <?php }

    public function if_product_not_stock()
    {
        global $product;

        if ($product->get_price() == '') {
            echo '<p class="stock out-of-stock">Товар отсутсвует</p>';
        }
    }

    public function jk_related_products_args($args)
    {
        $args['posts_per_page'] = 5; // количество "Похожих товаров"
        return $args;
    }

    /*
     * PAGE-CART
     */
    public function custom_cart_item_price($price, $values, $cart_item_key)
    {

        $is_on_sale = $values['data']->is_on_sale();
        $_product = $values['data'];
        $regular_price = $_product->get_regular_price();

        if ($is_on_sale) {
            $sale_price = $_product->get_sale_price();
            $regular_price = $_product->get_regular_price();
            $sale_percent = '-' . 100 - ($sale_price / $regular_price * 100) . '%';

            $price = '
<div class="product-price">
    <div class="main-price regular-price">' . wc_price($regular_price) . '</div>
    
    <div class="sale-percent p3">' . $sale_percent . '</div>
</div>';
        } else {
            $price = '
<div class="product-price">
    <h4 class="main-price">' . wc_price($regular_price) . '</h4>
</div>';
        }

        return $price;
    }

    public function show_product_additional_text($cart_item)
    {
        $additional_text = get_field('additional_text', $cart_item['product_id']);
        ?>
        <?php if ($additional_text) { ?>
        <div class="product-additional-text p3"><?= $additional_text; ?></div>
    <?php } ?>
        <?php
    }

    public function cart_products_amount()
    {
        ?>
        <div class="cart-count">
            <h5 class="count__title">Товаров<br> в корзине</h5>

            <h5 class="count__number"><?= WC()->cart->get_cart_contents_count() ?> шт</h5>
        </div>
        <?php
    }

    public function filter_woocommerce_cart_subtotal($subtotal, $compound, $cart)
    {
        $subtotal = 0;
        foreach (WC()->cart->get_cart() as $key => $cart_item) {
            $subtotal += $cart_item['data']->get_regular_price() * $cart_item['quantity'];
        }
        $subtotal = wc_price($subtotal);
        return $subtotal;
    }

    public function print_cart_weight()
    {
        ?>
        <tr class="order-weight">
            <th class="p1">Общая масса</th>

            <td data-title="Масса"><?= WC()->cart->get_cart_contents_weight(); ?> кг</td>
        </tr>
        <?php
    }

    public function print_cart_volume()
    {
        global $woocommerce;
        $items = $woocommerce->cart->get_cart();
        $totalVolume = 0;

        foreach ($items as $item => $values) {
            $_product = wc_get_product($values['data']->get_id());
            $volume = get_field('volume', $_product->get_id());
            $quantity = $values['quantity'];
            if ($volume) {
                $totalVolume += $volume * $quantity;
            }
        }
        ?>
        <tr class="order-volume">
            <th class="p1">Объем</th>

            <td data-title="Масса"><?= $totalVolume; ?> м <sup class="number">3</sup>
            </td>
        </tr>
        <?php
    }

    public function custom_woocommerce_empty_cart_action()
    {
        if (isset($_GET['empty_cart']) && 'yes' === esc_html($_GET['empty_cart'])) {
            WC()->cart->empty_cart();

            $referer = wp_get_referer() ? esc_url(remove_query_arg('empty_cart')) : wc_get_cart_url();
            wp_safe_redirect($referer);
        }
    }

    public function custom_woocommerce_empty_cart_button()
    {
        echo '<a href="' . esc_url(add_query_arg('empty_cart', 'yes')) . '" class="clear-cart p3" title="' . esc_attr('Empty Cart', 'woocommerce') . '">
<svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
  <path d="M7.5 7L17.5 17M7.5 17L17.5 7" stroke="#959595" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

Очистить корзину
</a>';
    }

    public function invoice()
    {
        ?>
        <div id="invoice-btn" class="btn invert">Сформировать накладную</div>
        <?php
    }

    /*
     * PAGE-CHECKOUT
     */
    public function carrie_customer_default_shipping_country($value, $customer)
    {
        $value = !empty($value) ? $value : 'RU';
        return $value;
    }

    public function custom_override_checkout_fields($fields)
    {
        unset($fields['billing']['billing_country']); // Отключаем страны оплаты
        unset($fields['shipping']['shipping_country']);// Отключаем страны доставки
        return $fields;
    }

    public function custom_thankyou_text($order, $permission)
    {
        $order = 'Заказ успешно оформлен!';

        return $order;
    }

    public function custom_checkout_order_review()
    {
        ?>
        <div class="cart-count">
            <div class="p2 count__title">Товаров <br> в корзине</div>

            <h6 class="count__number"><?= WC()->cart->get_cart_contents_count() ?></h6>
        </div>
        <?php
    }

    public function open_additional_field_block()
    {
        ?>
        <div class="additional-section__wrapper">
        <h4>Адрес доставки</h4>
        <div class="additional-section__fields">
        <?php
    }

    public function close_additional_field_block()
    {
        ?>
        </div>
        </div>
        <?php
    }

    public function show_shipping_methods()
    {
        ?>
        <div class="shipping-methods-wrapper">
            <h4 class="inputs__title">Способ получения</h4>

            <?php wc_cart_totals_shipping_html(); ?>
        </div>
        <?php
    }

    public function change_cart_shipping_method_full_label($label, $method)
    {
        $price = $method->cost > 0 ? '(+' . $method->cost . ' руб.)' : '(Бесплатно)';
        $label = '
<div class="method__content">
    <div class="method__text">
        <h5 class="method__name">' . $method->get_label() . '</h5>
    
    </div>
    
    <div class="method__price p3">' . $price . '</div>
</div>';

        return $label;
    }

    public function open_payment_methods_block()
    { ?>
        <div class="payment-methods-wrapper">
        <h4 class="inputs__title">Способы оплаты</h4>
    <?php }

    public function close_payment_methods_block()
    { ?>
        </div>
        <?php
    }

    public function second_place_order_button()
    {
        $order_button_text = apply_filters('woocommerce_order_button_text', __("Оформить заказ"));
        echo '<button type="submit" class="button btn alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>';

        wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce');
    }

    /*
     * THANKS
     * */
    public function block_after_thanks_info()
    {
        $after_thanks_title = theme('after_thanks_title');
        $after_thanks_subtitle = theme('after_thanks_subtitle');

        if ($after_thanks_title || $after_thanks_subtitle) { ?>
            <div class="after-thanks block-margin alignfull">
                <div class="after-thanks__bg-left">
                    <img src="<?= get_theme_file_uri(); ?>/assets/images/after-thanks-bg-left.png" alt="">
                </div>
                <div class="after-thanks__bg-center">
                    <img src="<?= get_theme_file_uri(); ?>/assets/images/after-thanks-bg-center.png" alt="">
                </div>
                <div class="after-thanks__bg-right">
                    <img src="<?= get_theme_file_uri(); ?>/assets/images/after-thanks-bg-right.png" alt="">
                </div>

                <div class="container">
                    <div class="after-thanks__content">
                        <?php if ($after_thanks_title) { ?>
                            <div class="after-thanks__title"><?= $after_thanks_title; ?></div>
                        <?php } ?>

                        <?php if ($after_thanks_subtitle) { ?>
                            <div class="after-thanks__subtitle"><?= $after_thanks_subtitle; ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php }
    }

    /*
     * PAGE-FAVORITES
     * */

    public function updateFavorites()
    {
        if (WCFAVORITES()->count_items() > 99) {
            echo '99+';
        } else {
            echo WCFAVORITES()->count_items();
        }
        wp_die();
    }

    public function wc_clear_favorite_url()
    {
        if (isset($_REQUEST['clear-fav'])) {
            unset($_COOKIE['WC_FAVORITES']);
        }
    }

    public function custom_favorite_item_price()
    {
        global $product;

        $is_variable = $product->is_type('variable');
        $is_on_sale = $product->is_on_sale();
//        var_dump($is_on_sale);
        $_product = $product;
        $regular_price = $_product->get_regular_price();

        if ($is_variable) {
            ?>
            <div class="product-price">
                <div class="main-price regular-price">от <?= wc_price($product->get_price()); ?></div>
            </div>
            <?php
        } else {
            if ($is_on_sale) {
                $sale_price = $_product->get_sale_price();
                $regular_price = $_product->get_regular_price();
                $sale_percent = '-' . 100 - ($sale_price / $regular_price * 100) . '%';
                ?>
                <div class="product-price">
                    <div class="main-price regular-price"><?= wc_price($regular_price); ?></div>

                    <div class="sale-percent p3"><?= $sale_percent; ?></div>
                </div>
            <?php } else {
                ?>
                <div class="product-price">
                <h4 class="main-price"><?= wc_price($regular_price); ?></h4>
                </div<?php
            }
        }
    }
}