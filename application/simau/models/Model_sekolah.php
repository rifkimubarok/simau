<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_sekolah extends CI_Model {

    var $table = 'tbl_sekolah';
    var $table_ = "ref_kab";
    var $column_order = array(null, 
                                    'namasekolah',
                                    'jenjang',
                                    'kecamatan',
                                    'alamat', null);
    var $column_search = array( 'namasekolah',
                                'jenjang',
                                'kecamatan',
                                'alamat');
    var $order = array('npsn' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function getDetSekolah($id){
        $this->db->select("id,NPSN,namasekolah,alamat,desa,telepon,kecamatan,kabupaten,thn_pendirian,lat,lng,foto");
        $this->db->where("id",$id);
        $hasil = $this->db->get("ref_sekolah");
        return $hasil->row();
    }

    function updateData($data,$where){
        $this->db->where($where);
        $this->db->update("ref_sekolah",$data);
        return $this->db->affected_rows();
    }

    function simpanData($data){
        $this->db->insert('ref_sekolah',$data);
        return $this->db->affected_rows();
    }

    function getKecamatan(){
        $hasil = $this->db->query('SELECT npsn, kecamatan FROM tbl_sekolah GROUP BY kecamatan');
        return $hasil->result();
    }

    function getKabupaten(){
        $hasil = $this->db->query('SELECT kd_rayon, nm_rayon FROM ref_kab GROUP BY kd_rayon');
        return $hasil->result();
    }

    function getJenjang(){
        $hasil = $this->db->query('SELECT npsn, jenjang FROM tbl_sekolah GROUP BY jenjang');
        return $hasil->result();
    }

    // function getJenjang(){
    //     $this->db->order_by('jenjang','ASC');
    //     $kelas= $this->db->get('tbl_sekolah');
    //     return $kelas->result_array();
    // }

    // function getKabupaten(){
    //     $this->db->order_by('kabupaten','ASC');
    //     $kelas= $this->db->get('tbl_sekolah');
    //     return $kelas->result_array();
    // }

    private function _get_datatables_query()
    {
        
        $this->db->from($this->table);

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

    function get_datatables()
    {
        $this->_get_datatables_query();
        $this->_get_custom_field();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->_get_custom_field();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function _get_custom_field()
    {
        // if(isset($_POST['columns'][3]['search']['value']) and $_POST['columns'][3]['search']['value'] !=''){
        //     $this->db->where('jenjang',$_POST['columns'][3]['search']['value']);
        // }
        if(isset($_POST['columns'][4]['search']['value']) and $_POST['columns'][4]['search']['value'] !=''){
            if($_POST['columns'][3]['search']['value'] !=''){
                $kecamatan = $_POST['columns'][4]['search']['value'];
                $jenjang = $_POST['columns'][3]['search']['value'];
                $array = array('kecamatan' => $kecamatan, 'jenjang' => $jenjang);
                $this->db->where($array);
            }else{
                $this->db->where('kecamatan',$_POST['columns'][4]['search']['value']);
            }
        }else if($_POST['columns'][3]['search']['value'] !=''){
                $this->db->where('jenjang',$_POST['columns'][3]['search']['value']);
            }
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


}
