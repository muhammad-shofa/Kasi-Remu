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
            <!-- <button type="button" class="add-action btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal">Add User</button> -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">My Transactions</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Transaction Code</th>
                                <th>Date & Time</th>
                                <th>Total Items</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th style="width: 60px">Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTransactionsTableData">
                            <tr>
                                <td colspan="7" class="text-center border">
                                    <p class="fw-bold no-data-yet">No transactions yet</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!--end::Container-->
    </div>
</main>
<?= $this->endSection() ?>

<?= $this->section("script") ?>
<script src="js/my-transactions.js"></script>
<?= $this->endSection() ?>