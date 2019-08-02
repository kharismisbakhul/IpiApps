<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row ml-2">
        <div class="col-sm-0">
            <i class="fas fa-fw fa-chart-bar fo"></i>
        </div>
        <div class="col-sm-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?></h1>
        </div>
    </div>

    <div class="row">
        <!-- Area Rentan Waktu -->
        <div class="col-xl-6 col-md-12 col-sm-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header <?= $background ?>">
                    <div class="text-sm font-weight-bold text-uppercase mb-1 text-white">
                        Pilih Tahun untuk data <?= $title;  ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12">
                            <form action="<?= base_url('admin/subdimensi'); ?>" method="get">
                                <div class="row ml-1 mr-1">
                                    <div class="col-lg-12 mb-2 text-gray-800 mt-1">
                                        Untuk menampilkan data pada
                                        tabel dan chart, harap untuk
                                        mengisi <br> rentan tahun di bawah
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <small>dari tahun</small>
                                        <select class="custom-select" id="start-date" name="star_date">

                                        </select>
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <small>sampai tahun</small>
                                        <select class="custom-select" id="end-date" name="end_date">

                                        </select>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <input type="hidden" name="sd" value="<?= $this->input->get('sd');  ?>">
                                        <button type="submit" class="btn btn-primary submit" style="width: 100%" id="submit">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <!-- Area Rentan Waktu -->
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header <?= $background ?> text-white">
                    <div class="text-sm font-weight-bold text-uppercase mb-1">
                        Table Data dan Chart <?= $title;  ?>
                    </div>
                </div>
                <div class="card-body mb-2">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center tClip table-sm flex-wrap">
                                    <thead class="header-table-root">
                                        <tr style="background-color: #0097e6; color: #ffffff" class="header-table">
                                        </tr>
                                        <tr style="background-color: #0097e6; color: #ffffff" class="tahun-sub">
                                        </tr>
                                    </thead>
                                    <tbody class="iniData-subdimensi">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center" style="height: 500px;">
                        <div class="col-lg-12">
                            <div class="card-body chart mb-2">
                                <canvas id="chart-subdimensi" style="width: 1100px; height: 500px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->