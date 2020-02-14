<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_home extends CI_Model
{
	public $_table = 'm_modul';
	function __construct()
	{
		parent::__construct();
	}

	public function getStatic()
	{
		$data['allSD'] = $this->getAllSD();
		$data['allSMP'] = $this->getAllSMP();
		$data['all'] = $this->getAll();
		$data['jmlmapel'] = $this->getAllMapel();
		return $data;
	}

	public function getAllSD()
	{
		$this->db->select('count(*) as nomor');
		$this->db->where(array("jenjang"=>"SD"));
		$hasil = $this->db->get('m_siswa');
		if($hasil->num_rows()>0){
			$data = $hasil->row();
			return $data->nomor;
		}else{
			return 0;
		}
	}

	public function getAllSMP()
	{
		$this->db->select('count(*) as nomor');
		$this->db->where(array("jenjang"=>"SMP"));
		$hasil = $this->db->get('m_siswa');
		if($hasil->num_rows()>0){
			$data = $hasil->row();
			return $data->nomor;
		}else{
			return 0;
		}
	}

	public function getAll()
	{
		$this->db->select('count(*) as nomor');
		$hasil = $this->db->get('m_siswa');
		if($hasil->num_rows()>0){
			$data = $hasil->row();
			return $data->nomor;
		}else{
			return 0;
		}
	}

	public function getAllMapel()
	{
		$this->db->select('count(*) as nomor');
		$hasil = $this->db->get('m_mapel');
		if($hasil->num_rows() >0 ){
			$data = $hasil->row();
			return $data->nomor;
		}else{
			return 0;
		}
	}

	public function getJenjang()
	{
		$this->db->select("DISTINCT(jenjang) as jenjang");
		$hasil = $this->db->get("tbl_sekolah");
		return $hasil->result();
	}

	public function getMapel()
	{
		$this->db->select("kd_matpel,matpel");
		$hasil = $this->db->get("ref_matpel");
		return $hasil->result();
	}
}