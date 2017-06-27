( function( $, window ) {

	// Sets initial positions of the Announcement buttons.
	$( ".announcements .flex-item" ).css( "top", $( ".announcements" ).height() + "px" );

	// Toggles the "Fields of Study" list.
	$( ".drop" ).click( function() {
		$( ".dropped" ).not( this ).removeClass( "dropped" );
		$( this ).toggleClass( "dropped" );
	} );

	// Triggers ripple effect on "Important Announcements" button clicks.
	// Based on https://codepen.io/ahse/pen/gaLKeM.
	$( ".ripple" ).on( "click", function( e ) {
		var $ripple = $( "<span class='ripple-effect'></span>" ),
			$button = $( this ),
			btnOffset = $button.offset(),
			xPos = e.pageX - btnOffset.left,
			yPos = e.pageY - btnOffset.top,
			size = parseInt( Math.min( $button.height(), $button.width() ) * 0.5 ),
			animateSize = parseInt( Math.max( $button.width(), $button.height() ) * Math.PI );

		$ripple
			.css( {
				top: yPos,
				left: xPos,
				width: size,
				height: size
			} )
			.appendTo( $button )
			.animate( {
					width: animateSize,
					height: animateSize,
					opacity: 0
				}, 150, function() {
					$( this ).remove();
				}
			);
	} );

	// Triggers scroll-based animations.
	$( window ).scroll( function() {
		window.requestAnimationFrame( function() {
			animate_lazy_text();
			slide_buttons();
		} );
	} );

	// Animates the lazy text list items.
	function animate_lazy_text() {
		var container = $( ".lazy-text-scroll" )[ 0 ].getBoundingClientRect();

		if ( window.innerHeight > container.top && 0 < container.bottom ) {
			$( ".lazy-text-scroll li" ).each( function() {
				var $element = $( this ),
					index = $element.index() + 1, // One-based
					y = $( window ).scrollTop() / ( index * 5 );

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
