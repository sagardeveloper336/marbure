<?php
/**
 * Kirki section: Blog.
 *
 * Archive layout and excerpt/meta display options.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_section(
	'marbure_section_blog',
	array(
		'title'    => esc_html__( 'Blog', 'marbure' ),
		'panel'    => 'marbure_theme_options_panel',
		'priority' => 50,
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'     => 'select',
		'settings' => 'blog_layout',
		'label'    => esc_html__( 'Archive Layout', 'marbure' ),
		'section'  => 'marbure_section_blog',
		'default'  => 'list',
		'priority' => 10,
		'choices'  => array(
			'list'    => esc_html__( 'List', 'marbure' ),
			'grid'    => esc_html__( 'Grid', 'marbure' ),
			'masonry' => esc_html__( 'Masonry', 'marbure' ),
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'slider',
		'settings'    => 'excerpt_length',
		'label'       => esc_html__( 'Excerpt Length', 'marbure' ),
		'description' => esc_html__( 'Number of words shown in archive excerpts.', 'marbure' ),
		'section'     => 'marbure_section_blog',
		'default'     => 30,
		'priority'    => 20,
		'choices'     => array(
			'min'  => 10,
			'max'  => 100,
			'step' => 5,
		),
	)
);

Kirki::add_field(
	'marbure_theme_options',
	array(
		'type'        => 'multicheck',
		'settings'    => 'post_meta_visibility',
		'label'       => esc_html__( 'Post Meta Visibility', 'marbure' ),
		'description' => esc_html__( 'Choose which meta items appear on archive cards.', 'marbure' ),
		'section'     => 'marbure_section_blog',
		'default'     => array( 'date', 'author', 'category' ),
		'priority'    => 30,
		'choices'     => array(
			'date'     => esc_html__( 'Date', 'marbure' ),
			'author'   => esc_html__( 'Author', 'marbure' ),
			'category' => esc_html__( 'Category', 'marbure' ),
			'comments' => esc_html__( 'Comment Count', 'marbure' ),
		),
	)
);
