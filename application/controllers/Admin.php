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

        $this->loadTemplate($data);
        $this->load->view('menu/ipi', $data);
        $this->load->view('templates/footer');
    }

    public function aktivitasEkonomi()
    {
        $this->login_check();
        $data = $this->initData();
        $data['title'] = 'Aktivitas Ekonomi';

        $this->loadTemplate($data);
        $this->load->view('menu/aktivitasEkonomi', $data);
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
