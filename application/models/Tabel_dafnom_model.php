<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabel_dafnom_model extends CI_Model
{

    public $table = 'tabel_dafnom';
    public $id = 'idKasus';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select("idKasus,np2,kode,tabel_mfwp.nama,tabel_dafnom.npwp,CONCAT(bln1,thn1,'-',bln2,thn2) as masa,tglsptlb");
        $this->datatables->from('tabel_dafnom');
        $this->datatables->join('tabel_mfwp', 'tabel_dafnom.npwp = tabel_mfwp.npwp');
        $this->datatables->add_column('action', '<i id=$1 style="color: #337ab7;" class="lihat fa fa-eye" data-toggle="modal" data-target="#myModal"></i>'." | ".anchor(site_url('tabel_dafnom/update/$1'),'<i class="fa fa-pencil-square-o"></i>')." | ".anchor(site_url('tabel_dafnom/delete/$1'),'<i class="fa fa-trash"></i>','onclick="javasciprt: return confirm(\'Anda yakin menghapus record ini ?\')"'), 'idKasus');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->join('tabel_mfwp', 'tabel_mfwp.npwp = tabel_dafnom.npwp', 'left');
        return $this->db->get($this->table)->row();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    //List Kode
    function listkode()
    {
        $this->db->select('kode');
        return $this->db->get('tabel_kode')->row();
    }

    // SP2
    function tambahsp2($sp2,$pemeriksa)
    {
        $this->db->insert('tabel_sp2',$sp2);
        $this->db->insert_batch('tabel_sp2_pemeriksa', $pemeriksa);
    }

    function detil_case($idkasus)
    {
        $this->db->select('tabel_dafnom.*,ket,tabel_mfwp.nama');
        $this->db->join('tabel_mfwp', 'tabel_dafnom.npwp = tabel_mfwp.npwp', 'left');
        $this->db->join('tabel_kode', 'tabel_dafnom.kode = tabel_kode.kode', 'left');
        $this->db->where('idKasus', $idkasus);
        return $this->db->get('tabel_dafnom')->row();
    }

    function detil_pemeriksa($idkasus)
    {
        
        $this->db->join('tabel_pegawai', 'tabel_pegawai.ip = tabel_sp2_pemeriksa.pemeriksa', 'left');
        $this->db->join('tabel_dafnom', 'tabel_sp2_pemeriksa.idKasus = tabel_dafnom.idKasus', 'left');
        $this->db->join('tabel_pemeriksa', 'tabel_sp2_pemeriksa.pemeriksa = tabel_pemeriksa.pemeriksa_ip', 'left');
        $this->db->where('tabel_sp2_pemeriksa.idKasus', $idkasus);
        $this->db->order_by('role', 'desc');
        return $this->db->get('tabel_sp2_pemeriksa')->result();
    }


}
