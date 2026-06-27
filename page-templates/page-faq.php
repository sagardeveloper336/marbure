<?php
/**
 * Template Name: FAQ
 * Template Post Type: page
 *
 * Content built entirely with Elementor.
 * Use the FAQ Accordion widget from the Marbure widget category.
 * FAQPage JSON-LD is output by inc/schema.php when this template is assigned.
 *
 * @package marbure
 */

get_header();
?>
<main id="main" class="site-main faq-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php
get_footer();
