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
    <?php $dimensi = $this->db->get('dimensi')->result_array(); ?>
    <!-- Nav Item - Pages Collapse Menu -->


    <!-- Aktivitas Ekonomi -->
    <?php foreach ($dimensi as $d) : ?>
        <?php if ($title == $d['nama_dimensi']) : ?>
            <li class="nav-item active">
            <?php else : ?>
            <li class="nav-item">
            <?php endif; ?>
            <a class="nav-link collapsed pb-0" href="#" data-toggle="collapse" data-target="#coleps<?= $d['kode_d'] ?>" aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-fw fa-chart-bar"></i>
                <?php $n_dimensi = explode(" ", $d['nama_dimensi']); ?>
                <span>
                    <?php for ($i = 0; $i < count($n_dimensi); $i++) : ?>
                        <?php if ($i != 2) : ?>
                            <?= $n_dimensi[$i] . ' ' ?>
                        <?php else : ?>
                            <br><span class="ml-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $n_dimensi[$i] ?> </span>
                        <?php endif; ?>
                    <?php endfor; ?>
                </span>
            </a>
            <!-- Menu Dropdown -->
            <div id="coleps<?= $d['kode_d'] ?>" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('admin/dimensi?d=') . $d['kode_d'] ?>">
                        <span>
                            <?php for ($i = 0; $i < count($n_dimensi); $i++) : ?>
                                <?php if ($i != 2) : ?>
                                    <?= $n_dimensi[$i] . ' ' ?>
                                <?php else : ?>
                                    <br><span class="ml-0"><?= $n_dimensi[$i] ?> </span>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </span>
                    </a>

                    <?php foreach ($subDimensi as $sd) :
                        if ($sd['kode_d'] == 1) {
                            $str = $sd['nama_sub_dimensi'];
                            $result = explode(" ", $str);
                            if (count($result) < 3) {
                                ?>
                                <a class="collapse-item" href="<?= base_url('admin/subdimensi?sd=') . $sd['kode_sd'] ?>"> <?= $str ?></a>
                            <?php } else {
                                ?>
                                <a class="collapse-item" href="<?= base_url('admin/subdimensi?sd=') . $sd['kode_sd'] ?>"><span><?= $result[0] . " " . $result[1] . " " ?><br><span class="ml-0"><?= $result[2] ?></span></span></a>
                            <?php }
                        };
                    endforeach; ?>
                </div>
            </div>
        </li>
    <?php endforeach; ?>

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