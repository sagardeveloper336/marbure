<?php
/**
 * Testimonial Carousel – Style 1
 * Dark primary background, frosted-glass cards, Swiper carousel.
 *
 * Expected variables (injected by widget render()):
 *   @var array  $settings     Full widget settings from get_settings_for_display().
 *   @var array  $testimonials Testimonials repeater items.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section testimonials-section testimonials-<?php echo esc_attr( $style ); ?>">
	<div class="container">

		<?php if ( 'yes' === $settings['show_header'] && ( $settings['heading'] || $settings['eyebrow'] ) ) : ?>
			<div class="section__header" data-aos="fade-up">
				<?php if ( $settings['eyebrow'] ) : ?>
					<span class="eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
				<?php endif; ?>
				<?php if ( $settings['heading'] ) : ?>
					<h2 class="section-heading"><?php echo esc_html( $settings['heading'] ); ?></h2>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php $is_grid = isset( $settings['layout'] ) && 'grid' === $settings['layout']; ?>

		<?php if ( $is_grid ) : ?>
		<div class="testimonials-grid" data-aos="fade-up" data-aos-delay="100">
		<?php else : ?>
		<?php marbure_testimonials_swiper_open( $settings ); ?>
		<?php endif; ?>

				<?php foreach ( $testimonials as $item ) :
					$rating = max( 1, min( 5, (int) $item['rating'] ) );
				?>
					<div class="<?php echo $is_grid ? 'testimonials-grid__item' : 'swiper-slide'; ?>">
						<div class="testimonial-card">

							<div class="testimonial-card__quote-icon" aria-hidden="true">
								<i class="fas fa-quote-left"></i>
							</div>

							<div class="testimonial-card__stars"
							     aria-label="<?php printf( esc_attr__( '%d out of 5 stars', 'marbure' ), $rating ); ?>">
								<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
									<i class="<?php echo $i <= $rating ? 'fas fa-star' : 'far fa-star'; ?>"
									   aria-hidden="true"></i>
								<?php endfor; ?>
							</div>

							<blockquote class="testimonial-card__body">
								<p class="testimonial-card__text"><?php echo esc_html( $item['quote'] ); ?></p>
							</blockquote>

							<footer class="testimonial-card__footer">
								<?php if ( ! empty( $item['avatar']['url'] ) ) : ?>
									<div class="testimonial-card__avatar">
										<img
											src="<?php echo esc_url( $item['avatar']['url'] ); ?>"
											alt="<?php echo esc_attr( $item['client_name'] ); ?>"
											loading="lazy"
											width="60"
											height="60"
										/>
									</div>
								<?php else : ?>
									<div class="testimonial-card__avatar testimonial-card__avatar--initials"
									     aria-hidden="true">
										<?php echo esc_html( mb_substr( $item['client_name'], 0, 1 ) ); ?>
									</div>
								<?php endif; ?>

								<div class="testimonial-card__author">
									<?php if ( ! empty( $item['source_url']['url'] ) ) : ?>
										<cite>
											<a href="<?php echo esc_url( $item['source_url']['url'] ); ?>"
											   target="_blank"
											   rel="noopener noreferrer">
												<?php echo esc_html( $item['client_name'] ); ?>
											</a>
										</cite>
									<?php else : ?>
										<cite><?php echo esc_html( $item['client_name'] ); ?></cite>
									<?php endif; ?>
									<?php if ( $item['client_title'] ) : ?>
										<span class="testimonial-card__title">
											<?php echo esc_html( $item['client_title'] ); ?>
										</span>
									<?php endif; ?>
								</div>
							</footer>

						</div>
					</div>
				<?php endforeach; ?>

		<?php if ( $is_grid ) : ?>
		</div><!-- .testimonials-grid -->
		<?php else : ?>
			</div><!-- .swiper-wrapper -->

			<div class="swiper-pagination testimonials-swiper__pagination"></div>
		</div><!-- .swiper -->
		<?php endif; ?>

	</div>
</section>
