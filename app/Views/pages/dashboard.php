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
                    <h3 class="mb-0">Dashboard</h3>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="/user-management" class="text-decoration-none">
                        <div class="info-box">
                            <span class="info-box-icon text-bg-primary shadow-sm">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">User</span>
                                <span class="info-box-number" id="userCountData">
                                    0
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="/item-management" class="text-decoration-none">
                        <div class="info-box">
                            <span class="info-box-icon text-bg-danger shadow-sm">
                                <i class="bi bi-box-seam-fill"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Item</span>
                                <span class="info-box-number" id="itemCountData">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                <!-- fix for small devices only -->
                <!-- <div class="clearfix hidden-md-up"></div> -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="#0" class="text-decoration-none">
                        <div class="info-box">
                            <span class="info-box-icon text-bg-success shadow-sm">
                                <i class="bi bi-receipt-cutoff"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">My Transactions</span>
                                <span class="info-box-number" id="myTransactionCountData">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-warning shadow-sm">
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">All Transactions</span>
                            <span class="info-box-number" id="allTransactionCountData">0</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
        <!--end::Container-->
    </div>
</main>
<?= $this->endSection() ?>

<?= $this->section("script") ?>
<script src="js/dashboard.js"></script>
<?= $this->endSection() ?>