( function( $ ) {

	// Toggle the "Fields of Study" list.
	$( ".drop" ).click( function() {
		$( ".dropped" ).not( this ).removeClass( "dropped" );
		$( this ).toggleClass( "dropped" );
	} );

	// Trigger ripple effect on "Important Announcements" button clicks.
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
}( jQuery ) );
