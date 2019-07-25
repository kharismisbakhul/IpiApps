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
        $this->load->model('Admin_model', 'admin');
        $nama_indikator = str_replace("_", " ", $url_nama_indikator);
        $kode_indikator = $this->admin->getKodeIndikator($nama_indikator);
        $this->admin->getNilaiIndikatorJson($kode_indikator, $tahun);
    }

    //Untuk hitung max min nilai
    public function getNilaiIndikatorPerTahun($kode_indikator, $tahun)
    {
        $this->load->model('Admin_model', 'admin');
        $result = $this->admin->getNilaiIndikator($kode_indikator, $tahun);
        return $result;
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
        $indikator = $this->db->get_where('indikator', ['kode_indikator' => $kode_indikator])->row_array();
        $kode_sd = intval($indikator['kode_sd']);
        $max = doubleval($indikator['max_nilai']);
        $min = doubleval($indikator['min_nilai']);
        $status = doubleval($indikator['status']);

        $this->load->model('Admin_model', 'admin');
        $result = $this->db->get_where('nilaiindikator', ['kode_indikator' => $kode_indikator])->result_array();
        $jumlah_data_nilai = count($result);
        echo "Indikator = " . $indikator['nama_indikator'] . "<br>";
        echo "Kode Indikator = " . $kode_indikator . "<br>";
        for ($i = 0; $i < $jumlah_data_nilai; $i++) {
            $tahun = intval($result[$i]['tahun']);
            $nilaiEksisting = doubleval($result[$i]['nilai']);
            $nilai_rescale = 0;
            if ($status == 0) {
                //Rumus (putih) --> ((eksisting sesuai tahun - min)/(max-min))*10 
                $nilai_rescale = (($nilaiEksisting - $min) / ($max - $min)) * 10;
            } else if ($status == 1 && $kode_sd == 4) {
                //Rumus (merah - IPK) --> (((eksisting sesuai tahun - min)/(max-min))*-10)+10 
                $nilai_rescale = ((($nilaiEksisting - $min) / ($max - $min)) * (-10)) + 10;
            } else {
                //Rumus (merah) --> ((max - eksisting sesuai tahun - min)/(max-min))*10 
                $nilai_rescale = (($max - $nilaiEksisting) / ($max - $min)) * 10;
            }
            print "<br>Nilai Rescale tahun " . $tahun . " = " . $nilai_rescale . "<br>";
        }

        // echo json_encode($indikator);
    }

    //Set Nilai rescale Indikator tiap tahun
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

        for ($i = 0; $i < $jumlah_data_indikator; $i++) {
            $kode_indikator = intval($data_indikator[$i]['kode_indikator']);
            $nama_indikator = $data_indikator[$i]['nama_indikator'];
            for ($j = 0; $j < $jumlah_data_tahun; $j++) {
                $tahun = intval($data_tahun[$i]['tahun']);
                $nilai_data_indikator = $this->admin->getNilaiIndikator($kode_indikator, $tahun);
                print "<br> I > Nilai Rescale Indikator (" . $nama_indikator . ") tahun " . $tahun . " = " . $nilai_data_indikator['nilai_rescale'] . "<br>";
            }
        }

        // echo "Indikator = " . $indikator['nama_indikator'] . "<br>";
        // echo "Kode Indikator = " . $kode_indikator . "<br>";
        // for ($i = 0; $i < $jumlah_data_nilai_indikator; $i++) {
        //     $tahun = intval($result[$i]['tahun']);
        //     $nilaiEksisting = doubleval($result[$i]['nilai']);
        //     $nilai_rescale_indikator = doubleval($result[$i]['nilai_rescale']);
        //     $nilai_rescale = 0;
        //     $nilai_rescale += 0;
        //     print "<br> I > Nilai Rescale Indikator tahun " . $tahun . " = " . $nilai_rescale_indikator . "<br>";
        //     print "<br> SD > Nilai Rescale Sub Dimensi tahun " . $tahun . " = " . $nilai_rescale . "<br>";
        // }

        // echo json_encode($jumlah_data_tahun);
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
                $data['title'] = 'Indeks Inflasi';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(1);
                $data['indikator'] = $this->admin->getIndikator(1);
                $link = "sd_II";
            } else if ($subDimensi == "iae") {
                $data['title'] = 'Indeks Aktivitas Ekonomi';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(2);
                $data['indikator'] = $this->admin->getIndikator(2);
                $link = "sd_IAE";
            } else if ($subDimensi == "ipsdm") {
                $data['title'] = 'Indeks Pembangunan Sumberdaya Manusia';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(3);
                $data['indikator'] = $this->admin->getIndikator(3);
                $link = "sd_IPSDM";
            }
            for ($i = 0; $i < count($data['indikator']); $i++) {
                $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
            }
        } else {
            $data['title'] = 'Pertumbuhan Ekonomi';
            $data['nilai_dimensi'] = $this->admin->getNilaiDimensi(1);
            $data['subDimensi'] = $this->admin->getSubDimensi(1);
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi($data['subDimensi'][$i]['kode_sd']);
            }
            $link = "pertumbuhanEkonomi";
        }
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
                $data['title'] = 'Indeks Penanggulangan Kemiskinan';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(4);
                $data['indikator'] = $this->admin->getIndikator(4);
                $link = "sd_IPK";
            } else if ($subDimensi == "ip") {
                $data['title'] = 'Indeks Pemerataan';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(5);
                $data['indikator'] = $this->admin->getIndikator(5);
                $link = "sd_IP";
            }
            for ($i = 0; $i < count($data['indikator']); $i++) {
                $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
            }
        } else {
            $data['title'] = 'Inklusifitas';
            $data['nilai_dimensi'] = $this->admin->getNilaiDimensi(2);
            $data['subDimensi'] = $this->admin->getSubDimensi(2);
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi($data['subDimensi'][$i]['kode_sd']);
            }
            $link = "inklusifitas";
        }
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
            if ($subDimensi == "iku") {
                $data['title'] = 'Indeks Keberlanjutan Keuangan';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(6);
                $data['indikator'] = $this->admin->getIndikator(6);
                $link = "sd_IKU";
            } else if ($subDimensi == "iki") {
                $data['title'] = 'Indeks Keberlanjutan Infrastruktur';
                $data['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi(7);
                $data['indikator'] = $this->admin->getIndikator(7);
                $link = "sd_IKI";
            }
            for ($i = 0; $i < count($data['indikator']); $i++) {
                $data['indikator'][$i]['nilai_indikator'] = $this->admin->getNilaiIndikator($data['indikator'][$i]['kode_indikator']);
            }
        } else {
            $data['title'] = 'Sustainability';
            $data['nilai_dimensi'] = $this->admin->getNilaiDimensi(3);
            $data['subDimensi'] = $this->admin->getSubDimensi(3);
            for ($i = 0; $i < count($data['subDimensi']); $i++) {
                $data['subDimensi'][$i]['nilai_subDimensi'] = $this->admin->getNilaiSubDimensi($data['subDimensi'][$i]['kode_sd']);
            }
            $link = "sustainability";
        }
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
