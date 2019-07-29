<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/');  ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/')  ?>css/sb-admin-2.css" rel="stylesheet">

    <title>Export Table</title>

</head>

<body>
    <style type="text/css">
        table thead tr th {
            background-color: #485460;
            color: #ecf0f1;
            border: 1px black;
        }

        table thead tr th,
        table tbody tr td {
            font-family: 'Times New Roman', Times, serif;
            color: black;
            font-size: 12px;
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

        #dimensi td {
            background-color: blue;
            color: white;
        }

        #sub-dimensi td {
            background-color: orange;
            color: black;
        }

        #status1 {
            background-color: red;
            color: white;
        }

        #status2 {
            background-color: yellow;
            color: white;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Report.xls");
    ?>

    <table class="table table-bordered table-report">
        <thead class="text-center">
            <tr>
                <th class="align-middle" rowspan="2" colspan="3">Kode</th>
                <th class="align-middle" rowspan="2">Dimensi</th>
                <th colspan="<?= $col_span ?>" class="align-middle">Nilai Indikator Eksisting</th>
                <th rowspan="2" class="align-middle">Nilai Max</th>
                <th rowspan="2" class="align-middle">Nilai Min</th>
                <th colspan="<?= $col_span ?>" class="align-middle">Re-Scale Indikator (SCORE)</th>
            </tr>
            <tr>
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
            <tr class="font-weight-bold" id="ipi">
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

            <?php for ($d = 0; $d < $jumlahData['jumlah_d']; $d++) { ?>
                <!-- Dimensi -->
                <tr class="dimensi font-weight-bold" id="dimensi">
                    <td><?= ($d + 1); ?></td>
                    <td></td>
                    <td></td>
                    <td><?= $dimensi[$d]['data']['nama_dimensi'] ?></td>
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
                    <tr class="sub-dimensi font-weight-bold" id="sub-dimensi">
                        <td></td>
                        <td><?= ($sd + 1); ?></td>
                        <td></td>
                        <td><?= $subDimensi[$sd]['data']['nama_sub_dimensi'] ?></td>
                        <?php foreach ($range_tahun as $rt) : ?>
                            <td scope="col"></td>
                        <?php endforeach; ?>
                        <td></td>
                        <td></td>
                        <?php foreach ($subDimensi[$sd]['nilai_rescale'] as $snr) : ?>
                            <td class="text-center"><?= $snr ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php $jumlahIndikator = $jumlahData['detail'][$d]['subDimensi']['detail'][$sd]['indikator']['jumlah_indikator']; ?>
                    <?php for ($ind = 0; $ind < $jumlahIndikator; $ind++) { ?>
                        <!-- Indikator -->
                        <tr class="indikator" id="indikator">
                            <?php $id = "";
                            if ($indikator_sd[$sd][$ind]['status'] == 1) {
                                $id = "status1";
                            } elseif ($indikator_sd[$sd][$ind]['status'] == 2) {
                                $id = "status2";
                            }
                            ?>
                            <td class="" id="<?= $id ?>"></td>
                            <td class="" id="<?= $id ?>"></td>
                            <td class="" id="<?= $id ?>"><?= $ind + 1; ?></td>
                            <td class="" id="<?= $id ?>"><?= $indikator_sd[$sd][$ind]['nama_indikator'] ?></td>
                            <?php foreach ($indikator_sd[$sd][$ind]['nilai_eksisting'] as $ine) : ?>
                                <td class="text-center"><?= $ine ?></td>
                            <?php endforeach; ?>
                            <td class="text-center"><?= round($indikator_sd[$sd][$ind]['max_nilai'], 2); ?></td>
                            <td class="text-center"><?= round($indikator_sd[$sd][$ind]['min_nilai'], 2); ?></td>
                            <?php foreach ($indikator_sd[$sd][$ind]['nilai_rescale'] as $inr) : ?>
                                <td class="text-center"><?= $inr ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            <!-- End Data -->
        </tbody>
    </table>

</body>

</html>