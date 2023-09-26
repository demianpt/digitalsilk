<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$button = get_sub_field('button');
$content = get_sub_field('content');

$image = get_sub_field('image');
$image_position = get_sub_field('image_position');
?>

<section class="l-dcbl container gap-top gap-bot <?php echo 'image-' . $image_position; ?>">
    <div class="c-block">
        <div class="c-block__col c-block__media">
            <div class="c-image">
                <?php if ($image): ?>
                    <div class="c-image__primary">
                        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="c-block__col c-block__content align-center">
            <div class="c-block__inner">

                <div class="c-heading -h3">
                    <?php if ($title): ?>
                        <h3 class="c-heading__title">
                            <?php echo $title; ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ($subtitle): ?>
                        <div class="c-heading__sub">
                            <?php echo $subtitle; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($content): ?>
                    <div class="c-block__text is-wysiwyg">
                        <?php echo $content; ?>
                    </div>
                <?php endif; ?>

                <?php if ($button): ?>
                    <div class="c-block__text is-wysiwyg">
                        <?php echo acf_button($button, array('class' => 'c-btn -primary')); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

</section>
