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

        $this->loadTemplate($data);
        $this->load->view('menu/inputData', $data);
        $this->load->view('templates/footer');
    }

    public function ipi()
    {
        $this->login_check();
        $data = $this->initData();
        $data['title'] = 'Indeks Pembangunan Inklusif';
        $this->load->model('Admin_model', 'admin');
        $data['star_date'] = $this->input->get('star_date');
        $data['end_date'] = $this->input->get('end_date');
        $data['nilaiDimensi'] = $this->admin->getNilaiDimensiPeriode($data['star_date'],  $data['end_date']);
        $data['tahun_selc'] = $this->admin->getTahunNilaiDimensi();
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('tahun')->row_array();
        $data['tahun'] = $this->admin->getPeriode($data['star_date'],  $data['end_date']);
        $data['dimensi'] = $this->db->get('dimensi')->result_array();
        $data['ipi_index'] = $this->admin->getIpiPeriode($data['star_date'], $data['end_date']);
        $this->loadTemplate($data);
        $this->load->view('menu/ipi', $data);
        $this->load->view('templates/footer');
    }

    public function getIpi()
    {
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        if ($star_date > $end_date) {
            return;
        }
        $this->load->model('Admin_model', 'admin');
        $nilaiDimensi = $this->db->get('nilaidimensi')->result_array();
        $tahun = $this->admin->getPeriode($star_date, $end_date);
        $dimensi = $this->db->get('dimensi')->result_array();
        $data = [];
        foreach ($dimensi as $d) {
            $data[$d['kode_d']] = [];
        }
        // ipi
        $ipi_index = $this->admin->getIpiPeriode($star_date, $end_date);
        $data2 = [];
        $count = 0;
        $count2 = 1;
        foreach ($ipi_index as $i) {
            $data2[$count]['nilai_rescale'] = $i['nilai_rescale'];
            $data2[$count]['tahun'] = $i['tahun'];
            $count++;
        }
        foreach ($dimensi as $d) {
            foreach ($nilaiDimensi as $n) {
                if ($d['kode_d'] == $n['kode_d']) {
                    $data[$count2][] = $n['nilai_rescale'];
                }
            }
            $count2++;
        }
        $cek['nama_dimensi'] = $dimensi;
        $cek['ipi'] = $data2;
        $cek['dimensi'] = $data;
        $cek['tahun'] = $tahun;
        echo json_encode($cek);
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
        $data = $this->initData();
        $data['title'] = 'Inklusifitas';

        $this->loadTemplate($data);
        $this->load->view('menu/inklusifitas', $data);
        $this->load->view('templates/footer');
    }

    public function sustainability()
    {
        $this->login_check();
        $data = $this->initData();
        $data['title'] = 'Sustainability';

        $this->loadTemplate($data);
        $this->load->view('menu/sustainability', $data);
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
