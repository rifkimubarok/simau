<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_rekap extends CI_Model{
	private $table = 'tmp_dudi';
    public $_table = '';
    var $column_order = array(); 
    var $column_search = array(
        'kabupaten',
        'kecamatan',
        'indo',
        'ipa',
        'matematika');  
    var $order = array(null,null); // default order
	function __construct()
	{
		parent::__construct();
        
	}

    private function _get_datatables_query()
    {
        if(isset($_POST['getkec']) && $_POST['getkec'] != ''){
            $this->_table = 'v_rekapjwbsek';
            $this->column_order = array(null,'kecamatan','namasekolah','indo','ipa','matematika');
            $this->column_search = array('kecamatan','namasekolah','indo','ipa','matematika');
        }else{
            $this->_table = 'v_rekapjwbkec';
            $this->column_order = array(null,'kabupaten','kecamatan','indo','ipa','matematika');
            $this->column_search = array('kabupaten','kecamatan','indo','ipa','matematika');
        }

        $this->select_query();

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

    private function select_query()
    {
        if(isset($_POST['getkab']) && $_POST['getkab'] != '' && isset($_POST['getkec']) && $_POST['getkec']==''){
           $this->db->select('b.kabupaten, b.kecamatan, (SELECT a.ratarata FROM v_rekapjwbkec a WHERE a.kd_matpel = 1 and a.kecamatan = b.kecamatan) as indo , (SELECT a.ratarata FROM v_rekapjwbkec a WHERE a.kd_matpel = 2 and a.kecamatan = b.kecamatan) as ipa , (SELECT a.ratarata FROM v_rekapjwbkec a WHERE a.kd_matpel = 3 and a.kecamatan = b.kecamatan) as matematika');
            $this->db->where(array('b.kabupaten'=>$_POST['getkab']));
            $this->db->group_by('1,2');
        }else if(isset($_POST['getkab']) && $_POST['getkab'] != '' && isset($_POST['getkec']) && $_POST['getkec'] !=''){
            $this->db->select('b.namasekolah,b.kecamatan,b.kabupaten,b.indo,ipa,b.matematika');
            $this->db->where(array('b.kabupaten'=>$_POST['getkab'],'b.kecamatan'=>$_POST['getkec']));
            $this->db->group_by('1,2,3');
        }else{
            $this->db->select('b.kabupaten,"" as kecamatan,(SELECT round(avg(a.ratarata),2) FROM v_rekapjwbkec a WHERE a.kd_matpel = 1 and a.kabupaten = b.kabupaten) as indo,(SELECT round(avg(a.ratarata),2) FROM v_rekapjwbkec a WHERE a.kd_matpel = 2 and a.kabupaten = b.kabupaten) as ipa, (SELECT round(avg(a.ratarata),2) FROM v_rekapjwbkec a WHERE a.kd_matpel = 3 and a.kabupaten = b.kabupaten) as matematika');
            $this->db->group_by('1,2');
        }
        $this->db->from($this->_table.' b');
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
           $this->db->where('b.jenjang',$jenjang);
           $this->db->where("thn_upload",$this->input->post('thn_upload'));
    }
    public function count_all()
    {
        return $this->db->count_all_results($this->_table);
    }

    public function getKabupaten()
    {
        $this->db->where(array('kd_prop'=>'04','kd_rayon'=>'05'));
        $hasil = $this->db->get('ref_kab');
        return $hasil->result();
    }

    public function getKecamatan()
    {
        $this->db->select('kecamatan');
        $this->db->group_by('kecamatan');
        $hasil = $this->db->get('tbl_sekolah');
        return $hasil->result();
    }

    function getKab($kode)
    {
        $this->db->where(array('kd_prop'=>'04','kd_rayon'=>$kode));
        $hasil = $this->db->get('ref_kab');
        if($hasil->num_rows() >0){
            $data = $hasil->row();
            return $data->nm_rayon;
        }else{
            return "";
        }
    }
}