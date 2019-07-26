<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function getDimensi()
    {
        $this->load->model('Admin_model', 'admin');
        $this->admin->getDimensiJson();
    }
    public function getSubDimensi($url_nama_d)
    {
        $nama_d = str_replace("_", " ", $url_nama_d);
        $this->load->model('Admin_model', 'admin');
        $kode_d = $this->admin->getKodeDimensi($nama_d);
        $this->admin->getSubDimensiJson($kode_d);
    }
    public function getIndikator($url_nama_sd)
    {
        $nama_sd = str_replace("_", " ", $url_nama_sd);
        $this->load->model('Admin_model', 'admin');
        $kode_sd = $this->admin->getKodeSubDimensi($nama_sd);
        $this->admin->getIndikatorJson($kode_sd);
    }
    public function getNilaiIndikator($url_nama_indikator, $tahun)
    {
        $nama_indikator = str_replace("_", " ", $url_nama_indikator);
        $this->load->model('Admin_model', 'admin');
        $kode_indikator = $this->admin->getKodeIndikator($nama_indikator);
        $this->admin->getNilaiIndikatorJson($kode_indikator, $tahun);
    }
    public function getTahun()
    {
        $result = $this->db->get('tahun')->result_array();
        $tahun = [];
        for ($i = 0; $i < count($result); $i++) {
            array_push($tahun, $result[$i]['tahun']);
        }
        echo json_encode($tahun);
    }
    public function getTahunSelected($tahun)
    {
        $this->db->where('tahun >', intval($tahun));
        $result = $this->db->get('tahun')->result_array();
        $tahun = [];
        for ($i = 0; $i < count($result); $i++) {
            array_push($tahun, $result[$i]['tahun']);
        }
        echo json_encode($tahun);
    }
}
