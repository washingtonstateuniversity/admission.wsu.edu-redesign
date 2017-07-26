( function( $ ) {

	// Scrolls to the top when the footer "Back to top" link is clicked.
	$( ".back-to-top" ).click( function( e ) {
	    e.preventDefault();

	    $( "body, html" ).animate( {
	        scrollTop: 0
	    }, 450 );
	} );
}( jQuery ) );
