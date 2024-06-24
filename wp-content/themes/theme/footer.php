<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Company
 */

$logo = theme('logo');
$phones = @settings('phones');
$emails = @settings('emails');
$socials = @settings('socials');
$addresses = @settings('addresses');
$requisites = @settings('requisites');
$footer_additional_text = theme('footer_additional_text');
?>

<footer id="footer" class="site-footer">
    <div class="container-wide">
        <div class="footer">
            <div class="container">
                <div class="footer__wrapper">
                    <div class="footer__top">
                        <div class="top__main">
                            <?php if ($logo) { ?>
                                <a href="/" class="logo p4">
                                    <?= $logo; ?>
                                </a>
                            <?php } ?>

                            <?php if ($requisites) { ?>
                                <div class="requisites p6"><?= $requisites; ?></div>
                            <?php } ?>
                        </div>

                        <?php
                        wp_nav_menu([
                            'theme_location' => 'mobileMenu',
                            'container' => false,
                            'menu' => 'Главное-футер',
                            'menu_class' => 'menuFooter',
                            'echo' => true,
                            'fallback_cb' => 'wp_page_menu',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth' => 2,
                        ]);
                        ?>

                        <div class="top__contacts">
                            <?php if (!empty($phones)) { ?>
                                <div class="contact">
                                    <div class="contact__icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_2001_756)">
                                                <path d="M10.9375 -0.000584072C15.9414 -0.000584072 20 4.05801 20 9.06192C20 9.58145 19.582 9.99942 19.0625 9.99942C18.543 9.99942 18.125 9.58145 18.125 9.06192C18.125 5.09317 14.9062 1.87442 10.9375 1.87442C10.418 1.87442 10 1.45645 10 0.936916C10 0.417385 10.418 -0.000584072 10.9375 -0.000584072ZM11.25 7.49942C11.5815 7.49942 11.8995 7.63111 12.1339 7.86553C12.3683 8.09995 12.5 8.4179 12.5 8.74942C12.5 9.08094 12.3683 9.39888 12.1339 9.6333C11.8995 9.86772 11.5815 9.99942 11.25 9.99942C10.9185 9.99942 10.6005 9.86772 10.3661 9.6333C10.1317 9.39888 10 9.08094 10 8.74942C10 8.4179 10.1317 8.09995 10.3661 7.86553C10.6005 7.63111 10.9185 7.49942 11.25 7.49942ZM10 4.68692C10 4.16739 10.418 3.74942 10.9375 3.74942C13.8711 3.74942 16.25 6.12832 16.25 9.06192C16.25 9.58145 15.832 9.99942 15.3125 9.99942C14.793 9.99942 14.375 9.58145 14.375 9.06192C14.375 7.16348 12.8359 5.62442 10.9375 5.62442C10.418 5.62442 10 5.20645 10 4.68692ZM4.58984 0.0541034C5.34766 -0.152928 6.14062 0.233791 6.44141 0.960354L8.00391 4.71035C8.26953 5.34707 8.08594 6.08535 7.55078 6.51895L5.625 8.09707C6.92578 10.8471 9.15234 13.0736 11.9023 14.3744L13.4766 12.4486C13.9141 11.9135 14.6484 11.7299 15.2852 11.9955L19.0352 13.558C19.7617 13.8588 20.1484 14.6518 19.9414 15.4096L19.0039 18.8471C18.8203 19.5268 18.2031 19.9994 17.5 19.9994C7.83594 19.9994 0 12.1635 0 2.49942C0 1.79629 0.472656 1.1791 1.15234 0.991604L4.58984 0.0541034Z"
                                                      fill="#93ACD9"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_2001_756">
                                                    <rect width="20" height="20" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>

                                    <div class="contact__items">
                                        <?php foreach ($phones as $item) {
                                            $value = $item['value'];
                                            $name = $item['name'];
                                            ?>
                                            <a href="tel:<?= $value; ?>" class="item p4"><?= $name; ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if (!empty($emails)) { ?>
                                <div class="contact">
                                    <div class="contact__icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.875 2.5C0.839844 2.5 0 3.33984 0 4.375C0 4.96484 0.277344 5.51953 0.75 5.875L9.25 12.25C9.69531 12.582 10.3047 12.582 10.75 12.25L19.25 5.875C19.7227 5.51953 20 4.96484 20 4.375C20 3.33984 19.1602 2.5 18.125 2.5H1.875ZM0 6.875V15C0 16.3789 1.12109 17.5 2.5 17.5H17.5C18.8789 17.5 20 16.3789 20 15V6.875L11.5 13.25C10.6094 13.918 9.39062 13.918 8.5 13.25L0 6.875Z"
                                                  fill="#93ACD9"/>
                                        </svg>
                                    </div>

                                    <div class="contact__items">
                                        <?php foreach ($emails as $item) {
                                            $value = $item['value'];
                                            $name = $item['name'];
                                            ?>
                                            <a href="mailto:<?= $value; ?>" class="item p4"><?= $name; ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="top__additionals">
                            <div class="btn" data-modal="callback">обратный звонок</div>
                        </div>
                    </div>

                    <div class="footer__bottom">
                        <a href="/privacy-policy" class="policy p6" target="_blank">
                            Политика конфиденциальности
                        </a>

                        <a href="https://grampus-studio.ru/?utm_source=client&utm_keyword=<?= get_site_url(); ?>;"
                           target="_blank" class="grampus p6">
                            Сайт разработан

                            <?= inline('assets/images/GRAMPUS.svg'); ?>
                        </a>

                        <?php if ($footer_additional_text) { ?>
                            <div class="additional-text p6"><?= $footer_additional_text; ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="modal-callback" class="theme-modal theme-modal-main">
    <div class="close-modal">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_82_2776)">
                <path d="M11.6131 2.07225C12.0789 1.60641 12.0789 0.849885 11.6131 0.384047C11.1473 -0.0817917 10.3907 -0.0817917 9.92491 0.384047L6.00068 4.312L2.07273 0.387774C1.6069 -0.078065 0.850374 -0.078065 0.384535 0.387774C-0.0813034 0.853612 -0.0813034 1.61013 0.384535 2.07597L4.31249 6.0002L0.388262 9.92815C-0.0775766 10.394 -0.0775766 11.1505 0.388262 11.6163C0.854101 12.0822 1.61062 12.0822 2.07646 11.6163L6.00068 7.6884L9.92864 11.6126C10.3945 12.0785 11.151 12.0785 11.6168 11.6126C12.0827 11.1468 12.0827 10.3903 11.6168 9.92442L7.68888 6.0002L11.6131 2.07225Z"
                      fill="#979CA4"/>
            </g>
            <defs>
                <clipPath id="clip0_82_2776">
                    <rect width="12" height="12" fill="white"/>
                </clipPath>
            </defs>
        </svg>
    </div>
    <div class="form__holder">
        <?php get_form('callback-modal') ?>
    </div>
</div>

<div id="modal-request" class="theme-modal theme-modal-main">
    <div class="close-modal">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_82_2776)">
                <path d="M11.6131 2.07225C12.0789 1.60641 12.0789 0.849885 11.6131 0.384047C11.1473 -0.0817917 10.3907 -0.0817917 9.92491 0.384047L6.00068 4.312L2.07273 0.387774C1.6069 -0.078065 0.850374 -0.078065 0.384535 0.387774C-0.0813034 0.853612 -0.0813034 1.61013 0.384535 2.07597L4.31249 6.0002L0.388262 9.92815C-0.0775766 10.394 -0.0775766 11.1505 0.388262 11.6163C0.854101 12.0822 1.61062 12.0822 2.07646 11.6163L6.00068 7.6884L9.92864 11.6126C10.3945 12.0785 11.151 12.0785 11.6168 11.6126C12.0827 11.1468 12.0827 10.3903 11.6168 9.92442L7.68888 6.0002L11.6131 2.07225Z"
                      fill="#979CA4"/>
            </g>
            <defs>
                <clipPath id="clip0_82_2776">
                    <rect width="12" height="12" fill="white"/>
                </clipPath>
            </defs>
        </svg>
    </div>
    <div class="form__holder">
        <?php get_form('request-modal') ?>
    </div>
</div>

<div id="modal-success" class="theme-modal theme-modal-additional">
    <div class="close-modal">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_82_2776)">
                <path d="M11.6131 2.07225C12.0789 1.60641 12.0789 0.849885 11.6131 0.384047C11.1473 -0.0817917 10.3907 -0.0817917 9.92491 0.384047L6.00068 4.312L2.07273 0.387774C1.6069 -0.078065 0.850374 -0.078065 0.384535 0.387774C-0.0813034 0.853612 -0.0813034 1.61013 0.384535 2.07597L4.31249 6.0002L0.388262 9.92815C-0.0775766 10.394 -0.0775766 11.1505 0.388262 11.6163C0.854101 12.0822 1.61062 12.0822 2.07646 11.6163L6.00068 7.6884L9.92864 11.6126C10.3945 12.0785 11.151 12.0785 11.6168 11.6126C12.0827 11.1468 12.0827 10.3903 11.6168 9.92442L7.68888 6.0002L11.6131 2.07225Z"
                      fill="#979CA4"/>
            </g>
            <defs>
                <clipPath id="clip0_82_2776">
                    <rect width="12" height="12" fill="white"/>
                </clipPath>
            </defs>
        </svg>
    </div>

    <div class="form__title">
        Успешно отправлено!
    </div>

    <div class="form__subtitle">
        Наш специалист перезвонит Вам на указанный номер в течение 15 минут.
    </div>

    <a href="/" class="btn">Закрыть</a>
</div>

<div id="modal-error" class="theme-modal">
    <div class="close-modal">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_82_2776)">
                <path d="M11.6131 2.07225C12.0789 1.60641 12.0789 0.849885 11.6131 0.384047C11.1473 -0.0817917 10.3907 -0.0817917 9.92491 0.384047L6.00068 4.312L2.07273 0.387774C1.6069 -0.078065 0.850374 -0.078065 0.384535 0.387774C-0.0813034 0.853612 -0.0813034 1.61013 0.384535 2.07597L4.31249 6.0002L0.388262 9.92815C-0.0775766 10.394 -0.0775766 11.1505 0.388262 11.6163C0.854101 12.0822 1.61062 12.0822 2.07646 11.6163L6.00068 7.6884L9.92864 11.6126C10.3945 12.0785 11.151 12.0785 11.6168 11.6126C12.0827 11.1468 12.0827 10.3903 11.6168 9.92442L7.68888 6.0002L11.6131 2.07225Z"
                      fill="#979CA4"/>
            </g>
            <defs>
                <clipPath id="clip0_82_2776">
                    <rect width="12" height="12" fill="white"/>
                </clipPath>
            </defs>
        </svg>
    </div>

    <div class="form__title">
        Ошибка!
    </div>

    <div class="form__subtitle">
        Не удалось отправить форму. Попробуйте позже
    </div>

    <a href="/" class="btn">Закрыть</a>
</div>

<?php wp_footer(); ?>
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
</body>
</html>