$(document).ready(function () {
    var navbarHeight = $("#navbar").height();
    var windowHeight = $(window).height();
    console.log(windowHeight);
    console.log(navbarHeight);

    var introHeight = windowHeight - navbarHeight;

    $(".home-intro-introtext").css("height", introHeight);
    $(".home-intro-introillus").css("height", introHeight);

});