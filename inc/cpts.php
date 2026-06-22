<?php
/**
 * Register Custom Post Types.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

function marbure_register_cpts() {

	// ── Practice Areas ────────────────────────────────────────────────────────
	register_post_type(
		'marbure_service',
		array(
			'labels'        => array(
				'name'               => esc_html__( 'Practice Areas', 'marbure' ),
				'singular_name'      => esc_html__( 'Practice Area', 'marbure' ),
				'add_new'            => esc_html__( 'Add New', 'marbure' ),
				'add_new_item'       => esc_html__( 'Add New Practice Area', 'marbure' ),
				'edit_item'          => esc_html__( 'Edit Practice Area', 'marbure' ),
				'new_item'           => esc_html__( 'New Practice Area', 'marbure' ),
				'view_item'          => esc_html__( 'View Practice Area', 'marbure' ),
				'search_items'       => esc_html__( 'Search Practice Areas', 'marbure' ),
				'not_found'          => esc_html__( 'No practice areas found.', 'marbure' ),
				'not_found_in_trash' => esc_html__( 'No practice areas found in trash.', 'marbure' ),
				'menu_name'          => esc_html__( 'Practice Areas', 'marbure' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'menu_icon'     => 'dashicons-hammer',
			'menu_position' => 5,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			'rewrite'       => array( 'slug' => 'practice-areas', 'with_front' => false ),
			'show_in_rest'  => true,
		)
	);

	// ── Case Results (Portfolio) ───────────────────────────────────────────────
	register_post_type(
		'marbure_portfolio',
		array(
			'labels'        => array(
				'name'               => esc_html__( 'Case Results', 'marbure' ),
				'singular_name'      => esc_html__( 'Case Result', 'marbure' ),
				'add_new'            => esc_html__( 'Add New', 'marbure' ),
				'add_new_item'       => esc_html__( 'Add New Case Result', 'marbure' ),
				'edit_item'          => esc_html__( 'Edit Case Result', 'marbure' ),
				'new_item'           => esc_html__( 'New Case Result', 'marbure' ),
				'view_item'          => esc_html__( 'View Case Result', 'marbure' ),
				'search_items'       => esc_html__( 'Search Case Results', 'marbure' ),
				'not_found'          => esc_html__( 'No case results found.', 'marbure' ),
				'not_found_in_trash' => esc_html__( 'No case results found in trash.', 'marbure' ),
				'menu_name'          => esc_html__( 'Case Results', 'marbure' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'menu_icon'     => 'dashicons-portfolio',
			'menu_position' => 6,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'rewrite'       => array( 'slug' => 'case-results', 'with_front' => false ),
			'show_in_rest'  => true,
		)
	);

	// ── Attorneys (Team) ──────────────────────────────────────────────────────
	register_post_type(
		'marbure_team',
		array(
			'labels'        => array(
				'name'               => esc_html__( 'Attorneys', 'marbure' ),
				'singular_name'      => esc_html__( 'Attorney', 'marbure' ),
				'add_new'            => esc_html__( 'Add New', 'marbure' ),
				'add_new_item'       => esc_html__( 'Add New Attorney', 'marbure' ),
				'edit_item'          => esc_html__( 'Edit Attorney', 'marbure' ),
				'new_item'           => esc_html__( 'New Attorney', 'marbure' ),
				'view_item'          => esc_html__( 'View Attorney', 'marbure' ),
				'search_items'       => esc_html__( 'Search Attorneys', 'marbure' ),
				'not_found'          => esc_html__( 'No attorneys found.', 'marbure' ),
				'not_found_in_trash' => esc_html__( 'No attorneys found in trash.', 'marbure' ),
				'menu_name'          => esc_html__( 'Attorneys', 'marbure' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'menu_icon'     => 'dashicons-businessman',
			'menu_position' => 7,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'rewrite'       => array( 'slug' => 'attorneys', 'with_front' => false ),
			'show_in_rest'  => true,
		)
	);

	// ── Testimonials ──────────────────────────────────────────────────────────
	register_post_type(
		'marbure_testimonial',
		array(
			'labels'        => array(
				'name'               => esc_html__( 'Testimonials', 'marbure' ),
				'singular_name'      => esc_html__( 'Testimonial', 'marbure' ),
				'add_new'            => esc_html__( 'Add New', 'marbure' ),
				'add_new_item'       => esc_html__( 'Add New Testimonial', 'marbure' ),
				'edit_item'          => esc_html__( 'Edit Testimonial', 'marbure' ),
				'not_found'          => esc_html__( 'No testimonials found.', 'marbure' ),
				'not_found_in_trash' => esc_html__( 'No testimonials found in trash.', 'marbure' ),
				'menu_name'          => esc_html__( 'Testimonials', 'marbure' ),
			),
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'menu_icon'     => 'dashicons-format-quote',
			'menu_position' => 8,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'show_in_rest'  => true,
		)
	);

	// ── FAQ Items ─────────────────────────────────────────────────────────────
	register_post_type(
		'marbure_faq',
		array(
			'labels'        => array(
				'name'               => esc_html__( 'FAQs', 'marbure' ),
				'singular_name'      => esc_html__( 'FAQ', 'marbure' ),
				'add_new'            => esc_html__( 'Add New', 'marbure' ),
				'add_new_item'       => esc_html__( 'Add New FAQ', 'marbure' ),
				'edit_item'          => esc_html__( 'Edit FAQ', 'marbure' ),
				'not_found'          => esc_html__( 'No FAQs found.', 'marbure' ),
				'not_found_in_trash' => esc_html__( 'No FAQs found in trash.', 'marbure' ),
				'menu_name'          => esc_html__( 'FAQs', 'marbure' ),
			),
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'menu_icon'     => 'dashicons-editor-help',
			'menu_position' => 9,
			'supports'      => array( 'title', 'editor' ),
			'show_in_rest'  => true,
		)
	);
}
add_action( 'init', 'marbure_register_cpts' );

// Flush rewrite rules only once after CPT registration (on theme activation/switch).
function marbure_flush_rewrite_rules() {
	marbure_register_cpts();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'marbure_flush_rewrite_rules' );
