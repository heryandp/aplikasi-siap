<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

    public function list_user()
    {
    	$this->db->select('first_name,last_name,email');
    	$this->db->order_by('created_on asc','first_name desc');
    	return $this->db->get('users')->result();
    }

    public function delete_user($email)
    {
    	$this->db->where('email', $email);
    	$this->db->delete('users');
    }

}

/* End of file Konfigurasi_model.php */
/* Location: ./application/models/Konfigurasi_model.php */