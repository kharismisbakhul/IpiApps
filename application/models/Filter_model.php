<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Filter_model extends CI_Model
{
    public function getTahunNilaiDimensi()
    {
        $this->db->select('tahun');
        $this->db->from('nilaidimensi');
        $this->db->group_by('tahun', 'ASC');
        return $this->db->get()->result_array();
    }
    public function getDataPeriode()
    {
        $this->db->select('nilaidimensi.nilai_rescale,nilaidimensi.tahun_nilaidimensi,nilaidimensi.kode_d');
        $this->db->from('nilaidimensi');
        return $this->db->get()->result_array();
    }
    public function getPeriode($star_date = null, $end_date = null)
    {
        $this->db->select('ipi.tahun');
        $this->db->from('ipi');
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        $this->db->order_by('tahun', 'ASC');
        $this->db->group_by('ipi.tahun');
        return $this->db->get()->result_array();
    }
    public function getNilaiDimensiPeriode($star_date = null, $end_date = null)
    {
        $this->db->select('*');
        $this->db->from('nilaidimensi');
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        $this->db->order_by('kode_d');
        return $this->db->get()->result_array();
    }
    public function getIpiPeriode($star_date = null, $end_date = null)
    {
        $this->db->select('*');
        $this->db->from('ipi');
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        $this->db->order_by('id_nilai_ipi');
        return $this->db->get()->result_array();
    }
}
