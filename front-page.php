<?php
/**
 * Template: Homepage (front page).
 * Assembled from individual section partials in template-parts/sections/.
 *
 * @package marbure
 */

get_header();

get_template_part( 'template-parts/sections/hero-slider' );
get_template_part( 'template-parts/sections/marquee-strip' );
get_template_part( 'template-parts/sections/services-overview' );
get_template_part( 'template-parts/sections/stats-counter' );
get_template_part( 'template-parts/sections/featured-collections' );
get_template_part( 'template-parts/sections/why-choose-us' );
get_template_part( 'template-parts/sections/projects-preview' );
get_template_part( 'template-parts/sections/cta-band' );
get_template_part( 'template-parts/sections/testimonials-carousel' );
get_template_part( 'template-parts/sections/blog-grid' );

get_footer();
