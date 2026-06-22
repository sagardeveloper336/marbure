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
			add_action( 'add_meta_boxes', array( $this, 'register' ) );
			add_action( 'save_post',      array( $this, 'save' ), 10, 2 );
			add_action( 'admin_head',     array( $this, 'styles' ) );
		}

		public function register() {
			add_meta_box( 'marbure-team-details',        __( 'Attorney Details', 'marbure' ),    array( $this, 'render_team' ),        'marbure_team',        'normal', 'high' );
			add_meta_box( 'marbure-service-details',     __( 'Service Details', 'marbure' ),     array( $this, 'render_service' ),     'marbure_service',     'normal', 'high' );
			add_meta_box( 'marbure-portfolio-details',   __( 'Case Details', 'marbure' ),        array( $this, 'render_portfolio' ),   'marbure_portfolio',   'normal', 'high' );
			add_meta_box( 'marbure-testimonial-details', __( 'Testimonial Details', 'marbure' ), array( $this, 'render_testimonial' ), 'marbure_testimonial', 'normal', 'high' );
		}

		// ── Field renderers ───────────────────────────────────────────────────

		public function render_team( $post ) {
			wp_nonce_field( 'marbure_team_save', 'marbure_team_nonce' );
			$fields = array(
				'_team_position'   => __( 'Position / Title', 'marbure' ),
				'_team_phone'      => __( 'Phone', 'marbure' ),
				'_team_email'      => __( 'Email', 'marbure' ),
				'_team_bar_number' => __( 'Bar Number', 'marbure' ),
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
				'_portfolio_case_type'   => __( 'Case Type', 'marbure' ),
				'_portfolio_settlement'  => __( 'Settlement / Award Value (e.g. $2.5M)', 'marbure' ),
				'_portfolio_year'        => __( 'Year of Resolution', 'marbure' ),
			);
			$this->render_text_fields( $post->ID, $fields );

			// Outcome select.
			$outcome  = get_post_meta( $post->ID, '_portfolio_outcome', true );
			$outcomes = array(
				''          => __( '— Select Outcome —', 'marbure' ),
				'won'       => __( 'Won', 'marbure' ),
				'settled'   => __( 'Settled', 'marbure' ),
				'dismissed' => __( 'Dismissed', 'marbure' ),
			);
			echo '<p><label for="_portfolio_outcome"><strong>' . esc_html__( 'Outcome', 'marbure' ) . '</strong></label><br>';
			echo '<select name="_portfolio_outcome" id="_portfolio_outcome">';
			foreach ( $outcomes as $val => $label ) {
				echo '<option value="' . esc_attr( $val ) . '"' . selected( $outcome, $val, false ) . '>' . esc_html( $label ) . '</option>';
			}
			echo '</select></p>';
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
