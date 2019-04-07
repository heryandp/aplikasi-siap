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
        );
        $this->load->view('tabel_suratmasuk/list',$data);
    } 
    
    public function json() {
            header('Content-Type: application/json');
            echo $this->Tabel_suratmasuk_model->json();
    }

     public function jsontugas() {
            header('Content-Type: application/json');
            $pelaksana = $this->session->userdata('emailbro');
            echo $this->Tabel_suratmasuk_model->jsontugas($pelaksana);
    }

    public function nomorsurat()
    {
        $row = $this->Tabel_suratmasuk_model->get_no_surat();
        if ($row < 1) {
            echo '1'.'/RIK/'.date('Y');
        } else {
            $row2 = $row+1;
            echo $row2.'/RIK/'.date('Y');
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Buat',
            'action' => site_url('tabel_suratmasuk/create_action'),
            'id' => set_value('id'),
            'pembuat' => set_value('pembuat'),
            'no' => set_value('no'),
            'nosekre' => set_value('nosekre'),
            'tglsuratsekre' => set_value('tglsuratsekre'),
            'nosurat' => set_value('nosuratsekre'),
            'asalsuratsekre' => set_value('asalsuratsekre'),
            'hal' => set_value('hal'),
            'dd_seksi' => $this->Grab_model->dropdown_seksi('masuk'),
            'seksi_selected' => $this->input->post('asalsuratseksi') ? $this->input->post('asalsuratseksi') : '',
    );
        $this->load->view('tabel_suratmasuk/form', $data);
    }
    
    public function create_action() 
    {
        $data = array(
                    'no' => $this->input->post('no',TRUE),
                    'no_sekre' => $this->input->post('nosekre',TRUE),
                    'no_surat' => $this->input->post('nosurat',TRUE),
                    'tgl_surat' => $this->input->post('tglsurat',TRUE),
                    'hal_surat' => $this->input->post('hal',TRUE),
                    'seksi' => $this->input->post('asalsuratseksi',TRUE),
                    'pembuat' => $this->input->post('pembuat',TRUE),
                    'asal_surat' => $this->input->post('asalsuratsekre',TRUE),
            );
    
        //Insert ke tabel_suratmasuk
        $this->Tabel_suratmasuk_model->insert($data);

        //Redirect ke list
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <i class="icon fa fa-check"></i>Sukses menambahkan data</div>');
        redirect(site_url('tabel_suratmasuk'));
    
    }

     public function update($id) 
    {
            $surat = array(
                    'no_sekre' => $this->input->post('editnosekre',TRUE),
                    'no_surat' => $this->input->post('editnosurat',TRUE),
                    'tgl_surat' => $this->input->post('edittglsurat',TRUE),
                    'hal_surat' => $this->input->post('edithal',TRUE),
                    'asal_surat' => $this->input->post('editasalsuratsekre',TRUE),
                );
            $dispo = array(
                    'seksi' => $this->input->post('editasalsuratseksi',TRUE),
            );
            //Update ke tabel_suratmasuk
            $this->Tabel_suratmasuk_model->update($id,$surat,$dispo);

            // Redirect ke list
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Sukses mengubah data</div>');
            redirect(site_url('tabel_suratmasuk'));
    }

    public function dispo() 
    {
        if ($this->uri->segment('3') == 'add'){
            if (!$this->uri->segment('4')) {
                redirect(site_url('tabel_suratmasuk'));
            } else {
            $data = array(
                    'id_surat_masuk' => $this->uri->segment('4'),
                    'sifat' => $this->input->post('dispo-sifat'),
                    'pelaksana' => $this->input->post('dispo-pelaksana'),
                    'keterangan' => $this->input->post('dispo-keterangan'),
                    'catatan' => $this->input->post('dispo-catatan'),
            );
            $this->Tabel_suratmasuk_model->add_dispo($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Sukses membuat disposisi</div>');
            redirect(site_url('tabel_suratmasuk'));
            }
        } else {
            redirect(site_url('tabel_suratmasuk'));
        }
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
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-ban"></i>Record berhasil dihapus</div>');
                redirect(site_url('tabel_suratmasuk'));
            } else {
               $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-ban"></i>Record tidak dapat dihapus</div>');
                redirect(site_url('tabel_suratmasuk'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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