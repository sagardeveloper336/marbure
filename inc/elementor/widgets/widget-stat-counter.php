<?php
/**
 * Elementor Widget: Stat Counter
 * Animated number counters using IntersectionObserver (js/main.js handles init).
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Stat_Counter extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_stat_counter'; }
	public function get_title()      { return esc_html__( 'Stat Counters', 'marbure' ); }
	public function get_icon()       { return 'eicon-counter'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'counter', 'stat', 'number', 'animate', 'achievement' ); }

	protected function register_controls() {

		$this->start_controls_section(
			'section_stats',
			array(
				'label' => esc_html__( 'Stats', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon_class',
			array(
				'label'       => esc_html__( 'Icon (Font Awesome class)', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'fas fa-gavel',
				'default'     => 'fas fa-gavel',
			)
		);

		$repeater->add_control(
			'number',
			array(
				'label'   => esc_html__( 'Number', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 750,
				'min'     => 0,
			)
		);

		$repeater->add_control(
			'suffix',
			array(
				'label'   => esc_html__( 'Suffix', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '+',
			)
		);

		$repeater->add_control(
			'label',
			array(
				'label'   => esc_html__( 'Label', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Cases Won', 'marbure' ),
			)
		);

		$repeater->add_control(
			'duration',
			array(
				'label'   => esc_html__( 'Animation Duration (ms)', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 2000,
				'min'     => 500,
				'max'     => 5000,
				'step'    => 100,
			)
		);

		$this->add_control(
			'stats',
			array(
				'label'       => esc_html__( 'Stats', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
				'default'     => array(
					array( 'icon_class' => 'fas fa-gavel',        'number' => 750,  'suffix' => '+',  'label' => esc_html__( 'Cases Won', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-chart-line',   'number' => 97,   'suffix' => '%',  'label' => esc_html__( 'Success Rate', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-balance-scale','number' => 12,   'suffix' => '+',  'label' => esc_html__( 'Years Experience', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-users',        'number' => 5000, 'suffix' => '+',  'label' => esc_html__( 'Happy Clients', 'marbure' ) ),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$stats    = $settings['stats'];

		if ( empty( $stats ) ) {
			return;
		}
		?>
		<section class="section stats-section">
			<div class="container">
				<div class="stats-grid" data-aos="fade-up">
					<?php foreach ( $stats as $stat ) : ?>
						<div class="stat-item">
							<?php if ( $stat['icon_class'] ) : ?>
								<div class="stat-item__icon" aria-hidden="true">
									<i class="<?php echo esc_attr( $stat['icon_class'] ); ?>"></i>
								</div>
							<?php endif; ?>
							<div class="stat-item__number">
								<span
									class="stat-item__counter js-counter"
									data-target="<?php echo esc_attr( $stat['number'] ); ?>"
									data-duration="<?php echo esc_attr( $stat['duration'] ?: 2000 ); ?>"
									aria-label="<?php echo esc_attr( $stat['number'] . $stat['suffix'] . ' ' . $stat['label'] ); ?>"
								>0</span><span class="stat-item__suffix"><?php echo esc_html( $stat['suffix'] ); ?></span>
							</div>
							<p class="stat-item__label"><?php echo esc_html( $stat['label'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
