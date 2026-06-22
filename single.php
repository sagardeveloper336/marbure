<?php
/**
 * Template: single post.
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
				get_template_part( 'template-parts/content', 'single' );

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous', 'marbure' ) . '</span><span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next', 'marbure' ) . '</span><span class="nav-title">%title</span>',
					)
				);

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile;
			?>
		</main>

		<?php get_sidebar(); ?>

	</div>
</div>
<?php
get_footer();
