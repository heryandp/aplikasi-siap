<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grab_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function namawp($npwp)
    {
        $this->db->select('nama');
        $query = $this->db->get_where('tabel_mfwp',['npwp' => $npwp])->row();
        return $query;
    }

    public function getkode($kode)
    {
        $this->db->select('ket');
        $query = $this->db->get_where('tabel_kode',['kode' => $kode])->row();
        return $query;
    }

    function jsonkode() {
        $this->datatables->select('kode,ket,durasi');
        $this->datatables->from('tabel_kode');
        return $this->datatables->generate();
    }

    function jsonuser() {
        $this->datatables->select('email,first_name,last_name,active');
        $this->datatables->from('users');
        return $this->datatables->generate();
    }

    function jsonsp2()
    {
        $this->datatables->select('tabel_sp2.id,tabel_sp2.idKasus,tabel_mfwp.npwp,nama,np2,kode,no,tgl,CONCAT(bln1,thn1,"-",bln2,thn2) as masa');
        $this->datatables->join('tabel_dafnom',' tabel_sp2.idKasus = tabel_dafnom.idKasus');
        $this->datatables->join('tabel_mfwp','tabel_dafnom.npwp = tabel_mfwp.npwp');
        $this->datatables->from('tabel_sp2');
        return $this->datatables->generate();
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

     // get data dropdown
    function dropdown_pemeriksa()
    {
        // ambil data dari db
        $this->db->select('id,pemeriksa_nip,pemeriksa_nama,pemeriksa_ip');
        $this->db->order_by('pemeriksa_nama', 'asc');
        $result = $this->db->get('tabel_pemeriksa');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Pilih Pemeriksa';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->pemeriksa_ip] = $row->pemeriksa_ip.' - '.$row->pemeriksa_nama;
            }
        }
        return $dd;
    }

    //NOTA DINAS
    function dropdown_seksi($surat)
    {
        // ambil data dari db
        $this->db->select('kode,ket');
        $this->db->order_by('kode', 'asc');
        $result = $this->db->get('seksi');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        // $dd[''] = 'Pilih Seksi';
        if ($result->num_rows() > 0) {
            if ($surat == 'keluar') {
                foreach ($result->result() as $row) {
                // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                    $dd[$row->ket] = $row->ket;
                }
            } else {
                foreach ($result->result() as $row) {
                // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                    $dd[$row->kode] = $row->ket;
                }
            }
        }
        return $dd;
    }

    public function seksi()
    {
        return $this->db->get('seksi')->result();
    }

}
