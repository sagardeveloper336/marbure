<?php
/**
 * Homepage section: Projects Preview.
 * Queries recent marbure_project CPT with optional Isotope filter.
 *
 * @package marbure
 */

$args = array(
	'post_type'      => 'marbure_project',
	'posts_per_page' => 6,
	'no_found_rows'  => true,
	'orderby'        => 'date',
	'order'          => 'DESC',
);
$projects = new WP_Query( $args );

if ( ! $projects->have_posts() ) return;

$show_filter = marbure_option( 'project_filter', true );
$col_class   = marbure_grid_col_class( 'project', 3 );

$cats = array();
if ( $show_filter ) {
	$cats = get_terms( array(
		'taxonomy'   => 'project_cat',
		'hide_empty' => true,
		'number'     => 10,
	) );
}
?>
<section class="section projects-section">
	<div class="container">

		<div class="section__header" data-aos="fade-up">
			<span class="eyebrow"><?php esc_html_e( 'Our Work', 'marbure' ); ?></span>
			<h2 class="section-heading"><?php esc_html_e( 'Recent Projects', 'marbure' ); ?></h2>
			<p class="section-subheading">
				<?php esc_html_e( 'From cosy residential bathrooms to large-scale commercial flooring — explore some of our completed installations.', 'marbure' ); ?>
			</p>
		</div>

		<?php if ( $show_filter && ! is_wp_error( $cats ) && $cats ) : ?>
			<div class="tax-filter" role="group" aria-label="<?php esc_attr_e( 'Filter projects by category', 'marbure' ); ?>" data-aos="fade-up">
				<button class="tax-filter__btn is-active js-filter-btn" data-filter="*"><?php esc_html_e( 'All Projects', 'marbure' ); ?></button>
				<?php foreach ( $cats as $cat ) : ?>
					<button class="tax-filter__btn js-filter-btn" data-filter=".term-<?php echo esc_attr( $cat->slug ); ?>">
						<?php echo esc_html( $cat->name ); ?>
					</button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="projects-grid js-portfolio-grid" data-aos="fade-up" data-aos-delay="100">
			<?php while ( $projects->have_posts() ) : $projects->the_post();
				$term_slugs   = wp_list_pluck( get_the_terms( get_the_ID(), 'project_cat' ) ?: array(), 'slug' );
				$term_classes = ! empty( $term_slugs )
					? ' ' . implode( ' ', array_map( function( $s ) { return 'term-' . sanitize_html_class( $s ); }, $term_slugs ) )
					: '';
				$location = get_post_meta( get_the_ID(), '_project_location', true );
				$type     = get_post_meta( get_the_ID(), '_project_type', true );
				$area     = get_post_meta( get_the_ID(), '_project_area', true );
			?>
				<div class="project-item<?php echo esc_attr( $term_classes ); ?> <?php echo esc_attr( $col_class ); ?>">
					<article class="project-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="project-card__image">
								<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
									<?php the_post_thumbnail( 'marbure-portfolio', array( 'loading' => 'lazy' ) ); ?>
								</a>
								<div class="project-card__overlay">
									<?php if ( $location ) : ?>
										<span class="project-card__location">
											<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
											<?php echo esc_html( $location ); ?>
										</span>
									<?php endif; ?>
									<?php if ( $type ) : ?>
										<span class="project-card__type"><?php echo esc_html( $type ); ?></span>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="project-card__body">
							<h3 class="project-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<?php if ( $area ) : ?>
								<span class="project-card__area">
									<i class="fas fa-vector-square" aria-hidden="true"></i>
									<?php echo esc_html( $area ); ?>
								</span>
							<?php endif; ?>
							<?php if ( has_excerpt() ) : ?>
								<p class="project-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
							<?php endif; ?>
							<a href="<?php the_permalink(); ?>" class="btn--ghost"><?php esc_html_e( 'View Project', 'marbure' ); ?></a>
						</div>
					</article>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<div class="section__footer" data-aos="fade-up">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'marbure_project' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'View All Projects', 'marbure' ); ?>
			</a>
		</div>

	</div>
</section>
