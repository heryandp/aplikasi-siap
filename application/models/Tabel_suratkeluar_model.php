<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabel_suratkeluar_model extends CI_Model
{

    public $table = 'tabel_suratkeluar';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,jenis,nomor,tgl,thn,tujuan,hal,ket,pembuat');
        $this->datatables->from('tabel_suratkeluar');
        return $this->datatables->generate();
    }
    function jsonndrik() {
        $this->datatables->select('tabel_suratkeluar_ndrik.id,id_suratkeluar,tabel_suratkeluar.nomor,tabel_suratkeluar.tgl,tabel_suratkeluar_ndrik.idKasus,tabel_dafnom.np2,tabel_dafnom.npwp,tabel_mfwp.nama,tabel_mfwp.alamat,tabel_dafnom.kode,CONCAT(bln1,thn1,"-",bln2,thn2) as masa,tabel_dafnom.tglsptlb,tabel_suratkeluar.tujuan,supervisor,tabel_suratkeluar_ndrik.status,tgl_kembali');
        $this->datatables->from('tabel_suratkeluar_ndrik');
        $this->datatables->join('tabel_suratkeluar','tabel_suratkeluar_ndrik.id_suratkeluar = tabel_suratkeluar.id','left');
        $this->datatables->join('tabel_dafnom','tabel_suratkeluar_ndrik.idKasus = tabel_dafnom.idKasus','left');
        $this->datatables->join('tabel_mfwp','tabel_dafnom.npwp = tabel_mfwp.npwp','left');
        return $this->datatables->generate();
    }
    function json_tugas() {
        $this->datatables->select('id,jenis,nomor,tgl,thn,tujuan,hal,ket,pembuat');
        $this->datatables->from('tabel_suratkeluar');
        $this->datatables->where('pelaksana', 'Heryan Dwiyoga Putra');
        return $this->datatables->generate();
    }

    // get nomor surat
    function get_no_surat($jenis)
    {
        $data = array('jenis' => $jenis);
        return $this->db->get_where($this->table,$data)->num_rows();
    }

    // get nomor surat terakhir
    function getlast_no_surat($jenis)
    {
        $data = array('jenis' => $jenis);
        $this->db->limit(1);
        $this->db->order_by($this->id, 'DESC');
        return $this->db->get($this->table,$data)->row();
    }

    // total surat

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
        return $this->db->get($this->table)->row();
    }

    // get data dropdown
    function dropdown_case()
    {
        // ambil data dari db
        $this->db->select('idKasus, tabel_dafnom.npwp, tabel_mfwp.nama, kode, bln1,thn1,bln2,thn2');
        $this->db->order_by('idKasus', 'asc');
        $this->db->join('tabel_mfwp', 'tabel_dafnom.npwp = tabel_mfwp.npwp', 'left');
        $result = $this->db->get('tabel_dafnom');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Pilih Case / Wajib Pajak';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $masa = $row->bln1.substr($row->thn1,2).'/'.$row->bln2.substr($row->thn2, 2);
                $dd[$row->idKasus] = $row->nama.' - '.$row->kode.' - '.$masa;
            }
        }
        return $dd;
    }

    // insert data
    function insert($data)
    {
        $surat_keluar = array(
            'jenis' => $data['jenis'],
            'nomor' => $data['nomor'],
            'tgl' => $data['tgl'],
            'thn' => $data['thn'],
            'tujuan' => $data['tujuan'],
            'hal' => $data['hal'],
            'ket' => $data['ket'],
            'pembuat' => $data['pembuat'],
        );

        $this->db->trans_start();
        $this->db->insert('tabel_suratkeluar', $surat_keluar);
        $id_surat_keluar = $this->db->insert_id();
        $this->db->trans_complete();

        // Input ke tabel surat keluar nd rik
        if ($data['jenis'] == 'NDRIK') {
            $ndrik = array (
                'id_suratkeluar' => $id_surat_keluar,
                'idKasus' => $data['case'],
            );
            $this->db->insert('tabel_suratkeluar_ndrik', $ndrik);
        };

    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

     // update data
    function update_ndrik($ids, $data)
    {
        $this->db->where('id', $ids);
        $this->db->update('tabel_suratkeluar_ndrik', $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
