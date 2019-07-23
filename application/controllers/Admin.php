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

    public function aktivitasEkonomi()
    {
        $this->load->model('Admin_model', 'admin');
        $this->login_check();
        $data = $this->initData();
        $data['title'] = 'Aktivitas Ekonomi';
        $data['nilai_dimensi'] = $this->admin->getNilaiDimensi(1);
        $data['subDimensi'] = $this->admin->getSubDimensi(1);
        for ($i = 0; $i < count($data['subDimensi']); $i++) {
            $data['subDimensi'][$i]['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi($data['subDimensi'][$i]['kode_sd']);
        }
        $this->loadTemplate($data);
        $this->load->view('menu/aktivitasEkonomi', $data);
        $this->load->view('templates/footer');
    }

    public function ii()
    {
        $this->load->model('Admin_model', 'admin');
        $this->login_check();
        $data = $this->initData();
        $data['title'] = 'Aktivitas Ekonomi';
        $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(1);
        $data['indikator'] = $this->admin->getIndikator(1);
        for ($i = 0; $i < count($data['indikator']); $i++) {
            $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
        }
        $this->loadTemplate($data);
        $this->load->view('menu/sb_II', $data);
        $this->load->view('templates/footer');
    }

    public function iae()
    {
        $this->load->model('Admin_model', 'admin');
        $this->login_check();
        $data = $this->initData();
        $data['title'] = 'Aktivitas Ekonomi';
        $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(2);
        $data['indikator'] = $this->admin->getIndikator(2);
        for ($i = 0; $i < count($data['indikator']); $i++) {
            $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
        }
        $this->loadTemplate($data);
        $this->load->view('menu/sb_IAE', $data);
        $this->load->view('templates/footer');
    }

    public function ipsm()
    {
        $this->load->model('Admin_model', 'admin');
        $this->login_check();
        $data = $this->initData();
        $data['title'] = 'Aktivitas Ekonomi';
        $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(3);
        $data['indikator'] = $this->admin->getIndikator(3);
        for ($i = 0; $i < count($data['indikator']); $i++) {
            $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
        }
        $this->loadTemplate($data);
        $this->load->view('menu/sb_IPSDM', $data);
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
