<?php
/**
 * Elementor Widget: Service Card Grid
 * Renders a grid of practice area cards from a repeater.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Service_Card extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_service_card'; }
	public function get_title()      { return esc_html__( 'Service Cards', 'marbure' ); }
	public function get_icon()       { return 'eicon-icon-box'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'service', 'practice', 'card', 'grid', 'icon' ); }

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
				'default'   => esc_html__( 'What We Do', 'marbure' ),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'     => esc_html__( 'Heading', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Our Practice Areas', 'marbure' ),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'subheading',
			array(
				'label'     => esc_html__( 'Subheading', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'default'   => esc_html__( 'We offer a comprehensive range of legal services, each delivered with the expertise your case demands.', 'marbure' ),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// ── CONTENT: Cards ────────────────────────────────────────────────────

		$this->start_controls_section(
			'section_cards',
			array(
				'label' => esc_html__( 'Cards', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon_class',
			array(
				'label'       => esc_html__( 'Icon (Font Awesome class)', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'fas fa-balance-scale',
				'default'     => 'fas fa-balance-scale',
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Criminal Defense', 'marbure' ),
			)
		);

		$repeater->add_control(
			'excerpt',
			array(
				'label'   => esc_html__( 'Excerpt', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Expert defense strategies tailored to protect your rights and future.', 'marbure' ),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'         => esc_html__( 'Card Link', 'marbure' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => esc_html__( '/practice-areas/criminal-defense', 'marbure' ),
				'show_external' => false,
			)
		);

		$this->add_control(
			'cards',
			array(
				'label'       => esc_html__( 'Service Cards', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array( 'icon_class' => 'fas fa-balance-scale', 'title' => esc_html__( 'Criminal Defense', 'marbure' ), 'excerpt' => esc_html__( 'Expert defense strategies tailored to protect your rights.', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-car-crash',     'title' => esc_html__( 'Personal Injury', 'marbure' ),   'excerpt' => esc_html__( 'Fighting for maximum compensation after an accident.', 'marbure' ) ),
					array( 'icon_class' => 'fas fa-building',      'title' => esc_html__( 'Business Law', 'marbure' ),      'excerpt' => esc_html__( 'Comprehensive legal support for your business needs.', 'marbure' ) ),
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
					'4' => esc_html__( '4 Columns', 'marbure' ),
				),
				'default' => '3',
			)
		);

		$this->add_control(
			'cta_label',
			array(
				'label'     => esc_html__( 'Link Text', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Learn More', 'marbure' ),
				'separator' => 'before',
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
				'default'   => esc_html__( 'View All Practice Areas', 'marbure' ),
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
		$cards    = $settings['cards'];

		if ( empty( $cards ) ) {
			return;
		}

		$col_map = array( '2' => 'col-md-6', '3' => 'col-md-4', '4' => 'col-md-3' );
		$col     = isset( $col_map[ $settings['columns'] ] ) ? $col_map[ $settings['columns'] ] : 'col-md-4';
		?>
		<section class="section services-section">
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

				<div class="services-grid row" data-aos="fade-up" data-aos-delay="100">
					<?php foreach ( $cards as $card ) :
						$link_url = ! empty( $card['link']['url'] ) ? $card['link']['url'] : '#';
						$ext      = ! empty( $card['link']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
					?>
						<div class="<?php echo esc_attr( $col ); ?>">
							<div class="service-card">
								<?php if ( $card['icon_class'] ) : ?>
									<div class="service-card__icon">
										<i class="<?php echo esc_attr( $card['icon_class'] ); ?>" aria-hidden="true"></i>
									</div>
								<?php endif; ?>
								<h3 class="service-card__title">
									<a href="<?php echo esc_url( $link_url ); ?>"<?php echo $ext; // phpcs:ignore ?>>
										<?php echo esc_html( $card['title'] ); ?>
									</a>
								</h3>
								<?php if ( $card['excerpt'] ) : ?>
									<p class="service-card__tagline"><?php echo esc_html( $card['excerpt'] ); ?></p>
								<?php endif; ?>
								<a href="<?php echo esc_url( $link_url ); ?>"<?php echo $ext; // phpcs:ignore ?> class="service-card__link btn--ghost">
									<?php echo esc_html( $settings['cta_label'] ?: __( 'Learn More', 'marbure' ) ); ?>
								</a>
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
