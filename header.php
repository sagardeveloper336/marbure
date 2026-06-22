<?php
/**
 * The site header.
 *
 * Outputs <html>, <head>, wp_head(), the topbar, main header, and mobile menu.
 * The #content div is opened here and closed in footer.php.
 *
 * @package marbure
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main">
		<?php esc_html_e( 'Skip to content', 'marbure' ); ?>
	</a>

	<header id="masthead" class="<?php echo esc_attr( marbure_header_classes() ); ?>">
		<?php if ( marbure_option( 'show_top_bar', true ) ) : ?>
			<?php get_template_part( 'template-parts/header/top-bar' ); ?>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/header/header-main' ); ?>
	</header><!-- #masthead -->

	<?php get_template_part( 'template-parts/header/mobile-off-canvas' ); ?>
	<div class="mobile-overlay" id="marbure-overlay" aria-hidden="true"></div>

	<?php
	// Show page header / breadcrumb band on all inner pages.
	if ( ! is_front_page() && marbure_option( 'show_page_header', true ) ) :
		get_template_part( 'template-parts/page-header/breadcrumb-band' );
	endif;
	?>

	<div id="content" class="site-content">
