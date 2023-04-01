var navPos = $( '#global-nav' ).offset().top; // グローバルメニューの位置
var navHeight = $( '#global-nav' ).outerHeight(); // グローバルメニューの高さ
$( window ).on( 'scroll', function() {
	if ( $( this ).scrollTop() > navPos ) {
		$( 'body' ).css( 'padding-top', -navHeight );
		$( '#global-nav' ).addClass( 'm_fixed' );
	} else {
		$( 'body' ).css( 'padding-top', 0 );
		$( '#global-nav' ).removeClass( 'm_fixed' );
	}
});