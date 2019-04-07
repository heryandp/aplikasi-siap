<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabel_dafnom extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tabel_dafnom_model');
        $this->load->model('Grab_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
        $this->load->model('ion_auth_model');
        $this->load->library('ion_auth');
        if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
        

    }

    public function index()
    {
        $this->load->view('tabel_dafnom/list');
    } 
    
    public function json() {
        echo $this->Tabel_dafnom_model->json();
    }

   
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tabel_dafnom/create_action'),
            'usulan' => set_value('usulan'),
            'tgl_usulan' => set_value('tgl_usulan'),
    	    'kode' => set_value('kode'),
    	    'npwp' => set_value('npwp'),
            'nama' => set_value(''),
    	    'bln1' => set_value('bln1'),
    	    'thn1' => set_value('thn1'),
    	    'bln2' => set_value('bln2'),
    	    'thn2' => set_value('thn2'),
    	    'tglsptlb' => set_value('tglsptlb'),
	);
        $this->load->view('tabel_dafnom/form', $data);
    }
    
    public function create_action() 
    {
            $np2 = $this->input->post('kode').'.'.$this->input->post('bln1').substr($this->input->post('thn1'),2).$this->input->post('bln2').substr($this->input->post('thn2'),2).'.'.$this->input->post('npwp');
            $data = array(
                        'np2' => $np2,
                        'usulan' => $this->input->post('usulan',TRUE),
                        'tgl_usulan' => $this->input->post('tgl_usulan',TRUE),
                		'kode' => $this->input->post('kode',TRUE),
                		'npwp' => $this->input->post('npwp',TRUE),
                		'bln1' => $this->input->post('bln1',TRUE),
                		'thn1' => $this->input->post('thn1',TRUE),
                		'bln2' => $this->input->post('bln2',TRUE),
                		'thn2' => $this->input->post('thn2',TRUE),
                		'tglsptlb' => $this->input->post('tglsptlb',TRUE),
	           );

            $this->Tabel_dafnom_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Sukses menambahkan data</div>');
            redirect(site_url('tabel_dafnom'));
    }
    
    public function update($id) 
    {
        $row = $this->Tabel_dafnom_model->get_by_id($id);

        if ($row) {
            $data = array(
                            'button' => 'Update',
                            'action' => site_url('tabel_dafnom/update_action'),
                    		'idKasus' => set_value('idKasus', $row->idKasus),
                    		'kode' => set_value('kode', $row->kode),
                    		'ketkode' => set_value('ketkode', $row->ketkode),
                    		'npwp' => set_value('npwp', $row->npwp),
                            'nama' => set_value('nama', $row->nama),
                    		'bln1' => set_value('bln1', $row->bln1),
                    		'thn1' => set_value('thn1', $row->thn1),
                    		'bln2' => set_value('bln2', $row->bln2),
                    		'thn2' => set_value('thn2', $row->thn2),
                    		'tglsptlb' => set_value('tglsptlb', $row->tglsptlb),
                	    );
                       
            $this->load->view('tabel_dafnom/form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabel_dafnom'));
        }
    }
    
    public function update_action() 
    {
        $np2 = $this->input->post('kode').'.'.$this->input->post('bln1').substr($this->input->post('thn1'),2).$this->input->post('bln2').substr($this->input->post('thn2'),2).'.'.$this->input->post('npwp');
        $data = array(
                    'np2' => $np2,
                    'usulan' => $this->input->post('usulan',TRUE),
                    'tgl_usulan' => $this->input->post('tgl_usulan',TRUE),
                    'kode' => $this->input->post('kode',TRUE),
                    'npwp' => $this->input->post('npwp',TRUE),
                    'bln1' => $this->input->post('bln1',TRUE),
                    'thn1' => $this->input->post('thn1',TRUE),
                    'bln2' => $this->input->post('bln2',TRUE),
                    'thn2' => $this->input->post('thn2',TRUE),
                    'tglsptlb' => $this->input->post('tglsptlb',TRUE),
           );

        $this->Tabel_dafnom_model->update($this->input->post('idKasus', TRUE), $data);
         $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Sukses mengubah data</div>');
        redirect(site_url('tabel_dafnom'));
    }
    
    public function delete($id) 
    {
        $row = $this->Tabel_dafnom_model->get_by_id($id);

        if ($row) {
            $this->Tabel_dafnom_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Record berhasil dihapus</div>');
            redirect(site_url('tabel_dafnom'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Record tidak ditemukan</div>');
            redirect(site_url('tabel_dafnom'));
        }
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tabel_dafnom.xls";
        $judul = "tabel_dafnom";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "NP2");
    	xlsWriteLabel($tablehead, $kolomhead++, "Kode");
    	xlsWriteLabel($tablehead, $kolomhead++, "Ketkode");
    	xlsWriteLabel($tablehead, $kolomhead++, "Npwp");
    	xlsWriteLabel($tablehead, $kolomhead++, "Bln1");
    	xlsWriteLabel($tablehead, $kolomhead++, "Thn1");
    	xlsWriteLabel($tablehead, $kolomhead++, "Bln2");
    	xlsWriteLabel($tablehead, $kolomhead++, "Thn2");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tglsptlb");

	foreach ($this->Tabel_dafnom_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->np2);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->kode);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->ketkode);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->npwp);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->bln1);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->thn1);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->bln2);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->thn2);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tglsptlb);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function sp2()
    {
       $this->load->view('tabel_dafnom/sp2/list');
    }

    public function sp2_tambah()
    {
        $data = array (
            'action' => 'sp2_tambah_action',
            'dd_case' => $this->Grab_model->dropdown_case(),
            'case_selected' => $this->input->post('case') ? $this->input->post('case') : '',
            'dd_pemeriksa' => $this->Grab_model->dropdown_pemeriksa(),
            'pemeriksa_selected' => $this->input->post('pemeriksa') ? $this->input->post('pemeriksa') : '',
        );

       $this->load->view('tabel_dafnom/sp2/form',$data);
    }

    public function sp2_tambah_action()
    {
        //POST
        $case = $_POST['case'];
        $pemeriksa = $_POST['pemeriksa'];
        $role = $_POST['role'];
        $datapemeriksa = array();

        // Array SP2
        $datasp2 = array(
            'idKasus' => $this->input->post('case'),
            'no' => $this->input->post('nosp2'),
            'tgl' => $this->input->post('tglsp2')
        );

        // Array Data Pemeriksa
        $i = 0;
        foreach($pemeriksa as $pemeriksasp2){
          array_push($datapemeriksa, array(
            'idKasus' => $case,
            'pemeriksa' => $pemeriksa[$i],
            'role' => $role[$i],
          ));
          $i++;
        }

        //Tambah ke tabel SP2 dan tabel SP2 pemeriksa
        $this->Tabel_dafnom_model->tambahsp2($datasp2,$datapemeriksa);

        redirect(site_url('tabel_dafnom/sp2'));
    }

    public function sp2_detil($idkasus)
    {
        $data['case'] = $this->Tabel_dafnom_model->detil_case($idkasus);
        $data['user'] = $this->Tabel_dafnom_model->detil_pemeriksa($idkasus);

        // var_dump( $data['case']);
        $this->load->view('tabel_dafnom/sp2/detil',$data);
    }

}