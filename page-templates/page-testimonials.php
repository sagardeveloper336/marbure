<?php
/**
 * Template Name: Testimonials
 * Template Post Type: page
 *
 * @package marbure
 */

get_header();
?>

<main id="main" class="site-main testimonials-main">

	<section class="testimonials-archive section-pad">
		<div class="container">

			<?php
			$testimonials = new WP_Query( array(
				'post_type'      => 'marbure_testimonial',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'no_found_rows'  => true,
			) );
			?>

			<?php if ( $testimonials->have_posts() ) : ?>

				<div class="testimonials-grid">
					<?php while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?>

						<div class="testimonial-card" data-aos="fade-up">

							<?php
							$rating  = get_post_meta( get_the_ID(), '_testimonial_rating', true );
							$title   = get_post_meta( get_the_ID(), '_testimonial_client_title', true );
							$src_url = get_post_meta( get_the_ID(), '_testimonial_source_url', true );
							?>

							<?php if ( $rating ) : ?>
								<div class="testimonial-card__stars" aria-label="<?php printf( esc_attr__( '%s out of 5 stars', 'marbure' ), esc_attr( $rating ) ); ?>">
									<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
										<span class="star<?php echo $i <= intval( $rating ) ? ' star--filled' : ''; ?>">&#9733;</span>
									<?php endfor; ?>
								</div>
							<?php endif; ?>

							<blockquote class="testimonial-card__quote">
								<?php the_content(); ?>
							</blockquote>

							<div class="testimonial-card__author">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'testimonial-card__avatar' ) ); ?>
								<?php endif; ?>
								<div class="testimonial-card__meta">
									<strong class="testimonial-card__name"><?php the_title(); ?></strong>
									<?php if ( $title ) : ?>
										<span class="testimonial-card__role"><?php echo esc_html( $title ); ?></span>
									<?php endif; ?>
								</div>
								<?php if ( $src_url ) : ?>
									<a href="<?php echo esc_url( $src_url ); ?>" class="testimonial-card__source" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'View original review', 'marbure' ); ?>">
										<i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
									</a>
								<?php endif; ?>
							</div>

						</div>

					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>

			<?php else : ?>

				<p class="no-results"><?php esc_html_e( 'No testimonials found.', 'marbure' ); ?></p>

			<?php endif; ?>

		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/cta-band' ); ?>

</main>

<?php
get_footer();
