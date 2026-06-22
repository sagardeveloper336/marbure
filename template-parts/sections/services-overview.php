<?php
/**
 * Homepage section: Services Overview.
 * Static section — three core service pillars.
 *
 * @package marbure
 */

$services = array(
	array(
		'icon'  => 'fas fa-store',
		'title' => __( 'Tile Supply', 'marbure' ),
		'text'  => __( 'Thousands of tiles in stock — floor, wall, outdoor, mosaic, and more. We source from the world\'s leading manufacturers so you always find the perfect match.', 'marbure' ),
		'link'  => get_post_type_archive_link( 'marbure_product' ) ?: '#',
		'cta'   => __( 'Browse Products', 'marbure' ),
	),
	array(
		'icon'  => 'fas fa-hard-hat',
		'title' => __( 'Professional Installation', 'marbure' ),
		'text'  => __( 'Our certified tiling teams work on residential and commercial projects of any scale, with meticulous attention to surface prep, grout, and finish quality.', 'marbure' ),
		'link'  => home_url( '/services/' ),
		'cta'   => __( 'Our Process', 'marbure' ),
	),
	array(
		'icon'  => 'fas fa-pencil-ruler',
		'title' => __( 'Design Consultation', 'marbure' ),
		'text'  => __( 'Book a free in-showroom or on-site consultation with one of our design specialists to help you choose the right tile style, size, and layout for your space.', 'marbure' ),
		'link'  => home_url( '/get-a-quote/' ),
		'cta'   => __( 'Book a Consultation', 'marbure' ),
	),
);
?>
<section class="section services-overview-section">
	<div class="container">

		<div class="section__header" data-aos="fade-up">
			<span class="eyebrow"><?php esc_html_e( 'What We Offer', 'marbure' ); ?></span>
			<h2 class="section-heading"><?php esc_html_e( 'Complete Tiling Solutions', 'marbure' ); ?></h2>
			<p class="section-subheading">
				<?php esc_html_e( 'From selecting the right tile to a flawless final installation — we handle every stage of your project.', 'marbure' ); ?>
			</p>
		</div>

		<div class="services-overview__grid row" data-aos="fade-up" data-aos-delay="100">
			<?php foreach ( $services as $service ) : ?>
				<div class="col-md-4">
					<div class="service-overview-card">
						<div class="service-overview-card__icon">
							<i class="<?php echo esc_attr( $service['icon'] ); ?>" aria-hidden="true"></i>
						</div>
						<h3 class="service-overview-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
						<p class="service-overview-card__text"><?php echo esc_html( $service['text'] ); ?></p>
						<?php if ( $service['link'] ) : ?>
							<a href="<?php echo esc_url( $service['link'] ); ?>" class="btn--ghost">
								<?php echo esc_html( $service['cta'] ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
