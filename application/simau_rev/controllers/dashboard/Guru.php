<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Guru extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->sesi->check_session();
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('Model_guru','guru');
		$this->load->library('Libkebutuhan');
	}

	 function index(){
		$this->template->display("dashboard/guru/listguru");
	}

	function infoDoc(){
		$this->template->display("dashboard/dokumen/listguru");
	}

	function cetak_dokumen()
	{
		$where = array("b.umur"=>"60","a.kode_sekolah"=>$this->session->userdata('npsn'));
		$data['hasil'] = $this->guru->getAllDataGuru($where);
		/*$this->load->view('dashboard/dokumen/print/gurudoc',$data);*/
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$data['logo']  = $this->config->item('logo_path');
		$data['fpdf'] = $this->load->library('fpdf');
		$lib = $this->libkebutuhan;
		$data['lib'] = $lib;
		$this->load->view('dashboard/dokumen/print/gurudoc', $data);
	}

	function listguru(){
		$list = $this->guru->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $guru) {
            $no++;
            $id = "'".$guru->id."'";
            $row = array();
            $row[] = $no;
            if($guru->nip != '' || $guru->nip != null){
            	$row[] = $guru->nip;
            }else{
            	$row[] = $guru->nuptk;
            }
            $row[] = $guru->nama;
            $row[] = $guru->jk;
            $row[] = $guru->stat_kepegawaian;
            $row[] = $guru->jenis_ptk;
            $row[] = '<div class="btn-group">
	                  <button class="btn btn-xs btn-outline btn-primary" onclick="ubahData('.$guru->id.')" style="display: block;"><i class="fa fa-edit"></i></button>
	                  </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->guru->count_filtered(),
            "recordsFiltered" => $this->guru->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function listGuruPensi()
	{
		$list = $this->guru->get_datatables2();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $guru) {
            $no++;
            $id = "'".$guru->id."'";
            $row = array();
            $row[] = $no;
            if($guru->nip != '' || $guru->nip != null){
            	$row[] = $guru->nip;
            }else{
            	$row[] = $guru->nuptk;
            }
            $row[] = $guru->nama;
            $row[] = $guru->ttl;
            $row[] = $guru->pangkat_gol;
            $row[] = $this->libkebutuhan->getNameSekolah($guru->kode_sekolah);
            $row[] = $guru->jenis_ptk;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->guru->count_filtered2(),
            "recordsFiltered" => $this->guru->count_filtered2(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}


	public function getDialogImport()
	{
		$this->load->view('dashboard/guru/importguru');
	}

	public function getDialogubah($id){
		$data = $this->guru->getsinglerow($id);
		echo json_encode($data);
	}

	public function ubah(){
		$data = array('id'=>$this->input->post('id'),
					  'nama'=>$this->input->post('nama'),
					  'nuptk'=>$this->input->post('nuptk'),
					  'jk'=>$this->input->post('jk'),
					  'tmp_lahir'=>$this->input->post('tmp_lahir'),
					  'tgl_lahir'=>$this->input->post('tgl_lahir'),
					  'nip'=>$this->input->post('nip'),
					  'stat_kepegawaian'=>$this->input->post('stat_kepegawaian'),
					  'jenis_ptk'=>$this->input->post('jenis_ptk'),
					  'agama'=>$this->input->post('agama'),
					  'alamat'=>$this->input->post('alamat'),
					  'rt'=>$this->input->post('rt'),
					  'rw'=>$this->input->post('rw'),
					  'nama_dusun'=>$this->input->post('nama_dusun'),
					  'desa'=>$this->input->post('desa'),
					  'kecamatan'=>$this->input->post('kecamatan'),
					  'kode_pos'=>$this->input->post('kode_pos'),
					  'telepon'=>$this->input->post('telepon'),
					  'hp'=>$this->input->post('hp'),
					  'email'=>$this->input->post('email'),
					  'tugas_tambahan'=>$this->input->post('tugas_tambahan'),
					  'sk_cpns'=>$this->input->post('sk_cpns'),
					  'tgl_cpns'=>$this->input->post('tgl_cpns'),
					  'sk_pengangkatan'=>$this->input->post('sk_pengangkatan'),
					  'tmt_pengangkatan'=>$this->input->post('tmt_pengangkatan'),
					  'lembaga_pengangkatan'=>$this->input->post('lembaga_pengangkatan'),
					  'pangkat_gol'=>$this->input->post('pangkat_gol'),
					  'sumber_gaji'=>$this->input->post('sumber_gaji'),
					  'nama_ibu_kandung'=>$this->input->post('nama_ibu_kandung'),
					  'status_perkawinan'=>$this->input->post('status_perkawinan'),
					  'nama_suami_istri'=>$this->input->post('nama_suami_istri'),
					  'nip_suami_istri'=>$this->input->post('nip_suami_istri'),
					  'pekerjaan_suami_istri'=>$this->input->post('pekerjaan_suami_istri'),
					  'tmt_pns'=>$this->input->post('tmt_pns'),
					  'lisensi_kepala_sekolah'=>$this->input->post('lisensi_kepala_sekolah'),
					  'pernah_diklat'=>$this->input->post('pernah_diklat'),
					  'keahlian_braile'=>$this->input->post('keahlian_braile'),
					  'keahlian_isyarat'=>$this->input->post('keahlian_isyarat'),
					  'npwp'=>$this->input->post('npwp'),
					  'nama_wajib_pajak'=>$this->input->post('nama_wajib_pajak'),
					  'kewarganegaraan'=>$this->input->post('kewarganegaraan'),
					  'bank'=>$this->input->post('bank'),
					  'no_rek'=>$this->input->post('no_rek'),
					  'nama_rek'=>$this->input->post('nama_rek'),
					  'nik'=>$this->input->post('nik'),
					  'kode_sekolah'=>$this->input->post('kode_sekolah'));
		$this->guru->ubah($data, $this->input->post('id'));
		redirect('dashboard/guru');
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
		$kode_sekolah = $this->session->userdata('npsn');
		$hasil = $this->profile->getProfile($kode_sekolah);
		echo json_encode($hasil);
	}

	function listguruTemp(){
		$list = $this->guru->get_datatables1();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $guru) {
            $no++;
            $id = "'".$guru->id."'";
            $row = array();
            $row[] = $no;
            if($guru->nip != '' || $guru->nip != null){
            	$row[] = $guru->nip;
            }else{
            	$row[] = $guru->nuptk;
            }
            $row[] = $guru->nama;
            $row[] = $guru->jk;
            $row[] = $guru->tmt_pangkat;
            $row[] = $guru->tmt_berkala;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->guru->count_filtered1(),
            "recordsFiltered" => $this->guru->count_filtered1(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function uploadDataguru(){
			$kode_sekolah = $this->session->userdata('npsn');
			$deleteTemp = $this->guru->deleteDataTemp($kode_sekolah);
			if($deleteTemp >0){
				$fileName = str_replace(" ","_",time().$_FILES['file']['name']);

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
				for ($row = 6; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
					$rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);
					$nomor123++;								
					//Sesuaikan sama nama kolom tabel di database								
					 $data = array(
						'nama' => $rowData[0][0],
						'nuptk' => $rowData[0][1],
						'jk' => $rowData[0][2],
						'tmp_lahir' => $rowData[0][3],
						'tgl_lahir' => $rowData[0][4],
						'nip' => $rowData[0][5],
						'stat_kepegawaian' => $rowData[0][6],
						'jenis_ptk' => $rowData[0][7],
						'agama' => $rowData[0][8],
						'alamat' => $rowData[0][9],
						'rt' => $rowData[0][10],
						'rw' => $rowData[0][11],
						'dusun' => $rowData[0][12],
						'desa' => $rowData[0][13],
						'kecamatan' => $rowData[0][14],
						'kode_pos' => $rowData[0][15],
						'telepon' => $rowData[0][16],
						'hp' => $rowData[0][17],
						'email' => $rowData[0][18],
						'tugas_tambahan' => $rowData[0][19],
						'sk_cpns' => $rowData[0][20],
						'tgl_cpns' => $rowData[0][21],
						'sk_pengangkatan' => $rowData[0][22],
						'tmt_pengangkatan' => $rowData[0][23],
						'lembaga_pengangkatan' => $rowData[0][24],
						'pangkat_gol' => $rowData[0][25],
						'sumber_gaji' => $rowData[0][26],
						'nama_ibu_kandung' => $rowData[0][27],
						'status_perkawinan' => $rowData[0][28],
						'nama_suami_istri' => $rowData[0][29],
						'nip_suami_istri' => $rowData[0][30],
						'pekerjaan_suami_istri' => $rowData[0][31],
						'tmt_pns' => $rowData[0][32],
						'lisensi_kepala_sekolah' => $rowData[0][33],
						'pernah_diklat' => $rowData[0][34],
						'keahlian_braile' => $rowData[0][35],
						'keahlian_isyarat' => $rowData[0][36],
						'npwp' => $rowData[0][37],
						'nama_wajib_pajak' => $rowData[0][38],
						'kewarganegaraan' => $rowData[0][39],
						'bank' => $rowData[0][40],
						'no_rek' => $rowData[0][41],
						'nama_rek' => $rowData[0][42],
						'nik' => $rowData[0][43],
						"kode_sekolah" => $this->session->userdata('npsn')
					);
					//sesuaikan nama dengan nama tabel
					$this->guru->simpanData($data);
				}
				unlink($inputFileName);
			echo json_encode(array("status"=>"berhasil"));
			}
		
	}

	function saveDataguru(){
		$kode_sekolah = $this->session->userdata('npsn');
		$hasil = $this->guru->simpanDataFix($kode_sekolah);
		if($hasil>0){
			echo json_encode(array("status"=>"1"));
		}
	}
}