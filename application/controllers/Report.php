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


    public function index()
    {
        $data = $this->initData();
        $this->loadTemplate($data);
        $this->load->view('menu/report', $data);
        $this->load->view('templates/footer');
    }

    public function export()
    {
        $data['username'] = $this->session->userdata('username');
        $data['title'] = 'Report';

        //Data
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Kalkulasi_model', 'kalkulasi');
        $this->load->model('Jumlah_model', 'jumlah');
        $data['star_date'] = '';
        $data['end_date'] = '';
        if ($this->input->get('star_date') && $this->input->get('end_date')) {
            $data['star_date'] = $this->input->get('star_date');
            $data['end_date'] = $this->input->get('end_date');
            $data['col_span'] =  $data['end_date'] -  $data['star_date']   + 1;
            $data['range_tahun'] = $this->admin->getSemuaTahun($data['star_date'], $data['end_date']);
        } else {
            $tahun_terakhir = $this->kalkulasi->tahunTerakhirDataSemuaIndikator();
            $data['col_span'] = $tahun_terakhir - $this->input->get('star_date') + 1;
            $data['range_tahun'] = $this->admin->getSemuaTahun();
        }
        // Data IPI - IPI
        $data['ipi'] = $this->admin->getIPI($data['star_date'], $data['end_date']);
        $data['dimensi'] = $this->admin->getDimensiRange($data['star_date'], $data['end_date']);
        $data['jumlahData'] = $this->jumlah->getJumlahDimensi();
        // echo json_encode($data);
        // die;
        // header("Content-type: application/json");

        $this->load->view('export', $data);
    }
}
