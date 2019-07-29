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
        <div class="col-lg-12">
            <?= $this->session->flashdata('message');  ?>
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
                                        <button type="button" id="submit-search" class="btn btn-primary submit-search" style="width: 100%;">Submit</button>
                                    </div>
                                </div>
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
                                            <th id="span-table" class="span-table" colspan="<?= $col_span ?>">Skor</th>
                                        </tr>
                                        <tr style="background-color: #f8f8f8; color: #101010" id="range-tahun" class="range-tahun">
                                            <?php foreach ($range_tahun as $rt) : ?>
                                                <th scope="col"><?= $rt ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody id="dimensi-table">
                                        <tr id="dimensi-value" class="dimensi-value">
                                            <td colspan="2">Indeks <?= $title; ?></td>
                                            <?php foreach ($dimensi['nilai_rescale'] as $nd) : ?>
                                                <td><?= $nd ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php $a = 1;
                                        foreach ($subDimensi as $sd) : ?>
                                            <tr>
                                                <td><?= $a; ?></td>
                                                <td><?= $sd['nama_sub_dimensi'] ?></td>
                                                <?php foreach ($sd['nilai_subDimensi'] as $snd) : ?>
                                                    <td><?= $snd ?></td>
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
                        <div class="chart-bar chart-bar-dimensi-ipe">
                            <canvas id="dimensi-pertumbuhanEkonomi" width="850" height="500"></canvas>
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
                                                        <a href="#" class="text-sm text-decoration-none text-secondary ml-4"><?= $data_dimensi[0]['nama_dimensi'] ?></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="label-1">
                                                        <a href="#" role="button" class="btn square-legend bg-yellow"></a>
                                                        <a href="#" class="text-sm text-decoration-none text-secondary ml-4"><?= $subDimensi[0]['nama_sub_dimensi'] ?></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div class="label-1">
                                                        <a href="#" role="button" class="btn square-legend bg-orange"></a>
                                                        <a href="#" class="text-sm text-decoration-none text-secondary ml-4"><?= $subDimensi[1]['nama_sub_dimensi'] ?></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div class="label-1">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <hr class="ml-1 line-legend bg-brown">
                                                            </div>
                                                            <div class="col-8">
                                                                <a href="#" class="text-sm text-decoration-none text-secondary"><?= $subDimensi[2]['nama_sub_dimensi'] ?></a>
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