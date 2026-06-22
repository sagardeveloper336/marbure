<?php
/**
 * Content partial: single blog post (full view).
 *
 * @package marbure
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>

	<header class="single-post__header">
		<div class="single-post__meta">
			<?php
			$cats = get_the_category();
			if ( $cats ) :
				foreach ( array_slice( $cats, 0, 2 ) as $cat ) :
					echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="single-post__cat">' . esc_html( $cat->name ) . '</a>';
				endforeach;
			endif;
			?>
			<time class="single-post__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
			<span class="single-post__read-time">
				<?php
				$words   = str_word_count( wp_strip_all_tags( get_the_content() ) );
				$minutes = max( 1, (int) round( $words / 200 ) );
				printf( esc_html( _n( '%d min read', '%d min read', $minutes, 'marbure' ) ), $minutes );
				?>
			</span>
		</div>

		<h1 class="single-post__title"><?php the_title(); ?></h1>

		<div class="single-post__byline">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
			<div>
				<span class="single-post__author"><?php the_author(); ?></span>
				<span class="single-post__updated"><?php printf( esc_html__( 'Updated %s', 'marbure' ), esc_html( get_the_modified_date() ) ); ?></span>
			</div>
		</div>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="single-post__thumbnail">
			<?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="single-post__content entry-content">
		<?php
		the_content();
		wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'marbure' ), 'after' => '</div>' ) );
		?>
	</div>

	<footer class="single-post__footer">
		<?php
		$tags = get_the_tags();
		if ( $tags ) :
		?>
			<div class="single-post__tags">
				<span><?php esc_html_e( 'Tags:', 'marbure' ); ?></span>
				<?php foreach ( $tags as $tag ) : ?>
					<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>">#<?php echo esc_html( $tag->name ); ?></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="single-post__share">
			<span><?php esc_html_e( 'Share:', 'marbure' ); ?></span>
			<?php $url = urlencode( get_permalink() ); $title = urlencode( get_the_title() ); ?>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on Facebook', 'marbure' ); ?>">
				<i class="fab fa-facebook-f" aria-hidden="true"></i>
			</a>
			<a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on Twitter', 'marbure' ); ?>">
				<i class="fab fa-x-twitter" aria-hidden="true"></i>
			</a>
			<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $url; ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'marbure' ); ?>">
				<i class="fab fa-linkedin-in" aria-hidden="true"></i>
			</a>
		</div>
	</footer>

</article>
