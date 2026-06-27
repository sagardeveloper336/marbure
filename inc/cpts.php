<?php
/**
 * Register Custom Post Types.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

function marbure_register_cpts() {

	// ── Services ─────────────────────────────────────────────────────────────
	register_post_type(
		'marbure_service',
		array(
			'labels'        => array(
				'name'               => esc_html__( 'Services', 'marbure' ),
				'singular_name'      => esc_html__( 'Service', 'marbure' ),
				'add_new'            => esc_html__( 'Add New', 'marbure' ),
				'add_new_item'       => esc_html__( 'Add New Service', 'marbure' ),
				'edit_item'          => esc_html__( 'Edit Service', 'marbure' ),
				'new_item'           => esc_html__( 'New Service', 'marbure' ),
				'view_item'          => esc_html__( 'View Service', 'marbure' ),
				'search_items'       => esc_html__( 'Search Services', 'marbure' ),
				'not_found'          => esc_html__( 'No services found.', 'marbure' ),
				'not_found_in_trash' => esc_html__( 'No services found in trash.', 'marbure' ),
				'menu_name'          => esc_html__( 'Services', 'marbure' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'menu_icon'     => 'dashicons-hammer',
			'menu_position' => 5,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			'rewrite'       => array( 'slug' => 'services', 'with_front' => false ),
			'show_in_rest'  => true,
		)
	);

	// ── Portfolio ─────────────────────────────────────────────────────────────
	register_post_type(
		'marbure_portfolio',
		array(
			'labels'        => array(
				'name'               => esc_html__( 'Portfolio', 'marbure' ),
				'singular_name'      => esc_html__( 'Portfolio Item', 'marbure' ),
				'add_new'            => esc_html__( 'Add New', 'marbure' ),
				'add_new_item'       => esc_html__( 'Add New Portfolio Item', 'marbure' ),
				'edit_item'          => esc_html__( 'Edit Portfolio Item', 'marbure' ),
				'new_item'           => esc_html__( 'New Portfolio Item', 'marbure' ),
				'view_item'          => esc_html__( 'View Portfolio Item', 'marbure' ),
				'search_items'       => esc_html__( 'Search Portfolio', 'marbure' ),
				'not_found'          => esc_html__( 'No portfolio items found.', 'marbure' ),
				'not_found_in_trash' => esc_html__( 'No portfolio items found in trash.', 'marbure' ),
				'menu_name'          => esc_html__( 'Portfolio', 'marbure' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'menu_icon'     => 'dashicons-portfolio',
			'menu_position' => 6,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'rewrite'       => array( 'slug' => 'portfolio', 'with_front' => false ),
			'show_in_rest'  => true,
		)
	);

	// ── Team ──────────────────────────────────────────────────────────────────
	register_post_type(
		'marbure_team',
		array(
			'labels'        => array(
				'name'               => esc_html__( 'Team', 'marbure' ),
				'singular_name'      => esc_html__( 'Team Member', 'marbure' ),
				'add_new'            => esc_html__( 'Add New', 'marbure' ),
				'add_new_item'       => esc_html__( 'Add New Team Member', 'marbure' ),
				'edit_item'          => esc_html__( 'Edit Team Member', 'marbure' ),
				'new_item'           => esc_html__( 'New Team Member', 'marbure' ),
				'view_item'          => esc_html__( 'View Team Member', 'marbure' ),
				'search_items'       => esc_html__( 'Search Team', 'marbure' ),
				'not_found'          => esc_html__( 'No team members found.', 'marbure' ),
				'not_found_in_trash' => esc_html__( 'No team members found in trash.', 'marbure' ),
				'menu_name'          => esc_html__( 'Team', 'marbure' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'menu_icon'     => 'dashicons-businessman',
			'menu_position' => 7,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'rewrite'       => array( 'slug' => 'team', 'with_front' => false ),
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

	// ── Clients ───────────────────────────────────────────────────────────────
	register_post_type(
		'marbure_client',
		array(
			'labels'        => array(
				'name'               => esc_html__( 'Clients', 'marbure' ),
				'singular_name'      => esc_html__( 'Client', 'marbure' ),
				'add_new'            => esc_html__( 'Add New', 'marbure' ),
				'add_new_item'       => esc_html__( 'Add New Client', 'marbure' ),
				'edit_item'          => esc_html__( 'Edit Client', 'marbure' ),
				'new_item'           => esc_html__( 'New Client', 'marbure' ),
				'view_item'          => esc_html__( 'View Client', 'marbure' ),
				'search_items'       => esc_html__( 'Search Clients', 'marbure' ),
				'not_found'          => esc_html__( 'No clients found.', 'marbure' ),
				'not_found_in_trash' => esc_html__( 'No clients found in trash.', 'marbure' ),
				'menu_name'          => esc_html__( 'Clients', 'marbure' ),
			),
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'menu_icon'     => 'dashicons-id-alt',
			'menu_position' => 9,
			'supports'      => array( 'title', 'thumbnail' ),
			'show_in_rest'  => true,
		)
	);

	// ── Products (Marble / Stone tiles) ───────────────────────────────────────
	register_post_type(
		'marbure_product',
		array(
			'labels'        => array(
				'name'               => esc_html__( 'Products', 'marbure' ),
				'singular_name'      => esc_html__( 'Product', 'marbure' ),
				'add_new'            => esc_html__( 'Add New', 'marbure' ),
				'add_new_item'       => esc_html__( 'Add New Product', 'marbure' ),
				'edit_item'          => esc_html__( 'Edit Product', 'marbure' ),
				'new_item'           => esc_html__( 'New Product', 'marbure' ),
				'view_item'          => esc_html__( 'View Product', 'marbure' ),
				'search_items'       => esc_html__( 'Search Products', 'marbure' ),
				'not_found'          => esc_html__( 'No products found.', 'marbure' ),
				'not_found_in_trash' => esc_html__( 'No products found in trash.', 'marbure' ),
				'menu_name'          => esc_html__( 'Products', 'marbure' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'menu_icon'     => 'dashicons-products',
			'menu_position' => 10,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			'rewrite'       => array( 'slug' => 'products', 'with_front' => false ),
			'show_in_rest'  => true,
		)
	);

	// ── Projects (Completed installations) ────────────────────────────────────
	register_post_type(
		'marbure_project',
		array(
			'labels'        => array(
				'name'               => esc_html__( 'Projects', 'marbure' ),
				'singular_name'      => esc_html__( 'Project', 'marbure' ),
				'add_new'            => esc_html__( 'Add New', 'marbure' ),
				'add_new_item'       => esc_html__( 'Add New Project', 'marbure' ),
				'edit_item'          => esc_html__( 'Edit Project', 'marbure' ),
				'new_item'           => esc_html__( 'New Project', 'marbure' ),
				'view_item'          => esc_html__( 'View Project', 'marbure' ),
				'search_items'       => esc_html__( 'Search Projects', 'marbure' ),
				'not_found'          => esc_html__( 'No projects found.', 'marbure' ),
				'not_found_in_trash' => esc_html__( 'No projects found in trash.', 'marbure' ),
				'menu_name'          => esc_html__( 'Projects', 'marbure' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'menu_icon'     => 'dashicons-hammer',
			'menu_position' => 11,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'rewrite'       => array( 'slug' => 'projects', 'with_front' => false ),
			'show_in_rest'  => true,
		)
	);

	// ── FAQ ───────────────────────────────────────────────────────────────────
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
			'menu_position' => 12,
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
