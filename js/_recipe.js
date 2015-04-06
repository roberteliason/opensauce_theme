( function( $ ) {

    $(document).ready(function () {
        $('.ingredients-table tbody tr').click(function (e) {
            $(this).toggleClass('selected');
        });
    });

}) ( jQuery );