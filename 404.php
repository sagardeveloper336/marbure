<?php
/**
 * Template: 404 Not Found.
 *
 * @package marbure
 */

get_header();
?>
<section class="error-404-section">
	<div class="container">
		<div class="error-404">

			<div class="error-404__number" aria-hidden="true">404</div>

			<h1 class="error-404__heading">
				<?php esc_html_e( 'Page Not Found', 'marbure' ); ?>
			</h1>
			<p class="error-404__text">
				<?php esc_html_e( 'Sorry, the page you are looking for doesn\'t exist or has been moved. Let us help you find what you need.', 'marbure' ); ?>
			</p>

			<div class="error-404__actions">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
					<i class="fas fa-home" aria-hidden="true"></i>
					<?php esc_html_e( 'Back to Home', 'marbure' ); ?>
				</a>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'marbure_service' ) ); ?>" class="btn btn--outline">
					<?php esc_html_e( 'Our Services', 'marbure' ); ?>
				</a>
			</div>

			<div class="error-404__search">
				<p><?php esc_html_e( 'Or try searching:', 'marbure' ); ?></p>
				<?php get_search_form(); ?>
			</div>

		</div>
	</div>
</section>
<?php
get_footer();
