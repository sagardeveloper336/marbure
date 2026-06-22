<?php
/**
 * Elementor Widget: Testimonial Carousel
 * Swiper-powered testimonial slider; HTML structure matches testimonials-carousel template-part.
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

		// ── CONTENT: Testimonials ─────────────────────────────────────────────

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
				'default' => esc_html__( 'Personal Injury Client', 'marbure' ),
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
					'1' => '1 ' . esc_html__( 'Star', 'marbure' ),
				),
				'default' => '5',
			)
		);

		$repeater->add_control(
			'quote',
			array(
				'label'   => esc_html__( 'Quote', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'The team fought tirelessly for my case and secured a settlement far beyond what I expected. I am truly grateful.', 'marbure' ),
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
						'client_title' => esc_html__( 'Personal Injury Client', 'marbure' ),
						'rating'       => '5',
						'quote'        => esc_html__( 'The team secured a $2.5M settlement I never thought possible. They treated my case with incredible care.', 'marbure' ),
					),
					array(
						'client_name'  => esc_html__( 'Linda Chen', 'marbure' ),
						'client_title' => esc_html__( 'Family Law Client', 'marbure' ),
						'rating'       => '5',
						'quote'        => esc_html__( 'Professional, compassionate, and relentlessly effective. I will always recommend Marbure Law Firm.', 'marbure' ),
					),
					array(
						'client_name'  => esc_html__( 'David Thompson', 'marbure' ),
						'client_title' => esc_html__( 'Business Litigation Client', 'marbure' ),
						'rating'       => '5',
						'quote'        => esc_html__( 'They turned a complicated dispute into a clear victory. Outstanding strategic thinking throughout.', 'marbure' ),
					),
				),
			)
		);

		$this->end_controls_section();

		// ── CONTENT: Slider Settings ──────────────────────────────────────────

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
		?>
		<section class="section testimonials-section">
			<div class="container">

				<?php if ( 'yes' === $settings['show_header'] && ( $settings['heading'] || $settings['eyebrow'] ) ) : ?>
					<div class="section__header" data-aos="fade-up">
						<?php if ( $settings['eyebrow'] ) : ?>
							<span class="eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
						<?php endif; ?>
						<?php if ( $settings['heading'] ) : ?>
							<h2 class="section-heading"><?php echo esc_html( $settings['heading'] ); ?></h2>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="swiper js-testimonials-swiper" data-aos="fade-up" data-aos-delay="100">
					<div class="swiper-wrapper">

						<?php foreach ( $testimonials as $item ) :
							$rating = max( 1, min( 5, (int) $item['rating'] ) );
						?>
							<div class="swiper-slide">
								<div class="testimonial-card">

									<div class="testimonial-card__quote-icon" aria-hidden="true">
										<i class="fas fa-quote-left"></i>
									</div>

									<div class="testimonial-card__stars" aria-label="<?php printf( esc_attr__( '%d out of 5 stars', 'marbure' ), $rating ); ?>">
										<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
											<i class="<?php echo $i <= $rating ? 'fas fa-star' : 'far fa-star'; ?>" aria-hidden="true"></i>
										<?php endfor; ?>
									</div>

									<blockquote class="testimonial-card__body">
										<p class="testimonial-card__text"><?php echo esc_html( $item['quote'] ); ?></p>
									</blockquote>

									<footer class="testimonial-card__footer">
										<?php if ( ! empty( $item['avatar']['url'] ) ) : ?>
											<div class="testimonial-card__avatar">
												<img
													src="<?php echo esc_url( $item['avatar']['url'] ); ?>"
													alt="<?php echo esc_attr( $item['client_name'] ); ?>"
													loading="lazy"
													width="60"
													height="60"
												/>
											</div>
										<?php else : ?>
											<div class="testimonial-card__avatar testimonial-card__avatar--initials" aria-hidden="true">
												<?php echo esc_html( mb_substr( $item['client_name'], 0, 1 ) ); ?>
											</div>
										<?php endif; ?>
										<div class="testimonial-card__author">
											<?php if ( ! empty( $item['source_url']['url'] ) ) : ?>
												<cite>
													<a href="<?php echo esc_url( $item['source_url']['url'] ); ?>" target="_blank" rel="noopener noreferrer">
														<?php echo esc_html( $item['client_name'] ); ?>
													</a>
												</cite>
											<?php else : ?>
												<cite><?php echo esc_html( $item['client_name'] ); ?></cite>
											<?php endif; ?>
											<?php if ( $item['client_title'] ) : ?>
												<span class="testimonial-card__title"><?php echo esc_html( $item['client_title'] ); ?></span>
											<?php endif; ?>
										</div>
									</footer>

								</div>
							</div>
						<?php endforeach; ?>

					</div><!-- .swiper-wrapper -->

					<div class="swiper-pagination testimonials-swiper__pagination"></div>
				</div><!-- .swiper -->

			</div>
		</section>
		<?php
	}
}
