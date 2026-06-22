<?php
/**
 * Elementor Widget: Hero Slider
 * Outputs a Swiper full-width hero matching the hero-slider template-part HTML.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Hero_Slider extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_hero_slider'; }
	public function get_title()      { return esc_html__( 'Hero Slider', 'marbure' ); }
	public function get_icon()       { return 'eicon-slideshow'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'hero', 'slider', 'swiper', 'banner' ); }

	public function get_style_depends()  { return array( 'swiper' ); }
	public function get_script_depends() { return array( 'swiper' ); }

	protected function register_controls() {

		// ── CONTENT: Slides ───────────────────────────────────────────────────

		$this->start_controls_section(
			'section_slides',
			array(
				'label' => esc_html__( 'Slides', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'eyebrow',
			array(
				'label'   => esc_html__( 'Eyebrow Text', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '12 Years of Legal Excellence', 'marbure' ),
			)
		);

		$repeater->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Fighting for Your Justice', 'marbure' ),
			)
		);

		$repeater->add_control(
			'text',
			array(
				'label'   => esc_html__( 'Subtext', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Experienced attorneys committed to protecting your rights and securing the justice you deserve.', 'marbure' ),
			)
		);

		$repeater->add_control(
			'bg_image',
			array(
				'label' => esc_html__( 'Background Image', 'marbure' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'overlay_opacity',
			array(
				'label'   => esc_html__( 'Overlay Opacity', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range'   => array( 'px' => array( 'min' => 0, 'max' => 1, 'step' => 0.05 ) ),
				'default' => array( 'size' => 0.6 ),
			)
		);

		$repeater->add_control(
			'btn1_label',
			array(
				'label'     => esc_html__( 'Button 1 Label', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Free Consultation', 'marbure' ),
				'separator' => 'before',
			)
		);

		$repeater->add_control(
			'btn1_url',
			array(
				'label'         => esc_html__( 'Button 1 URL', 'marbure' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => esc_html__( '/contact', 'marbure' ),
				'show_external' => true,
			)
		);

		$repeater->add_control(
			'btn2_label',
			array(
				'label'   => esc_html__( 'Button 2 Label', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Our Practice Areas', 'marbure' ),
			)
		);

		$repeater->add_control(
			'btn2_url',
			array(
				'label'         => esc_html__( 'Button 2 URL', 'marbure' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => esc_html__( '/practice-areas', 'marbure' ),
				'show_external' => true,
			)
		);

		$this->add_control(
			'slides',
			array(
				'label'       => esc_html__( 'Slides', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ heading }}}',
				'default'     => array(
					array(
						'eyebrow'   => esc_html__( '12 Years of Legal Excellence', 'marbure' ),
						'heading'   => esc_html__( 'Fighting for Your Justice', 'marbure' ),
						'text'      => esc_html__( 'Experienced attorneys committed to protecting your rights.', 'marbure' ),
						'btn1_label' => esc_html__( 'Free Consultation', 'marbure' ),
						'btn2_label' => esc_html__( 'Our Practice Areas', 'marbure' ),
					),
					array(
						'eyebrow'   => esc_html__( 'Trusted Legal Counsel', 'marbure' ),
						'heading'   => esc_html__( 'Standing Firm for What\'s Right', 'marbure' ),
						'text'      => esc_html__( 'We navigate complex legal challenges so you can focus on what matters most.', 'marbure' ),
						'btn1_label' => esc_html__( 'Our Attorneys', 'marbure' ),
						'btn2_label' => esc_html__( 'Case Results', 'marbure' ),
					),
				),
			)
		);

		$this->end_controls_section();

		// ── CONTENT: Slider Settings ──────────────────────────────────────────

		$this->start_controls_section(
			'section_slider_settings',
			array(
				'label' => esc_html__( 'Slider Settings', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'        => esc_html__( 'Autoplay', 'marbure' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'marbure' ),
				'label_off'    => esc_html__( 'No', 'marbure' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'autoplay_delay',
			array(
				'label'     => esc_html__( 'Autoplay Delay (ms)', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => 6000,
				'min'       => 1000,
				'max'       => 15000,
				'step'      => 500,
				'condition' => array( 'autoplay' => 'yes' ),
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
			'speed',
			array(
				'label'   => esc_html__( 'Transition Speed (ms)', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 800,
				'min'     => 200,
				'max'     => 3000,
				'step'    => 100,
			)
		);

		$this->add_control(
			'show_nav',
			array(
				'label'        => esc_html__( 'Show Navigation Arrows', 'marbure' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'show_pagination',
			array(
				'label'        => esc_html__( 'Show Pagination Dots', 'marbure' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$slides   = $settings['slides'];

		if ( empty( $slides ) ) {
			return;
		}

		$data_attrs = 'data-autoplay="' . esc_attr( $settings['autoplay'] === 'yes' ? $settings['autoplay_delay'] : '0' ) . '"'
			. ' data-loop="' . esc_attr( $settings['loop'] === 'yes' ? '1' : '0' ) . '"'
			. ' data-speed="' . esc_attr( $settings['speed'] ) . '"';
		?>
		<section class="hero-slider" aria-label="<?php esc_attr_e( 'Hero slideshow', 'marbure' ); ?>">
			<div class="swiper js-hero-swiper" <?php echo $data_attrs; // phpcs:ignore WordPress.Security.EscapeOutput ?>>
				<div class="swiper-wrapper">

					<?php foreach ( $slides as $index => $slide ) :
						$bg_url  = ! empty( $slide['bg_image']['url'] ) ? $slide['bg_image']['url'] : '';
						$opacity = ! empty( $slide['overlay_opacity']['size'] ) ? $slide['overlay_opacity']['size'] : 0.6;
					?>
						<div class="swiper-slide">
							<div
								class="hero-slide<?php echo empty( $bg_url ) ? ' hero-slide--gradient' : ''; ?>"
								<?php if ( $bg_url ) : ?>
									style="background-image: url(<?php echo esc_url( $bg_url ); ?>);"
								<?php endif; ?>
							>
								<div class="hero-slide__overlay" style="opacity:<?php echo esc_attr( $opacity ); ?>;"></div>

								<div class="container">
									<div class="hero-slide__content">

										<?php if ( $slide['eyebrow'] ) : ?>
											<span class="hero-slide__eyebrow eyebrow">
												<?php echo esc_html( $slide['eyebrow'] ); ?>
											</span>
										<?php endif; ?>

										<<?php echo 0 === $index ? 'h1' : 'h2'; ?> class="hero-slide__title">
											<?php echo esc_html( $slide['heading'] ); ?>
										</<?php echo 0 === $index ? 'h1' : 'h2'; ?>>

										<?php if ( $slide['text'] ) : ?>
											<p class="hero-slide__text"><?php echo esc_html( $slide['text'] ); ?></p>
										<?php endif; ?>

										<div class="hero-slide__actions">
											<?php
											if ( $slide['btn1_label'] && ! empty( $slide['btn1_url']['url'] ) ) :
												$ext1 = ! empty( $slide['btn1_url']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
											?>
												<a href="<?php echo esc_url( $slide['btn1_url']['url'] ); ?>"<?php echo $ext1; // phpcs:ignore ?> class="btn btn--primary">
													<?php echo esc_html( $slide['btn1_label'] ); ?>
												</a>
											<?php endif; ?>

											<?php
											if ( $slide['btn2_label'] && ! empty( $slide['btn2_url']['url'] ) ) :
												$ext2 = ! empty( $slide['btn2_url']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
											?>
												<a href="<?php echo esc_url( $slide['btn2_url']['url'] ); ?>"<?php echo $ext2; // phpcs:ignore ?> class="btn btn--outline-white">
													<?php echo esc_html( $slide['btn2_label'] ); ?>
												</a>
											<?php endif; ?>
										</div>

									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

				</div><!-- .swiper-wrapper -->

				<?php if ( 'yes' === $settings['show_pagination'] ) : ?>
					<div class="swiper-pagination hero-swiper__pagination"></div>
				<?php endif; ?>

				<?php if ( 'yes' === $settings['show_nav'] ) : ?>
					<button class="swiper-button-prev hero-swiper__prev" aria-label="<?php esc_attr_e( 'Previous slide', 'marbure' ); ?>"></button>
					<button class="swiper-button-next hero-swiper__next" aria-label="<?php esc_attr_e( 'Next slide', 'marbure' ); ?>"></button>
				<?php endif; ?>

			</div><!-- .swiper -->
		</section>
		<?php
	}
}
