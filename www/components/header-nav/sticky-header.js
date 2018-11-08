jQuery(function( $ ){

	if( $( document ).scrollTop() > 0 ){
		$( 'header' ).addClass( 'sticky' );
	}

	// Add opacity class to site header
	$( document ).on('scroll', function(){

		if ( $( document ).scrollTop() > 0 ){
			$( 'header' ).addClass( 'sticky' );
			$( '#menu-logo' ).src = '././resources/images/logo-white.svg';

		} else {
			$( 'header' ).removeClass( 'sticky' );
		}

	});

});
