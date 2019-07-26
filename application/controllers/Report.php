<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
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
        $data['title'] = 'Report';

        $this->loadTemplate($data);
        $this->load->view('menu/report', $data);
        $this->load->view('templates/footer');
    }
}
