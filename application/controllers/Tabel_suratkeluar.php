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
        $this->load->library('ion_auth');
        $this->load->model('ion_auth_model');
        $this->load->model('Grab_model');
        if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
    }

    public function index()
    {
         $data = array(
            // 'dd_case' => $this->Tabel_suratkeluar_model->dropdown_case(),
            'case_selected' => $this->input->post('case') ? $this->input->post('case') : '',
            'dd_seksi' => $this->Grab_model->dropdown_seksi('keluar'),
            'seksi_selected' => $this->input->post('case') ? $this->input->post('seksi') : '',
        );

        $this->load->view('tabel_suratkeluar/list',$data);
    } 

    public function get_no_surat($jenis)
    {
        $row = $this->Tabel_suratkeluar_model->get_no_surat($jenis);
        if ($row < 1) {
            if ($jenis == 'ND') {
                $no = 'ND-1/WPJ.05/KP.0205/'.date('Y');
            } elseif ($jenis == 'NDRIK') {
                $no = 'ND-1.RIK/WPJ.05/KP.0205/'.date('Y');
            } else {
                $no = 'BA-1/WPJ.05/KP.0205/'.date('Y');
            }
        } else {
            $rows = $row+1;
            if ($jenis == 'ND') {
                $no = 'ND-'.$rows.'/WPJ.05/KP.0205/'.date('Y');
            } elseif ($jenis == 'NDRIK') {
                $no = 'ND-'.$rows.'.RIK/WPJ.05/KP.0205/'.date('Y');
            } else {
                $no = 'BA-'.$rows.'/WPJ.05/KP.0205/'.date('Y');
            }
        }
    }
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tabel_suratkeluar_model->json('list',0);
    }

    public function jsonndrik() {
        header('Content-Type: application/json');
        echo $this->Tabel_suratkeluar_model->jsonndrik();
    }

    public function jsoncase($q)
    {
        echo $this->Tabel_suratkeluar_model->dropdown_case($q);
    }

    public function create_action() 
    {   
        $jenis = $this->input->post('jenis');
        $row = $this->Tabel_suratkeluar_model->get_no_surat($jenis);
        if ($row < 1) {
            $rows = sprintf('%04d',1);
            if ($jenis == 'ND') {
                $no = 'ND-'.$rows.'/WPJ.05/KP.0205/'.date('Y');
            } elseif ($jenis == 'NDRIK') {
                $no = 'ND-'.$rows.'.RIK/WPJ.05/KP.0205/'.date('Y');
            } else {
                $no = 'BA-'.$rows.'/WPJ.05/KP.0205/'.date('Y');
            }
        } else {
            $rows = sprintf('%04d',$row+1);
            if ($jenis == 'ND') {
                $no = 'ND-'.$rows.'/WPJ.05/KP.0205/'.date('Y');
            } elseif ($jenis == 'NDRIK') {
                $no = 'ND-'.$rows.'.RIK/WPJ.05/KP.0205/'.date('Y');
            } else {
                $no = 'BA-'.$rows.'/WPJ.05/KP.0205/'.date('Y');
            }
        }

        // $thn = explode('-', date('Y-m-d'));
        $data = array(
                    'jenis' => $this->input->post('jenis',TRUE),
                    'nomor' => $no,
                    'tgl' => date('Y-m-d'),
                    'thn' => date('Y'),
                    'tujuan' => implode(", ",$this->input->post('tujuan',TRUE)),
                    'case' => $this->input->post('case',TRUE),
                    'hal' => $this->input->post('hal',TRUE),
                    'ket' => $this->input->post('ket',TRUE),
                    'pembuat' => $this->session->userdata('fullname'),
	    );

        $this->Tabel_suratkeluar_model->insert($data);

        redirect(site_url('tabel_suratkeluar'));
    }
    
    public function json_edit($id) {
        header('Content-Type: application/json');
        echo $this->Tabel_suratkeluar_model->json('edit',$id);
    }

    public function update() 
    {
        $id = $this->input->post('id_surat',TRUE);
        $data = array(
                    'tujuan' => implode(", ",$this->input->post('tujuan',TRUE)),
                    'hal' => $this->input->post('hal',TRUE),
                    'ket' => $this->input->post('ket',TRUE),
                );

        $this->Tabel_suratkeluar_model->update($id,$data);
        
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

    //Nota Dinas

    //Nota Dinas ND RIK
    public function ndrik()
    {
        $data = array(
                        'selesai' => $this->Tabel_suratkeluar_model->count_ndrik('0'),
                        'proses' => $this->Tabel_suratkeluar_model->count_ndrik('1'),
                        'batal' => $this->Tabel_suratkeluar_model->count_ndrik('2'),
        );
        // var_dump($data);
        $this->load->view('tabel_suratkeluar/nd/ndrik/list',$data);
    }

    //Proses ND RIK
    public function ndrik_proses()
    {
        $id = $this->input->post('id-ndrik',TRUE);
        $data = array(
                'status' => $this->input->post('status-nd',TRUE),
                'tgl_kembali'  => $this->input->post('tgl-kembali',TRUE),
        );

       $this->Tabel_suratkeluar_model->update_ndrik($id,$data);
       //Refresh
       redirect(site_url('tabel_suratkeluar/ndrik'));
    }

}