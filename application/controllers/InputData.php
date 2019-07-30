<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InputData extends CI_Controller
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
        $data['title'] = 'Input Data';
        $this->form_validation->set_rules('dimensi', 'Dimensi', 'required|trim');
        $this->form_validation->set_rules('subDimensi', 'Sub Dimensi', 'required|trim');
        $this->form_validation->set_rules('indikator', 'Indikator', 'required|trim');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required|trim', [
            'required' => 'Nilai tidak boleh kosong!!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->loadTemplate($data);
            $this->load->view('menu/inputData', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('Admin_model', 'admin');
            $indikator = $this->input->post('indikator');
            $kode_indikator = $this->admin->getKodeIndikator($indikator);
            $tahun = $this->input->post('tahun');
            $nilai = $this->input->post('nilai');
            $data = array(
                'tahun' => $tahun,
                'nilai' => $nilai,
                'kode_indikator' => $kode_indikator
            );
            $cek_data = $this->db->get_where('nilaiindikator', ['kode_indikator' => $kode_indikator, 'tahun' => $tahun])->row_array();
            if ($cek_data['nilai'] != null) {
                $this->db->set($data);
                $this->db->where('kode_indikator', $kode_indikator);
                $this->db->where('tahun', $tahun);
                $this->db->update('nilaiindikator');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil Diperbarui</div>');
            } else {
                $this->db->insert('nilaiindikator', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil Ditambahkan</div>');
            }
            $this->load->model('Kalkulasi_model', 'kalkulasi');
            $this->kalkulasi->setNilaiMax($kode_indikator);
            $this->kalkulasi->setNilaiMin($kode_indikator);
            $this->kalkulasi->setNilaiRescaleIndikator($kode_indikator);
            $this->kalkulasi->setNilaiRescaleSubDimensi($kode_indikator);
            $this->kalkulasi->setNilaiRescaleDimensi($kode_indikator);
            $this->kalkulasi->setNilaiRescaleIPI();
            redirect('report');
        }
    }

    public function tambahIndikator()
    {
        $this->load->model('Admin_model', 'admin');
        $Dimensi = $this->input->post('modal-dimensi');
        $subDimensi = $this->input->post('modal-subDimensi');
        $kode_sd = $this->admin->getKodeSubDimensi($subDimensi);
        $nama_indikator = $this->input->post('modal-indikator');
        $status = $this->input->post('modal-status');
        $status_kode = 0;
        if ($status === "Merah") {
            $status_kode = 1;
        } else if ($status == "Putih") {
            $status_kode = 0;
        } else {
            $status_kode = 2;
        }

        $data = array(
            'nama_indikator' => $nama_indikator,
            'status' => $status_kode,
            'kode_sd' => $kode_sd
        );
        if ($Dimensi == "Pilih Dimensi" && $subDimensi == "Pilih Sub Dimensi") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dimensi Belum ada yang dipilih</div>');
        } else if ($subDimensi == "Pilih Sub Dimensi") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sub Dimensi belum ada yang dipilih</div>');
        } else {
            $cek_indikator =  $this->db->get_where('indikator', ['nama_indikator' => $nama_indikator])->row_array();
            if ($cek_indikator != null) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Indikator sudah ada!!</div>');
            } else {
                $this->db->insert('indikator', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Variabel indikator berhasil ditambahkan</div>');
            }
        }
        redirect('report');
    }
    public function hapusIndikator()
    {
        $nama_indikator = $this->input->post('modal-indikator-hapus');
        $nama_subdimensi = $this->input->post('modal-subDimensi-hapus');
        $this->load->model('Admin_model', 'admin');
        $kode_indikator = $this->admin->getKodeIndikator($nama_indikator);
        $kode_subDimensi = $this->admin->getKodeIndikator($nama_subdimensi);
        $this->db->where('kode_indikator', $kode_indikator);
        $this->db->delete('nilaiindikator');

        $this->db->where('kode_indikator', $kode_indikator);
        $this->db->delete('indikator');

        $temp_indikator = $this->db->get_where('indikator', ['kode_sd' => $kode_subDimensi])->row_array();
        $kode_temp_indikator = intval($temp_indikator['kode_indikator']);
        $this->kalkulasi->setNilaiRescaleSubDimensi($kode_temp_indikator);
        $this->kalkulasi->setNilaiRescaleDimensi($kode_temp_indikator);
        $this->kalkulasi->setNilaiRescaleIPI();

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Variabel indikator berhasil dihapus</div>');
        redirect('report');
    }
    public function hapusData()
    {
        $data = $this->initData();
        $data['title'] = 'Hapus Data';
        $this->form_validation->set_rules('dimensi', 'Dimensi', 'required|trim');
        $this->form_validation->set_rules('subDimensi', 'Sub Dimensi', 'required|trim');
        $this->form_validation->set_rules('indikator', 'Indikator', 'required|trim');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required|trim', [
            'required' => 'Nilai tidak boleh kosong!!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->loadTemplate($data);
            $this->load->view('menu/deleteData', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('Admin_model', 'admin');
            $indikator = $this->input->post('indikator');
            $kode_indikator = $this->admin->getKodeIndikator($indikator);
            $tahun = $this->input->post('tahun');
            $data = array(
                'tahun' => $tahun,
                'kode_indikator' => $kode_indikator
            );
            $this->db->delete('nilaiindikator', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data berhasil Dihapus</div>');
            redirect('report');
        }
    }
    public function hai()
    {
        echo $this->db->get_where('tahun', ['tahun' => 2030])->result_array();
    }
}
