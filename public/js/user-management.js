$(document).ready(function () {
  // get all users data and show into user table
  function loadUserData() {
    $.ajax({
      url: "/api/user/get-users",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          // console.log(response);
          // console.log(response.data);
          let row = "";
          let no = 0;
          response.data.forEach((user) => {
            no++;
            row += `
                    <tr class="align-middle">
                        <td>${no}</td>
                        <td>${user["name"]}</td>
                        <td>${user["username"]}</td>
                        <td>${user["email"]}</td>
                        <td>${user["gender"]}</td>
                        <td>${user["role"]}</td>
                        <td>
                            <div class="btn-group mb-2" role="group">
                                <button type="button" class="edit-action btn btn-warning" data-user_id="${user["user_id"]}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                <button type="button" class="delete-action btn btn-danger" data-user_id="${user["user_id"]}">Delete</button>
                            </div>
                        </td>
                    </tr>
                    `;
          });

          $("#userTableData").html(row);
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
  loadUserData();

  // add new user
  $(document).on("click", ".save-add", function () {
    let formData = {
      name: $("#name").val(),
      username: $("#username").val(),
      password: $("#password").val(),
      email: $("#email").val(),
      gender: $("#gender").val(),
      role: $("#role").val(),
    };

    $.ajax({
      url: "/api/user/add-user",
      type: "POST",
      dataType: "json",
      data: formData,
      success: (response) => {
        console.log(response);
        if (response.success) {
          console.log(response.message);
          loadUserData();

          $("#addModal").modal("hide");
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
    let user_id = $(this).data("user_id");

    $.ajax({
      url: "/api/user/get-edit/" + user_id,
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          // console.log(response.data);
          $("#editUserId").val(response.data.user_id); // hidden
          $("#editName").val(response.data.name);
          $("#editUsername").val(response.data.username);
          $("#editEmail").val(response.data.email);
          $("#editGender").val(response.data.gender);
          $("#editRole").val(response.data.role);
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
    let user_id = $("#editUserId").val();

    let formData = {
      name: $("#editName").val(),
      username: $("#editUsername").val(),
      email: $("#editEmail").val(),
      gender: $("#editGender").val(),
      role: $("#editRole").val(),
    };

    console.log(formData);

    $.ajax({
      url: "/api/user/save-edit/" + user_id,
      type: "POST",
      dataType: "json",
      data: formData,
      success: (response) => {
        console.log(response);
        if (response.success) {
          console.log(response.message);
          loadUserData();

          $("#editModal").modal("hide");
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
