( function( $, window ) {

	// Sets initial positions of the Announcement buttons.
	$( ".announcements .flex-item" ).css( "top", $( ".announcements" ).height() + "px" );

	// Toggles the "Fields of Study" list.
	$( ".drop" ).click( function() {
		$( ".dropped" ).not( this ).removeClass( "dropped" );
		$( this ).toggleClass( "dropped" );
	} );

	// Unsets lazy text inline style.
	$( window ).resize( function() {
		if ( 693 > $( window ).width() ) {
			$( ".lazy-text-scroll li" ).css( "top", "" );
		}
	} );

	// Triggers scroll-based animations.
	$( window ).scroll( function() {
		window.requestAnimationFrame( function() {
			slide_buttons();

			if ( 693 < $( window ).width() ) {
				animate_lazy_text();
			}
		} );
	} );

	// Animates the lazy text list items.
	function animate_lazy_text() {
		var container = $( ".lazy-text-scroll" )[ 0 ].getBoundingClientRect();

		if ( window.innerHeight > container.top && 0 < container.bottom ) {
			$( ".lazy-text-scroll li" ).each( function() {
				var $element = $( this ),
					index = $element.index() + 1, // One-based
					y = $( window ).scrollTop() / ( index * 2 );

				$element.css( "top", "-" + parseInt( y ) + "px" );
			} );
		}
	}

	// Slides the "Important Announcements" buttons in.
	function slide_buttons() {
		var container = $( ".announcements" )[ 0 ].getBoundingClientRect();

		if ( window.innerHeight > container.bottom ) {
			$( ".announcements .slide-up" ).each( function( i ) {
				var $element = $( this );

				setTimeout( function() {
					$element.animate( {
						"top": "0"
					}, 300, function() {
						$element.find( "p" ).css( "opacity", "1" );
					} );
				}, i * 300 );
			} );
		}
	}
}( jQuery, window ) );
