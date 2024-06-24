<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme
 */

$logo = theme('logo');
$phones = @settings('phones');
$emails = @settings('emails');
$socials = @settings('socials');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css"
    />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="site-header">
    <div class="container-wide">
        <div class="header">
            <div class="container">
                <div class="header-wrapper">
                    <?php if ($logo) { ?>
                        <a href="/" class="logo">
                           <?= $logo; ?>
                        </a>
                    <?php } ?>

                    <?php
                    wp_nav_menu([
                        'theme_location' => 'mobileMenu',
                        'container' => false,
                        'menu' => 'Главное',
                        'menu_class' => 'menuTop',
                        'echo' => true,
                        'fallback_cb' => 'wp_page_menu',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth' => 2,
                    ]);
                    ?>

                    <div class="additionals">
                        <?php if (!empty($phones)) { ?>
                            <a href="<?= $phones[0]['value']; ?>" class="phone p3">
                                <?= $phones[0]['name']; ?>
                            </a>
                        <?php } ?>

                        <div class="btn-accent" data-modal="callback">Перезвоните мне</div>

                        <div class="burger open_menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="mobile-mnu">
        <div id="close-mnu">×</div>

        <a href="/" class="logo">
           <?= $logo; ?>
        </a>

        <?php
        wp_nav_menu([
            'theme_location' => 'mobileMenu',
            'container' => false,
            'menu' => 'Главное',
            'menu_class' => 'menuTop',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 2,
        ]);
        ?>

        <?php if (!empty($phones)) { ?>
            <div class="phones__holder">
                <?php foreach ($phones as $item) { ?>
                    <a href="tel:<?= $item['value']; ?>" class="phone__item">
                        <?= file_get_contents(TEMPLATEPATH . '/assets/images/phone.svg'); ?>
                        <?= $item['name']; ?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if (!empty($emails)): ?>
            <div class="email__holder">
                <?php foreach ($emails as $item) { ?>
                    <a href="mailto:<?= $item['value']; ?>" class="email__item">
                        <?= file_get_contents(TEMPLATEPATH . '/assets/images/mail.svg'); ?>
                        <?php echo $item['name']; ?>
                    </a>
                <?php } ?>
            </div>
        <?php endif ?>
        <?php if (!empty($adresses)): ?>
            <div class="adresses__holder">
                <?php foreach ($adresses as $adress) { ?>
                    <?= $adress['value']; ?>
                <?php } ?>
            </div>
        <?php endif ?>
        <?php if (!empty($socials)): ?>
            <div class="soc__holder">
                <?php foreach ($socials as $item) { ?>
                    <a href="<?= $item['value']; ?>" class="soc__item" target="_blank">
                        <?= get_image($item['icon'], [24, 24]); ?>
                    </a>
                <?php } ?>
            </div>
        <?php endif ?>
    </div>
</header><!-- #masthead -->
