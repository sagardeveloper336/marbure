<?php
/**
 * Template: Single Project.
 *
 * @package marbure
 */

get_header();
?>
<div class="container">
	<div class="content-row content-row--sidebar">

		<main id="main" class="site-main content-area" role="main">
			<?php while ( have_posts() ) : the_post();

				$location  = get_post_meta( get_the_ID(), '_project_location', true );
				$type      = get_post_meta( get_the_ID(), '_project_type', true );
				$area      = get_post_meta( get_the_ID(), '_project_area', true );
				$year      = get_post_meta( get_the_ID(), '_project_completion_year', true );
				$products  = get_post_meta( get_the_ID(), '_project_products_used', true );
				$client    = get_post_meta( get_the_ID(), '_project_client', true );
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'project-single' ); ?>>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="project-single__hero">
						<?php the_post_thumbnail( 'marbure-hero', array( 'loading' => 'eager' ) ); ?>
					</div>
				<?php endif; ?>

				<!-- Meta band -->
				<?php
				$meta_items = array(
					__( 'Location', 'marbure' )   => array( 'icon' => 'fa-map-marker-alt', 'value' => $location ),
					__( 'Type', 'marbure' )       => array( 'icon' => 'fa-building',        'value' => $type ),
					__( 'Area', 'marbure' )       => array( 'icon' => 'fa-vector-square',   'value' => $area ),
					__( 'Completed', 'marbure' )  => array( 'icon' => 'fa-calendar-alt',    'value' => $year ),
				);
				$meta_items = array_filter( $meta_items, function( $m ) { return ! empty( $m['value'] ); } );
				if ( $meta_items ) : ?>
					<div class="project-single__meta-band">
						<?php foreach ( $meta_items as $label => $meta ) : ?>
							<div class="project-single__meta-item">
								<i class="fas <?php echo esc_attr( $meta['icon'] ); ?>" aria-hidden="true"></i>
								<span class="project-single__meta-label"><?php echo esc_html( $label ); ?></span>
								<span class="project-single__meta-value"><?php echo esc_html( $meta['value'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<h1 class="project-single__title"><?php the_title(); ?></h1>

				<div class="entry-content project-single__content">
					<?php the_content(); ?>
				</div>

				<!-- Related Projects -->
				<?php
				$related = new WP_Query( array(
					'post_type'      => 'marbure_project',
					'posts_per_page' => 3,
					'post__not_in'   => array( get_the_ID() ),
					'no_found_rows'  => true,
				) );
				if ( $related->have_posts() ) :
				?>
				<aside class="related-projects">
					<h2 class="related-projects__title"><?php esc_html_e( 'More Projects', 'marbure' ); ?></h2>
					<div class="row">
						<?php while ( $related->have_posts() ) : $related->the_post(); ?>
							<div class="col-md-4">
								<?php get_template_part( 'template-parts/content', 'project' ); ?>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</aside>
				<?php endif; ?>

			</article>

			<?php endwhile; ?>
		</main>

		<aside class="widget-area sidebar-project" role="complementary">
			<div class="sidebar-cta">
				<h3><?php esc_html_e( 'Start Your Project', 'marbure' ); ?></h3>
				<p><?php esc_html_e( 'Like what you see? Get a free quote for your own tiling project — supply, installation, or both.', 'marbure' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="btn btn--primary">
					<?php esc_html_e( 'Get a Free Quote', 'marbure' ); ?>
				</a>
			</div>

			<?php if ( $products ) : ?>
				<div class="sidebar-products-used">
					<h3><?php esc_html_e( 'Tiles Used', 'marbure' ); ?></h3>
					<p><?php echo esc_html( $products ); ?></p>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-main' ) ) : ?>
				<?php dynamic_sidebar( 'sidebar-main' ); ?>
			<?php endif; ?>
		</aside>

	</div>
</div>
<?php
get_footer();
