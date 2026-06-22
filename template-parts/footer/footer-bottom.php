<?php
/**
 * Footer — Bottom bar (copyright + nav links).
 *
 * @package marbure
 */

$copyright = marbure_option( 'footer_copyright_text', '' );

// Replace {year} token with the current year.
$copyright = str_replace( '{year}', date( 'Y' ), $copyright );

if ( ! $copyright ) {
	/* translators: %1$s: current year, %2$s: site name. */
	$copyright = sprintf( esc_html__( '© %1$s %2$s. All rights reserved.', 'marbure' ), date( 'Y' ), get_bloginfo( 'name' ) );
}
?>
<div class="footer-bottom">
	<div class="container">

		<p class="footer-bottom__copyright">
			<?php echo wp_kses_post( $copyright ); ?>
		</p>

		<?php if ( has_nav_menu( 'footer-links' ) ) : ?>
			<nav class="footer-bottom__nav" aria-label="<?php esc_attr_e( 'Footer Links', 'marbure' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-links',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		<?php endif; ?>

	</div>
</div>
