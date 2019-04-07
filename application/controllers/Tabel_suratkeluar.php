<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class tabel_suratkeluar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tabel_suratkeluar_model');
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
        $this->load->view('tabel_suratkeluar/list');
    } 

    public function get_no_surat($jenis)
    {
        $row = $this->Tabel_suratkeluar_model->get_no_surat($jenis);
        if ($row < 1) {
            if ($jenis == 'ND') {
                echo 'ND-1/WPJ.05/KP.0205/'.date('Y');
            } elseif ($jenis == 'NDRIK') {
                echo 'ND-1.RIK/WPJ.05/KP.0205/'.date('Y');
            } else {
                echo 'BA-1/WPJ.05/KP.0205/'.date('Y');
            }
        } else {
            $rows = $row+1;
            if ($jenis == 'ND') {
                echo 'ND-'.$rows.'/WPJ.05/KP.0205/'.date('Y');
            } elseif ($jenis == 'NDRIK') {
                echo 'ND-'.$rows.'.RIK/WPJ.05/KP.0205/'.date('Y');
            } else {
                echo 'BA-'.$rows.'/WPJ.05/KP.0205/'.date('Y');
            }
        }
    }
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tabel_suratkeluar_model->json();
    }

    public function jsonndrik() {
        header('Content-Type: application/json');
        echo $this->Tabel_suratkeluar_model->jsonndrik();
    }

    public function create() 
    {
        $data = array(
            'button' => 'Buat',
            'action' => site_url('tabel_suratkeluar/create_action'),
    	    'id' => set_value('id'),
            'jenis' => set_value('jenis'),
            'nomor' => set_value('nomor'),
            'tgl' => set_value('tgl'),
            'tgl' => set_value('tgl'),
            'tujuan' => set_value('tujuan'),
            'hal' => set_value('hal'),
            'ket' => set_value('ket'),
            'pembuat' => set_value('pembuat'),
            'dd_case' => $this->Tabel_suratkeluar_model->dropdown_case(),
            'case_selected' => $this->input->post('case') ? $this->input->post('case') : '',
            'dd_seksi' => $this->Grab_model->dropdown_seksi('keluar'),
            'seksi_selected' => $this->input->post('case') ? $this->input->post('seksi') : '',
	);
        $this->load->view('tabel_suratkeluar/form', $data);
    }
    
    public function create_action() 
    {
        $thn = explode('/', $this->input->post('tgl'));
        $data = array(
                    'jenis' => $this->input->post('jenis',TRUE),
                    'nomor' => $this->input->post('nomor',TRUE),
                    'tgl' => $this->input->post('tgl',TRUE),
                    'thn' => $thn[2],
                    'tujuan' => implode(", ",$this->input->post('tujuan',TRUE)),
                    'case' => $this->input->post('case',TRUE),
                    'hal' => $this->input->post('hal',TRUE),
                    'ket' => $this->input->post('ket',TRUE),
                    'pembuat' => $this->input->post('pembuat',TRUE),
	    );

        $this->Tabel_suratkeluar_model->insert($data);

        //Redirect list
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <i class="icon fa fa-check"></i>Sukses menambahkan data</div>');
        redirect(site_url('tabel_suratkeluar'));
    }
    
    public function update($id) 
    {
      $data = array(
            'tujuan' => $this->input->post('edit-tujuan',TRUE),
            'hal' => $this->input->post('edit-hal',TRUE),
            'ket' => $this->input->post('edit-keterangan',TRUE),
      );

      $this->Tabel_suratkeluar_model->update($id,$data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">
                <i class="icon fa fa-check"></i>Sukses mengubah data</div>');
      redirect(site_url('tabel_suratkeluar'));
    }
    
    public function delete($id) 
    {
        $row = $this->Tabel_suratkeluar_model->get_by_id($id);

        $row_jenis = $this->Tabel_suratkeluar_model->get_no_surat($row->jenis);

        if ($row) {
            if ($row_jenis != 1) {
                $last = $this->Tabel_suratkeluar_model->getlast_no_surat($row_jenis);
                if ($last->nomor == $row->nomor) {
                    $this->Tabel_suratkeluar_model->delete($id);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                    <i class="icon fa fa-ban"></i>Record berhasil dihapus</div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                    <i class="icon fa fa-ban"></i>Record tidak berhasil dihapus</div>');
                }
            } else {
                $this->Tabel_suratkeluar_model->delete($id);
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                    <i class="icon fa fa-ban"></i>Record berhasil dihapus</div>');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>Record tidak ditemukan</div>');
        }

        //Refresh
        redirect(site_url('tabel_suratkeluar'));
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
        $this->form_validation->set_rules('nomor', 'nomor', 'trim|required');
        $this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
        $this->form_validation->set_rules('tujuan', 'tujuan', 'trim|required');
        $this->form_validation->set_rules('hal', 'hal', 'trim');
        $this->form_validation->set_rules('ket', 'ket', 'trim');
        $this->form_validation->set_rules('pembuat', 'pembuat', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        echo '';
    }
        

    //Nota Dinas

    //Nota Dinas ND RIK
    public function ndrik()
    {
        $this->load->view('tabel_suratkeluar/nd/ndrik/list');
    }

    //Proses ND RIK
    public function ndrik_proses($id)
    {
        $data = array(
                'status' => $this->input->post('status-nd',TRUE),
                'tgl_kembali'  => $this->input->post('tgl-kembali',TRUE),
        );
       $this->Tabel_suratkeluar_model->update_ndrik($id,$data);
       //Refresh
        redirect(site_url('tabel_suratkeluar/ndrik'));
    }

}