<?php
/**
 * Homepage section: About Intro.
 *
 * @package marbure
 */

$image   = marbure_option( 'about_image', '' );
$eyebrow = marbure_option( 'about_eyebrow', __( 'About Our Firm', 'marbure' ) );
$heading = marbure_option( 'about_heading', __( 'Dedicated Legal Advocates You Can Trust', 'marbure' ) );
$text    = marbure_option( 'about_subtext', __( 'Our law firm is dedicated to delivering trusted legal solutions with professionalism and integrity. We combine deep legal expertise with a compassionate approach to ensure the best outcomes for our clients.', 'marbure' ) );
$btn     = marbure_option( 'about_btn_label', __( 'Learn More About Us', 'marbure' ) );
$btn_url = marbure_option( 'about_btn_url', '/about-us' );

$pillars = array(
	array( 'icon' => 'fas fa-balance-scale', 'title' => __( 'Our Commitment', 'marbure' ),  'text' => __( 'We are dedicated to upholding justice and protecting client rights at every step.', 'marbure' ) ),
	array( 'icon' => 'fas fa-handshake',     'title' => __( 'Our Principles', 'marbure' ),   'text' => __( 'Integrity, transparency, and results define every case we take on.', 'marbure' ) ),
	array( 'icon' => 'fas fa-chart-line',    'title' => __( 'Our Performance', 'marbure' ), 'text' => __( '97% success rate built through diligent preparation and expert advocacy.', 'marbure' ) ),
	array( 'icon' => 'fas fa-shield-alt',    'title' => __( 'Our Vision', 'marbure' ),       'text' => __( 'A world where everyone has equal access to quality legal representation.', 'marbure' ) ),
);
?>
<section class="section about-section">
	<div class="container">
		<div class="about-section__grid">

			<!-- Image Column -->
			<div class="about-section__image-col" data-aos="fade-right" data-aos-duration="800">
				<div class="about-section__image-wrap">
					<?php if ( $image ) : ?>
						<img
							src="<?php echo esc_url( $image ); ?>"
							alt="<?php esc_attr_e( 'About our law firm', 'marbure' ); ?>"
							loading="lazy"
						>
					<?php else : ?>
						<div class="about-section__image-placeholder"></div>
					<?php endif; ?>

					<!-- Floating metric badge -->
					<div class="about-section__badge" aria-hidden="true">
						<span class="about-section__badge-number">97%</span>
						<span class="about-section__badge-label"><?php esc_html_e( 'Success Rate', 'marbure' ); ?></span>
					</div>
				</div>
			</div>

			<!-- Content Column -->
			<div class="about-section__content-col" data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">

				<?php if ( $eyebrow ) : ?>
					<span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>

				<?php if ( $heading ) : ?>
					<h2 class="section-heading"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $text ) : ?>
					<p class="section-subheading"><?php echo esc_html( $text ); ?></p>
				<?php endif; ?>

				<!-- Pillars grid -->
				<div class="about-section__pillars">
					<?php foreach ( $pillars as $pillar ) : ?>
						<div class="about-pillar">
							<div class="about-pillar__icon">
								<i class="<?php echo esc_attr( $pillar['icon'] ); ?>" aria-hidden="true"></i>
							</div>
							<div class="about-pillar__body">
								<h3 class="about-pillar__title"><?php echo esc_html( $pillar['title'] ); ?></h3>
								<p class="about-pillar__text"><?php echo esc_html( $pillar['text'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<?php if ( $btn && $btn_url ) : ?>
					<a href="<?php echo esc_url( $btn_url ); ?>" class="btn btn--primary">
						<?php echo esc_html( $btn ); ?>
					</a>
				<?php endif; ?>

			</div>

		</div>
	</div>
</section>
