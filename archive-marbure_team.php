<?php
/**
 * Template: Attorneys directory archive.
 *
 * @package marbure
 */

get_header();

$depts = get_terms( array(
	'taxonomy'   => 'team_dept',
	'hide_empty' => true,
) );
?>
<div class="team-archive">

	<div class="container">

		<?php if ( ! is_wp_error( $depts ) && $depts ) : ?>
			<div class="tax-filter" role="group" aria-label="<?php esc_attr_e( 'Filter attorneys by department', 'marbure' ); ?>">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'marbure_team' ) ); ?>"
				   class="tax-filter__btn<?php echo ! is_tax() ? ' is-active' : ''; ?>">
					<?php esc_html_e( 'All Attorneys', 'marbure' ); ?>
				</a>
				<?php foreach ( $depts as $dept ) : ?>
					<a href="<?php echo esc_url( get_term_link( $dept ) ); ?>"
					   class="tax-filter__btn<?php echo is_tax( 'team_dept', $dept ) ? ' is-active' : ''; ?>">
						<?php echo esc_html( $dept->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<div class="team-grid">
				<?php
				$col_class = marbure_grid_col_class( 'team', 4 );
				while ( have_posts() ) : the_post(); ?>
					<div class="<?php echo esc_attr( $col_class ); ?>">
						<?php get_template_part( 'template-parts/content', 'team' ); ?>
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
