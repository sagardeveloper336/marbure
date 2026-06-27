<?php
/**
 * Site Header — Main bar (logo + desktop nav + actions).
 *
 * @package marbure
 */

$cta_label = marbure_option( 'header_cta_label', __( 'Get a Free Quote', 'marbure' ) );
$cta_url   = marbure_option( 'header_cta_url', '/contact' );
?>
<div class="site-header__main">
	<div class="container">
		<div class="site-header__inner">

			<!-- Logo -->
			<div class="site-header__logo">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<span class="site-title"><?php bloginfo( 'name' ); ?></span>
					</a>
				<?php endif; ?>
			</div>

			<!-- Desktop Primary Navigation -->
			<nav id="site-navigation" class="site-header__nav" aria-label="<?php esc_attr_e( 'Primary Navigation', 'marbure' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'nav-menu',
						'container'      => false,
						'fallback_cb'    => false,
						'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
					)
				);
				?>
			</nav><!-- #site-navigation -->

			<!-- Header Actions -->
			<div class="site-header__actions">

				<button
					class="search-toggle"
					aria-label="<?php esc_attr_e( 'Open search', 'marbure' ); ?>"
					data-toggle="search"
				>
					<i class="fas fa-search" aria-hidden="true"></i>
				</button>

				<?php if ( $cta_label && $cta_url ) : ?>
					<a
						href="<?php echo esc_url( $cta_url ); ?>"
						class="header-cta btn btn--primary"
					>
						<?php echo esc_html( $cta_label ); ?>
					</a>
				<?php endif; ?>

				<button
					class="mobile-menu-toggle"
					aria-controls="mobile-menu"
					aria-expanded="false"
					aria-label="<?php esc_attr_e( 'Open mobile menu', 'marbure' ); ?>"
				>
					<span></span>
					<span></span>
					<span></span>
				</button>

			</div>

		</div><!-- .site-header__inner -->
	</div><!-- .container -->
</div><!-- .site-header__main -->
