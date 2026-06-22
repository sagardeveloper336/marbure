/**
 * FAQ Accordion — accessible expand/collapse.
 * Works with the aria-expanded / aria-hidden pattern in page-faq.php.
 */
export function initFaqAccordion() {
	const accordion = document.querySelector( '.faq-accordion' );
	if ( ! accordion ) return;

	accordion.querySelectorAll( '.faq-item__question' ).forEach( ( btn ) => {
		btn.addEventListener( 'click', () => {
			const expanded = btn.getAttribute( 'aria-expanded' ) === 'true';
			const answer   = document.getElementById( btn.getAttribute( 'aria-controls' ) );

			// Close all others
			accordion.querySelectorAll( '.faq-item__question' ).forEach( ( b ) => {
				if ( b !== btn ) {
					b.setAttribute( 'aria-expanded', 'false' );
					const a = document.getElementById( b.getAttribute( 'aria-controls' ) );
					if ( a ) a.setAttribute( 'aria-hidden', 'true' );
				}
			} );

			// Toggle current
			btn.setAttribute( 'aria-expanded', String( ! expanded ) );
			if ( answer ) answer.setAttribute( 'aria-hidden', String( expanded ) );
		} );
	} );
}
