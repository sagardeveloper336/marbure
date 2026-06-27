<?php
/**
 * Template Name: Home v2
 * Template Post Type: page
 *
 * Homepage variant 2 — content built entirely with Elementor.
 *
 * @package marbure
 */

get_header();
?>
<main id="main" class="site-main home-main home-main--v2">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php
get_footer();
