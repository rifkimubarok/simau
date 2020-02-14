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
		$this->load->model('managemen/Model_analisis','analisis');
	}

	public function index(){
		redirect('managemen/Analisisjwb/g_jwbpie');
	}

	public function g_jwbpie()
	{
		$this->template->display('managemen/analisis/grafjwb');
	}

	public function g_jwbnilai()
	{
		$this->template->display('managemen/analisis/grafNilai');
	}

	public function g_jwbnilaiv()
	{
		$this->template->display('managemen/analisis/grafNilaiv');
	}

}
?>