<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InputData extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

    public function loadTemplate($data)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
    }

    public function initData()
    {
        $data['username'] = $this->session->userdata('username');
        return $data;
    }

    public function index()
    {
        $data = $this->initData();
        $data['title'] = 'Input Data';
        $this->form_validation->set_rules('dimensi', 'Dimensi', 'required|trim');
        $this->form_validation->set_rules('subDimensi', 'Sub Dimensi', 'required|trim');
        $this->form_validation->set_rules('indikator', 'Indikator', 'required|trim');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required|trim', [
            'required' => 'Nilai tidak boleh kosong!!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->loadTemplate($data);
            $this->load->view('menu/inputData', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('Admin_model', 'admin');
            $indikator = $this->input->post('indikator');
            if ($indikator == null) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal Diperbarui</div>');
                redirect('inputData');
            }
            $kode_indikator =  $indikator;
            $tahun = intval($this->input->post('tahun'));
            $nilai = doubleval($this->input->post('nilai'));
            $data = array(
                'tahun' => $tahun,
                'nilai' => $nilai,
                'kode_indikator' => $kode_indikator
            );
            $this->db->set($data);
            $this->db->where('kode_indikator', $kode_indikator);
            $this->db->where('tahun', $tahun);
            $this->db->update('nilaiindikator');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil Diperbarui</div>');

            $this->load->model('Kalkulasi_model', 'kalkulasi');
            $this->kalkulasi->setNilaiMax($kode_indikator);
            $this->kalkulasi->setNilaiMin($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleIndikator($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleSubDimensi($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleDimensi($kode_indikator);
            // $this->kalkulasi->setNilaiRescaleIPI();

            redirect('inputData');
        }
    }

    public function tambahIndikator()
    {
        $this->load->model('Admin_model', 'admin');
        $Dimensi = $this->input->post('modal-dimensi');
        $kode_sd = $this->input->post('modal-subDimensi');
        $baris = $this->input->post('modal-baris-indeks');
        $nama_indikator = $this->input->post('modal-indikator');
        $status = $this->input->post('modal-status');
        $status_kode = 0;
        if ($status === "Merah") {
            $status_kode = 1;
        } else if ($status == "Putih") {
            $status_kode = 0;
        } else {
            $status_kode = 2;
        }

        if ($Dimensi == "Pilih Dimensi" && $kode_sd == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dimensi Belum ada yang dipilih</div>');
        } else if ($kode_sd == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sub Dimensi belum ada yang dipilih</div>');
        } else if ($baris == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Baris indikator belum ada yang dipilih</div>');
        } else {
            $cek_indikator =  $this->db->get_where('indikator', ['nama_indikator' => $nama_indikator])->row_array();
            if ($cek_indikator != null) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Indikator sudah ada!!</div>');
            } else {
                // Cek Baris Indikator
                // Ambil semua data indikator sesudah baris tersebut untuk diupdate
                $this->db->where('kode_sd', $kode_sd);
                $this->db->where('baris >=', intval($baris));
                $this->db->from('indikator');
                $row_after_indikator =  $this->db->get()->result_array();

                // Data baris yang lain
                $data_temp = [];
                // Seleksi baris terakhir atau tidak
                if ($row_after_indikator != null) {

                    // Update data baris dibelakangnya (1 ke 2, 2 ke 3, dsb)
                    for ($i = 0; $i < count($row_after_indikator); $i++) {
                        $data_i = array(
                            'kode_indikator' => intval($row_after_indikator[$i]['kode_indikator']),
                            'baris' => intval($row_after_indikator[$i]['baris'] + 1)
                        );
                        array_push($data_temp, $data_i);
                    }
                    $this->db->update_batch('indikator', $data_temp, 'kode_indikator');
                }

                // Insert data baru
                $indikator_new = array(
                    'nama_indikator' => $nama_indikator,
                    'status' => $status_kode,
                    'kode_sd' => intval($kode_sd),
                    'baris' => intval($baris)
                );

                $this->db->insert('indikator', $indikator_new);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Variabel indikator berhasil ditambahkan</div>');
            }
        }


        $this->db->select('MIN(tahun) as tahun');
        $this->db->from('nilaiindikator');
        $tahun_min = $this->db->get()->row_array();

        $this->db->select('MAX(tahun) as tahun');
        $this->db->from('nilaiindikator');
        $tahun_max = $this->db->get()->row_array();

        $indikator = $this->db->get_where('indikator', ['nama_indikator' => $nama_indikator, 'baris' => intval($baris)])->row_array();
        for ($i = intval($tahun_min['tahun']); $i <= intval($tahun_max['tahun']); $i++) {
            $dataNilai = array(
                'tahun' => $i,
                'nilai' => 0,
                'kode_indikator' => intval($indikator['kode_indikator'])
            );
            $this->db->insert('nilaiindikator', $dataNilai);
        }

        redirect('inputData');
    }

    public function pindahIndikator()
    {
        $dimensi1 = $this->input->post('modal-dimensi-1');
        $subdimensi1 = $this->input->post('modal-subDimensi-1');
        $indikator1 = $this->input->post('modal-indikator-1');

        $dimensi2 = $this->input->post('modal-dimensi-2');
        $subdimensi2 = $this->input->post('modal-subDimensi-2');
        $baris = $this->input->post('modal-baris-indeks-2');

        if ($dimensi1 == "Pilih Dimensi" || $subdimensi1 == "Pilih Sub Dimensi" || $indikator1 == "Pilih Indikator" || $dimensi2 == "Pilih Dimensi" || $subdimensi2 == "Pilih Sub Dimensi" || $baris == "Pilih Baris / Indeks") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Form Pemindahan Indikator Belum Lengkap, Mohon Coba Kembali dan Lengkapi</div>');
            redirect('inputData');
        } else {
            $indikator = $this->db->get_where('indikator', ['kode_indikator' => intval($indikator1)])->row_array();

            // Data Indikator Asal
            // Ambil semua data indikator sesudah baris tersebut untuk diupdate
            $this->db->where('kode_indikator !=', intval($indikator1));
            $this->db->where('kode_sd', intval($subdimensi1));
            $this->db->where('baris >=', intval($indikator['baris']));
            $this->db->from('indikator');
            $row_after_indikator =  $this->db->get()->result_array();

            // Data baris yang lain
            $data_temp = [];
            // Seleksi baris terakhir atau tidak
            if ($row_after_indikator != null) {
                // Update data baris dibelakangnya (1 ke 2, 2 ke 3, dsb)
                for ($i = 0; $i < count($row_after_indikator); $i++) {
                    $data_i = array(
                        'kode_indikator' => intval($row_after_indikator[$i]['kode_indikator']),
                        'baris' => intval($row_after_indikator[$i]['baris'] - 1)
                    );
                    array_push($data_temp, $data_i);
                }
                $this->db->update_batch('indikator', $data_temp, 'kode_indikator');
            }

            // Data Tujuan
            $this->db->where('kode_sd', intval($subdimensi2));
            $this->db->where('baris >=', intval($baris));
            $this->db->from('indikator');
            $row_after_indikator_2 =  $this->db->get()->result_array();
            // Data baris yang lain
            $data_temp_2 = [];
            // Seleksi baris terakhir atau tidak
            if ($row_after_indikator_2 != null) {
                // Update data baris dibelakangnya (1 ke 2, 2 ke 3, dsb)
                for ($i = 0; $i < count($row_after_indikator_2); $i++) {
                    $data_i = array(
                        'kode_indikator' => intval($row_after_indikator_2[$i]['kode_indikator']),
                        'baris' => intval($row_after_indikator_2[$i]['baris'] + 1)
                    );
                    array_push($data_temp_2, $data_i);
                }
                $this->db->update_batch('indikator', $data_temp_2, 'kode_indikator');
            }

            // Update real data indikator
            $this->db->where('kode_indikator', intval($indikator1));
            $this->db->update('indikator', ['kode_sd' => intval($subdimensi2), 'baris' => intval($baris)]);

            // print_r($baris);
            // print_r($data_temp_2);
            // die;
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Variabel indikator berhasil dipindahkan</div>');
            redirect('inputData');
        }
    }

    public function tambahTahun()
    {
        $tahun = intval($this->input->post('tambah-tahun'));
        $this->db->select('tahun');
        $this->db->from('nilaiindikator');
        $this->db->group_by('tahun');
        $temp_tahun = $this->db->get()->result_array();
        $cek_tahun = true;
        for ($i = 0; $i < count($temp_tahun); $i++) {
            if (intval($temp_tahun[$i]['tahun']) == $tahun) {
                $cek_tahun = false;
            }
        }
        if ($cek_tahun == true) {
            $indikator = $this->db->get('indikator')->result_array();
            for ($i = 0; $i < count($indikator); $i++) {
                $kode_indikator = $indikator[$i]['kode_indikator'];
                $dataNilai = array(
                    'tahun' => $tahun,
                    'nilai' => 0,
                    'kode_indikator' => intval($kode_indikator)
                );
                $this->db->insert('nilaiindikator', $dataNilai);
                $this->load->model('Kalkulasi_model', 'kalkulasi');
                $this->kalkulasi->setNilaiMin($kode_indikator);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tahun berhasil ditambahkan!!</div>');
            redirect('inputData');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tahun sudah ada!!</div>');
            redirect('inputData');
        }
    }
    public function hapusIndikator()
    {

        $this->load->model('Admin_model', 'admin');
        $kode_indikator = $this->input->post('modal-indikator-hapus');
        // Cek Baris Indikator
        // Ambil semua data indikator sesudah baris tersebut untuk diupdate
        $this->db->where('kode_indikator', intval($kode_indikator));
        $this->db->from('indikator');
        $indikator_temp =  $this->db->get()->row_array();

        $this->db->where('kode_indikator !=', intval($indikator_temp['kode_indikator']));
        $this->db->where('kode_sd', intval($indikator_temp['kode_sd']));
        $this->db->where('baris >=', intval($indikator_temp['baris']));
        $this->db->from('indikator');
        $row_after_indikator =  $this->db->get()->result_array();

        // Data baris yang lain
        $data_temp = [];
        // Seleksi baris terakhir atau tidak
        if ($row_after_indikator != null) {

            // Update data baris dibelakangnya (1 ke 2, 2 ke 3, dsb)
            for ($i = 0; $i < count($row_after_indikator); $i++) {
                $data_i = array(
                    'kode_indikator' => intval($row_after_indikator[$i]['kode_indikator']),
                    'baris' => intval($row_after_indikator[$i]['baris'] - 1)
                );
                array_push($data_temp, $data_i);
            }
            $this->db->update_batch('indikator', $data_temp, 'kode_indikator');
        }

        // Hapus indikator
        $this->db->where('kode_indikator', $kode_indikator);
        $this->db->delete('nilaiindikator');
        $this->db->where('kode_indikator', $kode_indikator);
        $this->db->delete('indikator');
        $this->load->model('Kalkulasi_model', 'kalkulasi');
        // $temp_indikator = $this->db->get_where('indikator', ['kode_sd' => $kode_subDimensi])->row_array();
        // $kode_temp_indikator = intval($temp_indikator['kode_indikator']);
        // $this->kalkulasi->setNilaiRescaleSubDimensi($kode_temp_indikator);
        // $this->kalkulasi->setNilaiRescaleDimensi($kode_temp_indikator);
        // $this->kalkulasi->setNilaiRescaleIPI();

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Variabel indikator berhasil dihapus</div>');
        redirect('inputData');
    }
    public function hapusDataDiTahun()
    {
        $tahun = intval($this->input->post('tahun'));
        $this->db->where('tahun', $tahun);
        $this->db->delete('nilaiindikator');
        //Kalkulasi Ulang MAX MIN
        $this->db->select('kode_indikator');
        $indikator = $this->db->get('indikator')->result_array();
        for ($i = 0; $i < count($indikator); $i++) {
            $kode_indikator = $indikator[$i]['kode_indikator'];
            $this->load->model('Kalkulasi_model', 'kalkulasi');
            $this->kalkulasi->setNilaiMax($kode_indikator);
            $this->kalkulasi->setNilaiMin($kode_indikator);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tahun berhasil dihapus</div>');
        redirect('inputData');
    }


    public function hapusData()
    {
        $data = $this->initData();
        $data['title'] = 'Hapus Data';
        $this->form_validation->set_rules('dimensi', 'Dimensi', 'required|trim');
        $this->form_validation->set_rules('subDimensi', 'Sub Dimensi', 'required|trim');
        $this->form_validation->set_rules('indikator', 'Indikator', 'required|trim');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->loadTemplate($data);
            $this->load->view('menu/deleteData', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('Admin_model', 'admin');
            $indikator = $this->input->post('indikator');
            $kode_indikator = $this->admin->getKodeIndikator($indikator);
            $tahun = $this->input->post('tahun');
            $data = array(
                'tahun' => $tahun,
                'kode_indikator' => $kode_indikator
            );
            $this->db->delete('nilaiindikator', $data);
            $this->load->model('Kalkulasi_model', 'kalkulasi');
            $this->kalkulasi->setNilaiMax($kode_indikator);
            $this->kalkulasi->setNilaiMin($kode_indikator);
            $this->kalkulasi->setNilaiRescaleSubDimensi($kode_indikator);
            $this->kalkulasi->setNilaiRescaleDimensi($kode_indikator);
            $this->kalkulasi->setNilaiRescaleIPI();

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data berhasil Dihapus</div>');
            redirect('admin/report');
        }
    }
    public function hai()
    {
        $data = array(
            'tahun' => 2012,
            'nilai' => 20,
            'kode_indikator' => 1
        );
        $this->load->model('Kalkulasi_model', 'kalkulasi');
        $this->db->set($data);
        $this->db->where('kode_indikator', 1);
        $this->db->where('tahun', 2012);
        $this->db->update('nilaiindikator');
        $this->kalkulasi->setNilaiMax(1);
        $this->kalkulasi->setNilaiMin(1);

        // var_dump(2012);
    }
}
