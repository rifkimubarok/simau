<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Referensi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->sesi->check_session();
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('model_referensi','ref');
		$this->load->library('libkebutuhan');
    }

    function getKec()
	{	
		$data['kec'] = $this->ref->getKec();
		echo json_encode($data);
	}

	function getJenjang()
	{
		$data['jenjang'] = $this->ref->getJenjang();
		echo json_encode($data);
	}

	
	function getSekolah()
	{
		$data['sekolah'] = $this->ref->getSekolah($this->input->get('kec'),$this->input->get('jenjang'));
		echo json_encode($data);
	}

	public function getMatpel()
    {
		$kode = "";
		if(isset($_POST['jenjang'])){
			$kode = $this->input->post('jenjang');
		}
			if($kode != ''){
			$hasil = $this->ref->getMatpel($kode);
		}else{
			$hasil = $this->ref->getMatpel();
		}
		$data['matpel'] = $hasil;
		echo json_encode($hasil);
    }
}