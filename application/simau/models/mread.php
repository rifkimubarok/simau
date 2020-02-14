<?php	
class Mread extends CI_Model{
	function export_kontak(){
		$query = $this->db->query("SELECT * from eimport");
		
		if($query->num_rows() > 0){
			foreach($query->result() as $data){
				$hasil[] = $data;
			}
			return $hasil;
		}
	}
	function report(){
		$query = $this->db->query("SELECT * from report");
		
		if($query->num_rows() > 0){
			foreach($query->result() as $data){
				$hasil[] = $data;
			}
			return $hasil;
		}
	}
}