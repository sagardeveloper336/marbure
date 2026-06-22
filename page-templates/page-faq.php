<?php
/**
 * Template Name: FAQ
 * Template Post Type: page
 *
 * Queries marbure_faq CPT and groups by taxonomy if available.
 * Outputs FAQPage JSON-LD for rich results.
 *
 * @package marbure
 */

get_header();

$faq_query = new WP_Query( array(
	'post_type'      => 'marbure_faq',
	'posts_per_page' => -1,
	'no_found_rows'  => true,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );
?>
<section class="faq-section">
	<div class="container faq-section__container">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="faq-section__intro" data-aos="fade-up">
				<span class="eyebrow"><?php esc_html_e( 'FAQ', 'marbure' ); ?></span>
				<h1 class="section-heading"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="section-subheading"><?php the_excerpt(); ?></p>
				<?php endif; ?>
			</div>
		<?php endwhile; endif; ?>

		<?php if ( $faq_query->have_posts() ) : ?>
			<div class="faq-accordion" data-aos="fade-up" data-aos-delay="100">
				<?php
				$index = 0;
				while ( $faq_query->have_posts() ) :
					$faq_query->the_post();
					$index++;
					$item_id = 'faq-item-' . $index;
					?>
					<div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
						<button
							class="faq-item__question"
							aria-expanded="false"
							aria-controls="<?php echo esc_attr( $item_id ); ?>"
							itemprop="name"
						>
							<?php the_title(); ?>
							<span class="faq-item__icon" aria-hidden="true">
								<i class="fas fa-chevron-down"></i>
							</span>
						</button>
						<div
							id="<?php echo esc_attr( $item_id ); ?>"
							class="faq-item__answer"
							role="region"
							aria-hidden="true"
							itemscope
							itemprop="acceptedAnswer"
							itemtype="https://schema.org/Answer"
						>
							<div class="faq-item__answer-body" itemprop="text">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>

		<?php else : ?>
			<p><?php esc_html_e( 'No FAQ items found.', 'marbure' ); ?></p>
		<?php endif; ?>

		<!-- CTA below FAQs -->
		<div class="faq-section__cta" data-aos="fade-up">
			<p><?php esc_html_e( "Still have questions? Our attorneys are ready to help.", 'marbure' ); ?></p>
			<a href="<?php echo esc_url( marbure_option( 'hero_btn1_url', '/contact' ) ); ?>" class="btn btn--primary">
				<?php esc_html_e( 'Schedule Free Consultation', 'marbure' ); ?>
			</a>
		</div>

	</div>
</section>
<?php
get_footer();
