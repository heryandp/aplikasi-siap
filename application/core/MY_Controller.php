<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->userdata = $this->session->userdata('userdata');
        $this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));
    }
    public function check_login()
    {
        // pengecekan jika tidak ada email dari session maka diarahkan untuk login
        if (!$this->session->userdata('is_login')) {
            redirect('auth/login');
        }
    }
}