$(document).ready(function () {
  function loadCatalogData() {
    $.ajax({
      url: "/api/item/get-items",
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.success) {
          let content = "";
          let no = 0;

          response.data.forEach((item) => {
            no++;
            content += `
                    <div class="flex-grow-1 border p-3 m-3 shadow-sm" style="width: 200px;">
                            <h5 class="mb-1">${item["name"]}</h5>
                            <p class="mb-2">Rp${item["price"]}</p>
                            <div class="d-grid">
                                <button class="catalog-add-item btn btn-warning" data-item_id="${item["item_id"]}">+</button>
                            </div>
                    </div>`;
          });

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

  // load catalog data
  loadCatalogData();

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
          console.log(response.saved_data);

          // debug
          // console.log(response.item_id);
          // console.log(response.user_id);
        } else {
          console.log(response.message);
          console.log(response.error);
          // console.log(response.item_id);
          // console.log(response.user_id);
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
