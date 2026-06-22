/**
 * Marquee strip — pauses CSS scroll animation on hover.
 * Respects prefers-reduced-motion: keeps animation paused for those users.
 */
( function () {
	'use strict';

	const strips = document.querySelectorAll( '.marquee-strip' );
	if ( ! strips.length ) return;

	const prefersReduced = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	strips.forEach( ( strip ) => {
		const track = strip.querySelector( '.marquee-strip__track' );
		if ( ! track ) return;

		if ( prefersReduced ) {
			track.style.animationPlayState = 'paused';
			return;
		}

		strip.addEventListener( 'mouseenter', () => {
			track.style.animationPlayState = 'paused';
		} );

		strip.addEventListener( 'mouseleave', () => {
			track.style.animationPlayState = 'running';
		} );
	} );
}() );
