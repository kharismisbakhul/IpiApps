<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function loadTemplate($data)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
    }

    public function login_check()
    {
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

    public function initData()
    {
        $data['username'] = $this->session->userdata('username');
        return $data;
    }

    public function index()
    {
        $this->login_check();
        $data = $this->initData();
        $data['title'] = 'Dashboard';

        $this->loadTemplate($data);
        $this->load->view('menu/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function inputData()
    {
        $this->login_check();
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
            $kode_indikator = $this->admin->getKodeIndikator($indikator);
            $tahun = $this->input->post('tahun');
            $nilai = $this->input->post('nilai');
            $data = array(
                'tahun' => $tahun,
                'nilai' => $nilai,
                'kode_indikator' => $kode_indikator
            );
            $cek_data = $this->db->get_where('nilaiindikator', ['kode_indikator' => $kode_indikator, 'tahun' => $tahun])->row_array();
            if ($cek_data['nilai'] != null) {
                $this->db->set($data);
                $this->db->where('kode_indikator', $kode_indikator);
                $this->db->where('tahun', $tahun);
                $this->db->update('nilaiindikator');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil Diperbarui</div>');
            } else {
                $this->db->insert('nilaiindikator', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil Ditambahkan</div>');
            }
            $this->load->model('Kalkulasi_model', 'kalkulasi');
            $this->kalkulasi->setNilaiMax($kode_indikator);
            $this->kalkulasi->setNilaiMin($kode_indikator);
            $this->kalkulasi->setNilaiRescaleIndikator($kode_indikator);
            $this->kalkulasi->setNilaiRescaleSubDimensi($kode_indikator);
            $this->kalkulasi->setNilaiRescaleDimensi($kode_indikator);
            $this->kalkulasi->setNilaiRescaleIPI();
            redirect('admin/inputData');
        }
    }

    public function tambahIndikator()
    {
        $this->load->model('Admin_model', 'admin');
        $Dimensi = $this->input->post('modal-dimensi');
        $subDimensi = $this->input->post('modal-subDimensi');
        $kode_sd = $this->admin->getKodeSubDimensi($subDimensi);
        $nama_indikator = $this->input->post('modal-indikator');
        $status = $this->input->post('modal-status');
        $status_kode = 0;
        ($status === "Merah") ? $status_kode = 1 : $status_kode = 0;
        $data = array(
            'nama_indikator' => $nama_indikator,
            'status' => $status_kode,
            'kode_sd' => $kode_sd
        );
        if ($Dimensi == "Pilih Dimensi" && $subDimensi == "Pilih Sub Dimensi") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dimensi Belum ada yang dipilih</div>');
        } else if ($subDimensi == "Pilih Sub Dimensi") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sub Dimensi belum ada yang dipilih</div>');
        } else {
            $cek_indikator =  $this->db->get_where('indikator', ['nama_indikator' => $nama_indikator])->row_array();
            if ($cek_indikator != null) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Indikator sudah ada!!</div>');
            } else {
                $this->db->insert('indikator', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Variabel indikator berhasil ditambahkan</div>');
            }
        }
        redirect('admin/inputData');
    }

    public function ipi()
    {
        $this->login_check();
        $data = $this->initData();
        $this->load->model('Admin_model', 'admin');
        $data['title'] = 'Indeks Pembangunan Inklusif';
        $data['ipi'] = $this->admin->getIPI();
        $data['dimensi'] = $this->admin->getDimensi();
        for ($i = 0; $i < count($data['dimensi']); $i++) {
            $data['dimensi'][$i]['nilai_dimensi'] = $this->admin->getNilaiDimensi($data['dimensi'][$i]['kode_d']);
        }
        $this->loadTemplate($data);
        $this->load->view('menu/ipi', $data);
        $this->load->view('templates/footer');
    }

    public function pertumbuhanEkonomi()
    {
        $this->login_check();
        $this->load->model('Admin_model', 'admin');
        $data = $this->initData();
        $link = "";
        if ($this->uri->segment(3)) {
            $subDimensi = $this->uri->segment(3);
            if ($subDimensi == "ii") {
                $data['title2'] = 'Indeks Inflasi';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(1);
                $data['indikator'] = $this->admin->getIndikator(1);
                $link = "sd_II";
            } else if ($subDimensi == "iae") {
                $data['title2'] = 'Indeks Aktivitas Ekonomi';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(2);
                $data['indikator'] = $this->admin->getIndikator(2);
                $link = "sd_IAE";
            } else if ($subDimensi == "ipsdm") {
                $data['title2'] = 'Indeks Pembangunan Sumberdaya Manusia';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(3);
                $data['indikator'] = $this->admin->getIndikator(3);
                $link = "sd_IPSDM";
            }
            for ($i = 0; $i < count($data['indikator']); $i++) {
                $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
            }
        } else {
            $data['nilai_dimensi'] = $this->admin->getNilaiDimensi(1);
            $data['subDimensi'] = $this->admin->getSubDimensi(1);
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi($data['subDimensi'][$i]['kode_sd']);
            }
            $link = "pertumbuhanEkonomi";
        }
        $data['title'] = 'Pertumbuhan Ekonomi';
        $this->loadTemplate($data);
        $this->load->view('menu/pertumbuhanEkonomi/' . $link, $data);
        $this->load->view('templates/footer');
    }

    public function inklusifitas()
    {
        $this->login_check();
        $this->load->model('Admin_model', 'admin');
        $data = $this->initData();
        $link = "";
        if ($this->uri->segment(3)) {
            $subDimensi = $this->uri->segment(3);
            if ($subDimensi == "ipk") {
                $data['title2'] = 'Indeks Penanggulangan Kemiskinan';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(4);
                $data['indikator'] = $this->admin->getIndikator(4);
                $link = "sd_IPK";
            } else if ($subDimensi == "ip") {
                $data['title2'] = 'Indeks Pemerataan';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(5);
                $data['indikator'] = $this->admin->getIndikator(5);
                $link = "sd_IP";
            }
            for ($i = 0; $i < count($data['indikator']); $i++) {
                $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
            }
        } else {
            $data['nilai_dimensi'] = $this->admin->getNilaiDimensi(2);
            $data['subDimensi'] = $this->admin->getSubDimensi(2);
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi($data['subDimensi'][$i]['kode_sd']);
            }
            $link = "inklusifitas";
        }
        $data['title'] = 'Inklusifitas';
        $this->loadTemplate($data);
        $this->load->view('menu/inklusifitas/' . $link, $data);
        $this->load->view('templates/footer');
    }

    public function sustainability()
    {
        $this->login_check();
        $this->load->model('Admin_model', 'admin');
        $data = $this->initData();
        $link = "";
        if ($this->uri->segment(3)) {
            $subDimensi = $this->uri->segment(3);
            if ($subDimensi == "ikk") {
                $data['title2'] = 'Indeks Keberlanjutan Keuangan';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(6);
                $data['indikator'] = $this->admin->getIndikator(6);
                $link = "sd_IKK";
            } else if ($subDimensi == "iki") {
                $data['title2'] = 'Indeks Keberlanjutan Infrastruktur';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(7);
                $data['indikator'] = $this->admin->getIndikator(7);
                $link = "sd_IKI";
            }
            for ($i = 0; $i < count($data['indikator']); $i++) {
                $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
            }
        } else {
            $data['nilai_dimensi'] = $this->admin->getNilaiDimensi(3);
            $data['subDimensi'] = $this->admin->getSubDimensi(3);
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi($data['subDimensi'][$i]['kode_sd']);
            }
            $link = "sustainability";
        }
        $data['title'] = 'Sustainability';
        $this->loadTemplate($data);
        $this->load->view('menu/sustainability/' . $link, $data);
        $this->load->view('templates/footer');
    }

    public function report()
    {
        $this->login_check();
        $data = $this->initData();
        $data['title'] = 'Report';

        $this->loadTemplate($data);
        $this->load->view('menu/report', $data);
        $this->load->view('templates/footer');
    }
}
