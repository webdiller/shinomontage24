$(document).ready(function () {
    $("#carousel1").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        smartSpeed: 500,
        center: true,
        items: 1,
        dots: true
    });
    $("#carousel2").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: false,
        smartSpeed: 1000,
        center: true,
        items: 1,
        dots: true
    });
});