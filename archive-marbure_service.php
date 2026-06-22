<?php
/**
 * Template: Practice Areas archive.
 *
 * @package marbure
 */

get_header();

$terms = get_terms( array(
	'taxonomy'   => 'service_cat',
	'hide_empty' => true,
) );
?>
<div class="services-archive">

	<div class="container">

		<?php if ( ! is_wp_error( $terms ) && $terms ) : ?>
			<div class="tax-filter" role="group" aria-label="<?php esc_attr_e( 'Filter by practice area category', 'marbure' ); ?>">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'marbure_service' ) ); ?>"
				   class="tax-filter__btn<?php echo ! is_tax() ? ' is-active' : ''; ?>">
					<?php esc_html_e( 'All Areas', 'marbure' ); ?>
				</a>
				<?php foreach ( $terms as $term ) : ?>
					<a href="<?php echo esc_url( get_term_link( $term ) ); ?>"
					   class="tax-filter__btn<?php echo is_tax( 'service_cat', $term ) ? ' is-active' : ''; ?>">
						<?php echo esc_html( $term->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<div class="services-grid row">
				<?php
				$col_class = marbure_grid_col_class( 'service', 3 );
				while ( have_posts() ) : the_post(); ?>
					<div class="<?php echo esc_attr( $col_class ); ?>">
						<?php get_template_part( 'template-parts/content', 'service' ); ?>
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
