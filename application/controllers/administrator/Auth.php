<?php

class Auth extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        // Load User_model
        $this->load->model('Login_model');
        $this->load->model('User_model');
    }

    public function index() {
        $data['title'] = 'Form Login';
        $this->load->view('templates_admin/header', $data);
        $this->load->view('administrator/login');
        $this->load->view('templates_admin/footer');
    }

    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

        // Mengkustomisasi pesan error
        $this->form_validation->set_message('required', '{field} harus diisi.');
        $this->form_validation->set_message('valid_email', '{field} harus berupa email yang valid.');
        $this->form_validation->set_message('is_unique', '{field} email ini sudah digunakan');

        if($this->form_validation->run() == false) {
            $data['title'] = 'Form Login';
            $this->load->view('templates_admin/header', $data);
            $this->load->view('administrator/login');
            $this->load->view('templates_admin/footer');
        } else {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);

            $checkLogin = $this->Login_model->login($email, $password);
            
            if($checkLogin) {

                    var_dump($checkLogin);
                    $session_data = [
                        "full_name" => $checkLogin->full_name,
                        "email" => $checkLogin->email,
                        "level_id" => $checkLogin->level_id
                    ];


                $this->session->set_userdata($session_data);



                if($session_data["level_id"] == 2) {
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

    public function registration() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('full_name', 'Full name', 'required|xss_clean');
        $this->form_validation->set_rules('level_id', 'Level', 'required|xss_clean');

        // Mengkustomisasi pesan error
        $this->form_validation->set_message('required', '{field} harus diisi.');
        $this->form_validation->set_message('valid_email', '{field} harus berupa email yang valid.');
        $this->form_validation->set_message('is_unique', '{field} ini sudah digunakan');

        if($this->form_validation->run() == false) {
            $data['title'] = 'Form Registrasi';
            $this->load->view('templates_admin/header', $data);
            $this->load->view('administrator/registration');
            $this->load->view('templates_admin/footer');
        } else {
            $data = [
                'username' => $this->security->xss_clean($this->input->post('username')),
                'email' => $this->security->xss_clean($this->input->post('email')),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'full_name' => $this->security->xss_clean($this->input->post('full_name')),
                'level_id' => $this->security->xss_clean($this->input->post('level_id')),
            ];

            $this->User_model->saveUser($data);
            $this->session->set_flashdata("message", '<div class="alert alert-primary" role="alert">
            User berhasil ditambahkan
          </div>');

          redirect('administrator/auth');
        }
    }
}
