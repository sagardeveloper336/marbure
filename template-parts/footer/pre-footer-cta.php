<?php
/**
 * Footer — Pre-footer CTA band.
 *
 * @package marbure
 */

$heading = marbure_option( 'pre_footer_cta_heading', __( 'Ready to Transform Your Space?', 'marbure' ) );
$text    = marbure_option( 'pre_footer_cta_text', __( 'Request a free, no-obligation quote from our stone specialists today.', 'marbure' ) );
$btn     = marbure_option( 'pre_footer_cta_btn_label', __( 'Request a Free Quote', 'marbure' ) );
$url     = marbure_option( 'pre_footer_cta_btn_url', '/contact' );

if ( ! $heading && ! $btn ) {
	return;
}
?>
<div class="pre-footer-cta">
	<div class="container">

		<div class="pre-footer-cta__text">
			<?php if ( $heading ) : ?>
				<h2><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $text ) : ?>
				<p><?php echo esc_html( $text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $btn && $url ) : ?>
			<div class="pre-footer-cta__action">
				<a href="<?php echo esc_url( $url ); ?>" class="btn btn--outline-white">
					<?php echo esc_html( $btn ); ?>
				</a>
			</div>
		<?php endif; ?>

	</div>
</div>
