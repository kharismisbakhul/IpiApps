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

    <!-- <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 mt-3">
            <?= $this->session->flashdata('message');  ?>
            <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
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
    </div> -->

    <div class="row mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12">
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
                                        <th colspan="14" class="align-middle">Nilai Indikator Eksisting</th>
                                        <th rowspan="2" class="align-middle">Nilai Max</th>
                                        <th rowspan="2" class="align-middle">Nilai Min</th>
                                        <th class="align-middle" colspan="14">Re-Scale Indikator (SCORE)</th>
                                    </tr>
                                    <tr style="background-color: #485460; color: #ecf0f1;">

                                        <!-- Tahun Nilai Indikator -->
                                        <th scope="col" class="pb-3">2012</th>
                                        <th scope="col" class="pb-3">2013</th>
                                        <th scope="col" class="pb-3">2014</th>
                                        <th scope="col" class="pb-3">2015</th>
                                        <th scope="col" class="pb-3">2016</th>
                                        <th scope="col" class="pb-3">2017</th>
                                        <th scope="col" class="pb-3">2018</th>
                                        <th scope="col" class="pb-3">2019</th>
                                        <th scope="col" class="pb-3">2020</th>
                                        <th scope="col" class="pb-3">2021</th>
                                        <th scope="col" class="pb-3">2022</th>
                                        <th scope="col" class="pb-3">2023</th>
                                        <th scope="col" class="pb-3">2024</th>
                                        <th scope="col" class="pb-3">2025</th>

                                        <!-- Tahun Re-Scale Indikator (SCORE) -->
                                        <th scope="col" class="pb-3">2012</th>
                                        <th scope="col" class="pb-3">2013</th>
                                        <th scope="col" class="pb-3">2014</th>
                                        <th scope="col" class="pb-3">2015</th>
                                        <th scope="col" class="pb-3">2016</th>
                                        <th scope="col" class="pb-3">2017</th>
                                        <th scope="col" class="pb-3">2018</th>
                                        <th scope="col" class="pb-3">2019</th>
                                        <th scope="col" class="pb-3">2020</th>
                                        <th scope="col" class="pb-3">2021</th>
                                        <th scope="col" class="pb-3">2022</th>
                                        <th scope="col" class="pb-3">2023</th>
                                        <th scope="col" class="pb-3">2024</th>
                                        <th scope="col" class="pb-3">2025</th>

                                    </tr>
                                </thead>
                                <tbody style="color: #101010">
                                <!-- IPI Column -->
                                    <tr class="font-weight-bold" style="background-color:yellow">
                                        <td colspan="4">Indeks Pembangunan Inklusif</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <!-- IPI Column End -->

                                <!-- Indeks Pertumbuhan Ekonomi -->
                                    <tr class="dimensi bg-blue font-weight-bold text-white">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td>Indeks Pertumbuhan Ekonomi</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td>Indeks Inflasi</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="indikator bg-red text-white">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td>Deflator PDRB</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 2 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td>Indeks AKtivitas Ekonomi</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="indikator bg-white-gray">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td>Pertumbuhan PDRB Harga Konstan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 3 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td>Indeks Pembangunan Sumber Daya</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="indikator bg-gray">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td>Persentase Tenaga Kerja Sektor Industri</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <!-- Indeks Pertumbuhan Ekonomi End-->

                                <!-- Indeks Inklusifitas -->
                                    <tr class="dimensi bg-blue font-weight-bold text-white">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 2 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td>Indeks Inklusifitas</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td>Indeks Penanggulangan Kemiskinan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="indikator bg-red text-white">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td>Persentase Penduduk Kemiskinan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 2 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td>Indeks Pemerataan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    
                                    <tr class="indikator bg-gray-white">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td>Indeks Pemberdayaan Gender</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="indikator bg-yellow">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 2 </td>
                                        <td>Persentase Rumah Tangga Dengan Luas Lantai Hunian >= 50 m2</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <!-- Indeks Inklusifitas End-->

                                <!-- Indeks Keberlanjuatan -->
                                    <tr class="dimensi bg-blue font-weight-bold text-white">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 3 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td>Indeks Keberlanjutan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td>Indeks Keberlanjutan Keuangan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="indikator bg-gray-white">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td>Ruang Fiskal Daerah</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="sub-dimensi bg-orange font-weight-bold">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 2 </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td>Indeks Keberlanjutan Infrastruktur</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr class="indikator bg-gray-white">
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> </td>
                                        <td> <!-- buat kode tiap dimensi/sub-dimensi/indikator --> 1 </td>
                                        <td>Produktivitas Lahan Sawah</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

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

</div>
<!-- End of Main Content -->