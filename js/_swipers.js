( function( $ ) {
    $(document).ready(function () {
        var latestSwiper = new Swiper('.latest .swiper-container', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,

            // Navigation arrows
            nextButton: '.latest .swiper-button-next',
            prevButton: '.latest .swiper-button-prev',

            // Pagination
            pagination: '.latest .swiper-pagination',
            paginationClickable: true,
        });

        var imageSwiper = new Swiper('.intro .swiper-container', {
            loop: true,
            autoplay: 3600,
            effect: 'fade',

            nextButton: '.intro .swiper-button-next',
            prevButton: '.intro .swiper-button-prev',
        });

        var stepSwiper = new Swiper('.steps .swiper-container', {
            direction: 'horizontal',
            loop: true,

            nextButton: '.steps .swiper-button-next',
            prevButton: '.steps .swiper-button-prev',

            pagination: '.steps .swiper-pagination',
            paginationClickable: true,
        });
    });

}) ( jQuery );