<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard1 extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard');
		$this->load->model('ion_auth_model');
		$this->load->library('ion_auth');
		if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
	}

	public function index()
	{
		$data = array(
			'total_dafnom' => $this->dashboard->total_dafnom('tabel_dafnom'),
			'total_sp2' => $this->dashboard->total_dafnom('tabel_sp2'),
			'total_pemeriksa' => $this->dashboard->total('tabel_pemeriksa'),
			'total_fpp' => $this->dashboard->total('tabel_pemeriksa', 'fpp'),
			'total_ppp' => $this->dashboard->total('tabel_pemeriksa', 'ppp'),
			'total_suratmasuk' => $this->dashboard->total('tabel_suratmasuk'),
			'total_suratkeluar' => $this->dashboard->total('tabel_suratkeluar'),
			'total_user' => $this->dashboard->total('users')
		);
		
		$this->load->view('dashboard1',$data);
	}
}
