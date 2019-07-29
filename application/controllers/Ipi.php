<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ipi extends CI_Controller
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
        $this->load->model('Admin_model', 'admin');
        $data['title'] = 'Indeks Pembangunan Inklusif';

        //Inisialisasi Data
        $data['ipi'] = $this->admin->getIPI();
        $data['dimensi'] = $this->admin->getDimensi();
        $data['ipi']['nilai_rescale'] = [];
        for ($i = 0; $i < count($data['dimensi']); $i++) {
            $data['dimensi'][$i]['nilai_dimensi'] = [];
        }
        $start_date = 2012;
        $end_date = 0;
        $data['range_tahun'] = [];
        $data['col_span'] = 0;

        //Seleksi Input Range Tahun
        if ($this->input->get('start-date') && $this->input->get('end-date')) {
            $start_date = intval($this->input->get('start-date'));
            $end_date = intval($this->input->get('end-date'));
            //Inputan tanggal salah
            if ($start_date === 0 || $end_date === 0) {
                redirect('admin/ipi');
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
        $this->load->view('menu/ipi', $data);
        $this->load->view('templates/footer');
    }
}
