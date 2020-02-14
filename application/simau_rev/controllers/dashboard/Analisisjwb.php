<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Analisisjwb extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->sesi->check_session();
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('Model_analisis','analisis');
		$this->load->model("model_banding","banding");
	}

	public function index(){
		redirect('dashboard/analisisjwb/g_jwbpie');
	}

	public function g_jwbpie()
	{
		$this->template->display('dashboard/report/grafjwb');
	}

	public function g_jwbnilai()
	{
		$this->template->display('dashboard/report/grafNilai');
	}

	public function g_jwbnilaiv()
	{
		$this->template->display('dashboard/report/grafNilaiv');
	}

	public function getMain()
	{
		$kode = $this->input->post('kode');
			$jml = 0;
		if($kode == '1'){
			$jml = 50;
		}else{
			$jml = 40;
		}
		$data['jml'] = $jml;
		$this->load->view('uptd/analisis/maingraf',$data);
	}

	function getAnalisis()
    {
		$where = '';
		$kode = $this->input->post('kode');
		$jenjang = $this->input->post('jenjang');
		$kecamatan = $this->input->post('kecamatan');
		$sekolah = $this->input->post('sekolah');
		if($kecamatan != '' && $sekolah == ''){
			$where = array("kd_matpel"=>$kode,'kecamatan'=>$kecamatan,'jenjang'=>$jenjang);
		}else if($kecamatan != '' && $sekolah != ''){
			$where = array("kd_matpel"=>$kode,'kecamatan'=>$kecamatan,'jenjang'=>$jenjang,'kd_sekolah'=>$sekolah);
		}else{
			$where = array("kd_matpel"=>$kode);
		}
        $data = array();
        for ($i=1; $i <=50 ; $i++) { 
            $hasil = $this->analisis->getAnalisis($i,$where);
            $data[] = $hasil;
        }
        $akhir['datanomor'] = $data;
        echo json_encode($akhir);
    }


    public function getGrafNilai()
    {
		$kec = $this->input->post('kec');
		$npsn = $this->input->post('npsn');
		$jenjang = $this->input->post("jenjang");
		$hasil = $this->analisis->getGrafNilai($kec,$npsn,$jenjang);
		if(isset($hasil)){
			$data = array();
			foreach ($hasil as $sekolah) {
				$row = array();
				$row['name'] = $sekolah->matpel;
				$row['data'] = array(floatval($sekolah->nilai));
				$data[] = $row;
			}
			$fix['status'] = array("status"=>true);
			$fix['data'] = $data;
			echo json_encode($fix);
		}else{
			echo  json_encode(array("status"=>false));
		}
    }

	public function getGrafNilaiv()
	{
		/*$jenjang = $this->input->post('jenjang');
		$matapel = $this->analisis->getMatpel();
		$kecamatan = $this->analisis->getKecamatan();
		$d_keca = array();
		$master = array();
		foreach ($matapel as $matpel) {
			$hasil = $this->analisis->getGrafNilaiv($jenjang,$matpel->id);
			$row = array();
			$row1 = array();
			$row['name'] = $matpel->matpel;
			foreach ($hasil as $data) {
				$row1[] = floatval($data->ratarata);
			}
			$row['data'] = $row1;
			$master[] = $row;
		}
		foreach ($kecamatan as $kec) {
			$d_keca[] = $kec->kecamatan;
		}
		$output['data'] = $master;
		$output['kecamatan'] = $d_keca;
		echo json_encode($output);*/

		$jenjang = $this->session->userdata('npsn');
		$param = $this->input->post('matpel');
		$matapel = array();
		if($param != ''){
			$matapel = $this->analisis->getMatpel_param($param);
		}else{
			$matapel = $this->analisis->getMatpel($jenjang);
		}
		$kecamatan = $this->analisis->getSekolah2($param);
		$d_keca = array();
		$master = array();
		foreach ($matapel as $matpel) {
			$hasil = $this->analisis->getGrafNilaiv($jenjang,$matpel->id,$param);
			$row = array();
			$row1 = array();
			$row['name'] = $matpel->matpel;
			$mata = "";
			if($matpel->id == 1){
				$mata = 'indo';
			}else if($matpel->id == 2){
				$mata = 'ipa';
			}else{
				$mata = 'matematika';
			}
			foreach ($hasil as $data) {
				if(floatval($data->{$mata}) >=0 && floatval($data->{$mata}) <= 60){
					$row1[] = array("y"=>floatval($data->{$mata}),"color"=>"red");
				}else if(floatval($data->{$mata}) >= 60.1 and floatval($data->{$mata}) <= 70){
					$row1[] = array("y"=>floatval($data->{$mata}),"color"=>"yellow");
				}else{
					$row1[] = array("y"=>floatval($data->{$mata}),"color"=>"#008aff");
				}
			}
			$row['data'] = $row1;
			$master[] = $row;
		}
		foreach ($kecamatan as $kec) {
			$d_keca[] = $kec->namasekolah;
		}
		$output['data'] = $master;
		$output['nama_sekolah'] = $d_keca;
		$output['tinggi'] = '';
		echo json_encode($output);
	}

    public function generateGraf()
    {
		$jenjang = $this->input->post("jenjang");
		if($jenjang == 'SD'){
			$this->getGrafNilaiv();
		}else{
			if($this->input->post("kelas") == 9 )
				$this->getGrafNilaiKelas9();
			else
				$this->getGrafNilaiSmp();
		}
    }

	private function getGrafNilaiSmp(){
		
	}

    private function getGrafNilaiKelas9()
    {
		$tahun = $this->input->post("thn_upload");
		$kecamatan = $this->input->post("kecamatan");
		$param = $this->input->post('matpel');
		$kcm = $this->banding->getKCM();
		$n_sekolah = array();
		$master = array();
		$matapel = array();
		if($param != ''){
			$matapel = $this->analisis->getMatpel_param($param);
		}else{
			$matapel = $this->analisis->getMatpel($this->input->post("jenjang"));
		}
		if(count($matapel) == 1){
			foreach($matapel as $mat){
				$hasil = $this->analisis->getGrafNilaiSmp($tahun,$kecamatan,$mat->id);
			}
		}
		else
			$hasil = $this->analisis->getGrafNilaiSmp($tahun,$kecamatan);
		
		$nomor =0;
		foreach ($matapel as $matpel) {
			$row = array();
			$row1 = array();
			$row['name'] = $matpel->matpel;
			$mata = "";
			switch($matpel->id){
				case 1 : $mata = "bin";break;
				case 2 : $mata = "ipa"; break;
				case 3 : $mata = "mat"; break;
				case 4 : $mata = "ing"; break;
				default : $mata = "tot"; break;
			}
			foreach($hasil as $data){
				foreach ($kcm as $nilai){
					if(floatval($data->{$mata}) > $nilai->min && floatval($data->{$mata}) <= $nilai->max){
						$row1[] = array("y"=>floatval($data->{$mata}),"color"=>$nilai->color);
					}
				}
				if($nomor == 0){
					$n_sekolah[]= $data->nama_sekolah;
				}
			}
			$row['data'] = $row1;
			$master[] = $row;
			$nomor++;
		}
		$output['data'] = $master;
		$output['nama_sekolah'] = $n_sekolah;
		$base_height = 300;
		if($n_sekolah > 10){
			$output['tinggi'] = $base_height * (count($n_sekolah)/10 + 0.5);
		}else{
			$output['tinggi'] = $base_height;
		}
		echo json_encode($output);
    }

}
?>