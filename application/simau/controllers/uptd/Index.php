<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Index extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
		$this->load->library('Template');
		$this->load->model('sekolah/Model_sekolah','sekolah');
		$this->load->model('Model_infograf','info');
	}

	function index(){
		$kode_sekolah = $this->session->userdata('npsn');
		$hasil = $this->sekolah->infoGraf($kode_sekolah);
		$hsl = $this->info->getBanyakMuridPerkelas_Pengelola($kode_sekolah);
		$data['jmlmurid'] = $hasil;
		$data['SD'] = $this->info->getBanyakSD();
		$data['SMP'] = $this->info->getBanyakSMP();
		$data['Total_Sekolah'] = $this->info->getBanyakSekolah();
		$data['Total_Guru'] = $this->info->getBanyakTotalGuru();
		$data['Total_Tendik'] = $this->info->getBanyakTotalTendik();
		$data['JmlLaki'] = $this->info->getBanyakLaki();
		$data['JmlPerempuan'] = $this->info->getBanyakPerempuan();
        $this->template->display('uptd/main', $data);
	}

	function getGrafikMuridPerkelas()
	{
		$hasil = $this->info->getBanyakMuridPerkelas_Pengelola();
		$data = array();
		$name = array();
		foreach ($hasil as $value) {
		 	$row = array("name"=>"Kelas ".$value->id_kelas,"data"=>array(intval($value->jmlLaki),intval($value->jmlPerem)));
			$data[] = $row;
		 } 
		$output['data'] = $data;
		echo json_encode($output);
	}

}