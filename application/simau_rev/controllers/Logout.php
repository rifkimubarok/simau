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
		$this->sesi->check_session();
	}

	function index(){
		unset_session("user");
		redirect('Landing');
	}
}