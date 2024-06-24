<?php
$thumbnail_wide = get_the_post_thumbnail_url($post, 'wide');
$thumbnail_full = get_the_post_thumbnail_url($post, 'full');
$title = get_the_title($post);
$description = get_field('description');
$attributes = get_field('attributes');
?>
<div class="work-card">
    <div class="work-card__title p3"><?= $title; ?></div>

    <div class="work-card__content">
        <?php if ($description || !empty($attributes)) {?>
            <div class="work-card__info">
                <?php if ($description) {?>
                    <div class="work-card__description text-block p6"><?= $description; ?></div>
                <?php } ?>
                
                <?php if (!empty($attributes)) {?>
                    <div class="work-card__attributes">
                        <?php foreach ($attributes as $attribute) { 
                            $name = $attribute['name'];
                            $value = $attribute['value'];
                            ?>
                            <div class="attribute">
                                <?php if ($name) {?>
                                    <p class="attribute__name"><?= $name; ?>: </p>
                                <?php } ?>
                                
                                <?php if ($value) {?>
                                    <p class="attribute__value"> <?= $value; ?></p>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        
        <?php if ($thumbnail_wide) {?>
            <div class="work-card__thumbnail" data-fancybox data-src='<?= $thumbnail_full; ?>'>
                <img src="<?= $thumbnail_wide; ?>" alt="">
            </div>
        <?php } ?>
    </div>
</div>
