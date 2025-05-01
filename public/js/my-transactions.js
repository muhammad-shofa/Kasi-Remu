$(document).ready(function () {
  // load my transactions data
  function loadMyTransactionsData() {
    $.ajax({
      url: "/api/transaction/get-my-transactions",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          let row = "";
          let no = 0;

          response.data.forEach((mytxn) => {
            no++;
            row += `
                      <tr class="align-middle">
                          <td>${no}</td>
                          <td>${mytxn["txn_code"]}</td>
                          <td>${mytxn["created_at"]}</td>
                          <td>${mytxn["total_items"]}</td>
                          <td>${mytxn["total_amount"]}</td>
                          <td>${mytxn["status"]}</td>
                          <td>
                              <div class="btn-group mb-2" role="group">
                                  <button type="button" class="view-detail-action btn btn-info" data-transaction_id="${mytxn["transaction_id"]}">Details</button>
                              </div>
                          </td>
                      </tr>
                      `;
          });
          //   <button type="button" class="edit-action btn btn-warning" data-mytxn_id="${mytxn["mytxn_id"]}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>

          $("#myTransactionsTableData").html(row);
        }
      },
      error: (xhr, error, status) => {
        console.log(xhr);
        console.log(error);
        console.log(status);
      },
    });
  }

  // load my transactions data
  loadMyTransactionsData();
});
