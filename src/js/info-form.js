( function( $ ) {
	$( document ).ready( function() {

		$( "#disclose-additional" ).on( "click", function() {
			$( "#additional-info" ).toggleClass( "closed" );
		} );

		$( "#PhoneType" ).on( "change", function() {
			if ( $( "#PhoneType" ).val() === "Mobile" ) {
				$( "#MobileProvider, #OkayToText" ).removeClass( "hidden" );
			} else {
				$( "#MobileProvider, #OkayToText" ).addClass( "hidden" );
			}
		} );

		$( "#Country" ).on( "change", function() {
			if ( $( "#Country" ).val() === "USA" ) {
				$( "#State" ).removeClass( "hidden" );
			}
		} );

		$( "#info input[type=text], #info select" ).each( function() {
			var name = $( this ).attr( "name" ),
				stored_value = JSON.parse( sessionStorage.getItem( name ) );

			if ( stored_value !== "" ) {
				$( this ).val( stored_value );
			}
		} ).change( function() {
			var name = $( this ).attr( "name" ),
				value = $( this ).val();

			sessionStorage.setItem( name, JSON.stringify( value ) );
		} );
	} );
} )( jQuery );
