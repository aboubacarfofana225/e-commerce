jQuery( function ( $ ) {
	'use strict';

	$( '.js-dtdsi-import-data' ).on( 'click', function () {

		// Reset response div content.
		$( '.js-dtdsi-ajax-response' ).empty();

		// Prepare data for the AJAX call
		var data = new FormData();
		data.append( 'action', 'DTDSI_import_demo_data' );
		data.append( 'security', dtdsi.ajax_nonce );
		data.append( 'selected', $( '#DTDSI__demo-import-files' ).val() );
		if ( $('#DTDSI__content-file-upload').length ) {
			data.append( 'content_file', $('#DTDSI__content-file-upload')[0].files[0] );
		}
		if ( $('#DTDSI__widget-file-upload').length ) {
			data.append( 'widget_file', $('#DTDSI__widget-file-upload')[0].files[0] );
		}
		if ( $('#DTDSI__customizer-file-upload').length ) {
			data.append( 'customizer_file', $('#DTDSI__customizer-file-upload')[0].files[0] );
		}

		// AJAX call to import everything (content, widgets, before/after setup)
		ajaxCall( data );

	});

	function ajaxCall( data ) {
		$.ajax({
			method:     'POST',
			url:        dtdsi.ajax_url,
			data:       data,
			contentType: false,
			processData: false,
			beforeSend: function() {
				$( '.js-dtdsi-ajax-loader' ).show();
			}
		})
		.done( function( response ) {

			if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {
				ajaxCall( data );
			}
			else if ( 'undefined' !== typeof response.message ) {
				$( '.js-dtdsi-ajax-response' ).append( '<p>' + response.message + '</p>' );
				$( '.js-dtdsi-ajax-loader' ).hide();
			}
			else {
				$( '.js-dtdsi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>' + response + '</p></div>' );
				$( '.js-dtdsi-ajax-loader' ).hide();
			}
		})
		.fail( function( error ) {
			$( '.js-dtdsi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>Error: ' + error.statusText + ' (' + error.status + ')' + '</p></div>' );
			$( '.js-dtdsi-ajax-loader' ).hide();
		});
	}

	// Switch preview images on select change event, but only if the img element .js-dtdsi-preview-image exists.
	// Also switch the import notice (if it exists).
	$( '#DTDSI__demo-import-files' ).on( 'change', function(){
		if ( $( '.js-dtdsi-preview-image' ).length ) {

			// Attempt to change the image, else display message for missing image.
			var currentFilePreviewImage = dtdsi.import_files[ this.value ]['import_preview_image_url'] || '';
			$( '.js-dtdsi-preview-image' ).prop( 'src', currentFilePreviewImage );
			$( '.js-dtdsi-preview-image-message' ).html( '' );

			if ( '' === currentFilePreviewImage ) {
				$( '.js-dtdsi-preview-image-message' ).html( dtdsi.texts.missing_preview_image );
			}
		}

		// Update import notice.
		var currentImportNotice = dtdsi.import_files[ this.value ]['import_notice'] || '';
		$( '.js-dtdsi-demo-import-notice' ).html( currentImportNotice );
	});

});
