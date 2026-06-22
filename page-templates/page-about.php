<?php
/**
 * Template Name: About Us
 * Template Post Type: page
 *
 * @package marbure
 */

get_header();
?>

<main id="main" class="site-main about-main">

	<?php get_template_part( 'template-parts/sections/about-intro' ); ?>

	<?php get_template_part( 'template-parts/sections/stats-counter' ); ?>

	<?php get_template_part( 'template-parts/sections/team-grid' ); ?>

	<?php get_template_part( 'template-parts/sections/testimonials-carousel' ); ?>

	<?php get_template_part( 'template-parts/sections/cta-band' ); ?>

</main>

<?php
get_footer();
