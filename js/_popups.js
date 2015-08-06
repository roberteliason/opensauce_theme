( function( $ ) {
    $( document ).ready( function() {
        $( '.qr-popup' ).on( 'click', function( e ) {
            e.preventDefault();

            $.ajax(
                {
                    url: e.currentTarget.href
                }
            ).done( function( data ) {
                var $modal      = $( $( '.modals' ).html() );
                var $container  = $( '.inner', $modal );

                $container.html( data );
                $modal.toggleClass( 'show' );
                $modal.on( 'click', function( e ) {
                    e.preventDefault();
                    var $this = $( this );

                    $( '.inner', $this ).html( '' );
                    $this.toggleClass( 'show' );
                    $this.remove();
                });

                $( 'body' ).append( $modal );
            });
        });
    });
})( jQuery );