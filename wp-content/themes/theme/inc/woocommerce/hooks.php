<?php

include_once 'functions.php';

class WooThemeHooks extends WooThemeFunctions
{
    function __construct()
    {
        $this->register();
    }

    private function register()
    {
        /*
         * WC GLOBAL
         */
        add_filter('woocommerce_enqueue_styles', '__return_empty_array'); //Убираем стили woocommerce
        add_action('wp_enqueue_scripts', [$this, 'error_fade_out'], 25);//Исчезание ошибки после промежутка времени

        add_filter('woocommerce_add_to_cart_fragments', [$this, 'wc_refresh_mini_cart_count']); //Обновление счетчика товаров в козине
        add_filter('woocommerce_get_price_html', [$this, 'custom_sale_price'], 10, 2); //Изменяем верстку стоимости товара
//        add_filter( 'woocommerce_variable_price_html', [$this, 'custom_variable_product_price'], 9999, 2 ); //Меняем формат стоимости вариативного товара
        add_filter('woocommerce_gallery_thumbnail_size', function ($size) {
            return 'thumbnail';
        });
        add_action('widgets_init', [$this, 'register_my_widgets']); // Регистрация сайдбаров
        add_action('woocommerce_before_main_content', [$this, 'custom_breadcrumbs'], 15); //Кастомные хлебные крошки
        add_filter('woocommerce_product_single_add_to_cart_text', [$this, 'woo_custom_cart_button_text'], 1);
//        add_filter('woocommerce_currency_symbol', [$this, 'change_existing_currency_symbol'], 10, 2); //Меняем значек рубля на текст

        remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10); // Убираем оболочку WooCommerce
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20); // Меняем хлебные крошки

        /*
         * CATEGORY-CARD
         */
//        add_action('woocommerce_before_subcategory_title', [$this, 'category_image_wrapper'], 10); // Добавляем оболочку для картинки категории
        add_action('woocommerce_shop_loop_subcategory_title', [$this, 'open_category_content_wrapper'], 1); //Открываем блок с контентом категории (Заголовок, ссылка)
//        add_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_link_open', 14); //Добавляем ссылку на категорию
        add_action('woocommerce_shop_loop_subcategory_title', [$this, 'category_content'], 15); //Добавляем контент карточки категории
//        add_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_link_close', 16); //Закрываем ссылку на категорию
        add_action('woocommerce_shop_loop_subcategory_title', [$this, 'close_category_content_wrapper'], 20); //Закрываем блок с контентом категории (Заголовок, ссылка)
        add_filter('woocommerce_subcategory_count_html', [$this, 'remove_count']); // Удаляем количество товаров в категории

        remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10); //Убираем стандартное название категории
        remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10); // Удаляем картинку без оболочки
//        remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10); //Убираем стандартную ссылку на категорию
//        remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10); //Убираем стандартную ссылку на категорию

        /*
         * ARCHIVE-PRODUCT
         */
        add_filter('loop_shop_per_page', [$this, 'products_per_page'], 20); // Меняем количество выводимых товаров на странице
        add_filter('woocommerce_result_count', [$this, 'custom_woocommerce_result_count'], 10, 4);//Меняем текст вывода количества товаров
        add_action('woocommerce_archive_description', [$this, 'archive_category_banner'], 20); //Добавяем главный баннер категории
        add_action('woocommerce_archive_description', [$this, 'archive_categories'], 30); //Добавяем главный баннер категории
        add_action('woocommerce_after_main_content', [$this, 'archive_products_additional_blocks'], 5); //Добавляем блоки после архива с товарами
        add_filter('woocommerce_show_page_title', [$this, 'wp_kama_woocommerce_show_page_title_filter']); //Удаляем стандартный заголовок страницы у категорий WC
        add_action('woocommerce_after_shop_loop', [$this, 'open_archive_products_bottom_part'], 0);//Открываем нижнюю часть архивной страницы
        add_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 5);// Выводим количество товаров
        add_action('woocommerce_after_shop_loop', 'pagination', 10);// Подключаем кастомную пагинацию к WooCommerce
        add_action('woocommerce_after_shop_loop', [$this, 'close_archive_products_bottom_part'], 100);//Закрываем нижнюю часть архивной страницы

        remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);// Убираем стандартную пагинацию WooCommerce
        remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10); //Убираем стандартное место вывода описания
        remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10); // Убираем сообщения Woo
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20); // Убираем счетчик товаров в каталоге
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30); // Убираем сортировку товаров в каталоге

        /*
         * PRODUCT-CARD
         */
        add_action('woocommerce_before_shop_loop_item', [$this, 'product_card_top_part'], 15); //Собираем верхнюю часть карточки товара
//        add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_close', 25); //Добавляем закрытие ссылки на товар
        add_action('woocommerce_after_shop_loop_item_title', [$this, 'product_card_bottom_part'], 15); //Собираем нижнюю часть карточки товара
        add_filter('woocommerce_product_add_to_cart_text', [$this, 'wp_kama_woocommerce_product_add_to_cart_text_filter'], 10, 2); //Меняем кнопку "Добавить в корзину"
        remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10); //Убираем стандартный заголовок
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10); //Убираем стандартное изображение товара
        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10); //Убираем стандартную стоимость товара
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10); // Убираем распродажа из карточки товара
//        remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10); //Убираем обертку карточки (ссылка)
//        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5); // Удаляем стандартное закрытие ссылки товара
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10); // Убираем кнопку добавить к корзину

        /*
         * PRODUCT-PAGE
         */
        /*Верхняя часть товара*/
//        add_action('woocommerce_single_product_summary', [$this, 'if_product_not_stock'], 25); // Если цены нет, то выводим информационное поле
        add_action('woocommerce_single_product_summary', [$this, 'custom_product_swiper'], 1); //Вывод изображения товара
        add_action('woocommerce_single_product_summary', [$this, 'open_product_main_info'], 2); //Открытие блока с основной информацией товара
        add_action('woocommerce_single_product_summary', [$this, 'show_short_description'], 10); //Выводим краткое описание товара
        add_action('woocommerce_single_product_summary', [$this, 'show_mini_attributes'], 10); //Выводим несколько атрибутов товара
        add_action('woocommerce_single_product_summary', [$this, 'product_info'], 15); //Информация о товаре (описание, атрибуты)
        add_action('woocommerce_single_product_summary', [$this, 'close_product_main_info'], 70); //Закрытие блока с основной информацией
        /*Описание и характеристики*/
        add_action('woocommerce_after_single_product_summary', [$this, 'product_bottom_info'], 5); //Описание товара
        /*Нижняя часть товара*/
        add_action('woocommerce_after_single_product_summary', [$this, 'product_additional_blocks'], 25); //Доп. блоки
//        add_action('woocommerce_after_single_product', [$this, 'product_additional_blocks'], 1); //Дополнительные блоки на странице товара

        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5); //Убираем название товара
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10); //Убираем цену товара
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);  //Убираем похожие товары
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40); //Убираем мета-теги
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30); //Убираем стандартную кнопку заказа
        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10); // Убираем распродажа в карточке товара
        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20); //Убираем Изображения товара
        remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10); //Убираем сообщения в карточке товара
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10); //Отключаем табы в карточке товара
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20); //Убираем краткое описание
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10); //Убираем Sidebar у товара

        /*
         * PRODUCT CART
         * */
        add_filter('woocommerce_cart_item_price', [$this, 'custom_cart_item_price'], 30, 3); //Меняем формат вывода стоимости товара
        add_filter('woocommerce_notice_types', '__return_empty_array'); //Убираем уведомления
        add_action('woocommerce_after_cart_item_name', [$this, 'show_product_additional_text'], 20); //Выводим доп. текст карточки
        add_filter('woocommerce_cart_subtotal', [$this, 'filter_woocommerce_cart_subtotal'], 10, 3);//Добавляем в подытог стоимость товаров не учитывая скидки
        add_action('woocommerce_before_cart_totals', [$this, 'cart_products_amount'], 10); // Вывод количества товаров
        add_action('woocommerce_proceed_to_checkout', [$this, 'custom_woocommerce_empty_cart_button'], 25); //Добавляем кнопку очистки корзины
//        add_action('woocommerce_proceed_to_checkout', [$this, 'invoice'], 20); //Добавляем кнопку "Сформировать накладную"
        add_action('wp_loaded', [$this, 'custom_woocommerce_empty_cart_action'], 20); //Очистка корзины

        remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

        /*
         * CHECKOUT
         * */
        add_filter('woocommerce_cart_shipping_method_full_label', [$this, 'change_cart_shipping_method_full_label'], 10, 2); //Меняем формат вывода доставки товара
        add_action('woocommerce_after_checkout_billing_form', [$this, 'open_additional_field_block'], 5); //Обертка для Адреса доставки
        add_action('woocommerce_after_checkout_billing_form', [$this, 'close_additional_field_block'], 15); //Закрытие обертки для Адреса доставки
        add_action('woocommerce_after_checkout_billing_form', [$this, 'show_shipping_methods'], 20); //Отображаем способы доставки товара (получения)
        add_action('woocommerce_after_checkout_billing_form', [$this, 'open_payment_methods_block'], 30); //Открываем блок со способами оплаты товара
        add_action('woocommerce_after_checkout_billing_form', 'woocommerce_checkout_payment', 35); //Выводим способы оплаты товара
        add_action('woocommerce_after_checkout_billing_form', [$this, 'close_payment_methods_block'], 40); //Закрываем блок со способами оплаты товара
//        add_action('woocommerce_after_checkout_billing_form', [$this, 'open_comment'], 50); //Закрываем блок со способами оплаты товара

        add_action('woocommerce_checkout_order_review', [$this, 'custom_checkout_order_review'], 0); //Обертка для review-order
//        add_action('woocommerce_checkout_order_review', [$this, 'invoice'], 20);
//        add_action('woocommerce_review_order_after_order_total', [$this, 'print_cart_weight'], 10);//Вывод общей массы товаров в корзине
//        add_action('woocommerce_review_order_after_order_total', [$this, 'print_cart_volume'], 10);//Вывод общего объема товаров в корзине
        add_action('woocommerce_checkout_order_review', [$this, 'second_place_order_button'], 10); // Перенос кнопки подтвердить заказ
        /*ЕСЛИ НЕТ ПОЛЕЙ С ДОСТАВКОЙ*/
        add_filter('woocommerce_customer_get_shipping_country', [$this, 'carrie_customer_default_shipping_country'], 10, 2);//Устанавливаем RU
        add_filter('woocommerce_checkout_fields', [$this, 'custom_override_checkout_fields']); //Отключаем страны оплаты и страны доставки
//        add_filter( 'woocommerce_thankyou_order_received_text', [$this, 'custom_thankyou_text'], 10, 2 ); //Меняем текст Спасибо за заказ

        remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20); // Убираем доставку из order_review
        remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10); // Удаляем сообщения
        remove_action('woocommerce_before_checkout_form_cart_notices', 'woocommerce_output_all_notices', 10);

        /*
         * THANKS
         * */
        add_action('woocommerce_after_order_details', [$this, 'block_after_thanks_info'], 10); //Добавляем блок после информации о заказе

        /*
         * PAGE-FAVORITES
         * */
        add_action('favorite_item_price', [$this, 'custom_favorite_item_price']); //Меняем формат вывода стоимости товара
        add_action('wp_ajax_updatefavorites', [$this, 'updateFavorites']); // Обновление избранного
        add_action('wp_ajax_nopriv_updatefavorites', [$this, 'updateFavorites']); // Обновление избранного
        add_action('init', [$this, 'wc_clear_favorite_url']); // Чистка избранного
    }
}

return new WooThemeHooks();