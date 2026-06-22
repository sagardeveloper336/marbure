<?php
/**
 * Template Name: Full Width
 * Template Post Type: page
 *
 * No sidebar — full canvas width. Intended for Elementor-built pages.
 *
 * @package marbure
 */

get_header();
?>

<main id="main" class="site-main fullwidth-main">

	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>

</main>

<?php
get_footer();
