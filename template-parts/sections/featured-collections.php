<?php
/**
 * Homepage section: Featured Collections.
 * Queries marbure_product CPT, featured items first.
 *
 * @package marbure
 */

$args = array(
	'post_type'      => 'marbure_product',
	'posts_per_page' => 6,
	'no_found_rows'  => true,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'meta_query'     => array(
		array( 'key' => '_product_featured', 'value' => '1', 'compare' => '=' ),
	),
);
$products = new WP_Query( $args );

if ( ! $products->have_posts() ) {
	unset( $args['meta_query'] );
	$products = new WP_Query( $args );
}

if ( ! $products->have_posts() ) return;

$col_class = marbure_grid_col_class( 'product', 3 );

$cats = get_terms( array(
	'taxonomy'   => 'product_cat',
	'hide_empty' => true,
	'number'     => 10,
) );
?>
<section class="section collections-section">
	<div class="container">

		<div class="section__header" data-aos="fade-up">
			<span class="eyebrow"><?php esc_html_e( 'Our Collections', 'marbure' ); ?></span>
			<h2 class="section-heading"><?php esc_html_e( 'Featured Tiles & Flooring', 'marbure' ); ?></h2>
			<p class="section-subheading">
				<?php esc_html_e( 'Explore our curated selection of premium tiles — from floor to wall, indoor to outdoor.', 'marbure' ); ?>
			</p>
		</div>

		<?php if ( ! is_wp_error( $cats ) && $cats ) : ?>
			<div class="tax-filter" role="group" aria-label="<?php esc_attr_e( 'Filter collections by category', 'marbure' ); ?>" data-aos="fade-up">
				<button class="tax-filter__btn is-active js-filter-btn" data-filter="*"><?php esc_html_e( 'All', 'marbure' ); ?></button>
				<?php foreach ( $cats as $cat ) : ?>
					<button class="tax-filter__btn js-filter-btn" data-filter=".term-<?php echo esc_attr( $cat->slug ); ?>">
						<?php echo esc_html( $cat->name ); ?>
					</button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="collections-grid js-portfolio-grid row" data-aos="fade-up" data-aos-delay="100">
			<?php while ( $products->have_posts() ) : $products->the_post();
				$term_slugs   = wp_list_pluck( get_the_terms( get_the_ID(), 'product_cat' ) ?: array(), 'slug' );
				$term_classes = ! empty( $term_slugs )
					? ' ' . implode( ' ', array_map( function( $s ) { return 'term-' . sanitize_html_class( $s ); }, $term_slugs ) )
					: '';
				$material = get_post_meta( get_the_ID(), '_product_material', true );
				$size     = get_post_meta( get_the_ID(), '_product_size', true );
				$finish   = get_post_meta( get_the_ID(), '_product_finish', true );
			?>
				<div class="collections-item<?php echo esc_attr( $term_classes ); ?> <?php echo esc_attr( $col_class ); ?>">
					<article class="product-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="product-card__image">
								<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
									<?php the_post_thumbnail( 'marbure-portfolio', array( 'loading' => 'lazy' ) ); ?>
								</a>
								<?php if ( $finish ) : ?>
									<span class="product-card__badge"><?php echo esc_html( $finish ); ?></span>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<div class="product-card__body">
							<?php
							$primary_cat = get_the_terms( get_the_ID(), 'product_cat' );
							if ( $primary_cat && ! is_wp_error( $primary_cat ) ) : ?>
								<span class="product-card__cat"><?php echo esc_html( $primary_cat[0]->name ); ?></span>
							<?php endif; ?>
							<h3 class="product-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<?php if ( $material || $size ) : ?>
								<ul class="product-card__meta">
									<?php if ( $material ) : ?>
										<li><i class="fas fa-layer-group" aria-hidden="true"></i> <?php echo esc_html( $material ); ?></li>
									<?php endif; ?>
									<?php if ( $size ) : ?>
										<li><i class="fas fa-expand-alt" aria-hidden="true"></i> <?php echo esc_html( $size ); ?></li>
									<?php endif; ?>
								</ul>
							<?php endif; ?>
							<a href="<?php the_permalink(); ?>" class="btn--ghost"><?php esc_html_e( 'View Details', 'marbure' ); ?></a>
						</div>
					</article>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<div class="section__footer" data-aos="fade-up">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'marbure_product' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'Browse All Products', 'marbure' ); ?>
			</a>
		</div>

	</div>
</section>
