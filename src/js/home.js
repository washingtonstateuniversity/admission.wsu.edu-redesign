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

		// Unsets lazy text inline style.
		if ( 694 > window.innerWidth ) {
			$( ".lazy-text-scroll li" ).css( "top", "" );
		}

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
			animate_lazy_text();
		} );
	} );

	// Animates the lazy text list items.
	function animate_lazy_text() {
		var container = $( ".lazy-text-scroll" )[ 0 ].getBoundingClientRect();

		if ( window.innerHeight > container.top && 0 < container.bottom ) {
			$( ".lazy-text-scroll li" ).each( function() {
				var $element = $( this ),
					index = $element.index() + 1, // One-based
					y = $( window ).scrollTop() / ( index * 20 ),
					element_bottom = this.getBoundingClientRect().bottom,
					window_height = $( window ).height();

				$element.css( {
					"top": "-" + parseInt( y ) + "px",
					"opacity": ( element_bottom / window_height ) * ( index * 1.5 )
				} );
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
					}, 450, function() {
						$element.find( "p" ).css( "opacity", "1" );
					} );
				}, i * 450 );
			} );
		}
	}
}( jQuery, window ) );
