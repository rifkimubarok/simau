<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_matapelajaran extends CI_Model
{
	public $_table = 'm_modul';
	function __construct()
	{
		parent::__construct();
	}

	public function getMapel_param($id)
	{
		$where = array("id"=>$id);
		$this->db->select("nama");
		$this->db->where($where);
		$hasil = $this->db->get('m_mapel');
		if($hasil->num_rows()>0){
			$data = $hasil->row();
			return $data->nama;
		}else{
			return "-";
		}
	}

}