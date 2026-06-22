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

	( function initHeroSlider() {
		const el = document.querySelector( '.js-hero-swiper' );
		if ( ! el || typeof Swiper === 'undefined' ) return;

		new Swiper( el, {
			loop: true,
			speed: 800,
			autoplay: { delay: 6000, disableOnInteraction: false, pauseOnMouseEnter: true },
			effect: 'fade',
			fadeEffect: { crossFade: true },
			pagination: { el: '.hero-swiper__pagination', clickable: true },
			navigation: { prevEl: '.hero-swiper__prev', nextEl: '.hero-swiper__next' },
			a11y: {
				prevSlideMessage: ( marbureParams.i18n && marbureParams.i18n.prevSlide ) || 'Previous slide',
				nextSlideMessage: ( marbureParams.i18n && marbureParams.i18n.nextSlide ) || 'Next slide',
			},
		} );
	}() );

	// ── Testimonials Carousel (Swiper) ────────────────────────────────────────

	( function initTestimonials() {
		const el = document.querySelector( '.js-testimonials-swiper' );
		if ( ! el || typeof Swiper === 'undefined' ) return;

		new Swiper( el, {
			loop: true,
			speed: 600,
			autoplay: { delay: 5000, disableOnInteraction: false, pauseOnMouseEnter: true },
			spaceBetween: 24,
			pagination: { el: '.testimonials-swiper__pagination', clickable: true },
			breakpoints: { 768: { slidesPerView: 2 }, 1100: { slidesPerView: 3 } },
		} );
	}() );

	// ── FAQ Accordion ─────────────────────────────────────────────────────────

	( function initFaqAccordion() {
		var accordion = document.querySelector( '.faq-accordion' );
		if ( ! accordion ) return;

		accordion.querySelectorAll( '.faq-item__question' ).forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				var expanded = btn.getAttribute( 'aria-expanded' ) === 'true';
				var answer   = document.getElementById( btn.getAttribute( 'aria-controls' ) );

				accordion.querySelectorAll( '.faq-item__question' ).forEach( function ( b ) {
					if ( b !== btn ) {
						b.setAttribute( 'aria-expanded', 'false' );
						var a = document.getElementById( b.getAttribute( 'aria-controls' ) );
						if ( a ) a.setAttribute( 'aria-hidden', 'true' );
					}
				} );

				btn.setAttribute( 'aria-expanded', String( ! expanded ) );
				if ( answer ) answer.setAttribute( 'aria-hidden', String( expanded ) );
			} );
		} );
	}() );

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

}() );
