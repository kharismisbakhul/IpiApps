<style type="text/css">
    table thead tr th {
        background-color: #485460;
        color: #ecf0f1;
        border: 1px black;
    }

    table thead tr th,
    table tbody tr td {
        font-family: 'Calibri', sans-serif;
        color: black;
        font-size: 14px;
        border: 1px solid black;
    }

    table thead tr th {
        color: white;
    }

    #ipi td {
        background-color: yellow;
        text-align: center;
        color: black;
    }

    #dimensiD td {
        background-color: #3498db;
        color: white;
    }

    #sub-dimensiSD td {
        background-color: #fa8231;
        color: black;
    }

    #status1 {
        background-color: #e74c3c;
        color: white;
    }

    #status2 {
        background-color: #f9ca24;
        color: black;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800"><?= $title;  ?> Data</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xl-4 col-md-4 col-sm-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header text-white" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-uppercase mb-1">
                        Action
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">
                            <a href="<?= base_url('inputData'); ?>" class="btn btn-primary btn-icon-split tambah-user">
                                <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-plus"></i>
                                </span>
                                <span class="text">Tambah Data</span>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-3 col-lg export-excel">
                        <a href="#" class="btn btn-success btn-icon-split export-to-excel" id="test" onclick="fnExcelReport();">
                            <span class="icon text-white-50">
                                <i class="fas fa-fw fa-file-excel"></i>
                            </span>
                            <span class="text">Download Excel File</span>
                        </a>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-4">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card shadow h-100">
                <div class="card-header text-white" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-uppercase">
                        Table Data <?= $title;  ?>
                    </div>
                </div>
                <div class="card-body global">
                    <div class="text-center report">
                        <p>Kalkulasi Data Indeks Pembangunan Inklusif...</p>
                        <div id="progressTimer"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive mx-auto my-auto">
                                <div style="height: 510px">
                                    <div class="loading-progress"></div>
                                    <table class="table table-bordered table-report table-global text-nowrap" id="myTable">
                                        <thead class="text-center">
                                            <tr>
                                                <th class="align-middle" rowspan="2" colspan="3">Kode</th>
                                                <th class="align-middle" rowspan="2">Dimensi</th>
                                                <th colspan="<?= count($tahun) ?>" class="align-middle">Nilai Indikator Eksisting</th>
                                                <th rowspan="2" class="align-middle">Nilai Max</th>
                                                <th rowspan="2" class="align-middle">Nilai Min</th>
                                                <th colspan="<?= count($tahun) ?>" class="align-middle">Re-Scale Indikator (SCORE)</th>
                                            </tr>
                                            <tr>
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
                                            <tr class="ipi" id="ipi">
                                                <td colspan="4">Indeks Pembangunan Inklusif</td>
                                                <?php foreach ($tahun as $t) : ?>
                                                    <td></td>
                                                <?php endforeach; ?>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <!-- dimensi -->
                                            <?php $indek1 = 1; ?>
                                            <?php foreach ($dimensi as $d) : ?>
                                                <tr class="dimensi<?= $d['kode_d'] ?>" id="dimensiD">
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
                                                        <tr class="subdimensi<?= $sd['kode_sd'] ?>" id="sub-dimensiSD">
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
                                                                <tr class="indikator<?= $in['kode_indikator']  ?>" id="indikatorI">
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><?= $indek3++; ?></td>
                                                                    <?php $id = "";
                                                                    if ($in['status'] == 1) {
                                                                        $id = "status1";
                                                                    } elseif ($in['status'] == 2) {
                                                                        $id = "status2";
                                                                    } ?>
                                                                    <td id="<?= $id ?>"><?= $in['nama_indikator'] ?></td>
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