<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grab extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Grab_model');
		$this->load->model('ion_auth_model');
		$this->load->library('ion_auth');
		if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
	}

	public function namawp($npwp)
	{
		$data = $this->Grab_model->namawp($npwp);
		echo json_encode($data);
	}

	public function supervisor($jabatan)
	{
		echo $this->Grab_model->supervisor($jabatan);
	}

	public function getkode($kode)
	{
		$data = $this->Grab_model->getkode($kode);
		echo json_encode($data);
	}

	public function jsonkode()
	{
		header('Content-Type: application/json');
        echo $this->Grab_model->jsonkode();
	}

	public function jsonsp2()
	{
		header('Content-Type: application/json');
        echo $this->Grab_model->jsonsp2();
	}

	public function jsonlhp()
	{
		header('Content-Type: application/json');
        echo $this->Grab_model->jsonlhp();
	}


}

/* End of file Grab.php */
/* Location: ./application/controllers/Grab.php */