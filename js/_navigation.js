( function( $ ) {

    $( document ).ready( function () {
        var $menuToggle = $( '#js-mobile-menu' )
        var $menu = $( '.navigation-menu' );
        $menuToggle.unbind();
        $menu.removeClass( "show" );

        $menuToggle.on('click', function ( e ) {
            e.preventDefault();
            $menu.slideToggle( function () {
                if ( $menu.is( ':hidden' ) ) {
                    $menu.removeAttr( 'style' );
                }
            });
        });
    });

}) ( jQuery );