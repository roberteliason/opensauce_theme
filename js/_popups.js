( function( $ ) {
    $(document).ready( function() {
        $( '.qr-popup' ).on( 'click', function( e ) {
            e.preventDefault();

            $.ajax(
                {
                    url: e.currentTarget.href
                }
            ).done( function( data ) {
                $modal      = $( 'modals .popover' );
                $container  = $( '.inner', $modal );
                $container.html( data );
                $modal.toggleClass( 'show' );
            });
        });

        $( '.popover' ).on( 'click', function( e ) {
            $( '.inner', this ).html( '' );
            $( this ).toggleClass( 'show' );
        });
    });
})( jQuery );