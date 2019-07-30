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
                                <form action="<?= base_url('admin/subdimensi'); ?>" method="get">
                                    <div class="row ml-1 mr-1">
                                        <div class="col-lg-12 mb-2">
                                            <small>dari tahun</small>
                                            <select class="custom-select" id="inputGroupSelect01" name="star_date">
                                                <option value="<?= $min_tahun['tahun'] ?>" selected id="star_date">pilih tahun...</option>
                                                <?php foreach ($tahun_selc as $t) : ?>
                                                    <option value="<?= $t['tahun'] ?>" id="star_date"><?= $t['tahun'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <small>sampai tahun</small>
                                            <select class="custom-select" id="inputGroupSelect01" name="end_date">
                                                <option value="<?= $max_tahun['tahun'] ?>" selected id="end_date">pilih tahun...</option>
                                                <?php foreach ($tahun_selc as $t) : ?>
                                                    <option value="<?= $t['tahun'] ?>" id="end_date"><?= $t['tahun'] ?></option>

                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <input type="hidden" name="sd" value="<?= $this->input->get('sd');  ?>">
                                            <button type="submit" class="btn btn-primary submit" style="width: 100%" id="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
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
                                <table class="table table-bordered text-center tClip table-sm flex-wrap">
                                    <thead>
                                        <tr style="background-color: #f8f8f8; color: #101010">
                                            <th class="py-5" rowspan="2">#</th>
                                            <th class="py-5" rowspan="2">Sub Dimensi</th>
                                            <th colspan="6">Skor</th>
                                        </tr>
                                        <tr style="background-color: #f8f8f8; color: #101010" class="tahun-sub">
                                        </tr>
                                    </thead>
                                    <tbody class="iniData-subdimensi">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center" style="height: 800px;">
                        <div class="col-lg-12">
                            <div class="chart-sub">
                                <canvas id="chart-subdimensi" width="100%" height="600px"></canvas>
                            </div>
                            <div class="col-md-12 mr-2">
                                <div class="text-gray-800 mt-0">
                                    <div class="legenda card no-border" style="width: auto;">
                                        <div class="card-body">
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