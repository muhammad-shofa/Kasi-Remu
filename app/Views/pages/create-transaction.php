<?= $this->extend("layouts/template") ?>

<?= $this->section("content") ?>
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?= $title ?></h3>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <!-- catalog item -->
                <div class="col-md-6 mb-3">
                    <div class="catalog border p-3 shadow-sm" style="min-height: 400px;">
                        <h4>Catalog</h4>
                        <input type="text" class="form-control" id="searchCatalog" placeholder="Search Catalog">
                        <div class="catalog-item" id="catalogItem">
                            <!-- catalog item will be inserted here -->
                        </div>
                        <div class="d-flex flex-wrap justify-content-around" id="catalog-item">
                            <p class="pt-5 mt-5"><b>No item yet</b></p>
                        </div>
                    </div>
                </div>
                <!-- cart item -->
                <div class="col-md-6 mb-3">
                    <div class="cart border p-3 shadow-sm" style="min-height: 400px;">
                        <h4>Cart</h4>

                        <table class="table border">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Name</th>
                                    <th>Prc</th>
                                    <th>Qty</th>
                                    <th>Sub Total</th>
                                    <th style="width: 30px">Action</th>
                                </tr>
                            </thead>
                            <tbody id="cartTableData">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Total : </td>
                                    <td id="totalPrice" class="fw-bold">0</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Cash Received : </td>
                                    <td id="cashReceived" class="fw-bold" style="width: 200px">
                                        <input type="number" name="cash_received" id="cash_received" class="form-control" placeholder="Cash Received">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Change : </td>
                                    <td id="change" class="fw-bold">0</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="d-flex justify-content-between">
                            <button class="btn-reset-tmp-txn btn btn-danger rounded" data-bs-toggle="modal" data-bs-target="#resetCartModal">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn-complete-transaction btn btn-success rounded">
                                Complete Transaction
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->


        <!-- delete all tmp txn modal / reset cart-->
        <!-- masukkan modal body -->
        <?php ob_start() ?>
        <p>Are you sure you want to delete all item on this cart?</p>
        <?php $modalBodyDelete = ob_get_clean() ?>

        <!-- masukkan modal footer -->
        <?php ob_start() ?>
        <button type="button" class="btn-reset-confirmed btn btn-danger">Yes</button>
        <?php $modalFooterDelete = ob_get_clean() ?>

        <!-- kirim ke layouts/modal -->
        <?= view("layouts/modal", [
            'modalId' => 'resetCartModal',
            'modalTitle' => 'Delete Cart Item',
            'modalBody' => $modalBodyDelete,
            'modalFooter' => $modalFooterDelete
        ]) ?>


    </div>
</main>

<?= $this->endSection() ?>

<?= $this->section("script") ?>
<script src="js/create-transaction.js"></script>
<?= $this->endSection() ?>