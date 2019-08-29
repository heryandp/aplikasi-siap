<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Monitoring_model');
		$this->load->model('Tabel_suratmasuk_model');
		$this->load->model('ion_auth_model');
		$this->load->library('ion_auth');
		if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
	}

	public function json_npwp($kode)
	{
		ob_start('ob_gzhandler');
		echo $this->Monitoring_model->json_npwp($kode);
	}
	public function npwp()
	{
		$this->load->view('monitoring/npwp/list');
	}

	public function npwp_tambah()
	{
		$explode_tgl = explode('-', $_POST['tgl-bps']);
		$np2 = '5321.01'.substr($explode_tgl[0], 2).$explode_tgl[1].substr($explode_tgl[0], 2).'.'.$_POST['npwp'];
		$data = array(
			'np2' => $np2,
			'kode' => '5321',
			'npwp' => $_POST['npwp'],
			'nama' => $_POST['nama'],
			'usulan' => $_POST['no-bps'],
			'tgl_usulan' => $_POST['tgl-bps'],
			'alasan' => $_POST['alasan'],
			'telepon' => $_POST['telepon'],
			'bln1' => '01',
			'thn1' => $explode_tgl[0],
			'bln2' => $explode_tgl[1],
			'thn2' => $explode_tgl[0],
		);

		$this->Monitoring_model->npwp('tambah',$data);
		redirect('monitoring/npwp','refresh');
	}

	public function npwp_hapus($id)
	{
		$data = $id;
		$this->Monitoring_model->npwp('hapus',$data);
		redirect('monitoring/npwp','refresh');
	}

	public function npwp_hasil($id)
	{
		$data = array(
				'id' => $id,
				'hasil' => $_POST['hasil']
		);
		$this->Monitoring_model->npwp('hasil',$data);
		redirect('monitoring/npwp','refresh');
	}

	public function dispo_cetak($id)
    {
        $data['cetak'] = $this->Monitoring_model->get_dispo($id);
        // var_dump($data['cetak']->nama);
        $data['pelaksana'] = $this->Tabel_suratmasuk_model->pelaksana();
        $this->load->view('template/cetak/dispo_hapus',$data);

    }

	public function pkp()
	{
		$this->load->view('monitoring/pkp/list');
	}
}
