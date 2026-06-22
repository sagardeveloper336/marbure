<?php
/**
 * Template: Case Results archive.
 *
 * @package marbure
 */

get_header();

$terms = get_terms( array(
	'taxonomy'   => 'portfolio_cat',
	'hide_empty' => true,
) );
?>
<div class="portfolio-archive">

	<div class="container">

		<?php if ( ! is_wp_error( $terms ) && $terms ) : ?>
			<div class="tax-filter" role="group" aria-label="<?php esc_attr_e( 'Filter by case type', 'marbure' ); ?>">
				<button class="tax-filter__btn is-active js-filter-btn" data-filter="*"><?php esc_html_e( 'All Cases', 'marbure' ); ?></button>
				<?php foreach ( $terms as $term ) : ?>
					<button
						class="tax-filter__btn js-filter-btn"
						data-filter=".term-<?php echo esc_attr( $term->slug ); ?>">
						<?php echo esc_html( $term->name ); ?>
					</button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<div class="portfolio-grid js-portfolio-grid">
				<?php
				$col_class = marbure_grid_col_class( 'portfolio', 3 );
				while ( have_posts() ) : the_post();
					$term_slugs = wp_list_pluck( get_the_terms( get_the_ID(), 'portfolio_cat' ) ?: array(), 'slug' );
					$term_classes = ! empty( $term_slugs ) ? ' ' . implode( ' term-', array_map( 'sanitize_html_class', array_merge( array(''), $term_slugs ) ) ) : '';
					?>
					<div class="portfolio-item<?php echo esc_attr( $term_classes ); ?> <?php echo esc_attr( $col_class ); ?>">
						<?php get_template_part( 'template-parts/content', 'portfolio' ); ?>
					</div>
				<?php endwhile; ?>
			</div>
			<?php marbure_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>

	</div>

</div>
<?php
get_footer();
