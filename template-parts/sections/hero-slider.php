<?php
/**
 * Homepage section: Hero Slider (Swiper).
 *
 * Slide 1 content comes from Kirki. Slides 2 & 3 are demo content.
 * Replace demo slide images by uploading to Media and updating here,
 * or use the Elementor Hero Slider widget (Phase 5) for full control.
 *
 * @package marbure
 */

$eyebrow  = marbure_option( 'hero_eyebrow', __( '12 Years of Legal Excellence', 'marbure' ) );
$heading  = marbure_option( 'hero_heading', __( 'Fighting for Your Justice', 'marbure' ) );
$subtext  = marbure_option( 'hero_subtext', __( 'Experienced attorneys committed to protecting your rights and securing the justice you deserve.', 'marbure' ) );
$btn1     = marbure_option( 'hero_btn1_label', __( 'Free Consultation', 'marbure' ) );
$btn1_url = marbure_option( 'hero_btn1_url', '/contact' );
$btn2     = marbure_option( 'hero_btn2_label', __( 'Our Practice Areas', 'marbure' ) );
$btn2_url = marbure_option( 'hero_btn2_url', '/practice-areas' );
$bg_img   = marbure_option( 'hero_bg_image', '' );

$slides = array(
	array(
		'bg'      => $bg_img,
		'eyebrow' => $eyebrow,
		'heading' => $heading,
		'text'    => $subtext,
		'btn1'    => $btn1, 'btn1_url' => $btn1_url,
		'btn2'    => $btn2, 'btn2_url' => $btn2_url,
	),
	array(
		'bg'      => '',
		'eyebrow' => __( 'Trusted Legal Counsel', 'marbure' ),
		'heading' => __( 'Standing Firm for What\'s Right', 'marbure' ),
		'text'    => __( 'We navigate complex legal challenges so you can focus on what matters most. Your justice is our mission.', 'marbure' ),
		'btn1'    => __( 'Our Attorneys', 'marbure' ), 'btn1_url' => '/attorneys',
		'btn2'    => __( 'Case Results', 'marbure' ),  'btn2_url' => '/case-results',
	),
	array(
		'bg'      => '',
		'eyebrow' => __( 'Results-Driven Representation', 'marbure' ),
		'heading' => __( 'Advocating for Your Rights', 'marbure' ),
		'text'    => __( 'From personal injury to business litigation, we bring the full weight of our experience to every case we handle.', 'marbure' ),
		'btn1'    => __( 'Free Consultation', 'marbure' ), 'btn1_url' => '/contact',
		'btn2'    => __( 'Practice Areas', 'marbure' ),   'btn2_url' => '/practice-areas',
	),
);
?>
<section class="hero-slider" aria-label="<?php esc_attr_e( 'Hero slideshow', 'marbure' ); ?>">
	<div class="swiper js-hero-swiper">
		<div class="swiper-wrapper">

			<?php foreach ( $slides as $i => $slide ) : ?>
				<div class="swiper-slide">
					<div
						class="hero-slide<?php echo empty( $slide['bg'] ) ? ' hero-slide--gradient' : ''; ?>"
						<?php if ( ! empty( $slide['bg'] ) ) : ?>
							style="background-image: url(<?php echo esc_url( $slide['bg'] ); ?>);"
						<?php endif; ?>
					>
						<div class="hero-slide__overlay"></div>

						<div class="container">
							<div class="hero-slide__content" data-aos="fade-right" data-aos-duration="800">

								<?php if ( $slide['eyebrow'] ) : ?>
									<span class="hero-slide__eyebrow eyebrow">
										<?php echo esc_html( $slide['eyebrow'] ); ?>
									</span>
								<?php endif; ?>

								<h<?php echo 0 === $i ? '1' : '2'; ?> class="hero-slide__title">
									<?php echo esc_html( $slide['heading'] ); ?>
								</h<?php echo 0 === $i ? '1' : '2'; ?>>

								<?php if ( $slide['text'] ) : ?>
									<p class="hero-slide__text">
										<?php echo esc_html( $slide['text'] ); ?>
									</p>
								<?php endif; ?>

								<div class="hero-slide__actions">
									<?php if ( $slide['btn1'] && $slide['btn1_url'] ) : ?>
										<a href="<?php echo esc_url( $slide['btn1_url'] ); ?>" class="btn btn--primary">
											<?php echo esc_html( $slide['btn1'] ); ?>
										</a>
									<?php endif; ?>
									<?php if ( $slide['btn2'] && $slide['btn2_url'] ) : ?>
										<a href="<?php echo esc_url( $slide['btn2_url'] ); ?>" class="btn btn--outline-white">
											<?php echo esc_html( $slide['btn2'] ); ?>
										</a>
									<?php endif; ?>
								</div>

							</div>
						</div>

					</div>
				</div>
			<?php endforeach; ?>

		</div><!-- .swiper-wrapper -->

		<div class="swiper-pagination hero-swiper__pagination"></div>
		<button class="swiper-button-prev hero-swiper__prev" aria-label="<?php esc_attr_e( 'Previous slide', 'marbure' ); ?>"></button>
		<button class="swiper-button-next hero-swiper__next" aria-label="<?php esc_attr_e( 'Next slide', 'marbure' ); ?>"></button>

	</div><!-- .swiper -->
</section>
