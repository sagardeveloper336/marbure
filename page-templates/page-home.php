<?php
/**
 * Template Name: Home
 * Template Post Type: page
 *
 * Full-width homepage template — content built entirely with Elementor.
 *
 * @package marbure
 */

get_header();
?>
<main id="main" class="site-main home-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php
get_footer();
