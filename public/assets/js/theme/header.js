$(document).ready(function () {
    var headerHeight = $(".header-container").height();

    $('.header-profile').css("top", headerHeight);

    $(".profile-image").click(function (e) {
        $(".header-profile").slideToggle();
    });
});