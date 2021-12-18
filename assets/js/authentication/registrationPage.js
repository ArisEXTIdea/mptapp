$(document).ready(function () {
  // Check Agreement for enable button

  $(".form-check-input").click(function (e) {
    if ($(".form-check-input").is(":checked") == true) {
      $("button").attr("disabled", false);
    } else {
      $("button").attr("disabled", true);
    }
  });

  // Verify password
  var myPassword;

  $("#password-input").on("input", function (e) {
    myPassword = $("#password-input").val();
  });

  $("#password-input-verify").on("input", function (e) {
    if (myPassword === $("#password-input-verify").val()) {
      console.log("password sama");
    } else {
      console.log("password tidak samaa");
    }
  });
});

bootstrapValidate('#email', 'email:Enter a valid E-Mail!')