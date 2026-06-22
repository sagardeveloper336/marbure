<?php
/**
 * Content partial: standard blog post card (archive / index).
 *
 * @package marbure
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card' ); ?>>

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
				$cats = get_the_category();
				if ( $cats ) {
					echo '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '">' . esc_html( $cats[0]->name ) . '</a>';
				}
				?>
			</span>
			<time class="blog-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
				<i class="fas fa-calendar-alt" aria-hidden="true"></i>
				<?php echo esc_html( get_the_date() ); ?>
			</time>
		</div>

		<h2 class="blog-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<p class="blog-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>

		<div class="blog-card__footer">
			<a href="<?php the_permalink(); ?>" class="btn--ghost"><?php esc_html_e( 'Read More', 'marbure' ); ?></a>
			<span class="blog-card__author">
				<i class="fas fa-user" aria-hidden="true"></i>
				<?php the_author(); ?>
			</span>
		</div>
	</div>

</article>
