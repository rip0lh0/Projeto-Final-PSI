$(function () {
    // Navbar
    $(window).scroll(function () {
        if ($(document).scrollTop() > 50) {
            $('nav, .logo, .nav>li>a').addClass('shrink');
        } else {
            $('nav, .logo, .nav>li>a').removeClass('shrink');
        }
    });

    if (!isTouchDevice()) {
        $('[data-toggle*="tooltip"]').tooltip();
    }

    // utility

    function isTouchDevice() {
        return !!('ontouchstart' in window || navigator.msMaxTouchPoints);
    }
});