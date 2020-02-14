<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_profile extends CI_Model
{
    public $_table = 'tbl_sekolah';
	function __construct()
	{
		parent::__construct();
	}

    public function simpanData($data,$where)
    {
        $this->db->where($where);
        $hasil = $this->db->update($this->_table,$data);
        return $hasil;
    }

    public function getProfile($kode_sekolah){
        $this->db->where(array('npsn'=>$kode_sekolah));
        $hasil = $this->db->get($this->_table);
        return $hasil->row();
    }
}