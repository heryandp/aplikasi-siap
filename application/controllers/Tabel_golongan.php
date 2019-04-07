<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabel_golongan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tabel_golongan_model');
        $this->load->library('form_validation');
        $this->load->model('ion_auth_model');
        $this->load->library('ion_auth');
        if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tabel_golongan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tabel_golongan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tabel_golongan/index.html';
            $config['first_url'] = base_url() . 'tabel_golongan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tabel_golongan_model->total_rows($q);
        $tabel_golongan = $this->Tabel_golongan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tabel_golongan_data' => $tabel_golongan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tabel_golongan/tabel_golongan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tabel_golongan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'pangkat' => $row->pangkat,
		'golongan' => $row->golongan,
		'ruang' => $row->ruang,
	    );
            $this->load->view('tabel_golongan/tabel_golongan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabel_golongan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tabel_golongan/create_action'),
	    'id' => set_value('id'),
	    'pangkat' => set_value('pangkat'),
	    'golongan' => set_value('golongan'),
	    'ruang' => set_value('ruang'),
	);
        $this->load->view('tabel_golongan/tabel_golongan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'pangkat' => $this->input->post('pangkat',TRUE),
		'golongan' => $this->input->post('golongan',TRUE),
		'ruang' => $this->input->post('ruang',TRUE),
	    );

            $this->Tabel_golongan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tabel_golongan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tabel_golongan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tabel_golongan/update_action'),
		'id' => set_value('id', $row->id),
		'pangkat' => set_value('pangkat', $row->pangkat),
		'golongan' => set_value('golongan', $row->golongan),
		'ruang' => set_value('ruang', $row->ruang),
	    );
            $this->load->view('tabel_golongan/tabel_golongan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabel_golongan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'pangkat' => $this->input->post('pangkat',TRUE),
		'golongan' => $this->input->post('golongan',TRUE),
		'ruang' => $this->input->post('ruang',TRUE),
	    );

            $this->Tabel_golongan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tabel_golongan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tabel_golongan_model->get_by_id($id);

        if ($row) {
            $this->Tabel_golongan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tabel_golongan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabel_golongan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('pangkat', 'pangkat', 'trim|required');
	$this->form_validation->set_rules('golongan', 'golongan', 'trim|required');
	$this->form_validation->set_rules('ruang', 'ruang', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tabel_golongan.xls";
        $judul = "tabel_golongan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Pangkat");
	xlsWriteLabel($tablehead, $kolomhead++, "Golongan");
	xlsWriteLabel($tablehead, $kolomhead++, "Ruang");

	foreach ($this->Tabel_golongan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pangkat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->golongan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ruang);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tabel_golongan.php */
/* Location: ./application/controllers/Tabel_golongan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-20 02:54:01 */
/* http://harviacode.com */