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
        <div class="col-lg-6">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>

    <div class="row">
        <!-- Area Rentan Wakti -->
        <div class="col-lg-5 box">
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
                        <div class="col-lg-12 mb-2">
                            <small>dari tahun</small>
                            <select class="custom-select" id="inputGroupSelect01">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <small>sampai tahun</small>
                            <select class="custom-select" id="inputGroupSelect01">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4 mb-4">
        <!-- Area Rentan Wakti -->
        <div class="col-lg-11 box">
            <div class="card shadow border-bottom-success">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Chart Data Indeks Pembangunan Inklusif</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body bClip">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered text-center tClip">
                                <thead>
                                    <tr style="background-color: #f8f8f8; color: #101010">
                                        <th class="py-5" rowspan="2">#</th>
                                        <th class="py-5" rowspan="2">Dimensi</th>
                                        <th colspan="6">Skor</th>
                                    </tr>
                                    <tr style="background-color: #f8f8f8; color: #101010">
                                        <th scope="col">2012</th>
                                        <th scope="col">2013</th>
                                        <th scope="col">2014</th>
                                        <th scope="col">2015</th>
                                        <th scope="col">2016</th>
                                        <th scope="col">2017</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Indeks Inklusifitas</td>
                                        <?php foreach ($nilai_subDimensi as $nsd) : ?>
                                            <td><?= round($nsd['nilai_rescale'], 2) ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php $a = 2;
                                    foreach ($indikator as $i) : ?>
                                        <tr>
                                            <td><?= $a; ?></td>
                                            <td><?= $i['nama_indikator'] ?></td>
                                            <?php foreach ($i['nilai_indikator'] as $ini) : ?>
                                                <td><?= round($ini['nilai_rescale'], 2) ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php $a++;
                                    endforeach; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <canvas id="myBarChart" width="400" height="400"></canvas>
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