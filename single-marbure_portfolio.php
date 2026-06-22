<?php
/**
 * Template: Single Case Result.
 *
 * @package marbure
 */

get_header();
?>
<div class="container">
	<div class="content-row content-row--sidebar">

		<main id="main" class="site-main content-area" role="main">
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-single' ); ?>>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="portfolio-single__hero">
							<?php the_post_thumbnail( 'marbure-portfolio', array( 'loading' => 'eager' ) ); ?>
						</div>
					<?php endif; ?>

					<?php
					$case_type  = get_post_meta( get_the_ID(), '_portfolio_case_type', true );
					$settlement = get_post_meta( get_the_ID(), '_portfolio_settlement', true );
					$year       = get_post_meta( get_the_ID(), '_portfolio_year', true );
					$outcome    = get_post_meta( get_the_ID(), '_portfolio_outcome', true );

					if ( $case_type || $settlement || $year || $outcome ) : ?>
						<div class="portfolio-single__meta-band">
							<?php if ( $case_type ) : ?>
								<div class="portfolio-single__meta-item">
									<span class="portfolio-single__meta-label"><?php esc_html_e( 'Case Type', 'marbure' ); ?></span>
									<span class="portfolio-single__meta-value"><?php echo esc_html( $case_type ); ?></span>
								</div>
							<?php endif; ?>
							<?php if ( $settlement ) : ?>
								<div class="portfolio-single__meta-item">
									<span class="portfolio-single__meta-label"><?php esc_html_e( 'Settlement', 'marbure' ); ?></span>
									<span class="portfolio-single__meta-value portfolio-single__meta-value--accent"><?php echo esc_html( $settlement ); ?></span>
								</div>
							<?php endif; ?>
							<?php if ( $year ) : ?>
								<div class="portfolio-single__meta-item">
									<span class="portfolio-single__meta-label"><?php esc_html_e( 'Year', 'marbure' ); ?></span>
									<span class="portfolio-single__meta-value"><?php echo esc_html( $year ); ?></span>
								</div>
							<?php endif; ?>
							<?php if ( $outcome ) : ?>
								<div class="portfolio-single__meta-item">
									<span class="portfolio-single__meta-label"><?php esc_html_e( 'Outcome', 'marbure' ); ?></span>
									<span class="portfolio-single__meta-value"><?php echo esc_html( ucfirst( $outcome ) ); ?></span>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<h1 class="portfolio-single__title"><?php the_title(); ?></h1>

					<div class="entry-content portfolio-single__content">
						<?php the_content(); ?>
					</div>

					<?php
					// Related cases.
					$related = new WP_Query( array(
						'post_type'      => 'marbure_portfolio',
						'posts_per_page' => 3,
						'post__not_in'   => array( get_the_ID() ),
						'no_found_rows'  => true,
					) );
					if ( $related->have_posts() ) :
					?>
					<aside class="related-cases">
						<h2 class="related-cases__title"><?php esc_html_e( 'More Case Results', 'marbure' ); ?></h2>
						<div class="portfolio-grid portfolio-grid--related">
							<?php while ( $related->have_posts() ) : $related->the_post(); ?>
								<div><?php get_template_part( 'template-parts/content', 'portfolio' ); ?></div>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					</aside>
					<?php endif; ?>

				</article>

			<?php endwhile; ?>
		</main>

		<aside class="widget-area sidebar-portfolio" role="complementary">
			<div class="sidebar-service__consult">
				<h3><?php esc_html_e( 'Need Legal Help?', 'marbure' ); ?></h3>
				<p><?php esc_html_e( 'Our attorneys have a proven track record. Get a free consultation today.', 'marbure' ); ?></p>
				<a href="<?php echo esc_url( marbure_option( 'hero_btn1_url', '/contact' ) ); ?>" class="btn btn--primary">
					<?php esc_html_e( 'Free Consultation', 'marbure' ); ?>
				</a>
			</div>

			<?php if ( is_active_sidebar( 'sidebar-service' ) ) : ?>
				<?php dynamic_sidebar( 'sidebar-service' ); ?>
			<?php endif; ?>
		</aside>

	</div>
</div>
<?php
get_footer();
