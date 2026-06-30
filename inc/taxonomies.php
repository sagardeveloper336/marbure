<?php
/**
 * Register Custom Taxonomies.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

function marbure_register_taxonomies() {

	// ── Service Category ──────────────────────────────────────────────────────
	register_taxonomy(
		'service_cat',
		'marbure_service',
		array(
			'labels'        => array(
				'name'              => esc_html__( 'Service Categories', 'marbure' ),
				'singular_name'     => esc_html__( 'Service Category', 'marbure' ),
				'all_items'         => esc_html__( 'All Service Categories', 'marbure' ),
				'edit_item'         => esc_html__( 'Edit Service Category', 'marbure' ),
				'update_item'       => esc_html__( 'Update Service Category', 'marbure' ),
				'add_new_item'      => esc_html__( 'Add New Service Category', 'marbure' ),
				'new_item_name'     => esc_html__( 'New Service Category Name', 'marbure' ),
				'search_items'      => esc_html__( 'Search Service Categories', 'marbure' ),
				'not_found'         => esc_html__( 'No service categories found.', 'marbure' ),
				'menu_name'         => esc_html__( 'Service Categories', 'marbure' ),
			),
			'hierarchical'  => true,
			'public'        => true,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => 'service-category', 'with_front' => false ),
		)
	);

	// ── Portfolio Category ────────────────────────────────────────────────────
	register_taxonomy(
		'portfolio_cat',
		'marbure_portfolio',
		array(
			'labels'        => array(
				'name'              => esc_html__( 'Portfolio Categories', 'marbure' ),
				'singular_name'     => esc_html__( 'Portfolio Category', 'marbure' ),
				'all_items'         => esc_html__( 'All Portfolio Categories', 'marbure' ),
				'edit_item'         => esc_html__( 'Edit Portfolio Category', 'marbure' ),
				'update_item'       => esc_html__( 'Update Portfolio Category', 'marbure' ),
				'add_new_item'      => esc_html__( 'Add New Portfolio Category', 'marbure' ),
				'new_item_name'     => esc_html__( 'New Portfolio Category Name', 'marbure' ),
				'search_items'      => esc_html__( 'Search Portfolio Categories', 'marbure' ),
				'not_found'         => esc_html__( 'No portfolio categories found.', 'marbure' ),
				'menu_name'         => esc_html__( 'Portfolio Categories', 'marbure' ),
			),
			'hierarchical'  => true,
			'public'        => true,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => 'portfolio-category', 'with_front' => false ),
		)
	);

	// ── Team Department ───────────────────────────────────────────────────────
	register_taxonomy(
		'team_dept',
		'marbure_team',
		array(
			'labels'        => array(
				'name'              => esc_html__( 'Departments', 'marbure' ),
				'singular_name'     => esc_html__( 'Department', 'marbure' ),
				'all_items'         => esc_html__( 'All Departments', 'marbure' ),
				'edit_item'         => esc_html__( 'Edit Department', 'marbure' ),
				'update_item'       => esc_html__( 'Update Department', 'marbure' ),
				'add_new_item'      => esc_html__( 'Add New Department', 'marbure' ),
				'new_item_name'     => esc_html__( 'New Department Name', 'marbure' ),
				'search_items'      => esc_html__( 'Search Departments', 'marbure' ),
				'not_found'         => esc_html__( 'No departments found.', 'marbure' ),
				'menu_name'         => esc_html__( 'Departments', 'marbure' ),
			),
			'hierarchical'  => true,
			'public'        => true,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => 'department', 'with_front' => false ),
		)
	);

	// ── Client Group → Clients ────────────────────────────────────────────────
	register_taxonomy(
		'client_group',
		'marbure_client',
		array(
			'labels'        => array(
				'name'              => esc_html__( 'Client Groups', 'marbure' ),
				'singular_name'     => esc_html__( 'Client Group', 'marbure' ),
				'all_items'         => esc_html__( 'All Client Groups', 'marbure' ),
				'edit_item'         => esc_html__( 'Edit Client Group', 'marbure' ),
				'update_item'       => esc_html__( 'Update Client Group', 'marbure' ),
				'add_new_item'      => esc_html__( 'Add New Client Group', 'marbure' ),
				'new_item_name'     => esc_html__( 'New Client Group Name', 'marbure' ),
				'search_items'      => esc_html__( 'Search Client Groups', 'marbure' ),
				'not_found'         => esc_html__( 'No client groups found.', 'marbure' ),
				'menu_name'         => esc_html__( 'Client Group', 'marbure' ),
			),
			'hierarchical'  => true,
			'public'        => false,
			'show_ui'       => true,
			'show_in_rest'  => true,
		)
	);

	// ── Testimonial Type → Testimonials ───────────────────────────────────────
	register_taxonomy(
		'testimonial_type',
		'marbure_testimonial',
		array(
			'labels'        => array(
				'name'              => esc_html__( 'Testimonial Types', 'marbure' ),
				'singular_name'     => esc_html__( 'Testimonial Type', 'marbure' ),
				'all_items'         => esc_html__( 'All Types', 'marbure' ),
				'edit_item'         => esc_html__( 'Edit Type', 'marbure' ),
				'add_new_item'      => esc_html__( 'Add New Type', 'marbure' ),
				'new_item_name'     => esc_html__( 'New Type Name', 'marbure' ),
				'not_found'         => esc_html__( 'No types found.', 'marbure' ),
				'menu_name'         => esc_html__( 'Types', 'marbure' ),
			),
			'hierarchical'  => false,
			'public'        => false,
			'show_ui'       => true,
			'show_in_rest'  => true,
		)
	);

}
add_action( 'init', 'marbure_register_taxonomies' );
