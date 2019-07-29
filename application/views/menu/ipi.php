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
        <div class="col-lg-3 box">
            <div class="card shadow border-bottom-success">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pilih Rentan Waktu</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body bClip">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            Untuk menampilkan data pada
                            tabel dan chart, harap untuk
                            mengisi rentan tahun di bawah
                        </div>
                        <form action="<?= base_url('admin/ipi') ?>" method="get">
                            <div class="row ml-1 mr-1">
                                <div class="col-lg-12 mb-2">
                                    <small>dari tahun</small>
                                    <select class="custom-select" id="inputGroupSelect01" name="star_date">
                                        <?php foreach ($tahun_selc as $t) : ?>
                                            <?php if ($t['tahun'] == $star_date) : ?>
                                                <option value="<?= $t['tahun'] ?>" selected id="star_date"><?= $t['tahun'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $t['tahun'] ?>" id="star_date"><?= $t['tahun'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <small>sampai tahun</small>
                                    <select class="custom-select" id="inputGroupSelect01" name="end_date">
                                        <?php foreach ($tahun_selc as $t) : ?>
                                            <?php if ($t['tahun'] == $end_date) : ?>
                                                <option value="<?= $t['tahun'] ?>" selected id="end_date"><?= $t['tahun'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $t['tahun'] ?>" id="end_date"><?= $t['tahun'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <button type="submit" class="btn btn-primary submit" style="width: 100%" id="submit">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Table Data Pembangunan Inklusif -->
        <div class="col-lg-8 box">
            <div class="card shadow border-bottom-success">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Table Data Pembangunan Inklusif</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body bClip">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center tClip">
                            <thead>
                                <tr style="background-color: #f8f8f8; color: #101010">
                                    <th class="py-5" rowspan="2">#</th>
                                    <th class="py-5" rowspan="2">Dimensi</th>
                                    <th colspan="6">Skor</th>
                                </tr>
                                <tr style="background-color: #f8f8f8; color: #101010" class="tahun-ipi">
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

    <?php $dimensi = $this->db->get('dimensi')->result_array(); ?>
    <div class="row mt-4 mb-4">
        <!-- Area Rentan Wakti -->
        <div class="col-lg-11 box">
            <div class="card shadow border-bottom-success">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Chart Data Indeks Pembangunan Inklusif</h6>
                </div>
                <!-- Card Body -->
                <div class="table-responsive" style="height: 700px;">
                    <div class="card-body chart">
                        <canvas id="ipi-chart" width="200" height="500"></canvas>
                    </div>
                    <div class="col-md-12 mr-2">
                        <div class="text-gray-800 mt-0">
                            <div class="legenda card no-border" style="width: auto;">
                                <div class="card-body">
                                    <?php foreach ($dimensi as $d) : ?>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <a href="#" role="button" class="btn square-legend bg-cream"></a>
                                            </div>
                                            <div class="col-xs-6">
                                                <small>
                                                    <a href="#" class="text-sm text-decoration-none text-secondary ml-4"><?= $d['nama_dimensi'] ?></a>
                                                </small>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
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