<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jwbpd extends CI_Controller{
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('sekolah/Model_jwbpd','jwbpd');
	}

	public function index(){
		$this->template->display('sekolah/jwbpd/listjwbpd');
	}

	function listjwbpd(){
		$list = $this->jwbpd->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $jwbpd) {
            $no++;
            //$id = "'".$jwbpd->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $jwbpd->matpel;
            $row[] = $jwbpd->kelas;
            $row[] = $jwbpd->asalsekolah;
            $row[] = $jwbpd->jumlah;
            $row[] = '<div class="btn-group">
	                  <button class="btn btn-xs btn-outline btn-primary" onclick="ubahData('.$jwbpd->kd_matpel.','.$jwbpd->kd_matpel.')" style="display: block;"><i class="fa fa-edit"></i></button>
	                  </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->jwbpd->count_filtered(),
            "recordsFiltered" => $this->jwbpd->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function getDialogImport(){
		$data['matpel'] = $this->jwbpd->getmatpel();
		$this->load->view('sekolah/jwbpd/importjwb',$data);
	}



	public function getDialogubah($id){
		$data = $this->keahlian->getsinglerow($id);
		echo json_encode($data);
	}

	public function uploadExcel(){
			$kode_sekolah = $this->session->userdata('npsn');
				$fileName = $_FILES['file']['name'];

			$config['upload_path'] = './assets/xls_file/'; //buat folder dengan nama assets di root folder
			$config['file_name'] = $fileName;
			$config['allowed_types'] = 'xls|xlsx|csv';
			$config['max_size'] = 10000;

			$this->load->library('upload');
			$this->upload->initialize($config);

			if(! $this->upload->do_upload('file')){
				$this->upload->display_errors();
			}

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

				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow();
				$highestColumn = $sheet->getHighestColumn();
				$nomor123 = 0;
				$master = array();
				for ($row = 8; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
					$rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);
					$nomor123++;
												
					 $data = array(
					 	"no_pes" => $rowData[0][0],
					 	"nama" => $rowData[0][1],
					 	"kd_matpel" => $this->input->post('kd_matpel'),
					 	"thn_upload" => $this->input->post('thn_upload'),
					 	"kd_guru" => $this->input->post('kd_guru'),
					 	"kd_sekolah" => $this->session->userdata('npsn')
					);
					 $n=0;
					 if($this->input->post('kd_matpel') == '3' || $this->input->post('kd_matpel') == '2'){
					 	$n=94;
					 }else{
					 	$n=104;
					 }
					 $c=0;
					 $benar=0;
					 for($i=55;$i<=$n;$i++){
					 	$c+=1;
					 	$data['n'.$c] = $rowData[0][$i];
					 	$benar += $rowData[0][$i];
					 }
					 $nilai = 0;
					 $b = $n - 54;
					   if($b == 40){
					   		$nilai = $benar * 2.5;
					   }else{
					   		$nilai = $benar * 2;
					   }
					//sesuaikan nama dengan nama tabel

					$data['nilaiakhir'] = $nilai;
					$master[] = $data;
				}
				$hasil = $this->jwbpd->upload($master);
				unlink($inputFileName);
				if ($hasil > 0 ){
				echo json_encode(array("Status"=>"ok"));
				}		
			//echo json_encode($master);
			// redirect('sekolah/keahlian');
			
		
	}

	public function uploadTxt()
	{
		$fileName = str_replace(' ','_',time().$_FILES['file']['name']);

			$config['upload_path'] = './assets/txt_file/'; //buat folder dengan nama assets di root folder
			$config['file_name'] = $fileName;
			$config['allowed_types'] = 'xls|xlsx|txt';
			$config['max_size'] = 100000;

			$this->load->library('upload');
			$this->upload->initialize($config);

			if(! $this->upload->do_upload('file')){
				$this->upload->display_errors();
			}
			$this->upload->display_errors();

			$media = $this->upload->data('file');
		$inputFileName = str_replace(' ','_',$config['upload_path'].$fileName);

		$fh = fopen($inputFileName,'r');
		$master = array();
		$no = 1;
		while ($line = fgets($fh)) {
			//echo $no." ";
		  // <... Do your work with the line ...>
		   
		   $data = array();
		   $data1 = explode(" ", $line);
		   $data['no_pes'] = $data1[0];
		   $data['nisn'] = $data1[0];
		   $jwb = $data1[1];
		   $data['ket'] = str_replace("\r\r\n",'', $data1[2]);;
		   $n = strlen($jwb);
		   $a = 1;
		   $benar = 0;
		   for ($i=0; $i < $n ; $i++) { 
		   		$data['n'.$a] = $jwb[$i];
		   		$a+= 1;
		   		$benar += $jwb[$i];
		   }
		   $nilai = ($benar*100) / $n;

		   $data['nilaiakhir'] = $nilai;
		   $data['kd_sekolah'] = $this->session->userdata('npsn');
		   $data['kd_matpel'] = $this->input->post('kd_matpel');
		   $data['kd_guru'] = $this->input->post('kd_guru');
		   $data['kelas'] = $this->input->post('kelas');
		   $data['thn_upload'] = $this->input->post('thn_upload');
		   	$master[] = $data;
			//echo json_encode($data);
		   //$hasil = $this->jwbpd->upload($data);
		   /*if($no == 10){
		   	break;
		   }
		   $no+=1;*/
		}
		//echo json_encode($master);
			$hasil = $this->jwbpd->upload($master);
			if ($hasil > 0 ){
				echo json_encode(array("Status"=>"ok"));
			}		
		fclose($fh);
		unlink('./assets/txt_file/'.$fileName);
	}

	public function hitung1()
	{
		$hasil = $this->jwbpd->get12();
		echo json_encode($hasil);
		$a = 0;
		for ($i=1; $i <= 50 ; $i++) { 
			if($hasil->{'n'.$i} == 1){
				$a+= 1;
			}
		}
		echo '<br>'.$a;	
	}

	public function validate_upload_path()
{
    if ($this->upload_path == '')
    {
        $this->set_error('upload_no_filepath');
        return FALSE;
    }

    if (function_exists('realpath') AND @realpath($this->upload_path) !== FALSE)
    {
        $this->upload_path = str_replace("\\", "/", realpath($this->upload_path));
    }

    // This is most likely the trigger for your error
    if ( ! @is_dir($this->upload_path))
    {
        $this->set_error('upload_no_filepath');
        return FALSE;
    }

    if ( ! is_really_writable($this->upload_path))
    {
        $this->set_error('upload_not_writable');
        return FALSE;
    }

    $this->upload_path = preg_replace("/(.+?)\/*$/", "\\1/",  $this->upload_path);
    return TRUE;
}
	function temporarylist(){
		$list = $this->keahlian->get_datatables1();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $keahlian) {
            $no++;
            $id = "'".$keahlian->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $keahlian->bidang_keahlian;
            $row[] = $keahlian->program_keahlian;
            $row[] = $keahlian->kompetensi_keahlian;
            $row[] = $keahlian->sk_izin;
            $row[] = $keahlian->tgl_izin;
            $row[] = $keahlian->jml_daftar_ppdb;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->keahlian->count_filtered1(),
            "recordsFiltered" => $this->keahlian->count_filtered1(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	function saveDatakeahlian(){
		$kode_sekolah = $this->session->userdata('npsn');
		$hasil = $this->keahlian->simpanDataFix($kode_sekolah);
		if($hasil>0){
			echo json_encode(array("status"=>"1"));
		}
	}

	function getGuru()
	{
		$hasil = $this->jwbpd->getGuru();
		echo json_encode($hasil);
	}
}