<?php
/**
 * JSON-LD structured data output.
 *
 * Outputs schema.org markup in <head> based on the current template context.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

// ─── Helpers ─────────────────────────────────────────────────────────────────

/**
 * Safely encode and echo a schema array as a <script> block.
 *
 * @param array $schema Schema.org data array.
 */
function marbure_schema_print( array $schema ) {
	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT )
		. '</script>' . "\n";
}

/**
 * Return the logo image URL for schema output.
 *
 * @return string
 */
function marbure_schema_logo_url() {
	$logo_id = get_theme_mod( 'custom_logo' );
	if ( $logo_id ) {
		$src = wp_get_attachment_image_src( $logo_id, 'full' );
		if ( ! empty( $src[0] ) ) {
			return $src[0];
		}
	}
	return home_url( '/wp-content/themes/marbure/assets/images/logo.png' );
}

// ─── Site-wide: HomeAndConstructionBusiness + LocalBusiness ──────────────────

function marbure_schema_site() {
	$phone = marbure_option( 'topbar_phone', '' );
	$email = marbure_option( 'topbar_email', '' );

	$schema = array(
		'@context' => 'https://schema.org',
		'@type'    => array( 'HomeAndConstructionBusiness', 'LocalBusiness' ),
		'name'     => get_bloginfo( 'name' ),
		'url'      => home_url( '/' ),
		'logo'     => array(
			'@type' => 'ImageObject',
			'url'   => marbure_schema_logo_url(),
		),
	);

	if ( $phone ) {
		$schema['telephone'] = esc_html( $phone );
	}
	if ( $email ) {
		$schema['email'] = sanitize_email( $email );
	}

	$social_keys = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );
	$same_as     = array();
	foreach ( $social_keys as $key ) {
		$url = marbure_option( 'social_' . $key, '' );
		if ( $url ) {
			$same_as[] = esc_url_raw( $url );
		}
	}
	if ( $same_as ) {
		$schema['sameAs'] = $same_as;
	}

	marbure_schema_print( $schema );
}
add_action( 'wp_head', 'marbure_schema_site', 5 );

// ─── BreadcrumbList ──────────────────────────────────────────────────────────

function marbure_schema_breadcrumb() {
	if ( is_front_page() || is_home() ) {
		return;
	}

	$items = array(
		array(
			'@type'    => 'ListItem',
			'position' => 1,
			'name'     => get_bloginfo( 'name' ),
			'item'     => home_url( '/' ),
		),
	);

	$position = 2;

	if ( is_singular() ) {
		$post          = get_queried_object();
		$post_type_obj = get_post_type_object( $post->post_type );

		if ( $post_type_obj && $post_type_obj->has_archive && 'post' !== $post->post_type && 'page' !== $post->post_type ) {
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $position,
				'name'     => $post_type_obj->labels->name,
				'item'     => get_post_type_archive_link( $post->post_type ),
			);
			$position++;
		}

		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => get_the_title( $post ),
			'item'     => get_permalink( $post ),
		);
	}

	if ( is_archive() ) {
		$queried = get_queried_object();
		$label   = $queried instanceof WP_Term ? $queried->name : ( $queried instanceof WP_Post_Type ? $queried->labels->name : '' );
		if ( $label ) {
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $position,
				'name'     => $label,
				'item'     => get_pagenum_link( 1 ),
			);
		}
	}

	marbure_schema_print(
		array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $items,
		)
	);
}
add_action( 'wp_head', 'marbure_schema_breadcrumb', 6 );

// ─── Article (blog single) ────────────────────────────────────────────────────

function marbure_schema_article() {
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	$post   = get_queried_object();
	$author = get_userdata( $post->post_author );

	$schema = array(
		'@context'         => 'https://schema.org',
		'@type'            => 'Article',
		'headline'         => get_the_title( $post ),
		'datePublished'    => get_the_date( 'c', $post ),
		'dateModified'     => get_the_modified_date( 'c', $post ),
		'author'           => array(
			'@type' => 'Person',
			'name'  => $author ? $author->display_name : get_bloginfo( 'name' ),
		),
		'publisher'        => array(
			'@type' => 'Organization',
			'name'  => get_bloginfo( 'name' ),
			'logo'  => array(
				'@type' => 'ImageObject',
				'url'   => marbure_schema_logo_url(),
			),
		),
		'mainEntityOfPage' => array(
			'@type' => 'WebPage',
			'@id'   => get_permalink( $post ),
		),
	);

	if ( has_post_thumbnail( $post ) ) {
		$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post ), 'marbure-hero' );
		if ( ! empty( $img[0] ) ) {
			$schema['image'] = $img[0];
		}
	}

	marbure_schema_print( $schema );
}
add_action( 'wp_head', 'marbure_schema_article', 7 );

// ─── AggregateRating + Reviews (testimonials page) ───────────────────────────

function marbure_schema_reviews() {
	if ( ! is_page_template( 'page-templates/page-testimonials.php' ) ) {
		return;
	}

	$testimonials = get_posts(
		array(
			'post_type'      => 'marbure_testimonial',
			'posts_per_page' => -1,
			'no_found_rows'  => true,
		)
	);

	if ( empty( $testimonials ) ) {
		return;
	}

	$ratings     = array();
	$review_list = array();

	foreach ( $testimonials as $t ) {
		$rating      = (int) get_post_meta( $t->ID, '_testimonial_rating', true );
		$rating      = max( 1, min( 5, $rating ?: 5 ) );
		$ratings[]   = $rating;

		$review_list[] = array(
			'@type'        => 'Review',
			'reviewRating' => array(
				'@type'       => 'Rating',
				'ratingValue' => $rating,
				'bestRating'  => 5,
				'worstRating' => 1,
			),
			'author'       => array(
				'@type' => 'Person',
				'name'  => get_the_title( $t ),
			),
			'reviewBody'   => wp_strip_all_tags( $t->post_content ),
		);
	}

	$avg = count( $ratings ) ? round( array_sum( $ratings ) / count( $ratings ), 1 ) : 5;

	marbure_schema_print(
		array(
			'@context'        => 'https://schema.org',
			'@type'           => 'HomeAndConstructionBusiness',
			'name'            => get_bloginfo( 'name' ),
			'aggregateRating' => array(
				'@type'       => 'AggregateRating',
				'ratingValue' => $avg,
				'reviewCount' => count( $ratings ),
				'bestRating'  => 5,
				'worstRating' => 1,
			),
			'review'          => $review_list,
		)
	);
}
add_action( 'wp_head', 'marbure_schema_reviews', 7 );
