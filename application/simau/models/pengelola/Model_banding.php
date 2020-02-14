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
		}else if(($kecamatan != "" or $kecamatan != null )AND ($sekolah == null or $sekolah == "")) {
			$this->db->select("d.namasekolah,round(avg(a.nilai_total),2) as nilaiukg,round(avg(c.nilaiakhir),2) as nilaisiswa,c.kelas,d.kecamatan");
			$this->db->where(array("d.jenjang"=>$jenjang,"d.kecamatan"=>$kecamatan));
				$this->db->group_by("1,4,5");
		}

		if($sekolah != "" or $sekolah != null){
			$this->db->select("b.nama,b.no_peserta,b.nuptk,b.nip,avg(a.nilai_total) as nilaiukg,b.kode_sekolah,avg(c.nilaiakhir) as nilaisiswa,c.kelas,d.kecamatan");
			$this->db->where(array("d.jenjang"=>$jenjang,"d.kecamatan"=>$kecamatan,"c.kd_sekolah"=>$sekolah));
			
			$this->db->group_by("1,2,3,4,6,8,9");
			if($matpel == '' or $matpel == null){
				$this->db->select("c.kd_matpel");
				$this->db->group_by('10');
			}
		}

		if($matpel != '' or $matpel != null){
			$this->db->select("c.kd_matpel");
			$this->db->where(array("c.kd_matpel"=>$matpel));
			$this->db->group_by('10');
		}

		if($kelas != ""){
			$this->db->where(array("kelas"=>$kelas));
		}

		$this->db->from("tbl_hasil_ukg as a");
		$this->db->join("tbl_guru as b","ON b.no_peserta = a.no_peserta","INNER");
		$this->db->join("v_rekapjwbguru AS c","ON b.kode_sekolah = c.kd_sekolah AND c.kd_guru = b.nip OR c.kd_guru = b.nuptk OR c.kd_guru = b.no_peserta","INNER");
		$this->db->where(array("c.thn_upload"=>$tahun,"a.tahun"=>$tahun));
		$this->db->join("tbl_sekolah AS d","ON b.kode_sekolah = d.npsn","INNER");
		$hasil = $this->db->get();
		if($hasil->num_rows()>0){
			return $hasil->result();
		}else{
			return 0;
		}
    }

    public function getKCM()
    {
    	$this->db->where(array("jenis"=>"siswa"));
    	return $this->db->get("ref_kcm")->result();
    }

    public function getMatpel()
    {
    	return $this->db->get('ref_matpel')->result();
    }
}