/**
 * Back-to-top button.
 * Shows after 300px scroll; smooth scrolls to top on click.
 */
( function () {
	'use strict';

	const btn = document.getElementById( 'back-to-top' );

	if ( ! btn ) return;

	window.addEventListener(
		'scroll',
		function () {
			btn.classList.toggle( 'is-visible', window.scrollY > 300 );
		},
		{ passive: true }
	);

	btn.addEventListener( 'click', function () {
		window.scrollTo( { top: 0, behavior: 'smooth' } );
	} );
}() );
