<?php
/**
 * Template Name: Home
 * Template Post Type: page
 *
 * Full-width homepage template — assembles all sections in order.
 *
 * @package marbure
 */

get_header();
?>

<main id="main" class="site-main home-main">

	<?php get_template_part( 'template-parts/sections/hero-slider' ); ?>

	<?php get_template_part( 'template-parts/sections/featured-collections' ); ?>

	<?php get_template_part( 'template-parts/sections/marquee-strip' ); ?>

	<?php get_template_part( 'template-parts/sections/why-choose-us' ); ?>

	<?php get_template_part( 'template-parts/sections/stats-counter' ); ?>

	<?php get_template_part( 'template-parts/sections/projects-preview' ); ?>

	<?php get_template_part( 'template-parts/sections/services-overview' ); ?>

	<?php get_template_part( 'template-parts/sections/testimonials-carousel' ); ?>

	<?php get_template_part( 'template-parts/sections/cta-band' ); ?>

	<?php get_template_part( 'template-parts/sections/blog-grid' ); ?>

</main>

<?php
get_footer();
