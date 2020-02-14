<?php
class Map_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function get_coordinates($kec, $jenjang)
	{
		$return = array();
		if (isset($_GET['kec']) && $_GET['kec'] != ""){
            $this->db->where("a.kecamatan",$kec);
        }
        if (isset($_GET['jenjang']) && $_GET['jenjang'] != ""){
            $this->db->where("a.jenjang",$jenjang);
        }
		$this->db->select('a.npsn,a.namasekolah, a.posisilat, a.posisilong, a.alamat, a.rt,a.rw,a.kodepos,a.kelurahan,a.kecamatan,a.kabupaten,a.provinsi, a.jenjang,(CASE WHEN tot/ (CASE WHEN a.jenjang = "SD" THEN 3 ELSE 4 END) BETWEEN 70	AND 100 THEN "university2.png" WHEN tot BETWEEN 60	AND 70 THEN	"university3.png" ELSE "university4.png" END) as icon');
		$this->db->where("a.posisilat IS NOT NULL and a.posisilong IS NOT NULL and a.posisilat != '' and a.posisilong != '' and a.posisilat != 'NULL' and a.posisilong != 'NULL'");
		$this->db->from('tbl_sekolah a');
		$this->db->join('v_rekapjwbsek b','on a.npsn = b.kd_sekolah','left');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			foreach ($query->result() as $row) {
				array_push($return, $row);
			}
		}
		return $return;
	}

	function getJmlSiswa($idsekolah){
		$hasil = $this->db->query('SELECT ifnull((SELECT COUNT(nisn) FROM ref_siswa WHERE id_kel = "1" and id_sekolah = "'.$idsekolah.'"),0) as jmlL, ifnull((SELECT COUNT(nisn) FROM ref_siswa WHERE id_kel = "2" and id_sekolah = "'.$idsekolah.'"),0) as jmlP,ifnull((SELECT COUNT(id_guru) FROM ref_guru WHERE id_sekolah = "'.$idsekolah.'"),0) as jmlGuru');
		return $hasil->row();
	}

	function getMaps(){
		$this->db->select('a.npsn,a.namasekolah, a.posisilat, a.posisilong, a.alamat, a.rt,a.rw,a.kodepos,a.kelurahan,a.kecamatan,a.kabupaten,a.provinsi, a.jenjang,(CASE WHEN tot/3 BETWEEN 70	AND 100 THEN "university2.png" WHEN tot BETWEEN 60	AND 70 THEN	"university3.png" ELSE "university4.png" END) as icon');
		$this->db->where("a.posisilat IS NOT NULL and a.posisilong IS NOT NULL and a.posisilat != '' and a.posisilong != '' and a.posisilat != 'NULL' and a.posisilong != 'NULL'");
		$this->db->from('tbl_sekolah a');
		$this->db->join('v_rekapjwbsek b','on a.npsn = b.kd_sekolah','left');
		$hasil = $this->db->get();
		return $hasil->result();
	}
	function _get_custom_map()
    {
        

    }
}