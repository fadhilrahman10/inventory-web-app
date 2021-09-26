<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('inventory_model');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('admin');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // success validation
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $admin = $this->db->get_where('admin', ['email' => $email])->row_array();

        // jika usernya ada
        if ($admin != NULL) {
            // cek password
            if (password_verify($password, $admin['password'])) {
                $data = [
                    'email' => $admin['email'],
                ];
                $this->session->set_userdata($data);
                redirect('admin');
                // salah password
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password! </div>');

                redirect('auth/index');
            }
            // email belom diregistrasi
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered. Create an account before! </div>');

            redirect('auth/index');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('admin');
        }
        $data['id'] = $this->inventory_model->admin_id();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[admin.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont matches',
            'min_length' => 'Password too short'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $this->inventory_model->add_admin();
        }
    }

    public function logout()
    {

        $this->session->unset_userdata('id_admin');
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">You have been logout</div>');
        redirect('auth/index');
    }
}
