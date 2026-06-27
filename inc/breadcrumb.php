<?php
/**
 * Breadcrumb generator — expanded in Phase 4.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Marbure_Breadcrumb' ) ) :

	class Marbure_Breadcrumb {

		private $separator;
		private $items = array();

		public function __construct() {
			$this->separator = apply_filters( 'marbure_breadcrumb_separator', '/' );
		}

		public function render() {
			$this->build();
			if ( empty( $this->items ) ) return;

			echo '<nav class="breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'marbure' ) . '">';
			echo '<ol class="breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">';

			$count = count( $this->items );
			foreach ( $this->items as $i => $item ) {
				$is_last = ( $i === $count - 1 );
				echo '<li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
				if ( ! $is_last && ! empty( $item['url'] ) ) {
					echo '<a href="' . esc_url( $item['url'] ) . '" itemprop="item"><span itemprop="name">' . esc_html( $item['label'] ) . '</span></a>';
				} else {
					echo '<span itemprop="name">' . esc_html( $item['label'] ) . '</span>';
				}
				echo '<meta itemprop="position" content="' . esc_attr( $i + 1 ) . '">';
				if ( ! $is_last ) {
					echo '<span class="breadcrumb__sep" aria-hidden="true">' . esc_html( $this->separator ) . '</span>';
				}
				echo '</li>';
			}

			echo '</ol></nav>';
		}

		private function build() {
			$this->items[] = array( 'label' => esc_html__( 'Home', 'marbure' ), 'url' => home_url( '/' ) );

			if ( is_singular() ) {
				$post_type = get_post_type();
				if ( 'marbure_service' === $post_type ) {
					$this->items[] = array( 'label' => esc_html__( 'Services', 'marbure' ), 'url' => get_post_type_archive_link( 'marbure_service' ) );
				} elseif ( 'marbure_portfolio' === $post_type ) {
					$this->items[] = array( 'label' => esc_html__( 'Portfolio', 'marbure' ), 'url' => get_post_type_archive_link( 'marbure_portfolio' ) );
				} elseif ( 'marbure_team' === $post_type ) {
					$this->items[] = array( 'label' => esc_html__( 'Team', 'marbure' ), 'url' => get_post_type_archive_link( 'marbure_team' ) );
				} elseif ( 'post' === $post_type ) {
					$this->items[] = array( 'label' => esc_html__( 'Blog', 'marbure' ), 'url' => get_permalink( get_option( 'page_for_posts' ) ) );
				}
				$this->items[] = array( 'label' => get_the_title(), 'url' => '' );

			} elseif ( is_post_type_archive() ) {
				$this->items[] = array( 'label' => post_type_archive_title( '', false ), 'url' => '' );

			} elseif ( is_category() || is_tag() || is_tax() ) {
				$term = get_queried_object();
				if ( $term && ! is_wp_error( $term ) ) {
					$this->items[] = array( 'label' => $term->name, 'url' => '' );
				}

			} elseif ( is_search() ) {
				$this->items[] = array( 'label' => sprintf( esc_html__( 'Search: %s', 'marbure' ), get_search_query() ), 'url' => '' );

			} elseif ( is_404() ) {
				$this->items[] = array( 'label' => esc_html__( '404 Not Found', 'marbure' ), 'url' => '' );

			} elseif ( is_home() && ! is_front_page() ) {
				$this->items[] = array( 'label' => esc_html__( 'Blog', 'marbure' ), 'url' => '' );

			} elseif ( is_page() ) {
				$this->items[] = array( 'label' => get_the_title(), 'url' => '' );

			} elseif ( is_archive() ) {
				$this->items[] = array( 'label' => get_the_archive_title(), 'url' => '' );
			}
		}
	}

endif;

function marbure_breadcrumb() {
	$bc = new Marbure_Breadcrumb();
	$bc->render();
}
