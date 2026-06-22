<?php
/**
 * Homepage section: Testimonials Carousel (Swiper).
 *
 * @package marbure
 */

$args = array(
	'post_type'      => 'marbure_testimonial',
	'posts_per_page' => 8,
	'no_found_rows'  => true,
	'orderby'        => 'date',
	'order'          => 'DESC',
);
$testimonials = new WP_Query( $args );

if ( ! $testimonials->have_posts() ) return;
?>
<section class="section testimonials-section">
	<div class="container">

		<div class="section__header" data-aos="fade-up">
			<span class="eyebrow"><?php esc_html_e( 'Client Stories', 'marbure' ); ?></span>
			<h2 class="section-heading"><?php esc_html_e( 'What Our Clients Say', 'marbure' ); ?></h2>
		</div>

		<div class="swiper js-testimonials-swiper" data-aos="fade-up" data-aos-delay="100">
			<div class="swiper-wrapper">

				<?php while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?>
					<?php
					$client_title = get_post_meta( get_the_ID(), '_testimonial_client_title', true );
					$rating       = (int) get_post_meta( get_the_ID(), '_testimonial_rating', true );
					$source_url   = get_post_meta( get_the_ID(), '_testimonial_source_url', true );
					?>
					<div class="swiper-slide">
						<div class="testimonial-card">

							<div class="testimonial-card__quote-icon" aria-hidden="true">
								<i class="fas fa-quote-left"></i>
							</div>

							<?php if ( $rating ) : ?>
								<div class="testimonial-card__stars" aria-label="<?php printf( esc_attr__( '%d out of 5 stars', 'marbure' ), $rating ); ?>">
									<?php echo marbure_star_rating( $rating ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
								</div>
							<?php endif; ?>

							<blockquote class="testimonial-card__body">
								<p class="testimonial-card__text"><?php echo wp_kses_post( get_the_content() ); ?></p>
							</blockquote>

							<footer class="testimonial-card__footer">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="testimonial-card__avatar">
										<?php the_post_thumbnail( 'thumbnail', array( 'loading' => 'lazy', 'alt' => esc_attr( get_the_title() ) ) ); ?>
									</div>
								<?php else : ?>
									<div class="testimonial-card__avatar testimonial-card__avatar--initials" aria-hidden="true">
										<?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?>
									</div>
								<?php endif; ?>
								<div class="testimonial-card__author">
									<?php if ( $source_url ) : ?>
										<cite><a href="<?php echo esc_url( $source_url ); ?>" target="_blank" rel="noopener noreferrer"><?php the_title(); ?></a></cite>
									<?php else : ?>
										<cite><?php the_title(); ?></cite>
									<?php endif; ?>
									<?php if ( $client_title ) : ?>
										<span class="testimonial-card__title"><?php echo esc_html( $client_title ); ?></span>
									<?php endif; ?>
								</div>
							</footer>

						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>

			</div><!-- .swiper-wrapper -->

			<div class="swiper-pagination testimonials-swiper__pagination"></div>
		</div><!-- .swiper -->

	</div>
</section>
