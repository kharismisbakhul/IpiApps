<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_model extends CI_Model
{
    public function getRangeTahun($start_date, $end_date)
    {
        $this->db->where('tahun >', $start_date - 1);
        $this->db->where('tahun <', $end_date + 1);
        $this->db->select('tahun');
        $this->db->from('tahun');
        $result = $this->db->get()->result_array();

        $tahun = [];
        for ($i = 0; $i < count($result); $i++) {
            array_push($tahun, intval($result[$i]['tahun']));
        }
        return $tahun;
    }
    public function getSemuaTahun()
    {
        $this->load->model('Kalkulasi_model', 'kalkulasi');
        $tahun = $this->kalkulasi->tahunTerakhirDataSemuaIndikator();
        $this->db->where('tahun <=', $tahun);
        $this->db->select('tahun');
        $this->db->from('tahun');
        $result = $this->db->get()->result_array();
        $tahun = [];
        for ($i = 0; $i < count($result); $i++) {
            array_push($tahun, $result[$i]['tahun']);
        }
        return $tahun;
    }
    public function getIPI()
    {
        return $this->db->get('ipi')->result_array();
    }
    public function getIndikatorRange($kode_sd, $start, $end)
    {
        $indikator = $this->db->get_where('indikator', ['kode_sd' => $kode_sd])->result_array();
        for ($i = 0; $i < count($indikator); $i++) {
            $kode_indikator = $indikator[$i]['kode_indikator'];
            $indikator[$i]['nilai_indikator'] = $this->getIndikatorRangeNilai($kode_indikator, $start, $end);
        }
        // echo json_encode($indikator);
        return $indikator;
    }
    public function getIndikatorRangeNilai($kode_indikator, $start, $end)
    {
        $this->db->where('nilaiindikator.kode_indikator', $kode_indikator);
        $this->db->where('tahun >=', $start);
        $this->db->where('tahun <=', $end);
        $this->db->select('*');
        $this->db->from('nilaiindikator');
        return $this->db->get()->result_array();
    }
    public function getSubDimensiRange($kode_d, $start, $end)
    {
        $subDimensi = $this->db->get_where('subdimensi', ['kode_d' => $kode_d])->result_array();
        for ($i = 0; $i < count($subDimensi); $i++) {
            $kode_sd = $subDimensi[$i]['kode_sd'];
            $subDimensi[$i]['nilai'] = $this->getSubDimensiRangeNilai($kode_sd, $start, $end);
            $subDimensi[$i]['indikator'] = $this->getIndikatorRange($kode_sd, $start, $end);
        }
        // echo json_encode($subDimensi);
        return $subDimensi;
    }
    public function getSubDimensiRangeNilai($kode_sd, $start, $end)
    {
        $this->db->where('nilaisubdimensi.kode_sd', $kode_sd);
        $this->db->where('tahun >=', $start);
        $this->db->where('tahun <=', $end);
        $this->db->select('*');
        $this->db->from('nilaisubdimensi');
        return $this->db->get()->result_array();
    }
    public function getDimensiRange($start, $end)
    {
        $Dimensi = $this->db->get('dimensi')->result_array();
        for ($i = 0; $i < count($Dimensi); $i++) {
            $kode_d = $Dimensi[$i]['kode_d'];
            $Dimensi[$i]['nilai'] = $this->getDimensiRangeNilai($kode_d, $start, $end);
            $Dimensi[$i]['subDimensi'] = $this->getSubDimensiRange($kode_d, $start, $end);
        }
        return $Dimensi;
    }
    public function getDimensiRangeNilai($kode_d, $start, $end)
    {
        $this->db->where('nilaidimensi.kode_d', $kode_d);
        $this->db->where('tahun >=', $start);
        $this->db->where('tahun <=', $end);
        $this->db->select('*');
        $this->db->from('nilaidimensi');
        return $this->db->get()->result_array();
    }
    public function getIPIPerTahun($tahun)
    {
        $this->db->where('ipi.tahun', $tahun);
        $this->db->select('*');
        $this->db->from('ipi');
        return $this->db->get()->row_array();
    }
    public function getKodeDimensi($nama_d)
    {
        $this->db->where('nama_dimensi', $nama_d);
        $this->db->select('kode_d');
        $this->db->from('dimensi');
        $result = $this->db->get()->row_array();
        $kode_d = intval($result['kode_d']);
        return $kode_d;
    }
    public function getKodeSubDimensi($nama_sd)
    {
        $this->db->where('nama_sub_dimensi', $nama_sd);
        $this->db->select('kode_sd');
        $this->db->from('subdimensi');
        $result = $this->db->get()->row_array();
        $kode_sd = intval($result['kode_sd']);
        return $kode_sd;
    }
    public function getKodeIndikator($nama_indikator)
    {
        $this->db->where('nama_indikator', $nama_indikator);
        $this->db->select('kode_indikator');
        $this->db->from('indikator');
        $result = $this->db->get()->row_array();
        $kode_indikator = intval($result['kode_indikator']);
        return $kode_indikator;
    }
    public function getDimensiJson()
    {
        $result = $this->db->get('dimensi')->result_array();
        echo json_encode($result);
    }
    public function getSubDimensiJson($kode_d)
    {
        $result = $this->db->get_where('subdimensi', ['kode_d' => $kode_d])->result_array();
        echo json_encode($result);
    }
    public function getIndikatorJson($kode_sd)
    {
        $result = $this->db->get_where('indikator', ['kode_sd' => $kode_sd])->result_array();
        echo json_encode($result);
    }
    public function getNilaiIndikatorJson($kode_i, $tahun)
    {
        $this->db->where('nilaiindikator.kode_indikator', $kode_i);
        $this->db->where('nilaiindikator.tahun', $tahun);
        $this->db->select('*');
        $this->db->from('nilaiindikator');
        $result = $this->db->get()->row_array();
        echo json_encode($result);
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
    public function getNilaiDimensiPerTahun($kode_d, $tahun)
    {
        $this->db->where('nilaidimensi.kode_d', $kode_d);
        $this->db->where('nilaidimensi.tahun', $tahun);
        $this->db->select('*');
        $this->db->from('nilaidimensi');
        return $this->db->get()->row_array();
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
    public function getNilaiSubDimensiPerTahun($kode_sd, $tahun)
    {
        $this->db->where('nilaisubdimensi.kode_sd', $kode_sd);
        $this->db->where('nilaisubdimensi.tahun', $tahun);
        $this->db->select('*');
        $this->db->from('nilaisubdimensi');
        return $this->db->get()->row_array();
    }
    public function getIndikator($kode_sd)
    {
        return $this->db->get_where('indikator', ['kode_sd' => $kode_sd])->result_array();
    }
    public function getNilaiIndikator($kode_indikator)
    {
        $this->db->where('nilaiindikator.kode_indikator', $kode_indikator);
        $this->db->select('*');
        $this->db->from('nilaiindikator');
        return $this->db->get()->result_array();
    }
    public function getNilaiIndikatorPerTahun($kode_indikator, $tahun)
    {
        $this->db->where('nilaiindikator.kode_indikator', $kode_indikator);
        $this->db->where('nilaiindikator.tahun', $tahun);
        $this->db->select('*');
        $this->db->from('nilaiindikator');
        $result = $this->db->get()->row_array();
        return $result;
    }
}
