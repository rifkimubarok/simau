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
                $this->db->where('id not in (4)');
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

    public function getSekolah($where)
    {
    	$this->db->where($where);
    	$this->db->select('npsn,namasekolah');
    	$this->db->order_by('namasekolah','asc');
    	$hasil = $this->db->get('tbl_sekolah');
    	return $hasil->result();
    }

    public function getGrafNilai($kec,$npsn)
    {
    	if($kec != '' and $npsn != ''){
    		$this->db->select('kecamatan,kabupaten,kd_matpel,(select a.matpel from ref_matpel a where  a.id = kd_matpel) as matpel,kd_sekolah,namasekolah,round(avg(nilaiakhir),2) as nilai ');
    		$this->db->where(array('kd_sekolah'=>$npsn));
            $this->db->where('thn_upload',$this->input->post("thn_upload"));
    		$this->db->group_by("1,2,3,4");
    		$hasil = $this->db->get('v_rekapjwb');
    		if($hasil->num_rows()>0){
    			return $hasil->result();
    		}else{
    			return null;
    		}
        }else{
            $this->db->select('b.kabupaten,b.kecamatan,b.kd_matpel,(select a.matpel from ref_matpel a where  a.id = kd_matpel)as matpel,b.ratarata as nilai');
            $this->db->where(array('b.kecamatan'=>$kec));
            $this->db->where('thn_upload',$this->input->post("thn_upload"));
            $this->db->group_by('1,2,3');
            $hasil = $this->db->get('v_rekapjwbkec b');
            if($hasil->num_rows()>0){
                return $hasil->result();
            }else{
                return null;
            }
        }

    }

    public function getGrafNilaiv($kode,$matpel,$param)
    {
        $mata = "";
        if($matpel == 1){
            $mata = 'indo,';
        }else if($matpel == 2){
            $mata = 'ipa,';
        }else{
            $mata = 'matematika,';
        }
        $this->db->select('namasekolah,'.$mata.',jenjang,tot as nilai');
        $this->db->where(array("jenjang"=>$kode));
        if($param != ''){
            $this->db->order_by('2','desc');
        }else{
            $this->db->order_by('4','desc');
        }
        $kecamatan = $this->session->userdata('kecamatan');
        $this->db->where(array("kecamatan"=>$kecamatan));
        $this->db->where('thn_upload',$this->input->post("thn_upload"));
        $hasil = $this->db->get('v_rekapjwbsek');
        return $hasil->result();
    }

    public function getKecamatan($param)
    {
        $mata = "";
        if($param == 1){
            $mata = ',indo,';
        }else if($param == 2){
            $mata = ',ipa,';
        }else if($param == 3){
            $mata = ',matematika,';
        }
        $this->db->select('kecamatan,(indo+ipa+matematika) as nilai'.$mata);
        if($param != ''){
            $this->db->order_by('3','desc');
        }else{
            $this->db->order_by('2','desc');
        }
        $this->db->group_by('1');
        $hasil = $this->db->get('v_rekapjwbkecv');
        return $hasil->result();
    }

    public function getSekolah2($param)
    {
        $mata = "";
        if($param == 1){
            $mata = ',indo';
        }else if($param == 2){
            $mata = ',ipa';
        }else if($param == 3){
            $mata = ',matematika';
        }
        $this->db->select('namasekolah,kecamatan,(indo+ipa+matematika) as nilai'.$mata);
        if($param != ''){
            $this->db->order_by('4','desc');
        }else{
            $this->db->order_by('3','desc');
        }
        $kecamatan = $this->session->userdata('kecamatan');
        $this->db->where(array("kecamatan"=>$kecamatan));
        $this->db->group_by('1');
        $hasil = $this->db->get('v_rekapjwbsek');
        return $hasil->result();
    }


    public function getGrafNilaiSmp($kode,$param)
    {
        $mata = "";
        if($kode == 1){
            $mata = ',bin';
        }else if($kode == 2){
            $mata = ',ipa';
        }else if($kode == 3){
            $mata = ',mat';
        }else if($kode == 4){
            $mata = ',ing';
        }

        $this->db->select('id, nama_sekolah, status_sekolah, round((bin+ipa+mat+ing), 2) as tot '.$mata);
        if($param != ''){
            $this->db->order_by('5','desc');
        }else{
            $this->db->order_by('4','desc');
        }
        $hasil = $this->db->get('tbl_jml_nilai');
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
}