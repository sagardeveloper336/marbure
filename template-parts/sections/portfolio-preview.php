<?php
/**
 * Homepage section: Portfolio / Case Results preview.
 *
 * @package marbure
 */

$args = array(
	'post_type'      => 'marbure_portfolio',
	'posts_per_page' => 6,
	'no_found_rows'  => true,
	'orderby'        => 'date',
	'order'          => 'DESC',
);
$portfolio = new WP_Query( $args );

if ( ! $portfolio->have_posts() ) return;

$show_filter = marbure_option( 'portfolio_filter', true );
$col_class   = marbure_grid_col_class( 'portfolio', 3 );

$cats = array();
if ( $show_filter ) {
	$cats = get_terms( array(
		'taxonomy'   => 'portfolio_cat',
		'hide_empty' => true,
		'number'     => 10,
	) );
}
?>
<section class="section portfolio-section">
	<div class="container">

		<div class="section__header" data-aos="fade-up">
			<span class="eyebrow"><?php esc_html_e( 'Our Success Stories', 'marbure' ); ?></span>
			<h2 class="section-heading"><?php esc_html_e( 'Notable Case Results', 'marbure' ); ?></h2>
			<p class="section-subheading">
				<?php esc_html_e( 'A track record of securing maximum compensation and favourable outcomes for our clients.', 'marbure' ); ?>
			</p>
		</div>

		<?php if ( $show_filter && ! is_wp_error( $cats ) && $cats ) : ?>
			<div class="portfolio-filter" data-aos="fade-up" role="group" aria-label="<?php esc_attr_e( 'Filter case results by category', 'marbure' ); ?>">
				<button class="portfolio-filter__btn is-active" data-filter="*"><?php esc_html_e( 'All Cases', 'marbure' ); ?></button>
				<?php foreach ( $cats as $cat ) : ?>
					<button
						class="portfolio-filter__btn"
						data-filter=".cat-<?php echo esc_attr( $cat->slug ); ?>"
					><?php echo esc_html( $cat->name ); ?></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="portfolio-grid" data-aos="fade-up" data-aos-delay="100">
			<?php while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>
				<?php
				$cat_slugs   = wp_list_pluck( get_the_terms( get_the_ID(), 'portfolio_cat' ) ?: array(), 'slug' );
				$filter_data = ! empty( $cat_slugs ) ? implode( ' cat-', $cat_slugs ) : '';
				$settlement  = get_post_meta( get_the_ID(), '_portfolio_settlement', true );
				$case_type   = get_post_meta( get_the_ID(), '_portfolio_case_type', true );
				$outcome     = get_post_meta( get_the_ID(), '_portfolio_outcome', true );
				?>
				<div class="portfolio-item<?php echo $filter_data ? ' cat-' . esc_attr( ltrim( $filter_data, ' cat-' ) ) : ''; ?> <?php echo esc_attr( $col_class ); ?>">
					<article class="portfolio-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="portfolio-card__image">
								<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
									<?php the_post_thumbnail( 'marbure-portfolio', array( 'loading' => 'lazy' ) ); ?>
								</a>
								<?php if ( $settlement ) : ?>
									<div class="portfolio-card__badge"><?php echo esc_html( $settlement ); ?></div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<div class="portfolio-card__body">
							<?php if ( $case_type ) : ?>
								<span class="portfolio-card__type"><?php echo esc_html( $case_type ); ?></span>
							<?php endif; ?>
							<h3 class="portfolio-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<?php if ( has_excerpt() ) : ?>
								<p class="portfolio-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
							<?php endif; ?>
							<?php if ( $outcome ) : ?>
								<div class="portfolio-card__outcome">
									<i class="fas fa-check-circle" aria-hidden="true"></i>
									<?php echo esc_html( $outcome ); ?>
								</div>
							<?php endif; ?>
							<a href="<?php the_permalink(); ?>" class="btn--ghost">
								<?php esc_html_e( 'View Case', 'marbure' ); ?>
							</a>
						</div>
					</article>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<div class="section__footer" data-aos="fade-up">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'marbure_portfolio' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'View All Case Results', 'marbure' ); ?>
			</a>
		</div>

	</div>
</section>
