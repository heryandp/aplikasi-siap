<?php
/* @property phpword_model $phpword_model */
include_once(APPPATH."third_party/PhpOffice/PhpWord/Autoloader.php");
include_once(APPPATH."third_party/PhpOffice/Common/Autoloader.php");
include_once(APPPATH."third_party/Zend/Escaper.php");
include_once(APPPATH."third_party/TCPDF/tcpdf.php");

use PhpOffice\PhpWord\Autoloader;
use PhpOffice\Common\Autoloader as CommonAutoLoader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;

Autoloader::register();
CommonAutoloader::register();
Settings::loadConfig();

class Word extends CI_Controller {

	function __construct(){
	  parent::__construct();
	  $this->load->model('tabel_suratmasuk_model');
	  $this->load->model('ion_auth_model');
		$this->load->library('ion_auth');
		if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
    }

	public function index($id)
	{
		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		$data = $this->tabel_suratmasuk_model->get_by_id($id);

		$key = array(
			'no_disposisi',
			'tgl_disposisi',
			'no_sekre',
			'tgl_sekre',
			'no_suratsekre',
			'tgl_suratsekre',
			'asal_suratsekre',
			'ket_disposisi',
			'hal_suratsekre'
		);

		$value = array(
			$data->no_disposisi,
			$data->tgl_disposisi,
			$data->no_sekre,
			$data->tgl_sekre,
			$data->no_suratsekre,
			$data->tgl_suratsekre,
			$data->asal_suratsekre,
			$data->ket_disposisi,
			$data->hal_suratsekre
		);

		$templateProcessor = new TemplateProcessor(base_url()."assets/template/disposisi.docx");
		$templateProcessor->setValue($key, $value);
		$templateProcessor->saveAs("assets/word/test1.docx");
		$phpWord = IOFactory::load('assets/word/test1.docx');
		$xmlWriter = IOFactory::createWriter($phpWord , 'HTML');
		$xmlWriter->save('assets/word/result1.html'); 

		// $url =base_url('assets/word/result1.pdf');
	 //    $content = file_get_contents($url);

	 //    header('Content-Type: application/pdf');
	 //    header('Content-Length: ' . strlen($content));
	 //    header('Content-Disposition: inline; filename="result1.pdf"');
	 //    header('Cache-Control: private, max-age=0, must-revalidate');
	 //    header('Pragma: public');
	 //    ini_set('zlib.output_compression','0');

	 //    die($content);
	}
}
/* End of file dashboard.php */
/* Location: ./system/application/modules/matchbox/controllers/dashboard.php */