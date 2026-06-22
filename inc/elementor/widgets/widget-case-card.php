<?php
/**
 * Elementor Widget: Case Result Cards
 * Grid of portfolio/case result cards with image, category, outcome badge, settlement.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Case_Card extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_case_card'; }
	public function get_title()      { return esc_html__( 'Case Result Cards', 'marbure' ); }
	public function get_icon()       { return 'eicon-gallery-grid'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'case', 'portfolio', 'result', 'win', 'settlement', 'grid' ); }

	protected function register_controls() {

		// ── CONTENT: Section Header ───────────────────────────────────────────

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
				'default'   => esc_html__( 'Track Record', 'marbure' ),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'     => esc_html__( 'Heading', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Recent Case Results', 'marbure' ),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'subheading',
			array(
				'label'     => esc_html__( 'Subheading', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// ── CONTENT: Cases ────────────────────────────────────────────────────

		$this->start_controls_section(
			'section_cases',
			array(
				'label' => esc_html__( 'Case Results', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			array(
				'label' => esc_html__( 'Image', 'marbure' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'category',
			array(
				'label'   => esc_html__( 'Case Category', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Personal Injury', 'marbure' ),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Case Title', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Rear-End Collision Claim', 'marbure' ),
			)
		);

		$repeater->add_control(
			'outcome',
			array(
				'label'   => esc_html__( 'Outcome', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'won'       => esc_html__( 'Won', 'marbure' ),
					'settled'   => esc_html__( 'Settled', 'marbure' ),
					'dismissed' => esc_html__( 'Dismissed', 'marbure' ),
				),
				'default' => 'settled',
			)
		);

		$repeater->add_control(
			'settlement',
			array(
				'label'       => esc_html__( 'Settlement / Award', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '$2.5M',
				'default'     => '$2.5M',
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'         => esc_html__( 'Case Link', 'marbure' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => false,
				'separator'     => 'before',
			)
		);

		$this->add_control(
			'cases',
			array(
				'label'       => esc_html__( 'Cases', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array( 'category' => esc_html__( 'Personal Injury', 'marbure' ),  'title' => esc_html__( 'Rear-End Collision', 'marbure' ),     'outcome' => 'settled', 'settlement' => '$2.5M' ),
					array( 'category' => esc_html__( 'Business Litigation', 'marbure' ),'title' => esc_html__( 'Contract Breach Claim', 'marbure' ), 'outcome' => 'won',     'settlement' => '$1.2M' ),
					array( 'category' => esc_html__( 'Criminal Defense', 'marbure' ),  'title' => esc_html__( 'Charges Fully Dismissed', 'marbure' ),'outcome' => 'dismissed','settlement' => '' ),
					array( 'category' => esc_html__( 'Personal Injury', 'marbure' ),  'title' => esc_html__( 'Workplace Accident', 'marbure' ),     'outcome' => 'settled', 'settlement' => '$780K' ),
				),
			)
		);

		$this->add_control(
			'columns',
			array(
				'label'   => esc_html__( 'Columns', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'2' => esc_html__( '2 Columns', 'marbure' ),
					'3' => esc_html__( '3 Columns', 'marbure' ),
				),
				'default' => '2',
			)
		);

		$this->end_controls_section();

		// ── CONTENT: Footer ───────────────────────────────────────────────────

		$this->start_controls_section(
			'section_footer',
			array(
				'label' => esc_html__( 'View All Link', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_view_all',
			array(
				'label'        => esc_html__( 'Show "View All" Button', 'marbure' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'view_all_label',
			array(
				'label'     => esc_html__( 'Button Label', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'View All Case Results', 'marbure' ),
				'condition' => array( 'show_view_all' => 'yes' ),
			)
		);

		$this->add_control(
			'view_all_url',
			array(
				'label'     => esc_html__( 'Button URL', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::URL,
				'condition' => array( 'show_view_all' => 'yes' ),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$cases    = $settings['cases'];

		if ( empty( $cases ) ) {
			return;
		}

		$col_map = array( '2' => 'col-md-6', '3' => 'col-md-4' );
		$col     = isset( $col_map[ $settings['columns'] ] ) ? $col_map[ $settings['columns'] ] : 'col-md-6';

		$outcome_labels = array(
			'won'       => esc_html__( 'Won', 'marbure' ),
			'settled'   => esc_html__( 'Settled', 'marbure' ),
			'dismissed' => esc_html__( 'Dismissed', 'marbure' ),
		);
		?>
		<section class="section portfolio-section">
			<div class="container">

				<?php if ( 'yes' === $settings['show_header'] && ( $settings['heading'] || $settings['eyebrow'] ) ) : ?>
					<div class="section__header" data-aos="fade-up">
						<?php if ( $settings['eyebrow'] ) : ?>
							<span class="eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
						<?php endif; ?>
						<?php if ( $settings['heading'] ) : ?>
							<h2 class="section-heading"><?php echo esc_html( $settings['heading'] ); ?></h2>
						<?php endif; ?>
						<?php if ( $settings['subheading'] ) : ?>
							<p class="section-subheading"><?php echo esc_html( $settings['subheading'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="portfolio-grid row" data-aos="fade-up" data-aos-delay="100">
					<?php foreach ( $cases as $case ) :
						$link_url = ! empty( $case['link']['url'] ) ? $case['link']['url'] : '#';
						$outcome  = $case['outcome'];
						$label    = isset( $outcome_labels[ $outcome ] ) ? $outcome_labels[ $outcome ] : ucfirst( $outcome );
					?>
						<div class="<?php echo esc_attr( $col ); ?>">
							<div class="portfolio-card">
								<div class="portfolio-card__image">
									<?php if ( ! empty( $case['image']['url'] ) ) : ?>
										<img
											src="<?php echo esc_url( $case['image']['url'] ); ?>"
											alt="<?php echo esc_attr( $case['title'] ); ?>"
											loading="lazy"
											width="700"
											height="500"
										/>
									<?php else : ?>
										<div class="portfolio-card__image-placeholder" aria-hidden="true">
											<i class="fas fa-gavel"></i>
										</div>
									<?php endif; ?>
									<?php if ( $outcome ) : ?>
										<span class="portfolio-card__outcome portfolio-card__outcome--<?php echo esc_attr( $outcome ); ?>">
											<?php echo esc_html( $label ); ?>
										</span>
									<?php endif; ?>
								</div>
								<div class="portfolio-card__body">
									<?php if ( $case['category'] ) : ?>
										<span class="portfolio-card__cat"><?php echo esc_html( $case['category'] ); ?></span>
									<?php endif; ?>
									<h3 class="portfolio-card__title">
										<a href="<?php echo esc_url( $link_url ); ?>">
											<?php echo esc_html( $case['title'] ); ?>
										</a>
									</h3>
									<?php if ( $case['settlement'] ) : ?>
										<p class="portfolio-card__settlement">
											<?php echo esc_html( $case['settlement'] ); ?>
										</p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<?php if ( 'yes' === $settings['show_view_all'] && ! empty( $settings['view_all_url']['url'] ) ) : ?>
					<div class="section__footer" data-aos="fade-up">
						<a href="<?php echo esc_url( $settings['view_all_url']['url'] ); ?>" class="btn btn--outline">
							<?php echo esc_html( $settings['view_all_label'] ); ?>
						</a>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<?php
	}
}
