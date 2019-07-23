<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'IPI APPS Login';
            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        // Cek ketersediaan user
        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                $this->session->set_userdata('username', $username);
                redirect('admin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah !</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak terdaftar !</div>');
            redirect('auth');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('username');

        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Logout berhasil</div>');
        redirect('auth');
    }


    public function blocked()
    {
        $this->load->view('error403');
    }
}