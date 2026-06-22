<?php
/**
 * Title: Testimonials Carousel
 * Slug: marbure/testimonials-carousel
 * Categories: featured
 * Description: Client testimonial cards with star ratings, quotes, and author details.
 * Note: Dynamic carousel effect requires the Swiper JS widget. This pattern shows
 *       three static testimonial cards in a responsive column layout.
 */
?>
<!-- wp:group {"align":"full","style":{"color":{"background":"#F8F8F8"},"spacing":{"padding":{"top":"5rem","bottom":"5rem","left":"2rem","right":"2rem"}}},"className":"marbure-testimonials-section"} -->
<div class="wp-block-group alignfull marbure-testimonials-section" style="background-color:#F8F8F8;padding-top:5rem;padding-bottom:5rem;padding-left:2rem;padding-right:2rem">

	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"0.5rem","margin":{"bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide" style="margin-bottom:3rem">
		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.8125rem","fontWeight":"600","letterSpacing":"0.12em","textTransform":"uppercase"},"color":{"text":"#CF9776"}}} -->
		<p class="has-text-align-center has-text-color" style="color:#CF9776;font-size:0.8125rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase">Client Stories</p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"2.5rem","fontWeight":"700"},"color":{"text":"#0A1E3F"}},"fontFamily":"heading"} -->
		<h2 class="wp-block-heading has-text-align-center has-text-color has-heading-font-family" style="color:#0A1E3F;font-size:2.5rem;font-weight:700">What Our Clients Say</h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"align":"wide","isStackedOnMobile":true,"style":{"spacing":{"blockGap":"1.5rem"}}} -->
	<div class="wp-block-columns alignwide">

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"2rem","right":"2rem"}}},"className":"marbure-testimonial-card"} -->
			<div class="wp-block-group marbure-testimonial-card" style="background-color:#ffffff;border-radius:8px;padding:2rem">
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem"},"color":{"text":"#CF9776"}}} -->
				<p class="has-text-color" style="color:#CF9776;font-size:1.5rem">★★★★★</p>
				<!-- /wp:paragraph -->
				<!-- wp:quote {"style":{"typography":{"fontSize":"1rem","fontStyle":"italic","lineHeight":"1.75"},"color":{"text":"#3D3D3D"},"spacing":{"margin":{"top":"0","bottom":"1.5rem"}}}} -->
				<blockquote class="wp-block-quote has-text-color" style="color:#3D3D3D;font-size:1rem;font-style:italic;line-height:1.75;margin-top:0;margin-bottom:1.5rem"><p>"The team secured a $2.5M settlement I never thought possible. They treated my case with incredible care and professionalism throughout."</p><cite>Robert Martinez — Personal Injury Client</cite></blockquote>
				<!-- /wp:quote -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"2rem","right":"2rem"}}},"className":"marbure-testimonial-card"} -->
			<div class="wp-block-group marbure-testimonial-card" style="background-color:#ffffff;border-radius:8px;padding:2rem">
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem"},"color":{"text":"#CF9776"}}} -->
				<p class="has-text-color" style="color:#CF9776;font-size:1.5rem">★★★★★</p>
				<!-- /wp:paragraph -->
				<!-- wp:quote {"style":{"typography":{"fontSize":"1rem","fontStyle":"italic","lineHeight":"1.75"},"color":{"text":"#3D3D3D"},"spacing":{"margin":{"top":"0","bottom":"1.5rem"}}}} -->
				<blockquote class="wp-block-quote has-text-color" style="color:#3D3D3D;font-size:1rem;font-style:italic;line-height:1.75;margin-top:0;margin-bottom:1.5rem"><p>"Professional, compassionate, and relentlessly effective. I will always recommend Marbure Law Firm to anyone in need."</p><cite>Linda Chen — Family Law Client</cite></blockquote>
				<!-- /wp:quote -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"2rem","right":"2rem"}}},"className":"marbure-testimonial-card"} -->
			<div class="wp-block-group marbure-testimonial-card" style="background-color:#ffffff;border-radius:8px;padding:2rem">
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5rem"},"color":{"text":"#CF9776"}}} -->
				<p class="has-text-color" style="color:#CF9776;font-size:1.5rem">★★★★★</p>
				<!-- /wp:paragraph -->
				<!-- wp:quote {"style":{"typography":{"fontSize":"1rem","fontStyle":"italic","lineHeight":"1.75"},"color":{"text":"#3D3D3D"},"spacing":{"margin":{"top":"0","bottom":"1.5rem"}}}} -->
				<blockquote class="wp-block-quote has-text-color" style="color:#3D3D3D;font-size:1rem;font-style:italic;line-height:1.75;margin-top:0;margin-bottom:1.5rem"><p>"They turned a complicated business dispute into a clear victory. Outstanding strategic thinking and communication from start to finish."</p><cite>David Thompson — Business Litigation Client</cite></blockquote>
				<!-- /wp:quote -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
