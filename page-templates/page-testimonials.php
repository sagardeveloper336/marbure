<?php
/**
 * Template Name: Testimonials
 * Template Post Type: page
 *
 * Content built entirely with Elementor.
 * Use the Testimonial Carousel widget from the Marbure widget category.
 * AggregateRating + Review JSON-LD is output by inc/schema.php when
 * this template is assigned.
 *
 * @package marbure
 */

get_header();
?>
<main id="main" class="site-main testimonials-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php
get_footer();
