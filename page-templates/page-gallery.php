<?php
/**
 * Template Name: Gallery
 * Template Post Type: page
 *
 * Filterable project image gallery with GLightbox.
 *
 * @package marbure
 */

get_header();

$args = array(
	'post_type'      => 'marbure_project',
	'posts_per_page' => -1,
	'no_found_rows'  => true,
	'orderby'        => 'date',
	'order'          => 'DESC',
);
$projects = new WP_Query( $args );

$cats = get_terms( array(
	'taxonomy'   => 'project_cat',
	'hide_empty' => true,
) );
?>

<main id="main" class="site-main gallery-page">
	<div class="container">

		<?php if ( $the_content = get_the_content() ) : ?>
			<div class="entry-content page-content">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>

		<!-- Filter bar -->
		<?php if ( ! is_wp_error( $cats ) && $cats ) : ?>
			<div class="tax-filter gallery-filter" role="group" aria-label="<?php esc_attr_e( 'Filter gallery by project category', 'marbure' ); ?>" data-aos="fade-up">
				<button class="tax-filter__btn is-active js-filter-btn" data-filter="*"><?php esc_html_e( 'All', 'marbure' ); ?></button>
				<?php foreach ( $cats as $cat ) : ?>
					<button class="tax-filter__btn js-filter-btn" data-filter=".cat-<?php echo esc_attr( $cat->slug ); ?>">
						<?php echo esc_html( $cat->name ); ?>
					</button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<!-- Gallery Grid -->
		<?php if ( $projects->have_posts() ) : ?>
			<div class="gallery-grid js-portfolio-grid" data-aos="fade-up" data-aos-delay="100">
				<?php while ( $projects->have_posts() ) : $projects->the_post();
					if ( ! has_post_thumbnail() ) continue;

					$term_slugs   = wp_list_pluck( get_the_terms( get_the_ID(), 'project_cat' ) ?: array(), 'slug' );
					$term_classes = ! empty( $term_slugs )
						? ' ' . implode( ' ', array_map( function( $s ) { return 'cat-' . sanitize_html_class( $s ); }, $term_slugs ) )
						: '';

					$full_src = get_the_post_thumbnail_url( get_the_ID(), 'marbure-hero' );
					$location = get_post_meta( get_the_ID(), '_project_location', true );
				?>
					<div class="gallery-item<?php echo esc_attr( $term_classes ); ?>">
						<a
							href="<?php echo esc_url( $full_src ); ?>"
							class="gallery-item__link glightbox"
							data-gallery="marbure-gallery"
							data-title="<?php echo esc_attr( get_the_title() ); ?>"
							data-description="<?php echo esc_attr( $location ); ?>"
							aria-label="<?php echo esc_attr( sprintf( __( 'View %s project image', 'marbure' ), get_the_title() ) ); ?>"
						>
							<?php the_post_thumbnail( 'marbure-portfolio', array( 'loading' => 'lazy' ) ); ?>
							<div class="gallery-item__overlay">
								<i class="fas fa-search-plus" aria-hidden="true"></i>
								<span class="gallery-item__title"><?php the_title(); ?></span>
							</div>
						</a>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
