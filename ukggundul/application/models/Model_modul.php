<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_modul extends CI_Model
{
	public $_table = 'm_modul';
    var $column_order = array('a.id_mapel',
        'a.modul'); 
    var $column_search = array('a.id_mapel',
        'a.modul');  
    var $order = array('a.id_mapel,a.id_modul' => 'asc'); // default order
	function __construct()
	{
		parent::__construct();
	}

    private function _get_datatables_query()
    {
        $this->db->select('a.id,a.modul,b.nama');
        $this->db->from($this->_table.' a');
        $this->db->join('m_mapel b','b.id = a.id_mapel','left');

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
           /* $this->db->where("kode_sekolah",$this->session->userdata('npsn'));
            //$this->db->where("kode_sekolah","20211510");*/
    }
    public function count_all()
    {
        return $this->db->count_all_results($this->_table);
    }

    public function getMatpel()
    {
        $this->db->select('id as kode,nama');
        $this->db->order_by('id','asc');
        $hasil = $this->db->get('m_mapel');
        return $hasil->result();
    }

    public function getMatpelParam($jenjang,$id_mapel)
    {
        if($jenjang == "SMP"){
            $this->db->select('id as kode,nama');
            $this->db->order_by('id','asc');
            $this->db->where('id',$id_mapel);
            $hasil = $this->db->get('m_mapel');
            if($hasil->num_rows() >0){
                return $hasil->row()->nama;
            }else{
                return $id_mapel;
            }
        }else{
            return $id_mapel;
        }
    }

    public function getJenjang($username)
    {
        $this->db->select('jenjang,id_matpel');
        $this->db->where(array("nim"=>$username));
        $hasil = $this->db->get('m_siswa');
        if($hasil->num_rows()>0){
            $data = $hasil->row();
            $nilai = array($data->jenjang,$data->id_matpel);
            return $nilai;
        }else{
            return "kosong";
        }
    }

    public function getModul($id_mapel)
    {
        $this->db->where(array('id_mapel'=>$id_mapel));
        $hasil = $this->db->get('m_modul');
        return $hasil->result();
    }

    public function generateIdModul($id_mapel)
    {
        $this->db->where(array("id_mapel"=>$id_mapel));
        $this->db->select("id_modul as no");
        $this->db->order_by('id_modul','desc');
        $this->db->limit('1');
        $hasil = $this->db->get("m_modul");
        if($hasil->num_rows() > 0){
            $data = $hasil->row();
            $no = intval($data->no);
            $nomor = $no+1;
            return $nomor;
        }else{
            return 1;
        }
    }

    public function simpanModul($data)
    {
        $hasil = $this->db->insert("m_modul",$data);
        if($hasil>0){
            return 1;
        }else{
            return 0;
        }
    }

    public function updateModul($where,$data)
    {
        $this->db->where($where);
        $hasil = $this->db->update("m_modul",$data);
        if($hasil >0  ){
            return 1;
        }else{
            return 0;
        }
    }

    public function getDet($id)
    {
        $this->db->where(array("id"=>$id));
        $hasil = $this->db->get("m_modul");
        if($hasil->num_rows() >0){
            return $hasil->row();
        }else{
            return 0;
        }
    }

    public function hapusMod($id)
    {
        $this->db->where(array("id"=>$id));
        $hasil = $this->db->delete('m_modul');
        if($hasil >0){
            return 1;
        }else{
            return 0;
        }
    }

    public function getNamaModul($id_mapel,$id_modul)  
    {
        $this->db->where(array('id_mapel'=>$id_mapel,'id_modul'=>$id_modul));
        $hasil = $this->db->get('m_modul');
        if($hasil->num_rows() > 0){
            $data = $hasil->row();
            return $data->modul;
        }else{
            return '';
        }
        //return $hasil->row();
    }
}