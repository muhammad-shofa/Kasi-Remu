$(document).ready(function () {
  // load catalog data
  function loadCatalogData() {
    $.ajax({
      url: "/api/item/get-items",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          let content = "";

          // console.log("debuug load catalog data" + response.data[1]["price"]);
          for (let i = 0; i <= 4; i++) {
            content += `
                      <div class="flex-grow-1 border p-3 m-3 shadow-sm" style="width: 200px;">
                              <h5 class="mb-1">${response.data[i]["name"]}</h5>
                              <p class="mb-2">Rp${response.data[i]["price"]}</p>
                              <div class="d-grid">
                                  <button class="catalog-add-item btn btn-warning" data-item_id="${response.data[i]["item_id"]}">+</button>
                              </div>
                      </div>`;
          }

          $("#catalog-item").html(content);
        }
      },
      error: (xhr, error, status) => {
        console.log(xhr);
        console.log(error);
        console.log(status);
      },
    });
  }

  // calculate total price function
  function calculate_totalPrice() {
    let total_price = $("#totalPrice").text();
    let cash_received = $("#cash_received").val();
    let change = cash_received - total_price;
    // console.log(total_price);
    // console.log(cash_received);
    // console.log(change);

    if (change < 0) {
      $("#change").text(0);
    } else {
      $("#change").text(change);
    }
  }

  // calculate total price
  $(document).on("input", "#cash_received", function () {
    calculate_totalPrice();
  });

  // load cart data
  function loadCartData(isReset) {
    isReset ? $("#cartTableData").empty() : "";

    $.ajax({
      url: "/api/transaction/get-tmp-transaction",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          // console.log(response.message);

          let no = 0;
          let row = "";
          let total_price = 0;

          response.data.forEach((tmp_txn) => {
            no++;
            row += `
              <tr>
                  <td class="text-center border">
                    ${no}
                  </td>
                  <td class="text-center border">
                    ${tmp_txn["name"]}
                    </td>
                  <td class="text-center border">
                    ${tmp_txn["price"]}
                    </td>
                  <td class="text-center border">
                    <button class="btn-min-qty btn btn-sm btn-secondary rounded"
                    data-tmp_txn_id="${tmp_txn["tmp_txn_id"]}">
                        <i class="bi bi-dash"></i>
                    </button>
                    ${tmp_txn["quantity"]}
                    <button class="btn-add-qty btn btn-sm btn-secondary rounded"
                    data-tmp_txn_id="${tmp_txn["tmp_txn_id"]}">
                        <i class="bi bi-plus"></i>
                    </button>
                  </td>
                  <td class="text-center border">
                    ${tmp_txn["price"] * tmp_txn["quantity"]}
                  </td>
                  <td>
                      <button type="button" class="delete-item-cart btn btn-danger"
                      data-tmp_txn_id="${tmp_txn["tmp_txn_id"]}">
                        <i class="nav-icon bi bi-trash"></i>
                      </button>
                  </td>
              </tr>`;

            total_price += tmp_txn["price"] * tmp_txn["quantity"];

            $("#cartTableData").html(row);
            $("#totalPrice").text(total_price);
          });
          calculate_totalPrice();
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
  }

  // load catalog data
  loadCatalogData();

  // load cart data
  loadCartData();

  // ketika tombol tambah pada item diklik
  $(document).on("click", ".catalog-add-item", function () {
    let item_id = $(this).data("item_id");

    console.log(item_id);

    // kirim item_id ke backend
    $.ajax({
      url: "/api/transaction/add-catalog-item",
      type: "POST",
      dataType: "JSON",
      data: { item_id: item_id },
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          loadCartData();
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

  // kurangi quantity item
  $(document).on("click", ".btn-min-qty", function () {
    let tmp_txn_id = $(this).data("tmp_txn_id");

    // console.log(tmp_txn_id);

    $.ajax({
      url: "/api/transaction/min-qty",
      type: "POST",
      dataType: "json",
      data: { tmp_txn_id: tmp_txn_id },
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          loadCartData(true);
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

  // tambah quantity item
  $(document).on("click", ".btn-add-qty", function () {
    let tmp_txn_id = $(this).data("tmp_txn_id");

    // console.log(tmp_txn_id);

    $.ajax({
      url: "/api/transaction/add-qty",
      type: "POST",
      dataType: "json",
      data: { tmp_txn_id: tmp_txn_id },
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          loadCartData(true);
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

  // delete item cart
  $(document).on("click", ".delete-item-cart", function () {
    let tmp_txn_id = $(this).data("tmp_txn_id");
    // console.log(tmp_txn_id);

    $.ajax({
      url: "/api/transaction/delete-item-cart/" + tmp_txn_id,
      type: "DELETE",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          loadCartData(true);
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

  // confirmed reset delete all data
  $(document).on("click", ".btn-reset-confirmed", function () {
    $.ajax({
      url: "/api/transaction/reset-cart",
      type: "DELETE",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          loadCartData(true);
          $("#resetCartModal").modal("hide");
        } else {
          $("#resetCartModal").modal("hide");
        }
      },
      error: (xhr, error, status) => {
        console.log(xhr);
        console.log(error);
        console.log(status);
      },
    });
  });

  // submit transaction
  $(document).on("click", ".btn-complete-transaction", function () {
    let transactionData = {
      total_amount: $("#totalPrice").text(),
      cash_received: $("#cash_received").val(),
      change_returned: $("#change").text(),
    };

    $.ajax({
      url: "/api/transaction/complete-transaction",
      type: "POST",
      dataType: "json",
      data: transactionData,
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          loadCartData(true);
          $("#cash_received").val(0);
          $("#change").text(0);
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
});
