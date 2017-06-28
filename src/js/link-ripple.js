( function( $ ) {

	// Triggers ripple effect on link clicks.
	// Based on https://codepen.io/ahse/pen/gaLKeM.
	$( "main a" ).on( "click", function( e ) {
		var $ripple = $( "<span class='ripple-effect'></span>" ),
			$button = $( this ),
			button_offset = $button.offset(),
			x_position = e.pageX - button_offset.left,
			y_position = e.pageY - button_offset.top,
			size = parseInt( Math.min( $button.height(), $button.width() ) * 0.5 ),
			animate_size = parseInt( Math.max( $button.width(), $button.height() ) * Math.PI );

		$ripple
			.css( {
				top: y_position,
				left: x_position,
				width: size,
				height: size
			} )
			.appendTo( $button )
			.animate( {
					width: animate_size,
					height: animate_size,
					opacity: 0
				}, 450, function() {
					$( this ).remove();
				}
			);
	} );
}( jQuery ) );
