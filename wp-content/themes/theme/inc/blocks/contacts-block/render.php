<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$contacts_title = get_field('contacts_title');
$show_form = get_field('show_form');
$form_title = get_field('form_title');
$form_subtitle = get_field('form_subtitle');
$show_map = get_field('show_map');
$addresses = @settings('addresses');
$phones = @settings('phones');
$emails = @settings('emails');
?>
<div id="contacts-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
    <div class="container">
        <?php if ($show_form) { ?>
            <div class="block__content-with-form">
                <div class="block__top">
                    <?php if (!empty($addresses) || !empty($phones) || !empty($emails)) { ?>
                        <div class="block__contacts">
                            <?php if ($contacts_title) { ?>
                                <h3><?= $contacts_title; ?></h3>
                            <?php } ?>

                            <div class="contacts">
                                <?php if (!empty($addresses)) { ?>
                                    <div class="contact">
                                        <div class="contact__icon">
                                            <svg width="9" height="12" viewBox="0 0 9 12" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_82_3566)">
                                                    <path d="M5.05547 11.7C6.25781 10.1953 9 6.54844 9 4.5C9 2.01562 6.98438 0 4.5 0C2.01562 0 0 2.01562 0 4.5C0 6.54844 2.74219 10.1953 3.94453 11.7C4.23281 12.0586 4.76719 12.0586 5.05547 11.7ZM4.5 3C4.89782 3 5.27936 3.15804 5.56066 3.43934C5.84196 3.72064 6 4.10217 6 4.5C6 4.89782 5.84196 5.27936 5.56066 5.56066C5.27936 5.84196 4.89782 6 4.5 6C4.10218 6 3.72064 5.84196 3.43934 5.56066C3.15804 5.27936 3 4.89782 3 4.5C3 4.10217 3.15804 3.72064 3.43934 3.43934C3.72064 3.15804 4.10218 3 4.5 3Z"
                                                          fill="white"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_82_3566">
                                                        <rect width="9" height="12" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>

                                        <div class="contact__items">
                                            <?php foreach ($addresses as $item) {
                                                $value = $item['value'];
                                                ?>
                                                <div class="item p4">
                                                    <?= $value; ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($phones)) { ?>
                                    <div class="contact">
                                        <div class="contact__icon">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_82_3572)">
                                                    <path d="M6.5625 -0.000448099C9.56484 -0.000448099 12 2.43471 12 5.43705C12 5.74877 11.7492 5.99955 11.4375 5.99955C11.1258 5.99955 10.875 5.74877 10.875 5.43705C10.875 3.0558 8.94375 1.12455 6.5625 1.12455C6.25078 1.12455 6 0.873771 6 0.562052C6 0.250333 6.25078 -0.000448099 6.5625 -0.000448099ZM6.75 4.49955C6.94891 4.49955 7.13968 4.57857 7.28033 4.71922C7.42098 4.85987 7.5 5.05064 7.5 5.24955C7.5 5.44846 7.42098 5.63923 7.28033 5.77988C7.13968 5.92053 6.94891 5.99955 6.75 5.99955C6.55109 5.99955 6.36032 5.92053 6.21967 5.77988C6.07902 5.63923 6 5.44846 6 5.24955C6 5.05064 6.07902 4.85987 6.21967 4.71922C6.36032 4.57857 6.55109 4.49955 6.75 4.49955ZM6 2.81205C6 2.50033 6.25078 2.24955 6.5625 2.24955C8.32266 2.24955 9.75 3.6769 9.75 5.43705C9.75 5.74877 9.49922 5.99955 9.1875 5.99955C8.87578 5.99955 8.625 5.74877 8.625 5.43705C8.625 4.29799 7.70156 3.37455 6.5625 3.37455C6.25078 3.37455 6 3.12377 6 2.81205ZM2.75391 0.0323644C3.20859 -0.0918544 3.68437 0.140177 3.86484 0.576114L4.80234 2.82611C4.96172 3.20815 4.85156 3.65111 4.53047 3.91127L3.375 4.85815C4.15547 6.50815 5.49141 7.84408 7.14141 8.62455L8.08594 7.46908C8.34844 7.14799 8.78906 7.03783 9.17109 7.19721L11.4211 8.13471C11.857 8.31518 12.0891 8.79096 11.9648 9.24565L11.4023 11.3081C11.2922 11.716 10.9219 11.9996 10.5 11.9996C4.70156 11.9996 0 7.29799 0 1.49955C0 1.07768 0.283594 0.707364 0.691406 0.594864L2.75391 0.0323644Z"
                                                          fill="white"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_82_3572">
                                                        <rect width="12" height="12" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>

                                        <div class="contact__items">
                                            <?php foreach ($phones as $item) {
                                                $value = $item['value'];
                                                $name = $item['name'];
                                                ?>
                                                <a href="tel:<?= $value; ?>" class="item p4">
                                                    <?= $name; ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($emails)) { ?>
                                    <div class="contact">
                                        <div class="contact__icon">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.125 1.5C0.503906 1.5 0 2.00391 0 2.625C0 2.97891 0.166406 3.31172 0.45 3.525L5.55 7.35C5.81719 7.54922 6.18281 7.54922 6.45 7.35L11.55 3.525C11.8336 3.31172 12 2.97891 12 2.625C12 2.00391 11.4961 1.5 10.875 1.5H1.125ZM0 4.125V9C0 9.82734 0.672656 10.5 1.5 10.5H10.5C11.3273 10.5 12 9.82734 12 9V4.125L6.9 7.95C6.36562 8.35078 5.63438 8.35078 5.1 7.95L0 4.125Z"
                                                      fill="white"/>
                                            </svg>
                                        </div>

                                        <div class="contact__items">
                                            <?php foreach ($emails as $item) {
                                                $value = $item['value'];
                                                $name = $item['name'];
                                                ?>
                                                <a href="mailto:<?= $value; ?>" class="item p4">
                                                    <?= $name; ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="block__form">
                        <?php if ($form_title) { ?>
                            <h3 class="form__title"><?= $form_title; ?></h3>
                        <?php } ?>

                        <?php if ($form_subtitle) { ?>
                            <div class="form__subtitle p4"><?= $form_subtitle; ?></div>
                        <?php } ?>

                        <?php get_form('callback') ?>
                    </div>
                </div>

                <?php if ($show_map) { ?>
                    <div class="block__map">
                        <?php render_map(); ?>
                    </div>
                <?php } ?>
            </div>
        <?php } else {
            ?>
            <div class="block__content-without-form">
                <?php if (!empty($addresses) || !empty($phones) || !empty($emails)) { ?>
                    <div class="block__contacts">
                        <?php if ($contacts_title) { ?>
                            <h2 class="block-title"><?= $contacts_title; ?></h2>
                        <?php } ?>

                        <div class="contacts">
                            <?php if (!empty($addresses)) { ?>
                                <div class="contact">
                                    <div class="contact__icon">
                                        <svg width="9" height="12" viewBox="0 0 9 12" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_82_3566)">
                                                <path d="M5.05547 11.7C6.25781 10.1953 9 6.54844 9 4.5C9 2.01562 6.98438 0 4.5 0C2.01562 0 0 2.01562 0 4.5C0 6.54844 2.74219 10.1953 3.94453 11.7C4.23281 12.0586 4.76719 12.0586 5.05547 11.7ZM4.5 3C4.89782 3 5.27936 3.15804 5.56066 3.43934C5.84196 3.72064 6 4.10217 6 4.5C6 4.89782 5.84196 5.27936 5.56066 5.56066C5.27936 5.84196 4.89782 6 4.5 6C4.10218 6 3.72064 5.84196 3.43934 5.56066C3.15804 5.27936 3 4.89782 3 4.5C3 4.10217 3.15804 3.72064 3.43934 3.43934C3.72064 3.15804 4.10218 3 4.5 3Z"
                                                      fill="white"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_82_3566">
                                                    <rect width="9" height="12" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>

                                    <div class="contact__items">
                                        <?php foreach ($addresses as $item) {
                                            $value = $item['value'];
                                            ?>
                                            <div class="item p4">
                                                <?= $value; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if (!empty($phones)) { ?>
                                <div class="contact">
                                    <div class="contact__icon">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_82_3572)">
                                                <path d="M6.5625 -0.000448099C9.56484 -0.000448099 12 2.43471 12 5.43705C12 5.74877 11.7492 5.99955 11.4375 5.99955C11.1258 5.99955 10.875 5.74877 10.875 5.43705C10.875 3.0558 8.94375 1.12455 6.5625 1.12455C6.25078 1.12455 6 0.873771 6 0.562052C6 0.250333 6.25078 -0.000448099 6.5625 -0.000448099ZM6.75 4.49955C6.94891 4.49955 7.13968 4.57857 7.28033 4.71922C7.42098 4.85987 7.5 5.05064 7.5 5.24955C7.5 5.44846 7.42098 5.63923 7.28033 5.77988C7.13968 5.92053 6.94891 5.99955 6.75 5.99955C6.55109 5.99955 6.36032 5.92053 6.21967 5.77988C6.07902 5.63923 6 5.44846 6 5.24955C6 5.05064 6.07902 4.85987 6.21967 4.71922C6.36032 4.57857 6.55109 4.49955 6.75 4.49955ZM6 2.81205C6 2.50033 6.25078 2.24955 6.5625 2.24955C8.32266 2.24955 9.75 3.6769 9.75 5.43705C9.75 5.74877 9.49922 5.99955 9.1875 5.99955C8.87578 5.99955 8.625 5.74877 8.625 5.43705C8.625 4.29799 7.70156 3.37455 6.5625 3.37455C6.25078 3.37455 6 3.12377 6 2.81205ZM2.75391 0.0323644C3.20859 -0.0918544 3.68437 0.140177 3.86484 0.576114L4.80234 2.82611C4.96172 3.20815 4.85156 3.65111 4.53047 3.91127L3.375 4.85815C4.15547 6.50815 5.49141 7.84408 7.14141 8.62455L8.08594 7.46908C8.34844 7.14799 8.78906 7.03783 9.17109 7.19721L11.4211 8.13471C11.857 8.31518 12.0891 8.79096 11.9648 9.24565L11.4023 11.3081C11.2922 11.716 10.9219 11.9996 10.5 11.9996C4.70156 11.9996 0 7.29799 0 1.49955C0 1.07768 0.283594 0.707364 0.691406 0.594864L2.75391 0.0323644Z"
                                                      fill="white"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_82_3572">
                                                    <rect width="12" height="12" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>

                                    <div class="contact__items">
                                        <?php foreach ($phones as $item) {
                                            $value = $item['value'];
                                            $name = $item['name'];
                                            ?>
                                            <a href="tel:<?= $value; ?>" class="item p4">
                                                <?= $name; ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if (!empty($emails)) { ?>
                                <div class="contact">
                                    <div class="contact__icon">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.125 1.5C0.503906 1.5 0 2.00391 0 2.625C0 2.97891 0.166406 3.31172 0.45 3.525L5.55 7.35C5.81719 7.54922 6.18281 7.54922 6.45 7.35L11.55 3.525C11.8336 3.31172 12 2.97891 12 2.625C12 2.00391 11.4961 1.5 10.875 1.5H1.125ZM0 4.125V9C0 9.82734 0.672656 10.5 1.5 10.5H10.5C11.3273 10.5 12 9.82734 12 9V4.125L6.9 7.95C6.36562 8.35078 5.63438 8.35078 5.1 7.95L0 4.125Z"
                                                  fill="white"/>
                                        </svg>
                                    </div>

                                    <div class="contact__items">
                                        <?php foreach ($emails as $item) {
                                            $value = $item['value'];
                                            $name = $item['name'];
                                            ?>
                                            <a href="mailto:<?= $value; ?>" class="item p4">
                                                <?= $name; ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                
                <?php if ($show_map) {?>
                    <div class="block__map">
                        <?php render_map(); ?>
                    </div>
                <?php } ?>
            </div>
            <?php
        } ?>
    </div>
</div>