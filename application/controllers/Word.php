<?php
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use NcJoes\OfficeConverter\OfficeConverter;

class Word extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('ion_auth_model');
        if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
    }

	public function index()
	{
		$this->load->view('template/cetak/rencana');
		// $filetemplate = 'assets/template/nd-rencana.docx';
		// $converter = new OfficeConverter($filetemplate);
		// $converter->convertTo('hasil.pdf'); //generates pdf file in same directory as test-file.docx
		// $templateProcessor = new TemplateProcessor($filetemplate);
		// $templateProcessor->saveAs('assets/template/temp/nd-rencana-temp.docx');
		// $filename = "NDRIK.docx";
		// $phpWord = IOFactory::load('assets/template/nd-rencana.docx', 'Word2007');
		// $phpWord->save('assets/template/nd-rencana.pdf', 'PDF');
		// header('Content-Description: File Transfer');
		// header('Content-Type: application/octet-stream');
		// header('Content-Disposition: attachment; filename='.$filename);
		// header('Content-Transfer-Encoding: binary');
		// header('Expires: 0');
		// header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		// header('Pragma: public');
		// header('Content-Length: ' . filesize('assets/template/temp/nd-rencana-temp.docx'));
		// flush();
		// readfile('assets/template/temp/nd-rencana-temp.docx');
		// unlink('assets/template/temp/nd-rencana-temp.docx');
	}

}

/* End of file Word.php */
/* Location: ./application/controllers/Word.php */