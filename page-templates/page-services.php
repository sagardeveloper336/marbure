<?php
/**
 * Template Name: Services
 * Template Post Type: page
 *
 * Content built entirely with Elementor.
 *
 * @package marbure
 */

get_header();
?>
<main id="main" class="site-main services-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php
get_footer();
