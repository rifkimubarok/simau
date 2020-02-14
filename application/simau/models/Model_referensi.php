<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_referensi extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getJenjang()
	{
		$this->db->select("DISTINCT(jenjang) as jenjang");
		$hasil = $this->db->get("tbl_sekolah");
		return $hasil->result();
	}

	public function getJnsUjian()
	{
		return $this->db->get("ref_ujian")->result();
	}
}