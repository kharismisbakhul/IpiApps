    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-3">
                    <h1 class="h3 mb-0 text-gray-800">Manajemen User</h1>
                    <div class="tanggal">
                        <div class="text-s mb-0 font-weight-bold text-gray-400">
                            <span><i class="fas fa-calendar-day text-gray-400"></i></span> <?= date('d M Y') ?>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <!-- Content Row -->
                        <div class="row">
                            <div class="col-lg-12 col-md-6 mb-4">
                                <!-- Approach -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 bg-blue">
                                        <h6 class="m-0 font-weight-bold text-capitalize text-white">Daftar User</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="col-lg-12 text-right mb-2">
                                                <button type="button" class="btn btn-success">
                                                    <a href="<?= base_url('admin/tambahUser'); ?>" style="text-decoration: none; color: white;"><i class="fas fa-fw fa-plus"></i> Tambah User</a></button>
                                            </div>
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead style="text-align: center">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Username</th>
                                                        <th>Status User</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($list_user as $lu) : ?>
                                                        <tr>
                                                            <td class="text-center"><?= $i; ?></td>
                                                            <td><?= $lu['username']; ?></td>
                                                            <td><?= $lu['menu']; ?></td>
                                                            <td class="text-center">
                                                                <button type="button" class="badge badge-pill badge-danger userdelete">
                                                                    <a href="<?= base_url('admin/deleteUser/') . $lu['id']; ?>" style="text-decoration: none; color: white;">
                                                                        <span class="icon text-white-50">
                                                                            <i class="fas fa-fw fa-trash-alt"></i>
                                                                        </span>
                                                                        <span class="text">Delete</span>
                                                                    </a>
                                                                </button>
                                                                <button type="button" class="badge badge-pill badge-primary">
                                                                    <a href="<?= base_url('admin/editUser/') . $lu['id']; ?>" style="text-decoration: none; color: white;">
                                                                        <span class=" icon text-white-50">
                                                                            <i class="fas fa-fw fa-pencil-alt"></i>
                                                                        </span>
                                                                        <span class="text">Edit</span>
                                                                    </a>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Table -->

                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Alert Delete User -->
        <!-- End Alert Delete User -->