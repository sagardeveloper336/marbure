<?php
/**
 * Homepage section: Why Choose Us.
 *
 * @package marbure
 */

$image   = marbure_option( 'about_image', '' );
$eyebrow = marbure_option( 'about_eyebrow', __( 'Why Choose Marbure', 'marbure' ) );
$heading = marbure_option( 'about_heading', __( 'Quality Tiles & Flooring You Can Trust', 'marbure' ) );
$text    = marbure_option( 'about_subtext', __( 'From premium ceramic and porcelain to natural stone and mosaic, we source the finest tiles from leading manufacturers worldwide. Every product in our collection meets the highest standards of quality, durability, and design.', 'marbure' ) );
$btn     = marbure_option( 'about_btn_label', __( 'About Our Showroom', 'marbure' ) );
$btn_url = marbure_option( 'about_btn_url', '/about' );

$pillars = array(
	array( 'icon' => 'fas fa-gem',           'title' => __( 'Premium Quality', 'marbure' ),      'text' => __( 'Every tile is selected for exceptional durability, finish, and design consistency across batches.', 'marbure' ) ),
	array( 'icon' => 'fas fa-tools',          'title' => __( 'Expert Installation', 'marbure' ),  'text' => __( 'Our certified installers bring decades of experience to every residential and commercial project.', 'marbure' ) ),
	array( 'icon' => 'fas fa-th-large',       'title' => __( 'Vast Selection', 'marbure' ),       'text' => __( 'Thousands of styles, sizes, finishes, and materials — all in one showroom or online catalogue.', 'marbure' ) ),
	array( 'icon' => 'fas fa-shield-alt',     'title' => __( 'Warranty & Support', 'marbure' ),   'text' => __( 'All products come with manufacturer warranty and our after-sales support team is always available.', 'marbure' ) ),
);
?>
<section class="section why-choose-section">
	<div class="container">
		<div class="why-choose__grid">

			<!-- Image Column -->
			<div class="why-choose__image-col" data-aos="fade-right" data-aos-duration="800">
				<div class="why-choose__image-wrap">
					<?php if ( $image ) : ?>
						<img
							src="<?php echo esc_url( $image ); ?>"
							alt="<?php esc_attr_e( 'Our tile showroom', 'marbure' ); ?>"
							loading="lazy"
						>
					<?php else : ?>
						<div class="why-choose__image-placeholder"></div>
					<?php endif; ?>

					<div class="why-choose__badge" aria-hidden="true">
						<span class="why-choose__badge-number">15+</span>
						<span class="why-choose__badge-label"><?php esc_html_e( 'Years of Experience', 'marbure' ); ?></span>
					</div>
				</div>
			</div>

			<!-- Content Column -->
			<div class="why-choose__content-col" data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">

				<?php if ( $eyebrow ) : ?>
					<span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>

				<?php if ( $heading ) : ?>
					<h2 class="section-heading"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $text ) : ?>
					<p class="section-subheading"><?php echo esc_html( $text ); ?></p>
				<?php endif; ?>

				<div class="why-choose__pillars">
					<?php foreach ( $pillars as $pillar ) : ?>
						<div class="why-pillar">
							<div class="why-pillar__icon">
								<i class="<?php echo esc_attr( $pillar['icon'] ); ?>" aria-hidden="true"></i>
							</div>
							<div class="why-pillar__body">
								<h3 class="why-pillar__title"><?php echo esc_html( $pillar['title'] ); ?></h3>
								<p class="why-pillar__text"><?php echo esc_html( $pillar['text'] ); ?></p>
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
