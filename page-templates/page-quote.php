<?php
/**
 * Template Name: Get a Quote
 * Template Post Type: page
 *
 * Content built entirely with Elementor.
 * Place your quote/contact form via CF7, WPForms, or Elementor's Form widget.
 *
 * @package marbure
 */

get_header();
?>
<main id="main" class="site-main quote-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php
get_footer();
