<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Analisisjwb extends CI_Controller{
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
		$this->load->library('Template');
		$this->load->model('pengelola/Model_analisis','analisis');
	}

	public function index(){
		redirect('pengelola/Analisisjwb/g_jwbpie');
	}

	public function g_jwbpie()
	{
		$this->template->display('pengelola/analisis/grafjwb');
	}

	public function g_jwbnilai()
	{
		$this->template->display('pengelola/analisis/grafNilai');
	}

	public function g_jwbnilaiv()
	{
		$this->template->display('pengelola/analisis/grafNilaiv');
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
		$this->load->view('pengelola/analisis/maingraf',$data);
	}

	function getAnalisis()
    {
      $where = '';
    	$kode = $this->input->post('kode');
      $jenjang = $this->input->post('jenjang');
      $kecamatan = $this->input->post('kecamatan');
      $sekolah = $this->input->post('sekolah');
      $kelas = $this->input->post('kelas');
      if($kecamatan != '' && $sekolah == ''){
        $where = array("kd_matpel"=>$kode,'kecamatan'=>$kecamatan,'jenjang'=>$jenjang);
      }else if($kecamatan != '' && $sekolah != ''){
        $where = array("kd_matpel"=>$kode,'kecamatan'=>$kecamatan,'jenjang'=>$jenjang,'kd_sekolah'=>$sekolah);
      }else{
        $where = array("kd_matpel"=>$kode,'jenjang'=>$jenjang);
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
    	$kec = $this->input->post('kec');
      if(isset($_POST['jenjang'])){
        $where = array("kecamatan"=>$kec,'jenjang'=>$this->input->post('jenjang'));
      }else{
        $where = array("kecamatan"=>$kec);
      }
    	$hasil = $this->analisis->getSekolah($where);
    	$data['sekolah'] = $hasil;
    	echo json_encode($data);
    }

    public function getGrafNilai()
    {
    	$kec = $this->input->post('kec');
      $npsn = $this->input->post('npsn');
    	$jenjang = $this->input->post('jenjang');
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
   		$jenjang = $this->input->post('jenjang');
      $param = $this->input->post('matpel');
      $keca = $this->input->post('kecamatan');
   		$kelas = $this->input->post('kelas');
      $matapel = array();
      $kcm = $this->analisis->getKCM();

      if($param != ''){
          $matapel = $this->analisis->getMatpel_param($param);
      }else{
          $matapel = $this->analisis->getMatpel($jenjang);
      }

      $d_keca = array();
   		if($keca != '' || $keca != null){
        $namasekolah = $this->analisis->getSekolahParam($param,$jenjang,$keca);
        foreach ($namasekolah as $namsek) {
          $d_keca[] = $namsek->namasekolah;
        }
      }else{
        $kecamatan = $this->analisis->getKecamatan($param,$jenjang);
        foreach ($kecamatan as $kec) {
          $d_keca[] = $kec->kecamatan;
        }
      }
   		$master = array();
      $tinggi_chart = 0;

      $hasil = $this->analisis->getGrafNilaiv($jenjang,$keca,$kelas);
      
   		foreach ($matapel as $matpel) {
   			$row = array();
   			$row1 = array();
			  $row['name'] = $matpel->matpel;
   			foreach ($hasil as $data) {
          //echo json_encode($data);
            foreach ($kcm as $dat) {
              if(floatval($data->{$matpel->singkat}) > $dat->min && floatval($data->{$matpel->singkat}) <= $dat->max){
                $row1[] = array("y"=>floatval($data->{$matpel->singkat}),"color"=>$dat->color);
                $tinggi_chart ++;
              }
            }
   			}
   			$row['data'] = $row1;
   			$master[] = $row;
   		}

   		$output['data'] = $master;
   		$output['nama_sekolah'] = $d_keca;
      $output['tinggi'] = $tinggi_chart > 50 ? $tinggi_chart *15 :'';
   		echo json_encode($output);
   		
   	}

    public function generateGraf()
    {
      $jenjang = $this->input->post('jenjang');
      if($jenjang == 'SD'){
          $this->getGrafNilaiv();
      }else{
        $this->getGrafNilaiv();
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