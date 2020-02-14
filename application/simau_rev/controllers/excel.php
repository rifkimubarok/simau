<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('mread');
	}
	public function index()
	{
		$this->load->view('excel');
	}
	public function upload(){
		$fileName = time().$_FILES['file']['name'];

		$config['upload_path'] = './assets/xls_file/'; //buat folder dengan nama assets di root folder
		$config['file_name'] = $fileName;
		$config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if(! $this->upload->do_upload('file') )
		$this->upload->display_errors();

		$media = $this->upload->data('file');
		$inputFileName = "assets/xls_file/".$fileName;
		
		try {
				$inputFileType = IOFactory::identify($inputFileName);
				$objReader = IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
				
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}

			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();
			
			for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
				$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
												NULL,
												TRUE,
												FALSE);
												
				//Sesuaikan sama nama kolom tabel di database								
				 $data = array(
					"nisn"=> $rowData[0][0],
					"nis"=> $rowData[0][1],
					"nama_siswa"=> $rowData[0][2],
					"alamat"=> $rowData[0][3]
				);
				//sesuaikan nama dengan nama tabel
				$insert = $this->db->insert("test_excel",$data);
				//delete_files($media['file_path']);
					
			}
		echo json_encode(array("status"=>"berhasil"));
	}
	public function export(){
		$ambildata = $this->mread->export_kontak();
		
		if(count($ambildata)>0){
			$objPHPExcel = new PHPExcel();
			// Set properties
			$objPHPExcel->getProperties()
				  ->setCreator("SAMSUL ARIFIN") //creator
					->setTitle("Programmer - Regional Planning and Monitoring, XL AXIATA");  //file title

			$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
			$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

			$objget->setTitle('Sample Sheet'); //sheet title
			
			$objget->getStyle("A1:C1")->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => '92d050')
					),
					'font' => array(
						'color' => array('rgb' => '000000')
					)
				)
			);

			//table header
			$cols = array("A","B","C");
			
			$val = array("Nama","Alamat","Kontak");
			
			for ($a=0;$a<3; $a++) 
			{
				$objset->setCellValue($cols[$a].'1', $val[$a]);
				
				//Setting lebar cell
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
			
				$style = array(
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					)
				);
				$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
			}
			
			$baris  = 2;
			foreach ($ambildata as $frow){
				
				//sesuaikan dengan nama kolom tabel
				$objset->setCellValue("A".$baris, $frow->nama); //membaca data nama
				$objset->setCellValue("B".$baris, $frow->alamat); //membaca data alamat
				$objset->setCellValue("C".$baris, $frow->kontak); //membaca data alamat
				
				//Set number value
				$objPHPExcel->getActiveSheet()->getStyle('C1:C'.$baris)->getNumberFormat()->setFormatCode('0');
				
				$baris++;
			}
			
			$objPHPExcel->getActiveSheet()->setTitle('Data Export');

			$objPHPExcel->setActiveSheetIndex(0);  
			$filename = urlencode("Data".date("Y-m-d H:i:s").".xls");
			  
			  header('Content-Type: application/vnd.ms-excel'); //mime type
			  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			  header('Cache-Control: max-age=0'); //no cache

			$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
			$objWriter->save('php://output');
		}else{
			redirect('Excel');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */