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
            redirect('admin/inputData');
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
        ($status === "Merah") ? $status_kode = 1 : $status_kode = 0;
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
        redirect('admin/inputData');
    }

    public function ipi()
    {
        $this->login_check();
        $data = $this->initData();
        $this->load->model('Admin_model', 'admin');
        $data['title'] = 'Indeks Pembangunan Inklusif';

        //Inisialisasi Data
        $data['ipi'] = $this->admin->getIPI();
        $data['dimensi'] = $this->admin->getDimensi();
        $data['ipi']['nilai_rescale'] = [];
        for ($i = 0; $i < count($data['dimensi']); $i++) {
            $data['dimensi'][$i]['nilai_dimensi'] = [];
        }
        $start_date = 2012;
        $end_date = 0;
        $data['range_tahun'] = [];
        $data['col_span'] = 0;

        //Seleksi Input Range Tahun
        if ($this->input->get('start-date') && $this->input->get('end-date')) {
            $start_date = intval($this->input->get('start-date'));
            $end_date = intval($this->input->get('end-date'));
            //Inputan tanggal salah
            if ($start_date === 0 || $end_date === 0) {
                redirect('admin/ipi');
            }
            $data['range_tahun'] = $this->admin->getRangeTahun($start_date, $end_date);
            $data['col_span'] = $end_date - $start_date + 1;
            // $result = $this->admin->getIPIRange();
        } else {
            $data['col_span'] = 2017 - 2012 + 1;
            $data['range_tahun'] = $this->admin->getSemuaTahun();
        }

        //Loop Data
        // for ($j = 0; $j < $data['col_span']; $j++) {
        //     $tahunSelect = $start_date++;
        //     $data_IPI_sesuai_tahun = $this->admin->getIPIPerTahun($tahunSelect);
        //     $rescale_IPI = doubleval($data_IPI_sesuai_tahun['nilai_rescale']);
        //     array_push($data['ipi']['nilai_rescale'], round($rescale_IPI, 2));
        //     for ($i = 0; $i < count($data['dimensi']); $i++) {
        //         $kode_d = $data['dimensi'][$i]['kode_d'];
        //         $data_Dimensi_sesuai_tahun = $this->admin->getNilaiDimensiPerTahun($kode_d, $tahunSelect);
        //         $rescale_dimensi = doubleval($data_Dimensi_sesuai_tahun['nilai_rescale']);
        //         array_push($data['dimensi'][$i]['nilai_dimensi'], round($rescale_dimensi, 2));
        //     }
        // }

        $this->loadTemplate($data);
        $this->load->view('menu/ipi', $data);
        $this->load->view('templates/footer');
    }

    //Data Json IPI buat JS
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

    public function getIndikator()
    {
        $this->load->model('Admin_model', 'admin');
        $result = $this->admin->getIndikator(1);
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]['nilai_indikator'] = [];
        }
        echo json_encode($result);
    }
    public function getSubDimensi()
    {
        $this->load->model('Admin_model', 'admin');
        $result = $this->admin->getSubDimensi(1);
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]['nilai_subDimensi'] = [];
        }
        $result['nilai_rescale'] = [];
        echo json_encode($result);
    }
    public function getNilaiDimensi()
    {
        $this->load->model('Admin_model', 'admin');
        $result = $this->admin->getNilaiDimensi(1);
        $result['nilai_rescale'] = [];
        echo json_encode($result);
    }
    public function getNilaiSubDimensi()
    {
        $this->load->model('Admin_model', 'admin');
        $result = $this->admin->getNilaiSubDimensi(1);
        echo json_encode($result);
    }

    public function pertumbuhanEkonomi()
    {
        $this->login_check();
        $this->load->model('Admin_model', 'admin');
        $data = $this->initData();
        $link = "";
        if ($this->uri->segment(3)) {
            $subDimensi = $this->uri->segment(3);
            if ($subDimensi == "ii") {
                $data['title2'] = 'Indeks Inflasi';
                $data['subDimensi'] = $this->admin->getNilaiSubDimensi(1);
                $data['indikator'] = $this->admin->getIndikator(1);

                //tambahan
                $data['subDimensi']['nilai_rescale'] = [];
                for ($i = 0; $i < count($data['indikator']); $i++) {
                    $data['indikator'][$i]['nilai_indikator'] = [];
                }
                $start_date = 2012;
                $end_date = 0;
                $data['range_tahun'] = [];
                $data['col_span'] = 0;

                //Seleksi Input Range Tahun
                if ($this->input->get('start-date') && $this->input->get('end-date')) {
                    $start_date = intval($this->input->get('start-date'));
                    $end_date = intval($this->input->get('end-date'));
                    //Inputan tanggal salah
                    if ($start_date === 0 || $end_date === 0) {
                        redirect('admin/pertumbuhanEkonomi/ii');
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

                $link = "sd_II";
            } else if ($subDimensi == "iae") {
                $data['title2'] = 'Indeks Aktivitas Ekonomi';
                $data['subDimensi'] = $this->admin->getNilaiSubDimensi(2);
                $data['indikator'] = $this->admin->getIndikator(2);
                $link = "sd_IAE";
            } else if ($subDimensi == "ipsdm") {
                $data['title2'] = 'Indeks Pembangunan Sumberdaya Manusia';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(3);
                $data['indikator'] = $this->admin->getIndikator(3);
                $link = "sd_IPSDM";
            }
            for ($i = 0; $i < count($data['indikator']); $i++) {
                $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
            }
        } else {
            $data['dimensi'] = $this->admin->getNilaiDimensi(1);
            $data['subDimensi'] = $this->admin->getSubDimensi(1);
            //tambahan
            $data['dimensi']['nilai_rescale'] = [];
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = [];
            }
            $start_date = 2012;
            $end_date = 0;
            $data['range_tahun'] = [];
            $data['col_span'] = 0;

            //Seleksi Input Range Tahun
            if ($this->input->get('start-date') && $this->input->get('end-date')) {
                $start_date = intval($this->input->get('start-date'));
                $end_date = intval($this->input->get('end-date'));
                //Inputan tanggal salah
                if ($start_date === 0 || $end_date === 0) {
                    redirect('admin/pertumbuhanEkonomi');
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
                    // echo json_encode($data_subDimensi_sesuai_tahun);
                    $rescale_subDimensi = doubleval($data_subDimensi_sesuai_tahun['nilai_rescale']);
                    array_push($data['subDimensi'][$i]['nilai_subDimensi'], round($rescale_subDimensi, 2));
                }
            }
            $link = "pertumbuhanEkonomi";
        }
        $data['title'] = 'Pertumbuhan Ekonomi';
        $this->loadTemplate($data);
        $this->load->view('menu/pertumbuhanEkonomi/' . $link, $data);
        $this->load->view('templates/footer');
    }

    public function inklusifitas()
    {
        $this->login_check();
        $this->load->model('Admin_model', 'admin');
        $data = $this->initData();
        $link = "";
        if ($this->uri->segment(3)) {
            $subDimensi = $this->uri->segment(3);
            if ($subDimensi == "ipk") {
                $data['title2'] = 'Indeks Penanggulangan Kemiskinan';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(4);
                $data['indikator'] = $this->admin->getIndikator(4);
                $link = "sd_IPK";
            } else if ($subDimensi == "ip") {
                $data['title2'] = 'Indeks Pemerataan';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(5);
                $data['indikator'] = $this->admin->getIndikator(5);
                $link = "sd_IP";
            }
            for ($i = 0; $i < count($data['indikator']); $i++) {
                $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
            }
        } else {
            $data['dimensi'] = $this->admin->getNilaiDimensi(2);
            $data['subDimensi'] = $this->admin->getSubDimensi(2);

            //tambahan
            $data['dimensi']['nilai_rescale'] = [];
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = [];
            }
            $start_date = 2012;
            $end_date = 0;
            $data['range_tahun'] = [];
            $data['col_span'] = 0;

            //Seleksi Input Range Tahun
            if ($this->input->get('start-date') && $this->input->get('end-date')) {
                $start_date = intval($this->input->get('start-date'));
                $end_date = intval($this->input->get('end-date'));
                //Inputan tanggal salah
                if ($start_date === 0 || $end_date === 0) {
                    redirect('admin/inklusifitas');
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
                    // echo json_encode($data_subDimensi_sesuai_tahun);
                    $rescale_subDimensi = doubleval($data_subDimensi_sesuai_tahun['nilai_rescale']);
                    array_push($data['subDimensi'][$i]['nilai_subDimensi'], round($rescale_subDimensi, 2));
                }
            }

            $link = "inklusifitas";
        }
        $data['title'] = 'Inklusifitas';
        $this->loadTemplate($data);
        $this->load->view('menu/inklusifitas/' . $link, $data);
        $this->load->view('templates/footer');
    }

    public function sustainability()
    {
        $this->login_check();
        $this->load->model('Admin_model', 'admin');
        $data = $this->initData();
        $link = "";
        if ($this->uri->segment(3)) {
            $subDimensi = $this->uri->segment(3);
            if ($subDimensi == "ikk") {
                $data['title2'] = 'Indeks Keberlanjutan Keuangan';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(6);
                $data['indikator'] = $this->admin->getIndikator(6);
                $link = "sd_IKK";
            } else if ($subDimensi == "iki") {
                $data['title2'] = 'Indeks Keberlanjutan Infrastruktur';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(7);
                $data['indikator'] = $this->admin->getIndikator(7);
                $link = "sd_IKI";
            }
            for ($i = 0; $i < count($data['indikator']); $i++) {
                $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
            }
        } else {
            $data['dimensi'] = $this->admin->getNilaiDimensi(3);
            $data['subDimensi'] = $this->admin->getSubDimensi(3);

            //tambahan
            $data['dimensi']['nilai_rescale'] = [];
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = [];
            }
            $start_date = 2012;
            $end_date = 0;
            $data['range_tahun'] = [];
            $data['col_span'] = 0;

            //Seleksi Input Range Tahun
            if ($this->input->get('start-date') && $this->input->get('end-date')) {
                $start_date = intval($this->input->get('start-date'));
                $end_date = intval($this->input->get('end-date'));
                //Inputan tanggal salah
                if ($start_date === 0 || $end_date === 0) {
                    redirect('admin/sustainability');
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
                    // echo json_encode($data_subDimensi_sesuai_tahun);
                    $rescale_subDimensi = doubleval($data_subDimensi_sesuai_tahun['nilai_rescale']);
                    array_push($data['subDimensi'][$i]['nilai_subDimensi'], round($rescale_subDimensi, 2));
                }
            }

            $link = "sustainability";
        }
        $data['title'] = 'Sustainability';
        $this->loadTemplate($data);
        $this->load->view('menu/sustainability/' . $link, $data);
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
