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
		$hasil = $this->db->query("SELECT DISTINCT(jenjang) as jenjang FROM `tbl_sekolah`");
		// return $hasil->result();
		return $hasil->result();
	}

	public function getJnsUjian()
	{
		return $this->db->get("ref_ujian")->result();
	}

	function getKec()
    {
        $this->db->distinct();
        $this->db->select('kecamatan');
        $hasil = $this->db->get('tbl_sekolah');
        return $hasil->result();
	}
	
	function getSekolah($kec = null,$jenjang = null)
    {   
        if($kec != null){
            $hasil = $this->db->query('SELECT npsn, namasekolah, kecamatan, jenjang FROM tbl_sekolah WHERE kecamatan ="'.$kec.'"');
        }
        if($jenjang != null){
            $hasil = $this->db->query('SELECT npsn, namasekolah, kecamatan, jenjang FROM tbl_sekolah WHERE jenjang ="'.$jenjang.'"');
        }
        if($kec != null && $jenjang != null){
            $hasil = $this->db->query('SELECT npsn, namasekolah, kecamatan, jenjang FROM tbl_sekolah WHERE kecamatan ="'.$kec.'" AND jenjang = "'.$jenjang.'"');
        }
        if($kec == null && $jenjang == null){
            $hasil = $this->db->query('SELECT npsn, namasekolah, kecamatan, jenjang FROM tbl_sekolah');
        }
        return $hasil->result();
    }

    public function getMatpel($kode = null)
    {
        if($kode!= null){
            if($kode == 'SD'){
                $this->db->limit("3");
            }else{
                $this->db->limit("4");
            }
        }
        $hasil = $this->db->get('ref_matpel');
        return $hasil->result();
    }
}