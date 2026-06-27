/**
 * Testimonials Carousel — Swiper 11 init.
 */
export function initTestimonialsCarousel() {
	const el = document.querySelector( '.js-testimonials-swiper' );
	if ( ! el || typeof Swiper === 'undefined' ) return;

	new Swiper( el, {
		loop: true,
		speed: 600,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
			pauseOnMouseEnter: true,
		},
		slidesPerView: 1,
		spaceBetween: 24,
		pagination: {
			el: '.testimonials-swiper__pagination',
			clickable: true,
		},
		breakpoints: {
			640: {
				slidesPerView: 1,
			},
			768: {
				slidesPerView: 2,
			},
			1100: {
				slidesPerView: 3,
			},
		},
		a11y: {
			prevSlideMessage: ( marbureParams.i18n && marbureParams.i18n.prevSlide ) || 'Previous slide',
			nextSlideMessage: ( marbureParams.i18n && marbureParams.i18n.nextSlide ) || 'Next slide',
		},
	} );
}
