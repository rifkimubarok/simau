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
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('sekolah/Model_sekolah','sekolah');
		$this->load->model('Model_infograf','info');
	}

	function index(){
		$kode_sekolah = $this->session->userdata('npsn');
		$hasil = $this->sekolah->infoGraf($kode_sekolah);
		$data['jmlmurid'] = $hasil;
        $this->template->display('sekolah/main',$data);
	}

	function getGrafikMuridPerkelas()
	{
		$kode_sekolah = $this->session->userdata('npsn');
		$hasil = $this->info->getBanyakMuridPerkelas_Sekolah($kode_sekolah);
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