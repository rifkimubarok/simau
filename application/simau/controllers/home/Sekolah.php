<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Sekolah extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('Template');
	}

	function index(){
        $this->template->display('siswa/addsiswa');
	}
}