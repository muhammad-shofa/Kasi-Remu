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
                        <div class="d-flex flex-wrap justify-content-around" id="catalog-item">
                            <p class="pt-5 mt-5"><b>No item yet</b></p>
                        </div>
                    </div>
                </div>
                <!-- cart item -->
                <div class="col-md-6 mb-3">
                    <div class="cart border p-3 shadow-sm" style="min-height: 400px;">
                        <h4>Cart</h4>

                        <!-- <div class="d-flex flex-wrap justify-content-around" id="cart-item"> -->
                        <table class="table border">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Name</th>
                                    <th>Prc</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="cartTableData">
                            </tbody>
                        </table>

                        <button class="btn-reset-tmp-txn btn btn-danger rounded" data-bs-toggle="modal" data-bs-target="#resetCartModal">
                            <i class="nav-icon bi bi-trash"></i>
                        </button>
                        <!-- </div> -->
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