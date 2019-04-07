<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Model {

	public function total($tabel, $role = null)
	{
		
		$this->db->select('id');
		if ($role) {
			return $this->db->get_where($tabel, ['pemeriksa_role' => $role])->num_rows();
		} else {
			return $this->db->get($tabel)->num_rows();
		}
	}

	public function total_dafnom($tabel)
	{
		$this->db->select('idKasus');
		return $this->db->get($tabel)->num_rows();
	}

}

/* End of file Dashboard.php */
/* Location: ./application/models/Dashboard.php */