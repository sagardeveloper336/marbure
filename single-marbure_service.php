<?php
/**
 * Template: Single Practice Area.
 *
 * @package marbure
 */

get_header();
?>
<div class="container">
	<div class="content-row content-row--sidebar">

		<main id="main" class="site-main content-area" role="main">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'service-single' ); ?>>

					<div class="service-single__icon-row">
						<?php $icon = get_post_meta( get_the_ID(), '_service_icon_class', true ) ?: 'fas fa-balance-scale'; ?>
						<div class="service-single__icon">
							<i class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
						</div>
						<div>
							<?php $tagline = get_post_meta( get_the_ID(), '_service_tagline', true ); ?>
							<?php if ( $tagline ) : ?>
								<p class="service-single__tagline"><?php echo esc_html( $tagline ); ?></p>
							<?php endif; ?>
							<h1 class="service-single__title"><?php the_title(); ?></h1>
						</div>
					</div>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="service-single__thumbnail">
							<?php the_post_thumbnail( 'marbure-service', array( 'loading' => 'lazy' ) ); ?>
						</div>
					<?php endif; ?>

					<div class="entry-content service-single__content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'marbure' ), 'after' => '</div>' ) ); ?>
					</div>

				</article>

				<?php
				// Related services (same category, excluding current).
				$cats = get_the_terms( get_the_ID(), 'service_cat' );
				if ( $cats && ! is_wp_error( $cats ) ) :
					$related = new WP_Query( array(
						'post_type'      => 'marbure_service',
						'posts_per_page' => 3,
						'post__not_in'   => array( get_the_ID() ),
						'no_found_rows'  => true,
						'tax_query'      => array( array(
							'taxonomy' => 'service_cat',
							'field'    => 'term_id',
							'terms'    => wp_list_pluck( $cats, 'term_id' ),
						) ),
					) );
					if ( $related->have_posts() ) :
					?>
					<aside class="related-services">
						<h2 class="related-services__title"><?php esc_html_e( 'Related Practice Areas', 'marbure' ); ?></h2>
						<div class="related-services__grid">
							<?php while ( $related->have_posts() ) : $related->the_post(); ?>
								<?php get_template_part( 'template-parts/content', 'service' ); ?>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					</aside>
					<?php endif; ?>
				<?php endif; ?>

			<?php endwhile; ?>
		</main>

		<aside class="widget-area sidebar-service" role="complementary">
			<div class="sidebar-service__consult">
				<h3><?php esc_html_e( 'Free Consultation', 'marbure' ); ?></h3>
				<p><?php esc_html_e( 'Speak with an attorney today — no obligation, completely confidential.', 'marbure' ); ?></p>
				<a href="<?php echo esc_url( marbure_option( 'hero_btn1_url', '/contact' ) ); ?>" class="btn btn--primary">
					<?php esc_html_e( 'Schedule Now', 'marbure' ); ?>
				</a>
			</div>
			<?php
			// All practice areas list.
			$all_services = new WP_Query( array(
				'post_type'      => 'marbure_service',
				'posts_per_page' => -1,
				'no_found_rows'  => true,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			) );
			if ( $all_services->have_posts() ) :
			?>
			<nav class="sidebar-service__all-areas">
				<h3><?php esc_html_e( 'Practice Areas', 'marbure' ); ?></h3>
				<ul>
					<?php while ( $all_services->have_posts() ) : $all_services->the_post(); ?>
						<li<?php echo get_the_ID() === get_queried_object_id() ? ' class="current"' : ''; ?>>
							<a href="<?php the_permalink(); ?>">
								<i class="fas fa-chevron-right" aria-hidden="true"></i>
								<?php the_title(); ?>
							</a>
						</li>
					<?php endwhile; wp_reset_postdata(); ?>
				</ul>
			</nav>
			<?php endif; ?>
		</aside>

	</div>
</div>
<?php
get_footer();
