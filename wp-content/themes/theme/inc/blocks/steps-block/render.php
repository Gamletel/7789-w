<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$steps = $args['steps'] ?? get_field('steps');
?>
<?php if (!empty($steps)) { ?>
    <div id="steps-block" class="block-margin block-padding <?= $classes; ?> <?= $align; ?>">
        <div class="container">
            <?php if ($block_title) { ?>
                <h2 class="block-title"><?= $block_title; ?></h2>
            <?php } ?>

            <div class="steps">
                <?php foreach ($steps as $key => $step) {
                    $title = $step['title'];
                    $text = $step['text'];
                    $image = wp_get_attachment_image_url($step['image'], 'wide');
                    ?>
                    <div class="step">
                        <div class="step__index p4">
                            <?php if ($key < 10) {
                                echo '0' . $key + 1;
                            } else {
                                echo $key + 1;
                            } ?>
                        </div>

                        <div class="step__content">
                            <?php if ($title) { ?>
                                <div class="step__title p5"><?= $title; ?></div>
                            <?php } ?>

                            <?php if ($text) { ?>
                                <div class="step__text text-block p4"><?= $text; ?></div>
                            <?php } ?>
                        </div>

                        <?php if ($image) { ?>
                            <div class="step__image">
                                <div class="image">
                                    <img src="<?= $image; ?>" alt="">
                                </div>
                            </div>
                        <?php } ?>

                        <div class="step__toggler">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 0C2.20435 0 1.44129 0.316071 0.87868 0.87868C0.316071 1.44129 0 2.20435 0 3L0 21C0 21.7956 0.316071 22.5587 0.87868 23.1213C1.44129 23.6839 2.20435 24 3 24H21C21.7956 24 22.5587 23.6839 23.1213 23.1213C23.6839 22.5587 24 21.7956 24 21V3C24 2.20435 23.6839 1.44129 23.1213 0.87868C22.5587 0.316071 21.7956 0 21 0L3 0ZM12.75 6.75V15.4395L15.969 12.219C16.0387 12.1493 16.1215 12.094 16.2126 12.0562C16.3037 12.0185 16.4014 11.9991 16.5 11.9991C16.5986 11.9991 16.6963 12.0185 16.7874 12.0562C16.8785 12.094 16.9613 12.1493 17.031 12.219C17.1007 12.2887 17.156 12.3715 17.1938 12.4626C17.2315 12.5537 17.2509 12.6514 17.2509 12.75C17.2509 12.8486 17.2315 12.9463 17.1938 13.0374C17.156 13.1285 17.1007 13.2113 17.031 13.281L12.531 17.781C12.4613 17.8508 12.3786 17.9063 12.2874 17.9441C12.1963 17.9819 12.0987 18.0013 12 18.0013C11.9013 18.0013 11.8037 17.9819 11.7125 17.9441C11.6214 17.9063 11.5387 17.8508 11.469 17.781L6.969 13.281C6.89927 13.2113 6.84395 13.1285 6.80621 13.0374C6.76848 12.9463 6.74905 12.8486 6.74905 12.75C6.74905 12.6514 6.76848 12.5537 6.80621 12.4626C6.84395 12.3715 6.89927 12.2887 6.969 12.219C7.10983 12.0782 7.30084 11.9991 7.5 11.9991C7.59862 11.9991 7.69627 12.0185 7.78738 12.0562C7.87848 12.094 7.96127 12.1493 8.031 12.219L11.25 15.4395V6.75C11.25 6.55109 11.329 6.36032 11.4697 6.21967C11.6103 6.07902 11.8011 6 12 6C12.1989 6 12.3897 6.07902 12.5303 6.21967C12.671 6.36032 12.75 6.55109 12.75 6.75Z"
                                      fill="#39B449"/>
                            </svg>

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M1.5 21C1.5 21.3978 1.65804 21.7794 1.93934 22.0607C2.22064 22.342 2.60217 22.5 3 22.5L21 22.5C21.3978 22.5 21.7794 22.342 22.0607 22.0607C22.342 21.7794 22.5 21.3978 22.5 21L22.5 3C22.5 2.60217 22.342 2.22064 22.0607 1.93934C21.7794 1.65804 21.3978 1.5 21 1.5L3 1.5C2.60217 1.5 2.22064 1.65804 1.93934 1.93934C1.65804 2.22064 1.5 2.60217 1.5 3L1.5 21ZM24 21C24 21.7956 23.6839 22.5587 23.1213 23.1213C22.5587 23.6839 21.7956 24 21 24L3 24C2.20435 24 1.44129 23.6839 0.878681 23.1213C0.316071 22.5587 0 21.7956 0 21L0 3C0 2.20435 0.316071 1.44129 0.878681 0.878681C1.44129 0.316071 2.20435 0 3 0L21 0C21.7956 0 22.5587 0.316071 23.1213 0.878681C23.6839 1.44129 24 2.20435 24 3L24 21ZM11.25 17.25C11.25 17.4489 11.329 17.6397 11.4697 17.7803C11.6103 17.921 11.8011 18 12 18C12.1989 18 12.3897 17.921 12.5303 17.7803C12.671 17.6397 12.75 17.4489 12.75 17.25L12.75 8.5605L15.969 11.781C16.1098 11.9218 16.3008 12.0009 16.5 12.0009C16.6992 12.0009 16.8902 11.9218 17.031 11.781C17.1718 11.6402 17.2509 11.4492 17.2509 11.25C17.2509 11.0508 17.1718 10.8598 17.031 10.719L12.531 6.219C12.4613 6.14915 12.3786 6.09374 12.2875 6.05593C12.1963 6.01812 12.0987 5.99866 12 5.99866C11.9013 5.99866 11.8037 6.01812 11.7126 6.05593C11.6214 6.09374 11.5387 6.14915 11.469 6.219L6.969 10.719C6.82817 10.8598 6.74905 11.0508 6.74905 11.25C6.74905 11.4492 6.82817 11.6402 6.969 11.781C7.10983 11.9218 7.30084 12.0009 7.5 12.0009C7.69916 12.0009 7.89017 11.9218 8.031 11.781L11.25 8.5605L11.25 17.25Z"
                                      fill="#979CA4"/>
                            </svg>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
