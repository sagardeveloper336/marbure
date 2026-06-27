<?php
/**
 * Elementor Widget: FAQ Accordion
 * Accessible accordion; JS init handled by main.js (.faq-accordion selector).
 * Optional FAQPage JSON-LD schema output.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Faq_Accordion extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_faq_accordion'; }
	public function get_title()      { return esc_html__( 'FAQ Accordion', 'marbure' ); }
	public function get_icon()       { return 'eicon-accordion'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'faq', 'accordion', 'question', 'answer', 'toggle' ); }

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
				'default'   => esc_html__( 'FAQ', 'marbure' ),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'     => esc_html__( 'Heading', 'marbure' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Frequently Asked Questions', 'marbure' ),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);

		$this->end_controls_section();

		// ── CONTENT: Questions ────────────────────────────────────────────────

		$this->start_controls_section(
			'section_faqs',
			array(
				'label' => esc_html__( 'Questions & Answers', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'question',
			array(
				'label'   => esc_html__( 'Question', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'What types of stone do you supply?', 'marbure' ),
			)
		);

		$repeater->add_control(
			'answer',
			array(
				'label'   => esc_html__( 'Answer', 'marbure' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'We supply marble, granite, travertine, limestone, quartzite, and onyx sourced directly from quarries worldwide.', 'marbure' ),
			)
		);

		$this->add_control(
			'faqs',
			array(
				'label'       => esc_html__( 'FAQs', 'marbure' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ question }}}',
				'default'     => array(
					array(
						'question' => esc_html__( 'What types of stone do you supply?', 'marbure' ),
						'answer'   => esc_html__( 'We supply a wide range of natural stone including marble, granite, travertine, limestone, quartzite, and onyx — sourced directly from quarries in Italy, Turkey, India, and Brazil.', 'marbure' ),
					),
					array(
						'question' => esc_html__( 'Do you offer installation services?', 'marbure' ),
						'answer'   => esc_html__( 'Yes. Our certified installation team handles everything from floor and wall tiling to custom countertops and feature walls. We manage the full project from design to completion.', 'marbure' ),
					),
					array(
						'question' => esc_html__( 'How long does a typical installation take?', 'marbure' ),
						'answer'   => esc_html__( 'Project timelines depend on scope. A bathroom floor can take 1-2 days; a full kitchen or commercial installation may take 1-2 weeks. We provide a detailed schedule before work begins.', 'marbure' ),
					),
					array(
						'question' => esc_html__( 'Can I request a custom stone cut or finish?', 'marbure' ),
						'answer'   => esc_html__( 'Absolutely. We offer custom cutting, edge profiling (polished, honed, brushed, or leathered), and bespoke sizing for any application. Contact us with your specifications for a quote.', 'marbure' ),
					),
				),
			)
		);

		$this->add_control(
			'open_first',
			array(
				'label'        => esc_html__( 'Open First Item by Default', 'marbure' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'schema_markup',
			array(
				'label'        => esc_html__( 'Output FAQPage Schema (JSON-LD)', 'marbure' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$faqs     = $settings['faqs'];

		if ( empty( $faqs ) ) {
			return;
		}

		$open_first = 'yes' === $settings['open_first'];
		?>
		<section class="section faq-section">
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

				<div class="faq-accordion" data-aos="fade-up" data-aos-delay="100">
					<?php foreach ( $faqs as $index => $faq ) :
						$is_open  = $open_first && 0 === $index;
						$panel_id = 'faq-panel-' . $this->get_id() . '-' . $index;
					?>
						<div class="faq-item<?php echo $is_open ? ' is-open' : ''; ?>">
							<button
								class="faq-item__question"
								aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
								aria-controls="<?php echo esc_attr( $panel_id ); ?>"
							>
								<span><?php echo esc_html( $faq['question'] ); ?></span>
								<i class="fas fa-plus faq-item__icon" aria-hidden="true"></i>
							</button>
							<div
								class="faq-item__answer"
								id="<?php echo esc_attr( $panel_id ); ?>"
								aria-hidden="<?php echo $is_open ? 'false' : 'true'; ?>"
							>
								<p><?php echo wp_kses_post( $faq['answer'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
		</section>

		<?php if ( 'yes' === $settings['schema_markup'] && ! empty( $faqs ) ) :
			$schema_items = array();
			foreach ( $faqs as $faq ) {
				$schema_items[] = array(
					'@type'          => 'Question',
					'name'           => wp_strip_all_tags( $faq['question'] ),
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => wp_strip_all_tags( $faq['answer'] ),
					),
				);
			}
			$schema = array(
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => $schema_items,
			);
		?>
			<script type="application/ld+json">
			<?php echo wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?>
			</script>
		<?php endif;
	}
}
