$(document).ready(function () {

    $(".main-menu").next(".sub-menu").hide();

    $(".main-menu").click(function () {
        $(this).next(".sub-menu").slideToggle();
        return false;
    });

    var width = $(window).width();
    var condition = true;


    if(width < 576){
        $("#sidebar").attr("style","display:none;");
        condition= false;
    }
    else{
        $("#sidebar").removeAttr("style","display:none;");
        condition= true;
    }

    $(window).resize(function () { 
        width = $(window).width();
        if(width < 576){
            $("#sidebar").attr("style","display:none;");
            condition= false;
        }
        else{
            $("#sidebar").removeAttr("style","display:none;");
            condition= true;
        }
    });
    


    $("#hamburger").click(function (e) {
        e.preventDefault();
        if(condition === true){
            $("#sidebar").animate({ width: "toggle" });
            setTimeout(() => {
                $("#sidebar").addClass("d-none");
                $("#content").removeClass("col-12 col-sm-8 col-md-9 col-lg-10");
                $("#content").addClass("col-12");
            }, 300);
            condition= false;
        }
        else{
            $("#sidebar").removeClass("d-none");
            $("#content").addClass("col-12 col-sm-8 col-md-9 col-lg-10");
            $("#content").removeClass("col-12");
            setTimeout(() => {
                $("#sidebar").animate({ width: "toggle" });
            }, 100);
            condition= true;
        }
    });
});