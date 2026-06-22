( function ( $ ) {
	'use strict';

	$( document ).on( 'click', '.marbure-image-field .marbure-add-image', function ( e ) {
		e.preventDefault();

		var $field  = $( this ).closest( '.marbure-image-field' );
		var frame   = wp.media( {
			title:    'Select Image',
			button:   { text: 'Use this image' },
			multiple: false,
		} );

		frame.on( 'select', function () {
			var attachment = frame.state().get( 'selection' ).first().toJSON();
			$field.find( 'input[type="hidden"]' ).val( attachment.id );
			if ( $field.find( 'img' ).length ) {
				$field.find( 'img' ).attr( 'src', attachment.url );
			} else {
				$field.find( '.marbure-no-image' ).hide();
				$field.prepend( '<img src="' + attachment.url + '" style="max-width:200px;display:block;margin-bottom:8px;">' );
			}
		} );

		frame.open();
	} );

	$( document ).on( 'click', '.marbure-image-field .marbure-remove-image', function ( e ) {
		e.preventDefault();
		var $field = $( this ).closest( '.marbure-image-field' );
		$field.find( 'input[type="hidden"]' ).val( '' );
		$field.find( 'img' ).remove();
		$( this ).closest( 'p' ).remove();
		$field.find( '.marbure-add-image' ).text( 'Add Image' );
		if ( ! $field.find( '.marbure-no-image' ).length ) {
			$field.prepend( '<span class="marbure-no-image">No image selected</span>' );
		}
		$field.find( '.marbure-no-image' ).show();
		$( this ).remove();
	} );

} )( jQuery );
