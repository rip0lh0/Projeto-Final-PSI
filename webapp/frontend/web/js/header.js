// 768

$(function () {
    if (screen.width < 768) $(".navbar").addClass("shrink-nav");
    $(window).scroll(function () {
        var wscroll = $(this).scrollTop();

        if (wscroll > 50) $(".navbar").addClass("shrink-nav");
        else $(".navbar").removeClass("shrink-nav");

        if (screen.width < 768) $(".navbar").addClass("shrink-nav");
    });
});