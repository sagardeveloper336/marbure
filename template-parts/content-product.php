<?php
/**
 * Content partial: product card (archive grid + related).
 *
 * @package marbure
 */

$material = get_post_meta( get_the_ID(), '_product_material', true );
$size     = get_post_meta( get_the_ID(), '_product_size', true );
$finish   = get_post_meta( get_the_ID(), '_product_finish', true );
$primary_cat = get_the_terms( get_the_ID(), 'product_cat' );
?>
<article class="product-card" id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="product-card__image">
			<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
				<?php the_post_thumbnail( 'marbure-portfolio', array( 'loading' => 'lazy' ) ); ?>
			</a>
			<?php if ( $finish ) : ?>
				<span class="product-card__badge"><?php echo esc_html( $finish ); ?></span>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="product-card__body">
		<?php if ( $primary_cat && ! is_wp_error( $primary_cat ) ) : ?>
			<span class="product-card__cat"><?php echo esc_html( $primary_cat[0]->name ); ?></span>
		<?php endif; ?>

		<h3 class="product-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>

		<?php if ( $material || $size ) : ?>
			<ul class="product-card__meta">
				<?php if ( $material ) : ?>
					<li><i class="fas fa-layer-group" aria-hidden="true"></i> <?php echo esc_html( $material ); ?></li>
				<?php endif; ?>
				<?php if ( $size ) : ?>
					<li><i class="fas fa-expand-alt" aria-hidden="true"></i> <?php echo esc_html( $size ); ?></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>

		<?php if ( marbure_option( 'product_show_excerpt', true ) && has_excerpt() ) : ?>
			<p class="product-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="btn--ghost"><?php esc_html_e( 'View Details', 'marbure' ); ?></a>
	</div>

</article>
