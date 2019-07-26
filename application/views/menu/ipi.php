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
                        <form action="<?= base_url('ipi'); ?>" method="get">
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
                                <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
                            </div>
                        </form>
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
                    <canvas id="ipi-chart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->