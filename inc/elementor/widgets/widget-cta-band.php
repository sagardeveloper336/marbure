<?php
/**
 * Elementor Widget: CTA Band
 * Dark navy call-to-action band with heading, subtext, and two buttons.
 * Supports background color or image with overlay.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Cta_Band extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_cta_band'; }
	public function get_title()      { return esc_html__( 'CTA Band', 'marbure' ); }
	public function get_icon()       { return 'eicon-call-to-action'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'cta', 'call to action', 'banner', 'consultation', 'button' ); }

	protected function register_controls() {

		// ── CONTENT: Text & Buttons ───────────────────────────────────────────

		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Ready to Transform Your Space?', 'marbure' ),
			)
		);

		$this->add_control(
			'subtext',
			array(
				'label'   => esc_html__( 'Subtext', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Speak with our stone specialists today. Get a free, no-obligation quote for your marble or granite project.', 'marbure' ),
			)
		);

		$this->add_control(
			'btn1_label',
			array(
				'label'     => esc_html__( 'Button 1 Label', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Get a Free Quote', 'marbure' ),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'btn1_url',
			array(
				'label'         => esc_html__( 'Button 1 URL', 'marbure' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
			)
		);

		$this->add_control(
			'btn1_icon',
			array(
				'label' => esc_html__( 'Button 1 Icon', 'marbure' ),
				'type'  => \Elementor\Controls_Manager::ICONS,
			)
		);

		$this->add_control(
			'btn2_label',
			array(
				'label'     => esc_html__( 'Button 2 Label', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Call Us Now', 'marbure' ),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'btn2_url',
			array(
				'label'         => esc_html__( 'Button 2 URL', 'marbure' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => 'tel:+10000000000',
				'show_external' => false,
			)
		);

		$this->add_control(
			'btn2_icon',
			array(
				'label'   => esc_html__( 'Button 2 Icon', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-phone',
					'library' => 'fa-solid',
				),
			)
		);

		$this->end_controls_section();

		// ── CONTENT: Background ───────────────────────────────────────────────

		$this->start_controls_section(
			'section_background',
			array(
				'label' => esc_html__( 'Background', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'bg_type',
			array(
				'label'   => esc_html__( 'Background Type', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'color' => esc_html__( 'Color', 'marbure' ),
					'image' => esc_html__( 'Image', 'marbure' ),
				),
				'default' => 'color',
			)
		);

		$this->add_control(
			'bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#0A1E3F',
				'condition' => array( 'bg_type' => 'color' ),
			)
		);

		$this->add_control(
			'bg_image',
			array(
				'label'     => esc_html__( 'Background Image', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'condition' => array( 'bg_type' => 'image' ),
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => esc_html__( 'Overlay Color', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#0A1E3F',
				'condition' => array( 'bg_type' => 'image' ),
			)
		);

		$this->add_control(
			'overlay_opacity',
			array(
				'label'     => esc_html__( 'Overlay Opacity', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 1, 'step' => 0.05 ) ),
				'default'   => array( 'size' => 0.75 ),
				'condition' => array( 'bg_type' => 'image' ),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! $settings['heading'] && ! $settings['btn1_label'] ) {
			return;
		}

		// Build inline style for the section.
		$style = '';
		if ( 'color' === $settings['bg_type'] && $settings['bg_color'] ) {
			$style = 'background-color:' . esc_attr( $settings['bg_color'] ) . ';';
		} elseif ( 'image' === $settings['bg_type'] && ! empty( $settings['bg_image']['url'] ) ) {
			$style = 'background-image:url(' . esc_url( $settings['bg_image']['url'] ) . ');background-size:cover;background-position:center;position:relative;';
		}
		?>
		<section class="cta-band"<?php echo $style ? ' style="' . $style . '"' : ''; ?> data-aos="fade-up">

			<?php if ( 'image' === $settings['bg_type'] && ! empty( $settings['bg_image']['url'] ) ) :
				$oc      = $settings['overlay_color'] ?: '#0A1E3F';
				$opacity = isset( $settings['overlay_opacity']['size'] ) ? $settings['overlay_opacity']['size'] : 0.75;
			?>
				<div class="cta-band__overlay" style="background-color:<?php echo esc_attr( $oc ); ?>;opacity:<?php echo esc_attr( $opacity ); ?>;"></div>
			<?php endif; ?>

			<div class="container">
				<div class="cta-band__inner">

					<div class="cta-band__text">
						<?php if ( $settings['heading'] ) : ?>
							<h2 class="cta-band__heading"><?php echo esc_html( $settings['heading'] ); ?></h2>
						<?php endif; ?>
						<?php if ( $settings['subtext'] ) : ?>
							<p class="cta-band__subtext"><?php echo esc_html( $settings['subtext'] ); ?></p>
						<?php endif; ?>
					</div>

					<div class="cta-band__actions">
						<?php if ( $settings['btn1_label'] && ! empty( $settings['btn1_url']['url'] ) ) :
							$ext1 = ! empty( $settings['btn1_url']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
						?>
							<a href="<?php echo esc_url( $settings['btn1_url']['url'] ); ?>"<?php echo $ext1; // phpcs:ignore ?> class="btn btn--primary">
								<?php if ( ! empty( $settings['btn1_icon']['value'] ) ) : ?>
									<?php \Elementor\Icons_Manager::render_icon( $settings['btn1_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								<?php endif; ?>
								<?php echo esc_html( $settings['btn1_label'] ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $settings['btn2_label'] && ! empty( $settings['btn2_url']['url'] ) ) :
							$ext2 = ! empty( $settings['btn2_url']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
						?>
							<a href="<?php echo esc_url( $settings['btn2_url']['url'] ); ?>"<?php echo $ext2; // phpcs:ignore ?> class="btn btn--outline-white">
								<?php if ( ! empty( $settings['btn2_icon']['value'] ) ) : ?>
									<?php \Elementor\Icons_Manager::render_icon( $settings['btn2_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								<?php endif; ?>
								<?php echo esc_html( $settings['btn2_label'] ); ?>
							</a>
						<?php endif; ?>
					</div>

				</div>
			</div>
		</section>
		<?php
	}
}
