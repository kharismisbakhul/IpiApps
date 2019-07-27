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
        $data['title'] = 'Pertumbuhan Ekonomi';
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('ipi')->row_array();
        $data['min_tahun'] = $this->db->select('MIN(tahun) as tahun')->get('ipi')->row_array();
        $data['tahun_selc'] = $this->admin->getTahun();
        $data['tahun'] = $this->admin->getTahun($star_date, $end_date);
        // $data['dimensi'] = $this->_getNilaiDimensi(1, $star_date, $end_date);
        // $data['n_sb_dimensi'] = $this->db->select('nama_sub_dimensi,kode_sd')->get_where('subdimensi', ['kode_d' => 1])->result_array();
        // $data['n_dimensi'] = $this->db->select('nama_dimensi,kode_d')->get_where('dimensi', ['kode_d' => 1])->result_array();
        // $allsb = $this->db->select('kode_sd')->get_where('subdimensi', ['kode_d' => 1])->result_array();

        // foreach ($allsb as $sb) {
        //     $data['sub_dimensi'][$sb['kode_sd']] = $this->_getNilaiRescaleSubDimensi($sb['kode_sd'], $star_date, $end_date);
        // }

        $this->loadTemplate($data);
        $this->load->view('menu/pertumbuhanEkonomi/pertumbuhanEkonomi', $data);
        $this->load->view('templates/footer');
    }

    public function pertumbuhanEkonomiAPI()
    {
        $dimensi = 1;
        $this->login_check();
        $this->load->model('Admin_model', 'admin');
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        $dimensi = $this->input->get('d');
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('ipi')->row_array();
        $data['min_tahun'] = $this->db->select('MIN(tahun) as tahun')->get('ipi')->row_array();
        $data['tahun'] = $this->admin->getTahun($star_date, $end_date);
        $data['dimensi'] = $this->_getNilaiDimensi($dimensi, $star_date, $end_date);
        $data['n_sb_dimensi'] = $this->db->select('nama_sub_dimensi,kode_sd')->get_where('subdimensi', ['kode_d' => $dimensi])->result_array();
        $data['n_dimensi'] = $this->db->select('nama_dimensi,kode_d')->get_where('dimensi', ['kode_d' => $dimensi])->result_array();
        $allsb = $this->db->select('kode_sd')->get_where('subdimensi', ['kode_d' => $dimensi])->result_array();

        foreach ($allsb as $sb) {
            $data['sub_dimensi'][$sb['kode_sd']] = $this->_getNilaiRescaleSubDimensi($sb['kode_sd'], $star_date, $end_date);
        }

        echo json_encode($data);
    }



    // Get Nilai IPI per periode
    private function _getNilaiIpi($star_date = null, $end_date = null)
    {
        $dimensi = $this->db->select('kode_d')->get('dimensi')->result_array();
        if ($dimensi == null) {
            return 0;
        }
        $riscaleDimensi = [];
        $tahun = $this->admin->getTahun($star_date, $end_date);
        foreach ($dimensi as $d) {
            $riscaleDimensi[$d['kode_d']] = $this->_getNilaiDimensi($d['kode_d'], $star_date, $end_date);
        }
        $nilairescale_ipi = [];
        for ($i = 0; $i < count($tahun); $i++) {
            $nilaiIpi = 0;
            foreach ($riscaleDimensi as $in) { // 3
                if ($in[$tahun[$i]['tahun']] != null || $in[$tahun[$i]['tahun']] == 0) {
                    $nilaiIpi +=  $in[$tahun[$i]['tahun']];
                }
            }
            $nilairescale_ipi[$tahun[$i]['tahun']] =  $nilaiIpi / (count($riscaleDimensi));
        }
        return $nilairescale_ipi;
    }

    // Get Nilai dimensi per periode
    private function _getNilaiDimensi($dimensi, $star_date = null, $end_date = null)
    {
        $this->load->model('Admin_model', 'admin');
        $allsb = $this->db->select('kode_sd')->get_where('subdimensi', ['kode_d' => $dimensi])->result_array();
        if ($allsb == null) {
            return 0;
        }
        $rescalesb = [];
        $tahun = $this->admin->getTahun($star_date, $end_date);
        foreach ($allsb as $sb) {
            $rescalesb[$sb['kode_sd']] = $this->_getNilaiRescaleSubDimensi($sb['kode_sd'], $star_date, $end_date);
        }
        $nilairescale_dimensi = [];
        for ($i = 0; $i < count($tahun); $i++) {
            $nilaiTambah = 0;
            foreach ($rescalesb as $in) { // 3
                if ($in[$tahun[$i]['tahun']] != null || $in[$tahun[$i]['tahun']] == 0) {
                    $nilaiTambah +=  $in[$tahun[$i]['tahun']];
                }
            }
            $nilairescale_dimensi[$dimensi][$tahun[$i]['tahun']] = (1 / count($rescalesb)) * $nilaiTambah;
        }
        return $nilairescale_dimensi[$dimensi];
    }

    // Get Nilai Sub Dimensi per periode
    private function _getNilaiRescaleSubDimensi($sbdimensi, $star_date = null, $end_date = null)
    {
        $this->load->model('Admin_model', 'admin');
        $indikator = $this->admin->getIndikator($sbdimensi, $star_date, $end_date);
        // Nilai Indikator
        $tahun = $this->admin->getTahun($star_date, $end_date);
        $nilairescale_indikator = [];
        foreach ($tahun as $t) {
            foreach ($indikator as $i) {
                $nilairescale_indikator[$i['kode_indikator']][$t['tahun']] = $this->_getNilaiRescale($t['tahun'], $i['kode_indikator'], $star_date, $end_date);
            }
        }
        if ($nilairescale_indikator == null) {
            return 0;
        }


        // akhir nyari nilai per indikator
        // Nilai Subdimensi
        $nilairescale_subdimenasi = 0;
        $nilai_sb = [];
        for ($i = 0; $i < count($tahun); $i++) {
            $nilairescale_subdimenasi = 0;
            foreach ($nilairescale_indikator as $in) { // 6
                if ($in[$tahun[$i]['tahun']] != null || $in[$tahun[$i]['tahun']] == 0) {
                    $nilairescale_subdimenasi += ($in[$tahun[$i]['tahun']]) / count($nilairescale_indikator);
                }
            }
            $nilai_sb[$sbdimensi][$tahun[$i]['tahun']] = $nilairescale_subdimenasi;
        }
        return $nilai_sb[$sbdimensi];
    }

    // Get Nilai indikator per tahun
    private function _getNilaiRescale($tahun, $indikator, $star_date = null, $end_date = null)
    {
        $this->load->model('Admin_model', 'admin');
        $status = $this->admin->getStatus($indikator);
        $max = $this->admin->getMax($indikator, $star_date, $end_date);
        $min = $this->admin->getMin($indikator, $star_date, $end_date);
        if ($max['nilai'] == $min['nilai']) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data menghasilkan nilai NaN ! </div>');
            redirect('admin/pertumbuhanEkonomi');
        }

        $nilai = $this->admin->getNilai($tahun, $indikator);
        if (floatval($max['nilai']) > 0 && floatval($min['nilai']) > 0 && floatval($nilai['nilai']) > 0 && $max['nilai'] != $min['nilai']) {
            if ($status['status'] == 1) {
                $nilairescale = (floatval($max['nilai']) - floatval($nilai['nilai'])) / (floatval($max['nilai']) - floatval($min['nilai'])) * 10;
            } elseif ($status['status'] == 0 || $status['status'] == 2) {
                $nilairescale = (floatval($nilai['nilai']) - floatval($min['nilai'])) / (floatval($max['nilai']) - floatval($min['nilai'])) * 10;
            }
            return $nilairescale;
        } else {
            return $nilairescale = 'Non';
        }
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
