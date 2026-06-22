<?php
/**
 * Template Name: Get a Quote
 * Template Post Type: page
 *
 * @package marbure
 */

get_header();

$phone = marbure_option( 'topbar_phone', '' );
$email = marbure_option( 'topbar_email', '' );
?>

<main id="main" class="site-main quote-page">
	<div class="container">
		<div class="quote-page__grid">

			<!-- Form Column -->
			<div class="quote-page__form-col" data-aos="fade-right">
				<span class="eyebrow"><?php esc_html_e( 'Free Estimate', 'marbure' ); ?></span>
				<h1 class="quote-page__title"><?php the_title(); ?></h1>
				<p class="quote-page__intro">
					<?php esc_html_e( 'Fill in the form below and one of our team will get back to you within 24 hours with a detailed quote for your tiling project.', 'marbure' ); ?>
				</p>

				<div class="quote-page__form-wrap">
					<?php
					// Output page content — place your CF7 / WPForms shortcode here via the editor.
					the_content();
					?>
				</div>
			</div>

			<!-- Info Column -->
			<div class="quote-page__info-col" data-aos="fade-left" data-aos-delay="100">

				<div class="quote-info-card">
					<h2 class="quote-info-card__title"><?php esc_html_e( 'What to Expect', 'marbure' ); ?></h2>
					<ul class="quote-info-card__steps">
						<li>
							<span class="quote-info-card__step-num">1</span>
							<div>
								<strong><?php esc_html_e( 'Submit Your Request', 'marbure' ); ?></strong>
								<p><?php esc_html_e( 'Tell us about your project — room size, tile preferences, and your timeline.', 'marbure' ); ?></p>
							</div>
						</li>
						<li>
							<span class="quote-info-card__step-num">2</span>
							<div>
								<strong><?php esc_html_e( 'We Get in Touch', 'marbure' ); ?></strong>
								<p><?php esc_html_e( 'A specialist will call or email you within 24 hours to discuss the details.', 'marbure' ); ?></p>
							</div>
						</li>
						<li>
							<span class="quote-info-card__step-num">3</span>
							<div>
								<strong><?php esc_html_e( 'Receive Your Quote', 'marbure' ); ?></strong>
								<p><?php esc_html_e( 'We send a detailed, itemised quote — no hidden costs, no obligations.', 'marbure' ); ?></p>
							</div>
						</li>
					</ul>
				</div>

				<div class="quote-contact-card">
					<h3 class="quote-contact-card__title"><?php esc_html_e( 'Prefer to Call?', 'marbure' ); ?></h3>
					<?php if ( $phone ) : ?>
						<a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $phone ) ); ?>" class="quote-contact-card__phone">
							<i class="fas fa-phone" aria-hidden="true"></i>
							<?php echo esc_html( $phone ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>" class="quote-contact-card__email">
							<i class="fas fa-envelope" aria-hidden="true"></i>
							<?php echo esc_html( antispambot( $email ) ); ?>
						</a>
					<?php endif; ?>
					<p class="quote-contact-card__hours">
						<?php esc_html_e( 'Mon – Sat: 8am – 6pm', 'marbure' ); ?>
					</p>
				</div>

			</div>

		</div>
	</div>
</main>

<?php
get_footer();
