<?php
/**
 * Elementor Widget: Team Card Grid
 * Attorney cards with photo, name, role, social links, and hover overlay.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Team_Card extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_team_card'; }
	public function get_title()      { return esc_html__( 'Team Cards', 'marbure' ); }
	public function get_icon()       { return 'eicon-person'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'team', 'attorney', 'lawyer', 'staff', 'card', 'grid' ); }

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
				'default'   => esc_html__( 'Meet the Team', 'marbure' ),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'     => esc_html__( 'Heading', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Our Expert Attorneys', 'marbure' ),
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

		// ── CONTENT: Members ──────────────────────────────────────────────────

		$this->start_controls_section(
			'section_members',
			array(
				'label' => esc_html__( 'Team Members', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'photo',
			array(
				'label' => esc_html__( 'Photo', 'marbure' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'name',
			array(
				'label'   => esc_html__( 'Name', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'John Smith', 'marbure' ),
			)
		);

		$repeater->add_control(
			'role',
			array(
				'label'   => esc_html__( 'Role / Title', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Senior Partner', 'marbure' ),
			)
		);

		$repeater->add_control(
			'profile_url',
			array(
				'label'     => esc_html__( 'Profile Link', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::URL,
				'separator' => 'before',
			)
		);

		$repeater->add_control(
			'linkedin',
			array(
				'label'       => esc_html__( 'LinkedIn URL', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://linkedin.com/in/...',
			)
		);

		$repeater->add_control(
			'twitter',
			array(
				'label'       => esc_html__( 'Twitter/X URL', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://twitter.com/...',
			)
		);

		$repeater->add_control(
			'facebook',
			array(
				'label'       => esc_html__( 'Facebook URL', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://facebook.com/...',
			)
		);

		$this->add_control(
			'members',
			array(
				'label'       => esc_html__( 'Members', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
				'default'     => array(
					array( 'name' => esc_html__( 'John Smith', 'marbure' ),   'role' => esc_html__( 'Senior Partner', 'marbure' ) ),
					array( 'name' => esc_html__( 'Sarah Johnson', 'marbure' ),'role' => esc_html__( 'Criminal Defense', 'marbure' ) ),
					array( 'name' => esc_html__( 'Michael Lee', 'marbure' ),  'role' => esc_html__( 'Personal Injury', 'marbure' ) ),
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
			'show_socials',
			array(
				'label'        => esc_html__( 'Show Social Links', 'marbure' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$members  = $settings['members'];

		if ( empty( $members ) ) {
			return;
		}

		$col_map = array( '2' => 'col-md-6', '3' => 'col-md-4', '4' => 'col-md-3' );
		$col     = isset( $col_map[ $settings['columns'] ] ) ? $col_map[ $settings['columns'] ] : 'col-md-4';

		$social_map = array(
			'linkedin' => 'fab fa-linkedin-in',
			'twitter'  => 'fab fa-x-twitter',
			'facebook' => 'fab fa-facebook-f',
		);
		?>
		<section class="section team-section">
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

				<div class="team-grid row" data-aos="fade-up" data-aos-delay="100">
					<?php foreach ( $members as $member ) :
						$profile_url = ! empty( $member['profile_url']['url'] ) ? $member['profile_url']['url'] : '#';
					?>
						<div class="<?php echo esc_attr( $col ); ?>">
							<div class="team-card">
								<div class="team-card__photo">
									<?php if ( ! empty( $member['photo']['url'] ) ) : ?>
										<img
											src="<?php echo esc_url( $member['photo']['url'] ); ?>"
											alt="<?php echo esc_attr( $member['name'] ); ?>"
											loading="lazy"
											width="400"
											height="500"
										/>
									<?php else : ?>
										<div class="team-card__photo-placeholder" aria-hidden="true">
											<i class="fas fa-user"></i>
										</div>
									<?php endif; ?>

									<?php if ( 'yes' === $settings['show_socials'] ) : ?>
										<div class="team-card__hover-overlay">
											<div class="team-card__socials">
												<?php foreach ( $social_map as $network => $icon ) :
													if ( empty( $member[ $network ]['url'] ) ) continue;
												?>
													<a
														href="<?php echo esc_url( $member[ $network ]['url'] ); ?>"
														class="team-card__social-link"
														target="_blank"
														rel="noopener noreferrer"
														aria-label="<?php echo esc_attr( ucfirst( $network ) ); ?>"
													>
														<i class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
													</a>
												<?php endforeach; ?>
											</div>
										</div>
									<?php endif; ?>
								</div>

								<div class="team-card__info">
									<h3 class="team-card__name">
										<a href="<?php echo esc_url( $profile_url ); ?>">
											<?php echo esc_html( $member['name'] ); ?>
										</a>
									</h3>
									<?php if ( $member['role'] ) : ?>
										<span class="team-card__role"><?php echo esc_html( $member['role'] ); ?></span>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
		</section>
		<?php
	}
}
