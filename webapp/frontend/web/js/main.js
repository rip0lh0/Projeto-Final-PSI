$(function () {
    // Navbar
    $(window).scroll(function () {
        if ($(document).scrollTop() > 50) {
            $('nav, .logo, .nav>li>a').addClass('shrink');
        } else {
            $('nav, .logo, .nav>li>a').removeClass('shrink');
        }
    });
});