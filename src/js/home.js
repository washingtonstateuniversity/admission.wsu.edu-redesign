( function( $, window ) {

	// Sets initial positions of the Announcement buttons.
	$( ".announcements .flex-item" ).css( "top", $( ".announcements" ).height() + "px" );

	// Toggles the "Fields of Study" list.
	$( ".drop" ).click( function() {
		$( ".dropped" ).not( this ).removeClass( "dropped" );
		$( this ).toggleClass( "dropped" );
	} );

	// Handles changes for different browser widths.
	$( window ).resize( function() {

		// Toggles homepage featured image effects.
		if ( 737 > window.innerWidth ) {
			$( ".home .hero.video" ).addClass( "featured heromask-gradient" );
		} else {
			$( ".home .hero.video" ).removeClass( "featured heromask-gradient" );
		}
	} );

	// Triggers scroll-based animations.
	$( window ).scroll( function() {
		window.requestAnimationFrame( function() {
			slide_buttons();
		} );
	} );

	// Slides the "Important Announcements" buttons in.
	function slide_buttons() {
		var container = $( ".announcements" )[ 0 ].getBoundingClientRect();

		if ( window.innerHeight > container.bottom ) {
			$( ".announcements .slide-up" ).each( function( i ) {
				var $element = $( this );

				setTimeout( function() {
					$element.animate( {
						"top": "0"
					}, 450, function() {
						$element.find( "p" ).css( "opacity", "1" );
					} );
				}, i * 450 );
			} );
		}
	}
}( jQuery, window ) );
