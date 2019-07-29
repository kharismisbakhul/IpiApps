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
        <div class="col-xl-8 col-md-12 col-sm-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-red">
                    <div class="text-sm font-weight-bold text-uppercase mb-1 text-white">
                        Pilih Tahun untuk data <?= $title;  ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2">
                            <div class="text-gray-800 mt-1">
                                Untuk menampilkan data pada
                                tabel dan chart, harap untuk
                                mengisi <br> rentan tahun di bawah
                                <form action="<?= base_url('admin/dimensi'); ?>" method="get">
                                    <div class="row ml-1 mr-1">
                                        <div class="col-lg-12 mb-2">
                                            <small>dari tahun</small>
                                            <select class="custom-select" id="inputGroupSelect01" name="star_date">
                                                <option value="<?= $min_tahun['tahun'] ?>" selected id="star_date">pilih tahun...</option>
                                                <?php foreach ($tahun_selc as $t) : ?>
                                                    <option value="<?= $t['tahun'] ?>" id="star_date"><?= $t['tahun'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <small>sampai tahun</small>
                                            <select class="custom-select" id="inputGroupSelect01" name="end_date">
                                                <option value="<?= $max_tahun['tahun'] ?>" selected id="end_date">pilih tahun...</option>
                                                <?php foreach ($tahun_selc as $t) : ?>
                                                    <option value="<?= $t['tahun'] ?>" id="end_date"><?= $t['tahun'] ?></option>

                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <input type="hidden" name="d" value="<?= $this->input->get('d');  ?>">
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
    </div>

    <div class="row mt-4 mb-4">
        <!-- Area Rentan Waktu -->
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-red text-white">
                    <div class="text-sm font-weight-bold text-uppercase mb-1">
                        Table Data dan Chart <?= $title;  ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center tClip">
                                    <thead>
                                        <tr style="background-color: #f8f8f8; color: #101010">
                                            <th class="py-5" rowspan="2">#</th>
                                            <th class="py-5" rowspan="2">Dimensi</th>
                                            <th colspan="6">Skor</th>
                                        </tr>
                                        <tr style="background-color: #f8f8f8; color: #101010" class="tahun">
                                        </tr>
                                    </thead>
                                    <tbody class="iniData">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row no-gutters align-items-center">
                        <div class="col-lg-12">
                            <div class="chart">
                                <canvas id="chart-dimensi" width="200" height="500"></canvas>
                            </div>
                            <div class="col-md-12 mr-2">
                                <div class="text-gray-800 mt-0">
                                    <div class="legenda card no-border" style="width: auto;">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row ml-1 mt-0">
                                                    <div class="col-md-6">
                                                        <div class="label-1">
                                                            <a href="#" role="button" class="btn square-legend bg-cream"></a>
                                                            <a href="#" class="text-sm text-decoration-none text-secondary ml-4">Indeks Inflasi</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="label-1">
                                                            <a href="#" role="button" class="btn square-legend bg-yellow"></a>
                                                            <a href="#" class="text-sm text-decoration-none text-secondary ml-4">Indeks Aktivitas Ekonomi</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <div class="label-1">
                                                            <a href="#" role="button" class="btn square-legend bg-orange"></a>
                                                            <a href="#" class="text-sm text-decoration-none text-secondary ml-4">Indeks Pengembangan Sumberdaya Manusia</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <div class="label-1">
                                                            <div class="row">
                                                                <div class="col-2">
                                                                    <hr class="ml-1 line-legend bg-brown">
                                                                </div>
                                                                <div class="col-8">
                                                                    <a href="#" class="text-sm text-decoration-none text-secondary">Indeks Pertumbuhan Ekonomi</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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