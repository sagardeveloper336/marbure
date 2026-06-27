<?php
/**
 * Elementor Widget: Marquee Strip
 * Animated scrolling ticker; items are duplicated for seamless CSS loop.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Marquee_Strip extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_marquee_strip'; }
	public function get_title()      { return esc_html__( 'Marquee Strip', 'marbure' ); }
	public function get_icon()       { return 'eicon-scroll'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'marquee', 'ticker', 'scroll', 'strip', 'achievements', 'awards' ); }

	protected function register_controls() {

		// ── CONTENT: Items ────────────────────────────────────────────────────

		$this->start_controls_section(
			'section_items',
			array(
				'label' => esc_html__( 'Marquee Items', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon_class',
			array(
				'label'       => esc_html__( 'Icon (Font Awesome class)', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'fas fa-trophy',
				'default'     => 'fas fa-trophy',
			)
		);

		$repeater->add_control(
			'text',
			array(
				'label'   => esc_html__( 'Text', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Premium Italian Marble', 'marbure' ),
			)
		);

		$this->add_control(
			'items',
			array(
				'label'       => esc_html__( 'Items', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ text }}}',
				'default'     => array(
					array( 'icon_class' => 'fas fa-gem',          'text' => esc_html__( 'Premium Italian Marble', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-trophy',       'text' => esc_html__( 'Best Stone Supplier 2024', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-star',         'text' => esc_html__( '4.9★ Client Rating', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-award',        'text' => esc_html__( 'Excellence in Craftsmanship', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-check-circle', 'text' => esc_html__( '97% Client Satisfaction', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-handshake',    'text' => esc_html__( '500+ Projects Completed', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-medal',        'text' => esc_html__( 'Certified Natural Stone Experts', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-shield-alt',   'text' => esc_html__( '12+ Years of Excellence', 'marbure' ) ),
				),
			)
		);

		$this->end_controls_section();

		// ── CONTENT: Settings ─────────────────────────────────────────────────

		$this->start_controls_section(
			'section_settings',
			array(
				'label' => esc_html__( 'Strip Settings', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'direction',
			array(
				'label'   => esc_html__( 'Scroll Direction', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'left'  => esc_html__( 'Left (default)', 'marbure' ),
					'right' => esc_html__( 'Right', 'marbure' ),
				),
				'default' => 'left',
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'       => esc_html__( 'Animation Duration (seconds)', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'default'     => 40,
				'min'         => 5,
				'max'         => 120,
				'description' => esc_html__( 'Lower = faster. Adjust based on item count.', 'marbure' ),
			)
		);

		$this->add_control(
			'pause_on_hover',
			array(
				'label'        => esc_html__( 'Pause on Hover', 'marbure' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = $settings['items'];

		if ( empty( $items ) ) {
			return;
		}

		$speed     = absint( $settings['speed'] ) ?: 40;
		$direction = 'right' === $settings['direction'] ? 'reverse' : 'normal';
		$pause     = 'yes' === $settings['pause_on_hover'] ? ' marquee-strip--pause-hover' : '';

		// Duplicate for seamless loop.
		$all_items = array_merge( $items, $items );
		?>
		<div class="marquee-strip<?php echo esc_attr( $pause ); ?>" aria-hidden="true">
			<div
				class="marquee-track"
				style="animation-duration:<?php echo esc_attr( $speed ); ?>s;animation-direction:<?php echo esc_attr( $direction ); ?>;"
			>
				<?php foreach ( $all_items as $item ) : ?>
					<div class="marquee-item">
						<?php if ( $item['icon_class'] ) : ?>
							<i class="<?php echo esc_attr( $item['icon_class'] ); ?>" aria-hidden="true"></i>
						<?php endif; ?>
						<span><?php echo esc_html( $item['text'] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}
