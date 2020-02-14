<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Banding_ukg extends CI_Controller{
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
		$this->load->library('Template');
	}

	public function index(){
		$this->template->display("managemen/analisis/bandingukgun");
	}

}