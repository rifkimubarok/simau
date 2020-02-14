<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_siswa extends CI_Model
{
	private $table = 'tmp_siswa';
    public $_table = 'tbl_siswa';
    var $column_order = array('id',
        'nisn',
        'nipd',
        'nama',
        'jk',
        'rombel',
        'id'); 
    var $column_search = array('id',
        'nisn',
        'nipd',
        'nama',
        'jk',
        'rombel');  
    var $order = array('nama' => 'asc'); // default order
	function __construct()
	{
		parent::__construct();
	}

    private function _get_datatables_query()
    {

        $this->db->from($this->_table);
        $this->db->join('tbl_sekolah','tbl_sekolah.npsn = tbl_siswa.kode_sekolah');

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
            if (isset($_POST['npsn']) && $_POST['npsn'] != ""){
                $npsn = $_POST['npsn'];
                $this->db->where("kode_sekolah",$npsn);
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
            $hasil = $this->db->query('insert into '.$this->_table.' select "" as id,nama,nipd,jk,nisn,tmp_lahir,tgl_lahir,nik,agama,alamat,rt,rw,dusun,kelurahan,kecamatan,kode_pos,jenis_tinggal,alat_transport,telepon,hp,email,skhun,penerima_kps,no_kps,nama_ayah,thn_lahir_ayah,jenjang_ayah,pekerjaan_ayah,penghasilan_ayah,nik_ayah,nama_ibu,thn_lahir_ibu,jenjang_ibu,pekerjaan_ibu,penghasilan_ibu,nik_ibu,nama_wali,thn_lahir_wali,jenjang_wali,pekerjaan_wali,penghasilan_wali,nik_wali,rombel,no_peserta_un,no_seri_ijazah,penerima_kip,no_kip,nama_kip,no_kks,no_reg_akta,bank,no_rek,nama_rek,layak_pip,alasan_layak,kebutuhan_khusus,sekolah_asal,kode_sekolah from tmp_siswa where kode_sekolah = "'.$kode_sekolah.'"');
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

    var $column_order1 = array('id',
        'nisn',
        'nipd',
        'nama',
        'jk',
        'rombel'); 
    var $column_search1 = array('id',
        'nisn',
        'nipd',
        'nama',
        'jk',
        'rombel');  
    var $order1 = array('nama' => 'asc'); // default order

    private function _get_datatables_query1()
    {

        $this->db->from($this->table);

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
            $this->db->where("kode_sekolah",$this->session->userdata('npsn'));
    }
    public function count_all1()
    {
        return $this->db->count_all_results($this->table);
    }

    function getSekolah($kec = null,$jenjang = null)
    {   
        if($kec != null){
            $hasil = $this->db->query('SELECT npsn, namasekolah, kecamatan, jenjang FROM tbl_sekolah WHERE kecamatan ="'.$kec.'"');
        }
        if($jenjang != null){
            $hasil = $this->db->query('SELECT npsn, namasekolah, kecamatan, jenjang FROM tbl_sekolah WHERE jenjang ="'.$jenjang.'"');
        }
        if($kec != null && $jenjang != null){
            $hasil = $this->db->query('SELECT npsn, namasekolah, kecamatan, jenjang FROM tbl_sekolah WHERE kecamatan ="'.$kec.'" AND jenjang = "'.$jenjang.'"');
        }
        if($kec == null && $jenjang == null){
            $hasil = $this->db->query('SELECT npsn, namasekolah, kecamatan, jenjang FROM tbl_sekolah');
        }
        return $hasil->result();
    }

    function getKec()
    {
        $this->db->distinct();
        $this->db->select('kecamatan');
        $hasil = $this->db->get('tbl_sekolah');
        return $hasil->result();
    }
    function getJenjang()
    {   
        $this->db->distinct();
        $this->db->select('jenjang');
        $hasil = $this->db->get('tbl_sekolah');
        return $hasil->result();
    }


}