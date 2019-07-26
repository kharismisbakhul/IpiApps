<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row ml-2">
        <div class="col-sm-0">
            <i class="fas fa-fw fa-chart-bar fo"></i>
        </div>
        <div class="col-sm-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title2;  ?></h1>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>

    <div class="row">
        <!-- Area Rentan Waktu -->
        <div class="col-xl-8 col-md-12 col-sm-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-green">
                    <div class="text-sm font-weight-bold text-uppercase mb-1 text-white">
                        Pilih Tahun untuk data <?= $title2;  ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2">
                            <div class="text-gray-800 mt-1">
                                Untuk menampilkan data pada
                                tabel dan chart, harap untuk
                                mengisi <br> rentan tahun di bawah
                                <form action="<?= base_url('admin/inklusifitas/ip'); ?>" method="get" class="mt-3">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="start-date" class="text-xs">Dari Tahun</label>
                                            <select class="form-control start-date" id="start-date" name="start-date">
                                                <option>Pilih tahun</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="end-date" class="text-xs">Sampai Tahun</label>
                                            <select class="form-control end-date" id="end-date" name="end-date">
                                                <option>Pilih tahun</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 mt-3">
                                            <button type="submit" class="btn btn-primary" style="width: 100%;">Cari</button>
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
                <div class="card-header bg-green text-white">
                    <div class="text-sm font-weight-bold text-uppercase mb-1">
                        Table Data dan Chart <?= $title2;  ?>
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
                                            <th colspan="<?= $col_span ?>">Skor</th>
                                        </tr>
                                        <tr style="background-color: #f8f8f8; color: #101010">
                                            <?php foreach ($range_tahun as $rt) : ?>
                                                <th scope="col"><?= $rt ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2"><?= $title2; ?></td>
                                            <?php foreach ($subDimensi['nilai_rescale'] as $nsd) : ?>
                                                <td><?= $nsd ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php $a = 1;
                                        foreach ($indikator as $in) : ?>
                                            <tr>
                                                <td><?= $a; ?></td>
                                                <td><?= $in['nama_indikator'] ?></td>
                                                <?php foreach ($in['nilai_indikator'] as $inni) : ?>
                                                    <td><?= $inni ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <?php $a++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row no-gutters align-items-center">
                        <div class="chart-bar">
                            <canvas id="pertumbuhan-ek" width="850" height="500"></canvas>
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
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->