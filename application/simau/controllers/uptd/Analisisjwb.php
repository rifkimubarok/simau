<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Analisisjwb extends CI_Controller{
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('uptd/Model_analisis','analisis');
	}

	public function index(){
		redirect('uptd/Analisisjwb/g_jwbpie');
	}

	public function g_jwbpie()
	{
		$this->template->display('uptd/analisis/grafjwb');
	}

	public function g_jwbnilai()
	{
		$this->template->display('uptd/analisis/grafNilai');
	}

	public function g_jwbnilaiv()
	{
		$this->template->display('uptd/analisis/grafNilaiv');
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

    public function getMatpel()
    {
      $kode = "";
      if(isset($_POST['jenjang'])){
        $kode = $this->input->post('jenjang');
      }
    	if($kode != ''){
        $hasil = $this->analisis->getMatpel($kode);
      }else{
        $hasil = $this->analisis->getMatpel();
      }
    	$data['matpel'] = $hasil;
    	echo json_encode($hasil);
    }

    function getSekolah()
    {
    	$kec = $this->session->userdata('kecamatan');
      $jenjang = $this->session->userdata('npsn');
      $where = array("kecamatan"=>$kec,'jenjang'=>$jenjang);  
    	$hasil = $this->analisis->getSekolah($where);
    	$data['sekolah'] = $hasil;
    	echo json_encode($data);
    }

    public function getGrafNilai()
    {
    	$kec = $this->session->userdata('kecamatan');
    	$npsn = $this->input->post('npsn');
    	$hasil = $this->analisis->getGrafNilai($kec,$npsn);
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
      $jenjang = $this->session->userdata('npsn');
      if($jenjang == 'SD'){
          $this->getGrafNilaiv();
      }else{
        $this->getGrafNilaiSmp();
      }
    }


    public function getGrafNilaiSmp()
    {

      $param = $this->input->post('matpel');
      $nama_sekolah = $this->analisis->getNamaSekolah($param);
      $n_sekolah = array();
      $master = array();
      $matapel = array();
      if($param != ''){
          $matapel = $this->analisis->getMatpel_param($param);
      }else{
          $matapel = $this->analisis->getMatpel();
      }
      foreach ($matapel as $matpel) {
        $hasil = $this->analisis->getGrafNilaiSmp($matpel->id,$param);
        $row = array();
        $row1 = array();
      $row['name'] = $matpel->matpel;
        $mata = "";
        if($matpel->id == 1){
            $mata = 'bin';
        }else if($matpel->id == 2){
            $mata = 'ipa';
        }else if($matpel->id == 3){
            $mata = 'mat';
        }else if($matpel->id == 4){
            $mata = 'ing';
        }
        foreach ($hasil as $data) {
          if(floatval($data->{$mata}) >=0 && floatval($data->{$mata}) <= 6.00){
            $row1[] = array("y"=>floatval($data->{$mata}),"color"=>"red");
          }else if(floatval($data->{$mata}) >= 6.01 and floatval($data->{$mata}) <= 7){
            $row1[] = array("y"=>floatval($data->{$mata}),"color"=>"yellow");
          }else{
            $row1[] = array("y"=>floatval($data->{$mata}),"color"=>"#008aff");
          }
        }
        $row['data'] = $row1;
        $master[] = $row;
      }
      foreach ($nama_sekolah as $kec) {
        $n_sekolah[] = $kec->nama_sekolah;
      }
      $output['data'] = $master;
      $output['nama_sekolah'] = $n_sekolah;
      $output['tinggi'] = '300%';
      echo json_encode($output);
    }

}
?>