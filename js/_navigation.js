( function( $ ) {

    $( document ).ready( function () {
        var $menuToggle = $( '#js-mobile-menu' ).unbind();
        $menuToggle.removeClass( "show" );

        $menuToggle.on('click', function ( e ) {
            e.preventDefault();
            var $this = ( this );
            $this.slideToggle(function () {
                if ( $this.is( ':hidden' ) ) {
                    $this.removeAttr( 'style' );
                }
            });
        });
    });

}) ( jQuery );