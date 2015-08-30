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

        $( '.latest .slick-wrapper' ).slick(
            {
                autoplay: true,
                prevArrow: '<a href="#" class="slick-prev"></a>',
                nextArrow: '<a href="#" class="slick-next"></a>',
                mobileFirst: true,
                dots: true,
                responsive: [
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: true
                        }
                    }
                ]
            }
        );

        $( '.intro .slick-wrapper' ).slick(
            {
                autoplay: true,
                mobileFirst: true,
                dots: true,
                prevArrow: '<a href="#" class="slick-prev"></a>',
                nextArrow: '<a href="#" class="slick-next"></a>',
                responsive: [
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: true
                        }
                    }
                ]
            }
        );

        $( '.steps .slick-wrapper' ).slick(
            {
                autoplay: false,
                mobileFirst: true,
                dots: true,
                prevArrow: '<a href="#" class="slick-prev"></a>',
                nextArrow: '<a href="#" class="slick-next"></a>',
                responsive: [
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: true
                        }
                    }
                ]
            }
        );
    });

    $( window ).resize( function() {
    });
}) ( jQuery );