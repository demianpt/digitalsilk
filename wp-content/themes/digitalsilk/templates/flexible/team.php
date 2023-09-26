<?php
$title      = get_sub_field( 'title' );
$subtitle   = get_sub_field( 'subtitle' );
$team       = get_sub_field( 'team' );

if( !empty( $team ) ): ?>

	<section class="team">

		<?php if( $title ): ?>
			<h2><?php echo $title; ?></h2>
		<?php endif; ?>

		<?php if( $subtitle ): ?>
			<?php echo $subtitle; ?>
		<?php endif; ?>


		<?php $flag = 0; foreach ( $team as $post ): setup_postdata( $post );
			$name    = get_the_title();
			$role    = get_field( 'position', get_the_ID() );
			$bio     = get_field( 'bio', get_the_ID() );
			$image   = get_the_post_thumbnail( get_the_ID(), 'full' );
			$socials = get_field( 'socials', get_the_ID() );
        ?>

			<?php if ( ! empty( $name ) || ! empty( $role ) || ! empty( $image ) ): ?>
                <div class="c-team__preview" data-open-popup="team_<?php echo $flag; ?>">

					<?php if ( ! empty( $image ) ): ?>
                        <div class="c-team__preview-img">
							<?php echo $image; ?>
                        </div>
					<?php endif; ?>

                    <div class="c-team__preview-brief">
						<?php if ( ! empty( $name ) ): ?>
							<h3 class="c-team__preview-name"><?php echo $name; ?></h3>
						<?php endif; ?>

						<?php if ( !empty( $role ) ): ?>
                            <div class="c-team__preview-role"><?php echo $role; ?></div>
						<?php endif; ?>
                    </div>

                </div>

                <!--popup start-->
				<?php if ( !empty( $bio ) ): ?>
					<?php if ( ! empty( $image ) ): ?>
                        <div class="c-team__preview-img">
							<?php echo $image; ?>
                        </div>
					<?php endif; ?>

					<?php if ( ! empty( $name ) ): ?>
                        <h3 class="c-team__preview-name"><?php echo $name; ?></h3>
					<?php endif; ?>

					<?php if ( !empty( $role ) ): ?>
                        <div class="c-team__preview-role"><?php echo $role; ?></div>
					<?php endif; ?>

					<?php if ( !empty( $bio ) ): ?>
                        <div class="c-team__bio"><?php echo $bio; ?></div>
					<?php endif; ?>

					<?php if ( !empty( $socials ) ): ?>
                        <div class="c-team__preview-socials">
							<?php get_template_part( 'templates/parts/socials', null, array( 'socials' => $socials ) ); ?>
                        </div>
					<?php endif; ?>
				<?php endif; ?>
                <!--popup end-->
			<?php endif; ?>

		<?php $flag++; endforeach; wp_reset_postdata(); ?>

	</section>

<?php endif; ?>
