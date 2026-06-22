<?php
/**
 * Homepage section: Marquee Strip — animated scrolling achievements ticker.
 *
 * @package marbure
 */

$items = array(
	array( 'icon' => 'fas fa-trophy',       'text' => __( '$7M Personal Injury Settlement', 'marbure' ) ),
	array( 'icon' => 'fas fa-gavel',         'text' => __( 'Best Law Firm 2024', 'marbure' ) ),
	array( 'icon' => 'fas fa-star',          'text' => __( '4.9★ Client Rating', 'marbure' ) ),
	array( 'icon' => 'fas fa-award',         'text' => __( 'Yorke Prize Winner', 'marbure' ) ),
	array( 'icon' => 'fas fa-balance-scale', 'text' => __( '97% Success Rate', 'marbure' ) ),
	array( 'icon' => 'fas fa-handshake',     'text' => __( '$3.5M Business Litigation Win', 'marbure' ) ),
	array( 'icon' => 'fas fa-medal',         'text' => __( 'Harrison Award 2023', 'marbure' ) ),
	array( 'icon' => 'fas fa-shield-alt',    'text' => __( '12+ Years of Excellence', 'marbure' ) ),
);

// Duplicate items so the marquee loops seamlessly.
$all_items = array_merge( $items, $items );
?>
<div class="marquee-strip" aria-hidden="true">
	<div class="marquee-track">
		<?php foreach ( $all_items as $item ) : ?>
			<div class="marquee-item">
				<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
				<span><?php echo esc_html( $item['text'] ); ?></span>
			</div>
		<?php endforeach; ?>
	</div>
</div>
