/**
 * Marbure Theme — main.js
 *
 * Self-contained bundle. All source modules are concatenated here so a single
 * file is served. Module source lives in js/src/ for readability.
 *
 * Load order: sticky header → mobile menu → back-to-top → (future modules).
 *
 * @package marbure
 */

( function () {
	'use strict';

	// ── Sticky Header ─────────────────────────────────────────────────────────

	const header   = document.getElementById( 'masthead' );
	const SCROLL_Y = 50;

	if ( header ) {
		function onScroll() {
			header.classList.toggle( 'is-scrolled', window.scrollY > SCROLL_Y );
		}
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}

	// ── Mobile Off-Canvas Menu ────────────────────────────────────────────────

	const toggle   = document.querySelector( '.mobile-menu-toggle' );
	const mobileMenu  = document.getElementById( 'mobile-menu' );
	const overlay  = document.getElementById( 'marbure-overlay' );
	const closeBtn = mobileMenu && mobileMenu.querySelector( '.mobile-menu__close' );

	if ( toggle && mobileMenu && overlay ) {

		function openMenu() {
			mobileMenu.classList.add( 'is-open' );
			mobileMenu.setAttribute( 'aria-hidden', 'false' );
			overlay.classList.add( 'is-visible' );
			toggle.setAttribute( 'aria-expanded', 'true' );
			document.body.classList.add( 'menu-open' );
			const firstFocusable = mobileMenu.querySelector( 'a, button' );
			if ( firstFocusable ) firstFocusable.focus();
		}

		function closeMenu() {
			mobileMenu.classList.remove( 'is-open' );
			mobileMenu.setAttribute( 'aria-hidden', 'true' );
			overlay.classList.remove( 'is-visible' );
			toggle.setAttribute( 'aria-expanded', 'false' );
			document.body.classList.remove( 'menu-open' );
			toggle.focus();
		}

		toggle.addEventListener( 'click', openMenu );
		if ( closeBtn ) closeBtn.addEventListener( 'click', closeMenu );
		overlay.addEventListener( 'click', closeMenu );

		document.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key && mobileMenu.classList.contains( 'is-open' ) ) {
				closeMenu();
			}
		} );

		// Accordion: inject toggle buttons for sub-menus.
		mobileMenu.querySelectorAll( '.menu-item-has-children' ).forEach( function ( item ) {
			const link = item.querySelector( ':scope > a' );
			if ( ! link ) return;
			const btn = document.createElement( 'button' );
			btn.className = 'sub-menu-toggle';
			btn.setAttribute( 'aria-label', 'Toggle submenu' );
			btn.innerHTML = '<i class="fas fa-chevron-down" aria-hidden="true"></i>';
			link.after( btn );
			btn.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				item.classList.toggle( 'is-open' );
			} );
		} );

		// Focus trap.
		mobileMenu.addEventListener( 'keydown', function ( e ) {
			if ( 'Tab' !== e.key || ! mobileMenu.classList.contains( 'is-open' ) ) return;
			const focusable = Array.from(
				mobileMenu.querySelectorAll( 'a, button, input, [tabindex]:not([tabindex="-1"])' )
			).filter( function ( el ) { return ! el.disabled && el.offsetParent !== null; } );
			if ( ! focusable.length ) return;
			const first = focusable[ 0 ];
			const last  = focusable[ focusable.length - 1 ];
			if ( e.shiftKey && document.activeElement === first ) {
				e.preventDefault(); last.focus();
			} else if ( ! e.shiftKey && document.activeElement === last ) {
				e.preventDefault(); first.focus();
			}
		} );
	}

	// ── Back to Top ───────────────────────────────────────────────────────────

	const backToTopBtn = document.getElementById( 'back-to-top' );

	if ( backToTopBtn ) {
		window.addEventListener(
			'scroll',
			function () {
				backToTopBtn.classList.toggle( 'is-visible', window.scrollY > 300 );
			},
			{ passive: true }
		);
		backToTopBtn.addEventListener( 'click', function () {
			window.scrollTo( { top: 0, behavior: 'smooth' } );
		} );
	}

	// ── Search Toggle ─────────────────────────────────────────────────────────

	document.querySelectorAll( '[data-toggle="search"]' ).forEach( function ( btn ) {
		btn.addEventListener( 'click', function () {
			document.body.classList.toggle( 'search-open' );
		} );
	} );

	// ── Hero Slider (Swiper) ──────────────────────────────────────────────────
	// Reads data-autoplay / data-loop / data-speed from the wrapper element so
	// the Elementor widget can pass its own settings.

	function marbureInitHeroSwiper( el ) {
		if ( ! el || el._swiperHero || typeof Swiper === 'undefined' ) return;
		el._swiperHero = true;

		var autoplayDelay = el.dataset.autoplay ? parseInt( el.dataset.autoplay, 10 ) : 6000;
		var loopEnabled   = el.dataset.loop !== '0';
		var slideSpeed    = el.dataset.speed ? parseInt( el.dataset.speed, 10 ) : 800;

		new Swiper( el, {
			loop:       loopEnabled,
			speed:      slideSpeed,
			autoplay:   autoplayDelay > 0
				? { delay: autoplayDelay, disableOnInteraction: false, pauseOnMouseEnter: true }
				: false,
			effect:     'fade',
			fadeEffect: { crossFade: true },
			pagination: {
				el:        el.querySelector( '.hero-swiper__pagination' ),
				clickable: true,
			},
			navigation: {
				prevEl: el.querySelector( '.hero-swiper__prev' ),
				nextEl: el.querySelector( '.hero-swiper__next' ),
			},
			a11y: {
				prevSlideMessage: ( marbureParams.i18n && marbureParams.i18n.prevSlide ) || 'Previous slide',
				nextSlideMessage: ( marbureParams.i18n && marbureParams.i18n.nextSlide ) || 'Next slide',
			},
		} );
	}

	document.querySelectorAll( '.js-hero-swiper' ).forEach( marbureInitHeroSwiper );

	// ── Testimonials Carousel (Swiper) ────────────────────────────────────────
	// Settings are read from data-* attrs set by the PHP template so the JS
	// always reflects the Elementor widget controls without a separate AJAX call.

	function marbureInitTestimonialsSwiper( el ) {
		if ( ! el || el._swiperTestimonials || typeof Swiper === 'undefined' ) return;
		el._swiperTestimonials = true;

		var loopEnabled = el.dataset.loop     !== '0';
		var autoEnabled = el.dataset.autoplay !== '0';
		var autoDelay   = el.dataset.autoplayDelay ? parseInt( el.dataset.autoplayDelay, 10 ) : 5000;
		var slidesSm    = el.dataset.slidesSm      ? parseInt( el.dataset.slidesSm,      10 ) : 1;
		var slidesMd    = el.dataset.slidesMd      ? parseInt( el.dataset.slidesMd,      10 ) : 2;
		var slidesLg    = el.dataset.slidesLg      ? parseInt( el.dataset.slidesLg,      10 ) : 3;
		var prevEl      = el.querySelector( '.testimonials-swiper__prev' );
		var nextEl      = el.querySelector( '.testimonials-swiper__next' );
		var pagerEl     = el.querySelector( '.testimonials-swiper__pagination' );

		new Swiper( el, {
			loop:          loopEnabled,
			speed:         600,
			autoplay:      autoEnabled
				? { delay: autoDelay, disableOnInteraction: false, pauseOnMouseEnter: true }
				: false,
			slidesPerView: slidesSm,
			spaceBetween:  24,
			pagination:    pagerEl ? { el: pagerEl, clickable: true } : false,
			navigation:    ( prevEl && nextEl ) ? { prevEl: prevEl, nextEl: nextEl } : false,
			breakpoints: {
				768:  { slidesPerView: slidesMd },
				1100: { slidesPerView: slidesLg },
			},
		} );
	}

	document.querySelectorAll( '.js-testimonials-swiper' ).forEach( marbureInitTestimonialsSwiper );

	// ── Elementor frontend hook — re-init Swiper when a widget is rendered ────
	// jQuery(window).on('elementor/frontend/init') fires AFTER elementorFrontend
	// is fully ready (both on the frontend and inside the editor preview iframe).
	// This is the Elementor-idiomatic pattern; it is reliable where window.load
	// checks are not, because elementorFrontend can initialise asynchronously.

	if ( typeof jQuery !== 'undefined' ) {
		jQuery( window ).on( 'elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction(
				'frontend/element_ready/marbure_hero_slider.default',
				function ( $scope ) {
					var el = $scope[ 0 ] && $scope[ 0 ].querySelector( '.js-hero-swiper' );
					marbureInitHeroSwiper( el );
				}
			);
			elementorFrontend.hooks.addAction(
				'frontend/element_ready/marbure_testimonial.default',
				function ( $scope ) {
					var el = $scope[ 0 ] && $scope[ 0 ].querySelector( '.js-testimonials-swiper' );
					marbureInitTestimonialsSwiper( el );
				}
			);
		} );
	}

	// ── Stat Counters ─────────────────────────────────────────────────────────

	( function initCounters() {
		var counters = document.querySelectorAll( '.js-counter' );
		if ( ! counters.length ) return;

		var easeOut = function ( t ) { return 1 - Math.pow( 1 - t, 4 ); };

		function animate( el ) {
			var target   = parseFloat( el.dataset.target ) || 0;
			var duration = parseInt( el.dataset.duration, 10 ) || 2000;
			var start    = performance.now();
			var isFloat  = String( target ).indexOf( '.' ) !== -1;

			function step( now ) {
				var p     = Math.min( ( now - start ) / duration, 1 );
				var value = easeOut( p ) * target;
				el.textContent = isFloat ? value.toFixed( 1 ) : Math.floor( value ).toLocaleString();
				if ( p < 1 ) {
					requestAnimationFrame( step );
				} else {
					el.textContent = isFloat ? target.toFixed( 1 ) : target.toLocaleString();
				}
			}

			requestAnimationFrame( step );
		}

		if ( 'IntersectionObserver' in window ) {
			var obs = new IntersectionObserver( function ( entries, o ) {
				entries.forEach( function ( entry ) {
					if ( ! entry.isIntersecting ) return;
					animate( entry.target );
					o.unobserve( entry.target );
				} );
			}, { threshold: 0.4 } );

			counters.forEach( function ( el ) { obs.observe( el ); } );
		} else {
			counters.forEach( animate );
		}
	}() );

	// ── Marquee Strip — pause on hover ────────────────────────────────────────
	// CSS provides the same pause via :hover, but JS ensures correct behaviour
	// after dynamic DOM insertions (e.g. Elementor front-end editing).

	( function initMarquee() {
		var strips = document.querySelectorAll( '.marquee-strip' );
		if ( ! strips.length ) return;

		var prefersReduced = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

		strips.forEach( function ( strip ) {
			var track = strip.querySelector( '.marquee-strip__track' );
			if ( ! track ) return;

			if ( prefersReduced ) {
				track.style.animationPlayState = 'paused';
				return;
			}

			strip.addEventListener( 'mouseenter', function () {
				track.style.animationPlayState = 'paused';
			} );
			strip.addEventListener( 'mouseleave', function () {
				track.style.animationPlayState = 'running';
			} );
		} );
	}() );

	// ── Sticky Footer ────────────────────────────────────────────────────────
	// Pins footer#colophon to the bottom when page content is shorter than
	// the viewport. Skips when Elementor editor is active.

	( function initStickyFooter() {
		var footer = document.querySelector( 'footer#colophon' );
		var page   = document.getElementById( 'page' );
		if ( ! footer || ! page ) return;

		function ptFooterPosition() {
			if ( document.body.classList.contains( 'elementor-editor-active' ) ) return;

			// Reset any previous inline styles.
			footer.style.position      = '';
			footer.style.width         = '';
			footer.style.bottom        = '';
			document.body.style.height = '';
			page.style.height          = '';

			if ( window.innerHeight > document.body.offsetHeight ) {
				var windowHeight = window.innerHeight;
				var adminBar     = document.getElementById( 'wpadminbar' );
				if ( adminBar ) {
					windowHeight -= adminBar.offsetHeight;
				}
				document.body.style.height = windowHeight + 'px';
				page.style.height          = windowHeight + 'px';
				footer.style.position      = 'absolute';
				footer.style.width         = '100%';
				footer.style.bottom        = '0';
			}
		}

		ptFooterPosition();
		window.addEventListener( 'resize', ptFooterPosition, { passive: true } );
	}() );

	// ── AOS — Animate on Scroll ───────────────────────────────────────────────
	// aos.css hides [data-aos] elements with opacity:0 until aos-animate is added.
	// Without AOS.init() the content (eyebrow, heading, text, buttons) stays invisible.

	if ( typeof AOS !== 'undefined' ) {
		AOS.init( {
			duration: 800,
			once:     true,
			offset:   60,
		} );
	}

}() );
