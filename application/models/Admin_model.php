<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_model extends CI_Model
{
//Updated
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

    public function getStatus($indikator)
    {
        $this->db->select('status , kode_indikator');
        $this->db->from('indikator');
        $this->db->where('kode_indikator', $indikator);
        return $this->db->get()->row_array();
    }

    public function getMax($indikator, $star_date = null, $end_date = null)
    {
        $this->db->select('MAX(nilai) as nilai');
        $this->db->from('nilaiindikator');
        $this->db->where('kode_indikator', $indikator);
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        return $this->db->get()->row_array();
    }
    public function getMin($indikator, $star_date = null, $end_date = null)
    {
        $this->db->select('MIN(nilai) as nilai');
        $this->db->from('nilaiindikator');
        $this->db->where('kode_indikator', $indikator);
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        return $this->db->get()->row_array();
    }
    public function getNilai($tahun, $indikator)
    {
        $this->db->select('nilai');
        $this->db->from('nilaiindikator');
        $this->db->where('tahun', $tahun);
        $this->db->where('kode_indikator', $indikator);
        return $this->db->get()->row_array();
    }
    public function getTahun($star_date = null, $end_date = null)
    {
        $this->db->select('tahun');
        $this->db->from('nilaiindikator');
        $this->db->group_by('tahun');
        if ($star_date != null && $star_date != null) {
            $this->db->where('tahun >=', $star_date);
            $this->db->where('tahun <=', $end_date);
        }
        return $this->db->get()->result_array();
    }
    public function getIndikator($sbdimensi, $star_date = null, $end_date = null)
    {
        $this->db->select('indikator.kode_indikator,nilaiindikator.tahun,indikator.kode_sd');
        $this->db->from('indikator');
        $this->db->join('nilaiindikator', 'indikator.kode_indikator = nilaiindikator.kode_indikator', 'left');
        $this->db->where('indikator.kode_sd', $sbdimensi);
        if ($star_date != null && $star_date != null) {
            $this->db->where('nilaiindikator.tahun >=', $star_date);
            $this->db->where('nilaiindikator.tahun <=', $end_date);
        }
        return $this->db->get()->result_array();
    }

    public function getSubdimenasi($dimensi, $star_date = null, $end_date = null)
    {
        $this->db->select('subdimensi.kode_sd');
        $this->db->from('subdimensi');
        $this->db->join('nilaisubdimensi', 'subdimensi.kode_sd = nilaisubdimensi.kode_sd', 'left');
        $this->db->where('subdimensi.kode_d', $dimensi);
        if ($star_date != null && $star_date != null) {
            $this->db->where('nilaisubdimensi.tahun >=', $star_date);
            $this->db->where('nilaisubdimensi.tahun <=', $end_date);
        }
        return $this->db->get()->result_array();
    }
    public function getNilaiIndikatorPerTahun($kode_indikator, $tahun, $status = 0)
    {
        $this->db->where('kode_indikator', $kode_indikator);
        $this->db->where('tahun', $tahun);
        $this->db->select('*');
        $this->db->from('nilaiindikator');
        $result = $this->db->get()->row_array();
        return $result;
    }
}
