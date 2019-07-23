<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_model extends CI_Model
{
    public function getIPI()
    {
        return $this->db->get('ipi')->result_array();
    }
    public function getDimensi()
    {
        return $this->db->get('dimensi')->result_array();
    }
    public function getNilaiDimensi($kode_d)
    {
        $this->db->where('nilaidimensi.kode_d', $kode_d);
        $this->db->select('*');
        $this->db->from('nilaidimensi');
        return $this->db->get()->result_array();
    }
    public function getSubDimensi($kode_d)
    {
        return $this->db->get_where('subdimensi', ['kode_d' => $kode_d])->result_array();
    }
    public function getNilaiSubDimensi($kode_sd)
    {
        $this->db->where('nilaisubdimensi.kode_sd', $kode_sd);
        $this->db->select('*');
        $this->db->from('nilaisubdimensi');
        return $this->db->get()->result_array();
    }
    public function getIndikator($kode_sd)
    {
        return $this->db->get_where('indikator', ['kode_sd' => $kode_sd])->result_array();
    }
    public function getNilaiIndikator($kode_i)
    {
        $this->db->where('nilaiindikator.kode_indikator', $kode_i);
        $this->db->select('*');
        $this->db->from('nilaiindikator');
        return $this->db->get()->result_array();
    }
}
