<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800"><?= $title;  ?> Data</h1>
        
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
        <div class="col-xl-4 col-md-4 col-sm-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-header text-white" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-uppercase mb-1">
                        Action Card
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-icon-split">
                                <a href="<?= base_url('data/reset'); ?>" style="text-decoration: none; color: white;">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-fw fa-sync-alt"></i>
                                    </span>
                                    <span class="text">Reset Perhitungan Data</span>
                                </a>
                            </button>
                        </div>

                        <div class="col-md-12 mt-2">    
                            <button class="btn btn-success btn-icon-split">
                                <a href="<?= base_url('report/export'); ?>" class="export-to-excel" style="text-decoration: none; color: white;">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-fw fa-file-excel"></i>
                                    </span>
                                    <span class="text">Download Excel File</span>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-5 col-sm-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-header text-white" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-uppercase mb-1">
                        Action Card
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?= base_url('inputData'); ?>"  class="btn btn-primary btn-icon-split tambah-user mr-3">
                                <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-plus"></i>
                                </span>
                                <span class="text">Tambah Data</span>
                            </a>
                        </div>
                        <div class="col-md-12 mt-2">
                            <button class="btn btn-danger btn-icon-split">
                                <a href="<?= base_url('inputData/hapusData'); ?>" class="export-to-excel" style="text-decoration: none; color: white;">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </span>
                                    <span class="text">Hapus Data</span>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header text-white" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-uppercase mb-1">
                        Table Data dan Chart <?= $title;  ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive mx-auto my-auto">
                                <div style="height: 50rem;">
                                    <table class="table table-bordered table-report" style="border-color: black;">
                                        <thead class="text-center">
                                            <tr style="background-color: #485460; color: #ecf0f1;">
                                                <th class="align-middle" rowspan="2" colspan="3">Kode</th>
                                                <th class="align-middle" rowspan="2">Dimensi</th>
                                                <th colspan="<?= $col_span ?>" class="align-middle">Nilai Indikator Eksisting</th>
                                                <th rowspan="2" class="align-middle">Nilai Max</th>
                                                <th rowspan="2" class="align-middle">Nilai Min</th>
                                                <th colspan="<?= $col_span ?>" class="align-middle">Re-Scale Indikator (SCORE)</th>
                                            </tr>
                                            <tr style="background-color: #485460; color: #ecf0f1;">

                                                <!-- Tahun Nilai Indikator -->
                                                <?php foreach ($range_tahun as $rt) : ?>
                                                    <th scope="col"><?= $rt ?></th>
                                                <?php endforeach; ?>

                                                <!-- Tahun Re-Scale Indikator (SCORE) -->
                                                <?php foreach ($range_tahun as $rt) : ?>
                                                    <th scope="col"><?= $rt ?></th>
                                                <?php endforeach; ?>

                                            </tr>
                                        </thead>
                                        <tbody style="color: #101010">
                                            <!-- IPI Column -->
                                            <tr class="font-weight-bold text-center" style="background-color:yellow">
                                                <td colspan="4">Indeks Pembangunan Inklusif</td>
                                                <?php foreach ($range_tahun as $rt) : ?>
                                                    <td scope="col"></td>
                                                <?php endforeach; ?>
                                                <td></td>
                                                <td></td>
                                                <?php foreach ($ipi['nilai_rescale'] as $inr) : ?>
                                                    <td><?= $inr ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <!-- IPI Column End -->

                                            <!-- Data -->
                                            <?php for ($d = 0; $d < $jumlahData['jumlah_d']; $d++) { ?>
                                                <!-- Dimensi -->
                                                <tr class="dimensi bg-blue font-weight-bold text-white">
                                                    <td><?= ($d + 1); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?= $dimensi[$d]['nama_dimensi'] ?></td>
                                                    <?php foreach ($range_tahun as $rt) : ?>
                                                        <td scope="col"></td>
                                                    <?php endforeach; ?>
                                                    <td></td>
                                                    <td></td>
                                                    <?php foreach ($dimensi[$d]['nilai_rescale'] as $nr) : ?>
                                                        <td class="text-center"><?= $nr ?></td>
                                                    <?php endforeach; ?>
                                                </tr>
                                                <?php $jumlahSubDimensi = $jumlahData['detail'][$d]['subDimensi']['jumlah_sd'];
                                                for ($sd = 0; $sd < $jumlahSubDimensi; $sd++) { ?>
                                                    <!-- Sub Dimensi -->
                                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                                        <td></td>
                                                        <td><?= ($sd + 1); ?></td>
                                                        <td></td>
                                                        <td><?= $dimensi[$d]['subDimensi'][$sd]['nama_sub_dimensi'] ?></td>
                                                        <?php foreach ($range_tahun as $rt) : ?>
                                                            <td scope="col"></td>
                                                        <?php endforeach; ?>
                                                        <td></td>
                                                        <td></td>
                                                        <?php foreach ($dimensi[$d]['subDimensi'][$sd]['nilai_rescale'] as $snr) : ?>
                                                            <td class="text-center"><?= $snr ?></td>
                                                        <?php endforeach; ?>
                                                    </tr>
                                                    <?php $jumlahIndikator = $jumlahData['detail'][$d]['subDimensi']['detail'][$sd]['indikator']['jumlah_indikator']; ?>
                                                    <?php for ($ind = 0; $ind < $jumlahIndikator; $ind++) { ?>
                                                        <!-- Indikator -->
                                                        <tr class="indikator">
                                                            <?php $class = "";
                                                            $indikator = $dimensi[$d]['subDimensi'][$sd]['indikator'];
                                                            if ($indikator[$ind]['status'] == 1) {
                                                                $class = "bg-red text-white";
                                                            } elseif ($indikator[$ind]['status'] == 2) {
                                                                $class = "bg-yellow text-white";
                                                            }
                                                            ?>
                                                            <td class="<?= $class ?>"></td>
                                                            <td class="<?= $class ?>"></td>
                                                            <td class="<?= $class ?>"><?= $ind + 1; ?></td>
                                                            <td class="<?= $class ?>"><?= $indikator[$ind]['nama_indikator'] ?></td>
                                                            <?php foreach ($indikator[$ind]['nilai_eksisting'] as $ine) : ?>
                                                                <td class="text-center"><?= $ine ?></td>
                                                            <?php endforeach; ?>
                                                            <td class="text-center"><?= round($indikator[$ind]['max_nilai'], 2); ?></td>
                                                            <td class="text-center"><?= round($indikator[$ind]['min_nilai'], 2); ?></td>
                                                            <?php foreach ($indikator[$ind]['nilai_rescale'] as $inr) : ?>
                                                                <td class="text-center"><?= $inr ?></td>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <!-- End Data -->
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