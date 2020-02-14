<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_infograf extends CI_Model
{
    private $userdata;
    function __construct()
    {
        parent::__construct();
        $this->userdata = get_session("user");
    }


	public function getKeadaanSekolah($tanggal)
    {
        $this->db->select('a.nama_sekolah,b.*');
        $this->db->from('ref_sekolah a');
        $this->db->join('rpt_keadaan_sekolah b','a.id = b.id_sekolah','INNER');
        $this->db->where('MONTH(b.tanggal) = MONTH("'.$tanggal.'") and YEAR(b.tanggal) = YEAR("'.$tanggal.'")');
        $this->db->order_by("b.id_sekolah","asc");
        $query = $this->db->get();
        return $query->result();
    }

    function getBanyakSekolah(){
        $sql =  'SELECT jenjang FROM tbl_sekolah';
        $data = $this->db->query($sql);
        return $data->num_rows();
    }

    function getBanyakSD(){
    if($this->userdata->level =="9" ){
            $this->db->where("kecamatan",$this->userdata->kecamatan);
        }
        $this->db->select("jenjang");
        $this->db->where("jenjang","SD");
        $data = $this->db->get("tbl_sekolah");
        return $data->num_rows();
    }

    function getBanyakSMP(){
        $sql =  'SELECT jenjang FROM tbl_sekolah WHERE jenjang="SMP"';
        $data = $this->db->query($sql);
        return $data->num_rows();
    }

    function getBanyakSLB(){
        $sql =  'SELECT jenjang FROM tbl_sekolah WHERE jenjang="SLB"';
        $data = $this->db->query($sql);
        return $data->num_rows();
    }

    function getBanyakTotalGuru(){
    if($this->userdata->level  == '7' || $this->userdata->npsn == "8"){
            $this->db->where("tbl_sekolah.jenjang",$this->userdata->npsn);
        }
    if($this->userdata->level =="9"){
            $this->db->where("tbl_sekolah.kecamatan",$this->userdata->kecamatan);
        }
        $this->db->select('tbl_guru.nama');
        $this->db->from('tbl_guru');
        $this->db->join('tbl_sekolah','on tbl_guru.kode_sekolah = tbl_sekolah.npsn','inner');
        $data = $this->db->get();
        return $data->num_rows();
    }

    function getBanyakTotalTendik(){
        $sql =  'SELECT id FROM tbl_tendik';
        $data = $this->db->query($sql);
        return $data->num_rows();
    }

    function getBanyakLaki(){
    if($this->userdata->level  == '7' || $this->userdata->npsn == "8"){
            $this->db->where("tbl_sekolah.jenjang",$this->userdata->npsn);
        }
    if($this->userdata->level =="9"){
            $this->db->where("tbl_sekolah.kecamatan",$this->userdata->kecamatan);
        }
        $this->db->select('tbl_siswa.jk');
        $this->db->where("tbl_siswa.jk",'L');
        $this->db->from('tbl_siswa');
        $this->db->join('tbl_sekolah','on tbl_siswa.kode_sekolah = tbl_sekolah.npsn','inner');
        $data = $this->db->get();
        return $data->num_rows();
    }

    function getBanyakPerempuan(){
        if($this->userdata->level  == '7' || $this->userdata->npsn == "8"){
            $this->db->where("tbl_sekolah.jenjang",$this->userdata->npsn);
        }

    if($this->userdata->level =="9"){
            $this->db->where("tbl_sekolah.kecamatan",$this->userdata->kecamatan);
        }
        $this->db->select('tbl_siswa.jk');
        $this->db->where("tbl_siswa.jk",'P');
        $this->db->from('tbl_siswa');
        $this->db->join('tbl_sekolah','on tbl_siswa.kode_sekolah = tbl_sekolah.npsn','inner');
        $data = $this->db->get();
        return $data->num_rows();
    }

     function getBanyakMuridPerkelas_Pengelola(){
        $this->db->select("Count(tbl_siswa.nama),tbl_sekolah.jenjang,tbl_siswa.kelas as id_kelas,SUM(CASE WHEN tbl_siswa.jk = 'L' THEN 1 ELSE 0 END) as jmlLaki,SUM(CASE WHEN tbl_siswa.jk = 'P' THEN 1 ELSE 0 END) as jmlPerem");
        $this->db->from('tbl_siswa');
        $this->db->join('tbl_sekolah','ON tbl_siswa.kode_sekolah = tbl_sekolah.npsn','inner');
        $this->db->group_by('2,3');
    if($this->userdata->level  == '7' || $this->userdata->level  == "8"){
            $jenjang = $this->userdata->npsn;
            if($jenjang == "SD"){
                $this->db->where("tbl_sekolah.jenjang","SD");
                $this->db->where("tbl_siswa.kelas not in (7,8,9,10,11,12)");
            }else{
                $this->db->where("tbl_sekolah.jenjang","SMP");
                 $this->db->where("tbl_siswa.kelas not in (1,2,3,4,5,6,10,11,12)");
            }
    }else if($this->userdata->level  == '9'){
            $kecamatan = $this->userdata->kecamatan;
            $this->db->where("tbl_sekolah.kecamatan",$kecamatan);
           $this->db->where("tbl_siswa.kelas not in (7,8,9,10,11,12)");
        }else{
            $this->db->where("tbl_siswa.kelas not in (10,11,12)");
        }    
        $hasil = $this->db->get();
        return $hasil->result();
    }


    function getBanyakMuridPerkelas_Sekolah($kode_sekolah){

        $this->db->select("Count(tbl_siswa.nama),tbl_sekolah.jenjang,tbl_siswa.kelas as id_kelas,SUM(CASE WHEN tbl_siswa.jk = 'L' THEN 1 ELSE 0 END) as jmlLaki,SUM(CASE WHEN tbl_siswa.jk = 'P' THEN 1 ELSE 0 END) as jmlPerem");
        $this->db->from('tbl_siswa');
        $this->db->join('tbl_sekolah','ON tbl_siswa.kode_sekolah = tbl_sekolah.npsn','inner');
        $this->db->group_by('2,3');
        $jenjang = $this->userdata->jenjang;
        $this->db->where(array("tbl_sekolah.npsn"=>$kode_sekolah,"tbl_sekolah.jenjang"=>$jenjang)); 
        $hasil = $this->db->get();
        return $hasil->result();  
    }

    //cek Sekolah apakah SD / SMP
    private function chekJenjang($kode_sekolah)
    {
        $this->db->select('jenjang');
        $this->db->where(array('npsn'=>$kode_sekolah));
        $hasil = $this->db->get('tbl_sekolah');
        if($hasil->num_rows() >0 ){
            $data = $hasil->row();
            return $data->jenjang;
        }
    }

    // function getGrafikSekolah(){
    //     $sql =  "SELECT COUNT(jenjang) as Jumlah, jenjang as jenjang
    //   FROM tbl_sekolah GROUP BY jenjang";
    //   $data = $this->db->query($sql);
    //   return $data->result();
    // }

    public function graph_sekolah()
    {
      $sql =  "SELECT COUNT(jenjang) as Jumlah, jenjang as jenjang
      FROM tbl_sekolah GROUP BY jenjang";
      $data = $this->db->query($sql);
      return $data->result();
  }
  public function graph_sekolah_double_parameter($param, $param2){
    $a = $this->db->query('SELECT COUNT(jenjang) as Jumlah, jenjang as jenjang FROM tbl_sekolah WHERE kabupaten = "'.$param.'" AND jenjang = "'.$param2.'" GROUP BY jenjang');
    return $a->result();
  }
  public function graph_sekolah_kab_parameter($param){
    $a = $this->db->query('SELECT COUNT(jenjang) as Jumlah, jenjang as jenjang FROM tbl_sekolah WHERE kabupaten = "'.$param.'" GROUP BY jenjang');
    return $a->result();
  }
  public function graph_sekolah_jenjang_parameter($param2){
    $a = $this->db->query('SELECT COUNT(jenjang) as Jumlah, jenjang as jenjang FROM tbl_sekolah WHERE jenjang = "'.$param2.'" GROUP BY jenjang');
    return $a->result();
  }

  public function getGrafikSekolah($kec =null)
    {
        if($kec != null){
            $hasil = $this->db->query('SELECT COUNT(jenjang) as Jumlah, jenjang as jenjang FROM tbl_sekolah WHERE kecamatan = "'.$kec.'" GROUP BY jenjang');
        }else{
            $hasil = $this->db->query('SELECT COUNT(jenjang) as Jumlah, jenjang as jenjang FROM tbl_sekolah GROUP BY jenjang');
        }
        return $hasil->result();
    }

    public function getInformasi($where)
    {  
        $hasil = '';
        if($where != ''){
            $this->db->select("sum(CASE WHEN a.kode_sekolah = b.npsn THEN 1 ELSE 0 END) AS totmu,sum(CASE WHEN a.kode_sekolah = b.npsn AND a.jk = 'L' THEN 1 ELSE 0 END) AS totmula, sum(CASE WHEN a.kode_sekolah = b.npsn AND a.jk = 'P' THEN 1 ELSE 0 END) AS totmupe");
                $where = array("b.kecamatan"=>$where);
                $this->db->where($where);
                $this->db->from('tbl_siswa a');
                $this->db->join('tbl_sekolah b','ON a.kode_sekolah = b.npsn','INNER');
                $hasil = $this->db->get();
        }else{
            $hasil = $this->db->query("SELECT (SELECT count(id) FROM tbl_siswa) as totmu,(SELECT count(id) FROM tbl_siswa WHERE jk = 'L') as totmula,(SELECT count(id) FROM tbl_siswa where jk = 'P') as totmupe,(SELECT count(id) FROM tbl_guru) as totpeg");
        }
        return $hasil;
    }

    public function getBanyakGuru($where)
    {
        $this->db->select('count(a.id) as totpeg');
        if($where != ''){
            $where = array("b.kecamatan"=>$where);
            $this->db->where($where);
        }
        $this->db->from('tbl_guru a');
        $this->db->join('tbl_sekolah b','ON a.kode_sekolah = b.npsn','INNER');
        $hasil = $this->db->get();
        if($hasil->num_rows() > 0){
            $data = $hasil->row();
            return $data->totpeg;
        }else{
            return 0;
        }
    }

  // public function counting($param){
  //   $a = $this->db->query('SELECT COUNT(jenjang) as Jumlah, jenjang as jenjang FROM tbl_sekolah WHERE jenjang = "'.$param.'" GROUP BY jenjang');
  //   return $a->result();
  // }
  
}