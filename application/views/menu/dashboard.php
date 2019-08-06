<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h2 mb-0 text-gray-800"><?= $title;  ?></h1>
        <div class="tanggal">
            <div class="text-s mb-0 font-weight-bold text-gray-400">
                <span><i class="fas fa-calendar-day text-gray-400"></i></span> <?= date('d M Y') ?>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- //Updated -->
        <div class="col-lg-12">
            <?= $this->session->flashdata('message');  ?>
        </div>
        <div class="d-none d-lg-block col-md-12 mb-4">
            <div class="card border-left-primary shadow py-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col ml-auto">
                            <div class="h5 mb-0 font-weight-normal text-gray-800">Hai <span id="user_name" class="text-gray-900 font-weight-bold text-capitalize"><?= $username ?></span>, Selamat datang di IPI - Apps</div>
                            <div class="text-s font-weight-normal text-gray-800 mt-2"></div>
                        </div>
                        <div class="col-auto mr-3">
                            <i class="far fa-smile-beam fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-primary text-white">
                    <div class="text-sm font-weight-bold text-capitalize mb-1">
                        Table Data re-scale Indeks Pembangunan Inklusif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2">
                            <div class="text-gray-800 mt-1">
                                <form action="<?= base_url('admin/') ?>" method="get">
                                    <div class="form-row filter-tahun">
                                        <div class="form-group col-md-2">
                                            <label for="dariTahun" class="text-xs">Dari Tahun</label>

                                            <select class="custom-select" name="star_date" id="start-date">

                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="sampaiTahun" class="text-xs">Sampai Tahun</label>
                                            <select class="custom-select" name="end_date" id="end-date">

                                            </select>
                                        </div>
                                        <div class="form-group col-md-2" style="padding-top: 1.9rem;">
                                            <label for=""></label>
                                            <button type="submit" class="btn btn-primary" id="Search-Button">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center tClip">
                                    <thead class="header-table-root">
                                        <tr style="background-color: #3498db; color: #FFFFFF" class="header-table">
                                        </tr>
                                        <tr style="background-color: #3498db; color: #FFFFFF" class="tahun-ipi">
                                        </tr>
                                    </thead>
                                    <tbody class="iniDataIpi">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card shadow h-100">
                <div class="card-header bg-carrot text-white">
                    <div class="text-sm font-weight-bold text-capitalize">
                        Chart Data re-scale Indeks Pembangunan Inklusif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="chart-bar chart">
                            <canvas id="ipi-chart" style="width: 100%; height: 30rem;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>