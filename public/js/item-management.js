$(document).ready(function () {
  // get all item data and show into user table
  function loadItemData() {
    $.ajax({
      url: "/api/item/get-items",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          let row = "";
          let no = 0;

          response.data.forEach((item) => {
            no++;
            row += `
                    <tr class="align-middle">
                        <td>${no}</td>
                        <td>${item["name"]}</td>
                        <td>${item["category_name"]}</td>
                        <td>${item["price"]}</td>
                        <td>${item["stock"]}</td>
                        <td>
                            <div class="btn-group mb-2" role="group">
                                <button type="button" class="edit-action btn btn-warning" data-item_id="${item["item_id"]}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                <button type="button" class="delete-action btn btn-danger" data-item_id="${item["item_id"]}" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                            </div>
                        </td>
                    </tr>
                    `;
          });

          $("#itemTableData").html(row);
        }
      },
      error: (xhr, error, status) => {
        console.log(xhr);
        console.log(error);
        console.log(status);
      },
    });
  }

  // load item data
  loadItemData();

  // add new item
  $(document).on("click", ".save-add", function () {
    let formData = {
      name: $("#name").val(),
      category_id: $("#category").val(),
      price: $("#price").val(),
      stock: $("#stock").val(),
    };

    $.ajax({
      url: "/api/item/add-item",
      type: "POST",
      dataType: "json",
      data: formData,
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          loadItemData();

          // reset
          $("#addItemForm")[0].reset();
          $("#addModal").modal("hide");
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

  // add new category
  $(document).on("click", ".save-category", function () {
    let newCategoryName = $("#newCategoryName").val();

    $.ajax({
      url: "/api/category/add-category",
      type: "POST",
      dataType: "json",
      data: { name: newCategoryName},
      success: (response) => {
        if (response.success) {
          console.log(response.message);
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

  // get edit (when edit-action btn clicked)
  $(document).on("click", ".edit-action", function () {
    let item_id = $(this).data("item_id");
    let category_id = 0;

    $.ajax({
      url: "/api/item/get-edit/" + item_id,
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          console.log(response.data);
          $("#editItemId").val(response.data.item_id); // hidden
          $("#editName").val(response.data.name);
          // category_id += response.data.category
          // loadCategoryData();

          $("#editCategory").val(response.data.category_name);
          $("#editPrice").val(response.data.price);
          $("#editStock").val(response.data.stock);
        }
      },
      error: (xhr, error, status) => {
        console.log(xhr);
        console.log(error);
        console.log(status);
      },
    });
  });

  // save edit
  $(document).on("click", ".save-edit", function () {
    let item_id = $("#editItemId").val();

    let formData = {
      name: $("#editName").val(),
      username: $("#editUsername").val(),
      email: $("#editEmail").val(),
      gender: $("#editGender").val(),
      role: $("#editRole").val(),
    };

    console.log(formData);

    $.ajax({
      url: "/api/item/save-edit/" + item_id,
      type: "POST",
      dataType: "json",
      data: formData,
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          loadUserData();

          $("#editModal").modal("hide");
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

  // delete user confirmation
  $(document).on("click", ".delete-action", function () {
    let item_id = $(this).data("item_id");
    $("#deleteItemId").val(item_id);
  });

  // confirmed deletion
  $(document).on("click", ".confirmed-deletion", function () {
    let item_id = $("#deleteItemId").val();

    $.ajax({
      url: "/api/item/delete-item/" + item_id,
      type: "DELETE",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          loadItemData();

          $("#deleteModal").modal("hide");
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
