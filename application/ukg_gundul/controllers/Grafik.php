<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");
class Grafik extends CI_Controller {

	function __construct(){
		parent::__construct();
	    $this->db->query("SET time_zone='+7:00'");
		$this->load->model("Model_grafik","graf");
		$waktu_sql = $this->db->query("SELECT NOW() AS waktu")->row_array();
	    $this->waktu_sql = $waktu_sql['waktu'];
	    $this->opsi = array("a","b","c","d","e");
	}

	function getAnalisis()
	{
		//$jenjang = $this->input->post('jenjang');
		$kecamatan = $this->input->post('kecamatan');
		$hasil = $this->graf->getAnalisis($kecamatan);
		$kcm = $this->graf->getKCM();
		if($hasil > 0){
			//**** Start Looping grafik guru kcm
			for ($i=1; $i <=2 ; $i++) { 
			$kolom1 = '';$kolom2 = '';
			if($i == 1){
				$kolom1 = "di Atas KCM";
				$kolom2 = "upkcm";
			}else{
				$kolom1 = "di Bawah KCM";
				$kolom2 = "minkcm";
			}
			$data = array();
			$data['name'] = $kolom1;
			$data1 = array();
			foreach ($hasil as $a) {
					if($i == 1){
   					$data1[] = array("y"=>floatval($a->{$kolom2}),"color"=>"black");
					}else{
						$data1[] = array("y"=>floatval($a->{$kolom2}),"color"=>"red");
					}
				}
				$data['data'] = $data1;
				$master[] = $data;
			}
			//**** End Looping Grafik guru kcm

			//**** Start Looping Label Grafik
			$label = array();
			foreach ($hasil as $b) {
					$label[] = $b->nama;
			}
			//**** End Looping Label Grafik

			$output['label'] = $label;
			$output['tinggi'] = '100%';
			$output['data'] = $master;
			echo json_encode($output);
		}
	}

	//*** Grafik Persentase
	function getAnalisisPersen()
	{
		//$jenjang = $this->input->post('jenjang');
		$kecamatan = $this->input->post('kecamatan');
		$hasil = $this->graf->getAnalisis($kecamatan);
		$kcm = $this->graf->getKCM();
		if($hasil > 0){
			//**** Start Looping grafik guru kcm
			for ($i=1; $i <=2 ; $i++) { 
			$kolom1 = '';$kolom2 = '';
			if($i == 1){
				$kolom1 = "di Atas KCM";
				$kolom2 = "upkcm";
			}else{
				$kolom1 = "di Bawah KCM";
				$kolom2 = "minkcm";
			}
			$data = array();
			$data['name'] = $kolom1;
			$data1 = array();
			foreach ($hasil as $a) {
				$jmltotal = intval($a->upkcm) + intval($a->minkcm);
				$datapersen = number_format(($a->{$kolom2} / $jmltotal) * 100,2);
					if($i == 1){
   					$data1[] = array("y"=>floatval($datapersen),"color"=>"black");
					}else{
						$data1[] = array("y"=>floatval($datapersen),"color"=>"red");
					}
				}
				$data['data'] = $data1;
				$master[] = $data;
			}
			//**** End Looping Grafik guru kcm

			//**** Start Looping Label Grafik
			$label = array();
			foreach ($hasil as $b) {
					$label[] = $b->nama;
			}
			//**** End Looping Label Grafik

			$output['label'] = $label;
			$output['tinggi'] = '100%';
			$output['data'] = $master;
			echo json_encode($output);
		}
	}

	//*** Grafik Persentase Per Modul
	function getAnalisisPersenPermodul()
	{
		$jenjang = $this->input->post('jenjang');
		$kecamatan = $this->input->post('kecamatan');
		$kd_matpel = $this->input->post('kd_matpel');
		$hasil = $this->graf->getAnalisisPerModul($kecamatan,$jenjang,$kd_matpel);
		$kcm = $this->graf->getKCM();
		if($hasil > 0){
			//**** Start Looping grafik guru kcm
			for ($i=1; $i <=2 ; $i++) { 
			$kolom1 = '';$kolom2 = '';
			if($i == 1){
				$kolom1 = "di Atas KCM";
				$kolom2 = "upmodul";
			}else{
				$kolom1 = "di Bawah KCM";
				$kolom2 = "minmodul";
			}
			$data = array();
			$data['name'] = $kolom1;
			$data1 = array();
				foreach ($hasil as $a) {
					// *** Looping Modul 1 - 10
					for ($c=1; $c <=10 ; $c++) { 
						$jmltotal = intval($a->{'upmodul'.$c}) + intval($a->{'minmodul'.$c});
						$datapersen = number_format(($a->{$kolom2.$c} / $jmltotal) * 100,2);
							if($i == 1){
								// *** Nilai diatas KCM
		   						$data1[] = array("y"=>floatval($datapersen),"color"=>"black");
							}else{
								// *** Nilai dibawah KCM
								$data1[] = array("y"=>floatval($datapersen),"color"=>"red");
							}
					}
				}
			$data['data'] = $data1;
			$master[] = $data;
			}
			//**** End Looping Grafik guru kcm

			//**** Start Looping Label Grafik
			$label = array("A","B","C","D","E","F","G","H","I","J");
			//**** End Looping Label Grafik

			$output['label'] = $label;
			$output['tinggi'] = '75%';
			$output['data'] = $master;
			echo json_encode($output);
		}
	}

	//*** Function Grafik banyak guru per mapel di dasboard
	function getGrafikGuruPermapel()
	{
		$hasil = $this->graf->grafJmlGuruMapel();
		$data = array();
		$name = array();
		if($hasil >0){
			foreach ($hasil as $value) {
			 	$row = array("name"=>$value->nama,"data"=>array(intval($value->jumlah)));
				$data[] = $row;
			 } 
			$output['data'] = $data;
			echo json_encode($output);
		}
	}

	public function getKecamatan()
	{
		$hasil = $this->graf->getKecamatan();
		if($hasil>0 ){
			$data['kecamatan'] = $hasil;
			echo json_encode($data);
		}
	}

	public function getKcm()
	{
		$hasil = $this->graf->getKCM();

	}
}