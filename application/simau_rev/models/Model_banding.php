<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_banding extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getAnalisis($jenjang=null,$kecamatan=null,$sekolah=null,$matpel=null,$kelas=null,$tahun=null)
    {
		if($kecamatan == "" or $kecamatan == null){
			$this->db->select("round(avg(a.nilai_total),2) as nilaiukg,round(avg(c.nilaiakhir),2) as nilaisiswa,c.kelas,d.kecamatan");
			$this->db->where(array("d.jenjang"=>$jenjang));
			$this->db->group_by("3,4");
			$this->db->order_by("d.kecamatan","asc");
		}else if(($kecamatan != "" or $kecamatan != null )AND ($sekolah == null or $sekolah == "")) {
			$this->db->select("d.namasekolah,round(avg(a.nilai_total),2) as nilaiukg,round(avg(c.nilaiakhir),2) as nilaisiswa,c.kelas,d.kecamatan");
			$this->db->where(array("d.jenjang"=>$jenjang,"d.kecamatan"=>$kecamatan));
			$this->db->group_by("1,4,5");
			$this->db->order_by("d.namasekolah","asc");
		}

		if($sekolah != "" or $sekolah != null){
			$this->db->select("b.nama,b.no_peserta,b.nuptk,b.nip,avg(a.nilai_total) as nilaiukg,b.kode_sekolah,avg(c.nilaiakhir) as nilaisiswa,c.kelas,d.kecamatan,a.mata_pelajaran");
			$this->db->where(array("d.jenjang"=>$jenjang,"d.kecamatan"=>$kecamatan,"c.kd_sekolah"=>$sekolah));
			$this->db->join("tbl_guru as b","ON b.no_peserta = a.no_peserta","INNER");
			
			$this->db->group_by("1,2,3,4,6,8,9,10");
			if($matpel == '' or $matpel == null){
				$this->db->select("c.kd_matpel");
				$this->db->group_by('11');
			}
		}

		if($matpel != '' or $matpel != null){
			$this->db->select("c.id_matpel");
			$this->db->where(array("c.id_matpel"=>$matpel));
			if ($sekolah != ''){
				$this->db->group_by('11');
			}else{
				$this->db->group_by('5');
			}
		}else{
			$this->db->where("a.kd_matpel in ('156GG000','097GG000','180GG000','157GG000')");
		}

		if($kelas != ""){
			$this->db->where(array("kelas"=>$kelas));
		}

		$this->db->from("tbl_hasil_ukg as a");
		$this->db->join("v_rekapjwbguru AS c"," `c`.`kd_sekolah` = `a`.`kd_sekolah` and c.kd_matpel = a.kd_matpel ","INNER");
		$this->db->where(array("c.thn_upload"=>$tahun,"a.tahun"=>$tahun));
		$this->db->join("tbl_sekolah AS d"," `a`.`kd_sekolah` = `d`.`npsn`","INNER");
		$hasil = $this->db->get();
		if($hasil->num_rows()>0){

			return $hasil->result();
		}else{
			return 0;
		}
    }

    public function getKCM($jenis="siswa")
    {
		$this->db->where(array("jenis"=>$jenis));
		return $this->db->get("ref_kcm")->result();
    }

    public function getMatpel()
    {
		return $this->db->get('ref_matpel')->result();
	}
	
	public function get_analisis_hasil_un($jenjang=null,$kecamatan=null,$sekolah=null,$matpel=null,$kelas=null,$tahun=null)
	{
		// initial DB
		$db = $this->db;
		// select nilai secara keseluruhan
		$db->select("round(avg(T3.nilai_total),2) as nilaiukg,round(avg(T1.bin),2) as rat_bin,round(avg(T1.ing),2) as rat_ing,
		round(avg(T1.mat),2) as rat_mat,round(avg(T1.ipa),2) as rat_ipa");
		// parameter nilai
		$db->where([
			"T2.jenjang"=>$jenjang,
			"T1.tahun"=>$tahun,
			"T3.tahun"=>2018
			]);
			
		// asal tabel
		$db->from("tbl_jml_nilai as T1");
		$db->join("tbl_sekolah T2","T1.kode_sekolah = T2.npsn","inner");
		$db->join("tbl_hasil_ukg as T3","T3.kd_sekolah = T2.npsn","inner");

		// check kecamatan not null and sekolah is null 
		// untuk menampilkan nama sekolah di kecamatan tersebut
		if( $kecamatan != "" && $sekolah == ""){
			$db->select("T2.namasekolah")
				->group_by("T2.namasekolah")
				->where(["T2.kecamatan"=>$kecamatan])
				->order_by("T2.namasekolah","asc");
		}else if($kecamatan == ""){
			$db->select("T2.kecamatan")
				->group_by("T2.kecamatan")
				->order_by("T2.kecamatan","asc");
		}

		if($matpel != ""){
			if($matpel){
				$db->where(["T3.kd_matpel"=>$matpel->kd_matpel]);
			}
		}else{
			if($sekolah != ''){
				$db->select("T3.kd_matpel")->group_by("T3.kd_matpel");
			}
			$db->where("T3.kd_matpel in ('156GG000','097GG000','180GG000','157GG000')");
		}

		// check sekolah not null
		// untuk menampilkan nama guru yang mengajar disekolah tersebut
		if($sekolah != ""){
			$db->select("T4.nama,T3.mata_pelajaran")
				->join("tbl_guru T4","T4.no_peserta = T3.no_peserta")
				->where(["T2.npsn"=>$sekolah])
				->group_by("T4.nama,T3.mata_pelajaran");
		}

		
		// get result
		$hasil = $db->get();

		//return value
		// return $db->last_query();
		if($hasil->num_rows()>0)
			return $hasil->result();
		return 0;
	}

	public function get_mapel_code($where=null)
	{
		$db = $this->db;
		if($where != null){
			$db->where($where);
		}
		$db->select("id,kd_matpel");
		$hasil = $db->get("ref_matpel");
		if($hasil->num_rows() > 0){
			return $hasil->row();
		}else{
			return 0;
		}
	}
}