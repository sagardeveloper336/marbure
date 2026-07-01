<?php
/**
 * Elementor Widget: Testimonial Carousel
 * Swiper-powered testimonial slider with a multi-style system.
 * Each style loads its own template and stylesheet at render time.
 *
 * Adding a new style:
 *   1. Add an entry to the 'style' control options array below.
 *   2. Create  template-parts/testimonial/testimonial-{style-key}.php
 *   3. Create  css/testimonial/testimonial-{style-key}.css
 *   4. Add a preview image at assets/images/testimonial-{style-key}.svg
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Testimonial_Carousel extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_testimonial_carousel'; }
	public function get_title()      { return esc_html__( 'Testimonial Carousel', 'marbure' ); }
	public function get_icon()       { return 'eicon-testimonial-carousel'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'testimonial', 'review', 'carousel', 'slider', 'client' ); }

	public function get_style_depends()  { return array( 'swiper' ); }
	public function get_script_depends() { return array( 'swiper' ); }

	protected function register_controls() {

		$this->start_controls_section(
			'section_style_selector',
			array(
				'label' => esc_html__( 'Style', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Card Style', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1 – Dark Glass', 'marbure' ),
					'style-2' => esc_html__( 'Style 2 – Light Cards', 'marbure' ),
					'style-3' => esc_html__( 'Style 3 – Minimal', 'marbure' ),
					'style-4' => esc_html__( 'Style 4 – Bold Accent', 'marbure' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_header',
			array(
				'label' => esc_html__( 'Section Header', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_header',
			array(
				'label'        => esc_html__( 'Show Section Header', 'marbure' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'     => esc_html__( 'Eyebrow Text', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Client Stories', 'marbure' ),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'     => esc_html__( 'Heading', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'What Our Clients Say', 'marbure' ),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_testimonials',
			array(
				'label' => esc_html__( 'Testimonials', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'client_name',
			array(
				'label'   => esc_html__( 'Client Name', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Jane Doe', 'marbure' ),
			)
		);

		$repeater->add_control(
			'client_title',
			array(
				'label'   => esc_html__( 'Client Title / Description', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Residential Client', 'marbure' ),
			)
		);

		$repeater->add_control(
			'rating',
			array(
				'label'   => esc_html__( 'Rating', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'5' => '5 ' . esc_html__( 'Stars', 'marbure' ),
					'4' => '4 ' . esc_html__( 'Stars', 'marbure' ),
					'3' => '3 ' . esc_html__( 'Stars', 'marbure' ),
					'2' => '2 ' . esc_html__( 'Stars', 'marbure' ),
					'1' => '1 ' . esc_html__( 'Star',  'marbure' ),
				),
				'default' => '5',
			)
		);

		$repeater->add_control(
			'quote',
			array(
				'label'   => esc_html__( 'Quote', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'The craftsmanship is outstanding. Our marble flooring transformed the entire feel of our home — we couldn\'t be happier.', 'marbure' ),
			)
		);

		$repeater->add_control(
			'avatar',
			array(
				'label'     => esc_html__( 'Avatar Photo', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'separator' => 'before',
			)
		);

		$repeater->add_control(
			'source_url',
			array(
				'label'       => esc_html__( 'Source URL', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'Link to original review', 'marbure' ),
			)
		);

		$this->add_control(
			'testimonials',
			array(
				'label'       => esc_html__( 'Testimonials', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ client_name }}}',
				'default'     => array(
					array(
						'client_name'  => esc_html__( 'Robert Martinez', 'marbure' ),
						'client_title' => esc_html__( 'Residential Renovation', 'marbure' ),
						'rating'       => '5',
						'quote'        => esc_html__( 'Our Carrara marble kitchen transformed the entire home. The installation team was meticulous and professional from start to finish.', 'marbure' ),
					),
					array(
						'client_name'  => esc_html__( 'Linda Chen', 'marbure' ),
						'client_title' => esc_html__( 'Commercial Project', 'marbure' ),
						'rating'       => '5',
						'quote'        => esc_html__( 'Professional, detail-oriented, and beautifully executed. I will always recommend Marbure for high-end stone work.', 'marbure' ),
					),
					array(
						'client_name'  => esc_html__( 'David Thompson', 'marbure' ),
						'client_title' => esc_html__( 'Hotel Interior Design', 'marbure' ),
						'rating'       => '5',
						'quote'        => esc_html__( 'They sourced rare granite and delivered flawless custom countertops. Outstanding quality and project management throughout.', 'marbure' ),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider',
			array(
				'label' => esc_html__( 'Slider Settings', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'        => esc_html__( 'Loop', 'marbure' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'        => esc_html__( 'Autoplay', 'marbure' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'autoplay_delay',
			array(
				'label'     => esc_html__( 'Autoplay Delay (ms)', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => 5000,
				'min'       => 1000,
				'max'       => 15000,
				'step'      => 500,
				'condition' => array( 'autoplay' => 'yes' ),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$testimonials = $settings['testimonials'];

		if ( empty( $testimonials ) ) {
			return;
		}

		// Resolve and sanitise the selected style key.
		$style = isset( $settings['style'] ) && $settings['style']
			? sanitize_key( $settings['style'] )
			: 'style-1';

		// Enqueue only the CSS for the active style.
		$css_file = get_template_directory() . '/css/testimonial/testimonial-' . $style . '.css';
		if ( file_exists( $css_file ) ) {
			wp_enqueue_style(
				'marbure-testimonial-' . $style,
				get_template_directory_uri() . '/css/testimonial/testimonial-' . $style . '.css',
				array( 'marbure-theme' ),
				MARBURE_VERSION
			);
		}

		// Load the style template; fall back to style-1 if the file is missing.
		$template = get_template_directory() . '/template-parts/testimonial/testimonial-' . $style . '.php';
		if ( ! file_exists( $template ) ) {
			$template = get_template_directory() . '/template-parts/testimonial/testimonial-style-1.php';
		}

		if ( file_exists( $template ) ) {
			include $template; // $settings and $testimonials are in scope.
		}
	}
}
