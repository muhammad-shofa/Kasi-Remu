$(document).ready(() => {
  $("#loginForm").on("submit", function (e) {
    e.preventDefault();
    let loginData = $(this).serialize();
    // console.log(loginData);

    $.ajax({
      url: "/api/auth/login",
      type: "POST",
      dataType: "json",
      data: loginData,
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          // future update: show popup login success
          // console.log();
          window.location.href = "/dashboard";
        } else {
          console.log(response.message);
        }
      },
      error: (xhr, error, status) => {
        console.log(xhr);
        console.log(error);
        console.log(status);
      },
    });
  });

  $(".btn-logout").on("click", function () {
    $.ajax({
      url: "/api/auth/logout",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          window.location.href = "/";
        } else {
          console.log(response.message);
        }
      },
      error: (xhr, error, status) => {
        console.log(xhr);
        console.log(error);
        console.log(status);
      },
    });
  });
});
