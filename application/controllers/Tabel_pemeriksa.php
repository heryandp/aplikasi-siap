<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabel_pemeriksa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tabel_pemeriksa_model');
        $this->load->library('form_validation');
        $this->load->model('ion_auth_model');
        $this->load->library('ion_auth');
        if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->load->view('tabel_pemeriksa/list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Tabel_pemeriksa_model->json();    
    }
}