/**
 * Accessible keyboard navigation — toggles .focus on menu list items
 * so CSS-driven dropdowns are reachable via Tab key.
 */
( function () {
	'use strict';

	const container = document.getElementById( 'site-navigation' );
	if ( ! container ) return;

	container.querySelectorAll( 'a' ).forEach( ( link ) => {
		link.addEventListener( 'focus', toggleFocus );
		link.addEventListener( 'blur',  toggleFocus );
	} );

	function toggleFocus() {
		let el = this;
		while ( el && ! el.classList.contains( 'nav-menu' ) ) {
			if ( el.tagName === 'LI' ) {
				el.classList.toggle( 'focus' );
			}
			el = el.parentElement;
		}
	}
}() );
