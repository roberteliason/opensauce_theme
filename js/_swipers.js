( function( $ ) {
    function getSlideMaxHeight( $slides ) {
        return maxHeight = Math.max.apply( null, $slides.map( function ()
        {
            return $( this ).height();
        }).get() );
    }


    function resizeStepSwiper() {
        var maxHeight = getSlideMaxHeight( $( '.steps .slide-container' ) );
        $( '.steps .swiper-container' ).height( maxHeight + 42 );
    }

    $( document ).ready( function () {
        var latestSwiper = new Swiper('.latest .swiper-container', {
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

        var imageSwiper = new Swiper('.intro .swiper-container', {
            loop: true,
            autoplay: 3600,
            effect: 'fade',
            simulateTouch: false,

            nextButton: '.intro .swiper-button-next',
            prevButton: '.intro .swiper-button-prev'
        });

        var stepSwiper = new Swiper('.steps .swiper-container', {
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