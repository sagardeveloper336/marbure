<?php
/**
 * Kirki section: Homepage.
 * Controls for hero, about, stats, and mid-page CTA sections.
 *
 * @package marbure
 * @subpackage Kirki
 */

defined( 'ABSPATH' ) || exit;

Kirki::add_section(
	'marbure_section_homepage',
	array(
		'title'    => esc_html__( 'Homepage', 'marbure' ),
		'panel'    => 'marbure_theme_options_panel',
		'priority' => 15,
	)
);

// ── Hero ──────────────────────────────────────────────────────────────────────

Kirki::add_field( 'marbure_theme_options', array(
	'type'     => 'custom', 'settings' => 'hero_heading_sep',
	'section'  => 'marbure_section_homepage', 'priority' => 10,
	'default'  => '<div style="font-weight:700;padding:8px 0 4px;border-bottom:1px solid #ddd;margin-bottom:4px">' . esc_html__( '— Hero Slide 1', 'marbure' ) . '</div>',
) );

Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'image', 'settings' => 'hero_bg_image',
	'label' => esc_html__( 'Hero Background Image', 'marbure' ),
	'section' => 'marbure_section_homepage', 'default' => '', 'priority' => 20,
) );

Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'hero_eyebrow',
	'label' => esc_html__( 'Hero Eyebrow Label', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Premium Marble & Stone Since 2012', 'marbure' ), 'priority' => 30,
) );

Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'hero_heading',
	'label' => esc_html__( 'Hero Heading', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Elevate Every Surface', 'marbure' ), 'priority' => 40,
) );

Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'textarea', 'settings' => 'hero_subtext',
	'label' => esc_html__( 'Hero Subtext', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Premium marble, granite, and natural stone surfaces for homes and businesses that demand perfection.', 'marbure' ),
	'priority' => 50,
) );

Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'hero_btn1_label',
	'label' => esc_html__( 'Hero Button 1 Label', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Explore Collection', 'marbure' ), 'priority' => 60,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'link', 'settings' => 'hero_btn1_url',
	'label' => esc_html__( 'Hero Button 1 URL', 'marbure' ),
	'section' => 'marbure_section_homepage', 'default' => '/products', 'priority' => 70,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'hero_btn2_label',
	'label' => esc_html__( 'Hero Button 2 Label', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'View Projects', 'marbure' ), 'priority' => 80,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'link', 'settings' => 'hero_btn2_url',
	'label' => esc_html__( 'Hero Button 2 URL', 'marbure' ),
	'section' => 'marbure_section_homepage', 'default' => '/projects', 'priority' => 90,
) );

// ── About Section ─────────────────────────────────────────────────────────────

Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'custom', 'settings' => 'about_sep',
	'section' => 'marbure_section_homepage', 'priority' => 100,
	'default' => '<div style="font-weight:700;padding:8px 0 4px;border-bottom:1px solid #ddd;margin-bottom:4px">' . esc_html__( '— About Section', 'marbure' ) . '</div>',
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'image', 'settings' => 'about_image',
	'label' => esc_html__( 'About Image', 'marbure' ),
	'section' => 'marbure_section_homepage', 'default' => '', 'priority' => 110,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'about_eyebrow',
	'label' => esc_html__( 'About Eyebrow', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'About Marbure', 'marbure' ), 'priority' => 120,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'about_heading',
	'label' => esc_html__( 'About Heading', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Crafting Stone Spaces That Endure', 'marbure' ), 'priority' => 130,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'textarea', 'settings' => 'about_subtext',
	'label' => esc_html__( 'About Text', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Marbure is dedicated to sourcing, supplying, and installing premium marble, granite, and natural stone. We combine expert craftsmanship with personal service to transform every space into a timeless statement.', 'marbure' ),
	'priority' => 140,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'about_btn_label',
	'label' => esc_html__( 'About Button Label', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Learn More About Us', 'marbure' ), 'priority' => 150,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'link', 'settings' => 'about_btn_url',
	'label' => esc_html__( 'About Button URL', 'marbure' ),
	'section' => 'marbure_section_homepage', 'default' => '/about-us', 'priority' => 160,
) );

// ── Stats Section ─────────────────────────────────────────────────────────────

Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'custom', 'settings' => 'stats_sep',
	'section' => 'marbure_section_homepage', 'priority' => 170,
	'default' => '<div style="font-weight:700;padding:8px 0 4px;border-bottom:1px solid #ddd;margin-bottom:4px">' . esc_html__( '— Stats Section', 'marbure' ) . '</div>',
) );

$marbure_stats_defaults = array(
	array( 'value' => '4.5', 'suffix' => '★', 'label' => __( 'Client Rating',     'marbure' ), 'icon' => 'fas fa-star' ),
	array( 'value' => '97',  'suffix' => '%', 'label' => __( 'Success Rate',       'marbure' ), 'icon' => 'fas fa-trophy' ),
	array( 'value' => '7',   'suffix' => 'M+','label' => __( 'Average Deal Value', 'marbure' ), 'icon' => 'fas fa-dollar-sign' ),
	array( 'value' => '12',  'suffix' => '+', 'label' => __( 'Years Experience',   'marbure' ), 'icon' => 'fas fa-briefcase' ),
);

$marbure_stat_priority = 180;
foreach ( $marbure_stats_defaults as $i => $stat ) {
	$n = $i + 1;
	Kirki::add_field( 'marbure_theme_options', array(
		'type' => 'text', 'settings' => "stat_{$n}_value",
		'label' => sprintf( esc_html__( 'Stat %d — Number', 'marbure' ), $n ),
		'section' => 'marbure_section_homepage', 'default' => $stat['value'], 'priority' => $marbure_stat_priority++,
	) );
	Kirki::add_field( 'marbure_theme_options', array(
		'type' => 'text', 'settings' => "stat_{$n}_suffix",
		'label' => sprintf( esc_html__( 'Stat %d — Suffix', 'marbure' ), $n ),
		'section' => 'marbure_section_homepage', 'default' => $stat['suffix'], 'priority' => $marbure_stat_priority++,
	) );
	Kirki::add_field( 'marbure_theme_options', array(
		'type' => 'text', 'settings' => "stat_{$n}_label",
		'label' => sprintf( esc_html__( 'Stat %d — Label', 'marbure' ), $n ),
		'section' => 'marbure_section_homepage', 'default' => $stat['label'], 'priority' => $marbure_stat_priority++,
	) );
	Kirki::add_field( 'marbure_theme_options', array(
		'type' => 'text', 'settings' => "stat_{$n}_icon",
		'label' => sprintf( esc_html__( 'Stat %d — Icon Class', 'marbure' ), $n ),
		'section' => 'marbure_section_homepage', 'default' => $stat['icon'], 'priority' => $marbure_stat_priority++,
	) );
}
unset( $marbure_stats_defaults, $marbure_stat_priority, $n, $stat, $i );

// ── Mid-page CTA Band ─────────────────────────────────────────────────────────

Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'custom', 'settings' => 'cta_sep',
	'section' => 'marbure_section_homepage', 'priority' => 230,
	'default' => '<div style="font-weight:700;padding:8px 0 4px;border-bottom:1px solid #ddd;margin-bottom:4px">' . esc_html__( '— Mid-page CTA Band', 'marbure' ) . '</div>',
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'cta_band_heading',
	'label' => esc_html__( 'CTA Heading', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Transform Your Space with Premium Stone', 'marbure' ), 'priority' => 240,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'textarea', 'settings' => 'cta_band_subtext',
	'label' => esc_html__( 'CTA Subtext', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Our stone specialists are ready to help. Get in touch today for a free, no-obligation quote on your next marble or granite project.', 'marbure' ),
	'priority' => 250,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'cta_band_btn1_label',
	'label' => esc_html__( 'CTA Primary Button', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Explore Collection', 'marbure' ), 'priority' => 260,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'link', 'settings' => 'cta_band_btn1_url',
	'section' => 'marbure_section_homepage', 'default' => '/contact', 'priority' => 270,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'cta_band_btn2_label',
	'label' => esc_html__( 'CTA Secondary Button', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'View Our Projects', 'marbure' ), 'priority' => 280,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'link', 'settings' => 'cta_band_btn2_url',
	'section' => 'marbure_section_homepage', 'default' => '/portfolio', 'priority' => 290,
) );

// Pre-footer CTA fields (referenced in template-parts/footer/pre-footer-cta.php).
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'switch', 'settings' => 'show_pre_footer_cta',
	'label' => esc_html__( 'Show Pre-footer CTA', 'marbure' ),
	'section' => 'marbure_section_homepage', 'default' => true, 'priority' => 300,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'pre_footer_cta_heading',
	'label' => esc_html__( 'Pre-footer CTA Heading', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Ready to Transform Your Space?', 'marbure' ), 'priority' => 310,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'pre_footer_cta_text',
	'label' => esc_html__( 'Pre-footer CTA Subtext', 'marbure' ),
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Request a free quote from our stone specialists today. No obligation, just expert advice.', 'marbure' ),
	'priority' => 320,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'text', 'settings' => 'pre_footer_cta_btn_label',
	'section' => 'marbure_section_homepage',
	'default' => esc_html__( 'Request a Free Quote', 'marbure' ), 'priority' => 330,
) );
Kirki::add_field( 'marbure_theme_options', array(
	'type' => 'link', 'settings' => 'pre_footer_cta_btn_url',
	'section' => 'marbure_section_homepage', 'default' => '/contact', 'priority' => 340,
) );
