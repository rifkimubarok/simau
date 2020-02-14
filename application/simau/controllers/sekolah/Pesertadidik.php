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
		$this->load->model('sekolah/Model_siswa','siswa');
	}

	function index(){
        $this->template->display('sekolah/pesertadidik/pesertadidik');
	}

	function test(){
		$this->template->display('sekolah/pesertadidik/formPesertaDidik');
	}

	function getDataSiswa(){
		$id = $this->input->GET('ID',true);
		$hasil = $this->siswa->getDataSiswa($id);
		if($hasil->num_rows() >0){
			echo json_encode($hasil->row());
		}
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
            $row[] = $siswa->kelas;
            $row[] = '<div class="btn-group">
	                  <button class="btn btn-xs btn-outline btn-primary" onclick="ubahData('.$siswa->id.')" style="display: block;"><i class="fa fa-edit"></i></button>
	                  </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->siswa->count_filtered(),
            "recordsFiltered" => $this->siswa->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function getDialogImport(){
		$this->load->view('sekolah/pesertadidik/importPesertadidik');
	}

	public function getDialogubah($id){
		$data = $this->siswa->getsinglerow($id);
		echo json_encode($data);
	}

	public function ubah(){
		$data = array('id'=>$this->input->post('id'),
					  'nama'=>$this->input->post('nama'),
					  'nipd'=>$this->input->post('nipd'),
					  'jk'=>$this->input->post('jk'),
					  'nisn'=>$this->input->post('nisn'),
					  'tmp_lahir'=>$this->input->post('tmp_lahir'),
					  'tgl_lahir'=>$this->input->post('tgl_lahir'),
					  'nik'=>$this->input->post('nik'),
					  'agama'=>$this->input->post('agama'),
					  'alamat'=>$this->input->post('alamat'),
					  'rt'=>$this->input->post('rt'),
					  'rw'=>$this->input->post('rw'),
					  'dusun'=>$this->input->post('dusun'),
					  'kelurahan'=>$this->input->post('kelurahan'),
					  'kecamatan'=>$this->input->post('kecamatan'),
					  'kode_pos'=>$this->input->post('kode_pos'),
					  'jenis_tinggal'=>$this->input->post('jenis_tinggal'),
					  'alat_transport'=>$this->input->post('alat_transport'),
					  'telepon'=>$this->input->post('telepon'),
					  'hp'=>$this->input->post('hp'),
					  'email'=>$this->input->post('email'),
					  'skhun'=>$this->input->post('skhun'),
					  'penerima_kps'=>$this->input->post('penerima_kps'),
					  'no_kps'=>$this->input->post('no_kps'),
					  'nama_ayah'=>$this->input->post('nama_ayah'),
					  'thn_lahir_ayah'=>$this->input->post('thn_lahir_ayah'),
					  'jenjang_ayah'=>$this->input->post('jenjang_ayah'),
					  'pekerjaan_ayah'=>$this->input->post('pekerjaan_ayah'),
					  'penghasilan_ayah'=>$this->input->post('penghasilan_ayah'),
					  'nik_ayah'=>$this->input->post('nik_ayah'),
					  'nama_ibu'=>$this->input->post('nama_ibu'),
					  'thn_lahir_ibu'=>$this->input->post('thn_lahir_ibu'),
					  'jenjang_ibu'=>$this->input->post('jenjang_ibu'),
					  'pekerjaan_ibu'=>$this->input->post('pekerjaan_ibu'),
					  'penghasilan_ibu'=>$this->input->post('penghasilan_ibu'),
					  'nik_ibu'=>$this->input->post('nik_ibu'),
					  'nama_wali'=>$this->input->post('nama_wali'),
					  'thn_lahir_wali'=>$this->input->post('thn_lahir_wali'),
					  'jenjang_wali'=>$this->input->post('jenjang_wali'),
					  'pekerjaan_wali'=>$this->input->post('pekerjaan_wali'),
					  'penghasilan_wali'=>$this->input->post('penghasilan_wali'),
					  'nik_wali'=>$this->input->post('nik_wali'),
					  'rombel'=>$this->input->post('rombel'),
					  'no_peserta_un'=>$this->input->post('no_peserta_un'),
					  'no_seri_ijazah'=>$this->input->post('no_seri_ijazah'),
					  'penerima_kip'=>$this->input->post('penerima_kip'),
					  'no_kip'=>$this->input->post('no_kip'),
					  'nama_kip'=>$this->input->post('nama_kip'),
					  'no_kks'=>$this->input->post('no_kks'),
					  'no_reg_akta'=>$this->input->post('no_reg_akta'),
					  'bank'=>$this->input->post('bank'),
					  'no_rek'=>$this->input->post('no_rek'),
					  'nama_rek'=>$this->input->post('nama_rek'),
					  'layak_pip'=>$this->input->post('layak_pip'),
					  'alasan_layak'=>$this->input->post('alasan_layak'),
					  'kebutuhan_khusus'=>$this->input->post('kebutuhan_khusus'),
					  'sekolah_asal'=>$this->input->post('sekolah_asal'),
					  'kode_sekolah'=>$this->input->post('kode_sekolah'),
					  'kelas'=>$this->input->post('kelas'),
					  'jurusan'=>$this->input->post('jurusan'),
					  'buntut'=>$this->input->post('buntut'));
		$this->pesertadidik->ubah($data, $this->input->post('id'));
		redirect('sekolah/pesertadidik');
	}

	public function uploadDataSiswa(){
			$kode_sekolah = $this->session->userdata('npsn');
			$deleteTemp = $this->siswa->deleteDataTemp($kode_sekolah);
			if($deleteTemp >0){
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
				$text = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
				for ($row = 7; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
					$rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
													NULL,
													TRUE,
													FALSE);
					$nomor123++;
					if(substr($rowData[0][41], 0, 1) == 'X'){
						if(substr($rowData[0][41], 0, 2) == 'XI'){
							if(substr($rowData[0][41], 0, 3) == 'XII'){
								$new = str_replace('XII', '12', $rowData[0][41]);
								$tingkat = substr($new, 0, 2);
								if(is_numeric(substr($new, -1))){
									$buntut = substr($new, -1);
								}else{
									$buntut = NULL;
								}
								if(substr($new, 4, 1) == ' '){
									$jurusan = substr($new, 5);
									$jurusan_final = str_replace(array(' ','1','2','3','4','5','6','7','8','9','0'), '', $new);
								}else{
									$jurusan = substr($new, 4);
									$jurusan_final = str_replace(array(' ','1','2','3','4','5','6','7','8','9','0'), '', $new);
								}
							}else{
								$new = str_replace('XI', '11', $rowData[0][41]);
								$tingkat = substr($new, 0, 2);
								if(is_numeric(substr($new, -1))){
									$buntut = substr($new, -1);
								}else{
									$buntut = NULL;
								}
								if(substr($new, 4, 1) == ' '){
									$jurusan = substr($new, 5);
									$jurusan_final = str_replace(array(' ','1','2','3','4','5','6','7','8','9','0'), '', $new);
								}else{
									$jurusan = substr($new, 4);
									$jurusan_final = str_replace(array(' ','1','2','3','4','5','6','7','8','9','0'), '', $new);
								}
							}
						}else{
							$new = str_replace('X', '10', $rowData[0][41]);
							$tingkat = substr($new, 0, 2);
							if(is_numeric(substr($new, -1))){
									$buntut = substr($new, -1);
								}else{
									$buntut = NULL;
								}
							if(substr($new, 4, 1) == ' '){
								$jurusan = substr($new, 5);
								$jurusan_final = str_replace(array(' ','1','2','3','4','5','6','7','8','9','0'), '', $new);
							}else{
								$jurusan = substr($new, 4);
								$jurusan_final = str_replace(array(' ','1','2','3','4','5','6','7','8','9','0'), '', $new);
							}
						}
					}else{
						$tingkat = substr($rowData[0][41], 0, 2);
						if(is_numeric(substr($rowData[0][41], -1))){
									$buntut = substr($rowData[0][41], -1);
								}else{
									$buntut = NULL;
								}
						if(substr($rowData[0][41], 4, 1) == ' '){
							$jurusan = substr($rowData[0][41], 5);
							$jurusan_final = str_replace(array(' ','1','2','3','4','5','6','7','8','9','0'), '', $rowData[0][41]);
						}else{
							$jurusan = substr($rowData[0][41], 4);
							$jurusan_final = str_replace(array(' ','1','2','3','4','5','6','7','8','9','0'), '', $rowData[0][41]);
						}
					}															
					 $data = array(
					 	"kelas" => $tingkat,
					 	"jurusan" => $jurusan_final,
					 	"buntut" => $buntut,
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
}