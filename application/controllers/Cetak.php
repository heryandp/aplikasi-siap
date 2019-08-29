<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cetak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Grab_model');
		$this->load->model('Tabel_dafnom_model');
		$this->load->model('Ion_auth_model');
		$this->load->library('ion_auth');
		if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
	}

	public function index()
	{
		redirect('dashboard1','refresh');
	}

	function tanggal($tanggal)
	{
		$bulan = array (
		1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$pecahkan = explode('-', $tanggal);
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}

	// NOTA DINAS
	public function rencana($id)
	{

		$jenis = 'NDRIK';
		$data['surat'] = $this->Grab_model->suratkeluar($jenis,$id);
		$data['tgl'] = $this->tanggal($data['surat']->tgl);
		$data['masa'] = $data['surat']->bln1.substr($data['surat']->thn1, 2).' '.$data['surat']->bln2.substr($data['surat']->thn2, 2);
		$data['kasi'] = $this->Grab_model->kasi('Kepala Seksi');
		$data['supervisor'] = $this->Grab_model->supervisor($data['surat']->tujuan);
		$this->load->view('template/cetak/rencana',$data);
	}

	//SP2
	public function sp2($idKasus)
	{
		if (!$idKasus) {
			echo 'NULL BRO';
		}

		// Cek Template
		$template = $this->Tabel_dafnom_model->detil_case($idKasus)->template;

		// Data
		$data['sp2'] = $this->Grab_model->sp2($idKasus);
		$data['masa'] = $data['sp2']->bln1.substr($data['sp2']->thn1, 2).' '.$data['sp2']->bln2.substr($data['sp2']->thn2, 2);
		$data['tgl'] = $this->tanggal($data['sp2']->tgl);
		$data['explode'] = explode("-", $data['sp2']->no);
		$data['pemeriksa'] = $this->Tabel_dafnom_model->detil_pemeriksa($idKasus);

		// var_dump($data['pemeriksa']);

		if ($template == 'pemb') {
			$this->load->view('template/cetak/sp2/pemb',$data);
		} else {
			$this->load->view('template/cetak/sp2/pang',$data);
		}
	}
}

/* End of file Cetak.php */
/* Location: ./application/controllers/Cetak.php */