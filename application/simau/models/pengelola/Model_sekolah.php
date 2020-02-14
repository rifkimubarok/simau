<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_sekolah extends CI_Model
{
	//private $table = 'tmp_sekolah';
    public $_table = 'tbl_sekolah';
    var $column_order = array('1',
        'npsn',
        'namasekolah',
        'email',
        'no_telp'); 
    var $column_search = array('1',
        'npsn',
        'namasekolah',
        'email',
        'no_telp');  
    var $order = array('npsn' => 'asc'); // default order

	function __construct()
	{
		parent::__construct();
	}

    public function getsinglerow($param){
        $a = $this->db->query('SELECT * FROM tbl_sekolah WHERE npsn = "'.$param.'"');
        return $a->row();
    }

    public function ubah($data, $param){
        $this->db->update($this->_table, $data, 'npsn = "'.$param.'" ');
        return $this->db->affected_rows();
    }

    private function _get_datatables_query()
    {

        $this->db->select("npsn,namasekolah,email,no_telp");
        $this->db->from($this->_table);

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
        if (isset($_POST['kecamatan']) && $_POST['kecamatan'] != ""){
            $kec = $_POST['kecamatan'];
            $this->db->where("kecamatan",$kec);
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

    public function infoGraf($kode_sekolah){
        $hasil = $this->db->query("SELECT (SELECT COUNT(id) FROM tbl_siswa WHERE kode_sekolah = '".$kode_sekolah."' AND jk = 'L' ) AS siswaL, (SELECT COUNT(id) FROM tbl_siswa WHERE kode_sekolah = '".$kode_sekolah."' AND jk = 'P') AS siswaP,(SELECT COUNT(*) FROM tbl_siswa WHERE kode_sekolah = '".$kode_sekolah."' ) AS jmlsiswa, ((SELECT count(*) FROM tbl_guru WHERE kode_sekolah = '".$kode_sekolah."')+(SELECT COUNT(*) FROM tbl_tendik WHERE kode_sekolah = '".$kode_sekolah."')) AS totalpegawai");
        return $hasil->row();
    }
}