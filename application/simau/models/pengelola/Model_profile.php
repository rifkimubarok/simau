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

    public function validasi($data,$where){
        $return = 0;
        $this->db->where($where);
        $hasil = $this->db->get($this->_table);
        if($hasil->num_rows()>0){
            $hasil1 = $this->simpanData($data,$where);
            $return = $hasil1;
        }else{
            $hasil2 = $this->addData($data);
            $return = $hasil2;
        }

        return $return;
    }

    public function simpanData($data,$where)
    {
        $this->db->where($where);
        $hasil = $this->db->update($this->_table,$data);
        return $hasil;
    }

    public function addData($data){
        $hasil = $this->db->insert($this->_table,$data);
        return $hasil;
    }

    public function getProfile($kode_sekolah){
        $this->db->where(array('npsn'=>$kode_sekolah));
        $hasil = $this->db->get($this->_table);
        return $hasil->row();
    }
}