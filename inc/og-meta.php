<?php
/**
 * Open Graph and Twitter Card meta tags.
 *
 * Outputs <meta> tags in <head> for social sharing previews.
 * Hooked into wp_head at priority 2 (before plugins that might duplicate).
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

/**
 * Resolve the OG image URL for the current page.
 *
 * Priority: featured image → custom logo → first attached image.
 *
 * @return string Absolute image URL or empty string.
 */
function marbure_og_image_url() {
	if ( is_singular() && has_post_thumbnail() ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'marbure-hero' );
		if ( ! empty( $src[0] ) ) {
			return $src[0];
		}
	}

	// Fall back to the custom logo.
	$logo_id = get_theme_mod( 'custom_logo' );
	if ( $logo_id ) {
		$src = wp_get_attachment_image_src( $logo_id, 'full' );
		if ( ! empty( $src[0] ) ) {
			return $src[0];
		}
	}

	return '';
}

/**
 * Resolve the OG description for the current page.
 *
 * @return string Plain-text description (max ~160 chars).
 */
function marbure_og_description() {
	if ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			$desc = $post->post_excerpt
				? $post->post_excerpt
				: wp_trim_words( $post->post_content, 30, '' );
			return wp_strip_all_tags( $desc );
		}
	}

	if ( is_home() || is_front_page() ) {
		$tagline = get_bloginfo( 'description' );
		return $tagline ? $tagline : '';
	}

	if ( is_category() || is_tag() || is_tax() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term && ! empty( $term->description ) ) {
			return wp_strip_all_tags( $term->description );
		}
		return '';
	}

	return wp_strip_all_tags( get_bloginfo( 'description' ) );
}

/**
 * Resolve the OG type for the current page.
 *
 * @return string 'article', 'profile', or 'website'.
 */
function marbure_og_type() {
	if ( is_singular( 'post' ) ) {
		return 'article';
	}
	if ( is_singular( 'marbure_team' ) ) {
		return 'profile';
	}
	return 'website';
}

/**
 * Output all Open Graph and Twitter Card meta tags.
 */
function marbure_og_meta_output() {
	// Bail if a known SEO plugin is active — they handle this themselves.
	if (
		defined( 'WPSEO_VERSION' )       // Yoast SEO
		|| defined( 'RANK_MATH_VERSION' ) // Rank Math
		|| defined( 'AIOSEO_VERSION' )    // All-in-One SEO
	) {
		return;
	}

	$site_name   = get_bloginfo( 'name' );
	$og_type     = marbure_og_type();
	if ( is_singular() ) {
		$og_url = esc_url( get_permalink() );
	} elseif ( is_home() || is_front_page() ) {
		$og_url = esc_url( home_url( '/' ) );
	} else {
		$og_url = esc_url( home_url( add_query_arg( array() ) ) );
	}
	$og_title    = esc_attr( wp_get_document_title() );
	$og_desc     = esc_attr( marbure_og_description() );
	$og_image    = esc_url( marbure_og_image_url() );
	$twitter_acct = esc_attr( marbure_option( 'social_twitter', '' ) );

	echo "\n<!-- Open Graph -->\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
	echo '<meta property="og:type"      content="' . esc_attr( $og_type ) . '">' . "\n";
	echo '<meta property="og:url"       content="' . $og_url . '">' . "\n";
	echo '<meta property="og:title"     content="' . $og_title . '">' . "\n";

	if ( $og_desc ) {
		echo '<meta property="og:description" content="' . $og_desc . '">' . "\n";
	}

	if ( $og_image ) {
		echo '<meta property="og:image" content="' . $og_image . '">' . "\n";
		echo '<meta property="og:image:width"  content="1920">' . "\n";
		echo '<meta property="og:image:height" content="900">' . "\n";
	}

	// Article-specific meta.
	if ( 'article' === $og_type && is_singular( 'post' ) ) {
		$post = get_queried_object();
		echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c', $post ) ) . '">' . "\n";
		echo '<meta property="article:modified_time"  content="' . esc_attr( get_the_modified_date( 'c', $post ) ) . '">' . "\n";
		$categories = get_the_category( $post->ID );
		if ( $categories ) {
			echo '<meta property="article:section" content="' . esc_attr( $categories[0]->name ) . '">' . "\n";
		}
	}

	echo "\n<!-- Twitter Card -->\n";
	echo '<meta name="twitter:card"        content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title"       content="' . $og_title . '">' . "\n";

	if ( $og_desc ) {
		echo '<meta name="twitter:description" content="' . $og_desc . '">' . "\n";
	}

	if ( $og_image ) {
		echo '<meta name="twitter:image" content="' . $og_image . '">' . "\n";
	}

	if ( $twitter_acct ) {
		// Strip URL down to @handle if a full URL was saved.
		$handle = '@' . ltrim( basename( rtrim( $twitter_acct, '/' ) ), '@' );
		echo '<meta name="twitter:site" content="' . esc_attr( $handle ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'marbure_og_meta_output', 2 );
