<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Excel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	 public function index() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Gipsy Danger');
        $sheet->setCellValue('A2', 'Gipsy Avenger');
        $sheet->setCellValue('A3', 'Striker Eureka');
        

        //Save File
        $writer = new Xlsx($spreadsheet);
        $filename = 'SuratMasuk_'.date("YYYY_MM_DD");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');	// download file
    }

    //Surat Masuk
    public function suratmasuk()
    {
    	$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Gipsy Danger');
        $sheet->setCellValue('A2', 'Gipsy Avenger');
        $sheet->setCellValue('A3', 'Striker Eureka');
        

        //Save File
        $writer = new Xlsx($spreadsheet);
        $filename = 'SuratMasuk_'.date("Y_m_d");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

}

/* End of file Excel.php */
/* Location: ./application/controllers/Excel.php */