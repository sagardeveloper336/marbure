<?php
/**
 * Elementor Widget: Project Cards
 * Grid of completed project cards with image, location, type, area.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Project_Card extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_project_card'; }
	public function get_title()      { return esc_html__( 'Project Cards', 'marbure' ); }
	public function get_icon()       { return 'eicon-image-box'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'project', 'portfolio', 'installation', 'work', 'gallery' ); }

	protected function register_controls() {

		// ── CONTENT: Section Header ────────────────────────────────────────────

		$this->start_controls_section( 'section_header', array(
			'label' => esc_html__( 'Section Header', 'marbure' ),
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		) );

		$this->add_control( 'show_header', array(
			'label'        => esc_html__( 'Show Section Header', 'marbure' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		) );

		$this->add_control( 'eyebrow', array(
			'label'     => esc_html__( 'Eyebrow Text', 'marbure' ),
			'type'      => \Elementor\Controls_Manager::TEXT,
			'default'   => esc_html__( 'Our Work', 'marbure' ),
			'condition' => array( 'show_header' => 'yes' ),
		) );

		$this->add_control( 'heading', array(
			'label'     => esc_html__( 'Heading', 'marbure' ),
			'type'      => \Elementor\Controls_Manager::TEXT,
			'default'   => esc_html__( 'Recent Projects', 'marbure' ),
			'condition' => array( 'show_header' => 'yes' ),
		) );

		$this->add_control( 'subheading', array(
			'label'     => esc_html__( 'Subheading', 'marbure' ),
			'type'      => \Elementor\Controls_Manager::TEXTAREA,
			'condition' => array( 'show_header' => 'yes' ),
		) );

		$this->end_controls_section();

		// ── CONTENT: Projects ─────────────────────────────────────────────────

		$this->start_controls_section( 'section_projects', array(
			'label' => esc_html__( 'Projects', 'marbure' ),
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		) );

		$repeater = new \Elementor\Repeater();

		$repeater->add_control( 'image', array(
			'label' => esc_html__( 'Project Image', 'marbure' ),
			'type'  => \Elementor\Controls_Manager::MEDIA,
		) );

		$repeater->add_control( 'title', array(
			'label'   => esc_html__( 'Project Title', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'Modern Kitchen Renovation', 'marbure' ),
		) );

		$repeater->add_control( 'location', array(
			'label'   => esc_html__( 'Location', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'London', 'marbure' ),
		) );

		$repeater->add_control( 'type', array(
			'label'   => esc_html__( 'Project Type', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				'Residential'  => esc_html__( 'Residential', 'marbure' ),
				'Commercial'   => esc_html__( 'Commercial', 'marbure' ),
				'Hospitality'  => esc_html__( 'Hospitality', 'marbure' ),
			),
			'default' => 'Residential',
		) );

		$repeater->add_control( 'area', array(
			'label'       => esc_html__( 'Area Covered', 'marbure' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'placeholder' => '45 sqm',
		) );

		$repeater->add_control( 'link', array(
			'label'         => esc_html__( 'Project Link', 'marbure' ),
			'type'          => \Elementor\Controls_Manager::URL,
			'show_external' => false,
		) );

		$this->add_control( 'projects', array(
			'label'       => esc_html__( 'Projects', 'marbure' ),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'title_field' => '{{{ title }}}',
			'default'     => array(
				array( 'title' => __( 'Modern Kitchen Renovation', 'marbure' ),   'location' => 'London',     'type' => 'Residential', 'area' => '42 sqm' ),
				array( 'title' => __( 'Hotel Lobby Flooring', 'marbure' ),        'location' => 'Manchester', 'type' => 'Hospitality', 'area' => '380 sqm' ),
				array( 'title' => __( 'Luxury Bathroom Refit', 'marbure' ),       'location' => 'Birmingham', 'type' => 'Residential', 'area' => '18 sqm' ),
				array( 'title' => __( 'Office Reception Tiling', 'marbure' ),     'location' => 'Leeds',      'type' => 'Commercial',  'area' => '120 sqm' ),
			),
		) );

		$this->add_control( 'columns', array(
			'label'   => esc_html__( 'Columns', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array( '2' => '2', '3' => '3' ),
			'default' => '3',
		) );

		$this->end_controls_section();

		// ── CONTENT: Footer ───────────────────────────────────────────────────

		$this->start_controls_section( 'section_footer', array(
			'label' => esc_html__( 'View All Link', 'marbure' ),
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		) );

		$this->add_control( 'show_view_all', array(
			'label'        => esc_html__( 'Show "View All" Button', 'marbure' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		) );

		$this->add_control( 'view_all_label', array(
			'label'     => esc_html__( 'Button Label', 'marbure' ),
			'type'      => \Elementor\Controls_Manager::TEXT,
			'default'   => esc_html__( 'View All Projects', 'marbure' ),
			'condition' => array( 'show_view_all' => 'yes' ),
		) );

		$this->add_control( 'view_all_url', array(
			'label'     => esc_html__( 'Button URL', 'marbure' ),
			'type'      => \Elementor\Controls_Manager::URL,
			'condition' => array( 'show_view_all' => 'yes' ),
		) );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$projects = $settings['projects'];

		if ( empty( $projects ) ) return;

		$col_map = array( '2' => 'col-md-6', '3' => 'col-md-4' );
		$col     = $col_map[ $settings['columns'] ] ?? 'col-md-4';
		?>
		<section class="section projects-section">
			<div class="container">

				<?php if ( 'yes' === $settings['show_header'] && ( $settings['heading'] || $settings['eyebrow'] ) ) : ?>
					<div class="section__header" data-aos="fade-up">
						<?php if ( $settings['eyebrow'] ) : ?><span class="eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span><?php endif; ?>
						<?php if ( $settings['heading'] ) : ?><h2 class="section-heading"><?php echo esc_html( $settings['heading'] ); ?></h2><?php endif; ?>
						<?php if ( $settings['subheading'] ) : ?><p class="section-subheading"><?php echo esc_html( $settings['subheading'] ); ?></p><?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="projects-grid row" data-aos="fade-up" data-aos-delay="100">
					<?php foreach ( $projects as $project ) :
						$link_url = ! empty( $project['link']['url'] ) ? $project['link']['url'] : '#';
						$ext      = ! empty( $project['link']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
					?>
						<div class="<?php echo esc_attr( $col ); ?>">
							<div class="project-card">
								<div class="project-card__image">
									<?php if ( ! empty( $project['image']['url'] ) ) : ?>
										<a href="<?php echo esc_url( $link_url ); ?>"<?php echo $ext; // phpcs:ignore ?> tabindex="-1" aria-hidden="true">
											<img src="<?php echo esc_url( $project['image']['url'] ); ?>" alt="<?php echo esc_attr( $project['title'] ); ?>" loading="lazy" width="700" height="500">
										</a>
									<?php else : ?>
										<div class="project-card__image-placeholder" aria-hidden="true"><i class="fas fa-image"></i></div>
									<?php endif; ?>
									<div class="project-card__overlay">
										<?php if ( $project['location'] ) : ?>
											<span class="project-card__location"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> <?php echo esc_html( $project['location'] ); ?></span>
										<?php endif; ?>
										<?php if ( $project['type'] ) : ?>
											<span class="project-card__type"><?php echo esc_html( $project['type'] ); ?></span>
										<?php endif; ?>
									</div>
								</div>
								<div class="project-card__body">
									<h3 class="project-card__title">
										<a href="<?php echo esc_url( $link_url ); ?>"<?php echo $ext; // phpcs:ignore ?>><?php echo esc_html( $project['title'] ); ?></a>
									</h3>
									<?php if ( $project['area'] ) : ?>
										<span class="project-card__area"><i class="fas fa-vector-square" aria-hidden="true"></i> <?php echo esc_html( $project['area'] ); ?></span>
									<?php endif; ?>
									<a href="<?php echo esc_url( $link_url ); ?>"<?php echo $ext; // phpcs:ignore ?> class="btn--ghost"><?php esc_html_e( 'View Project', 'marbure' ); ?></a>
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
