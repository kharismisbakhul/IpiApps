<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Data_model extends CI_Model
{
    public function initData()
    {
        $data['username'] = $this->session->userdata('username');
        $data['range_tahun'] = [];
        $data['col_span'] = 0;
        return $data;
    }

    public function detailIndikator($data_subDimensi, $data_indikator, $keterangan_subDimensi, $keterangan_dimensi)
    {
        //Inisialisasi tahun
        $data = $this->initData();
        $start_date = 2012;
        $end_date = 0;

        $data['subDimensi'] = $data_subDimensi;
        $data['indikator'] = $data_indikator;
        $subDimensi = $keterangan_subDimensi;
        $dimensi = $keterangan_dimensi;

        $data['subDimensi']['nilai_rescale'] = [];
        for ($i = 0; $i < count($data['indikator']); $i++) {
            $data['indikator'][$i]['nilai_indikator'] = [];
        }

        //Seleksi Input Range Tahun
        if ($this->input->get('start-date') && $this->input->get('end-date')) {
            $start_date = intval($this->input->get('start-date'));
            $end_date = intval($this->input->get('end-date'));
            //Inputan tanggal salah
            if ($start_date === 0 || $end_date === 0) {
                redirect('admin/' . $dimensi . '/' . $subDimensi);
            }
            $data['range_tahun'] = $this->admin->getRangeTahun($start_date, $end_date);
            $data['col_span'] = $end_date - $start_date + 1;
        } else {
            $data['col_span'] = 2017 - 2012 + 1;
            $data['range_tahun'] = $this->admin->getSemuaTahun();
        }

        //Loop Data
        for ($j = 0; $j < $data['col_span']; $j++) {
            $tahunSelect = $start_date++;
            $data_subDimensi_sesuai_tahun = $this->admin->getNilaiSubDimensiPerTahun(1, $tahunSelect);
            $rescale_subDimensi = doubleval($data_subDimensi_sesuai_tahun['nilai_rescale']);
            array_push($data['subDimensi']['nilai_rescale'], round($rescale_subDimensi, 2));
            for ($i = 0; $i < count($data['indikator']); $i++) {
                $kode_indikator = $data['indikator'][$i]['kode_indikator'];
                $data_indikator_sesuai_tahun = $this->admin->getNilaiIndikatorPerTahun($kode_indikator, $tahunSelect);
                $rescale_indikator = doubleval($data_indikator_sesuai_tahun['nilai_rescale']);
                array_push($data['indikator'][$i]['nilai_indikator'], round($rescale_indikator, 2));
            }
        }
        return $data;
    }

    public function detailSubDimensi($data_dimensi, $data_subDimensi, $keterangan_dimensi)
    {
        //Inisialisasi tahun
        $data = $this->initData();
        $start_date = 2012;
        $end_date = 0;

        $data['dimensi'] = $data_dimensi;
        $data['subDimensi'] = $data_subDimensi;
        $dimensi = $keterangan_dimensi;

        $data['dimensi']['nilai_rescale'] = [];
        for ($i = 0; $i < count($data['subDimensi']); $i++) {
            $data['subDimensi'][$i]['nilai_subDimensi'] = [];
        }
        //Seleksi Input Range Tahun
        if ($this->input->get('start-date') && $this->input->get('end-date')) {
            $start_date = intval($this->input->get('start-date'));
            $end_date = intval($this->input->get('end-date'));
            //Inputan tanggal salah
            if ($start_date === 0 || $end_date === 0) {
                redirect('admin/' . $dimensi);
            }
            $data['range_tahun'] = $this->admin->getRangeTahun($start_date, $end_date);
            $data['col_span'] = $end_date - $start_date + 1;
        } else {
            $data['col_span'] = 2017 - 2012 + 1;
            $data['range_tahun'] = $this->admin->getSemuaTahun();
        }

        //Loop Data
        for ($j = 0; $j < $data['col_span']; $j++) {
            $tahunSelect = $start_date++;
            $data_dimensi_sesuai_tahun = $this->admin->getNilaiDimensiPerTahun(1, $tahunSelect);
            $rescale_dimensi = doubleval($data_dimensi_sesuai_tahun['nilai_rescale']);
            array_push($data['dimensi']['nilai_rescale'], round($rescale_dimensi, 2));
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $kode_sd = $data['subDimensi'][$i]['kode_sd'];
                $data_subDimensi_sesuai_tahun = $this->admin->getNilaiSubDimensiPerTahun($kode_sd, $tahunSelect);
                $rescale_subDimensi = doubleval($data_subDimensi_sesuai_tahun['nilai_rescale']);
                array_push($data['subDimensi'][$i]['nilai_subDimensi'], round($rescale_subDimensi, 2));
            }
        }
        return $data;
    }
}
