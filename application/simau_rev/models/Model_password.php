<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_password extends CI_Model{
	var $tbl = 'tbl_pengguna';
	public function cek($id){
		$a = $this->db->query('SELECT * FROM '.$this->tbl.' WHERE id = "'.$id.'"');
		return $a->num_rows();
	}
	public function get($id){
		$a = $this->db->query('SELECT * FROM '.$this->tbl.' WHERE id = "'.$id.'"');
		return $a->result();
	}
	public function change_pass($password, $name, $id){
		$this->db->query('UPDATE '.$this->tbl.' SET password = "'.$password.'", nama = "'.$name.'" WHERE id = "'.$id.'"');
		return $this->db->affected_rows();
	}
	public function change_username($name, $id){
		$this->db->query('UPDATE '.$this->tbl.' SET nama = "'.$name.'" WHERE id = "'.$id.'"');
		return $this->db->affected_rows();
	}
}