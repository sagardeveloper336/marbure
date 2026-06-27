<?php
/**
 * Site Header — Mobile off-canvas panel.
 * Slides in from the right; JS in js/src/mobile-menu.js handles open/close.
 *
 * @package marbure
 */

$cta_label = marbure_option( 'header_cta_label', __( 'Get a Free Quote', 'marbure' ) );
$cta_url   = marbure_option( 'header_cta_url', '/contact' );
?>
<nav
	id="mobile-menu"
	class="mobile-menu"
	aria-label="<?php esc_attr_e( 'Mobile Navigation', 'marbure' ); ?>"
	aria-hidden="true"
>
	<div class="mobile-menu__header">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<span class="site-title"><?php bloginfo( 'name' ); ?></span>
		<?php endif; ?>

		<button
			class="mobile-menu__close"
			aria-label="<?php esc_attr_e( 'Close menu', 'marbure' ); ?>"
		>
			<i class="fas fa-times" aria-hidden="true"></i>
		</button>
	</div>

	<div class="mobile-menu__nav">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'mobile',
				'menu_id'        => 'mobile-menu-list',
				'menu_class'     => 'mobile-nav-list',
				'container'      => false,
				'fallback_cb'    => function () {
					// Fall back to primary menu if no mobile menu is assigned.
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'mobile-nav-list',
						)
					);
				},
			)
		);
		?>
	</div>

	<?php if ( $cta_label && $cta_url ) : ?>
		<div class="mobile-menu__footer">
			<a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn--primary">
				<?php echo esc_html( $cta_label ); ?>
			</a>
		</div>
	<?php endif; ?>
</nav>
