<?php
/**
 * Template: blog index (fallback for all views not matched by a more specific template).
 *
 * @package marbure
 */

get_header();
?>
<div class="container">
	<div class="content-row content-row--sidebar">

		<main id="main" class="site-main content-area" role="main">

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header class="archive-header">
					<h1 class="archive-header__title"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php if ( have_posts() ) : ?>
				<div class="blog-grid blog-grid--list">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'post' );
					endwhile;
					?>
				</div>
				<?php marbure_pagination(); ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>

		</main>

		<?php get_sidebar(); ?>

	</div>
</div>
<?php
get_footer();
