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
        $data['tahun_selc'] = $this->db->get('tahun')->result_array();
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

    public function ubahData()
    {
        $this->login_check();
        $data = $this->initData();
        $data['title'] = 'Indeks Pembangunan Inklusif';
        $this->load->model('Admin_model', 'admin');
        $data['nilaiDimensi'] = $this->admin->getNilaiDimensiPeriode($this->input->post('star_date'), $this->input->post('end_date'));
        $data['tahun_selc'] = $this->db->get('tahun')->result_array();
        $data['tahun'] = $this->admin->getPeriode($this->input->post('star_date'), $this->input->post('end_date'));
        $data['dimensi'] = $this->db->get('dimensi')->result_array();
        $data['ipi_index'] = $this->admin->getIpiPeriode($this->input->post('star_date'), $this->input->post('end_date'));
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
