<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800"><?= $title;  ?> Data</h1>
        <button class="btn btn-primary">
            <a href="<?= base_url('data/reset'); ?>" style="text-decoration: none; color: white;">
                Reset Perhitungan data
            </a>
        </button>
        <button class="btn btn-success">
            <a href="<?= base_url('report/export'); ?>" class="export-to-excel" style="text-decoration: none; color: white;">
                Download Excel File
            </a>
        </button>
        <button class="btn btn-primary">
            <a href="<?= base_url('inputData'); ?>" class="export-to-excel" style="text-decoration: none; color: white;">
                Tambah Data
            </a>
        </button>
        <button class="btn btn-danger">
            <a href="<?= base_url('inputData/hapusData'); ?>" class="export-to-excel" style="text-decoration: none; color: white;">
                Hapus Data
            </a>
        </button>
        <div class="tanggal">
            <div class="text-s mb-0 font-weight-bold text-gray-400">
                <span><i class="fas fa-calendar-day text-gray-400"></i></span> <?= date('d M Y') ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header text-white mb-0" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-uppercase">
                        <p>Table Data dan Chart <?= $title;  ?></p>
                    </div>
                </div>
                <div class="card-body global">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive mx-auto my-auto">
                                <div style="height: 510px">
                                    <div class="loading-progress"></div>
                                    <table class="table table-bordered table-report table-global" style="border-color: black;">
                                        <thead class="text-center">
                                            <tr style="background-color: #485460; color: #ecf0f1;">
                                                <th class="align-middle" rowspan="2" colspan="3">Kode</th>
                                                <th class="align-middle" rowspan="2">Dimensi</th>
                                                <th colspan="<?= count($tahun) ?>" class="align-middle">Nilai Indikator Eksisting</th>
                                                <th rowspan="2" class="align-middle">Nilai Max</th>
                                                <th rowspan="2" class="align-middle">Nilai Min</th>
                                                <th colspan="<?= count($tahun) ?>" class="align-middle">Re-Scale Indikator (SCORE)</th>
                                            </tr>
                                            <tr style="background-color: #485460; color: #ecf0f1;">
                                                <!-- Tahun Nilai Indikator -->
                                                <?php foreach ($tahun as $t) : ?>
                                                    <th scope="col"><?= $t['tahun'] ?></th>
                                                <?php endforeach; ?>
                                                <!-- Tahun Re-Scale Indikator (SCORE) -->
                                                <?php foreach ($tahun as $rt) : ?>
                                                    <th scope="col"><?= $rt['tahun'] ?></th>
                                                <?php endforeach; ?>

                                            </tr>
                                        </thead>
                                        <tbody class="iniData" style="color: #101010">
                                            <tr class="ipi" style="background-color: #f1c40f">
                                                <td colspan="3"></td>
                                                <td>Indeks Pembangunan Inklusif</td>
                                                <?php foreach ($tahun as $t) : ?>
                                                    <td></td>
                                                <?php endforeach; ?>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <!-- dimensi -->
                                            <?php $indek1 = 1; ?>
                                            <?php foreach ($dimensi as $d) : ?>
                                                <tr class="dimensi<?= $d['kode_d'] ?>" style="background-color:#3498db; color:#ecf0f1">
                                                    <td><?= $indek1++ ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?= $d['nama_dimensi'] ?></td>
                                                    <?php foreach ($tahun as $t) : ?>
                                                        <td></td>
                                                    <?php endforeach; ?>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <!-- Subdimensi -->
                                                <?php $indek2 = 1; ?>
                                                <?php foreach ($subdimensi as $sd) : ?>
                                                    <?php if ($sd['kode_d'] == $d['kode_d']) : ?>
                                                        <tr class="subdimensi<?= $sd['kode_sd'] ?>" style="background-color:#e67e22; color:#ecf0f1">
                                                            <td></td>
                                                            <td><?= $indek2++; ?></td>
                                                            <td></td>
                                                            <td><?= $sd['nama_sub_dimensi'] ?></td>
                                                            <?php foreach ($tahun as $t) : ?>
                                                                <td></td>
                                                            <?php endforeach; ?>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <!-- Indikator -->
                                                        <?php $indek3 = 1; ?>
                                                        <?php foreach ($indikator as $in) : ?>
                                                            <?php if ($in['kode_sd'] == $sd['kode_sd']) : ?>
                                                                <tr class="indikator<?= $in['kode_indikator']  ?>">
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><?= $indek3++; ?></td>

                                                                    <?php if ($in['status'] == 1) : ?>
                                                                        <td style="background-color: red;color: #ecf0f1"><?= $in['nama_indikator'] ?></td>
                                                                    <?php elseif ($in['status'] == 2) : ?>
                                                                        <td style="background-color: #f1c40f;color: #ecf0f1"><?= $in['nama_indikator'] ?></td>
                                                                    <?php else : ?>
                                                                        <td><?= $in['nama_indikator'] ?></td>
                                                                    <?php endif; ?>
                                                                    <!-- Nilai Indikator -->
                                                                    <?php foreach ($tahun as $t) : ?>
                                                                        <?php foreach ($nilai_indikator as $nilai) : ?>
                                                                            <?php if ($nilai['tahun'] == $t['tahun'] && $nilai['kode_indikator'] == $in['kode_indikator']) : ?>
                                                                                <td><?= round($nilai['nilai'], 2) ?></td>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endforeach; ?>
                                                                    <!-- akhir Nilai Indikator -->
                                                                    <td><?= round($in['max_nilai'], 2) ?></td>
                                                                    <td><?= round($in['min_nilai'], 2) ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <!-- Akhir Indikator -->
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <!-- akhir Subdimensi -->
                                            <?php endforeach; ?>
                                            <!-- akhir dimensi -->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->