<?php

class Import_soal extends CI_Controller {

    function __construct(){
		parent::__construct();
        $this->load->library("curl_func");
    }
    
    public function index(Type $var = null)
    {
        # code...
    }
}