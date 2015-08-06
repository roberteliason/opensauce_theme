( function( $ ) {

    var radius = 80;
    var strokeWidth = 40;
    var canvasWidth = radius*2;
    var canvasHeight = canvasWidth;
    var centerX = canvasWidth / 2;
    var centerY = centerX;
    var startX = centerX;
    var startY = centerY - radius;


    /**
     * sets the value to display
     *
     * @param $gauge
     * @param value
     */
    function setGaugeValue( $gauge, value ) {

        if ( value >= 100 ) {
            value = 99.9999;
        }
        if ( value < 0 ) {
            value = 0;
        }

        var drawMode = 0;
        var progressDegrees = ( 100 - value )/100 * 360;
        var progressRadians = progressDegrees * Math.PI / 180;
        if ( progressDegrees < 179 ) {
            drawMode = 1;
        }

        var endX = centerX - ( Math.sin( progressRadians ) * radius );
        var endY = centerY - ( Math.cos( progressRadians ) * radius );

        $( '.gaugeMask path', $gauge )
            .attr( 'd', 'M'+centerX+', '+centerY+' L'+startX+', '+startY+' A'+radius+','+radius+' 0 '+drawMode+',1 '+endX+','+endY+' z' );

        $( '.value', $gauge )
            .html( Math.ceil( value ) + '<tspan>%</tspan>' )
            .find( 'tspan' )
            .attr( 'font-size', '2rem' );

    }


    /**
     * For each callback that sets up the gauges
     *
     * @param $gauge
     * @param $value
     * @param number
     */
    function drawGauge( $gauge, $value, number ) {

        $( $gauge )
            .attr( 'width', canvasWidth )
            .attr( 'height', canvasHeight )
            .attr( 'viewport', '0 0 '+ canvasWidth +' '+canvasHeight );

        $( '.gaugeMask', $gauge )
            .attr( 'id', 'mask'+number );

        $( '#track', $gauge )
            .attr( 'r', radius - ( strokeWidth / 4 ) )
            .attr( 'cx', centerX )
            .attr( 'cy', centerY )
            .attr( 'stroke', 'rgba( 0,0,0,0.25 )' )
            .attr( 'stroke-width', strokeWidth / 2 )
            .attr( 'fill', 'none' );

        $( '#fill', $gauge )
            .attr( 'r', radius )
            .attr( 'cx', centerX )
            .attr( 'cy', centerY )
            .attr( 'stroke', 'rgb( 176, 0, 0 )' )
            .attr( 'stroke-width', strokeWidth )
            .attr( 'fill', 'none' )
            .attr( 'clip-path', 'url(#mask'+number+')' );

        $( '.value', $gauge )
            .attr( 'x', '50%' )
            .attr( 'y', '60%' )
            .attr( 'text-anchor', 'middle' )
            .attr( 'font-size', '3em' );

        setGaugeValue( $gauge, $value );
    }

    /**
     * The bootstrapping
     */
    $( document ).ready( function() {

        var $gauges = $( '.gauge' );
        for ( var i = 0; i < $gauges.length; i++ ) {
            var $gauge = $gauges.eq(i).find( '.gauge-round' );
            var value = $gauges.eq(i).data( 'value' );

            drawGauge( $gauge, value, i );
        }

    });

})( jQuery );
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
( function( $ ) {

    $( document ).ready( function () {
        $( '.ingredients-table tbody tr' ).click( function ( e ) {
            $( this ).toggleClass( 'selected' );
        });
    });

}) ( jQuery );
( function( $ ) {
    function getSlideMaxHeight( $slides ) {
        return Math.max.apply( null, $slides.map( function ()
        {
            return $( this ).height();
        }).get() );
    }


    function resizeStepSwiper() {
        var $slideContainer = $( '.steps .slide-container' );
        var maxHeight = getSlideMaxHeight( $slideContainer );
        $( $slideContainer ).height( maxHeight + 42 );
    }

    $( document ).ready( function () {
        var latestSwiper = new Swiper( '.latest .swiper-container', {
            // Optional parameters
            loop: true,
            simulateTouch: false,

            // Navigation arrows
            nextButton: '.latest .swiper-button-next',
            prevButton: '.latest .swiper-button-prev',

            // Pagination
            pagination: '.latest .swiper-pagination',
            paginationClickable: true
        });

        var imageSwiper = new Swiper( '.intro .swiper-container', {
            loop: true,
            autoplay: 3600,
            effect: 'fade',
            simulateTouch: false,

            nextButton: '.intro .swiper-button-next',
            prevButton: '.intro .swiper-button-prev'
        });

        var stepSwiper = new Swiper( '.steps .swiper-container', {
            loop: true,
            simulateTouch: false,

            nextButton: '.steps .swiper-button-next',
            prevButton: '.steps .swiper-button-prev',

            pagination: '.steps .swiper-pagination',
            paginationClickable: true
        });
        resizeStepSwiper();
    });

    $( window ).resize( function() {
        resizeStepSwiper();
    });
}) ( jQuery );