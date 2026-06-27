<?php
/**
 * Homepage section: Stats Counter.
 * Values from Kirki; animated by js/src/counter.js via IntersectionObserver.
 *
 * @package marbure
 */

$stats = array(
	array(
		'value'  => marbure_option( 'stat_1_value', '4.5' ),
		'suffix' => marbure_option( 'stat_1_suffix', '★' ),
		'label'  => marbure_option( 'stat_1_label', __( 'Client Rating', 'marbure' ) ),
		'icon'   => marbure_option( 'stat_1_icon', 'fas fa-star' ),
	),
	array(
		'value'  => marbure_option( 'stat_2_value', '97' ),
		'suffix' => marbure_option( 'stat_2_suffix', '%' ),
		'label'  => marbure_option( 'stat_2_label', __( 'Success Rate', 'marbure' ) ),
		'icon'   => marbure_option( 'stat_2_icon', 'fas fa-trophy' ),
	),
	array(
		'value'  => marbure_option( 'stat_3_value', '7' ),
		'suffix' => marbure_option( 'stat_3_suffix', 'M+' ),
		'label'  => marbure_option( 'stat_3_label', __( 'Average Deal Value', 'marbure' ) ),
		'icon'   => marbure_option( 'stat_3_icon', 'fas fa-dollar-sign' ),
	),
	array(
		'value'  => marbure_option( 'stat_4_value', '12' ),
		'suffix' => marbure_option( 'stat_4_suffix', '+' ),
		'label'  => marbure_option( 'stat_4_label', __( 'Years Experience', 'marbure' ) ),
		'icon'   => marbure_option( 'stat_4_icon', 'fas fa-briefcase' ),
	),
);
?>
<section class="section stats-section">
	<div class="container">
		<div class="stats-grid" data-aos="fade-up">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="stat-item">
					<?php if ( $stat['icon'] ) : ?>
						<div class="stat-item__icon" aria-hidden="true">
							<i class="<?php echo esc_attr( $stat['icon'] ); ?>"></i>
						</div>
					<?php endif; ?>
					<div class="stat-item__number">
						<span
							class="stat-item__counter js-counter"
							data-target="<?php echo esc_attr( $stat['value'] ); ?>"
							data-duration="2000"
							aria-label="<?php echo esc_attr( $stat['value'] . $stat['suffix'] . ' ' . $stat['label'] ); ?>"
						>0</span><span class="stat-item__suffix"><?php echo esc_html( $stat['suffix'] ); ?></span>
					</div>
					<p class="stat-item__label"><?php echo esc_html( $stat['label'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
