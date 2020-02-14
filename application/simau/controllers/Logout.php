<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Logout extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status')==false) {
			redirect('Landing');
		}
	}

	function index(){
		$this->session->unset_userdata('npsn');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('jabatan');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('kecamatan');
		$this->session->unset_userdata('jenjang');
		$this->session->unset_userdata('status');
		redirect('Landing');
	}
}