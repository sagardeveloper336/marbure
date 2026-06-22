<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 *
 * @package marbure
 */

get_header();

$phone   = marbure_option( 'topbar_phone', '' );
$email_o = marbure_option( 'topbar_email', '' );
?>
<section class="contact-section">
	<div class="container">
		<div class="contact-grid">

			<!-- Contact Info Column -->
			<div class="contact-info" data-aos="fade-right">
				<span class="eyebrow"><?php esc_html_e( 'Get In Touch', 'marbure' ); ?></span>
				<h2 class="section-heading"><?php the_title(); ?></h2>

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="contact-info__body entry-content">
						<?php the_content(); ?>
					</div>
				<?php endwhile; endif; ?>

				<div class="contact-info__cards">
					<?php if ( $phone ) : ?>
						<div class="contact-info-card">
							<div class="contact-info-card__icon">
								<i class="fas fa-phone" aria-hidden="true"></i>
							</div>
							<div>
								<h3><?php esc_html_e( 'Call Us', 'marbure' ); ?></h3>
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $phone ) ); ?>">
									<?php echo esc_html( $phone ); ?>
								</a>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $email_o ) : ?>
						<div class="contact-info-card">
							<div class="contact-info-card__icon">
								<i class="fas fa-envelope" aria-hidden="true"></i>
							</div>
							<div>
								<h3><?php esc_html_e( 'Email Us', 'marbure' ); ?></h3>
								<a href="mailto:<?php echo esc_attr( antispambot( $email_o ) ); ?>">
									<?php echo esc_html( antispambot( $email_o ) ); ?>
								</a>
							</div>
						</div>
					<?php endif; ?>

					<div class="contact-info-card">
						<div class="contact-info-card__icon">
							<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
						</div>
						<div>
							<h3><?php esc_html_e( 'Visit Us', 'marbure' ); ?></h3>
							<p><?php esc_html_e( '123 Legal Avenue, Suite 500', 'marbure' ); ?><br>
							   <?php esc_html_e( 'New York, NY 10001', 'marbure' ); ?></p>
						</div>
					</div>

					<div class="contact-info-card">
						<div class="contact-info-card__icon">
							<i class="fas fa-clock" aria-hidden="true"></i>
						</div>
						<div>
							<h3><?php esc_html_e( 'Office Hours', 'marbure' ); ?></h3>
							<p><?php esc_html_e( 'Mon–Fri: 9:00 AM – 6:00 PM', 'marbure' ); ?><br>
							   <?php esc_html_e( 'Sat: 10:00 AM – 2:00 PM', 'marbure' ); ?></p>
						</div>
					</div>
				</div>
			</div>

			<!-- Form Column -->
			<div class="contact-form-col" data-aos="fade-left" data-aos-delay="100">
				<div class="contact-form-box">
					<h3><?php esc_html_e( 'Free Consultation Request', 'marbure' ); ?></h3>
					<p><?php esc_html_e( 'All submissions are confidential. We will respond within 24 hours.', 'marbure' ); ?></p>

					<?php
					// Use Contact Form 7 shortcode if plugin is active, else native form.
					if ( shortcode_exists( 'contact-form-7' ) ) {
						// Replace 1 with your CF7 form ID.
						echo do_shortcode( '[contact-form-7 id="1" title="Contact Form"]' );
					} else {
						// Native fallback form (accessible, honeypot-free).
						?>
						<form class="marbure-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
							<?php wp_nonce_field( 'marbure_contact_form', 'marbure_contact_nonce' ); ?>
							<input type="hidden" name="action" value="marbure_contact_submit">

							<div class="marbure-form__row marbure-form__row--two">
								<div class="marbure-form__field">
									<label for="cf-name"><?php esc_html_e( 'Full Name', 'marbure' ); ?> <span aria-hidden="true">*</span></label>
									<input type="text" id="cf-name" name="cf_name" required autocomplete="name" placeholder="<?php esc_attr_e( 'John Smith', 'marbure' ); ?>">
								</div>
								<div class="marbure-form__field">
									<label for="cf-email"><?php esc_html_e( 'Email Address', 'marbure' ); ?> <span aria-hidden="true">*</span></label>
									<input type="email" id="cf-email" name="cf_email" required autocomplete="email" placeholder="<?php esc_attr_e( 'john@example.com', 'marbure' ); ?>">
								</div>
							</div>

							<div class="marbure-form__row marbure-form__row--two">
								<div class="marbure-form__field">
									<label for="cf-phone"><?php esc_html_e( 'Phone Number', 'marbure' ); ?></label>
									<input type="tel" id="cf-phone" name="cf_phone" autocomplete="tel" placeholder="<?php esc_attr_e( '+1 (555) 000-0000', 'marbure' ); ?>">
								</div>
								<div class="marbure-form__field">
									<label for="cf-service"><?php esc_html_e( 'Practice Area', 'marbure' ); ?></label>
									<select id="cf-service" name="cf_service">
										<option value=""><?php esc_html_e( 'Select an area…', 'marbure' ); ?></option>
										<?php
										$services = new WP_Query( array(
											'post_type' => 'marbure_service', 'posts_per_page' => -1,
											'no_found_rows' => true, 'orderby' => 'menu_order', 'order' => 'ASC',
										) );
										while ( $services->have_posts() ) : $services->the_post();
											echo '<option value="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</option>';
										endwhile;
										wp_reset_postdata();
										?>
									</select>
								</div>
							</div>

							<div class="marbure-form__field">
								<label for="cf-message"><?php esc_html_e( 'Tell Us About Your Case', 'marbure' ); ?> <span aria-hidden="true">*</span></label>
								<textarea id="cf-message" name="cf_message" rows="5" required placeholder="<?php esc_attr_e( 'Please describe your legal situation briefly…', 'marbure' ); ?>"></textarea>
							</div>

							<button type="submit" class="btn btn--primary">
								<?php esc_html_e( 'Send Message', 'marbure' ); ?>
							</button>
						</form>
						<?php
					}
					?>
				</div>
			</div>

		</div>
	</div>
</section>
<?php
get_footer();
