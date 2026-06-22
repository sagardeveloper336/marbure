/**
 * Preloader — hides the #preloader overlay once the page has fully loaded.
 * CSS transition in sass/components/_preloader.scss handles the fade-out.
 */
( function () {
	'use strict';

	const preloader = document.getElementById( 'preloader' );
	if ( ! preloader ) return;

	function hide() {
		preloader.classList.add( 'is-hidden' );
		preloader.addEventListener(
			'transitionend',
			() => preloader.remove(),
			{ once: true }
		);
	}

	if ( document.readyState === 'complete' ) {
		hide();
	} else {
		window.addEventListener( 'load', hide );
	}
}() );
