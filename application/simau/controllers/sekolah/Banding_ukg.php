<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Banding_ukg extends CI_Controller{
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
		$this->load->library('Template');
		$this->load->model('sekolah/Model_profile','profile');
	}

	public function index(){
		$data['profile'] = $this->profile->getProfile($this->session->userdata('npsn'));
		$this->template->display("sekolah/dokumen/Banding_ukg",$data);
	}

}