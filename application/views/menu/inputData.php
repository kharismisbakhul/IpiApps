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
        <div class="col-lg-8">
            <?= $this->session->flashdata('message');  ?>
        </div>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header" style="background-color: #3867d6">
                    <div class="text-sm font-weight-bold text-uppercase mb-1 text-white">
                        Indeks Pembangunan Inklusif
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="<?= base_url('inputData') ?>" method="post">
                        <div class="form-group row">
                            <label for="dimensi" class="col-sm-2 col-form-label">Dimensi</label>
                            <div class="col-sm-6">
                                <select class="form-control dimensi" name="dimensi" id="dimensi">
                                </select>
                                <?= form_error('dimensi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subDimensi" class="col-sm-2 col-form-label">Sub Dimensi</label>
                            <div class="col-sm-6">
                                <select class="form-control subDimensi" name="subDimensi" id="subDimensi">
                                </select>
                                <?= form_error('subDimensi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="indikator" class="col-sm-2 col-form-label">Indikator</label>
                            <div class="col-sm-6">
                                <select class="form-control indikator" name="indikator" id="indikator">
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-primary tambah-indikator" data-toggle="modal" data-target="#ModalTambahIndikator">
                                    <i class="fas fa-fw fa-plus"></i>Indikator
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                            <div class="col-sm-6">
                                <select class="form-control tahun" name="tahun" id="tahun">
                                </select>
                                <?= form_error('tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-primary tambah-indikator" data-toggle="modal" data-target="#ModalTambahIndikator">
                                    <i class="fas fa-fw fa-plus"></i>Tahun
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="privileges" class="col-sm-2 col-form-label">Nilai</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control nilai" name="nilai" id="nilai" placeholder="Nilai">
                                <small class="text-secondary">Ganti koma (,) dengan titik(.) </small>
                                <?= form_error('nilai', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg action text-right mt-2 mb-0">
                                <button type="submit" class="btn btn-primary tambah-user">
                                    <i class="fas fa-fw fa-plus"></i>Tambah Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header" style="background-color: #3867d6">
                    <div class="text-sm font-weight-bold text-uppercase mb-1 text-white">
                        Action Hapus
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <button type="button" class="btn btn-danger hapus-indikator" data-toggle="modal" data-target="#ModalHapusIndikator">
                        <i class="fas fa-fw fa-trash"></i>Hapus Indikator
                    </button>
                    <button class="btn btn-danger mt-4">
                        <a href="<?= base_url('inputData/hapusData'); ?>" style="text-decoration: none; color: white;">
                            <i class="fas fa-fw fa-trash"></i>Hapus Data
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Tambah Indikator -->
<div class="modal fade" id="ModalTambahIndikator" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title font-weight-bold text-white" id="exampleModalCenterTitle">Variabel Indikator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formIsian" action="<?= base_url('inputData/tambahIndikator') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="modal-dimensi" class="col-sm-4 col-form-label">Dimensi</label>
                        <div class="col-sm-8">
                            <select class="form-control modal-dimensi" name="modal-dimensi" id="modal-dimensi">
                            </select>
                            <?= form_error('modal-dimensi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="modal-subDimensi" class="col-sm-4 col-form-label">Sub Dimensi</label>
                        <div class="col-sm-8">
                            <select class="form-control modal-subDimensi" name="modal-subDimensi" id="modal-subDimensi">
                            </select>
                            <?= form_error('modal-subDimensi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="modal-indikator" class="col-sm-4 col-form-label">Indikator</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="modal-indikator" name="modal-indikator" placeholder="Indikator" style="resize:none; max-height: 100px;" required></textarea>
                            <?= form_error('modal-indikator', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="modal-status" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control modal-status" name="modal-status" id="modal-status">
                                <option>Putih</option>
                                <option>Merah</option>
                                <option>Kuning</option>
                            </select>
                            <?= form_error('modal-status', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary tombolTambah">Tambah Indikator</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah Indikator -->

<!-- Modal Hapus Indikator -->
<div class="modal fade" id="ModalHapusIndikator" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title font-weight-bold text-white" id="exampleModalCenterTitle">Variabel Indikator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formIsian" action="<?= base_url('inputData/hapusIndikator') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="modal-dimensi-hapus" class="col-sm-4 col-form-label">Dimensi</label>
                        <div class="col-sm-8">
                            <select class="form-control modal-dimensi-hapus" name="modal-dimensi-hapus" id="modal-dimensi-hapus">
                            </select>
                            <?= form_error('modal-dimensi-hapus', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="modal-subDimensi-hapus" class="col-sm-4 col-form-label">Sub Dimensi</label>
                        <div class="col-sm-8">
                            <select class="form-control modal-subDimensi-hapus" name="modal-subDimensi-hapus" id="modal-subDimensi-hapus">
                            </select>
                            <?= form_error('modal-subDimensi-hapus', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="modal-indikator-hapus" class="col-sm-4 col-form-label">Indikator</label>
                        <div class="col-sm-8">
                            <select class="form-control modal-indikator-hapus" name="modal-indikator-hapus" id="modal-indikator-hapus">
                            </select>
                            <?= form_error('modal-indikator-hapus', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger tombolTambah">Hapus Indikator</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Hapus Indikator -->