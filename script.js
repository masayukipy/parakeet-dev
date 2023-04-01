var navPos = jQuery( '#global-nav' ).offset().top; // グローバルメニューの位置
var navHeight = jQuery( '#global-nav' ).outerHeight(); // グローバルメニューの高さ
jQuery( window ).on( 'scroll', function() {
	if ( jQuery( this ).scrollTop() > navPos ) {
		jQuery( 'body' ).css( 'padding-top', navHeight );
		jQuery( '#global-nav' ).addClass( 'm_fixed' );
	} else {
		jQuery( 'body' ).css( 'padding-top', 0 );
		jQuery( '#global-nav' ).removeClass( 'm_fixed' );
	}
});