<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

   public function json_npwp($kode)
   {
        if ($kode =='5321') {
          $this->db->select('tabel_dafnom_hapus.idKasus as idKasus2,tabel_dafnom.idKasus,tabel_dafnom_hapus.npwp,tabel_dafnom_hapus.nama,tabel_dafnom_hapus.usulan,tabel_dafnom_hapus.tgl_usulan,tabel_dafnom_hapus.alasan,tabel_dafnom_hapus.telepon,tabel_sp2.no as sp2,tabel_sp2.tgl as tgl_sp2,tabel_lhp.no_lhp as lhp,tabel_dafnom_hapus.hasil');
          $this->db->join('tabel_mfwp', 'tabel_mfwp.npwp = tabel_dafnom_hapus.npwp', 'left');
          $this->db->join('tabel_dafnom', 'tabel_dafnom_hapus.np2 = tabel_dafnom.np2', 'left');
          $this->db->join('tabel_sp2', 'tabel_sp2.idKasus = tabel_dafnom.idKasus', 'left');
          $this->db->join('tabel_lhp', 'tabel_lhp.idKasus = tabel_sp2.idKasus', 'left');
          $this->db->where('tabel_dafnom_hapus.kode', $kode);
          $this->datatables->from('tabel_dafnom_hapus');
          return $this->datatables->generate();
        } else {
          $this->db->select('tabel_dafnom_hapus.idKasus as idKasus2,tabel_dafnom.idKasus,tabel_dafnom_hapus.npwp,tabel_dafnom_hapus.nama,tabel_dafnom_hapus.usulan,tabel_dafnom_hapus.tgl_usulan,tabel_dafnom_hapus.telepon,tabel_sp2.no as sp2,tabel_sp2.tgl as tgl_sp2,tabel_lhp.no_lhp as lhp,tabel_dafnom_hapus.hasil');
          $this->db->join('tabel_mfwp', 'tabel_mfwp.npwp = tabel_dafnom_hapus.npwp', 'left');
          $this->db->join('tabel_dafnom', 'tabel_dafnom_hapus.np2 = tabel_dafnom.np2', 'left');
          $this->db->join('tabel_sp2', 'tabel_sp2.idKasus = tabel_dafnom.idKasus', 'left');
          $this->db->join('tabel_lhp', 'tabel_lhp.idKasus = tabel_sp2.idKasus', 'left');
          $this->db->where('tabel_dafnom_hapus.kode', $kode);
          $this->datatables->from('tabel_dafnom_hapus');
          return $this->datatables->generate();
        }
   }

   public function npwp($fungsi,$data)
   {
       if ($fungsi == 'tambah') {
           $this->db->insert('tabel_dafnom_hapus', $data);
       } else if($fungsi == 'hapus') {
            $this->db->where('idKasus', $data);
            $this->db->delete('tabel_dafnom_hapus');
       } else if($fungsi == 'hasil'){
            $update = array('hasil' => $data['hasil']);
            $this->db->where('idKasus', $data['id']);
            $this->db->update('tabel_dafnom_hapus', $update);
       }
   }

   public function get_dispo($id)
   {
     $this->db->select('tabel_dafnom_hapus.nama,tabel_dafnom_hapus.npwp,alamat,usulan,tgl_usulan');
     $this->db->join('tabel_mfwp','tabel_dafnom_hapus.npwp = tabel_mfwp.npwp','left');
     $this->db->where('idKasus',$id);
     return $this->db->get('tabel_dafnom_hapus')->result();
   }

}

/* End of file Konfigurasi_model.php */
/* Location: ./application/models/Konfigurasi_model.php */