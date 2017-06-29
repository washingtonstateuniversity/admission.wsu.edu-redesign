( function( $ ) {

	// Scrolls to the top when the footer "Back to top" link is clicked.
	$( ".footer .back-to-top" ).click( function( e ) {
	    e.preventDefault();

	    $( "body, html" ).animate( {
	        scrollTop: 0
	    }, 450 );
	} );
}( jQuery ) );
