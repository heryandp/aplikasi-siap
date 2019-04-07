<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tabel_suratmasuk_model');
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
			'proses' => $this->Tabel_suratmasuk_model->info_user('1'),
            'selesai' => $this->Tabel_suratmasuk_model->info_user('0'),
		);
		$this->load->view('user/tugas',$data);
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */