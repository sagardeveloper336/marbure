/**
 * Animated stat counters.
 * Uses IntersectionObserver to start counting when the stat section enters view.
 * No external dependency — pure requestAnimationFrame easing.
 */
export function initCounters() {
	const counters = document.querySelectorAll( '.js-counter' );
	if ( ! counters.length ) return;

	const easeOutQuart = ( t ) => 1 - Math.pow( 1 - t, 4 );

	const animateCounter = ( el ) => {
		const target   = parseFloat( el.dataset.target ) || 0;
		const duration = parseInt( el.dataset.duration, 10 ) || 2000;
		const start    = performance.now();
		const isFloat  = String( target ).includes( '.' );

		const step = ( now ) => {
			const elapsed  = now - start;
			const progress = Math.min( elapsed / duration, 1 );
			const value    = easeOutQuart( progress ) * target;

			el.textContent = isFloat
				? value.toFixed( 1 )
				: Math.floor( value ).toLocaleString();

			if ( progress < 1 ) {
				requestAnimationFrame( step );
			} else {
				el.textContent = isFloat
					? target.toFixed( 1 )
					: target.toLocaleString();
			}
		};

		requestAnimationFrame( step );
	};

	// Trigger when 50% of the stats section is in view
	const observer = new IntersectionObserver(
		( entries, obs ) => {
			entries.forEach( ( entry ) => {
				if ( ! entry.isIntersecting ) return;
				animateCounter( entry.target );
				obs.unobserve( entry.target );
			} );
		},
		{ threshold: 0.4 }
	);

	counters.forEach( ( el ) => observer.observe( el ) );
}
