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

        $this->admin->getDimensiRange(2012, $tahun_terakhir);

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

        //Data IPE - Dimensi
        $start_date = 2012;
        for ($i = 0; $i < 3; $i++) {
            $data['dimensi'][$i] = $this->admin->getNilaiDimensi($i + 1);
            $data['dimensi'][$i]['data'] = $this->db->get_where('dimensi', ['kode_d' => ($i + 1)])->row_array();
            $data['dimensi'][$i]['nilai_rescale'] = [];
        }

        for ($j = 0; $j < $data['col_span']; $j++) {
            $tahunSelect = $start_date++;
            for ($i = 0; $i < 3; $i++) {
                $data_Dimensi_sesuai_tahun = $this->admin->getNilaiDimensiPerTahun(($i + 1), $tahunSelect);
                $rescale_Dimensi = doubleval($data_Dimensi_sesuai_tahun['nilai_rescale']);
                array_push($data['dimensi'][$i]['nilai_rescale'], round($rescale_Dimensi, 2));
            }
        }

        //Data II - Sub Dimensi
        $start_date = 2012;
        for ($i = 0; $i < 7; $i++) {
            $data['subDimensi'][$i] = $this->admin->getNilaiSubDimensi(1);
            $data['subDimensi'][$i]['data'] = $this->db->get_where('subdimensi', ['kode_sd' => ($i + 1)])->row_array();
            $data['subDimensi'][$i]['nilai_rescale'] = [];
            $data['indikator_sd'][$i] = $this->admin->getIndikatorRange(($i + 1), $start_date, $tahun_terakhir);
        }
        //Data Indikator
        $start_date = 2012;
        for ($i = 0; $i < 7; $i++) {
            for ($j = 0; $j < count($data['indikator_sd'][$i]); $j++) {
                $data['indikator_sd'][$i][$j]['nilai_rescale'] = [];
                $data['indikator_sd'][$i][$j]['nilai_eksisting'] = [];
            }
        }

        //Loop Data
        for ($j = 0; $j < $data['col_span']; $j++) {
            $tahunSelect = $start_date++;
            for ($sd = 0; $sd < 7; $sd++) {
                $data_subDimensi_sesuai_tahun = $this->admin->getNilaiSubDimensiPerTahun(($sd + 1), $tahunSelect);
                $rescale_subDimensi = doubleval($data_subDimensi_sesuai_tahun['nilai_rescale']);
                array_push($data['subDimensi'][$sd]['nilai_rescale'], round($rescale_subDimensi, 2));
                for ($i = 0; $i < count($data['indikator_sd'][$sd]); $i++) {
                    $kode_indikator = $data['indikator_sd'][$sd][$i]['kode_indikator'];
                    $data_indikator_sesuai_tahun = $this->admin->getNilaiIndikatorPerTahun($kode_indikator, $tahunSelect);
                    $rescale_indikator = doubleval($data_indikator_sesuai_tahun['nilai_rescale']);
                    $eksisting_indikator = doubleval($data_indikator_sesuai_tahun['nilai']);
                    array_push($data['indikator_sd'][$sd][$i]['nilai_rescale'], round($rescale_indikator, 2));
                    array_push($data['indikator_sd'][$sd][$i]['nilai_eksisting'], round($eksisting_indikator, 2));
                }
            }
        }

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

    // $limit = init_get('memory_limit');
    // ini_set('memory_limit', -1);
    // ini_set('memory_limit', $limit);
    public function export()
    {
        $data = $this->initData();
        $this->load->view('export', $data);
    }
}
