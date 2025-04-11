$(document).ready(function() {
    $.ajax({
        url: "/api/get-users",
        type: "GET",
        dataType: "json",
        success: (response) => {
            if (response.success) {
                console.log(response);
                console.log(response.data);
                let row = "";
                let no = 0;
                response.data.forEach((user) => {
                    no++;
                    row += `
                    <tr class="align-middle">
                        <td>${no}</td>
                        <td>${user['name']}</td>
                        <td>${user['username']}</td>
                        <td>${user['email']}</td>
                        <td>${user['role']}</td>
                        <td>
                            <div class="btn-group mb-2" role="group">
                                <button type="button" class="btn btn-warning">Edit</button>
                                <button type="button" class="btn btn-danger">Delete</button>
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
        }
    })
})