<?php
/**
 * Footer — Widget columns.
 * Column count is controlled by the Kirki 'footer_widget_columns' option.
 *
 * @package marbure
 */

$cols       = (int) marbure_option( 'footer_widget_columns', 4 );
$col_ids    = array( 'footer-col-1', 'footer-col-2', 'footer-col-3', 'footer-col-4' );
$active_ids = array_slice( $col_ids, 0, $cols );

// Bail if no footer widgets are active.
$has_widgets = false;
foreach ( $active_ids as $id ) {
	if ( is_active_sidebar( $id ) ) {
		$has_widgets = true;
		break;
	}
}

if ( ! $has_widgets ) {
	return;
}
?>
<div class="footer-widgets">
	<div class="container">
		<div class="footer-widgets__grid footer-widgets__grid--cols-<?php echo esc_attr( $cols ); ?>">

			<?php foreach ( $active_ids as $col_id ) : ?>
				<?php if ( is_active_sidebar( $col_id ) ) : ?>
					<div class="footer-col">
						<?php dynamic_sidebar( $col_id ); ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>

		</div>
	</div>
</div>
