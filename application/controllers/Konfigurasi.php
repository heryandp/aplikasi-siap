<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ion_auth_model');
		$this->load->library('ion_auth');
		$this->load->model('Konfigurasi_model');
		if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
	}

	public function index()
	{
		$this->load->view('konfigurasi/umum');
	}

	public function user()
	{
		$data['user'] = $this->Konfigurasi_model->list_user();
		$this->load->view('konfigurasi/user',$data);
	}

	public function user_delete($email)
	{
		$users = $this->session->userdata('emailbro');
		$cek_users = $this->ion_auth_model->getnama($email);

		if ($this->ion_auth->is_admin()) {
			if ($cek_users) {
				if ($email == $users) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
		            <i class="icon fa fa-check"></i>Tidak bisa menghapus diri sendiri!</div>');
				} else {
					$this->Konfigurasi_model->delete_user($email);
			        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
			            <i class="icon fa fa-check"></i>User berhasil dihapus</div>');
				}
			} else {
				 $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
			            <i class="icon fa fa-check"></i>Nampaknya terjadi kesalahan</div>');
			}
		} else {
			 $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
			            <i class="icon fa fa-check"></i>Hanya Administrator yang dapat melakukan ini Ferguso!</div>');
		}
	        redirect(site_url('konfigurasi/user'));
	}
}

/* End of file Konfigurasi.php */
/* Location: ./application/controllers/Konfigurasi.php */