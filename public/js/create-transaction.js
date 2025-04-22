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
                            <p class="mb-2">Rp${item['price']}</p>
                            <div class="d-grid">
                                <button class="btn btn-warning">+</button>
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
});
