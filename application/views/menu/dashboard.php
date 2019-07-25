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
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?= $this->session->flashdata('message');  ?>
            <div class="d-none d-lg-block col-md-10 mb-4">
              <div class="card border-left-primary shadow py-0">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col ml-auto">
                      <div class="h5 mb-0 font-weight-normal text-gray-800">Hai, <span id="user_name" class="text-gray-900 font-weight-bold">Admin</span> Selamat datang di IPI - Apps</div>
                      <div class="text-s font-weight-normal text-gray-800 mt-2"></div>
                    </div>
                    <div class="col-auto mr-3">
                      <i class="far fa-smile-beam fa-3x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header">
                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                        Table Data re-scale Indikator (Score)
                    </div>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2">
                        <div class="text-gray-800 mt-1">
                            <form action="">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                            <label for="dariTahun" class="text-xs">Dari Tahun</label>
                                            <select type="email" class="form-control" id="dariTahun">
                                                <option selected>Pilih tahun</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="sampaiTahun" class="text-xs">Sampai Tahun</label>
                                            <select type="email" class="form-control" id="dariTahun">
                                                <option selected>Pilih tahun</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2" style="padding-top: 1.9rem;">
                                            <label for=""></label>
                                            <button type="button" class="btn btn-primary">Cari</button>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center tClip">
                                <thead>
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
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
              <div class="card border-left-primary carrot shadow h-100 py-2">
                <div class="card-header">
                    <div class="text-sm font-weight-bold text-uppercase" style="color: #e58e26">
                        Table Data re-scale Indikator (Score)
                    </div>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="chart-bar">
                        <canvas id="dashboard-chart" width="850" height="500"></canvas>
                    </div>
                    <div class="col-md-12 mr-2">
                        <div class="text-gray-800 mt-0">
                            <div class="legenda card no-border" style="width: auto;">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row ml-1 mt-0">
                                            <div class="col-md-6">
                                                <div class="label-1">
                                                    <a href="#" role="button" class="btn square-legend bg-brown"></a>
                                                    <a href="#" class="text-sm text-decoration-none text-secondary ml-4">Indeks Pertumbuhan Ekonomi</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="label-1">
                                                    <a href="#" role="button" class="btn square-legend bg-carrot"></a>
                                                    <a href="#" class="text-sm text-decoration-none text-secondary ml-4">Indeks Keberlanjutan</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="label-1">
                                                    <a href="#" role="button" class="btn square-legend bg-green"></a>
                                                    <a href="#" class="text-sm text-decoration-none text-secondary ml-4">Indeks Inklusifitas</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="label-1">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <hr class="ml-1 line-legend">
                                                        </div>
                                                        <div class="col-8">
                                                            <a href="#" class="text-sm text-decoration-none text-secondary">Indeks Pembangunan Inklusifitas</a>
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