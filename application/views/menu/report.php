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
                <div class="card-header text-white" style="background-color:#3867d6;">
                    <div class="text-sm font-weight-bold text-uppercase mb-1">
                        Table Data dan Chart <?= $title;  ?>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">    
                    <div class="col-md-12">
                        <div class="table-responsive mx-auto my-auto">
                            <table class="table table-bordered" style="border-color: black;">
                                <thead class="text-center">
                                    <tr style="background-color: #485460; color: #ecf0f1; border: none;">
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

                                <!-- Dimensi -->
                                    <tr class="dimensi bg-blue font-weight-bold text-white">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $dimensi[0]['data']['nama_dimensi'] ?></td>
                                        <?php foreach ($range_tahun as $rt) : ?>
                                            <td scope="col"></td>
                                        <?php endforeach; ?>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($dimensi[0]['nilai_rescale'] as $nr) : ?>
                                        <td class="text-center"><?= $nr ?></td>
                                        <?php endforeach; ?>
                                    </tr>

                                    <!-- Sub Dimensi 1 -->
                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $subDimensi[0]['data']['nama_sub_dimensi'] ?></td>
                                        <?php foreach ($range_tahun as $rt) : ?>
                                            <td scope="col"></td>
                                        <?php endforeach; ?>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($subDimensi[0]['nilai_rescale'] as $snr) : ?>
                                        <td class="text-center"><?= $snr ?></td>
                                        <?php endforeach; ?>
                                    </tr>

                                    <!-- Indikator -->
                                    <?php $i = 1; foreach($indikator_sd[0] as $isd0) : ?>
                                    <tr class="indikator">
                                        <td class="bg-red text-white"> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td class="bg-red text-white"> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td class="bg-red text-white"><?= $i; ?></td>
                                        <td class="bg-red text-white"><?= $isd0['nama_indikator'] ?></td>
                                        <?php foreach ($isd0['nilai_eksisting'] as $ine) : ?>
                                        <td class="text-center"><?= $ine ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center"><?= round($isd0['max_nilai'],2);?></td>
                                        <td class="text-center"><?= round($isd0['min_nilai'],2);?></td>
                                        <?php foreach ($isd0['nilai_rescale'] as $inr) : ?>
                                        <td class="text-center"><?= $inr ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php $i++; endforeach;?>

                                    <!-- Sub Dimensi 2 -->
                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 2 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $subDimensi[1]['data']['nama_sub_dimensi'] ?></td>
                                        <?php foreach ($range_tahun as $rt) : ?>
                                            <td scope="col"></td>
                                        <?php endforeach; ?>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($subDimensi[2]['nilai_rescale'] as $snr) : ?>
                                        <td class="text-center"><?= $snr ?></td>
                                        <?php endforeach; ?>
                                    </tr>

                                    <?php $i = 1; foreach($indikator_sd[1] as $isd1) : ?>
                                    <tr class="indikator">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $i; ?></td>
                                        <td><?= $isd1['nama_indikator'] ?></td>
                                        <?php foreach ($isd1['nilai_eksisting'] as $ine) : ?>
                                        <td class="text-center"><?= $ine ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center"><?= round($isd1['max_nilai'],2);?></td>
                                        <td class="text-center"><?= round($isd1['min_nilai'],2);?></td>
                                        <?php foreach ($isd1['nilai_rescale'] as $inr) : ?>
                                        <td class="text-center"><?= $inr ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php $i++; endforeach;?>

                                    <!-- Sub Dimensi 3 -->
                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 3 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $subDimensi[2]['data']['nama_sub_dimensi'] ?></td>
                                        <?php foreach ($range_tahun as $rt) : ?>
                                            <td scope="col"></td>
                                        <?php endforeach; ?>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($subDimensi[2]['nilai_rescale'] as $snr) : ?>
                                        <td class="text-center"><?= $snr ?></td>
                                        <?php endforeach; ?>
                                    </tr>

                                    <!-- Indikator -->
                                    <?php $i = 1; foreach($indikator_sd[2] as $isd2) : ?>
                                    <tr class="indikator">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $i; ?></td>
                                        <td><?= $isd2['nama_indikator'] ?></td>
                                        <?php foreach ($isd2['nilai_eksisting'] as $ine) : ?>
                                        <td class="text-center"><?= $ine ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center"><?= round($isd2['max_nilai'],2);?></td>
                                        <td class="text-center"><?= round($isd2['min_nilai'],2);?></td>
                                        <?php foreach ($isd2['nilai_rescale'] as $inr) : ?>
                                        <td class="text-center"><?= $inr ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php $i++; endforeach;?>
                                <!-- Indeks Pertumbuhan Ekonomi End-->

                                <!-- Dimensi -->
                                    <tr class="dimensi bg-blue font-weight-bold text-white">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 2 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $dimensi[1]['data']['nama_dimensi'] ?></td>
                                        <?php foreach ($range_tahun as $rt) : ?>
                                            <td scope="col"></td>
                                        <?php endforeach; ?>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($dimensi[1]['nilai_rescale'] as $nr) : ?>
                                        <td class="text-center"><?= $nr ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <!-- Sub Dimensi 4 -->
                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $subDimensi[3]['data']['nama_sub_dimensi'] ?></td>
                                        <?php foreach ($range_tahun as $rt) : ?>
                                            <td scope="col"></td>
                                        <?php endforeach; ?>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($subDimensi[3]['nilai_rescale'] as $snr) : ?>
                                        <td class="text-center"><?= $snr ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <!-- Indikator -->
                                    <?php $i = 1; foreach($indikator_sd[3] as $isd3) : ?>
                                    <tr class="indikator">
                                        <td class="bg-red text-white"> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td class="bg-red text-white"> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td class="bg-red text-white"><?= $i; ?></td>
                                        <td class="bg-red text-white"><?= $isd3['nama_indikator'] ?></td>
                                        <?php foreach ($isd3['nilai_eksisting'] as $ine) : ?>
                                        <td class="text-center"><?= $ine ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center"><?= round($isd3['max_nilai'],2);?></td>
                                        <td class="text-center"><?= round($isd3['min_nilai'],2);?></td>
                                        <?php foreach ($isd3['nilai_rescale'] as $inr) : ?>
                                        <td class="text-center"><?= $inr ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php $i++; endforeach;?>
                                    <!-- Sub Dimensi 5 -->
                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 2 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $subDimensi[4]['data']['nama_sub_dimensi'] ?></td>
                                        <?php foreach ($range_tahun as $rt) : ?>
                                            <td scope="col"></td>
                                        <?php endforeach; ?>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($subDimensi[4]['nilai_rescale'] as $snr) : ?>
                                        <td class="text-center"><?= $snr ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    
                                    <?php $i = 1; foreach($indikator_sd[4] as $isd4) : ?>
                                    <tr class="indikator">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $i; ?></td>
                                        <td><?= $isd4['nama_indikator'] ?></td>
                                        <?php foreach ($isd4['nilai_eksisting'] as $ine) : ?>
                                        <td class="text-center"><?= $ine ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center"><?= round($isd4['max_nilai'],2);?></td>
                                        <td class="text-center"><?= round($isd4['min_nilai'],2);?></td>
                                        <?php foreach ($isd4['nilai_rescale'] as $inr) : ?>
                                        <td class="text-center"><?= $inr ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php $i++; endforeach;?>

                                    <!-- <tr class="indikator bg-yellow">
                                        <td> buat kode tiap dimensi/sub-dimensi/indikator </td>
                                        <td> buat kode tiap dimensi/sub-dimensi/indikator </td>
                                        <td> buat kode tiap dimensi/sub-dimensi/indikator2 </td>
                                        <td>Persentase Rumah Tangga Dengan Luas Lantai Hunian >= 50 m2</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr> -->
                                <!-- Indeks Inklusifitas End-->

                                <!-- Dimensi -->
                                    <tr class="dimensi bg-blue font-weight-bold text-white">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 3 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $dimensi[2]['data']['nama_dimensi'] ?></td>
                                        <?php foreach ($range_tahun as $rt) : ?>
                                            <td scope="col"></td>
                                        <?php endforeach; ?>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($dimensi[2]['nilai_rescale'] as $nr) : ?>
                                        <td class="text-center"><?= $nr ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <!-- Sub Dimensi 6 -->
                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $subDimensi[5]['data']['nama_sub_dimensi'] ?></td>
                                        <?php foreach ($range_tahun as $rt) : ?>
                                            <td scope="col"></td>
                                        <?php endforeach; ?>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($subDimensi[5]['nilai_rescale'] as $snr) : ?>
                                        <td class="text-center"><?= $snr ?></td>
                                        <?php endforeach; ?>
                                    </tr>

                                    <?php $i = 1; foreach($indikator_sd[5] as $isd5) : ?>
                                    <tr class="indikator">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $i; ?></td>
                                        <td><?= $isd5['nama_indikator'] ?></td>
                                        <?php foreach ($isd5['nilai_eksisting'] as $ine) : ?>
                                        <td class="text-center"><?= $ine ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center"><?= round($isd5['max_nilai'],2);?></td>
                                        <td class="text-center"><?= round($isd5['min_nilai'],2);?></td>
                                        <?php foreach ($isd5['nilai_rescale'] as $inr) : ?>
                                        <td class="text-center"><?= $inr ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php $i++; endforeach;?>
                                    <!-- Sub Dimensi 7 -->
                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 2 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $subDimensi[6]['data']['nama_sub_dimensi'] ?></td>
                                        <?php foreach ($range_tahun as $rt) : ?>
                                            <td scope="col"></td>
                                        <?php endforeach; ?>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($subDimensi[6]['nilai_rescale'] as $snr) : ?>
                                        <td class="text-center"><?= $snr ?></td>
                                        <?php endforeach; ?>
                                    </tr>

                                    <?php $i = 1; foreach($indikator_sd[6] as $isd6) : ?>
                                    <tr class="indikator">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td><?= $i; ?></td>
                                        <td><?= $isd6['nama_indikator'] ?></td>
                                        <?php foreach ($isd6['nilai_eksisting'] as $ine) : ?>
                                        <td class="text-center"><?= $ine ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center"><?= round($isd6['max_nilai'],2);?></td>
                                        <td class="text-center"><?= round($isd6['min_nilai'],2);?></td>
                                        <?php foreach ($isd6['nilai_rescale'] as $inr) : ?>
                                        <td class="text-center"><?= $inr ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php $i++; endforeach;?>

                                <!-- Indeks Keberlanjutan End -->
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
<!-- End of Main Content -->