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

    //Set Nilai max indikator tertentu
    public function setNilaiMax($kode_indikator)
    {
        $result = $this->db->get_where('nilaiindikator', ['kode_indikator' => $kode_indikator])->result_array();
        $jumlah_data_nilai = count($result);
        $max = $result[0];
        for ($i = 0; $i < ($jumlah_data_nilai - 1); $i++) {
            if (doubleval($max['nilai']) < doubleval($result[$i + 1]['nilai'])) {
                $max = $result[$i + 1];
            }
        }
        echo json_encode(doubleval($max['nilai']));
    }

    //Set Nilai min indikator tertentu
    public function setNilaiMin($kode_indikator)
    {
        $result = $this->db->get_where('nilaiindikator', ['kode_indikator' => $kode_indikator])->result_array();
        $jumlah_data_nilai = count($result);
        $min = $result[0];
        for ($i = 0; $i < ($jumlah_data_nilai - 1); $i++) {
            if (doubleval($min['nilai']) > doubleval($result[$i + 1]['nilai'])) {
                $min = $result[$i + 1];
            }
        }
        echo json_encode(doubleval($min['nilai']));
    }

    //Ambil status indikator (merah/putih) untuk ditentukan rumusnya
    public function getStatusIndikator($kode_indikator)
    {
        $result = $this->db->get_where('indikator', ['kode_indikator' => $kode_indikator])->row_array();
        echo json_encode(intval($result['status']));
    }

    //Set Nilai rescale Indikator tiap tahun
    public function setNilaiRescaleIndikator($kode_indikator)
    {
        //Ambil indikator
        $data_indikator = $this->db->get_where('indikator', ['kode_indikator' => $kode_indikator])->row_array();
        $kode_sd = intval($data_indikator['kode_sd']);
        $max = doubleval($data_indikator['max_nilai']);
        $min = doubleval($data_indikator['min_nilai']);
        $status = doubleval($data_indikator['status']);
        $nama_indikator = $data_indikator['nama_indikator'];

        //Ambil data tahun
        $data_tahun = $this->getDataTahun();
        $jumlah_data_tahun = count($data_tahun);

        $this->load->model('Admin_model', 'admin');

        echo "Indikator = " . $nama_indikator . "<br>";
        echo "Kode Indikator = " . $kode_indikator . "<br>";
        for ($j = 0; $j < $jumlah_data_tahun; $j++) {
            $tahun = $data_tahun[$j];
            $nilai_data_indikator = $this->admin->getNilaiIndikatorPerTahun($kode_indikator, $tahun);
            $nilai_eksisting_perTahun = $nilai_data_indikator['nilai'];
            $nilai_rescale = 0;
            if ($status == 0) {
                //Rumus (putih) --> ((eksisting sesuai tahun - min)/(max-min))*10 
                $nilai_rescale = (($nilai_eksisting_perTahun - $min) / ($max - $min)) * 10;
            } else if ($status == 1 && $kode_sd == 4) {
                //Rumus (merah - IPK) --> (((eksisting sesuai tahun - min)/(max-min))*-10)+10 
                $nilai_rescale = ((($nilai_eksisting_perTahun - $min) / ($max - $min)) * (-10)) + 10;
            } else {
                //Rumus (merah) --> ((max - eksisting sesuai tahun - min)/(max-min))*10 
                $nilai_rescale = (($max - $nilai_eksisting_perTahun) / ($max - $min)) * 10;
            }
            print "<br>Nilai Rescale tahun " . $tahun . " = " . round($nilai_rescale, 2) . "<br>";
        }

        // echo json_encode($indikator);
    }

    //Set Nilai rescale Sub Dimensi tiap tahun
    public function setNilaiRescaleSubDimensi($kode_indikator)
    {
        //Ambil detail indikator
        $indikator = $this->db->get_where('indikator', ['kode_indikator' => $kode_indikator])->row_array();
        $kode_sd = intval($indikator['kode_sd']);
        $max = doubleval($indikator['max_nilai']);
        $min = doubleval($indikator['min_nilai']);
        $status = doubleval($indikator['status']);
        $result = $this->db->get_where('nilaiindikator', ['kode_indikator' => $kode_indikator])->result_array();
        $jumlah_data_nilai_indikator = count($result);

        //Ambil SubDimensi
        $this->load->model('Admin_model', 'admin');
        $nilai_subDimensi = $this->admin->getNilaiSubDimensi($kode_sd);
        $detail_subDimensi = $this->db->get_where('subDimensi', ['kode_sd' => $kode_sd])->row_array();
        $nama_subDimensi = $detail_subDimensi['nama_sub_dimensi'];
        $jumlah_data_nilai_subDimensi = count($nilai_subDimensi);

        //Ambil Semua indikator sesuai subDimensi
        $this->load->model('Admin_model', 'admin');
        $data_indikator =  $this->admin->getIndikator($kode_sd);
        $jumlah_data_indikator = count($data_indikator);

        //Ambil data tahun
        $data_tahun = $this->getDataTahun();
        $jumlah_data_tahun = count($data_tahun);

        for ($j = 0; $j < $jumlah_data_tahun; $j++) {
            $nilai_rescale_subDimensi_temp = 0;
            $tahun = $data_tahun[$j];
            for ($i = 0; $i < $jumlah_data_indikator; $i++) {
                $kode_indikator = intval($data_indikator[$i]['kode_indikator']);
                $nama_indikator = $data_indikator[$i]['nama_indikator'];
                $nilai_data_indikator = $this->admin->getNilaiIndikatorPerTahun($kode_indikator, $tahun);
                $nilai_rescale_indikator = doubleval($nilai_data_indikator['nilai_rescale']);
                // print "<br> I > Kode " . $kode_indikator . " Nilai Rescale Indikator (" . $nama_indikator . ") tahun " . $tahun . " = " . round($nilai_rescale_indikator, 2) . "<br>";
                $nilai_rescale_subDimensi_temp += $nilai_rescale_indikator;
                // echo json_encode($nama_indikator . " Tahun : " . $tahun . " Re-Scale : " . $nilai_rescale_indikator . "<br>");
            }
            $nilai_rescale_subDimensi = $nilai_rescale_subDimensi_temp / $jumlah_data_indikator;
            print "<br> I > Kode " . $kode_sd . " Nilai Rescale Sub Dimensi (" . $nama_subDimensi . ") tahun " . $tahun . " = " . round($nilai_rescale_subDimensi, 2) . "<br>";
        }

        // echo json_encode($jumlah_data_indikator);
    }

    //Set Nilai rescale Dimensi tiap tahun
    public function setNilaiRescaleDimensi($kode_indikator)
    {
        //Ambil detail indikator
        $indikator = $this->db->get_where('indikator', ['kode_indikator' => $kode_indikator])->row_array();
        $kode_sd = intval($indikator['kode_sd']);

        //Ambil SubDimensi
        $this->load->model('Admin_model', 'admin');
        $subDimensi = $this->db->get_where('subDimensi', ['kode_sd' => $kode_sd])->row_array();
        $kode_d = intval($subDimensi['kode_d']);

        //Ambil Dimensi
        $this->load->model('Admin_model', 'admin');
        $dimensi = $this->db->get_where('dimensi', ['kode_d' => $kode_d])->row_array();
        $nama_dimensi = $dimensi['nama_dimensi'];

        //Ambil Semua subDimensi sesuai Dimensi
        $this->load->model('Admin_model', 'admin');
        $data_subDimensi =  $this->admin->getsubDimensi($kode_d);
        $jumlah_data_subDimensi = count($data_subDimensi);

        //Ambil data tahun
        $data_tahun = $this->getDataTahun();
        $jumlah_data_tahun = count($data_tahun);
        // print_r($data_subDimensi);

        for ($j = 0; $j < $jumlah_data_tahun; $j++) {
            $nilai_rescale_Dimensi_temp = 0;
            $tahun = $data_tahun[$j];
            for ($i = 0; $i < $jumlah_data_subDimensi; $i++) {
                $kode_subDimensi = intval($data_subDimensi[$i]['kode_sd']);
                $nama_subDimensi = $data_subDimensi[$i]['nama_sub_dimensi'];
                $nilai_data_subDimensi = $this->admin->getNilaiSubDimensiPerTahun($kode_subDimensi, $tahun);
                $nilai_rescale_subDimensi = doubleval($nilai_data_subDimensi['nilai_rescale']);
                // print "<br> I > Kode " . $kode_sd . " Nilai Rescale Sub Dimensi (" . $nama_subDimensi . ") tahun " . $tahun . " = " . round($nilai_rescale_subDimensi, 2) . "<br>";
                $nilai_rescale_Dimensi_temp += $nilai_rescale_subDimensi;
                //         // echo json_encode($nama_indikator . " Tahun : " . $tahun . " Re-Scale : " . $nilai_rescale_indikator . "<br>");
            }
            $nilai_rescale_Dimensi = $nilai_rescale_Dimensi_temp / $jumlah_data_subDimensi;
            print "<br> I > Kode " . $kode_d . " Nilai Rescale Dimensi (" . $nama_dimensi . ") tahun " . $tahun . " = " . round($nilai_rescale_Dimensi, 2) . "<br>";
            // die;
        }
    }

    //Set Nilai rescale IPI tiap tahun
    public function setNilaiRescaleIPI()
    {
        //Ambil Dimensi
        $this->load->model('Admin_model', 'admin');
        $data_dimensi = $this->admin->getDimensi();
        $jumlah_data_dimensi = count($data_dimensi);

        //Ambil data tahun
        $data_tahun = $this->getDataTahun();
        $jumlah_data_tahun = count($data_tahun);
        // print_r($jumlah_data_dimensi);

        for ($j = 0; $j < $jumlah_data_tahun; $j++) {
            $nilai_rescale_IPI_temp = 0;
            $tahun = $data_tahun[$j];
            for ($i = 0; $i < $jumlah_data_dimensi; $i++) {
                $kode_dimensi = intval($data_dimensi[$i]['kode_d']);
                $nama_dimensi = $data_dimensi[$i]['nama_dimensi'];
                $nilai_data_dimensi = $this->admin->getNilaiDimensiPerTahun($kode_dimensi, $tahun);
                $nilai_rescale_dimensi = doubleval($nilai_data_dimensi['nilai_rescale']);
                // print "<br> I > Kode " . $kode_dimensi . " Nilai Rescale Dimensi (" . $nama_dimensi . ") tahun " . $tahun . " = " . round($nilai_rescale_dimensi, 2) . "<br>";
                $nilai_rescale_IPI_temp += $nilai_rescale_dimensi;
                //         // echo json_encode($nama_indikator . " Tahun : " . $tahun . " Re-Scale : " . $nilai_rescale_indikator . "<br>");
            }
            $nilai_rescale_IPI = $nilai_rescale_IPI_temp / $jumlah_data_dimensi;
            print "I > Nilai Rescale IPI tahun " . $tahun . " = " . round($nilai_rescale_IPI, 2) . "<br>";
            // die;
        }
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
    public function getDataTahun()
    {
        // $this->db->where('tahun > ', 2012);
        $this->db->where('tahun < ', 2018);
        $result = $this->db->get('tahun')->result_array();
        $tahun = [];
        for ($i = 0; $i < count($result); $i++) {
            array_push($tahun, intval($result[$i]['tahun']));
        }
        return $tahun;
    }
    public function ipi()
    {
        $this->login_check();
        $data = $this->initData();
        $this->load->model('Admin_model', 'admin');
        $data['title'] = 'Indeks Pembangunan Inklusif';
        $data['ipi'] = $this->admin->getIPI();
        $data['dimensi'] = $this->admin->getDimensi();
        for ($i = 0; $i < count($data['dimensi']); $i++) {
            $data['dimensi'][$i]['nilai_dimensi'] = $this->admin->getNilaiDimensi($data['dimensi'][$i]['kode_d']);
        }
        $this->loadTemplate($data);
        $this->load->view('menu/ipi', $data);
        $this->load->view('templates/footer');
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
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(1);
                $data['indikator'] = $this->admin->getIndikator(1);
                $link = "sd_II";
            } else if ($subDimensi == "iae") {
                $data['title2'] = 'Indeks Aktivitas Ekonomi';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(2);
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
            $data['nilai_dimensi'] = $this->admin->getNilaiDimensi(1);
            $data['subDimensi'] = $this->admin->getSubDimensi(1);
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi($data['subDimensi'][$i]['kode_sd']);
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
            $data['nilai_dimensi'] = $this->admin->getNilaiDimensi(2);
            $data['subDimensi'] = $this->admin->getSubDimensi(2);
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi($data['subDimensi'][$i]['kode_sd']);
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
            $data['nilai_dimensi'] = $this->admin->getNilaiDimensi(3);
            $data['subDimensi'] = $this->admin->getSubDimensi(3);
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi($data['subDimensi'][$i]['kode_sd']);
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
