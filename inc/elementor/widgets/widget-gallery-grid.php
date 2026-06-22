<?php
/**
 * Elementor Widget: Gallery Grid
 * Filterable image grid with GLightbox lightbox support.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Widget_Gallery_Grid extends \Elementor\Widget_Base {

	public function get_name()       { return 'marbure_gallery_grid'; }
	public function get_title()      { return esc_html__( 'Gallery Grid', 'marbure' ); }
	public function get_icon()       { return 'eicon-photo-library'; }
	public function get_categories() { return array( 'marbure' ); }
	public function get_keywords()   { return array( 'gallery', 'grid', 'lightbox', 'images', 'photos' ); }

	public function get_style_depends()  { return array( 'glightbox' ); }
	public function get_script_depends() { return array( 'glightbox' ); }

	protected function register_controls() {

		// ── CONTENT: Images ───────────────────────────────────────────────────

		$this->start_controls_section( 'section_images', array(
			'label' => esc_html__( 'Gallery Images', 'marbure' ),
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		) );

		$repeater = new \Elementor\Repeater();

		$repeater->add_control( 'image', array(
			'label' => esc_html__( 'Image', 'marbure' ),
			'type'  => \Elementor\Controls_Manager::MEDIA,
		) );

		$repeater->add_control( 'caption', array(
			'label'   => esc_html__( 'Caption / Title', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::TEXT,
			'default' => '',
		) );

		$repeater->add_control( 'filter_tag', array(
			'label'       => esc_html__( 'Filter Tag (slug)', 'marbure' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'placeholder' => 'bathroom',
			'description' => esc_html__( 'Used for Isotope filtering. Use lowercase, no spaces.', 'marbure' ),
		) );

		$this->add_control( 'images', array(
			'label'       => esc_html__( 'Images', 'marbure' ),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'title_field' => '{{{ caption || "Image" }}}',
		) );

		$this->end_controls_section();

		// ── CONTENT: Filter ───────────────────────────────────────────────────

		$this->start_controls_section( 'section_filter', array(
			'label' => esc_html__( 'Filter Bar', 'marbure' ),
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		) );

		$this->add_control( 'show_filter', array(
			'label'        => esc_html__( 'Show Filter Bar', 'marbure' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		) );

		$filter_repeater = new \Elementor\Repeater();

		$filter_repeater->add_control( 'filter_label', array(
			'label'   => esc_html__( 'Button Label', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'Bathroom', 'marbure' ),
		) );

		$filter_repeater->add_control( 'filter_value', array(
			'label'       => esc_html__( 'Filter Tag (slug)', 'marbure' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'placeholder' => 'bathroom',
		) );

		$this->add_control( 'filters', array(
			'label'       => esc_html__( 'Filter Buttons', 'marbure' ),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $filter_repeater->get_controls(),
			'title_field' => '{{{ filter_label }}}',
			'condition'   => array( 'show_filter' => 'yes' ),
			'default'     => array(
				array( 'filter_label' => __( 'Bathroom', 'marbure' ),  'filter_value' => 'bathroom' ),
				array( 'filter_label' => __( 'Kitchen', 'marbure' ),   'filter_value' => 'kitchen' ),
				array( 'filter_label' => __( 'Living Room', 'marbure' ),'filter_value' => 'living-room' ),
			),
		) );

		$this->end_controls_section();

		// ── CONTENT: Layout ───────────────────────────────────────────────────

		$this->start_controls_section( 'section_layout', array(
			'label' => esc_html__( 'Layout', 'marbure' ),
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		) );

		$this->add_control( 'columns', array(
			'label'   => esc_html__( 'Columns', 'marbure' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array( '2' => '2', '3' => '3', '4' => '4' ),
			'default' => '3',
		) );

		$this->add_control( 'enable_lightbox', array(
			'label'        => esc_html__( 'Enable Lightbox', 'marbure' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		) );

		$this->end_controls_section();
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$images        = $settings['images'];
		$show_filter   = 'yes' === $settings['show_filter'];
		$enable_lb     = 'yes' === $settings['enable_lightbox'];
		$col_map       = array( '2' => 'col-md-6', '3' => 'col-md-4', '4' => 'col-md-3' );
		$col           = $col_map[ $settings['columns'] ] ?? 'col-md-4';

		if ( empty( $images ) ) return;
		?>
		<div class="gallery-widget">

			<?php if ( $show_filter && ! empty( $settings['filters'] ) ) : ?>
				<div class="tax-filter gallery-filter" role="group" aria-label="<?php esc_attr_e( 'Filter gallery', 'marbure' ); ?>">
					<button class="tax-filter__btn is-active js-filter-btn" data-filter="*"><?php esc_html_e( 'All', 'marbure' ); ?></button>
					<?php foreach ( $settings['filters'] as $f ) : ?>
						<button class="tax-filter__btn js-filter-btn" data-filter=".tag-<?php echo esc_attr( $f['filter_value'] ); ?>">
							<?php echo esc_html( $f['filter_label'] ); ?>
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="gallery-grid js-portfolio-grid">
				<?php foreach ( $images as $item ) :
					if ( empty( $item['image']['url'] ) ) continue;
					$tag_class = $item['filter_tag'] ? ' tag-' . sanitize_html_class( $item['filter_tag'] ) : '';
				?>
					<div class="gallery-item<?php echo esc_attr( $tag_class ); ?> <?php echo esc_attr( $col ); ?>">
						<?php if ( $enable_lb ) : ?>
							<a
								href="<?php echo esc_url( $item['image']['url'] ); ?>"
								class="gallery-item__link glightbox"
								data-gallery="marbure-gallery-<?php echo esc_attr( $this->get_id() ); ?>"
								data-title="<?php echo esc_attr( $item['caption'] ); ?>"
								aria-label="<?php echo esc_attr( $item['caption'] ?: __( 'View image', 'marbure' ) ); ?>"
							>
						<?php else : ?>
							<div class="gallery-item__link">
						<?php endif; ?>

							<img
								src="<?php echo esc_url( $item['image']['url'] ); ?>"
								alt="<?php echo esc_attr( $item['caption'] ); ?>"
								loading="lazy"
							>
							<div class="gallery-item__overlay">
								<?php if ( $enable_lb ) : ?>
									<i class="fas fa-search-plus" aria-hidden="true"></i>
								<?php endif; ?>
								<?php if ( $item['caption'] ) : ?>
									<span class="gallery-item__title"><?php echo esc_html( $item['caption'] ); ?></span>
								<?php endif; ?>
							</div>

						<?php echo $enable_lb ? '</a>' : '</div>'; ?>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
		<?php
	}
}
