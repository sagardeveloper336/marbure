<?php
/**
 * Native WordPress meta boxes for CPT custom fields.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Marbure_Meta_Boxes' ) ) :

	class Marbure_Meta_Boxes {

		public function __construct() {
			add_action( 'add_meta_boxes',        array( $this, 'register' ) );
			add_action( 'save_post',             array( $this, 'save' ), 10, 2 );
			add_action( 'admin_head',            array( $this, 'styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_media' ) );
		}

		public function enqueue_media( $hook ) {
			if ( in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
				wp_enqueue_media();
				wp_enqueue_script(
					'marbure-client-logo',
					get_template_directory_uri() . '/js/admin-client-logo.js',
					array( 'jquery' ),
					'1.0.0',
					true
				);
			}
		}

		public function register() {
			add_meta_box( 'marbure-team-details',        __( 'Team Member Details', 'marbure' ), array( $this, 'render_team' ),        'marbure_team',        'normal', 'high' );
			add_meta_box( 'marbure-service-details',     __( 'Service Details', 'marbure' ),     array( $this, 'render_service' ),     'marbure_service',     'normal', 'high' );
			add_meta_box( 'marbure-portfolio-details',   __( 'Portfolio Details', 'marbure' ),   array( $this, 'render_portfolio' ),   'marbure_portfolio',   'normal', 'high' );
			add_meta_box( 'marbure-testimonial-details', __( 'Testimonial Details', 'marbure' ), array( $this, 'render_testimonial' ), 'marbure_testimonial', 'normal', 'high' );
			add_meta_box( 'marbure-client-logo-hover',   __( 'Client Logo Hover', 'marbure' ),   array( $this, 'render_client_logo_hover' ), 'marbure_client', 'normal', 'high' );
			add_meta_box( 'marbure-client-logo',         __( 'Select Client Logo', 'marbure' ),  array( $this, 'render_client_logo' ),       'marbure_client', 'normal', 'high' );
		}

		// ── Field renderers ───────────────────────────────────────────────────

		public function render_team( $post ) {
			wp_nonce_field( 'marbure_team_save', 'marbure_team_nonce' );
			$fields = array(
				'_team_position'   => __( 'Position / Title', 'marbure' ),
				'_team_phone'      => __( 'Phone', 'marbure' ),
				'_team_email'      => __( 'Email', 'marbure' ),
				'_team_bar_number' => __( 'Certification / Speciality', 'marbure' ),
				'_team_linkedin'   => __( 'LinkedIn URL', 'marbure' ),
				'_team_facebook'   => __( 'Facebook URL', 'marbure' ),
				'_team_twitter'    => __( 'Twitter / X URL', 'marbure' ),
			);
			$this->render_text_fields( $post->ID, $fields );
		}

		public function render_service( $post ) {
			wp_nonce_field( 'marbure_service_save', 'marbure_service_nonce' );
			$fields = array(
				'_service_icon_class' => __( 'Icon Class (e.g. fas fa-balance-scale)', 'marbure' ),
				'_service_tagline'    => __( 'Short Tagline (shown on cards)', 'marbure' ),
			);
			$this->render_text_fields( $post->ID, $fields );

			// Featured checkbox.
			$featured = get_post_meta( $post->ID, '_service_featured', true );
			echo '<p><label>';
			echo '<input type="checkbox" name="_service_featured" value="1"' . checked( '1', $featured, false ) . '> ';
			echo esc_html__( 'Show on Homepage Services Grid', 'marbure' );
			echo '</label></p>';
		}

		public function render_portfolio( $post ) {
			wp_nonce_field( 'marbure_portfolio_save', 'marbure_portfolio_nonce' );
			$fields = array(
				'_portfolio_case_type'   => __( 'Project Type (e.g. Residential, Commercial)', 'marbure' ),
				'_portfolio_settlement'  => __( 'Project Value / Budget (e.g. $50,000)', 'marbure' ),
				'_portfolio_year'        => __( 'Year of Completion', 'marbure' ),
			);
			$this->render_text_fields( $post->ID, $fields );

			// Outcome select.
			$outcome  = get_post_meta( $post->ID, '_portfolio_outcome', true );
			$outcomes = array(
				''            => __( '— Select Status —', 'marbure' ),
				'completed'   => __( 'Completed', 'marbure' ),
				'in-progress' => __( 'In Progress', 'marbure' ),
				'featured'    => __( 'Featured', 'marbure' ),
			);
			echo '<p><label for="_portfolio_outcome"><strong>' . esc_html__( 'Project Status', 'marbure' ) . '</strong></label><br>';
			echo '<select name="_portfolio_outcome" id="_portfolio_outcome">';
			foreach ( $outcomes as $val => $label ) {
				echo '<option value="' . esc_attr( $val ) . '"' . selected( $outcome, $val, false ) . '>' . esc_html( $label ) . '</option>';
			}
			echo '</select></p>';
		}

		public function render_client_logo_hover( $post ) {
			wp_nonce_field( 'marbure_client_save', 'marbure_client_nonce' );
			$image_id  = get_post_meta( $post->ID, '_client_logo_hover_id', true );
			$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'medium' ) : '';
			?>
			<p><?php esc_html_e( 'Select Logo for Hover effect. This logo will appear on mouse over.', 'marbure' ); ?></p>
			<div class="marbure-image-field" data-meta-key="_client_logo_hover_id">
				<?php if ( $image_url ) : ?>
					<img src="<?php echo esc_url( $image_url ); ?>" style="max-width:200px;display:block;margin-bottom:8px;">
					<a href="#" class="marbure-remove-image button"><?php esc_html_e( 'Remove Logo', 'marbure' ); ?></a>
				<?php else : ?>
					<span class="marbure-no-image"><?php esc_html_e( 'No image selected', 'marbure' ); ?></span>
					<a href="#" class="marbure-add-image button button-primary" style="margin-left:8px;"><?php esc_html_e( 'Add Image', 'marbure' ); ?></a>
				<?php endif; ?>
				<input type="hidden" name="_client_logo_hover_id" value="<?php echo esc_attr( $image_id ); ?>">
			</div>
			<?php
		}

		public function render_client_logo( $post ) {
			$image_id  = get_post_meta( $post->ID, '_client_logo_id', true );
			$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'medium' ) : '';
			?>
			<div class="marbure-image-field" data-meta-key="_client_logo_id">
				<?php if ( $image_url ) : ?>
					<img src="<?php echo esc_url( $image_url ); ?>" style="max-width:200px;display:block;margin-bottom:8px;">
					<p><em><?php esc_html_e( 'Click the image to edit or update', 'marbure' ); ?></em></p>
					<a href="#" class="marbure-add-image button"><?php esc_html_e( 'Edit or Update', 'marbure' ); ?></a>
					<a href="#" class="marbure-remove-image" style="color:#a00;margin-left:8px;"><?php esc_html_e( 'Remove Client Logo', 'marbure' ); ?></a>
				<?php else : ?>
					<a href="#" class="marbure-add-image button button-primary"><?php esc_html_e( 'Select Client Logo', 'marbure' ); ?></a>
				<?php endif; ?>
				<input type="hidden" name="_client_logo_id" value="<?php echo esc_attr( $image_id ); ?>">
			</div>
			<?php
		}

		public function render_testimonial( $post ) {
			wp_nonce_field( 'marbure_testimonial_save', 'marbure_testimonial_nonce' );
			$fields = array(
				'_testimonial_client_title' => __( 'Client Title / Description', 'marbure' ),
				'_testimonial_source_url'   => __( 'Source URL (optional)', 'marbure' ),
			);
			$this->render_text_fields( $post->ID, $fields );

			// Star rating select.
			$rating = get_post_meta( $post->ID, '_testimonial_rating', true );
			echo '<p><label for="_testimonial_rating"><strong>' . esc_html__( 'Star Rating', 'marbure' ) . '</strong></label><br>';
			echo '<select name="_testimonial_rating" id="_testimonial_rating">';
			for ( $i = 5; $i >= 1; $i-- ) {
				echo '<option value="' . esc_attr( $i ) . '"' . selected( (int) $rating, $i, false ) . '>' . esc_html( $i ) . ' ' . esc_html__( 'Stars', 'marbure' ) . '</option>';
			}
			echo '</select></p>';
		}

		// ── Save handler ──────────────────────────────────────────────────────

		public function save( $post_id, $post ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
			if ( ! current_user_can( 'edit_post', $post_id ) ) return;

			$nonces = array(
				'marbure_team'        => 'marbure_team_nonce',
				'marbure_service'     => 'marbure_service_nonce',
				'marbure_portfolio'   => 'marbure_portfolio_nonce',
				'marbure_testimonial' => 'marbure_testimonial_nonce',
				'marbure_client'      => 'marbure_client_nonce',
				);

			if ( ! isset( $nonces[ $post->post_type ] ) ) return;

			$nonce_action = 'marbure_' . str_replace( 'marbure_', '', $post->post_type ) . '_save';
			$nonce_field  = $nonces[ $post->post_type ];

			if ( ! isset( $_POST[ $nonce_field ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ $nonce_field ] ) ), $nonce_action ) ) return;

			$text_keys = array(
				'_team_position', '_team_phone', '_team_email', '_team_bar_number',
				'_team_linkedin', '_team_facebook', '_team_twitter',
				'_service_icon_class', '_service_tagline',
				'_portfolio_case_type', '_portfolio_settlement', '_portfolio_year', '_portfolio_outcome',
				'_testimonial_client_title', '_testimonial_source_url',
				);

			foreach ( $text_keys as $key ) {
				if ( isset( $_POST[ $key ] ) ) {
					update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
				}
			}

			// Testimonial rating — integer.
			if ( isset( $_POST['_testimonial_rating'] ) ) {
				update_post_meta( $post_id, '_testimonial_rating', (int) $_POST['_testimonial_rating'] );
			}

			// Service featured — checkbox.
			update_post_meta( $post_id, '_service_featured', isset( $_POST['_service_featured'] ) ? '1' : '0' );

			// Client logos — attachment IDs.
			foreach ( array( '_client_logo_id', '_client_logo_hover_id' ) as $img_key ) {
				if ( isset( $_POST[ $img_key ] ) ) {
					$val = absint( $_POST[ $img_key ] );
					if ( $val ) {
						update_post_meta( $post_id, $img_key, $val );
					} else {
						delete_post_meta( $post_id, $img_key );
					}
				}
			}
		}

		// ── Utility ───────────────────────────────────────────────────────────

		private function render_text_fields( $post_id, $fields ) {
			foreach ( $fields as $key => $label ) {
				$value = get_post_meta( $post_id, $key, true );
				echo '<p>';
				echo '<label for="' . esc_attr( $key ) . '"><strong>' . esc_html( $label ) . '</strong></label><br>';
				echo '<input type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" style="width:100%">';
				echo '</p>';
			}
		}

		public function styles() {
			echo '<style>.marbure-meta-label{font-weight:600;display:block;margin-bottom:4px}</style>';
		}
	}

	new Marbure_Meta_Boxes();

endif;
