$(document).ready(function () {
    $("#filter-slide-button").click(function (e) { 
        e.preventDefault();
        $("#search-filter").slideToggle();
    });
});