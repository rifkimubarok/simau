<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Rekap extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->sesi->check_session();
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('pengelola/nilai/Model_rekap','rekap');
		$this->load->library('Libkebutuhan');
	}

	 function index(){
		$this->template->display("pengelola/nilai/rekap");
	}

	function listrekap(){
		$list = $this->rekap->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $rekap) {
            $no++;
            $id = "'".$rekap->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $rekap->tahun;
            $row[] = $rekap->jml_peserta;
            $row[] = $rekap->lulus;
            $row[] = $rekap->tidak_lulus;
            $row[] = $rekap->jml;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rekap->count_filtered(),
            "recordsFiltered" => $this->rekap->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}


	public function getDialogImport()
	{
		$this->load->view('pengelola/nilai/import_rekap');
	}

	public function simpanData()
	{
		$json = file_get_contents('php://input');
        $obj = json_decode($json);

    	$where = array("npsn"=>$obj->{'npsn'});
    	$hasil = $this->profile->simpanData($obj,$where);
    	if($hasil>0){
    		echo json_encode(array("status"=>"berhasil"));
    	}
    	//echo $hasil;
	}

	public function getProfile(){
		$id = $this->session->userdata('id');
		$hasil = $this->profile->getProfile($id);
		echo json_encode($hasil);
	}

	function listrekapTemp(){
		$list = $this->rekap->get_datatables1();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $rekap) {
            $no++;
            $id = "'".$rekap->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $rekap->tahun;
            $row[] = $rekap->jml_peserta;
            $row[] = $rekap->lulus;
            $row[] = $rekap->tidak_lulus;
            $row[] = $rekap->jml;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rekap->count_filtered1(),
            "recordsFiltered" => $this->rekap->count_filtered1(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function uploadDatarekap(){
			$id = $this->session->userdata('id');
			$deleteTemp = $this->rekap->deleteDataTemp($id);
			if($deleteTemp >0){
				$fileName = $_FILES['file']['name'];

			$config['upload_path'] = './assets/xls_file/'; //buat folder dengan nama assets di root folder
			$config['file_name'] = $fileName;
			$config['allowed_types'] = 'xls|xlsx|csv';
			$config['max_size'] = 10000;

			$this->load->library('upload');
			$this->upload->initialize($config);

			if(! $this->upload->do_upload('file') )
			$this->upload->display_errors();

			$media = $this->upload->data('file');
			$inputFileName = str_replace(' ','_',$config['upload_path'].$fileName);
			
			try {
					$inputFileType = IOFactory::identify($inputFileName);
					$objReader = IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
					
				} catch(Exception $e) {
					die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
					unlink($inputFileName);
				}

				$sheet = $objPHPExcel->getSheet(5);
				$highestRow = $sheet->getHighestRow();
				$highestColumn = $sheet->getHighestColumn();
				$nomor123 = 0;
				for ($row = 5; $row <= $highestRow; $row++){ 
					$rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);
					$nomor123++;								
					 $data = array(
						'tahun' => $rowData[0][0],
						'jml_peserta' => $rowData[0][1],
						'lulus' => $rowData[0][2],
						'tidak_lulus' => $rowData[0][3],
						'jml' => $rowData[0][4],
						'id_uploader' => $this->session->userdata('id')
					);
					//sesuaikan nama dengan nama tabel
					 if($rowData[0][0] != null)
					$this->rekap->simpanData($data);
				}
				unlink($inputFileName);
			echo json_encode(array("status"=>"berhasil", 'row terbesar' => $highestRow, 'kolom' => $highestColumn));
			}
		
	}

	function saveData(){
		$id = $this->session->userdata('id');
		$hasil = $this->rekap->simpanDataFix($id);
		if($hasil>0){
			echo json_encode(array("status"=>"1"));
		}
	}
}