<?php
/**
 * Template: Projects archive with Isotope filter.
 *
 * @package marbure
 */

get_header();

$col_class = marbure_grid_col_class( 'project', 3 );

$cats = get_terms( array(
	'taxonomy'   => 'project_cat',
	'hide_empty' => true,
) );
?>
<div class="projects-archive">
	<div class="container">

		<?php if ( ! is_wp_error( $cats ) && $cats ) : ?>
			<div class="tax-filter" role="group" aria-label="<?php esc_attr_e( 'Filter projects by category', 'marbure' ); ?>" data-aos="fade-up">
				<button class="tax-filter__btn is-active js-filter-btn" data-filter="*"><?php esc_html_e( 'All Projects', 'marbure' ); ?></button>
				<?php foreach ( $cats as $term ) : ?>
					<button class="tax-filter__btn js-filter-btn" data-filter=".term-<?php echo esc_attr( $term->slug ); ?>">
						<?php echo esc_html( $term->name ); ?>
					</button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<div class="projects-grid js-portfolio-grid">
				<?php while ( have_posts() ) : the_post();
					$term_slugs   = wp_list_pluck( get_the_terms( get_the_ID(), 'project_cat' ) ?: array(), 'slug' );
					$term_classes = ! empty( $term_slugs )
						? ' ' . implode( ' ', array_map( function( $s ) { return 'term-' . sanitize_html_class( $s ); }, $term_slugs ) )
						: '';
				?>
					<div class="project-item<?php echo esc_attr( $term_classes ); ?> <?php echo esc_attr( $col_class ); ?>">
						<?php get_template_part( 'template-parts/content', 'project' ); ?>
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
