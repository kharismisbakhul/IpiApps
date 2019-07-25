<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h2 mb-0 text-gray-800"><?= $title;  ?></h1>
        <div class="tanggal">
            <div class="text-s mb-0 font-weight-bold text-gray-400">
                <span><i class="fas fa-calendar-day text-gray-400"></i></span> <?= date('d M Y') ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 mt-3">
            <?= $this->session->flashdata('message');  ?>
            <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
              <div class="card shadow h-100">
                <div class="card-header bg-green">
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
                            <form action="" class="mt-3">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="dariTahun" class="text-xs">Dari Tahun</label>
                                        <select type="email" class="form-control" id="dariTahun">
                                            <option selected>Pilih tahun</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="sampaiTahun" class="text-xs">Sampai Tahun</label>
                                        <select type="email" class="form-control" id="dariTahun">
                                            <option selected>Pilih tahun</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mt-3">
                                        <button type="button" class="btn btn-primary" style="width: 100%;">Cari</button>
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
    </div>

    <div class="row">
        <div class="col-lg-11 col-md-12 col-sm-12">
            <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
              <div class="card shadow h-100">
                <div class="card-header bg-green text-white">
                    <div class="text-sm font-weight-bold text-uppercase mb-1">
                        Table Data dan Chart <?= $title;  ?>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row no-gutters">    
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered  tClip">
                                <thead class="text-center">
                                    <tr style="background-color: #f8f8f8; color: #101010">
                                        <th class="py-5" rowspan="2">#</th>
                                        <th class="py-5" rowspan="2">Dimensi</th>
                                        <th colspan="6">Skor</th>
                                    </tr>
                                    <tr style="background-color: #f8f8f8; color: #101010">
                                        <th scope="col" class="pb-3">2012</th>
                                        <th scope="col" class="pb-3">2013</th>
                                        <th scope="col" class="pb-3">2014</th>
                                        <th scope="col" class="pb-3">2015</th>
                                        <th scope="col" class="pb-3">2016</th>
                                        <th scope="col" class="pb-3">2017</th>
                                    </tr>
                                </thead>
                                <tbody style="color: #101010">
                                    <tr>
                                        <td colspan="2">Indeks Pertumbuhan Ekonomi</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Indeks Inflasi</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Indeks Aktivitas Ekonomi</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Indeks Pembangunan Sumberdaya Manusia</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row no-gutters align-items-center">
                    <div class="chart-bar">
                        <canvas id="pertumbuhan-ek" width="850" height="500"></canvas>
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
                                                    <a href="#" class="text-sm text-decoration-none text-secondary ml-4">Indeks Inflasi</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="label-1">
                                                    <a href="#" role="button" class="btn square-legend bg-yellow"></a>
                                                    <a href="#" class="text-sm text-decoration-none text-secondary ml-4">Indeks Aktivitas Ekonomi</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="label-1">
                                                    <a href="#" role="button" class="btn square-legend bg-orange"></a>
                                                    <a href="#" class="text-sm text-decoration-none text-secondary ml-4">Indeks Pengembangan Sumberdaya Manusia</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="label-1">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <hr class="ml-1 line-legend bg-brown">
                                                        </div>
                                                        <div class="col-8">
                                                            <a href="#" class="text-sm text-decoration-none text-secondary">Indeks Pertumbuhan Ekonomi</a>
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
    </div>

</div>
<!-- End of Main Content -->