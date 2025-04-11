$(document).ready(function() {
    $.ajax({
        url: "/api/get-users",
        type: "GET",
        dataType: "json",
        success: (response) => {
            if (response.success) {
                console.log(response);
                console.log(response.data);
            }
        },
        error: (xhr, error, status) => {
            console.log(xhr);
            console.log(error);
            console.log(status);
        }
    })
})