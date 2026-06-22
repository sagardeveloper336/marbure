/**
 * Sticky header — adds .is-scrolled class after 50px of scroll.
 * CSS in sass/layout/_header.scss handles the visual shrink.
 */
( function () {
	'use strict';

	const header   = document.getElementById( 'masthead' );
	const SCROLL_Y = 50;

	if ( ! header ) return;

	function onScroll() {
		header.classList.toggle( 'is-scrolled', window.scrollY > SCROLL_Y );
	}

	window.addEventListener( 'scroll', onScroll, { passive: true } );
	onScroll(); // Run once on load (e.g. after a hard refresh mid-page).
}() );
