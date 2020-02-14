<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_jwbpd extends CI_Model
{
    private $table = 'tmp_dudi';
    public $_table = 'v_jwbpd';
    var $column_order = array('matpel',
        'matpel',
        'asalsekolah',
        'jumlah'); 
    var $column_search = array('matpel',
        'asalsekolah',
        'jumlah');  
    var $order = array('matpel' => 'asc'); // default order
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
        $kecamatan = $this->session->userdata('kecamatan');
        $jenjang = $this->session->userdata('npsn');
        $this->db->where(array("kecamatan"=>$kecamatan,"jenjang"=>$jenjang));
        $this->db->where("thn_upload",$this->input->post('thn_upload'));
            //$this->db->where("kd_sekolah",$this->session->userdata('npsn'));
            //$this->db->where("kode_sekolah","20211510");
    }
    public function count_all()
    {
        return $this->db->count_all_results($this->_table);
    }

	public function upload($data)
	{
		$this->db->trans_begin();

		foreach ($data as $input) {
			$this->db->insert('tbl_jwbpd',$input);
		}

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}
}