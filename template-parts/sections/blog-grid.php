<?php
/**
 * Homepage section: Blog Grid — Latest posts.
 *
 * @package marbure
 */

$args = array(
	'post_type'           => 'post',
	'posts_per_page'      => 3,
	'no_found_rows'       => true,
	'ignore_sticky_posts' => true,
	'orderby'             => 'date',
	'order'               => 'DESC',
);
$posts = new WP_Query( $args );

if ( ! $posts->have_posts() ) return;
?>
<section class="section blog-section">
	<div class="container">

		<div class="section__header" data-aos="fade-up">
			<span class="eyebrow"><?php esc_html_e( 'Stone Insights', 'marbure' ); ?></span>
			<h2 class="section-heading"><?php esc_html_e( 'From Our Blog', 'marbure' ); ?></h2>
			<p class="section-subheading">
				<?php esc_html_e( 'Stone care tips, design trends, and inspiration from the Marbure team.', 'marbure' ); ?>
			</p>
		</div>

		<div class="blog-grid" data-aos="fade-up" data-aos-delay="100">
			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
				<article class="blog-card" id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card' ); ?>>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="blog-card__image">
							<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
								<?php the_post_thumbnail( 'marbure-blog', array( 'loading' => 'lazy' ) ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="blog-card__body">
						<div class="blog-card__meta">
							<span class="blog-card__category">
								<?php
								$categories = get_the_category();
								if ( $categories ) {
									echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
								}
								?>
							</span>
							<time class="blog-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
								<i class="fas fa-calendar-alt" aria-hidden="true"></i>
								<?php echo esc_html( get_the_date() ); ?>
							</time>
						</div>

						<h3 class="blog-card__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<p class="blog-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>

						<div class="blog-card__footer">
							<a href="<?php the_permalink(); ?>" class="btn--ghost">
								<?php esc_html_e( 'Read More', 'marbure' ); ?>
							</a>
							<span class="blog-card__read-time">
								<?php
								$word_count = str_word_count( wp_strip_all_tags( get_the_content() ) );
								$minutes    = max( 1, (int) round( $word_count / 200 ) );
								printf( esc_html( _n( '%d min read', '%d min read', $minutes, 'marbure' ) ), $minutes );
								?>
							</span>
						</div>
					</div>

				</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<div class="section__footer" data-aos="fade-up">
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'View All Articles', 'marbure' ); ?>
			</a>
		</div>

	</div>
</section>
