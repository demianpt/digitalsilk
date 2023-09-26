<?php
$title      = get_field('title');
$subtitle   = get_field('subtitle');
$button     = get_field('button');
$image      = get_field('image');
?>

<section class="" style="background-image: url(<?php echo $image; ?>)">

    <?php if( $title ): ?>
        <h1>
            <?php echo $title; ?>
        </h1>
    <?php endif; ?>

    <?php if( $subtitle ): ?>
        <div class="">
            <?php echo $subtitle; ?>
        </div>
    <?php endif; ?>

    <?php if( $button ): ?>
        <?php echo acf_button($button, array('class' => 'btn btn-filled')); ?>
    <?php endif; ?>

</section>
