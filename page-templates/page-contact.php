<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 *
 * Content built entirely with Elementor.
 * Use the Elementor editor to add your contact form widget and info columns.
 *
 * @package marbure
 */

get_header();
?>
<main id="main" class="site-main contact-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php
get_footer();
