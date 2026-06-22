/**
 * Mega menu — mouse hover + full keyboard accessibility.
 * Toggles .is-open on parent LI; CSS handles panel visibility.
 */
( function () {
	'use strict';

	const ITEMS = document.querySelectorAll( '.nav-menu__item--has-mega' );
	const DELAY = 150; // ms — prevents flicker on quick mouse-overs.

	ITEMS.forEach( ( item ) => {
		let timer;
		const trigger = item.querySelector( ':scope > a' );

		item.addEventListener( 'mouseenter', () => {
			clearTimeout( timer );
			item.classList.add( 'is-open' );
			if ( trigger ) trigger.setAttribute( 'aria-expanded', 'true' );
		} );

		item.addEventListener( 'mouseleave', () => {
			timer = setTimeout( () => {
				item.classList.remove( 'is-open' );
				if ( trigger ) trigger.setAttribute( 'aria-expanded', 'false' );
			}, DELAY );
		} );

		if ( trigger ) {
			// Enter / Space — open panel.
			trigger.addEventListener( 'keydown', ( e ) => {
				if ( e.key === 'Enter' || e.key === ' ' ) {
					e.preventDefault();
					const isOpen = item.classList.toggle( 'is-open' );
					trigger.setAttribute( 'aria-expanded', String( isOpen ) );
				}
				// Escape — close panel and return focus.
				if ( e.key === 'Escape' ) {
					item.classList.remove( 'is-open' );
					trigger.setAttribute( 'aria-expanded', 'false' );
					trigger.focus();
				}
			} );
		}
	} );

	// Close all panels when clicking outside the nav.
	document.addEventListener( 'click', ( e ) => {
		ITEMS.forEach( ( item ) => {
			if ( ! item.contains( e.target ) ) {
				item.classList.remove( 'is-open' );
				const trigger = item.querySelector( ':scope > a' );
				if ( trigger ) trigger.setAttribute( 'aria-expanded', 'false' );
			}
		} );
	} );
}() );
