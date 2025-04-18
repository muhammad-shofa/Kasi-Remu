$(document).ready(function () {
  // get all category data and show into user table
  function loadCategoryData() {
    $.ajax({
      url: "/api/category/get-categories",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          let option = "";

          response.data.forEach((category) => {
            option += `
              <option value="${category["category_id"]}">${category["category_name"]}</option>
            `;

            $("#category").html(option);
          });
        }
      },
      error: (xhr, error, status) => {
        console.log(xhr);
        console.log(error);
        console.log(status);
      },
    });
  }

  // load user data
  // console.log(loadCategoryData());
  loadCategoryData();



  // delete user confirmation
  // $(document).on("click", ".delete-action", function () {
  //   let item_id = $(this).data("item_id");
  //   $("#deleteItemId").val(item_id);
  // });

  // confirmed deletion
  // $(document).on("click", ".confirmed-deletion", function () {
  //   let item_id = $("#deleteItemId").val();

  //   $.ajax({
  //     url: "/api/item/delete-item/" + item_id,
  //     type: "DELETE",
  //     dataType: "json",
  //     success: (response) => {
  //       if (response.success) {
  //         console.log(response.message);
  //         loadItemData();

  //         $("#deleteModal").modal("hide");
  //       }
  //     },
  //     error: (xhr, error, status) => {
  //       console.log(xhr);
  //       console.log(error);
  //       console.log(status);
  //     },
  //   });
  // });
});
