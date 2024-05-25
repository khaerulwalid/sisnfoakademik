<?php

 class Dashboard extends CI_Controller
{
    public function index() {

        if($this->session->userdata('level_id') != 2) {
            redirect('administrator/auth/login');
        }

        $data['title'] = 'Dashboard';
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('administrator/dashboard');
        $this->load->view('templates_admin/footer');
    }
}
