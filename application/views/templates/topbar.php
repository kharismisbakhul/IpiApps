<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link" href="<?= base_url('admin'); ?>" id="user" role="button">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $username; ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/login_page.svg') ?>">
                    </a>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->