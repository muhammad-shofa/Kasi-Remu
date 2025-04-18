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
            <button type="button" class="add-action btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal">Add User</button>
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">User Table</h3>
                    <!-- <div class="card-tools">
                        <ul class="pagination pagination-sm float-end">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Role</th>
                                <th style="width: 60px">Action</th>
                            </tr>
                        </thead>
                        <tbody id="userTableData">
                            <tr>
                                <td colspan="7" class="text-center border">
                                    <p class="fw-bold no-data-yet">No users yet</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

            <!-- tambah user modal -->
            <!-- masukkan modal body -->
            <?php ob_start() ?>
            <form id="addUserForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" />
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" />
                </div>
                <div class="md-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender">
                        <option selected value="M">M</option>
                        <option value="W">W</option>
                    </select>
                </div>
                <div class="md-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role">
                        <option selected value="admin">Admin</option>
                        <option value="cashier">Cashier</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>
            </form>
            <?php $modalBodyAdd = ob_get_clean() ?>

            <!-- masukkan modal footer -->
            <?php ob_start() ?>
            <button type="button" class="save-add btn btn-primary">Save User</button>
            <?php $modalFooterAdd = ob_get_clean() ?>

            <!-- kirim ke layouts/modal -->
            <?= view("layouts/modal", [
                'modalId' => 'addModal',
                'modalTitle' => 'Add User',
                'modalBody' => $modalBodyAdd,
                'modalFooter' => $modalFooterAdd
            ]) ?>


            <!-- edit modal -->
            <!-- masukkan modal body -->
            <?php ob_start() ?>
            <form>
                <input type="hidden" id="editUserId">
                <div class="mb-3">
                    <label for="editName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="editName" />
                </div>
                <div class="mb-3">
                    <label for="editUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="editUsername" />
                </div>
                <div class="mb-3">
                    <label for="editEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="editEmail" />
                </div>
                <div class="md-3">
                    <label for="editGender" class="form-label">Gender</label>
                    <select class="form-select" id="editGender">
                        <option selected value="M">M</option>
                        <option value="W">W</option>
                    </select>
                </div>
                <div class="md-3">
                    <label for="editRole" class="form-label">Role</label>
                    <select class="form-select" id="editRole">
                        <option selected value="admin">Admin</option>
                        <option value="cashier">Cashier</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>
            </form>
            <?php $modalBodyEdit = ob_get_clean() ?>

            <!-- masukkan modal footer -->
            <?php ob_start() ?>
            <button type="button" class="save-edit btn btn-warning">Save Changes</button>
            <?php $modalFooterEdit = ob_get_clean() ?>

            <!-- kirim ke layouts/modal -->
            <?= view("layouts/modal", [
                'modalId' => 'editModal',
                'modalTitle' => 'Edit User',
                'modalBody' => $modalBodyEdit,
                'modalFooter' => $modalFooterEdit
            ]) ?>

            <!-- delete modal -->
            <!-- masukkan modal body -->
            <?php ob_start() ?>
            <input type="hidden" id="deleteUserId">
            <p>Are you sure you want to delete this user?</p>
            <?php $modalBodyDelete = ob_get_clean() ?>

            <!-- masukkan modal footer -->
            <?php ob_start() ?>
            <button type="button" class="confirmed-deletion btn btn-danger">Yes</button>
            <?php $modalFooterDelete = ob_get_clean() ?>

            <!-- kirim ke layouts/modal -->
            <?= view("layouts/modal", [
                'modalId' => 'deleteModal',
                'modalTitle' => 'Delete User',
                'modalBody' => $modalBodyDelete,
                'modalFooter' => $modalFooterDelete
            ]) ?>

        </div>
        <!--end::Container-->
    </div>
</main>

<?= $this->endSection() ?>

<?= $this->section("script") ?>
<script src="js/user-management.js"></script>
<?= $this->endSection() ?>