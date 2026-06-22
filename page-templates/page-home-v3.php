<?php
/**
 * Template Name: Home v3
 * Template Post Type: page
 *
 * Homepage variant 3 — team-forward layout; attorneys lead before case results.
 *
 * @package marbure
 */

get_header();
?>

<main id="main" class="site-main home-main home-main--v3">

	<?php get_template_part( 'template-parts/sections/hero-slider' ); ?>

	<?php get_template_part( 'template-parts/sections/about-intro' ); ?>

	<?php get_template_part( 'template-parts/sections/team-grid' ); ?>

	<?php get_template_part( 'template-parts/sections/stats-counter' ); ?>

	<?php get_template_part( 'template-parts/sections/services-grid' ); ?>

	<?php get_template_part( 'template-parts/sections/testimonials-carousel' ); ?>

	<?php get_template_part( 'template-parts/sections/portfolio-preview' ); ?>

	<?php get_template_part( 'template-parts/sections/cta-band' ); ?>

	<?php get_template_part( 'template-parts/sections/marquee-strip' ); ?>

	<?php get_template_part( 'template-parts/sections/blog-grid' ); ?>

</main>

<?php
get_footer();
