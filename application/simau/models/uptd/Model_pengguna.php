<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_pengguna extends CI_Model
{
	//private $table = 'tmp_sekolah';
    public $_table = 'tbl_pengguna';
    public $_table2 = 'tbl_sekolah';
    var $column_order = array('id',
        'nama',
        'jabatan',
        'kode_sekolah',
        'username',
        'id'); 
    var $column_search = array('id',
        'nama',
        'jabatan',
        'kode_sekolah',
        'username');  
    var $order = array('nama' => 'asc'); // default order

	function __construct()
	{
		parent::__construct();
	}

    private function _get_datatables_query()
    {

        $this->db->select($this->_table.".id,".$this->_table.".nama,".$this->_table.".jabatan,".$this->_table.".kode_sekolah,".$this->_table.".username,".$this->_table2.".npsn,".$this->_table2.".namasekolah");
        $this->db->from($this->_table);
        $this->db->join($this->_table2, $this->_table.'.kode_sekolah = '.$this->_table2.'.npsn');

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

    function resetPass($password, $id){
        $this->db->query("update ".$this->_table." set password = '".$password."' where id = '".$id."'");
        return true;
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
        $level = array('1','2','3');
        $this->db->where_not_in('level', $level);
    }
    public function count_all()
    {
        return $this->db->count_all_results($this->_table);
    }

    public function generateUser()
    {
        $data = $this->getListSekolah();
        if ($data > 0) {
            $inserted = array();
            $hasil = false;
            foreach ($data as $datanya) {
                $row = array();
                $row['kode_sekolah'] = $datanya->npsn;
                $row['password'] = md5(sha1("123456"));
                $row['jabatan'] = 'Admin Sekolah';
                $row['level'] = '6';
                $row['username'] = $datanya->npsn;
                $hasil = $this->db->insert('tbl_pengguna',$row);
            }
            return $hasil;
        }else{
            return 0;
        }
        //return $data;
    }

    private function getListSekolah()
    {
        $notin = $this->getSekolah();
        if($notin == false){
            $this->db->select('npsn');
            //$this->db->where_not_in('npsn',$notin);
            $hasil = $this->db->get('tbl_sekolah');
            return $hasil->result();
        }else if($notin > 0){
            $this->db->select('npsn');
            $this->db->where_not_in('npsn',$notin);
            $hasil = $this->db->get('tbl_sekolah');
            return $hasil->result();
        }else{
            return 0;
        }
    }

    private function getSekolah()
    {
        $this->db->select('a.npsn');
        $this->db->join('tbl_pengguna b','on a.npsn = b.kode_sekolah','inner');
        $hasil = $this->db->get('tbl_sekolah a');
        if($hasil->num_rows() > 0){
            $hasil1 = $hasil->result();
            $sekolah = array();
            foreach ($hasil1 as $data) {
                $sekolah[] = $data->npsn;
            }
            return $sekolah;
        }else{
            return false;
        }
        
    }
}