<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

    public function cek()
    {
        $this->load->view('export_2');
    }

    public function initData()
    {
        $data['username'] = $this->session->userdata('username');
        $data['range_tahun'] = [];
        $data['col_span'] = 0;
        return $data;
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
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Kalkulasi_model', 'kalkulasi');
        $data['title'] = 'Dashboard';
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('ipi')->row_array();
        $data['min_tahun'] = $this->db->select('MIN(tahun) as tahun')->get('ipi')->row_array();
        $data['tahun_selc'] = $this->admin->getTahun();
        $data['tahun'] = $this->admin->getTahun($star_date, $end_date);

        if ($this->input->get('star_date') && $this->input->get('end_date')) { } else {
            $data['title2'] = 'Indeks Pembangunan Inklusif';
            //Start - Tambahan Data buat load awal (Semua data)
            $data['ipi'] = $this->admin->getIPI();
            $data['dimensi'] = $this->admin->getDimensi();
            $data['ipi']['nilai_rescale'] = [];
            for ($i = 0; $i < count($data['dimensi']); $i++) {
                $data['dimensi'][$i]['nilai_dimensi'] = [];
            }
            $start_date = 2012;
            $tahun_terakhir = $this->kalkulasi->tahunTerakhirDataSemuaIndikator();
            $data['col_span'] = ($tahun_terakhir - $start_date) + 1;
            $data['range_tahun'] = $this->admin->getSemuaTahun();

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
        }
        $this->loadTemplate($data);
        $this->load->view('menu/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function changePassword()
    {

        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">ojo masuk lewat kene.</div>');
            redirect('auth');
        }

        $this->form_validation->set_rules('passSebelum', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[3]|matches[password1]');

        $passSebelum = $this->input->post('passSebelum');
        $data = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">data inputan tidak lengkap!</div>');
            redirect('admin');
        } else {
            if (!password_verify($passSebelum, $data['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak sesuai!</div>');
                redirect('admin');
            } else {
                $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                $username = $this->session->userdata('username');
                $this->db->set('password', $password);
                $this->db->where('username', $username);
                $this->db->update('user');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diperbaharui!</div>');
                redirect('admin');
            }
        }
    }

    public function ipi()
    {
        //Updated
        $this->load->model('Admin_model', 'admin');
        $data = $this->initData();
        $data['title'] = 'Indeks Pembangunan Inklusif';
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('ipi')->row_array();
        $data['min_tahun'] = $this->db->select('MIN(tahun) as tahun')->get('ipi')->row_array();
        $data['tahun_selc'] = $this->admin->getTahun();
        $data['tahun'] = $this->admin->getTahun($star_date, $end_date);
        $this->loadTemplate($data);
        $this->load->view('menu/ipi', $data);
        $this->load->view('templates/footer');
    }

    public function ipiApi()
    {
        $this->load->model('Admin_model', 'admin');
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('ipi')->row_array();
        $data['min_tahun'] = $this->db->select('MIN(tahun) as tahun')->get('ipi')->row_array();
        $data['tahun'] = $this->admin->getTahun($star_date, $end_date);
        $data['ipi'] = $this->_getNilaiIpi($star_date, $end_date);
        $data['n_dimensi'] = $this->db->select('nama_dimensi,kode_d')->get_where('dimensi')->result_array();
        $data['n_ipi'] = 'Indeks Pembangunan Inklusif';
        foreach ($data['n_dimensi'] as $d) {
            $data['dimensi'][$d['kode_d']] = $this->_getNilaiRescaleSubDimensi($d['kode_d'], $star_date, $end_date);
        }

        echo json_encode($data);
    }

    public function dimensi()
    {
        //Updated
        $this->load->model('Admin_model', 'admin');
        $data = $this->initData();
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('ipi')->row_array();
        $data['min_tahun'] = $this->db->select('MIN(tahun) as tahun')->get('ipi')->row_array();
        $data['tahun_selc'] = $this->admin->getTahun();
        $data['tahun'] = $this->admin->getTahun($star_date, $end_date);
        $kode_dimensi = intval($this->input->get('d'));
        $dimensi = $this->db->select("nama_dimensi")->get('dimensi')->result_array();
        $nama_dimensi = [];
        foreach ($dimensi as $d) {
            array_push($nama_dimensi, $d['nama_dimensi']);
        }
        if ($kode_dimensi == 1) {
            $data['background'] = "bg-red";
        } else if ($kode_dimensi == 2) {
            $data['background'] = "bg-green";
        } else {
            $data['background'] = "bg-orange2";
        }
        $data['title'] = $nama_dimensi[$kode_dimensi - 1];

        // echo json_encode($data['background']);
        // die;
        $this->loadTemplate($data);
        $this->load->view('menu/dimensi', $data);

        $this->load->view('templates/footer');
    }

    public function subdimensi()
    {
        //Updated
        $this->load->model('Admin_model', 'admin');
        $data = $this->initData();
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('ipi')->row_array();
        $data['min_tahun'] = $this->db->select('MIN(tahun) as tahun')->get('ipi')->row_array();
        $data['tahun_selc'] = $this->admin->getTahun();
        $data['tahun'] = $this->admin->getTahun($star_date, $end_date);
        $kode_sd = intval($this->input->get('sd'));
        $subdimensi = $this->db->select("nama_sub_dimensi")->get('subdimensi')->result_array();
        $nama_sub_dimensi = [];
        foreach ($subdimensi as $sd) {
            array_push($nama_sub_dimensi, $sd['nama_sub_dimensi']);
        }
        if ($kode_sd == 1 || $kode_sd == 2 || $kode_sd == 3) {
            $data['background'] = "bg-red";
        } else if ($kode_sd == 4 || $kode_sd == 5) {
            $data['background'] = "bg-green";
        } else {
            $data['background'] = "bg-orange2";
        }
        $data['title'] = $nama_sub_dimensi[$kode_sd - 1];
        $this->loadTemplate($data);
        $this->load->view('menu/subdimensi', $data);
        $this->load->view('templates/footer');
    }

    public function Report()
    {
        $this->load->model('Admin_model', 'admin');
        $data = $this->initData();
        $data['title'] = 'Report';
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('ipi')->row_array();
        $data['min_tahun'] = $this->db->select('MIN(tahun) as tahun')->get('ipi')->row_array();


        $data['tahun_selc'] = $this->admin->getTahun();
        $data['tahun'] = $this->admin->getTahun($star_date, $end_date);
        $data['dimensi'] = $this->db->select('kode_d,nama_dimensi')->get('dimensi')->result_array();
        $data['subdimensi'] = $this->db->select('kode_sd,kode_d,nama_sub_dimensi')->get('subdimensi')->result_array();
        $data['indikator'] = $this->db->select('kode_indikator,nama_indikator,kode_sd,status,max_nilai,min_nilai,status')->get('indikator')->result_array();
        $data['nilai_indikator'] = $this->admin->getNilaiIndikator($star_date, $end_date);
        $this->loadTemplate($data);
        $this->load->view('menu/report_2', $data);
        $this->load->view('templates/footer');
    }

    public function reportApi()
    {
        $this->load->model('Admin_model', 'admin');
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('ipi')->row_array();
        $data['min_tahun'] = $this->db->select('MIN(tahun) as tahun')->get('ipi')->row_array();
        $data['tahun'] = $this->admin->getTahun($star_date, $end_date);
        $data['ipi'] = $this->_getNilaiIpi($star_date, $end_date);
        $data['n_dimensi'] = $this->db->select('nama_dimensi,kode_d')->get_where('dimensi')->result_array();
        $data['n_ipi'] = 'Indeks Pembangunan Inklusif';
        foreach ($data['n_dimensi'] as $d) {
            $data['dimensi'][$d['kode_d']] = $this->_getNilaiDimensi($d['kode_d'], $star_date, $end_date);
        }
        $data['n_sb_dimensi'] = $this->db->select('nama_sub_dimensi,kode_sd')->get('subdimensi')->result_array();
        $allsb = $this->db->select('kode_sd')->get('subdimensi')->result_array();
        foreach ($allsb as $sb) {
            $data['sub_dimensi'][$sb['kode_sd']] = $this->_getNilaiRescaleSubDimensi($sb['kode_sd'], $star_date, $end_date);
        }
        foreach ($allsb as $sb) {
            $data['indikator'][$sb['kode_sd']] = $this->_getNilaiIndikator($sb['kode_sd'], $star_date, $end_date);
        }
        header('Content-type: application/json');
        echo json_encode($data);
    }

    public function dimensiApi()
    {
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

    public function subdimensiApi()
    {
        $this->load->model('Admin_model', 'admin');
        $star_date = $this->input->get('star_date');
        $end_date = $this->input->get('end_date');
        $subdimensi = $this->input->get('sd');
        $data['max_tahun'] = $this->db->select('MAX(tahun) as tahun')->get('ipi')->row_array();
        $data['min_tahun'] = $this->db->select('MIN(tahun) as tahun')->get('ipi')->row_array();
        $data['tahun'] = $this->admin->getTahun($star_date, $end_date);

        $data['subdimensi'] = $this->_getNilaiRescaleSubDimensi($subdimensi, $star_date, $end_date);

        $data['n_subdimensi'] = $this->db->select('nama_sub_dimensi,kode_sd')->get_where('subdimensi', ['kode_sd' => $subdimensi])->row_array();

        $data['n_indikator'] = $this->db->select('nama_indikator,kode_indikator')->get_where('indikator', ['kode_sd' => $subdimensi])->result_array();

        $data['indikator'] = $this->_getNilaiIndikator($subdimensi, $star_date, $end_date);
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
        // Tambahan
        $whereCondition = '';
        $case = '';
        for ($i = 0; $i < count($tahun); $i++) {
            $nilaiIpi = 0;
            foreach ($riscaleDimensi as $in) { // 3
                if ($in[$tahun[$i]['tahun']] != null || $in[$tahun[$i]['tahun']] == 0) {
                    $nilaiIpi +=  $in[$tahun[$i]['tahun']];
                }
            }
            $nilairescale_ipi[$tahun[$i]['tahun']] = round(($nilaiIpi / (count($riscaleDimensi))), 2);
            $case .= " WHEN tahun = " . $tahun[$i]['tahun'] . " THEN " . $nilairescale_ipi[$tahun[$i]['tahun']] . "";
            $tahunTemp = $tahun[$i]['tahun'];
            $whereCondition .= ($whereCondition == '') ? "'$tahunTemp'" : ',' . "'$tahunTemp'";
        }
        // Query
        $sql = "UPDATE ipi set nilai_rescale = CASE $case END WHERE tahun in($whereCondition)";
        $this->db->query($sql);
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

        //Tambahan
        $whereCondition = '';
        $case = '';

        $nilairescale_dimensi = [];
        for ($i = 0; $i < count($tahun); $i++) {
            $nilaiTambah = 0;
            foreach ($rescalesb as $in) { // 3
                if ($in[$tahun[$i]['tahun']] != null || $in[$tahun[$i]['tahun']] == 0) {
                    $nilaiTambah +=  $in[$tahun[$i]['tahun']];
                }
            }
            $nilairescale_dimensi[$dimensi][$tahun[$i]['tahun']] = round(((1 / count($rescalesb)) * $nilaiTambah), 2);
            $case .= " WHEN kode_d = " . $dimensi . " AND tahun = " . $tahun[$i]['tahun'] . " THEN " . $nilairescale_dimensi[$dimensi][$tahun[$i]['tahun']] . "";
        }
        // Query
        $whereCondition .= ($whereCondition == '') ? "'$dimensi'" : ',' . "'$dimensi'";
        $sql = "UPDATE nilaidimensi set nilai_rescale = CASE $case END WHERE kode_d in($whereCondition)";
        $this->db->query($sql);
        return $nilairescale_dimensi[$dimensi];
    }

    // Get Nilai Sub Dimensi per periode
    private function _getNilaiRescaleSubDimensi($sbdimensi, $star_date = null, $end_date = null)
    {
        $this->load->model('Admin_model', 'admin');
        $indikator = $this->admin->getIndikator($sbdimensi);
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
        //Tambahan
        $whereCondition = '';
        $case = '';
        for ($i = 0; $i < count($tahun); $i++) {
            $nilairescale_subdimenasi = 0;
            foreach ($nilairescale_indikator as $in) { // 6
                if ($in[$tahun[$i]['tahun']] != null || $in[$tahun[$i]['tahun']] == 0) {
                    $nilairescale_subdimenasi += ($in[$tahun[$i]['tahun']]) / count($nilairescale_indikator);
                }
            }
            $nilai_sb[$sbdimensi][$tahun[$i]['tahun']] = round($nilairescale_subdimenasi, 2);
            $case .= " WHEN kode_sd = " . $sbdimensi . " AND tahun = " . $tahun[$i]['tahun'] . " THEN " . $nilairescale_subdimenasi . "";
        }
        // Query
        $whereCondition .= ($whereCondition == '') ? "'$sbdimensi'" : ',' . "'$sbdimensi'";
        $sql = "UPDATE nilaisubdimensi set nilai_rescale = CASE $case END WHERE kode_sd in($whereCondition)";
        $result = $this->db->query($sql);
        return $nilai_sb[$sbdimensi];
    }

    private function _getNilaiIndikator($sbdimensi, $star_date = null, $end_date = null)
    {
        $this->load->model('Admin_model', 'admin');

        //Tambahan
        $tahun = $this->admin->getTahun($star_date, $end_date);
        $this->db->where('kode_sd', $sbdimensi);

        $data_indikator = $this->db->get('indikator')->result_array();
        $nilairescale_indikator = [];
        $whereCondition = '';
        $case = '';
        foreach ($tahun as $t) {
            foreach ($data_indikator as $i) {
                $nilairescale_indikator[$i['kode_indikator']][$t['tahun']] = $this->_getNilaiRescale($t['tahun'], $i['kode_indikator'], $star_date, $end_date);
                //INPUT
                $ind = intval($i['kode_indikator']);
                $thn = intval($t['tahun']);
                $rescale = doubleval($nilairescale_indikator[$i['kode_indikator']][$t['tahun']]);

                $case .= " WHEN kode_indikator = " . $ind . " AND tahun = " . $thn . " THEN " . $rescale . "";
            }
        }
        foreach ($data_indikator as $i) {
            $ind = intval($i['kode_indikator']);
            $whereCondition .= ($whereCondition == '') ? "'$ind'" : ',' . "'$ind'";
        }

        $sql = "UPDATE nilaiindikator set nilai_rescale = CASE $case END WHERE kode_indikator in($whereCondition)";
        $this->db->query($sql);
        return $nilairescale_indikator;
    }

    // Get Nilai indikator per tahun
    private function _getNilaiRescale($tahun, $indikator, $star_date = null, $end_date = null)
    {
        $this->load->model('Admin_model', 'admin');
        $status = $this->admin->getStatus($indikator);
        $max = $this->admin->getMax($indikator, $star_date, $end_date);
        $min = $this->admin->getMin($indikator, $star_date, $end_date);
        if ($max['nilai'] == $min['nilai'] || ($max['nilai'] == 0)) {
            $nilairescale = 0;
        }

        $nilai = $this->admin->getNilai($tahun, $indikator);
        if (floatval($nilai['nilai']) >= 0 && $max['nilai'] != $min['nilai']) {
            if ($status['status'] == 1) {
                $nilairescale = (floatval($max['nilai']) - floatval($nilai['nilai'])) / (floatval($max['nilai']) - floatval($min['nilai'])) * 10;
            } elseif ($status['status'] == 0 || $status['status'] == 2) {
                $nilairescale = (floatval($nilai['nilai']) - floatval($min['nilai'])) / (floatval($max['nilai']) - floatval($min['nilai'])) * 10;
            }
            $nilairescale;
        } else {
            $nilairescale = 'Non';
        }
        return round($nilairescale, 2);
    }
}
