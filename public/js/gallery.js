$(document).ready(function () {
    $('#gallery-slider').owlCarousel({
        loop: true,
        center: true,
        items: 3,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 1000,
        smartSpeed: 600,
        dots: true,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            1170: { items: 3 }
        }
    });
});
