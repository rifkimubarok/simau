<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Nilai extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('pengelola/nilai/Model_nilai','nilai');
		$this->load->library('Libkebutuhan');
	}

	 function index(){
		$this->template->display("pengelola/nilai/nilai");
	}

	function listnilai(){
		$list = $this->nilai->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $nilai) {
            $no++;
            $id = "'".$nilai->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $nilai->kode_sekolah;
            $row[] = $nilai->nama_sekolah;
            $row[] = $nilai->status_sekolah;
            $row[] = $nilai->peserta;
            $row[] = $nilai->tl.'('.$nilai->persen.'%)';
            $row[] = $nilai->bin;
            $row[] = $nilai->ing;
            $row[] = $nilai->mat;
            $row[] = $nilai->ipa;
            $row[] = $nilai->tot;
            $row[] = $nilai->rank;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->nilai->count_filtered(),
            "recordsFiltered" => $this->nilai->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}


	public function getDialogImport()
	{
		$this->load->view('pengelola/nilai/import_nilai');
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

	function listnilaiTemp(){
		$list = $this->nilai->get_datatables1();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $nilai) {
            $no++;
            $id = "'".$nilai->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $nilai->kode_sekolah;
            $row[] = $nilai->nama_sekolah;
            $row[] = $nilai->status_sekolah;
            $row[] = $nilai->peserta;
            $row[] = $nilai->tl.'('.$nilai->persen.'%)';
            $row[] = $nilai->rank;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->nilai->count_filtered1(),
            "recordsFiltered" => $this->nilai->count_filtered1(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function uploadDatanilai(){
			$id = $this->session->userdata('id');
			$deleteTemp = $this->nilai->deleteDataTemp($id);
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

				$sheet = $objPHPExcel->getSheet(1);
				$highestRow = $sheet->getHighestRow();
				$highestColumn = $sheet->getHighestColumn();
				$nomor123 = 0;
				for ($row = 6; $row <= 65; $row++){ 
					$rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);
					$nomor123++;								
					 $data = array(
						'kode_sekolah' => $rowData[0][0],
						'nama_sekolah' => $rowData[0][1],
						'status_sekolah' => $rowData[0][2],
						'peserta' => $rowData[0][3],
						'tl' => $rowData[0][4],
						'persen' => $rowData[0][5],
						'bin' => $rowData[0][6],
						'ing' => $rowData[0][7],
						'mat' => $rowData[0][8],
						'ipa' => $rowData[0][9],
						'tot' => $rowData[0][10],
						'rank' => $rowData[0][11],
						'id_uploader' => $this->session->userdata('id')
					);
					$this->nilai->simpanData($data);
				}
				for ($row = 75; $row <= 121; $row++){ 
					$rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);
					$nomor123++;								
					 $data = array(
						'kode_sekolah' => $rowData[0][0],
						'nama_sekolah' => $rowData[0][1],
						'status_sekolah' => $rowData[0][2],
						'peserta' => $rowData[0][3],
						'tl' => $rowData[0][4],
						'persen' => $rowData[0][5],
						'bin' => $rowData[0][6],
						'ing' => $rowData[0][7],
						'mat' => $rowData[0][8],
						'ipa' => $rowData[0][9],
						'tot' => $rowData[0][10],
						'rank' => $rowData[0][11],
						'id_uploader' => $this->session->userdata('id')
					);
					//sesuaikan nama dengan nama tabel
					$this->nilai->simpanData($data);
				}
				for ($row = 134; $row <= 142; $row++){ 
					$rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);
					$nomor123++;								
					 $data = array(
						'kode_sekolah' => $rowData[0][0],
						'nama_sekolah' => $rowData[0][1],
						'status_sekolah' => $rowData[0][2],
						'peserta' => $rowData[0][3],
						'tl' => $rowData[0][4],
						'persen' => $rowData[0][5],
						'bin' => $rowData[0][6],
						'ing' => $rowData[0][7],
						'mat' => $rowData[0][8],
						'ipa' => $rowData[0][9],
						'tot' => $rowData[0][10],
						'rank' => $rowData[0][11],
						'id_uploader' => $this->session->userdata('id')
					);
					//sesuaikan nama dengan nama tabel
					$this->nilai->simpanData($data);
				}
				for ($row = 153; $row <= 172; $row++){ 
					$rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);
					$nomor123++;								
					 $data = array(
						'kode_sekolah' => $rowData[0][0],
						'nama_sekolah' => $rowData[0][1],
						'status_sekolah' => $rowData[0][2],
						'peserta' => $rowData[0][3],
						'tl' => $rowData[0][4],
						'persen' => $rowData[0][5],
						'bin' => $rowData[0][6],
						'ing' => $rowData[0][7],
						'mat' => $rowData[0][8],
						'ipa' => $rowData[0][9],
						'tot' => $rowData[0][10],
						'rank' => $rowData[0][11],
						'id_uploader' => $this->session->userdata('id')
					);
					//sesuaikan nama dengan nama tabel
					$this->nilai->simpanData($data);
				}
				unlink($inputFileName);
			echo json_encode(array("status"=>"berhasil"));
			}
		
	}

	function saveData(){
		$id = $this->session->userdata('id');
		$hasil = $this->nilai->simpanDataFix($id);
		if($hasil>0){
			echo json_encode(array("status"=>"1"));
		}
	}
}