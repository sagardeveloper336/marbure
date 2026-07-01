<?php
/**
 * Testimonial Carousel – Style 2
 * White background, shadow cards, dark text.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section testimonials-section testimonials-style-2">
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

		<div class="swiper js-testimonials-swiper"
		     data-aos="fade-up"
		     data-aos-delay="100"
		     data-loop="<?php echo ( 'yes' === $settings['loop'] ) ? '1' : '0'; ?>"
		     data-autoplay="<?php echo ( 'yes' === $settings['autoplay'] ) ? '1' : '0'; ?>"
		     data-autoplay-delay="<?php echo esc_attr( (int) $settings['autoplay_delay'] ); ?>"
		     data-slides-lg="3"
		     data-slides-md="2">
			<div class="swiper-wrapper">

				<?php foreach ( $testimonials as $item ) :
					$rating = max( 1, min( 5, (int) $item['rating'] ) );
				?>
					<div class="swiper-slide">
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

			</div><!-- .swiper-wrapper -->

			<div class="swiper-pagination testimonials-swiper__pagination"></div>
		</div><!-- .swiper -->

	</div>
</section>
