<?php
/**
 * Title: Portfolio Preview
 * Slug: marbure/portfolio-preview
 * Categories: featured
 * Description: Two-column grid of featured case result cards with category, outcome, and settlement.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem","left":"2rem","right":"2rem"}}},"className":"marbure-portfolio-section"} -->
<div class="wp-block-group alignfull marbure-portfolio-section" style="padding-top:5rem;padding-bottom:5rem;padding-left:2rem;padding-right:2rem">

	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"0.5rem","margin":{"bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide" style="margin-bottom:3rem">
		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.8125rem","fontWeight":"600","letterSpacing":"0.12em","textTransform":"uppercase"},"color":{"text":"#CF9776"}}} -->
		<p class="has-text-align-center has-text-color" style="color:#CF9776;font-size:0.8125rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase">Track Record</p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"2.5rem","fontWeight":"700"},"color":{"text":"#0A1E3F"}},"fontFamily":"heading"} -->
		<h2 class="wp-block-heading has-text-align-center has-text-color has-heading-font-family" style="color:#0A1E3F;font-size:2.5rem;font-weight:700">Recent Case Results</h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.0625rem"},"color":{"text":"#6b7280"}}} -->
		<p class="has-text-align-center has-text-color" style="color:#6b7280;font-size:1.0625rem">A track record of successful outcomes that speak for themselves.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"align":"wide","isStackedOnMobile":true,"style":{"spacing":{"blockGap":"1.5rem"}}} -->
	<div class="wp-block-columns alignwide">

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"border":{"radius":"8px"},"color":{"background":"#F8F8F8"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"className":"marbure-portfolio-card"} -->
			<div class="wp-block-group marbure-portfolio-card" style="background-color:#F8F8F8;border-radius:8px;padding:0">
				<!-- wp:image {"sizeSlug":"marbure-portfolio","linkDestination":"none","style":{"border":{"radius":"8px 8px 0 0"}},"aspectRatio":"7/5"} -->
				<figure class="wp-block-image size-marbure-portfolio" style="border-radius:8px 8px 0 0"><img src="" alt="Personal Injury case" /></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}}}} -->
				<div class="wp-block-group" style="padding-top:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem;padding-right:1.5rem">
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"600","textTransform":"uppercase","letterSpacing":"0.08em"},"color":{"text":"#CF9776"}}} -->
					<p class="has-text-color" style="color:#CF9776;font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em">Personal Injury</p>
					<!-- /wp:paragraph -->
					<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.25rem","fontWeight":"700"},"color":{"text":"#0A1E3F"}},"fontFamily":"heading"} -->
					<h3 class="wp-block-heading has-text-color has-heading-font-family" style="color:#0A1E3F;font-size:1.25rem;font-weight:700">Rear-End Collision — Settled for $2.5M</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"style":{"color":{"text":"#6b7280"}}} -->
					<p class="has-text-color" style="color:#6b7280">Successfully secured a $2.5M settlement for a client who suffered serious injuries in a highway collision.</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"border":{"radius":"8px"},"color":{"background":"#F8F8F8"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"className":"marbure-portfolio-card"} -->
			<div class="wp-block-group marbure-portfolio-card" style="background-color:#F8F8F8;border-radius:8px;padding:0">
				<!-- wp:image {"sizeSlug":"marbure-portfolio","linkDestination":"none","style":{"border":{"radius":"8px 8px 0 0"}},"aspectRatio":"7/5"} -->
				<figure class="wp-block-image size-marbure-portfolio" style="border-radius:8px 8px 0 0"><img src="" alt="Business litigation case" /></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}}}} -->
				<div class="wp-block-group" style="padding-top:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem;padding-right:1.5rem">
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"600","textTransform":"uppercase","letterSpacing":"0.08em"},"color":{"text":"#CF9776"}}} -->
					<p class="has-text-color" style="color:#CF9776;font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em">Business Litigation</p>
					<!-- /wp:paragraph -->
					<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.25rem","fontWeight":"700"},"color":{"text":"#0A1E3F"}},"fontFamily":"heading"} -->
					<h3 class="wp-block-heading has-text-color has-heading-font-family" style="color:#0A1E3F;font-size:1.25rem;font-weight:700">Contract Breach — Won $1.2M Award</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"style":{"color":{"text":"#6b7280"}}} -->
					<p class="has-text-color" style="color:#6b7280">Won a $1.2M award for a client whose business partner breached a multi-year commercial agreement.</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2.5rem"}}}} -->
	<div class="wp-block-buttons" style="margin-top:2.5rem">
		<!-- wp:button {"style":{"color":{"text":"#0A1E3F"},"border":{"radius":"4px","color":"#0A1E3F","width":"2px"}},"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color wp-element-button" href="/case-results" style="color:#0A1E3F;border-radius:4px;border-color:#0A1E3F;border-width:2px">View All Case Results</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->
