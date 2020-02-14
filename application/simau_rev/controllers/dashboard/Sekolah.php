<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Sekolah extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->sesi->check_session();
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('model_profile','profile');
		$this->load->model('model_sekolah','sekolah');
	}

	 function index(){
		$this->template->display("dashboard/sekolah/index");
	}

	public function getDialogubah($id){
		$data = $this->sekolah->getsinglerow($id);
		echo json_encode($data);
	}

	public function tambahData()
	{
		$this->load->view('dashboard/sekolah/profile');
	}
	function listsekolah(){
		$list = $this->sekolah->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $sekolah) {
            $no++;
            $id = "'".$sekolah->npsn."'";
            $row = array();
            $row[] = $no;
            $row[] = $sekolah->npsn;
            $row[] = $sekolah->namasekolah;
            $row[] = $sekolah->email;
            $row[] = $sekolah->no_telp;
            $row[] = '<div class="btn-group">
					  <button class="btn btn-xs btn-outline btn-primary" onclick="ubahData('.$id.')" style="display: block;"><i class="fa fa-edit"></i></button>
					  <button class="btn btn-xs btn-outline btn-primary" onclick="hapusData('.$id.')" style="display: block;"><i class="fa fa-trash"></i></button>
	                  </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sekolah->count_filtered(),
            "recordsFiltered" => $this->sekolah->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function fixubah(){
		$jenjang = $this->input->post('jenjang');
		switch($jenjang) {
			case "SD" :
				$icon = 'university.png';
			break;
			default:
				$icon = 'university.png';
			break;
		}
		$data = array(
			'npsn' => $this->input->post('npsn'),
			'namasekolah' => $this->input->post('namasekolah'),
			'jenjang' => $this->input->post('jenjang'),
			'status' => $this->input->post('status'),
			'alamat' => $this->input->post('alamat'),
			'rt' => $this->input->post('rt'),
			'rw' => $this->input->post('rw'),
			'kodepos' => $this->input->post('kodepos'),
			'kelurahan' => $this->input->post('kelurahan'),
			'kecamatan' => $this->input->post('kecamatan'),
			'kabupaten' => $this->input->post('kabupaten'),
			'provinsi' => $this->input->post('provinsi'),
			'negara' => $this->input->post('negara'),
			'posisilat' => $this->input->post('posisilat'),
			'posisilong' => $this->input->post('posisilong'),
			'sk_pendiri' => $this->input->post('sk_pendiri'),
			'tgl_sk_pendiri' => $this->input->post('tgl_sk_pendiri'),
			'status_milik' => $this->input->post('status_milik'),
			'sk_izin' => $this->input->post('sk_izin'),
			'tgl_sk_izin' => $this->input->post('tgl_sk_izin'),
			'kbth_khss_dlayani' => $this->input->post('kbth_khss_dlayani'),
			'no_rek' => $this->input->post('no_rek'),
			'nama_bank' => $this->input->post('nama_bank'),
			'cabang_bank' => $this->input->post('cabang_bank'),
			'nama_rek' => $this->input->post('nama_rek'),
			'mbs' => $this->input->post('mbs'),
			'l_tanah_milik' => $this->input->post('l_tanah_milik'),
			'l_tanah_nomilik' => $this->input->post('l_tanah_nomilik'),
			'nama_wajib_pajak' => $this->input->post('nama_wajib_pajak'),
			'npwp' => $this->input->post('npwp'),
			'no_telp' => $this->input->post('no_telp'),
			'no_fax' => $this->input->post('no_fax'),
			'email' => $this->input->post('email'),
			'website' => $this->input->post('website'),
			'w_penyelenggara' => $this->input->post('w_penyelenggara'),
			'sedia_bos' => $this->input->post('sedia_bos'),
			'sert_iso' => $this->input->post('sert_iso'),
			'sumber_listrik' => $this->input->post('sumber_listrik'),
			'daya_listrik' => $this->input->post('daya_listrik'),
			'internet' => $this->input->post('internet'),
			'internet_alter' => $this->input->post('internet_alter'),
			'cukup_air' => $this->input->post('cukup_air'),
			'memproses_air' => $this->input->post('memproses_air'),
			'air_minum' => $this->input->post('air_minum'),
			'siswa_air_minum' => $this->input->post('siswa_air_minum'),
			'jml_wc_khusus' => $this->input->post('jml_wc_khusus'),
			'air_sanitasi' => $this->input->post('air_sanitasi'),
			'sedia_air' => $this->input->post('sedia_air'),
			'tipe_wc' => $this->input->post('tipe_wc'),
			'jml_tmp_cuci' => $this->input->post('jml_tmp_cuci'),
			'sabun_air' => $this->input->post('sabun_air'),
			'jml_wc_bisa_laki' => $this->input->post('jml_wc_bisa_laki'),
			'jml_wc_bisa_perem' => $this->input->post('jml_wc_bisa_perem'),
			'jml_wc_bisa_bersama' => $this->input->post('jml_wc_bisa_bersama'),
			'jml_wc_tidak_laki' => $this->input->post('jml_wc_tidak_laki'),
			'jml_wc_tidak_perem' => $this->input->post('jml_wc_tidak_perem'),
			'jml_wc_tidak_bersama' => $this->input->post('jml_wc_tidak_bersama'),
			'icon' => $icon
			// 'pengawas' => $this->input->post('pengawas')
		);
		$this->sekolah->ubah($data, $this->input->post('npsn'));
		redirect('dashboard/sekolah');
	}

	function getDataProfile(){
			$fileName = str_replace(' ','_',time().$_FILES['file']['name']);

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
				                  //  Read a row of data into an array                 
					$namasekolah = $sheet->rangeToArray('D' . 4 . ':' . $highestColumn . 4,NULL,TRUE,FALSE);
					$npsn = $sheet->rangeToArray('D' . 5 . ':' . $highestColumn . 5,NULL,TRUE,FALSE);
					$jenjang = $sheet->rangeToArray('D' . 6 . ':' . $highestColumn . 6,NULL,TRUE,FALSE);
					$status = $sheet->rangeToArray('D' . 7 . ':' . $highestColumn . 7,NULL,TRUE,FALSE);
					$alamat = $sheet->rangeToArray('D' . 8 . ':' . $highestColumn . 8,NULL,TRUE,FALSE);
					$rtrw = $sheet->rangeToArray('D' . 9 . ':' . $highestColumn . 9,NULL,TRUE,FALSE);
					$kodepos = $sheet->rangeToArray('D' . 10 . ':' . $highestColumn . 10,NULL,TRUE,FALSE);
					$kelurahan = $sheet->rangeToArray('D' . 11 . ':' . $highestColumn . 11,NULL,TRUE,FALSE);
					$kecamatan = $sheet->rangeToArray('D' . 12 . ':' . $highestColumn . 12,NULL,TRUE,FALSE);
					$kabupaten = $sheet->rangeToArray('D' . 13 . ':' . $highestColumn . 13,NULL,TRUE,FALSE);
					$provinsi = $sheet->rangeToArray('D' . 14 . ':' . $highestColumn . 14,NULL,TRUE,FALSE);
					$negara = $sheet->rangeToArray('D' . 15 . ':' . $highestColumn . 15,NULL,TRUE,FALSE);
					$posisilat = $sheet->rangeToArray('D' . 16 . ':' . $highestColumn . 16,NULL,TRUE,FALSE);
					$posisilong = $sheet->rangeToArray('D' . 17 . ':' . $highestColumn . 17,NULL,TRUE,FALSE);
					$sk_pendiri = $sheet->rangeToArray('D' . 19 . ':' . $highestColumn . 19,NULL,TRUE,FALSE);
					$tgl_sk_pendiri = $sheet->rangeToArray('D' . 20 . ':' . $highestColumn . 20,NULL,TRUE,FALSE);
					$status_milik = $sheet->rangeToArray('D' . 21 . ':' . $highestColumn . 21,NULL,TRUE,FALSE);
					$sk_izin = $sheet->rangeToArray('D' . 22 . ':' . $highestColumn . 22,NULL,TRUE,FALSE);
					$tgl_sk_izin = $sheet->rangeToArray('D' . 23 . ':' . $highestColumn . 23,NULL,TRUE,FALSE);
					$kbth_khss_dlayani = $sheet->rangeToArray('D' . 24 . ':' . $highestColumn . 24,NULL,TRUE,FALSE);
					$no_rek = $sheet->rangeToArray('D' . 25 . ':' . $highestColumn . 25,NULL,TRUE,FALSE);
					$nama_bank = $sheet->rangeToArray('D' . 26 . ':' . $highestColumn . 26,NULL,TRUE,FALSE);
					$cabang_bank = $sheet->rangeToArray('D' . 27 . ':' . $highestColumn . 27,NULL,TRUE,FALSE);
					$nama_rek = $sheet->rangeToArray('D' . 28 . ':' . $highestColumn . 28,NULL,TRUE,FALSE);
					$mbs = $sheet->rangeToArray('D' . 29 . ':' . $highestColumn . 29,NULL,TRUE,FALSE);
					$l_tanah_milik = $sheet->rangeToArray('D' . 30 . ':' . $highestColumn . 30,NULL,TRUE,FALSE);
					$l_tanah_nomilik = $sheet->rangeToArray('D' . 31 . ':' . $highestColumn . 31,NULL,TRUE,FALSE);
					$nama_wajib_pajak = $sheet->rangeToArray('D' . 32 . ':' . $highestColumn . 32,NULL,TRUE,FALSE);
					$npwp = $sheet->rangeToArray('D' . 33 . ':' . $highestColumn . 33,NULL,TRUE,FALSE);
					$no_telp = $sheet->rangeToArray('D' . 35 . ':' . $highestColumn . 35,NULL,TRUE,FALSE);
					$no_fax = $sheet->rangeToArray('D' . 36 . ':' . $highestColumn . 36,NULL,TRUE,FALSE);
					$email = $sheet->rangeToArray('D' . 37 . ':' . $highestColumn . 37,NULL,TRUE,FALSE);
					$website = $sheet->rangeToArray('D' . 38 . ':' . $highestColumn . 38,NULL,TRUE,FALSE);
					$w_penyelenggara = $sheet->rangeToArray('D' . 40 . ':' . $highestColumn . 40,NULL,TRUE,FALSE);
					$sedia_bos = $sheet->rangeToArray('D' . 41 . ':' . $highestColumn . 41,NULL,TRUE,FALSE);
					$sert_iso = $sheet->rangeToArray('D' . 42 . ':' . $highestColumn . 42,NULL,TRUE,FALSE);
					$sumber_listrik = $sheet->rangeToArray('D' . 43 . ':' . $highestColumn . 43,NULL,TRUE,FALSE);
					$daya_listrik = $sheet->rangeToArray('D' . 44 . ':' . $highestColumn . 44,NULL,TRUE,FALSE);
					$internet = $sheet->rangeToArray('D' . 45 . ':' . $highestColumn . 45,NULL,TRUE,FALSE);
					$internet_alter = $sheet->rangeToArray('D' . 46 . ':' . $highestColumn . 46,NULL,TRUE,FALSE);
					$cukup_air = $sheet->rangeToArray('D' . 48 . ':' . $highestColumn . 48,NULL,TRUE,FALSE);
					$memproses_air = $sheet->rangeToArray('D' . 49 . ':' . $highestColumn . 49,NULL,TRUE,FALSE);
					$air_minum = $sheet->rangeToArray('D' . 51 . ':' . $highestColumn . 51,NULL,TRUE,FALSE);
					$siswa_air_minum = $sheet->rangeToArray('D' . 52 . ':' . $highestColumn . 52,NULL,TRUE,FALSE);
					$jml_wc_khusus = $sheet->rangeToArray('D' . 54 . ':' . $highestColumn . 54,NULL,TRUE,FALSE);
					$air_sanitasi = $sheet->rangeToArray('D' . 56 . ':' . $highestColumn . 56,NULL,TRUE,FALSE);
					$sedia_air = $sheet->rangeToArray('D' . 57 . ':' . $highestColumn . 57,NULL,TRUE,FALSE);
					$tipe_wc = $sheet->rangeToArray('D' . 59 . ':' . $highestColumn . 59,NULL,TRUE,FALSE);
					$jml_tmp_cuci = $sheet->rangeToArray('D' . 60 . ':' . $highestColumn . 60,NULL,TRUE,FALSE);
					$sabun_air = $sheet->rangeToArray('D' . 62 . ':' . $highestColumn . 62,NULL,TRUE,FALSE);
					$jml_wc_bisa = $sheet->rangeToArray('D' . 66 . ':' . $highestColumn . 66,NULL,TRUE,FALSE);
					$jml_wc_tidak = $sheet->rangeToArray('D' . 68 . ':' . $highestColumn . 68,NULL,TRUE,FALSE);
					//Sesuaikan sama nama kolom tabel di database								
					 $data = array(
						"namasekolah" => $namasekolah[0][0],
						"npsn" => $npsn[0][0],
						'jenjang' => $jenjang[0][0],
						'status' => $status[0][0],
						'alamat' => $alamat[0][0],
						'rt' => $rtrw[0][0],
						'rw' => $rtrw[0][2],
						'kodepos' => $kodepos[0][0],
						'kelurahan' => $kelurahan[0][0],
						'kecamatan' => $kecamatan[0][0],
						'kabupaten' => $kabupaten[0][0],
						'provinsi' => $provinsi[0][0],
						'negara' => $negara[0][0],
						'posisilat' => $posisilat[0][0],
						'posisilong' => $posisilong[0][0],
						'sk_pendiri' => $sk_pendiri[0][0],
						'tgl_sk_pendiri' => $tgl_sk_pendiri[0][0],
						'status_milik' => $status_milik[0][0],
						'sk_izin' => $sk_izin[0][0],
						'tgl_sk_izin' => $tgl_sk_izin[0][0],
						'kbth_khss_dlayani' => $kbth_khss_dlayani[0][0],
						'no_rek' => $no_rek[0][0],
						'nama_bank' => $nama_bank[0][0],
						'cabang_bank' => $cabang_bank[0][0],
						'nama_rek' => $nama_rek[0][0],
						'mbs' => $mbs[0][0],
						'l_tanah_milik' => $l_tanah_milik[0][0],
						'l_tanah_nomilik' => $l_tanah_nomilik[0][0],
						'nama_wajib_pajak' => $nama_wajib_pajak[0][0],
						'npwp' => $npwp[0][0],
						'no_telp' => $no_telp[0][0],
						'no_fax' => $no_fax[0][0],
						'email' => $email[0][0],
						'website' => $website[0][0],
						'w_penyelenggara' => $w_penyelenggara[0][0],
						'sedia_bos' => $sedia_bos[0][0],
						'sert_iso' => $sert_iso[0][0],
						'sumber_listrik' => $sumber_listrik[0][0],
						'daya_listrik' => $daya_listrik[0][0],
						'internet' => $internet[0][0],
						'internet_alter' => $internet_alter[0][0],
						'cukup_air' => $cukup_air[0][0],
						'memproses_air' => $memproses_air[0][0],
						'air_minum' => $air_minum[0][0],
						'siswa_air_minum' => $siswa_air_minum[0][0],
						'jml_wc_khusus' => $jml_wc_khusus[0][0],
						'air_sanitasi' => $air_sanitasi[0][0],
						'sedia_air' => $sedia_air[0][0],
						'tipe_wc' => $tipe_wc[0][0],
						'jml_tmp_cuci' => $jml_tmp_cuci[0][0],
						'sabun_air' => $sabun_air[0][0],
						'jml_wc_bisa_laki' => $jml_wc_bisa[0][0],
						'jml_wc_bisa_perem' => $jml_wc_bisa[0][2],
						'jml_wc_bisa_bersama' => $jml_wc_bisa[0][4],
						'jml_wc_tidak_laki' => $jml_wc_tidak[0][0],
						'jml_wc_tidak_perem' => $jml_wc_tidak[0][2],
						'jml_wc_tidak_bersama' => $jml_wc_tidak[0][4]
					);

				unlink($inputFileName);
			echo json_encode($data);
	}

	public function getDialogImport()
	{
		$this->load->view('dashboard/sekolah/importprofile');
	}

	public function simpanData()
	{
		$json = file_get_contents('php://input');
        $obj = json_decode($json);

    	$where = array("npsn"=>$obj->{'npsn'});
    	$hasil = $this->profile->validasi($obj,$where);
    	if($hasil>0){
    		echo json_encode(array("status"=>"berhasil"));
    	}
	}

	public function getProfile(){
		$kode_sekolah = $this->session->userdata('npsn');
		$hasil = $this->profile->getProfile($kode_sekolah);
		echo json_encode($hasil);
	}
	function getKab()
	{	
		$data['kab'] = $this->siswa->getKab();
		echo json_encode($data);
	}

	function getJenjang()
	{
		$data['jenjang'] = $this->siswa->getJenjang();
		echo json_encode($data);
	}
}