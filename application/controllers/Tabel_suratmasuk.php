<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class tabel_suratmasuk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tabel_suratmasuk_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
        $this->load->model('ion_auth_model');
        $this->load->model('Grab_model');
        $this->load->library('ion_auth');
        if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $now = date('Y-m-d');
        $data = array(
            'proses' => $this->Tabel_suratmasuk_model->info('tabel_suratdispo','proses','1'),
            'selesai' => $this->Tabel_suratmasuk_model->info('tabel_suratdispo','proses','0'),
            'unassign' => $this->Tabel_suratmasuk_model->info('tabel_suratdispo','pelaksana','-'),
            'pelaksana' => $this->Tabel_suratmasuk_model->pelaksana(),
            'seksi' => $this->Grab_model->seksi(),
            'dd_seksi' => $this->Grab_model->dropdown_seksi('masuk'),
            'seksi_selected' => $this->input->post('asalsuratseksi') ? $this->input->post('asalsuratseksi') : '',
        );
        $this->load->view('tabel_suratmasuk/list',$data);
    } 
    
    public function json() {
        // ob_start('ob_gzhandler');
        header('Content-Type: application/json');
        echo $this->Tabel_suratmasuk_model->json('list',0);
    }

    public function json_edit($id) {
        header('Content-Type: application/json');
        echo $this->Tabel_suratmasuk_model->json('edit',$id);
    }

    public function jsontugas() {
            header('Content-Type: application/json');
            $pelaksana = $this->session->userdata('emailbro');
            echo $this->Tabel_suratmasuk_model->jsontugas($pelaksana);
    }

    public function create_action() 
    {
        $row = $this->Tabel_suratmasuk_model->get_no_surat();
        if ($row < 1) {
            $no = '1'.'/RIK/'.date('Y');
        } else {
            $row2 = $row+1;
            $no = $row2.'/RIK/'.date('Y');
        }

        $data = array(
                    'no' => $no,
                    'no_sekre' => $this->input->post('nosekre',TRUE),
                    'no_surat' => $this->input->post('nosurat',TRUE),
                    'tgl_surat' => $this->input->post('tglsurat',TRUE),
                    'hal_surat' => $this->input->post('hal',TRUE),
                    'seksi' => $this->input->post('asalsuratseksi',TRUE),
                    'pembuat' =>  $this->session->userdata('fullname'),
                    'asal_surat' => $this->input->post('asalsuratsekre',TRUE),
            );
    
        //Insert ke tabel_suratmasuk
        $this->Tabel_suratmasuk_model->insert($data);

        //Redirect ke list
        redirect(site_url('tabel_suratmasuk'));
    
    }

    public function update() 
    {
            $id = $this->input->post('id_surat',TRUE);
            $surat = array(
                    'no_sekre' => $this->input->post('nosekre',TRUE),
                    'no_surat' => $this->input->post('nosurat',TRUE),
                    'tgl_surat' => $this->input->post('tglsurat',TRUE),
                    'hal_surat' => $this->input->post('hal',TRUE),
                    'asal_surat' => $this->input->post('asalsuratsekre',TRUE),
                );
            $dispo = array(
                    'seksi' => $this->input->post('asalsuratseksi',TRUE),
            );
            
            //Update ke tabel_suratmasuk
            $this->Tabel_suratmasuk_model->update($id,$surat,$dispo);

            redirect(site_url('tabel_suratmasuk'));
    }

    public function dispo() 
    {
        $id = $this->input->post('dispo-id');
        $data = array(
                'id_surat_masuk' => $id,
                'sifat' => $this->input->post('dispo-sifat',TRUE),
                'pelaksana' => $this->input->post('dispo-pelaksana',TRUE),
                'keterangan' => $this->input->post('dispo-keterangan',TRUE),
                'catatan' => $this->input->post('dispo-catatan',TRUE),
            );
        $this->Tabel_suratmasuk_model->add_dispo($data);

        echo $id;
    }

    public function dispo_cetak($id)
    {
        $data['cetak'] = $this->Tabel_suratmasuk_model->get_dispo($id);
        $data['pelaksana'] = $this->Tabel_suratmasuk_model->pelaksana();
        $this->load->view('template/cetak/dispo',$data);
    }
    
    public function delete($id) 
    {
        $row = $this->Tabel_suratmasuk_model->get_by_id($id);
        $last = $this->Tabel_suratmasuk_model->lastsurat();

        if ($row) {
            if ($row->no == $last->no) {
                $this->Tabel_suratmasuk_model->delete($id);
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>Record berhasil dihapus</div>');
                redirect(site_url('tabel_suratmasuk'));
            } else {
               $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>Record tidak dapat dihapus</div>');
                redirect(site_url('tabel_suratmasuk'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>Record tidak ditemukan</div>');
                redirect(site_url('tabel_suratmasuk'));
        }

    }

    public function done($id)
    {
        $this->Tabel_suratmasuk_model->done($id);
        redirect(site_url('user'));
    }

}