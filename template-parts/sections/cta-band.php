<?php
/**
 * Homepage section: CTA Band — dark navy band with two buttons.
 *
 * @package marbure
 */

$heading  = marbure_option( 'cta_band_heading', __( 'Ready to Protect Your Rights?', 'marbure' ) );
$subtext  = marbure_option( 'cta_band_subtext', __( 'Speak with one of our experienced attorneys today. Initial consultations are completely free and confidential.', 'marbure' ) );
$btn1     = marbure_option( 'cta_band_btn1_label', __( 'Schedule Free Consultation', 'marbure' ) );
$btn1_url = marbure_option( 'cta_band_btn1_url', '/contact' );
$btn2     = marbure_option( 'cta_band_btn2_label', __( 'Call Us Now', 'marbure' ) );
$btn2_url = marbure_option( 'cta_band_btn2_url', 'tel:+10000000000' );

if ( ! $heading && ! $btn1 ) return;
?>
<section class="cta-band" data-aos="fade-up">
	<div class="container">
		<div class="cta-band__inner">

			<div class="cta-band__text">
				<?php if ( $heading ) : ?>
					<h2 class="cta-band__heading"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
				<?php if ( $subtext ) : ?>
					<p class="cta-band__subtext"><?php echo esc_html( $subtext ); ?></p>
				<?php endif; ?>
			</div>

			<div class="cta-band__actions">
				<?php if ( $btn1 && $btn1_url ) : ?>
					<a href="<?php echo esc_url( $btn1_url ); ?>" class="btn btn--primary">
						<?php echo esc_html( $btn1 ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $btn2 && $btn2_url ) : ?>
					<a href="<?php echo esc_url( $btn2_url ); ?>" class="btn btn--outline-white">
						<i class="fas fa-phone" aria-hidden="true"></i>
						<?php echo esc_html( $btn2 ); ?>
					</a>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
