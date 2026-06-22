<?php
/**
 * Template Name: Services
 * Template Post Type: page
 *
 * @package marbure
 */

get_header();

$services = array(
	array(
		'icon'    => 'fas fa-store',
		'title'   => __( 'Tile Supply', 'marbure' ),
		'text'    => __( 'We stock thousands of tiles from the world\'s leading manufacturers. Whether you need floor tiles, wall tiles, outdoor paving, or decorative mosaics, our showroom carries an unrivalled selection of sizes, materials, and finishes.', 'marbure' ),
		'points'  => array(
			__( 'Porcelain, ceramic, marble, slate, and more', 'marbure' ),
			__( 'Sizes from mosaic to 1200×1200mm large format', 'marbure' ),
			__( 'Matte, satin, polished, textured, and slip-resistant finishes', 'marbure' ),
			__( 'Bulk stock available for commercial projects', 'marbure' ),
		),
	),
	array(
		'icon'    => 'fas fa-hard-hat',
		'title'   => __( 'Professional Installation', 'marbure' ),
		'text'    => __( 'Our certified tiling teams handle residential bathrooms, kitchens, and living areas as well as large-scale commercial floors and facades. Every installation includes surface preparation, waterproofing where required, and a quality-controlled final inspection.', 'marbure' ),
		'points'  => array(
			__( 'Residential and commercial projects of any scale', 'marbure' ),
			__( 'Full surface preparation and levelling', 'marbure' ),
			__( 'Waterproofing and wet-area compliance', 'marbure' ),
			__( 'Clean, punctual, and fully insured teams', 'marbure' ),
		),
	),
	array(
		'icon'    => 'fas fa-pencil-ruler',
		'title'   => __( 'Design Consultation', 'marbure' ),
		'text'    => __( 'Not sure where to start? Book a free consultation with one of our design specialists. We\'ll visit your space, understand your style and budget, and guide you to the perfect tile selection and layout plan.', 'marbure' ),
		'points'  => array(
			__( 'Free in-showroom or on-site consultation', 'marbure' ),
			__( 'Mood boards, material samples, and layout mockups', 'marbure' ),
			__( 'Budget planning and quantity calculations', 'marbure' ),
			__( 'Ongoing support from selection to completion', 'marbure' ),
		),
	),
	array(
		'icon'    => 'fas fa-truck',
		'title'   => __( 'Delivery & Logistics', 'marbure' ),
		'text'    => __( 'We offer same-day or next-day delivery on in-stock items across the local area, and scheduled deliveries for larger commercial orders. Our logistics team ensures tiles arrive safely, on time, and in perfect condition.', 'marbure' ),
		'points'  => array(
			__( 'Same-day delivery on in-stock items', 'marbure' ),
			__( 'Careful packaging to prevent breakage', 'marbure' ),
			__( 'Commercial project scheduling available', 'marbure' ),
			__( 'Returns and exchange policy on undamaged goods', 'marbure' ),
		),
	),
);
?>

<main id="main" class="site-main services-page">
	<div class="container">

		<div class="entry-content page-content">
			<?php the_content(); ?>
		</div>

		<div class="services-list">
			<?php foreach ( $services as $i => $service ) :
				$reverse = ( $i % 2 !== 0 ) ? ' services-list__item--reverse' : '';
			?>
				<div class="services-list__item<?php echo esc_attr( $reverse ); ?>" data-aos="fade-up">
					<div class="services-list__icon-col">
						<div class="services-list__icon">
							<i class="<?php echo esc_attr( $service['icon'] ); ?>" aria-hidden="true"></i>
						</div>
					</div>
					<div class="services-list__content-col">
						<h2 class="services-list__title"><?php echo esc_html( $service['title'] ); ?></h2>
						<p class="services-list__text"><?php echo esc_html( $service['text'] ); ?></p>
						<?php if ( $service['points'] ) : ?>
							<ul class="services-list__points">
								<?php foreach ( $service['points'] as $point ) : ?>
									<li>
										<i class="fas fa-check-circle" aria-hidden="true"></i>
										<?php echo esc_html( $point ); ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- CTA -->
		<div class="services-page__cta" data-aos="fade-up">
			<h2><?php esc_html_e( 'Ready to Get Started?', 'marbure' ); ?></h2>
			<p><?php esc_html_e( 'Contact us today for a free quote or visit our showroom to explore the full collection.', 'marbure' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="btn btn--primary">
				<?php esc_html_e( 'Get a Free Quote', 'marbure' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'Visit Our Showroom', 'marbure' ); ?>
			</a>
		</div>

	</div>
</main>

<?php
get_footer();
