<?php
/**
 * Content partial: team member card.
 *
 * @package marbure
 */

$position     = get_post_meta( get_the_ID(), '_team_position', true );
$phone        = get_post_meta( get_the_ID(), '_team_phone', true );
$email        = get_post_meta( get_the_ID(), '_team_email', true );
$bar_no       = get_post_meta( get_the_ID(), '_team_bar_number', true );
$linkedin     = get_post_meta( get_the_ID(), '_team_linkedin', true );
$facebook     = get_post_meta( get_the_ID(), '_team_facebook', true );
$twitter      = get_post_meta( get_the_ID(), '_team_twitter', true );
$show_socials = marbure_option( 'team_show_socials', true );
?>
<article class="team-card" id="post-<?php the_ID(); ?>">

	<div class="team-card__image-wrap">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'marbure-team', array(
					'class'   => 'team-card__image',
					'loading' => 'lazy',
					'alt'     => esc_attr( get_the_title() ),
				) ); ?>
			</a>
		<?php else : ?>
			<div class="team-card__image team-card__image--placeholder"></div>
		<?php endif; ?>

		<?php if ( $show_socials && ( $linkedin || $facebook || $twitter ) ) : ?>
			<div class="team-card__socials">
				<?php if ( $linkedin ) : ?>
					<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer"
					   aria-label="<?php echo esc_attr( get_the_title() . ' ' . __( 'on LinkedIn', 'marbure' ) ); ?>">
						<i class="fab fa-linkedin-in" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
				<?php if ( $facebook ) : ?>
					<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer"
					   aria-label="<?php echo esc_attr( get_the_title() . ' ' . __( 'on Facebook', 'marbure' ) ); ?>">
						<i class="fab fa-facebook-f" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
				<?php if ( $twitter ) : ?>
					<a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer"
					   aria-label="<?php echo esc_attr( get_the_title() . ' ' . __( 'on Twitter', 'marbure' ) ); ?>">
						<i class="fab fa-x-twitter" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="team-card__body">
		<h3 class="team-card__name">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<?php if ( $position ) : ?>
			<p class="team-card__position"><?php echo esc_html( $position ); ?></p>
		<?php endif; ?>
		<?php if ( $bar_no ) : ?>
			<p class="team-card__bar"><?php printf( esc_html__( 'Bar No. %s', 'marbure' ), esc_html( $bar_no ) ); ?></p>
		<?php endif; ?>
		<div class="team-card__contact">
			<?php if ( $phone ) : ?>
				<a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $phone ) ); ?>" class="team-card__contact-link">
					<i class="fas fa-phone" aria-hidden="true"></i>
					<?php echo esc_html( $phone ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $email ) : ?>
				<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>" class="team-card__contact-link">
					<i class="fas fa-envelope" aria-hidden="true"></i>
					<?php echo esc_html( antispambot( $email ) ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>

</article>
