<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_nilai extends CI_Model
{
	private $table = 'tmp_jml_nilai';
    public $_table = 'tbl_jml_nilai';
    var $column_order = array('id',
        'kode_sekolah',
        'nama_sekolah',
        'status_sekolah',
        'peserta',
        'tl',
        'persen',
        'rank'); 
    var $column_search = array('id',
        'kode_sekolah',
        'nama_sekolah',
        'status_sekolah',
        'peserta',
        'tl',
        'persen',
        'rank'); 
    var $order = array('status_sekolah' => 'asc'); // default order
	function __construct()
	{
		parent::__construct();
	}

    public function getsinglerow($param){
        $a = $this->db->query('SELECT * FROM tbl_jml_nilai WHERE id = "'.$param.'"');
        return $a->row();
    }

    public function ubah($data, $param){
        $this->db->update($this->_table, $data, 'id = "'.$param.'" ');
        return $this->db->affected_rows();
    }

    private function _get_datatables_query()
    {

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
            $this->db->where("id_uploader",$this->session->userdata('id'));
    }
    public function count_all()
    {
        return $this->db->count_all_results($this->_table);
    }


    public function simpanData($data)
    {
        $this->db->insert($this->table,$data);
    }

    public function simpanDataFix($id_uploader){
        $delOld = $this->deleteDataOld($id_uploader);
        if($delOld > 0){
            $hasil = $this->db->query('insert into '.$this->_table.' select "" as id,kode_sekolah,nama_sekolah,status_sekolah,peserta,tl,persen,bin,ing,mat,ipa,tot,rank,id_uploader from '.$this->table.' where id_uploader = "'.$id_uploader.'"');
            if($hasil > 0){
                $return = $this->deleteDataTemp($id_uploader);
                if($return > 0){
                    return $return;
                }
            }
        }
    }

    function deleteDataTemp($id_uploader){
        $this->db->where(array("id_uploader"=>$id_uploader));
        $hasil = $this->db->delete($this->table);
        return $hasil;
    }

    function deleteDataOld($id_uploader){
        $this->db->where(array("id_uploader"=>$id_uploader));
        $hasil = $this->db->delete($this->_table);
        return $hasil;  
    }

    var $column_order1 = array('id',
        'kode_sekolah',
        'nama_sekolah',
        'status_sekolah',
        'peserta',
        'tl',
        'persen',
        'rank'); 
    var $column_search1 = array('id',
        'kode_sekolah',
        'nama_sekolah',
        'status_sekolah',
        'peserta',
        'tl',
        'persen',
        'rank'); 
    var $order1 = array('rank' => 'asc'); // default order

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
            $this->db->where("id_uploader",$this->session->userdata('id'));
    }
    public function count_all1()
    {
        return $this->db->count_all_results($this->table);
    }

}