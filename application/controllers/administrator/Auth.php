<?php

class Auth extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        // Load User_model
        $this->load->model('Login_model');
    }

    public function index() {
        $this->load->view('templates_admin/header');
        $this->load->view('administrator/login');
        $this->load->view('templates_admin/footer');
    }

    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Mengkustomisasi pesan error
        $this->form_validation->set_message('required', '{field} harus diisi.');
        $this->form_validation->set_message('valid_email', '{field} harus berupa email yang valid.');
        $this->form_validation->set_message('is_unique', '{field} email ini sudah digunakan');

        if($this->form_validation->run() == false) {
            $this->load->view('templates_admin/header');
            $this->load->view('administrator/login');
            $this->load->view('templates_admin/footer');
        } else {
            $email = $this->input->post('email');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $checkLogin = $this->Login_model->login($email, $password);

            if($checkLogin) {
                foreach($checkLogin as $check) {
                    $session_data = [
                        "full_name" => $check->full_name,
                        "email" => $check->email,
                        "level_id" => $check->level_id
                    ];
                }

                $this->session->set_userdata($session_data);

                if($session_data["level_id"] == 1) {
                    redirect('administrator/dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Sorry, username or password is invalid!');
                    
                    redirect('administrator/auth');
                }
            } else {
                $this->session->set_flashdata('error', 'Sorry, username or password is invalid!');
                redirect('administrator/auth');
            }
        }
    }
}
