( function( $ ) {
    $( document ).ready( function() {
        $( '.qr-popup' ).on( 'click', function( e ) {
            e.preventDefault();

            $.ajax(
                {
                    url: e.currentTarget.href
                }
            ).done( function( data ) {
                var $modal      = $( '.modals .popover' );
                var $container  = $( '.inner', $modal );
                $container.html( data );
                $modal.toggleClass( 'show' );
            });
        });

        $( '.popover' ).on( 'click', function( e ) {
            e.preventDefault();

            $( '.inner', this ).html( '' );
            $( this ).toggleClass( 'show' );
        });
    });
})( jQuery );