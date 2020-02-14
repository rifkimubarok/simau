<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_grafik extends CI_Model
{
	public $_table = 'm_modul';
	function __construct()
	{
		parent::__construct();
	}

	/*public function getAnalisis($kecamatan,$jenjang)
	{
		$kcm = $this->getKCM();
		$this->db->select("Count(a.id) AS jml,	SUM(CASE WHEN nilai >= ".$kcm[0]->min." THEN 1 ELSE 0 END) as upkcm,	SUM(CASE WHEN nilai >= ".$kcm[1]->min." AND nilai < ".$kcm[1]->max." THEN 1 ELSE 0 END) as minkcm,	e.nama,	d.kecamatan");
		$this->db->from("tr_ikut_ujian AS a");
		$this->db->join("m_siswa AS b","ON a.id_user = b.id","inner");
		$this->db->join("tbl_guru AS c","ON c.no_peserta = b.nim","inner");
		$this->db->join("tbl_sekolah AS d","ON c.kode_sekolah = d.npsn","inner");
		$this->db->join("m_mapel AS e","ON b.id_matpel = e.id","inner");
		$this->db->where(array("d.jenjang"=>$jenjang));
		if($kecamatan != '' || $kecamatan != null){
			$this->db->where(array("d.kecamatan"=>$kecamatan));
		}
		$this->db->group_by("e.nama");
		$hasil = $this->db->get();
		if($hasil->num_rows()>0){
			return $hasil->result();
		}else{
			return 0;
		}
	}*/


	public function getAnalisis($kecamatan)
	{
		$kcm = $this->getKCM();
		$this->db->select("c.matpel as nama,SUM(CASE WHEN a.nilai_total >= ".$kcm[0]->min." THEN 1 ELSE 0 END) as upkcm,SUM(CASE WHEN a.nilai_total >=".$kcm[1]->min." AND a.nilai_total < ".$kcm[1]->max." THEN 1 ELSE 0 END) as minkcm");
		$this->db->from('tbl_hasil_ukg AS a');
		$this->db->join("tbl_sekolah AS b","ON a.kd_sekolah = b.npsn","inner");
		$this->db->join("ref_matpel AS c","ON a.kd_matpel = c.kd_matpel","inner");
		if($kecamatan != '' || $kecamatan != null){
			$this->db->where(array("b.kecamatan"=>$kecamatan));
		}
		$this->db->group_by("c.matpel");
		$hasil = $this->db->get();
		if($hasil->num_rows()>0){
			return $hasil->result();
		}else{
			return 0;
		}
	}

	

	public function grafJmlGuruMapel()
	{
		$this->db->select("Count(b.id) AS jumlah,a.matpel AS nama");
		$this->db->from("ref_matpel AS a");
		$this->db->join("tbl_guru AS b","ON b.kd_matpel = a.kd_matpel","inner");
		$this->db->group_by("a.matpel");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0){
			return $hasil->result();
		}else{
			return 0;
		}
	}

	public function getKecamatan()
	{
		$this->db->select("kecamatan");
		$this->db->group_by("kecamatan");
		$this->db->order_by("kecamatan");
		$hasil = $this->db->get("tbl_sekolah");
		if($hasil->num_rows()>0){
			return $hasil->result();
		}else{
			return 0;
		}
	}

	public function getKCM()
	{
		$this->db->where(array("jenis"=>"guru"));
		$hasil = $this->db->get("ref_kcm")->result();
		$data = array();
		foreach ($hasil as $row) {
			$row1 = array();
			$row1['min'] = $row->min;
			$row1['max'] = $row->max;
			$row1['color'] = $row->color;
			$data[]= $row;
		}
		return $data;
	}

	public function getAnalisisPerModul($kecamatan = null,$jenjang = null,$kd_matpel = null)
	{
		$kcm = $this->getKCM();
		$selectquery = '';
		for ($i=1; $i <= 10 ; $i++) { 
			$selectquery .= 'SUM(CASE WHEN ((a.peda'.$i.'+a.prof'.$i.')/2) >= '.$kcm[0]->min.' THEN 1 ELSE 0 END) as upmodul'.$i.',';
			$selectquery .= 'SUM(CASE WHEN ((a.peda'.$i.'+a.prof'.$i.')/2) >= '.$kcm[1]->min.' AND ((a.peda'.$i.'+a.prof'.$i.')/2) < '.$kcm[1]->max.' THEN 1 ELSE 0 END) as minmodul'.$i;
			if($i != 10){
				$selectquery .= ',';
			}
		}
		$this->db->select($selectquery);
		$this->db->from("tbl_hasil_ukg as a");
		$this->db->join("tbl_sekolah as b","ON a.kd_sekolah = b.npsn","inner");
		if($kecamatan != null and $kecamatan != ''){
			$this->db->where(array("b.kecamatan"=>$kecamatan));
		}
		if($jenjang != null and $jenjang != ''){
			$this->db->where(array("b.jenjang"=>$jenjang));
		}
		if($kd_matpel != null and $kd_matpel != ''){
			$this->db->where(array("a.kd_matpel"=>$kd_matpel));
		}
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			return $hasil->result();
		}else{
			return 0;
		}
	}

}