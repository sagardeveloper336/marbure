<?php
/**
 * Homepage section: Team Grid — Attorney profiles.
 *
 * @package marbure
 */

$args = array(
	'post_type'      => 'marbure_team',
	'posts_per_page' => 4,
	'no_found_rows'  => true,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
);
$team = new WP_Query( $args );

if ( ! $team->have_posts() ) return;

$show_socials = marbure_option( 'team_show_socials', true );
$col_class    = marbure_grid_col_class( 'team', 4 );
?>
<section class="section team-section">
	<div class="container">

		<div class="section__header" data-aos="fade-up">
			<span class="eyebrow"><?php esc_html_e( 'Meet Our Team', 'marbure' ); ?></span>
			<h2 class="section-heading"><?php esc_html_e( 'Our Experienced Attorneys', 'marbure' ); ?></h2>
			<p class="section-subheading">
				<?php esc_html_e( 'Our attorneys bring decades of combined experience and a shared commitment to delivering justice for every client.', 'marbure' ); ?>
			</p>
		</div>

		<div class="team-grid" data-aos="fade-up" data-aos-delay="100">
			<?php while ( $team->have_posts() ) : $team->the_post(); ?>
				<?php
				$position = get_post_meta( get_the_ID(), '_team_position', true );
				$phone    = get_post_meta( get_the_ID(), '_team_phone', true );
				$email    = get_post_meta( get_the_ID(), '_team_email', true );
				$bar_no   = get_post_meta( get_the_ID(), '_team_bar_number', true );
				$linkedin = get_post_meta( get_the_ID(), '_team_linkedin', true );
				$facebook = get_post_meta( get_the_ID(), '_team_facebook', true );
				$twitter  = get_post_meta( get_the_ID(), '_team_twitter', true );
				?>
				<div class="<?php echo esc_attr( $col_class ); ?>">
					<article class="team-card">
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
										<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( get_the_title() ) . ' ' . esc_attr__( 'on LinkedIn', 'marbure' ); ?>">
											<i class="fab fa-linkedin-in" aria-hidden="true"></i>
										</a>
									<?php endif; ?>
									<?php if ( $facebook ) : ?>
										<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( get_the_title() ) . ' ' . esc_attr__( 'on Facebook', 'marbure' ); ?>">
											<i class="fab fa-facebook-f" aria-hidden="true"></i>
										</a>
									<?php endif; ?>
									<?php if ( $twitter ) : ?>
										<a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( get_the_title() ) . ' ' . esc_attr__( 'on Twitter', 'marbure' ); ?>">
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
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<div class="section__footer" data-aos="fade-up">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'marbure_team' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'Meet All Attorneys', 'marbure' ); ?>
			</a>
		</div>

	</div>
</section>
