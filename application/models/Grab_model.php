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

    public function kasi($jabatan)
    {
        //ambil ID tabel_jabatan
        $this->db->trans_start();
        $this->db->select('id');
        $this->db->where('jabatan', $jabatan);
        $id = $this->db->get('tabel_jabatan')->row();
        $this->db->trans_complete();

        //ambil nama
        $this->db->select('nama');
        $this->db->where('jabatan', $id->id);
        $this->db->where('seksi', '0205');
        return $this->db->get('tabel_pegawai')->row();
    }
    public function supervisor($jabatan)
    {
        $this->db->trans_start();
        $this->db->select('id');
        $this->db->where('jabatan', $jabatan);
        $id = $this->db->get('tabel_jabatan')->row();
        $this->db->trans_complete();

        $this->db->select('nama');
        $this->db->where('jabatan', $id->id);
        return $this->db->get('tabel_pegawai')->row();
    }

    public function getkode($kode)
    {
        $this->db->select('ket');
        $query = $this->db->get_where('tabel_kode',['kode' => $kode])->row();
        return $query;
    }

    function jsonkode() {
        $this->db->select('kode,ket,durasi');
        $this->datatables->from('tabel_kode');
        return $this->datatables->generate();
    }

    function jsonuser() {
        $this->db->select('email,first_name,last_name,active');
        $this->datatables->from('users');
        return $this->datatables->generate();
    }

    function jsonsp2()
    {
        $this->db->select('tabel_sp2.id,tabel_sp2.idKasus,tabel_mfwp.npwp,nama,np2,kode,no,tgl,CONCAT(bln1,thn1,"-",bln2,thn2) as masa');
        $this->db->join('tabel_dafnom',' tabel_sp2.idKasus = tabel_dafnom.idKasus');
        $this->db->join('tabel_mfwp','tabel_dafnom.npwp = tabel_mfwp.npwp');
        $this->datatables->from('tabel_sp2');
        return $this->datatables->generate();
    }

    function jsonlhp()
    {
        $this->db->select('tabel_sp2.id,tabel_sp2.idKasus,tabel_mfwp.npwp,nama,np2,kode,no,tgl,CONCAT(bln1,thn1,"-",bln2,thn2) as masa,no_lhp,tgl_lhp');
        $this->db->join('tabel_dafnom','tabel_sp2.idKasus = tabel_dafnom.idKasus');
        $this->db->join('tabel_lhp','tabel_lhp.idKasus = tabel_sp2.idKasus');
        $this->db->join('tabel_mfwp','tabel_dafnom.npwp = tabel_mfwp.npwp');
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
        $this->db->select('tabel_pemeriksa.id,nip,nama,pemeriksa_ip');
        $this->db->join('tabel_pegawai', 'tabel_pegawai.ip = tabel_pemeriksa.pemeriksa_ip', 'left');
        $this->db->order_by('nama', 'asc');
        $result = $this->db->get('tabel_pemeriksa');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Pilih Pemeriksa';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->pemeriksa_ip] = $row->pemeriksa_ip.' - '.$row->nama;
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

    // SURAT KELUAR
    public function suratkeluar($jenis,$id)
    {
        if ($jenis = 'NDRIK') {
            $this->db->join('tabel_dafnom', 'tabel_dafnom.idKasus = tabel_suratkeluar_ndrik.idKasus', 'left');
            $this->db->join('tabel_suratkeluar', 'tabel_suratkeluar_ndrik.id_suratkeluar=tabel_suratkeluar.id', 'left');
            $this->db->join('tabel_kode', 'tabel_kode.kode = tabel_dafnom.kode', 'left');
            $this->db->join('tabel_mfwp', 'tabel_mfwp.npwp = tabel_dafnom.npwp', 'left');
            $this->db->where('tabel_suratkeluar_ndrik.id', $id);
            return $this->db->get('tabel_suratkeluar_ndrik')->row();
        }
    }

    // SP2
    public function sp2($idKasus)
    {
        $this->db->select('tabel_sp2.*,tabel_mfwp.nama,CONCAT(tabel_mfwp.alamat,",",tabel_mfwp.kelurahan,",",tabel_mfwp.kecamatan,",",tabel_mfwp.kota) as alamat,tabel_dafnom.*,tabel_kode.ket,tabel_kode.tujuan_pem');
        $this->db->join('tabel_dafnom', 'tabel_sp2.idKasus = tabel_dafnom.idKasus', 'left');
        $this->db->join('tabel_mfwp', 'tabel_mfwp.npwp=tabel_dafnom.npwp', 'left');
        $this->db->join('tabel_kode', 'tabel_kode.kode = tabel_dafnom.kode', 'left');
        $this->db->where('tabel_sp2.idKasus', $idKasus);
        return $this->db->get('tabel_sp2')->row();
    }
}
