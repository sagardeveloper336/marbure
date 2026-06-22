<?php
/**
 * Content partial: portfolio / case result card.
 *
 * @package marbure
 */

$settlement = get_post_meta( get_the_ID(), '_portfolio_settlement', true );
$case_type  = get_post_meta( get_the_ID(), '_portfolio_case_type', true );
$outcome    = get_post_meta( get_the_ID(), '_portfolio_outcome', true );
?>
<article class="portfolio-card" id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="portfolio-card__image">
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'marbure-portfolio', array( 'loading' => 'lazy' ) ); ?>
			</a>
			<?php if ( $settlement ) : ?>
				<div class="portfolio-card__badge"><?php echo esc_html( $settlement ); ?></div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="portfolio-card__body">
		<?php if ( $case_type ) : ?>
			<span class="portfolio-card__type"><?php echo esc_html( $case_type ); ?></span>
		<?php endif; ?>
		<h3 class="portfolio-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<?php if ( has_excerpt() ) : ?>
			<p class="portfolio-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
		<?php endif; ?>
		<?php if ( $outcome ) : ?>
			<div class="portfolio-card__outcome">
				<i class="fas fa-check-circle" aria-hidden="true"></i>
				<?php echo esc_html( $outcome ); ?>
			</div>
		<?php endif; ?>
		<a href="<?php the_permalink(); ?>" class="btn--ghost"><?php esc_html_e( 'View Case', 'marbure' ); ?></a>
	</div>

</article>
