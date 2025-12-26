$(document).ready(function () {
    $('#gallery-slider').owlCarousel({
        loop: true,
        center: true,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 600,
        dots: true,
        responsive: {
            0: { items: 1 },      // small phones: 1 item
            576: { items: 2 },    // tablets: 2 items
            992: { items: 3 }     // desktop: 3 items
        }
    });

    // Refresh after all images load
    $(window).on('load', function () {
        $('#gallery-slider').trigger('refresh.owl.carousel');
    });
});
