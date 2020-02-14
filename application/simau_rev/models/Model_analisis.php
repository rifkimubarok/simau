<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_analisis extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getAnalisis($nomor,$kode)
    {
        $this->db->select("sum((case when (n".$nomor." ='1') then 1 else 0 end)) AS b1, sum((case when (n".$nomor." ='0') then 1 else 0 end)) AS b2 ");
        $this->db->where($kode);
        $this->db->where('thn_upload',$this->input->post("thn_upload"));
        $hasil = $this->db->get('v_ljwbpd');
        $a = array();
        if($hasil->num_rows()>0){
            $d = $hasil->row();
            for ($i=1; $i <=2 ; $i++) { 
                $data = array();
                if($i == 1){
                    $data['name'] = 'Benar';
                }else{
                    $data['name'] = 'Salah';
                }
                $data['y'] = intval($d->{'b'.$i});
                $a[] = $data;
            }
            return $a;
        }else{
            return false;
        }
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

    public function getMatpel_param($param)
    {
        $this->db->where(array('id'=>$param));
        $hasil = $this->db->get('ref_matpel');
        return $hasil->result();
    }

    public function getGrafNilai($kec,$npsn,$jenjang)
    {
        $kelas = $this->input->post("kelas");
        $this->db->where(array("a.jenjang"=>$jenjang,"a.kelas"=>$kelas));
        if($kec != '' and $npsn == ''){
            $this->db->select('a.kabupaten,a.kecamatan,a.kd_matpel,b.matpel,ifnull(round(avg(a.ratarata),2),0) as nilai');
            $this->db->from("v_rekapjwbkec a");
            $this->db->join("ref_matpel b","on a.kd_matpel = b.id","left");
            $this->db->where(array('a.kecamatan'=>$kec,"a.thn_upload"=>$this->input->post("thn_upload")));
            $this->db->group_by('1,2,3,4');
            $hasil = $this->db->get();
            if($hasil->num_rows()>0){
                return $hasil->result();
            }else{
                return null;
            }
        }else if($kec != '' and $npsn != ''){
            $this->db->select('a.kecamatan,a.kabupaten,a.kd_matpel,b.matpel,a.kd_sekolah,a.namasekolah,round(avg(a.nilaiakhir),2) as nilai ');
            $this->db->from("v_rekapjwb a");
            $this->db->join("ref_matpel b","on a.kd_matpel = b.id","left");
            $this->db->where(array('a.kd_sekolah'=>$npsn,"a.thn_upload"=>$this->input->post("thn_upload")));
            $this->db->group_by("1,2,3,5");
            $hasil = $this->db->get();
            if($hasil->num_rows()>0){
                return $hasil->result();
            }else{
                return null;
            }
        }else{
            $this->db->select('a.kabupaten,a.kd_matpel,b.matpel,ifnull(round(avg(a.ratarata),2),0) as nilai');
            $this->db->from("v_rekapjwbkec a");
            $this->db->join("ref_matpel b","on a.kd_matpel = b.id","left");
            $this->db->group_by('1,2,3');
            $this->db->where('a.thn_upload',$this->input->post('thn_upload'));
            $hasil = $this->db->get();
            if($hasil->num_rows()>0){
                return $hasil->result();
            }else{
                return null;
            }
        }
    }

   /* public function getGrafNilaiv($kode,$matpel,$param,$kecamatan,$kelas)
    {
        $mata = "";
        if($matpel == 1){
            $mata = 'indo,';
        }else if($matpel == 2){
            $mata = 'ipa,';
        }else if($matpel == 4){
            $mata = 'ingg,';
        }else{
            $mata = 'matematika,';
        }
        $this->db->select('kabupaten,kecamatan,'.$mata.',jenjang,(indo+ipa+matematika+ingg) as nilai');
        $this->db->where(array("jenjang"=>$kode,"thn_upload"=>$this->input->post('thn_upload'),"kelas"=>$kelas));
        if($param != ''){
            $this->db->order_by('3','desc');
        }else{
            $this->db->order_by('5','desc');
        }
        if($kecamatan != null || $kecamatan != ''){
            $this->db->where(array("kecamatan"=>$kecamatan));
            $hasil = $this->db->get('v_rekapjwbsek');
        }else{
            $hasil = $this->db->get('v_rekapjwbkecv');
        }
        return $hasil->result();
    }*/

    public function getGrafNilaiv($kode,$kecamatan,$kelas)
    {
        $this->db->select('kabupaten,kecamatan,indo,ipa,matematika,ingg,jenjang,(indo+ipa+matematika+ingg) as nilai');
        $this->db->where(array("jenjang"=>$kode,"thn_upload"=>$this->input->post('thn_upload'),"kelas"=>$kelas));
        $this->db->order_by('nilai','desc');
        if($kecamatan != null || $kecamatan != ''){
            $this->db->where(array("kecamatan"=>$kecamatan));
            $hasil = $this->db->get('v_rekapjwbsek');
        }else{
            $hasil = $this->db->get('v_rekapjwbkecv');
        }
        //echo $this->db->last_query();
        return $hasil->result();
    }

    public function getKecamatan($param,$jenjang)
    {
        $mata = "";
        if($param == 1){
            $mata = ',indo,';
        }else if($param == 2){
            $mata = ',ipa,';
        }else if($param == 3){
            $mata = ',matematika,';
        }else if($param == 4){
            $mata = ',ingg,';
        }
        $this->db->where("jenjang",$jenjang);
        $this->db->select('kecamatan,(indo+ipa+matematika+ingg) as nilai'.$mata);
        if($param != ''){
            $this->db->order_by('3','desc');
        }else{
            $this->db->order_by('2','desc');
        }
        $this->db->group_by('1');
        $hasil = $this->db->get('v_rekapjwbkecv');
        return $hasil->result();
    }

    public function getSekolahParam($param,$jenjang,$kecamatan)
    {
        $mata = "";
        if($param == 1){
            $mata = ',indo,';
        }else if($param == 2){
            $mata = ',ipa,';
        }else if($param == 3){
            $mata = ',matematika,';
        }else if($param == 4){
            $mata = ',ingg,';
        }
        $this->db->where(array("jenjang"=>$jenjang,"kecamatan"=>$kecamatan));
        $this->db->select('namasekolah,(indo+ipa+matematika+ingg) as nilai'.$mata);
        if($param != ''){
            $this->db->order_by('3','desc');
        }else{
            $this->db->order_by('2','desc');
        }
        $this->db->group_by('1');
        $hasil = $this->db->get('v_rekapjwbsek');
        return $hasil->result();
    }


    public function getGrafNilaiSmp($tahun=null,$kecamatan=null,$kelas=null,$mapelid=0)
    {
        $db = $this->db;

        $db->select("T1.id, T1.nama_sekolah, T2.kecamatan, T1.status_sekolah,T1.tahun, T1.tot,T1.bin,T1.ipa,T1.mat,T1.ing");
        $db->from("tbl_jml_nilai T1");
        $db->join("tbl_sekolah T2","T2.npsn = T1.kode_sekolah","inner");
        $db->where(array("T1.tahun"=>$tahun));
        switch($mapelid){
				case 1 : $db->order_by("bin","desc");break;
				case 2 : $db->order_by("ipa","desc"); break;
				case 3 : $db->order_by("mat","desc"); break;
				case 4 : $db->order_by("ing","desc"); break;
				default : $db->order_by("tot","desc"); break;
		}
        if($kecamatan != null){
            $db->where(array("T2.kecamatan"=>$kecamatan));
        }

        $hasil = $db->get();
        return $hasil->result();        
    }

    public function getNamaSekolah($param)
    {
        $mata = "";
        if($param == 1){
            $mata = ',bin,';
        }else if($param == 2){
            $mata = ',ipa,';
        }else if($param == 3){
            $mata = ',mat,';
        }elseif($param == 4){
            $mata = ',ing,';
        }
        $this->db->select('id, nama_sekolah, round((bin+ipa+mat+ing), 2) as tot '.$mata);
        if($mata != ''){
            $this->db->order_by('4','desc');
        }else{
            $this->db->order_by('3','asc');
        }
        $hasil = $this->db->get('tbl_jml_nilai');
        return $hasil->result();
    }

    public function getKCM()
    {
        $this->db->where(array("jenis"=>"siswa"));
        return $this->db->get("ref_kcm")->result();
    }
}