<?php
/**
 * Template for displaying search forms.
 *
 * Pairs with the pill-input / circular-button styling in the
 * "Search form" section of style.css.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package marbure
 */

$marbure_search_id = wp_unique_id( 'search-field-' );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $marbure_search_id ); ?>" class="screen-reader-text">
		<?php esc_html_e( 'Search for:', 'marbure' ); ?>
	</label>
	<input type="search" id="<?php echo esc_attr( $marbure_search_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'marbure' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit">
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'marbure' ); ?></span>
	</button>
</form>
