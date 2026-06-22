<?php
/**
 * Content partial: service card (used in archive and related areas).
 *
 * @package marbure
 */

$icon    = get_post_meta( get_the_ID(), '_service_icon_class', true ) ?: 'fas fa-balance-scale';
$tagline = get_post_meta( get_the_ID(), '_service_tagline', true );
?>
<div class="service-card">
	<div class="service-card__icon">
		<i class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
	</div>
	<h3 class="service-card__title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h3>
	<?php if ( $tagline ) : ?>
		<p class="service-card__tagline"><?php echo esc_html( $tagline ); ?></p>
	<?php elseif ( has_excerpt() ) : ?>
		<p class="service-card__tagline"><?php echo esc_html( get_the_excerpt() ); ?></p>
	<?php endif; ?>
	<a href="<?php the_permalink(); ?>" class="service-card__link btn--ghost">
		<?php esc_html_e( 'Learn More', 'marbure' ); ?>
	</a>
</div>
