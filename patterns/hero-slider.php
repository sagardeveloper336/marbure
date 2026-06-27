<?php
/**
 * Title: Hero Slider
 * Slug: marbure/hero-slider
 * Categories: featured, banner
 * Block Types: core/group
 * Description: Full-width hero section with headline, subtext, and two CTA buttons on a dark background.
 */
?>
<!-- wp:group {"align":"full","style":{"color":{"background":"#0A1E3F"},"spacing":{"padding":{"top":"120px","bottom":"120px","left":"2rem","right":"2rem"}}},"textColor":"white","className":"marbure-hero-section"} -->
<div class="wp-block-group alignfull marbure-hero-section has-white-color has-text-color" style="background-color:#0A1E3F;padding-top:120px;padding-bottom:120px;padding-left:2rem;padding-right:2rem">

	<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.8125rem","fontStyle":"normal","fontWeight":"600","letterSpacing":"0.12em","textTransform":"uppercase"},"color":{"text":"#CF9776"}}} -->
	<p class="has-text-align-center has-text-color" style="color:#CF9776;font-size:0.8125rem;font-style:normal;font-weight:600;letter-spacing:0.12em;text-transform:uppercase">Premium Marble &amp; Stone Since 2012</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"clamp(2.25rem,5vw,3.75rem)","fontWeight":"700","lineHeight":"1.15"},"color":{"text":"#ffffff"}},"fontFamily":"heading"} -->
	<h1 class="wp-block-heading has-text-align-center has-text-color has-heading-font-family" style="color:#ffffff;font-size:clamp(2.25rem,5vw,3.75rem);font-weight:700;line-height:1.15">Elevate Every Surface</h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.125rem","lineHeight":"1.7"},"color":{"text":"#cbd5e1"},"spacing":{"margin":{"top":"1.25rem","bottom":"2.5rem"}}}} -->
	<p class="has-text-align-center has-text-color" style="color:#cbd5e1;font-size:1.125rem;line-height:1.7;margin-top:1.25rem;margin-bottom:2.5rem">Premium marble, granite, and natural stone surfaces for homes and businesses that demand perfection. Get a free, no-obligation quote today.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"1rem"}}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"style":{"color":{"background":"#CF9776","text":"#ffffff"},"border":{"radius":"4px"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"1.75rem","right":"1.75rem"}}},"fontSize":"base"} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="/contact" style="background-color:#CF9776;color:#ffffff;border-radius:4px;padding-top:0.875rem;padding-bottom:0.875rem;padding-left:1.75rem;padding-right:1.75rem">Get a Free Quote</a></div>
		<!-- /wp:button -->
		<!-- wp:button {"style":{"color":{"text":"#ffffff"},"border":{"radius":"4px","color":"#ffffff","width":"2px"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"1.75rem","right":"1.75rem"}}},"fontSize":"base","className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color wp-element-button" href="/services" style="color:#ffffff;border-radius:4px;border-color:#ffffff;border-width:2px;padding-top:0.875rem;padding-bottom:0.875rem;padding-left:1.75rem;padding-right:1.75rem">Our Services</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->
