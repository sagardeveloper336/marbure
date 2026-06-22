<?php
/**
 * Breadcrumb generator — builds an accessible breadcrumb trail.
 * Outputs a <nav> with a <ol class="breadcrumb"> list.
 *
 * Usage: Marbure_Breadcrumb::render();
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Breadcrumb {

	/** @var string Separator character shown between crumbs. */
	private static $separator = '/';

	/** @var array Accumulated crumb items [ 'label' => string, 'url' => string|null ] */
	private static $crumbs = array();

	/**
	 * Build and output the breadcrumb trail.
	 */
	public static function render() {
		if ( is_front_page() ) return;

		self::$crumbs    = array();
		self::$separator = get_theme_mod( 'marbure_breadcrumb_sep', '/' );

		// Home crumb — always first.
		self::add( esc_html__( 'Home', 'marbure' ), home_url( '/' ) );

		self::build();

		if ( count( self::$crumbs ) <= 1 ) return;

		self::output();
	}

	/**
	 * Add a crumb to the trail.
	 *
	 * @param string      $label Display text.
	 * @param string|null $url   URL — null for the current (last) crumb.
	 */
	private static function add( $label, $url = null ) {
		self::$crumbs[] = array(
			'label' => $label,
			'url'   => $url,
		);
	}

	/**
	 * Determine context and populate crumbs.
	 */
	private static function build() {
		if ( is_singular() ) {
			self::build_singular();
		} elseif ( is_archive() ) {
			self::build_archive();
		} elseif ( is_search() ) {
			self::add( sprintf( esc_html__( 'Search: "%s"', 'marbure' ), get_search_query() ) );
		} elseif ( is_404() ) {
			self::add( esc_html__( '404 — Not Found', 'marbure' ) );
		}
	}

	/**
	 * Crumbs for singular posts/pages/CPTs.
	 */
	private static function build_singular() {
		global $post;
		$post_type = get_post_type();

		// Blog single post.
		if ( 'post' === $post_type ) {
			if ( $blog_id = get_option( 'page_for_posts' ) ) {
				self::add( get_the_title( $blog_id ), get_permalink( $blog_id ) );
			}
			$cats = get_the_category();
			if ( $cats ) {
				self::add( esc_html( $cats[0]->name ), get_category_link( $cats[0]->term_id ) );
			}
			self::add( get_the_title() );
			return;
		}

		// CPT — link to archive first.
		if ( 'page' !== $post_type ) {
			$obj = get_post_type_object( $post_type );
			if ( $obj && $obj->has_archive ) {
				self::add( esc_html( $obj->labels->name ), get_post_type_archive_link( $post_type ) );
			}
		}

		// Page hierarchy.
		if ( 'page' === $post_type && $post->post_parent ) {
			$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
			foreach ( $ancestors as $ancestor_id ) {
				self::add( get_the_title( $ancestor_id ), get_permalink( $ancestor_id ) );
			}
		}

		self::add( get_the_title() );
	}

	/**
	 * Crumbs for archive pages.
	 */
	private static function build_archive() {
		if ( is_post_type_archive() ) {
			self::add( post_type_archive_title( '', false ) );
			return;
		}

		if ( is_tax() || is_category() || is_tag() ) {
			$term = get_queried_object();
			if ( $term && $term->parent ) {
				$parent = get_term( $term->parent, $term->taxonomy );
				if ( $parent && ! is_wp_error( $parent ) ) {
					self::add( esc_html( $parent->name ), get_term_link( $parent ) );
				}
			}
			self::add( esc_html( $term->name ) );
			return;
		}

		if ( is_date() ) {
			if ( is_day() ) {
				self::add( get_the_date() );
			} elseif ( is_month() ) {
				self::add( get_the_date( 'F Y' ) );
			} else {
				self::add( get_the_date( 'Y' ) );
			}
			return;
		}

		if ( is_author() ) {
			self::add( esc_html( get_the_author() ) );
		}
	}

	/**
	 * Render the HTML output.
	 */
	private static function output() {
		$last = count( self::$crumbs ) - 1;
		?>
		<nav class="breadcrumb-nav" aria-label="<?php esc_attr_e( 'Breadcrumb', 'marbure' ); ?>">
			<ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
				<?php foreach ( self::$crumbs as $i => $crumb ) : ?>
					<li
						class="breadcrumb__item"
						itemprop="itemListElement"
						itemscope
						itemtype="https://schema.org/ListItem"
					>
						<?php if ( $crumb['url'] && $i < $last ) : ?>
							<a href="<?php echo esc_url( $crumb['url'] ); ?>" class="breadcrumb__link" itemprop="item">
								<span itemprop="name"><?php echo esc_html( $crumb['label'] ); ?></span>
							</a>
						<?php else : ?>
							<span itemprop="name" aria-current="page"><?php echo esc_html( $crumb['label'] ); ?></span>
						<?php endif; ?>
						<meta itemprop="position" content="<?php echo esc_attr( $i + 1 ); ?>">
					</li>
				<?php endforeach; ?>
			</ol>
		</nav>
		<?php
	}
}
