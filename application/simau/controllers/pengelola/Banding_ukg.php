<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Banding_ukg extends CI_Controller{
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('pengelola/Model_banding','banding');
	}

	public function index(){
		$this->template->display("pengelola/analisis/bandingukgun");
	}

	function getAnalisis()
	{
		$jenjang = $this->input->post('jenjang');
		$kecamatan = $this->input->post('kecamatan');
		$sekolah = $this->input->post('sekolah');
		$matpel = $this->input->post('matpel');
		$kelas = $this->input->post('kelas');
		$tahun = $this->input->post('tahun');
		$hasil = $this->banding->getAnalisis($jenjang,$kecamatan,$sekolah,$matpel,$kelas,$tahun);
		$kcm = $this->banding->getKCM();
		$matapelajaran = $this->banding->getMatpel();
		$datamatpel = array();
		foreach ($matapelajaran as $mata) {
			$datamatpel[] = $mata->matpel;
		}
		$master = array();
		if($hasil > 0){
			for ($i=1; $i <=2 ; $i++) { 
			$kolom1 = '';$kolom2 = '';
			if($i == 1){
				$kolom1 = "Hasil UKG Guru";
				$kolom2 = "nilaiukg";
			}else{
				$kolom1 = "Hasil Ujian Siswa";
				$kolom2 = "nilaisiswa";
			}
			$data = array();
			$data['name'] = $kolom1;
			$data1 = array();
			foreach ($hasil as $a) {
					if($i == 1){
						if(floatval($a->{$kolom2}) >=75){
							$data1[] = array("y"=>floatval($a->{$kolom2}),"color"=>"black");
						}else{
							$data1[] = array("y"=>floatval($a->{$kolom2}),"color"=>"red");
						}
					}else{
						foreach ($kcm as $dat) {
							if(floatval($a->{$kolom2}) > $dat->min && floatval($a->{$kolom2}) <= $dat->max){
								$data1[] = array("y"=>floatval($a->{$kolom2}),"color"=>$dat->color);
							}
						}
					}
				}
				$data['data'] = $data1;
				$master[] = $data;
			}
			$label = array();
			$flabel = "kecamatan";
			if(($kecamatan != "" or $kecamatan != null) and ($sekolah =="" or $sekolah == null)){
				$flabel = "namasekolah";
			}
			if($matpel != '' or $matpel != null){
				foreach ($hasil as $b) {
						$z = intval($b->kd_matpel)-1;
						$label[] = $b->nama.'('.$datamatpel[$z].'),(Kelas '.$b->kelas.')';
				}
			}else{
				foreach ($hasil as $b) {
					if($sekolah!= '' or $sekolah != null){
						$z = intval($b->kd_matpel)-1;
						$label[] = $b->nama.'('.$datamatpel[$z].'),(Kelas '.$b->kelas.')';
					}else{
						$label[] = $b->{$flabel};
					}
				}
			}
			$output['label'] = $label;
			$output['tinggi'] = '';
			$output['data'] = $master;
			echo json_encode($output);
		}
	}
}