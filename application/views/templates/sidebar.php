<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-ipiapps sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-fw fa-chart-line"></i>
        </div>
        <div class="sidebar-brand-text mx-3">IPI APPS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php if ($title == "Dashboard") : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link mt-0 pt-0" href="<?= base_url('admin'); ?> ">
            <i class="fas fa-fw fa-university"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">

    <!-- Menu Heading -->
    <div class="sidebar-heading">
        Administrator
    </div>

    <!-- Menu -->

    <!-- Input Data -->
    <?php if ($title == "Input Data") : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link pb-0" href="<?= base_url('admin/inputData'); ?>">
            <i class="fas fa-fw fa-sign-in-alt"></i>
            <span>Input Data</span>
        </a>
    </li>

    <!-- Global/IPI -->
    <?php if ($title == "Indeks Pembangunan Inklusif") : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link pb-0" href="<?= base_url('admin/ipi'); ?>">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Indeks Pembangunan<br><span class="ml-4"> Inklusif</span></span>
        </a>
    </li>

    <?php $subDimensi = $this->db->get('subDimensi')->result_array(); ?>
    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Aktivitas Ekonomi -->
    <?php if ($title == "Aktivitas Ekonomi") : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link collapsed pb-0" href="<?= base_url('admin/aktivitasEkonomi'); ?>" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Aktivitas Ekonomi</span>
        </a>
        <!-- Menu Dropdown -->
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="collapse-inner rounded mb-0" style="color:white">
                <a class="collapse-item subDimensi text-white" href="<?= base_url('admin/aktivitasEkonomi'); ?>">IPE</a>
                <?php foreach ($subDimensi as $sd) :
                    if ($sd['kode_d'] == 1) { ?>
                        <a class="collapse-item text-white" href="<?= base_url($sd['link']) ?>"> <?= $sd['nama_sub_dimensi']; ?></a>
                    <?php };
                endforeach; ?>
            </div>
        </div>
    </li>

    <!-- Inklusifitas -->
    <?php if ($title == "Inklusifitas") : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link collapsed pb-0" href="<?= base_url('admin/inklusifitas'); ?>" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Inklusifitas</span>
        </a>
        <!-- Menu Dropdown -->
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="collapse-inner rounded mb-0" style="color:white">
                <a class="collapse-item text-white" href="<?= base_url('admin/inklusifitas') ?>">II</a>
                <?php foreach ($subDimensi as $sd) :
                    if ($sd['kode_d'] == 2) { ?>
                        <a class="collapse-item text-white" href="<?= base_url($sd['link']) ?>"> <?= $sd['nama_sub_dimensi']; ?></a>
                    <?php };
                endforeach; ?>
            </div>
        </div>
    </li>

    <!-- Sustainability -->
    <?php if ($title == "Sustainability") : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link collapsed pb-0" href="<?= base_url('admin/sustainability'); ?>" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Sustainability</span>
        </a>
        <!-- Menu Dropdown -->
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="collapse-inner rounded mb-0" style="color:white">
                <a class="collapse-item text-white" href="<?= base_url('admin/sustainability'); ?>">IK</a>
                <?php foreach ($subDimensi as $sd) :
                    if ($sd['kode_d'] == 3) { ?>
                        <a class="collapse-item text-white" href="<?= base_url($sd['link']) ?>"> <?= $sd['nama_sub_dimensi']; ?></a>
                    <?php };
                endforeach; ?>
            </div>
        </div>
    </li>

    <!-- Report -->
    <?php if ($title == "Report") : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link pb-0" href="<?= base_url('admin/report'); ?>">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Report</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mt-3 mb-0">

    <li class="nav-item">
        <a class="nav-link logout" href="#">
            <i class="fas fa-fw fa-power-off"></i>
            <span>logout</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->