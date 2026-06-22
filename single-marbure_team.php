<?php
/**
 * Template: Single Attorney profile.
 *
 * @package marbure
 */

get_header();
?>
<div class="container">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php
		$position = get_post_meta( get_the_ID(), '_team_position', true );
		$phone    = get_post_meta( get_the_ID(), '_team_phone', true );
		$email    = get_post_meta( get_the_ID(), '_team_email', true );
		$bar_no   = get_post_meta( get_the_ID(), '_team_bar_number', true );
		$linkedin = get_post_meta( get_the_ID(), '_team_linkedin', true );
		$facebook = get_post_meta( get_the_ID(), '_team_facebook', true );
		$twitter  = get_post_meta( get_the_ID(), '_team_twitter', true );
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'attorney-profile' ); ?>>

			<div class="attorney-profile__header">
				<div class="attorney-profile__photo">
					<?php the_post_thumbnail( 'marbure-team', array( 'loading' => 'eager', 'alt' => esc_attr( get_the_title() ) ) ); ?>
				</div>

				<div class="attorney-profile__intro">
					<?php if ( $position ) : ?>
						<p class="attorney-profile__position"><?php echo esc_html( $position ); ?></p>
					<?php endif; ?>
					<h1 class="attorney-profile__name"><?php the_title(); ?></h1>

					<?php if ( $bar_no ) : ?>
						<p class="attorney-profile__bar"><?php printf( esc_html__( 'Bar Admission No. %s', 'marbure' ), esc_html( $bar_no ) ); ?></p>
					<?php endif; ?>

					<div class="attorney-profile__contact">
						<?php if ( $phone ) : ?>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $phone ) ); ?>" class="attorney-profile__contact-link">
								<i class="fas fa-phone" aria-hidden="true"></i>
								<?php echo esc_html( $phone ); ?>
							</a>
						<?php endif; ?>
						<?php if ( $email ) : ?>
							<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>" class="attorney-profile__contact-link">
								<i class="fas fa-envelope" aria-hidden="true"></i>
								<?php echo esc_html( antispambot( $email ) ); ?>
							</a>
						<?php endif; ?>
					</div>

					<?php if ( $linkedin || $facebook || $twitter ) : ?>
						<div class="attorney-profile__socials">
							<?php if ( $linkedin ) : ?>
								<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'LinkedIn', 'marbure' ); ?>">
									<i class="fab fa-linkedin-in" aria-hidden="true"></i>
								</a>
							<?php endif; ?>
							<?php if ( $facebook ) : ?>
								<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Facebook', 'marbure' ); ?>">
									<i class="fab fa-facebook-f" aria-hidden="true"></i>
								</a>
							<?php endif; ?>
							<?php if ( $twitter ) : ?>
								<a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Twitter / X', 'marbure' ); ?>">
									<i class="fab fa-x-twitter" aria-hidden="true"></i>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<a href="<?php echo esc_url( marbure_option( 'hero_btn1_url', '/contact' ) ); ?>" class="btn btn--primary">
						<?php esc_html_e( 'Schedule Consultation', 'marbure' ); ?>
					</a>
				</div>
			</div>

			<div class="attorney-profile__body">
				<div class="attorney-profile__content entry-content">
					<?php the_content(); ?>
				</div>

				<?php
				// Practice areas this attorney handles.
				$service_args = array(
					'post_type'      => 'marbure_service',
					'posts_per_page' => 6,
					'no_found_rows'  => true,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				);
				$services = new WP_Query( $service_args );
				if ( $services->have_posts() ) :
				?>
					<aside class="attorney-profile__services">
						<h2><?php esc_html_e( 'Areas of Practice', 'marbure' ); ?></h2>
						<div class="services-grid row">
							<?php while ( $services->have_posts() ) : $services->the_post(); ?>
								<div class="col-md-4">
									<?php get_template_part( 'template-parts/content', 'service' ); ?>
								</div>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					</aside>
				<?php endif; ?>
			</div>

		</article>

	<?php endwhile; ?>

</div>
<?php
get_footer();
