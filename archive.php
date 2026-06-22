<?php
/**
 * Template: date / author / category / tag archive.
 *
 * CPT archives use their own archive-{cpt}.php files.
 *
 * @package marbure
 */

get_header();
?>
<div class="container">
	<div class="content-row content-row--sidebar">

		<main id="main" class="site-main content-area" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="archive-header">
					<?php
					the_archive_title( '<h1 class="archive-header__title">', '</h1>' );
					the_archive_description( '<div class="archive-header__description">', '</div>' );
					?>
				</header>

				<div class="blog-grid blog-grid--archive">
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
