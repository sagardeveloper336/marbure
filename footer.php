<?php
/**
 * The site footer.
 *
 * Closes #content, renders footer zones, back-to-top, then closes #page.
 *
 * @package marbure
 */
?>

	</div><!-- #content .site-content -->

	<footer id="colophon" class="site-footer">

		<?php if ( marbure_option( 'show_pre_footer_cta', true ) ) : ?>
			<?php get_template_part( 'template-parts/footer/pre-footer-cta' ); ?>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>
		<?php get_template_part( 'template-parts/footer/footer-bottom' ); ?>

	</footer><!-- #colophon -->

</div><!-- #page .site -->

<?php if ( marbure_option( 'show_back_to_top', true ) ) : ?>
	<button
		class="back-to-top"
		id="back-to-top"
		aria-label="<?php esc_attr_e( 'Back to top', 'marbure' ); ?>"
	>
		<i class="fas fa-chevron-up" aria-hidden="true"></i>
	</button>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
