( function( $, window ) {
	$( window ).scroll( function() {
		window.requestAnimationFrame( parallax );
	} );

	function parallax() {
		$( ".section-wrapper-has-background" ).has( ".featured" ).each( function() {
			var $element = $( this ),
				container = this.getBoundingClientRect(),
				y = $( window ).scrollTop() / 5;

			if ( 0 < container.bottom ) {
				$element.css( "background-position-y", "calc(50% + " + y + "px)" );
			}
		} );
	}
}( jQuery, window ) );
