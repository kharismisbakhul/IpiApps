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
}
