/**
 * Hero Slider — Swiper 11 init.
 * Loaded only when window.Swiper is available (front page / home template).
 */
export function initHeroSlider() {
	const el = document.querySelector( '.js-hero-swiper' );
	if ( ! el || typeof Swiper === 'undefined' ) return;

	new Swiper( el, {
		loop: true,
		speed: 800,
		autoplay: {
			delay: 6000,
			disableOnInteraction: false,
			pauseOnMouseEnter: true,
		},
		effect: 'fade',
		fadeEffect: { crossFade: true },
		pagination: {
			el: '.hero-swiper__pagination',
			clickable: true,
		},
		navigation: {
			prevEl: '.hero-swiper__prev',
			nextEl: '.hero-swiper__next',
		},
		a11y: {
			prevSlideMessage: ( marbureParams.i18n && marbureParams.i18n.prevSlide ) || 'Previous slide',
			nextSlideMessage: ( marbureParams.i18n && marbureParams.i18n.nextSlide ) || 'Next slide',
		},
		on: {
			// Re-trigger AOS animations for the active slide content
			slideChangeTransitionEnd( swiper ) {
				const active = swiper.slides[ swiper.activeIndex ];
				if ( active && typeof AOS !== 'undefined' ) {
					const elements = active.querySelectorAll( '[data-aos]' );
					elements.forEach( ( el ) => {
						el.classList.remove( 'aos-animate' );
						// Force reflow
						void el.offsetWidth;
						el.classList.add( 'aos-animate' );
					} );
				}
			},
		},
	} );
}
