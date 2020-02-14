<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_guru extends CI_Model
{
    private $table = 'tmp_guru';
    public $_table = 'tbl_guru';
    var $column_order = array('id',
        'nip',
        'nama',
        'jk',
        'stat_kepegawaian',
        'jenis_ptk',
        'id'); 
    var $column_search = array('id',
        'nip',
        'nama',
        'jk',
        'stat_kepegawaian',
        'jenis_ptk');  
    var $order = array('nama' => 'asc'); // default order
    function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->_table);
        $this->db->join('tbl_sekolah','tbl_sekolah.npsn = tbl_guru.kode_sekolah');

        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->_get_custom_field();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        $this->_get_custom_field();

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function _get_custom_field()
    {
        $jenjang = $this->session->userdata('npsn');
        $this->db->where(array('jenjang'=>$jenjang));
            if(isset($_POST['npsn']) && $_POST['npsn'] != ''){
                $this->db->where("kode_sekolah",$_POST['npsn']);
            }
            if(isset($_POST['stat_kepegawaian']) && $_POST['stat_kepegawaian'] != ''){
                $this->db->where("stat_kepegawaian",$_POST['stat_kepegawaian']);
            }
            if (isset($_POST['kecamatan']) && $_POST['kecamatan'] != ""){
                $kec = $_POST['kecamatan'];
                $this->db->where("tbl_sekolah.kecamatan",$kec);
            }
            if (isset($_POST['jenjang']) && $_POST['jenjang'] != ""){
                $jenjang = $_POST['jenjang'];
                $this->db->where("jenjang",$jenjang);
            }
    }
    public function count_all()
    {
        return $this->db->count_all_results($this->_table);
    }


    public function simpanData($data)
    {
        $this->db->insert($this->table,$data);
    }

    public function simpanDataFix($kode_sekolah){
        $delOld = $this->deleteDataOld($kode_sekolah);
        if($delOld > 0){
            $hasil = $this->db->query('insert into '.$this->_table.' select "" as id,nama,nuptk,jk,tmp_lahir,tgl_lahir,nip,stat_kepegawaian,jenis_ptk,agama,alamat,rt,rw,dusun,desa,kecamatan,kode_pos,telepon,hp,email,tugas_tambahan,sk_cpns,tgl_cpns,sk_pengangkatan,tmt_pengangkatan,lembaga_pengangkatan,pangkat_gol,sumber_gaji,nama_ibu_kandung,status_perkawinan,nama_suami_istri,nip_suami_istri,pekerjaan_suami_istri,tmt_pns,lisensi_kepala_sekolah,pernah_diklat,keahlian_braile,keahlian_isyarat,npwp,nama_wajib_pajak,kewarganegaraan,bank,no_rek,nama_rek,nik,kode_sekolah from '.$this->table.' where kode_sekolah = "'.$kode_sekolah.'"');
            if($hasil > 0){
                $return = $this->deleteDataTemp($kode_sekolah);
                if($return > 0){
                    return $return;
                }
            }
        }
    }

    function deleteDataTemp($kode_sekolah){
        $this->db->where(array("kode_sekolah"=>$kode_sekolah));
        $hasil = $this->db->delete($this->table);
        return $hasil;
    }

    function deleteDataOld($kode_sekolah){
        $this->db->where(array("kode_sekolah"=>$kode_sekolah));
        $hasil = $this->db->delete($this->_table);
        return $hasil;  
    }

    var $column_order1 = array('a.id',
        'a.nip',
        'a.nama',
        '3',
        'a.pangkat_gol',
        'a.kode_sekolah',
        'a.jenis_ptk'); 
    var $column_search1 = array('a.id',
        'a.nip',
        'a.nama',
        '3',
        'a.pangkat_gol',
        'a.kode_sekolah',
        'a.jenis_ptk');  
    var $order1 = array('nama' => 'asc'); // default order

    private function _get_datatables_query1()
    {
        $this->db->select('a.id,a.nip,a.nama,concat(a.tmp_lahir," ,",a.tgl_lahir) as ttl,a.pangkat_gol,a.kode_sekolah,a.jenis_ptk,a.nuptk');
        $this->db->join("v_umurguru2 b",'on a.id = b.id ','inner');
        $this->db->from($this->_table.' a');

        $i = 0;

        foreach ($this->column_search1 as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search1) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_filtered1()
    {
        $this->_get_datatables_query1();
        $this->_get_custom_field1();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_datatables1()
    {
        $this->_get_datatables_query1();
        $this->_get_custom_field1();

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function _get_custom_field1()
    {
        if(isset($_POST['npsn']) && $_POST['npsn'] != ''){
            $where = array("a.kode_sekolah"=>$_POST['npsn'],"b.umur"=>"60");
            $this->db->where($where);
        }else{
            $where = array("b.umur"=>"60");
            $this->db->where($where);
        }
    }
    public function count_all1()
    {
        return $this->db->count_all_results($this->table);
    }

    public function getAllDataGuru($where = null)
    {
        if($where != null){
            $this->db->select('a.id,a.nip,a.nama,concat(a.tmp_lahir," ,",a.tgl_lahir) as ttl,a.pangkat_gol,a.kode_sekolah,a.jenis_ptk,a.nuptk');
        $this->db->join("v_umurguru2 b",'on a.id = b.id ','inner');
        $this->db->from($this->_table.' a');
        $this->db->where($where);
        $hasil = $this->db->get();
        return $hasil->result();
        }else{
            $this->db->select('a.id,a.nip,a.nama,concat(a.tmp_lahir," ,",a.tgl_lahir) as ttl,a.pangkat_gol,a.kode_sekolah,a.jenis_ptk,a.nuptk');
        $this->db->join("v_umurguru2 b",'on a.id = b.id ','inner');
        $this->db->from($this->_table.' a');
        $hasil = $this->db->get();
        return $hasil->result();
        }
    }

    var $column_order2 = array('id',
        'nip',
        'nama',
        'pangkat_gol',
        'kode_sekolah',
        'tmt_berkala',
        'tgl_berkala'); 
    var $column_search2 = array('id',
        'nip',
        'nama',
        'pangkat_gol',
        'kode_sekolah',
        'tmt_berkala',
        'tgl_berkala');  
    var $order2 = array('by case when tgl_berkala is null then 1 else 0 end','asc'); // default order

    private function _get_datatables_query2()
    {
        $this->db->from('v_npg');

        $i = 0;

        foreach ($this->column_search2 as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search2) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order2))
        {
            $order = $this->order2;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_filtered2()
    {
        $this->_get_datatables_query2();
        $this->_get_custom_field2();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_datatables2()
    {
        $this->_get_datatables_query2();
        $this->_get_custom_field2();

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function _get_custom_field2()
    {
        $where = array();
        if(isset($_POST['bulan']) && isset($_POST['tahun']) && $_POST['bulan'] != '' && $_POST['tahun'] != ""){
            $kondisi = array("jabatan"=>"GURU","MONTH(tgl_berkala)"=>$_POST['bulan'],"YEAR(tgl_berkala)"=>$_POST['tahun']);
            $where = $kondisi;
        }else if (isset($_POST['bulan']) && isset($_POST['tahun']) && $_POST['bulan'] != '' && $_POST['tahun'] == '') {
            $kondisi = array("jabatan"=>"GURU","MONTH(tgl_berkala)"=>$_POST['bulan']);
            $where = $kondisi;
        }else if (isset($_POST['bulan']) && isset($_POST['tahun']) && $_POST['bulan'] == '' && $_POST['tahun'] != '') {
            $kondisi = array("jabatan"=>"GURU","YEAR(tgl_berkala)"=>$_POST['tahun']);
            $where = $kondisi;
        }else{
            $where = array("jabatan"=>'GURU');
        }
        if(isset($_POST['npsn']) && $_POST['npsn'] != ''){
            $where['kode_sekolah'] = $_POST['npsn'];
        }
        $this->db->where($where);
    }
    public function count_all2()
    {
        return $this->db->count_all_results($this->table);
    }

    public function getAllDataBerkala()
    {
        $where = array();
        if(isset($_GET['bulan']) && isset($_GET['tahun']) && $_GET['bulan'] != '' && $_GET['tahun'] != ""){
            $kondisi = array("jabatan"=>"GURU","MONTH(tgl_berkala)"=>$_GET['bulan'],"YEAR(tgl_berkala)"=>$_GET['tahun']);
            $where = $kondisi;
        }else if (isset($_GET['bulan']) && isset($_GET['tahun']) && $_GET['bulan'] != '' && $_GET['tahun'] == '') {
            $kondisi = array("jabatan"=>"GURU","MONTH(tgl_berkala)"=>$_GET['bulan']);
            $where = $kondisi;
        }else if (isset($_GET['bulan']) && isset($_GET['tahun']) && $_GET['bulan'] == '' && $_GET['tahun'] != '') {
            $kondisi = array("jabatan"=>"GURU","YEAR(tgl_berkala)"=>$_GET['tahun']);
            $where = $kondisi;
        }else{
            $where = array("jabatan"=>'GURU');
        }
        if(isset($_GET['npsn']) && $_GET['npsn'] != ''){
            $where['kode_sekolah'] = $_GET['npsn'];
        }
        $this->db->where($where);
        $hasil = $this->db->get('v_npg');
        return $hasil->result();
    }
    
    public function getAllDataPangkat()
    {
        $where = array();
        if(isset($_GET['bulan']) && isset($_GET['tahun']) && $_GET['bulan'] != '' && $_GET['tahun'] != ""){
            $kondisi = array("jabatan"=>"GURU","MONTH(tgl_pangkat)"=>$_GET['bulan'],"YEAR(tgl_pangkat)"=>$_GET['tahun']);
            $where = $kondisi;
        }else if (isset($_GET['bulan']) && isset($_GET['tahun']) && $_GET['bulan'] != '' && $_GET['tahun'] == '') {
            $kondisi = array("jabatan"=>"GURU","MONTH(tgl_pangkat)"=>$_GET['bulan']);
            $where = $kondisi;
        }else if (isset($_GET['bulan']) && isset($_GET['tahun']) && $_GET['bulan'] == '' && $_GET['tahun'] != '') {
            $kondisi = array("jabatan"=>"GURU","YEAR(tgl_pangkat)"=>$_GET['tahun']);
            $where = $kondisi;
        }else{
            $where = array("jabatan"=>'GURU');
        }
        if(isset($_GET['npsn']) && $_GET['npsn'] != ''){
            $where['kode_sekolah'] = $_GET['npsn'];
        }
        $this->db->where($where);
        $hasil = $this->db->get('v_npg');
        return $hasil->result();
    }


    var $column_order3 = array('id',
        'nip',
        'nama',
        'pangkat_gol',
        'kode_sekolah',
        'tmt_pangkat',
        'tgl_pangkat'); 
    var $column_search3 = array('id',
        'nip',
        'nama',
        'pangkat_gol',
        'kode_sekolah',
        'tmt_pangkat',
        'tgl_pangkat');  
    var $order3 = array('by case when tgl_pangkat is null then 1 else 0 end','asc'); // default order

    private function _get_datatables_query3()
    {
        $this->db->from('v_npg');

        $i = 0;

        foreach ($this->column_search3 as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search3) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order3[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order3))
        {
            $order = $this->order3;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_filtered3()
    {
        $this->_get_datatables_query3();
        $this->_get_custom_field3();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_datatables3()
    {
        $this->_get_datatables_query3();
        $this->_get_custom_field3();

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function _get_custom_field3()
    {
        $where = array();
        if(isset($_POST['bulan']) && isset($_POST['tahun']) && $_POST['bulan'] != '' && $_POST['tahun'] != ""){
            $kondisi = array("jabatan"=>"GURU","MONTH(tgl_pangkat)"=>$_POST['bulan'],"YEAR(tgl_pangkat)"=>$_POST['tahun']);
            $where = $kondisi;
        }else if (isset($_POST['bulan']) && isset($_POST['tahun']) && $_POST['bulan'] != '' && $_POST['tahun'] == '') {
            $kondisi = array("jabatan"=>"GURU","MONTH(tgl_pangkat)"=>$_POST['bulan']);
            $where = $kondisi;
        }else if (isset($_POST['bulan']) && isset($_POST['tahun']) && $_POST['bulan'] == '' && $_POST['tahun'] != '') {
            $kondisi = array("jabatan"=>"GURU","YEAR(tgl_pangkat)"=>$_POST['tahun']);
            $where = $kondisi;
        }else{
            $where = array("jabatan"=>'GURU');
        }
        if(isset($_POST['npsn']) && $_POST['npsn'] != ''){
            $where['kode_sekolah'] = $_POST['npsn'];
        }
        $this->db->where($where);
    }
    public function count_all3()
    {
        return $this->db->count_all_results($this->table);
    }

}