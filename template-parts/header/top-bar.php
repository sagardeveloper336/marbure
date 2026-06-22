<?php
/**
 * Site Header — Top Bar.
 * Phone, email on the left; social icons on the right.
 *
 * @package marbure
 */

$phone = marbure_option( 'topbar_phone', '' );
$email = marbure_option( 'topbar_email', '' );
?>
<div class="site-header__topbar">
	<div class="container">

		<div class="topbar__contact">
			<?php if ( $phone ) : ?>
				<a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $phone ) ); ?>">
					<i class="fas fa-phone-alt" aria-hidden="true"></i>
					<?php echo esc_html( $phone ); ?>
				</a>
			<?php endif; ?>

			<?php if ( $email ) : ?>
				<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>">
					<i class="fas fa-envelope" aria-hidden="true"></i>
					<?php echo esc_html( antispambot( $email ) ); ?>
				</a>
			<?php endif; ?>
		</div>

		<div class="topbar__social">
			<?php marbure_social_links(); ?>
		</div>

	</div>
</div>
