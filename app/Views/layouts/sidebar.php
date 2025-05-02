<?php

$role = session()->get('role');
$menus = [
    'admin' => [
        ['title' => 'Dashboard', 'icon' => 'bi bi-bar-chart', 'url' => '/dashboard'],
        ['title' => 'User Management', 'icon' => 'bi bi-person', 'url' => '/user-management'],
        ['title' => 'Item Management', 'icon' => 'bi bi-box-seam', 'url' => '/item-management'],
        ['title' => 'Create Transaction', 'icon' => 'bi bi-receipt', 'url' => '/create-transaction'],
        ['title' => 'My Transactions', 'icon' => 'bi bi-receipt-cutoff', 'url' => '/my-transactions'],
        ['title' => 'All Transactions', 'icon' => 'bi bi-journal-text', 'url' => '/all-transactions'],
        // ['title' => 'Transaction Details', 'icon' => 'fas fa-receipt', 'url' => '#0'],
    ],
    'cashier' => [
        ['title' => 'Dashboard', 'icon' => 'bi bi-bar-chart', 'url' => '/dashboard'],
        ['title' => 'Create Transaction', 'icon' => 'bi bi-receipt', 'url' => '/create-transaction'],
        ['title' => 'My Transactions', 'icon' => 'bi bi-receipt-cutoff', 'url' => '/my-transactions'],
    ]
];

$activeMenu = $menus[$role] ?? [];

?>

<aside class="app-sidebar bg-white" data-bs-theme="light">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="/" class="brand-link">
            <!--begin::Brand Image-->
            <!-- <img
                src="../../dist/assets/img/AdminLTELogo.png"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" /> -->
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Kasi Remu</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false">

                <?php foreach ($activeMenu as $menu) { ?>
                    <!-- dashboard -->
                    <li class="nav-item">
                        <a href="<?= $menu['url'] ?>" class="nav-link">
                            <i class="nav-icon <?= $menu['icon'] ?>"></i>
                            <p><?= $menu['title'] ?></p>
                        </a>
                    </li>
                <?php } ?>

                <!-- logout -->
                <li class="nav-item">
                    <div class="nav-link">
                        <button class="btn-logout btn btn-sm btn-danger">Logout</button>
                    </div>
                </li>

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->

</aside>

<?= $this->section("script") ?>
<script src="js/auth.js"></script>
<?= $this->endSection() ?>