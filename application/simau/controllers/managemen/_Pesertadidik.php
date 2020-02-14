<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Pesertadidik extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('managemen/Model_siswa','siswa');
		$this->load->library('Libkebutuhan');
	}

	function index(){
        $this->template->display('managemen/pesertadidik/pesertadidik');
	}

	function test(){
		$this->template->display('managemen/pesertadidik/formPesertaDidik');
	}

	function listPesertaDidik(){
		$list = $this->siswa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $siswa) {
            $no++;
            $id = "'".$siswa->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $siswa->nisn;
            $row[] = $siswa->nipd;
            $row[] = $siswa->nama;
            $row[] = $siswa->jk;
            $row[] = $siswa->kelas.' '.$siswa->jurusan.' '.$siswa->buntut;
            $row[] = $this->libkebutuhan->getNameSekolah($siswa->kode_sekolah);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->siswa->count_filtered(),
            "recordsFiltered" => $this->siswa->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
	}

	public function getDialogImport(){
		$this->load->view('sekolah/pesertadidik/importPesertadidik');
	}

	public function uploadDataSiswa(){
			$kode_sekolah = $this->session->userdata('npsn');
			$deleteTemp = $this->siswa->deleteDataTemp($kode_sekolah);
			if($deleteTemp >0){
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
			$inputFileName = $config['upload_path'].$fileName;
			
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
				for ($row = 7; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
					$rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);
					$nomor123++;								
					//Sesuaikan sama nama kolom tabel di database								
					 $data = array(
						"nama" => $rowData[0][0],
						"nipd" => $rowData[0][1],
						"jk" => $rowData[0][2],
						"nisn" => $rowData[0][3],
						"tmp_lahir" => $rowData[0][4],
						"tgl_lahir" => $rowData[0][5],
						"nik" => $rowData[0][6],
						"agama" => $rowData[0][7],
						"alamat" => $rowData[0][8],
						"rt" => $rowData[0][9],
						"rw" => $rowData[0][10],
						"dusun" => $rowData[0][11],
						"kelurahan" => $rowData[0][12],
						"kecamatan" => $rowData[0][13],
						"kode_pos" => $rowData[0][14],
						"jenis_tinggal" => $rowData[0][15],
						"alat_transport" => $rowData[0][16],
						"telepon" => $rowData[0][17],
						"hp" => $rowData[0][18],
						"email" => $rowData[0][19],
						"skhun" => $rowData[0][20],
						"penerima_kps" => $rowData[0][21],
						"no_kps" => $rowData[0][22],
						"nama_ayah" => $rowData[0][23],
						"thn_lahir_ayah" => $rowData[0][24],
						"jenjang_ayah" => $rowData[0][25],
						"pekerjaan_ayah" => $rowData[0][26],
						"penghasilan_ayah" => $rowData[0][27],
						"nik_ayah" => $rowData[0][28],
						"nama_ibu" => $rowData[0][29],
						"thn_lahir_ibu" => $rowData[0][30],
						"jenjang_ibu" => $rowData[0][31],
						"pekerjaan_ibu" => $rowData[0][32],
						"penghasilan_ibu" => $rowData[0][33],
						"nik_ibu" => $rowData[0][34],
						"nama_wali" => $rowData[0][35],
						"thn_lahir_wali" => $rowData[0][36],
						"jenjang_wali" => $rowData[0][37],
						"pekerjaan_wali" => $rowData[0][38],
						"penghasilan_wali" => $rowData[0][39],
						"nik_wali" => $rowData[0][40],
						"rombel" => $rowData[0][41],
						"no_peserta_un" => $rowData[0][42],
						"no_seri_ijazah" => $rowData[0][43],
						"penerima_kip" => $rowData[0][44],
						"no_kip" => $rowData[0][45],
						"nama_kip" => $rowData[0][46],
						"no_kks" => $rowData[0][47],
						"no_reg_akta" => $rowData[0][48],
						"bank" => $rowData[0][49],
						"no_rek" => $rowData[0][50],
						"nama_rek" => $rowData[0][51],
						"layak_pip" => $rowData[0][52],
						"alasan_layak" => $rowData[0][53],
						"kebutuhan_khusus" => $rowData[0][54],
						"sekolah_asal" => $rowData[0][55],
						"kode_sekolah" => $this->session->userdata('npsn')
					);
					//sesuaikan nama dengan nama tabel
					$this->siswa->simpanData($data);
				}
				unlink($inputFileName);
			echo json_encode(array("status"=>"berhasil"));
			}
		
	}

	function listPesertaDidikTemp(){
		$list = $this->siswa->get_datatables1();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $siswa) {
            $no++;
            $id = "'".$siswa->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $siswa->nisn;
            $row[] = $siswa->nipd;
            $row[] = $siswa->nama;
            $row[] = $siswa->jk;
            $row[] = $siswa->rombel;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->siswa->count_filtered1(),
            "recordsFiltered" => $this->siswa->count_filtered1(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	function saveDataSiswa(){
		$kode_sekolah = $this->session->userdata('npsn');
		$hasil = $this->siswa->simpanDataFix($kode_sekolah);
		if($hasil>0){
			echo json_encode(array("status"=>"1"));
		}
	}

	function getSekolah()
	{
		if(isset($_GET['kec']) && !isset($_GET['jenjang'])){
			$data['sekolah'] = $this->siswa->getSekolah($_GET['kec'], null);
        }elseif(isset($_GET['kec']) && isset($_GET['jenjang'])){
			$data['sekolah'] = $this->siswa->getSekolah($_GET['kec'], $_GET['jenjang']);
        }elseif(!isset($_GET['kec']) && isset($_GET['jenjang'])){
			$data['sekolah'] = $this->siswa->getSekolah(null, $_GET['jenjang']);
        }else{
			$data['sekolah'] = $this->siswa->getSekolah();
		}
		echo json_encode($data);
	}
	function getKec()
	{	
		$data['kec'] = $this->siswa->getKec();
		echo json_encode($data);
	}

	function getJenjang()
	{
		$data['jenjang'] = $this->siswa->getJenjang();
		echo json_encode($data);
	}
}