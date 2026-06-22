<?php
/**
 * Template: Single Product / Collection.
 *
 * @package marbure
 */

get_header();
?>
<div class="container">
	<div class="content-row content-row--sidebar">

		<main id="main" class="site-main content-area" role="main">
			<?php while ( have_posts() ) : the_post();

				$size         = get_post_meta( get_the_ID(), '_product_size', true );
				$material     = get_post_meta( get_the_ID(), '_product_material', true );
				$finish       = get_post_meta( get_the_ID(), '_product_finish', true );
				$thickness    = get_post_meta( get_the_ID(), '_product_thickness', true );
				$color_family = get_post_meta( get_the_ID(), '_product_color_family', true );
				$usage        = get_post_meta( get_the_ID(), '_product_usage', true );
				$price_range  = get_post_meta( get_the_ID(), '_product_price_range', true );
				$datasheet    = get_post_meta( get_the_ID(), '_product_datasheet_url', true );
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'product-single' ); ?>>

				<div class="product-single__top">

					<!-- Gallery -->
					<div class="product-single__gallery">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="product-single__main-image">
								<?php the_post_thumbnail( 'marbure-hero', array( 'loading' => 'eager' ) ); ?>
							</div>
						<?php endif; ?>
					</div>

					<!-- Info Panel -->
					<div class="product-single__info">

						<?php
						$primary_cat = get_the_terms( get_the_ID(), 'product_cat' );
						if ( $primary_cat && ! is_wp_error( $primary_cat ) ) : ?>
							<span class="product-single__cat"><?php echo esc_html( $primary_cat[0]->name ); ?></span>
						<?php endif; ?>

						<h1 class="product-single__title"><?php the_title(); ?></h1>

						<?php if ( has_excerpt() ) : ?>
							<p class="product-single__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<?php endif; ?>

						<!-- Specs Table -->
						<?php
						$specs = array(
							__( 'Size', 'marbure' )         => $size,
							__( 'Material', 'marbure' )     => $material,
							__( 'Finish', 'marbure' )       => $finish,
							__( 'Thickness', 'marbure' )    => $thickness,
							__( 'Color Family', 'marbure' ) => $color_family,
							__( 'Usage', 'marbure' )        => $usage,
							__( 'Price Range', 'marbure' )  => $price_range,
						);
						$specs = array_filter( $specs );
						if ( $specs ) : ?>
							<table class="product-single__specs">
								<tbody>
									<?php foreach ( $specs as $label => $value ) : ?>
										<tr>
											<th><?php echo esc_html( $label ); ?></th>
											<td><?php echo esc_html( $value ); ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<?php endif; ?>

						<!-- Taxonomy tags -->
						<?php
						$tax_display = array( 'product_material', 'product_finish' );
						foreach ( $tax_display as $tax ) :
							$terms = get_the_terms( get_the_ID(), $tax );
							if ( $terms && ! is_wp_error( $terms ) ) :
								$tax_obj = get_taxonomy( $tax );
						?>
							<div class="product-single__tags">
								<span class="product-single__tags-label"><?php echo esc_html( $tax_obj->labels->singular_name ); ?>:</span>
								<?php foreach ( $terms as $term ) : ?>
									<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="tag-chip">
										<?php echo esc_html( $term->name ); ?>
									</a>
								<?php endforeach; ?>
							</div>
						<?php endif; endforeach; ?>

						<div class="product-single__actions">
							<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="btn btn--primary">
								<?php esc_html_e( 'Get a Quote', 'marbure' ); ?>
							</a>
							<?php if ( $datasheet ) : ?>
								<a href="<?php echo esc_url( $datasheet ); ?>" class="btn btn--outline" target="_blank" rel="noopener noreferrer">
									<i class="fas fa-file-pdf" aria-hidden="true"></i>
									<?php esc_html_e( 'Download Datasheet', 'marbure' ); ?>
								</a>
							<?php endif; ?>
						</div>

					</div>
				</div>

				<!-- Full Description -->
				<?php if ( $post->post_content ) : ?>
					<div class="entry-content product-single__content">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>

				<!-- Related Products -->
				<?php
				$cats = get_the_terms( get_the_ID(), 'product_cat' );
				if ( $cats && ! is_wp_error( $cats ) ) :
					$related = new WP_Query( array(
						'post_type'      => 'marbure_product',
						'posts_per_page' => 3,
						'post__not_in'   => array( get_the_ID() ),
						'no_found_rows'  => true,
						'tax_query'      => array( array(
							'taxonomy' => 'product_cat',
							'field'    => 'term_id',
							'terms'    => wp_list_pluck( $cats, 'term_id' ),
						) ),
					) );
					if ( $related->have_posts() ) :
				?>
				<aside class="related-products">
					<h2 class="related-products__title"><?php esc_html_e( 'Related Products', 'marbure' ); ?></h2>
					<div class="row">
						<?php while ( $related->have_posts() ) : $related->the_post(); ?>
							<div class="col-md-4">
								<?php get_template_part( 'template-parts/content', 'product' ); ?>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</aside>
				<?php endif; endif; ?>

			</article>

			<?php endwhile; ?>
		</main>

		<aside class="widget-area sidebar-product" role="complementary">
			<div class="sidebar-cta">
				<h3><?php esc_html_e( 'Need a Quote?', 'marbure' ); ?></h3>
				<p><?php esc_html_e( 'Request a free quote for supply and installation. Our team responds within 24 hours.', 'marbure' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="btn btn--primary">
					<?php esc_html_e( 'Get a Free Quote', 'marbure' ); ?>
				</a>
			</div>

			<!-- All Categories -->
			<?php
			$all_cats = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true ) );
			if ( $all_cats && ! is_wp_error( $all_cats ) ) :
			?>
			<nav class="sidebar-categories">
				<h3><?php esc_html_e( 'Product Categories', 'marbure' ); ?></h3>
				<ul>
					<?php foreach ( $all_cats as $cat ) : ?>
						<li>
							<a href="<?php echo esc_url( get_term_link( $cat ) ); ?>">
								<i class="fas fa-chevron-right" aria-hidden="true"></i>
								<?php echo esc_html( $cat->name ); ?>
								<span class="sidebar-categories__count">(<?php echo (int) $cat->count; ?>)</span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</nav>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-product' ) ) : ?>
				<?php dynamic_sidebar( 'sidebar-product' ); ?>
			<?php endif; ?>
		</aside>

	</div>
</div>
<?php
get_footer();
