/**
 * Portfolio filter — Isotope grid + category filter buttons.
 * Requires Isotope 3.x (enqueued conditionally on portfolio archive pages).
 */
( function () {
	'use strict';

	const grid       = document.querySelector( '.portfolio-grid' );
	const filterBtns = document.querySelectorAll( '.portfolio-filter__btn' );

	if ( ! grid || typeof Isotope === 'undefined' ) return;

	const iso = new Isotope( grid, {
		itemSelector:    '.portfolio-grid__item',
		layoutMode:      'masonry',
		percentPosition: true,
		transitionDuration: '0.4s',
	} );

	// Re-layout after images load to prevent height miscalculations.
	if ( typeof imagesLoaded !== 'undefined' ) {
		imagesLoaded( grid, () => iso.layout() );
	}

	filterBtns.forEach( ( btn ) => {
		btn.addEventListener( 'click', () => {
			filterBtns.forEach( ( b ) => {
				b.classList.remove( 'is-active' );
				b.removeAttribute( 'aria-pressed' );
			} );

			btn.classList.add( 'is-active' );
			btn.setAttribute( 'aria-pressed', 'true' );

			iso.arrange( { filter: btn.dataset.filter || '*' } );
		} );
	} );
}() );
