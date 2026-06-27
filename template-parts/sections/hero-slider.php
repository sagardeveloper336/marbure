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

$eyebrow  = marbure_option( 'hero_eyebrow', __( 'Premium Marble & Stone Since 2012', 'marbure' ) );
$heading  = marbure_option( 'hero_heading', __( 'Elevate Every Surface', 'marbure' ) );
$subtext  = marbure_option( 'hero_subtext', __( 'Premium marble, granite, and natural stone surfaces for homes and businesses that demand perfection.', 'marbure' ) );
$btn1     = marbure_option( 'hero_btn1_label', __( 'Explore Collection', 'marbure' ) );
$btn1_url = marbure_option( 'hero_btn1_url', '/products' );
$btn2     = marbure_option( 'hero_btn2_label', __( 'View Projects', 'marbure' ) );
$btn2_url = marbure_option( 'hero_btn2_url', '/projects' );
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
		'eyebrow' => __( 'Trusted Stone Specialists', 'marbure' ),
		'heading' => __( 'Crafted for Lasting Beauty', 'marbure' ),
		'text'    => __( 'From Italian marble flooring to custom granite countertops — we bring timeless elegance to every space.', 'marbure' ),
		'btn1'    => __( 'Our Services', 'marbure' ), 'btn1_url' => '/services',
		'btn2'    => __( 'Get a Quote', 'marbure' ),  'btn2_url' => '/contact',
	),
	array(
		'bg'      => '',
		'eyebrow' => __( 'Exceptional Craftsmanship', 'marbure' ),
		'heading' => __( 'Stone Surfaces That Endure', 'marbure' ),
		'text'    => __( 'Travertine, quartzite, onyx, and granite — expertly sourced and installed by our certified stone craftsmen.', 'marbure' ),
		'btn1'    => __( 'Explore Collection', 'marbure' ), 'btn1_url' => '/products',
		'btn2'    => __( 'View Projects', 'marbure' ),      'btn2_url' => '/portfolio',
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
