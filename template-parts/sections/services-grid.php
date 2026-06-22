<?php
/**
 * Homepage section: Services Grid.
 * Queries featured Practice Areas (marbure_service CPT).
 *
 * @package marbure
 */

// Featured services first; fall back to latest if none marked featured.
$args = array(
	'post_type'      => 'marbure_service',
	'posts_per_page' => 6,
	'no_found_rows'  => true,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'meta_query'     => array(
		array( 'key' => '_service_featured', 'value' => '1', 'compare' => '=' ),
	),
);
$services = new WP_Query( $args );

if ( ! $services->have_posts() ) {
	unset( $args['meta_query'] );
	$services = new WP_Query( $args );
}

if ( ! $services->have_posts() ) return;

$col_class = marbure_grid_col_class( 'service', 3 );
?>
<section class="section services-section">
	<div class="container">

		<div class="section__header" data-aos="fade-up">
			<span class="eyebrow"><?php esc_html_e( 'What We Do', 'marbure' ); ?></span>
			<h2 class="section-heading"><?php esc_html_e( 'Our Practice Areas', 'marbure' ); ?></h2>
			<p class="section-subheading">
				<?php esc_html_e( 'We offer a comprehensive range of legal services, each delivered with the expertise and dedication your case demands.', 'marbure' ); ?>
			</p>
		</div>

		<div class="services-grid row" data-aos="fade-up" data-aos-delay="100">
			<?php while ( $services->have_posts() ) : $services->the_post(); ?>
				<div class="<?php echo esc_attr( $col_class ); ?>">
					<?php
					$icon    = get_post_meta( get_the_ID(), '_service_icon_class', true ) ?: 'fas fa-balance-scale';
					$tagline = get_post_meta( get_the_ID(), '_service_tagline', true );
					?>
					<div class="service-card">
						<div class="service-card__icon">
							<i class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
						</div>
						<h3 class="service-card__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<?php if ( $tagline ) : ?>
							<p class="service-card__tagline"><?php echo esc_html( $tagline ); ?></p>
						<?php elseif ( has_excerpt() ) : ?>
							<p class="service-card__tagline"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<?php endif; ?>
						<a href="<?php the_permalink(); ?>" class="service-card__link btn--ghost">
							<?php esc_html_e( 'Learn More', 'marbure' ); ?>
						</a>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<div class="section__footer" data-aos="fade-up">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'marbure_service' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'View All Practice Areas', 'marbure' ); ?>
			</a>
		</div>

	</div>
</section>
