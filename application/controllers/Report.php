<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
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
        $data['title'] = 'Report';

        //Data
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Kalkulasi_model', 'kalkulasi');
        $this->load->model('Jumlah_model', 'jumlah');

        return $data;
    }
    public function index()
    {
        $data = $this->initData();
        var_dump($data);
        die;
        $this->loadTemplate($data);
        $this->load->view('menu/report', $data);
        $this->load->view('templates/footer');
    }

    public function export()
    {
        $data = $this->initData();
        $this->load->view('export', $data);
    }
}
