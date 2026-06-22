/**
 * Off-canvas mobile menu.
 * Opens/closes the #mobile-menu panel and #marbure-overlay.
 * Keyboard: Escape closes, Tab stays trapped inside the open panel.
 */
( function () {
	'use strict';

	const toggle  = document.querySelector( '.mobile-menu-toggle' );
	const menu    = document.getElementById( 'mobile-menu' );
	const overlay = document.getElementById( 'marbure-overlay' );
	const closeBtn = menu && menu.querySelector( '.mobile-menu__close' );

	if ( ! toggle || ! menu || ! overlay ) return;

	// ── Open / Close ─────────────────────────────────────────────────────────

	function openMenu() {
		menu.classList.add( 'is-open' );
		menu.setAttribute( 'aria-hidden', 'false' );
		overlay.classList.add( 'is-visible' );
		toggle.setAttribute( 'aria-expanded', 'true' );
		document.body.classList.add( 'menu-open' );

		const firstFocusable = menu.querySelector( 'a, button' );
		if ( firstFocusable ) firstFocusable.focus();
	}

	function closeMenu() {
		menu.classList.remove( 'is-open' );
		menu.setAttribute( 'aria-hidden', 'true' );
		overlay.classList.remove( 'is-visible' );
		toggle.setAttribute( 'aria-expanded', 'false' );
		document.body.classList.remove( 'menu-open' );
		toggle.focus();
	}

	// ── Event Listeners ──────────────────────────────────────────────────────

	toggle.addEventListener( 'click', openMenu );
	if ( closeBtn ) closeBtn.addEventListener( 'click', closeMenu );
	overlay.addEventListener( 'click', closeMenu );

	document.addEventListener( 'keydown', function ( e ) {
		if ( 'Escape' === e.key && menu.classList.contains( 'is-open' ) ) {
			closeMenu();
		}
	} );

	// ── Accordion Sub-menus ───────────────────────────────────────────────────

	menu.querySelectorAll( '.menu-item-has-children' ).forEach( function ( item ) {
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

	// ── Focus Trap ────────────────────────────────────────────────────────────

	menu.addEventListener( 'keydown', function ( e ) {
		if ( 'Tab' !== e.key || ! menu.classList.contains( 'is-open' ) ) return;

		const focusable = Array.from(
			menu.querySelectorAll( 'a, button, input, [tabindex]:not([tabindex="-1"])' )
		).filter( function ( el ) { return ! el.disabled && el.offsetParent !== null; } );

		if ( ! focusable.length ) return;

		const first = focusable[ 0 ];
		const last  = focusable[ focusable.length - 1 ];

		if ( e.shiftKey && document.activeElement === first ) {
			e.preventDefault();
			last.focus();
		} else if ( ! e.shiftKey && document.activeElement === last ) {
			e.preventDefault();
			first.focus();
		}
	} );
}() );
