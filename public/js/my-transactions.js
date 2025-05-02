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

  // Tampilkan detail transaksi pada modal
  $(document).on("click", ".view-detail-action", function () {
    let transaction_id = $(this).data("transaction_id");
    console.log(transaction_id);

    $.ajax({
      url: `/api/transaction/get-transaction-detail/${transaction_id}`,
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          console.log(response.data);

          $("#viewDetailsModal").modal("show");

          let row = "";
          let no = 0;
          let txn_details = "";
          let txn_status = "";

          response.data.forEach((txn_details) => {
            no++;
            row += `
                      <tr class="align-middle">
                          <td>${no}</td>
                          <td>${txn_details["name"]}</td>
                          <td>${txn_details["category_name"]}</td>
                          <td>${txn_details["price"]}</td>
                          <td>${txn_details["quantity"]}</td>
                          <td>${txn_details["subtotal"]}</td>
                      </tr>
                      `;

            $("#txn_detail_code").html(
              `Transaction Code : ${txn_details["txn_code"]}`
            );
            $("#txn_detail_date").html(
              `Date & Time : ${txn_details["created_at"]}`
            );
            $("#txn_detail_cashier_name").html(
              `Cashier Name : ${txn_details["cashier_name"]}`
            );
            if (txn_details["status"] == "completed") {
              txn_status = `<span class="badge bg-success">Completed</span>`;
            } else {
              txn_status = `<span class="badge bg-success">Cancelled</span>`;
            }
            $("#txn_detail_status").html("Status : " + txn_status);
          });

          $("#viewDetailsTableData").html(row);
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
