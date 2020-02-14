<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Banding_ukg extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->sesi->check_session();
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('Model_banding','banding');
	}

	public function index(){
		$this->template->display("dashboard/report/bandingukgun");
	}
	
	function getAnalisis()
	{
		$jenjang = $this->input->post('jenjang');
		$kecamatan = $this->input->post('kecamatan');
		$sekolah = $this->input->post('sekolah');
		$matpel = $this->input->post('matpel');
		$kelas = $this->input->post('kelas');
		$tahun = $this->input->post('tahun');
		if($kelas == 9){
			if($matpel != ''){
				$mapel = $this->banding->get_mapel_code(array("id"=>$matpel));
			}else{
				$mapel = $matpel;
			}
			$hasil = $this->banding->get_analisis_hasil_un($jenjang,$kecamatan,$sekolah,$mapel,$kelas,$tahun);
		}else{
			$hasil = $this->banding->getAnalisis($jenjang,$kecamatan,$sekolah,$matpel,$kelas,$tahun);
		}
		$kcm_siswa = $this->banding->getKCM();
		$kcm_guru = $this->banding->getKCM("guru");
		$matapelajaran = $this->banding->getMatpel();
		$datamatpel = array();
		foreach ($matapelajaran as $mata) {
			$datamatpel[] = $mata->matpel;
		}
		$master = array();
		$label = [];
		$dataukg = [];
		$datasiswa = [];
		if($hasil>0){
			foreach ($hasil as $row) {
				$flabel = "kecamatan";
				if(($kecamatan != "" or $kecamatan != null) and ($sekolah =="" or $sekolah == null)){
					$flabel = "namasekolah";
				}
				if($sekolah!= '' or $sekolah != null){
					// $z = intval($row->kd_matpel)-1;
					if($kelas == 9){
						$label[] = $row->nama.'('.$row->mata_pelajaran.'),(Kelas 9)';
					}else{
						$label[] = $row->nama.'('.$row->mata_pelajaran.'),(Kelas '.$row->kelas.')';
					}
				}else{
					$label[] = $row->{$flabel};
				}
				foreach ($kcm_guru as $dat) {
					if(floatval($row->nilaiukg) > $dat->min && floatval($row->nilaiukg) <= $dat->max){
						$dataukg[] = array("y"=>floatval($row->nilaiukg),"color"=>$dat->color);
					}
				}
				if($kelas == 9){
					if($matpel == ''){
						if($sekolah != ''){
							$mapel = $this->banding->get_mapel_code(array("kd_matpel"=>$row->kd_matpel));
							$nilaisiswa = $this->get_nilai($mapel,$row);
						}else{
							$nilaisiswa = ($row->rat_bin+$row->rat_ing+$row->rat_mat+$row->rat_ipa)/4 ;
						}
					}else{
						$nilaisiswa = $this->get_nilai($mapel,$row);
					}
				}else{
					$nilaisiswa = $row->nilaisiswa;
				}
				foreach ($kcm_siswa as $dat) {
					if(floatval($nilaisiswa) > $dat->min && floatval($nilaisiswa) <= $dat->max){
						$datasiswa[] = array("y"=>floatval($nilaisiswa),"color"=>$dat->color);
					}
				}
			}
		}
		$output = [
			"label"=>$label,
			"data"=>[
				[
					"name"=>"Hasil UKG Guru",
					"data"=>$dataukg
				],
				[
					"name" => "Hasil Ujian Siswa",
					"data"=>$datasiswa
				]
			]
		];
		$base_height = 300;
		if($label > 10){
			$output['tinggi'] = $base_height * (count($label)/10 + 0.5);
		}else{
			$output['tinggi'] = $base_height;
		}
		echo json_encode($output);
	}

	private function get_nilai($matpel,$row){
		$nilaisiswa = 0;
		switch($matpel->id){
			case 1 : $nilaisiswa = $row->rat_bin;break;
			case 2 : $nilaisiswa = $row->rat_ipa;break;
			case 3 : $nilaisiswa = $row->rat_mat;break;
			case 4 : $nilaisiswa = $row->rat_ing;break;
		}
		return $nilaisiswa;
	}

	public function get_analisis_kelas_9()
	{
		$hasil = $this->banding->get_analisis_hasil_un();
		$kcm_siswa = $this->banding->getKCM();
		$kcm_guru = $this->banding->getKCM("guru");
		$label = [];
		$dataukg = [];
		$datasiswa = [];
		if($hasil>0){
			foreach ($hasil as $row) {
				$label[] = $row->namasekolah;
				foreach ($kcm_guru as $dat) {
					if(floatval($row->nilaiukg) > $dat->min && floatval($row->nilaiukg) <= $dat->max){
						$dataukg[] = array("y"=>floatval($row->nilaiukg),"color"=>$dat->color);
					}
				}
				foreach ($kcm_siswa as $dat) {
					if(floatval($row->rat_bin) > $dat->min && floatval($row->rat_bin) <= $dat->max){
						$datasiswa[] = array("y"=>floatval($row->rat_bin),"color"=>$dat->color);
					}
				}
			}
		}

		$output = [
			"label"=>$label,
			"data"=>[
				[
					"name"=>"Hasil UKG Guru",
					"data"=>$dataukg
				],
				[
					"name" => "Hasil Ujian Siswa",
					"data"=>$datasiswa
				]
			]
		];
		$base_height = 300;
		if($label > 10){
			$output['tinggi'] = $base_height * (count($label)/10 + 0.5);
		}else{
			$output['tinggi'] = $base_height;
		}
		echo json_encode($output);
	}
}