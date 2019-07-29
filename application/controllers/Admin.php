<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
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

    public function index()
    {
        $this->load->model('Data_model', 'data');
        $data = $this->data->initData();
        $data['title'] = 'Dashboard';
        $data['title2'] = 'Indeks Pembangunan Inklusif';

        //Inisialisasi Data
        $this->load->model('Admin_model', 'admin');
        $data['ipi'] = $this->admin->getIPI();
        $data['dimensi'] = $this->admin->getDimensi();
        $data['ipi']['nilai_rescale'] = [];
        for ($i = 0; $i < count($data['dimensi']); $i++) {
            $data['dimensi'][$i]['nilai_dimensi'] = [];
        }
        $start_date = 2012;
        $end_date = 0;

        //Seleksi Input Range Tahun
        if ($this->input->get('start-date') && $this->input->get('end-date')) {
            $start_date = intval($this->input->get('start-date'));
            $end_date = intval($this->input->get('end-date'));
            //Inputan tanggal salah
            if ($start_date === 0 || $end_date === 0) {
                redirect('admin');
            }
            $data['range_tahun'] = $this->admin->getRangeTahun($start_date, $end_date);
            $data['col_span'] = $end_date - $start_date + 1;
        } else {
            $data['col_span'] = 2017 - 2012 + 1;
            $data['range_tahun'] = $this->admin->getSemuaTahun();
        }

        //Loop Data
        for ($j = 0; $j < $data['col_span']; $j++) {
            $tahunSelect = $start_date++;
            $data_IPI_sesuai_tahun = $this->admin->getIPIPerTahun($tahunSelect);
            $rescale_IPI = doubleval($data_IPI_sesuai_tahun['nilai_rescale']);
            array_push($data['ipi']['nilai_rescale'], round($rescale_IPI, 2));
            for ($i = 0; $i < count($data['dimensi']); $i++) {
                $kode_d = $data['dimensi'][$i]['kode_d'];
                $data_Dimensi_sesuai_tahun = $this->admin->getNilaiDimensiPerTahun($kode_d, $tahunSelect);
                $rescale_dimensi = doubleval($data_Dimensi_sesuai_tahun['nilai_rescale']);
                array_push($data['dimensi'][$i]['nilai_dimensi'], round($rescale_dimensi, 2));
            }
        }
        $this->loadTemplate($data);
        $this->load->view('menu/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function pertumbuhanEkonomi()
    {
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Data_model', 'data');
        // $data = $this->initData();
        $dimensi = "pertumbuhanEkonomi";
        $link = "pertumbuhanEkonomi";
        $title2 = "";

        if ($this->uri->segment(3)) {
            $subDimensi = $this->uri->segment(3);
            $kode_subDimensi = 0;

            if ($subDimensi == "ii") {
                $title2 = 'Indeks Inflasi';
                $data['subDimensi'] = $this->admin->getNilaiSubDimensi(1);
                $data['indikator'] = $this->admin->getIndikator(1);
                $kode_subDimensi = 1;
                $link = "sd_II";
            } else if ($subDimensi == "iae") {
                $title2 = 'Indeks Aktivitas Ekonomi';
                $data['subDimensi'] = $this->admin->getNilaiSubDimensi(2);
                $data['indikator'] = $this->admin->getIndikator(2);
                $kode_subDimensi = 2;
                $link = "sd_IAE";
            } else if ($subDimensi == "ipsdm") {
                $title2 = 'Indeks Pembangunan Sumberdaya Manusia';
                $data['subDimensi'] = $this->admin->getNilaiSubDimensi(3);
                $data['indikator'] = $this->admin->getIndikator(3);
                $kode_subDimensi = 3;
                $link = "sd_IPSDM";
            }

            //Data
            $data_subDimensi = $data['subDimensi'];
            $data_indikator = $data['indikator'];
            $data = $this->data->detailIndikator($data_subDimensi, $data_indikator, $subDimensi, $dimensi, $kode_subDimensi);
            $data['title2'] = $title2;
        } else {
            $data['dimensi'] = $this->admin->getNilaiDimensi(1);
            $data['subDimensi'] = $this->admin->getSubDimensi(1);

            $data_dimensi = $data['dimensi'];
            $data_subDimensi = $data['subDimensi'];
            $data = $this->data->detailSubDimensi($data_dimensi, $data_subDimensi, $dimensi, 1);
            $data['data_dimensi'] = $this->admin->getDimensi();
        }
        $data['title'] = 'Pertumbuhan Ekonomi';
        // header('Content-Type: application/json');
        // echo json_encode($data);
        // die;
        $this->loadTemplate($data);
        $this->load->view('menu/' . $dimensi . '/' . $link, $data);
        $this->load->view('templates/footer');
    }

    public function inklusifitas()
    {
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Data_model', 'data');
        $dimensi = "inklusifitas";
        $link = "inklusifitas";
        $title2 = "";

        if ($this->uri->segment(3)) {
            $subDimensi = $this->uri->segment(3);
            $kode_subDimensi = 0;
            if ($subDimensi == "ipk") {
                $title2 = 'Indeks Penanggulangan Kemiskinan';
                $data['subDimensi'] = $this->admin->getNilaiSubDimensi(4);
                $data['indikator'] = $this->admin->getIndikator(4);
                $kode_subDimensi = 4;
                $link = "sd_IPK";
            } else if ($subDimensi == "ip") {
                $title2 = 'Indeks Pemerataan';
                $data['subDimensi'] = $this->admin->getNilaiSubDimensi(5);
                $data['indikator'] = $this->admin->getIndikator(5);
                $kode_subDimensi = 5;
                $link = "sd_IP";
            }

            //Data
            $data_subDimensi = $data['subDimensi'];
            $data_indikator = $data['indikator'];
            $data = $this->data->detailIndikator($data_subDimensi, $data_indikator, $subDimensi, $dimensi, $kode_subDimensi);
            $data['title2'] = $title2;
        } else {
            $data['dimensi'] = $this->admin->getNilaiDimensi(2);
            $data['subDimensi'] = $this->admin->getSubDimensi(2);

            $data_dimensi = $data['dimensi'];
            $data_subDimensi = $data['subDimensi'];
            $data = $this->data->detailSubDimensi($data_dimensi, $data_subDimensi, $dimensi, 2);
        }
        $data['title'] = 'Inklusifitas';
        $this->loadTemplate($data);
        $this->load->view('menu/' . $dimensi . '/' . $link, $data);
        $this->load->view('templates/footer');
    }

    public function sustainability()
    {
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Data_model', 'data');
        $dimensi = "sustainability";
        $link = "sustainability";
        $title2 = "";

        if ($this->uri->segment(3)) {
            $subDimensi = $this->uri->segment(3);
            $kode_subDimensi = 0;
            if ($subDimensi == "ikk") {
                $title2 = 'Indeks Keberlanjutan Keuangan';
                $data['subDimensi'] = $this->admin->getNilaiSubDimensi(6);
                $data['indikator'] = $this->admin->getIndikator(6);
                $kode_subDimensi = 6;
                $link = "sd_IKK";
            } else if ($subDimensi == "iki") {
                $title2 = 'Indeks Keberlanjutan Infrastruktur';
                $data['subDimensi'] = $this->admin->getNilaiSubDimensi(7);
                $data['indikator'] = $this->admin->getIndikator(7);
                $kode_subDimensi = 7;
                $link = "sd_IKI";
            }

            //Data
            $data_subDimensi = $data['subDimensi'];
            $data_indikator = $data['indikator'];
            $data = $this->data->detailIndikator($data_subDimensi, $data_indikator, $subDimensi, $dimensi, $kode_subDimensi);
            $data['title2'] = $title2;
        } else {
            $data['dimensi'] = $this->admin->getNilaiDimensi(3);
            $data['subDimensi'] = $this->admin->getSubDimensi(3);

            $data_dimensi = $data['dimensi'];
            $data_subDimensi = $data['subDimensi'];
            $data = $this->data->detailSubDimensi($data_dimensi, $data_subDimensi, $dimensi, 3);
        }
        $data['title'] = 'Sustainability';
        $this->loadTemplate($data);
        $this->load->view('menu/' . $dimensi . '/' . $link, $data);
        $this->load->view('templates/footer');
    }
}
