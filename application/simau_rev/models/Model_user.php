<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_user extends CI_Model {

		public function cek_user($data) {
			$query = $this->db->get_where('tbl_pengguna', $data);
			return $query;
		}

		public function getJenjang($kode_sekolah)
		{
			$this->db->where('npsn',$kode_sekolah);
			$this->db->select("jenjang");
			$hasil = $this->db->get('tbl_sekolah');
			if($hasil->num_rows()>0){
				$data = $hasil->row();
				return $data->jenjang;
			}else{
				return 0;
			}
		}
	}
?>