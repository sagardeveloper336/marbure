<?php
/**
 * Template: generic page. Sidebar shown when "Sidebar Main" widget area is active.
 *
 * @package marbure
 */

get_header();
$has_sidebar = is_active_sidebar( 'sidebar-main' );
?>
<div class="container">
	<div class="content-row<?php echo $has_sidebar ? ' content-row--sidebar' : ''; ?>">

		<main id="main" class="site-main content-area" role="main">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile;
			?>
		</main>

		<?php if ( $has_sidebar ) get_sidebar(); ?>

	</div>
</div>
<?php
get_footer();
