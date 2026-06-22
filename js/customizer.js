/**
 * Theme Customizer live-preview handlers.
 * Vanilla JS — no jQuery dependency.
 *
 * @package marbure
 */

/* global wp */
( function () {
	'use strict';

	const api = wp.customize;

	// ── Site title ───────────────────────────────────────────────────────────
	api( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			document.querySelectorAll( '.site-title a' ).forEach( function ( el ) {
				el.textContent = to;
			} );
		} );
	} );

	// ── Site tagline ─────────────────────────────────────────────────────────
	api( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			document.querySelectorAll( '.site-description' ).forEach( function ( el ) {
				el.textContent = to;
			} );
		} );
	} );

	// ── Primary color → CSS var ───────────────────────────────────────────────
	api( 'marbure_theme_options[color_primary]', function ( value ) {
		value.bind( function ( to ) {
			document.documentElement.style.setProperty( '--color-primary', to );
		} );
	} );

	// ── Secondary / accent color ─────────────────────────────────────────────
	api( 'marbure_theme_options[color_secondary]', function ( value ) {
		value.bind( function ( to ) {
			document.documentElement.style.setProperty( '--color-secondary', to );
		} );
	} );

	// ── Header background color ───────────────────────────────────────────────
	api( 'marbure_theme_options[header_background_color]', function ( value ) {
		value.bind( function ( to ) {
			document.documentElement.style.setProperty( '--header-bg', to );
		} );
	} );

	// ── Container width ───────────────────────────────────────────────────────
	api( 'marbure_theme_options[container_width]', function ( value ) {
		value.bind( function ( to ) {
			document.documentElement.style.setProperty( '--container-width', to + 'px' );
		} );
	} );

	// ── Footer copyright text ─────────────────────────────────────────────────
	api( 'marbure_theme_options[footer_copyright_text]', function ( value ) {
		value.bind( function ( to ) {
			const el = document.querySelector( '.footer-bottom__copyright' );
			if ( el ) el.innerHTML = to;
		} );
	} );

	// ── CTA button label ──────────────────────────────────────────────────────
	api( 'marbure_theme_options[header_cta_label]', function ( value ) {
		value.bind( function ( to ) {
			document.querySelectorAll( '.header-cta' ).forEach( function ( el ) {
				el.textContent = to;
			} );
		} );
	} );
}() );
