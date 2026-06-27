<?php
/**
 * Homepage section: Marquee Strip — animated scrolling achievements ticker.
 *
 * @package marbure
 */

$items = array(
	array( 'icon' => 'fas fa-gem',          'text' => __( 'Premium Italian Marble', 'marbure' ) ),
	array( 'icon' => 'fas fa-trophy',       'text' => __( 'Best Stone Supplier 2024', 'marbure' ) ),
	array( 'icon' => 'fas fa-star',         'text' => __( '4.9★ Client Rating', 'marbure' ) ),
	array( 'icon' => 'fas fa-award',        'text' => __( 'Excellence in Craftsmanship', 'marbure' ) ),
	array( 'icon' => 'fas fa-check-circle', 'text' => __( '97% Client Satisfaction', 'marbure' ) ),
	array( 'icon' => 'fas fa-handshake',    'text' => __( '500+ Projects Completed', 'marbure' ) ),
	array( 'icon' => 'fas fa-medal',        'text' => __( 'Certified Stone Experts', 'marbure' ) ),
	array( 'icon' => 'fas fa-shield-alt',   'text' => __( '12+ Years of Excellence', 'marbure' ) ),
);

// Duplicate items so the marquee loops seamlessly.
$all_items = array_merge( $items, $items );
?>
<div class="marquee-strip" aria-hidden="true">
	<div class="marquee-strip__track marquee-track">
		<?php foreach ( $all_items as $item ) : ?>
			<div class="marquee-item">
				<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
				<span><?php echo esc_html( $item['text'] ); ?></span>
			</div>
		<?php endforeach; ?>
	</div>
</div>
