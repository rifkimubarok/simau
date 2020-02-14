<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_siswa extends CI_Model
{
	private $table = 'ref_siswa';
    public $_table = 'v_lrefsiswa';
    var $column_order = array('id_sekolah',
        'nisn',
        'nis',
        'nama',
        'id_kelas',
        'nama_sekolah',
        'id_sekolah'); 
    var $column_search = array('id_sekolah',
        'nisn',
        'nis',
        'nama',
        'id_kelas',
        'nama_sekolah');  
    var $order = array('id_kelas,nama' => 'asc'); // default order
	function __construct()
	{
		parent::__construct();
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
        if($_POST['id_sekolah'] != "" and $_POST['id_sekolah'] != "34"){
            $this->db->where("id_sekolah",$_POST['id_sekolah']);
        }
    }
    public function count_all()
    {
        return $this->db->count_all_results($this->_table);
    }


    function getDetSiswa($id){
        $this->db->where("id",$id);
        $hasil = $this->db->get("ref_siswa");
        return $hasil->row();
    }

    function updateData($data,$where){
        $this->db->where($where);
        $this->db->update("ref_siswa",$data);
        return $this->db->affected_rows();
    }

    function simpanData($data){
        $this->db->insert('ref_siswa',$data);
        return $this->db->affected_rows();
    }

    function getPendidikan(){
        $hasil = $this->db->get('ref_pendidikan');
        return $hasil->result();
    }

    function getPekerjaan(){
        $hasil = $this->db->get('ref_pekerjaan');
        return $hasil->result();
    }

    function deleteDatasiswa($id){
        $this->db->where('id',$id);
        $this->db->delete("ref_siswa");
        return $this->db->affected_rows();
    }

    function deleteSiswa($id){
        $this->db->where('id_sekolah',$id);
        $this->db->delete("ref_siswa");
        return $this->db->affected_rows();   
    }
}