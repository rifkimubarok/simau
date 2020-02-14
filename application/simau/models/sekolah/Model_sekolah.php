<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_sekolah extends CI_Model
{
	private $table = 'ref_sekolah';
    public $_table = 'ref_sekolah a';
    var $column_order = array('id',
        'NPSN',
        'nama_sekolah',
        'desa'); 
    var $column_search = array('id',
        'NPSN',
        'nama_sekolah',
        'desa');  
    var $order = array('id' => 'asc'); // default order

	function __construct()
	{
		parent::__construct();
	}

    private function _get_datatables_query()
    {

        $this->db->from($this->_table);
        $this->db->join('ref_guru b','a.id = b.id_sekolah and b.id_jabatan = "1"','LEFT');

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
        $this->db->where("jenis_kantor in ('Sekolah')");
        if(isset($_POST['columns'][3]['search']['value']) and $_POST['columns'][3]['search']['value'] !=''){
            $this->db->where("desa",$_POST['columns'][3]['search']['value']);
        }
        if($this->session->userdata('user_id')!=null and $this->session->userdata('user_id')!="34"){
            $this->db->where("id",$this->session->userdata('user_id'));
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

    function getBanyakMuridPerkelas(){
        $hasil = $this->db->query('SELECT a.id_kelas, (SELECT count(nisn) from tbl_siswa WHERE kelas = a.id_kelas) as jmlLaki,(SELECT count(nisn) from tbl_siswa WHERE kelas = a.id_kelas) as jmlPerem FROM ref_kelas a');
        return $hasil->result();
    }
}