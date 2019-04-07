<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabel_suratmasuk_model extends CI_Model
{

    public $table = 'tabel_suratmasuk';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('tabel_suratdispo.no,tabel_suratdispo.seksi,tabel_suratdispo.sifat,tabel_pegawai.nama as pelaksana,tabel_suratdispo.keterangan,tabel_suratdispo.catatan,tabel_suratdispo.proses,tabel_suratmasuk.id,tgl_surat,no_surat,no_sekre,seksi.ket,hal_surat,asal_surat');
        $this->datatables->join('tabel_suratdispo', 'tabel_suratmasuk.id = tabel_suratdispo.id_surat_masuk','left');
        $this->datatables->join('tabel_pegawai','tabel_pegawai.ip = tabel_suratdispo.pelaksana','left');
        $this->datatables->join('seksi', 'tabel_suratdispo.seksi = seksi.kode','left');
        $this->datatables->from('tabel_suratmasuk');
        return $this->datatables->generate();
    }

    function jsontugas($pelaksana)
    {
        $this->datatables->select('tabel_suratdispo.no,tabel_suratdispo.seksi,tabel_suratdispo.sifat,tabel_pegawai.nama as pelaksana,tabel_suratdispo.keterangan,tabel_suratdispo.catatan,tabel_suratdispo.proses,tabel_suratmasuk.id,tgl_surat,no_surat,no_sekre,seksi.ket,hal_surat,asal_surat');
        $this->datatables->join('tabel_suratdispo','tabel_suratdispo.id_surat_masuk = tabel_suratmasuk.id');
        $this->datatables->join('tabel_pegawai','tabel_pegawai.ip = tabel_suratdispo.pelaksana','left');
        $this->datatables->join('seksi', 'tabel_suratdispo.seksi = seksi.kode','left');
        $this->datatables->where('pelaksana', $pelaksana);
        $this->datatables->from('tabel_suratmasuk');
        return $this->datatables->generate();
    }

     // get nomor surat
    function get_no_surat()
    {
        return $this->db->get($this->table)->num_rows();
    }

    // Dispo
    function get_dispo($id)
    {
        $this->db->select('id_surat_masuk,seksi,seksi.ket,no,waktu,sifat,pelaksana,keterangan,catatan,tabel_suratmasuk.*');
        $this->db->join('seksi', 'tabel_suratdispo.seksi = seksi.kode', 'left');
        $this->db->join('tabel_suratmasuk', 'tabel_suratmasuk.id=tabel_suratdispo.id_surat_masuk', 'left');
        $this->db->where('id_surat_masuk', $id);
        return $this->db->get('tabel_suratdispo')->row();
    }

    function pelaksana()
    {
        $this->db->where('seksi', '0205');
        $this->db->order_by('nama', 'asc');
        return $this->db->get('tabel_pegawai')->result();
    }

    function add_dispo($data)
    {
        $update = array(
            'sifat' => $data['sifat'],
            'pelaksana' => $data['pelaksana'],
            'keterangan' => $data['keterangan'],
            'catatan' => $data['catatan'],
        );
        
        $this->db->where('id_surat_masuk', $data['id_surat_masuk']);
        $this->db->update('tabel_suratdispo', $update);

    }

    //Info
    public function info($tabel,$field,$kriteria)
    {
        $this->db->where($field, $kriteria);
        return $this->db->get($tabel)->num_rows();
    }

    public function info_user($proses)
    {
        $user = $this->session->userdata('emailbro');
        $this->db->where('proses', $proses);
        $this->db->where('pelaksana', $user);
        return $this->db->get('tabel_suratdispo')->num_rows();
    }

    //Disposisi Selesai
    public function done($id)
    {
        $update = array(
            'proses' => 0,
        );
        $this->db->where('id_surat_masuk', $id);
        $this->db->update('tabel_suratdispo', $update);
    }
    
    // nomor terakhir
    function lastsurat()
    {
        $this->db->limit(1);
        $this->db->order_by($this->id, 'DESC');
        return $this->db->get('tabel_suratdispo')->row();
    }
    // total surat
    function totalsurat()
    {
        return $this->db->get('tabel_suratmasuk')->num_rows();
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
        $this->db->select('tabel_suratmasuk.id,tabel_suratdispo.id,no');
        $this->db->join('tabel_suratdispo', 'tabel_suratdispo.id_surat_masuk = tabel_suratmasuk.id', 'left');
        $this->db->where('id_surat_masuk', $id);
        return $this->db->get($this->table)->row();
    }

    // insert data
    function insert($data)
    {
        $surat_masuk = array(
            'tgl_surat' => $data['tgl_surat'],
            'no_surat' => $data['no_surat'],
            'no_sekre' => $data['no_sekre'],
            'hal_surat' => $data['hal_surat'],
            'asal_surat' => $data['asal_surat']
        );

        $this->db->trans_start();
        $this->db->insert('tabel_suratmasuk', $surat_masuk);
        $id_surat_masuk = $this->db->insert_id();
        $this->db->trans_complete();

        if ($data['seksi']) {
            $dispo = array(
                'id_surat_masuk' => $id_surat_masuk,
                'no' => $data['no'],
                'seksi' => $data['seksi'],
            );
        } else {
            $dispo = array(
                'id_surat_masuk' => $id_surat_masuk,
                'no' => $data['no'],
            );
        }

        $this->db->insert('tabel_suratdispo', $dispo);
    }

    // update data
    function update($id, $surat, $dispo)
    {
        // Update Surat Masuk
        $this->db->where('id', $id);
        $this->db->update('tabel_suratmasuk', $surat);

        // Update Disposisi
        $this->db->where('id_surat_masuk', $id);
        $this->db->update('tabel_suratdispo', $dispo);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
