<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_model extends CI_Model
{
    public function getIPI()
    {
        $this->db->select('dimensi.nama_dimensi,nilaidimensi.nilai_rescale,nilaidimensi.tahun,nilaidimensi.kode_d');
        $this->db->from('dimensi');
        $this->db->join('nilaidimensi', 'nilaidimensi.kode_d=dimensi.kode_d', 'left');
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
        $this->db->select('*');
        $this->db->from('tahun');
        if ($star_date != null && $star_date != null) {
            $this->db->where('id >=', $star_date);
            $this->db->where('id <=', $end_date);
        }
        $this->db->order_by('id', 'ASC');
        return $this->db->get()->result_array();
    }
    public function getNilaiDimensiPeriode($star_date = null, $end_date = null)
    {
        $this->db->select('*');
        $this->db->from('nilaidimensi');
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun_nilaidimensi >=', $star_date);
            $this->db->where('tahun_nilaidimensi <=', $end_date);
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
