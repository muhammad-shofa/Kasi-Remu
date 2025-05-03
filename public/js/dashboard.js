$(document).ready(function () {
  function loadCountData() {
    $.ajax({
      url: "/api/dashboard/count-data",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          $("#userCountData").html(response.userCount);
          $("#itemCountData").html(response.itemCount);
          $("#myTransactionCountData").html(response.myTransactionCount);
          $("#allTransactionCountData").html(response.allTransactionCount);
        } else {
        }
      },
      error: (xhr, error, status) => {
        console.log(xhr);
        console.log(error);
        console.log(status);
      },
    });
  }

  loadCountData();
});
