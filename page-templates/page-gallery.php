<?php
/**
 * Template Name: Gallery
 * Template Post Type: page
 *
 * Content built entirely with Elementor.
 * Use the Gallery Grid widget from the Marbure widget category (GLightbox powered).
 *
 * @package marbure
 */

get_header();
?>
<main id="main" class="site-main gallery-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php
get_footer();
