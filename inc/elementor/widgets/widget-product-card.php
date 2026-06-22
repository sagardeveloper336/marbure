<?php
/**
 * Elementor Widget: Product Cards
 * Grid of tile/flooring product cards with image, material, size, finish.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Product_Card extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_product_card'; }
	public function get_title()      { return esc_html__( 'Product Cards', 'marbure' ); }
	public function get_icon()       { return 'eicon-gallery-grid'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'product', 'tile', 'collection', 'card', 'grid', 'flooring' ); }

	protected function register_controls() {

		// ── CONTENT: Section Header ────────────────────────────────────────────

		$this->start_controls_section(
			'section_header',
			array(
				'label' => esc_html__( 'Section Header', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control( 'show_header', array(
			'label' => esc_html__( 'Show Section Header', 'marbure' ),
			'type'  => \Elementor\Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		) );

		$this->add_control( 'eyebrow', array(
			'label'     => esc_html__( 'Eyebrow Text', 'marbure' ),
			'type'      => \Elementor\Controls_Manager::TEXT,
			'default'   => esc_html__( 'Our Collections', 'marbure' ),
			'condition' => array( 'show_header' => 'yes' ),
		) );

		$this->add_control( 'heading', array(
			'label'     => esc_html__( 'Heading', 'marbure' ),
			'type'      => \Elementor\Controls_Manager::TEXT,
			'default'   => esc_html__( 'Featured Tiles & Flooring', 'marbure' ),
			'condition' => array( 'show_header' => 'yes' ),
		) );

		$this->add_control( 'subheading', array(
			'label'     => esc_html__( 'Subheading', 'marbure' ),
			'type'      => \Elementor\Controls_Manager::TEXTAREA,
			'default'   => esc_html__( 'Explore our curated selection of premium tiles for every space and style.', 'marbure' ),
			'condition' => array( 'show_header' => 'yes' ),
		) );

		$this->end_controls_section();

		// ── CONTENT: Cards ────────────────────────────────────────────────────

		$this->start_controls_section(
			'section_cards',
			array(
				'label' => esc_html__( 'Product Cards', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control( 'image', array(
			'label' => esc_html__( 'Product Image', 'marbure' ),
			'type'  => \Elementor\Controls_Manager::MEDIA,
		) );

		$repeater->add_control( 'category', array(
			'label'   => esc_html__( 'Category', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'Floor Tiles', 'marbure' ),
		) );

		$repeater->add_control( 'title', array(
			'label'   => esc_html__( 'Product Name', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'Milano Marble Effect', 'marbure' ),
		) );

		$repeater->add_control( 'material', array(
			'label'   => esc_html__( 'Material', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'Porcelain', 'marbure' ),
		) );

		$repeater->add_control( 'size', array(
			'label'       => esc_html__( 'Size', 'marbure' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'placeholder' => '600×600mm',
			'default'     => '600×600mm',
		) );

		$repeater->add_control( 'finish', array(
			'label'   => esc_html__( 'Finish Badge', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'Matte', 'marbure' ),
		) );

		$repeater->add_control( 'link', array(
			'label'         => esc_html__( 'Product Link', 'marbure' ),
			'type'          => \Elementor\Controls_Manager::URL,
			'show_external' => false,
		) );

		$this->add_control( 'cards', array(
			'label'       => esc_html__( 'Products', 'marbure' ),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'title_field' => '{{{ title }}}',
			'default'     => array(
				array( 'category' => __( 'Floor Tiles', 'marbure' ),  'title' => __( 'Milano Marble Effect', 'marbure' ), 'material' => 'Porcelain', 'size' => '600×600mm', 'finish' => __( 'Matte', 'marbure' ) ),
				array( 'category' => __( 'Wall Tiles', 'marbure' ),   'title' => __( 'Metro Gloss White', 'marbure' ),    'material' => 'Ceramic',   'size' => '300×600mm', 'finish' => __( 'Gloss', 'marbure' ) ),
				array( 'category' => __( 'Outdoor', 'marbure' ),      'title' => __( 'Slate Grey Patio', 'marbure' ),     'material' => 'Porcelain', 'size' => '600×900mm', 'finish' => __( 'Textured', 'marbure' ) ),
			),
		) );

		$this->add_control( 'columns', array(
			'label'   => esc_html__( 'Columns', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
			'default' => '3',
		) );

		$this->end_controls_section();

		// ── CONTENT: Footer ───────────────────────────────────────────────────

		$this->start_controls_section(
			'section_footer',
			array(
				'label' => esc_html__( 'View All Link', 'marbure' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control( 'show_view_all', array(
			'label'        => esc_html__( 'Show "View All" Button', 'marbure' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		) );

		$this->add_control( 'view_all_label', array(
			'label'     => esc_html__( 'Button Label', 'marbure' ),
			'type'      => \Elementor\Controls_Manager::TEXT,
			'default'   => esc_html__( 'Browse All Products', 'marbure' ),
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
		$cards    = $settings['cards'];

		if ( empty( $cards ) ) return;

		$col_map = array( '2' => 'col-md-6', '3' => 'col-md-4', '4' => 'col-md-3' );
		$col     = $col_map[ $settings['columns'] ] ?? 'col-md-4';
		?>
		<section class="section collections-section">
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

				<div class="collections-grid row" data-aos="fade-up" data-aos-delay="100">
					<?php foreach ( $cards as $card ) :
						$link_url = ! empty( $card['link']['url'] ) ? $card['link']['url'] : '#';
						$ext      = ! empty( $card['link']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
					?>
						<div class="<?php echo esc_attr( $col ); ?>">
							<div class="product-card">
								<div class="product-card__image">
									<?php if ( ! empty( $card['image']['url'] ) ) : ?>
										<a href="<?php echo esc_url( $link_url ); ?>"<?php echo $ext; // phpcs:ignore ?> tabindex="-1" aria-hidden="true">
											<img src="<?php echo esc_url( $card['image']['url'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" loading="lazy" width="700" height="500">
										</a>
									<?php else : ?>
										<div class="product-card__image-placeholder" aria-hidden="true">
											<i class="fas fa-th-large"></i>
										</div>
									<?php endif; ?>
									<?php if ( $card['finish'] ) : ?>
										<span class="product-card__badge"><?php echo esc_html( $card['finish'] ); ?></span>
									<?php endif; ?>
								</div>
								<div class="product-card__body">
									<?php if ( $card['category'] ) : ?>
										<span class="product-card__cat"><?php echo esc_html( $card['category'] ); ?></span>
									<?php endif; ?>
									<h3 class="product-card__title">
										<a href="<?php echo esc_url( $link_url ); ?>"<?php echo $ext; // phpcs:ignore ?>><?php echo esc_html( $card['title'] ); ?></a>
									</h3>
									<?php if ( $card['material'] || $card['size'] ) : ?>
										<ul class="product-card__meta">
											<?php if ( $card['material'] ) : ?><li><i class="fas fa-layer-group" aria-hidden="true"></i> <?php echo esc_html( $card['material'] ); ?></li><?php endif; ?>
											<?php if ( $card['size'] ) : ?><li><i class="fas fa-expand-alt" aria-hidden="true"></i> <?php echo esc_html( $card['size'] ); ?></li><?php endif; ?>
										</ul>
									<?php endif; ?>
									<a href="<?php echo esc_url( $link_url ); ?>"<?php echo $ext; // phpcs:ignore ?> class="btn--ghost"><?php esc_html_e( 'View Details', 'marbure' ); ?></a>
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
