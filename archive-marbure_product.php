<?php
/**
 * Template: Products / Collections archive.
 *
 * @package marbure
 */

get_header();

$col_class   = marbure_grid_col_class( 'product', 3 );
$show_filter = marbure_option( 'product_filter', true );

$filter_taxes = array( 'product_cat', 'product_material', 'product_finish' );
$active_tax   = isset( $_GET['filter_by'] ) ? sanitize_key( $_GET['filter_by'] ) : 'product_cat'; // phpcs:ignore WordPress.Security.NonceVerification
$active_tax   = in_array( $active_tax, $filter_taxes, true ) ? $active_tax : 'product_cat';

$terms = get_terms( array( 'taxonomy' => $active_tax, 'hide_empty' => true ) );
?>
<div class="products-archive">
	<div class="container">

		<?php if ( $show_filter ) : ?>
			<div class="archive-filter-bar" data-aos="fade-up">

				<!-- Taxonomy switcher tabs -->
				<div class="archive-filter-bar__tabs" role="tablist">
					<?php
					$tab_labels = array(
						'product_cat'      => __( 'Category', 'marbure' ),
						'product_material' => __( 'Material', 'marbure' ),
						'product_finish'   => __( 'Finish', 'marbure' ),
					);
					foreach ( $tab_labels as $tax => $label ) :
						$active_class = $active_tax === $tax ? ' is-active' : '';
					?>
						<a
							href="<?php echo esc_url( add_query_arg( 'filter_by', $tax, get_post_type_archive_link( 'marbure_product' ) ) ); ?>"
							class="archive-filter-bar__tab<?php echo esc_attr( $active_class ); ?>"
							role="tab"
						><?php echo esc_html( $label ); ?></a>
					<?php endforeach; ?>
				</div>

				<!-- Term filter links -->
				<?php if ( ! is_wp_error( $terms ) && $terms ) : ?>
					<div class="tax-filter" role="group" aria-label="<?php esc_attr_e( 'Filter by term', 'marbure' ); ?>">
						<a
							href="<?php echo esc_url( get_post_type_archive_link( 'marbure_product' ) ); ?>"
							class="tax-filter__btn<?php echo ! is_tax() ? ' is-active' : ''; ?>"
						><?php esc_html_e( 'All', 'marbure' ); ?></a>
						<?php foreach ( $terms as $term ) : ?>
							<a
								href="<?php echo esc_url( get_term_link( $term ) ); ?>"
								class="tax-filter__btn<?php echo is_tax( $active_tax, $term ) ? ' is-active' : ''; ?>"
							><?php echo esc_html( $term->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<div class="products-grid row">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="<?php echo esc_attr( $col_class ); ?>">
						<?php get_template_part( 'template-parts/content', 'product' ); ?>
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
