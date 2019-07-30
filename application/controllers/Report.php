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
        $tahun_terakhir = $this->kalkulasi->tahunTerakhirDataSemuaIndikator();
        $data['col_span'] = $tahun_terakhir - 2012 + 1;
        $data['range_tahun'] = $this->admin->getSemuaTahun();


        // Data IPI - IPI
        $start_date = 2012;
        $data['ipi'] = $this->admin->getIPI();
        $data['ipi']['nilai_rescale'] = [];
        for ($j = 0; $j < $data['col_span']; $j++) {
            $tahunSelect = $start_date++;
            $data_IPI_sesuai_tahun = $this->admin->getIPIPerTahun($tahunSelect);
            $rescale_IPI = doubleval($data_IPI_sesuai_tahun['nilai_rescale']);
            array_push($data['ipi']['nilai_rescale'], round($rescale_IPI, 2));
        }

        $data['dimensi'] = $this->admin->getDimensiRange(2012, $tahun_terakhir);
        $data['jumlahData'] = $this->jumlah->getJumlahDimensi();
        return $data;
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
        $data = $this->initData();
        $this->load->view('export', $data);
    }
}
