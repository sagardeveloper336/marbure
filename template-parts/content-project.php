<?php
/**
 * Content partial: project card (archive grid + related).
 *
 * @package marbure
 */

$location = get_post_meta( get_the_ID(), '_project_location', true );
$type     = get_post_meta( get_the_ID(), '_project_type', true );
$area     = get_post_meta( get_the_ID(), '_project_area', true );
?>
<article class="project-card" id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="project-card__image">
			<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
				<?php the_post_thumbnail( 'marbure-portfolio', array( 'loading' => 'lazy' ) ); ?>
			</a>
			<div class="project-card__overlay">
				<?php if ( $location ) : ?>
					<span class="project-card__location">
						<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
						<?php echo esc_html( $location ); ?>
					</span>
				<?php endif; ?>
				<?php if ( $type ) : ?>
					<span class="project-card__type"><?php echo esc_html( $type ); ?></span>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="project-card__body">
		<h3 class="project-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<?php if ( $area ) : ?>
			<span class="project-card__area">
				<i class="fas fa-vector-square" aria-hidden="true"></i>
				<?php echo esc_html( $area ); ?>
			</span>
		<?php endif; ?>
		<?php if ( has_excerpt() ) : ?>
			<p class="project-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
		<?php endif; ?>
		<a href="<?php the_permalink(); ?>" class="btn--ghost"><?php esc_html_e( 'View Project', 'marbure' ); ?></a>
	</div>

</article>
