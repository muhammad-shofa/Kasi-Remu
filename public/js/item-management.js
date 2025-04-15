$(document).ready(function () {
  // get all item data and show into user table
  function loadItemData() {
    $.ajax({
      url: "/api/item/get-items",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          // console.log(response.data);
          let row = "";
          let no = 0;

          // if (response.data.length != 0) {
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
          // } else {
          //   $(".no-data-yet").html("<p>No users yet</p>");
          // }

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

  // load user data
  loadItemData();

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
