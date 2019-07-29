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
        <div class="col-lg-6">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>

    <div class="row">
        <!-- Area Rentan Wakti -->
        <div class="col-lg-4 box">
            <div class="card shadow">
                <!-- Card Header - Dropdown -->
                <div class="card-header text-uppercase bg-midnight-blue text-white  py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Pilih Rentan Waktu</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body bClip">
                    <div class="row">
                        <div class="col-lg-12 mb-2 text-justify">
                            Untuk menampilkan data pada
                            tabel dan chart, harap untuk
                            mengisi rentan tahun di bawah
                        </div>
                        <div class="col-lg-12 mb-2">
                            <small>dari tahun</small>
                            <select class="custom-select start-date" id="start-date" name="start-date">
                                <option>Pilih Tahun</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <small>sampai tahun</small>
                            <select class="custom-select end-date" id="end-date" name="end-date">
                                <option>Pilih Tahun</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <button type="button" id="submit-search" class="btn btn-primary submit-search" style="width: 100%">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Data Pembangunan Inklusif -->
        <div class="col-lg-8 box">
            <div class="card shadow">
                <!-- Card Header - Dropdown -->
                <div class="card-header bg-midnight-blue text-white text-uppercase py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Table Data <?= $title ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body bClip">
                    <table class="table table-bordered text-center tClip">
                        <thead>
                            <tr style="background-color: #f8f8f8; color: #101010">
                                <th class="py-5" rowspan="2">#</th>
                                <th class="py-5" rowspan="2">Dimensi</th>
                                <th id="span-table" class="span-table" colspan="<?= $col_span ?>">Skor</th>
                            </tr>
                            <tr style="background-color: #f8f8f8; color: #101010" id="range-tahun" class="range-tahun">
                                <?php foreach ($range_tahun as $rt) : ?>
                                    <th scope="col"><?= $rt ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody id="ipi-table">
                            <tr id="ipi-value" class="ipi-value">
                                <td colspan="2"><?= $title ?></td>
                                <?php foreach ($ipi['nilai_rescale'] as $inr) : ?>
                                    <td><?= $inr ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <?php $a = 1;
                            foreach ($dimensi as $d) : ?>
                                <tr>
                                    <td><?= $a; ?></td>
                                    <td><?= $d['nama_dimensi'] ?></td>
                                    <?php foreach ($d['nilai_dimensi'] as $nd) : ?>
                                        <td><?= $nd ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php $a++;
                            endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <!-- Area Rentan Wakti -->
        <div class="col-lg-12 box">
            <div class="card shadow">
                <!-- Card Header - Dropdown -->
                <div class="card-header bg-midnight-blue text-white text-uppercase py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Chart Data Indeks Pembangunan Inklusif</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body bClip">
                    <div class="chart-bar chart-bar-ipi">
                        <canvas id="ipi_chart" width="400" height="400"></canvas>
                    </div>
                </div>

                <!-- Legenda -->

                <div class="col-md-12 mr-2">
                    <div class="text-gray-800 mt-0">
                        <div class="legenda card no-border" style="width: auto;">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row ml-1 mt-0">
                                        <div class="col-md-6">
                                            <div class="label-1">
                                                <a href="<?= base_url('admin/pertumbuhanEkonomi'); ?>" role="button" class="btn square-legend bg-cream"></a>
                                                <a href="<?= base_url('admin/pertumbuhanEkonomi'); ?>" class="text-sm text-decoration-none text-secondary ml-4"><?= $dimensi[0]['nama_dimensi'] ?></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="label-1">
                                                <a href="<?= base_url('admin/inklusifitas'); ?>" role="button" class="btn square-legend bg-yellow"></a>
                                                <a href="<?= base_url('admin/inklusifitas'); ?>" class="text-sm text-decoration-none text-secondary ml-4"><?= $dimensi[1]['nama_dimensi'] ?></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="label-1">
                                                <a href="<?= base_url('admin/sustainability'); ?>" role="button" class="btn square-legend bg-orange"></a>
                                                <a href="<?= base_url('admin/sustainability'); ?>" class="text-sm text-decoration-none text-secondary ml-4"><?= $dimensi[2]['nama_dimensi'] ?></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="label-1">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <hr class="ml-1 line-legend bg-brown">
                                                    </div>
                                                    <div class="col-8">
                                                        <a href="#" class="text-sm text-decoration-none text-secondary"><?= $title ?></a>
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
                <!-- End Legenda -->


            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->