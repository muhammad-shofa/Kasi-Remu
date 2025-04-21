$(document).ready(function () {
  // get all category data and show into user table
  function loadCategoryData() {
    $.ajax({
      url: "/api/category/get-categories",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          let option =
            "<option value='' selected>-- Select Category --</option>";
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
  loadCategoryData();

  // live search with select2 library
  // $("#category").select2({
  //   placeholder: "Pilih Kategori",
  //   allowClear: true,
  //   ajax: {
  //     url: "/api/category/search",
  //     dataType: "json",
  //     delay: 250,
  //     data: function (params) {
  //       return {
  //         keyword: params.term, // keyword yg diketik user
  //       };
  //     },
  //     processResults: function (data) {
  //       return {
  //         results: data.data.map(function (category) {
  //           return {
  //             id: category.category_id,
  //             text: category.category_name,
  //           };
  //         }),
  //       };
  //     },
  //     cache: true,
  //   },
  // });

  // live search category
  // Trigger setiap kali user mengetik
  $("#search-category").on("input", function () {
    let keyword = $(this).val();

    $.ajax({
      url: "/api/category/search",
      type: "GET",
      data: { keyword: keyword },
      dataType: "json",
      success: (response) => {
        if (response.status) {
          let resultSearch = ``;
          response.data.forEach((category) => {
            resultSearch += `<p>${category["category_name"]}</p>`;
          });
          $("#category-demo").html(resultSearch);
          console.log(resultSearch);
        }
      },
    });
  });

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
