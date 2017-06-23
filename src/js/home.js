( function( $ ) {

	// Toggle the "Fields of Study" list.
	$( ".drop" ).click( function() {
		$( ".dropped" ).not( this ).removeClass( "dropped" );
		$( this ).toggleClass( "dropped" );
	} );
}( jQuery ) );
