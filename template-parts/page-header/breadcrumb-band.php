<?php
/**
 * Page Header — breadcrumb band shown on all inner pages.
 *
 * Background image: current page's featured image if set, else the Kirki option.
 * Overlay color comes from Kirki --page-header-overlay CSS var.
 *
 * @package marbure
 */

$bg_url = marbure_page_header_bg();
$align  = marbure_option( 'page_header_align', 'left' );

$inline_style = $bg_url
	? 'style="background-image: url(' . esc_url( $bg_url ) . ');"'
	: '';
?>
<div
	class="page-header-band<?php echo 'center' === $align ? ' page-header-band--center' : ''; ?>"
	<?php echo $inline_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
>
	<div class="container">
		<div class="page-header-band__inner">

			<h1 class="page-header-band__title">
				<?php
				if ( is_singular() ) {
					the_title();
				} elseif ( is_post_type_archive() ) {
					post_type_archive_title();
				} elseif ( is_category() || is_tag() || is_tax() ) {
					single_term_title();
				} elseif ( is_search() ) {
					printf( esc_html__( 'Search: %s', 'marbure' ), '<span>' . get_search_query() . '</span>' );
				} elseif ( is_404() ) {
					esc_html_e( '404 — Page Not Found', 'marbure' );
				} elseif ( is_home() ) {
					esc_html_e( 'Blog', 'marbure' );
				} elseif ( is_archive() ) {
					the_archive_title();
				} else {
					bloginfo( 'name' );
				}
				?>
			</h1>

			<?php marbure_breadcrumb(); ?>

		</div>
	</div>
</div>
