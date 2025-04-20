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
            <button type="button" class="add-action btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal">Add Item</button>
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Item Table</h3>
                <div id="category-demo"></div>

                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th style="width: 60px">Action</th>
                            </tr>
                        </thead>
                        <tbody id="itemTableData">
                            <tr>
                                <td colspan="5" class="text-center border">
                                    <p class="fw-bold">No items yet</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

            <!-- tambah item modal -->
            <!-- masukkan modal body -->
            <?php ob_start() ?>
            <form id="addItemForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" />
                </div>
                <label for="category">Category</label>
                <input type="text" id="search-category" class="form-control mb-2" placeholder="Search category...">
                <select name="category" id="category" class="form-control">
                    
                </select>
                <small>
                    <a href="#0" class="text-dark" data-bs-toggle="modal" data-bs-target="#modalAddCategory">
                        + Add new category
                    </a>
                </small>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" />
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" />
                </div>
            </form>
            <?php $modalBodyAdd = ob_get_clean() ?>

            <!-- masukkan modal footer -->
            <?php ob_start() ?>
            <button type="button" class="save-add btn btn-primary">Save Item</button>
            <?php $modalFooterAdd = ob_get_clean() ?>

            <!-- kirim ke layouts/modal -->
            <?= view("layouts/modal", [
                'modalId' => 'addModal',
                'modalTitle' => 'Add Item',
                'modalBody' => $modalBodyAdd,
                'modalFooter' => $modalFooterAdd
            ]) ?>

            <!-- delete modal -->
            <!-- masukkan modal body -->
            <?php ob_start() ?>
            <input type="hidden" id="deleteItemId">
            <p>Are you sure you want to delete this item?</p>
            <?php $modalBodyDelete = ob_get_clean() ?>

            <!-- masukkan modal footer -->
            <?php ob_start() ?>
            <button type="button" class="confirmed-deletion btn btn-danger">Yes</button>
            <?php $modalFooterDelete = ob_get_clean() ?>

            <!-- kirim ke layouts/modal -->
            <?= view("layouts/modal", [
                'modalId' => 'deleteModal',
                'modalTitle' => 'Delete Item',
                'modalBody' => $modalBodyDelete,
                'modalFooter' => $modalFooterDelete
            ]) ?>

        </div>
        <!--end::Container-->
    </div>
</main>

<?= $this->endSection() ?>

<?= $this->section("script") ?>
<script src="js/item-management.js"></script>
<script src="js/category-management.js"></script>
<?= $this->endSection() ?>