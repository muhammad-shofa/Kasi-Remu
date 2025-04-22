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
                        <p>Hello</p>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
</main>

<?= $this->endSection() ?>

<?= $this->section("script") ?>
<script src="js/create-transaction.js"></script>
<!-- <script src="js/category-management.js"></script> -->
<?= $this->endSection() ?>