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

  // load cart data
  function loadCartData(isReset) {
    isReset ? $("#cartTableData").empty() : "";

    $.ajax({
      url: "/api/transaction/get-tmp-transaction",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          console.log(response.data);

          let no = 0;
          let row = "";

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
                    ${tmp_txn["quantity"]}
                  </td>
                  <td class="text-center border">
                    ${tmp_txn["price"] * tmp_txn["quantity"]}
                  </td>
              </tr>`;

            $("#cartTableData").html(row);
          });
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

  // ketika tomobl tambah pada item diklik
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

  // confirmed reset delete all data
  $(document).on("click", ".btn-reset-confirmed", function () {
    $.ajax({
      url: "/api/transaction/reset-cart",
      type: "DELETE",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          console.log(response.message);
          loadCartData(true);
          $("#resetCartModal").modal("hide");
        } else {
          console.log(response.message);
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
});
