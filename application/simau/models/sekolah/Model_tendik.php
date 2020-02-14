<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_tendik extends CI_Model
{
	private $table = 'tmp_tendik';
    public $_table = 'tbl_tendik';
    var $column_order = array('id',
        'nip',
        'nama',
        'jk',
        'stat_kepegawaian',
        'jenis_ptk',
        'id'); 
    var $column_search = array('id',
        'nip',
        'nama',
        'jk',
        'stat_kepegawaian',
        'jenis_ptk');  
    var $order = array('nama' => 'asc'); // default order
	function __construct()
	{
		parent::__construct();
	}

    public function getsinglerow($param){
        $a = $this->db->query('SELECT * FROM tbl_tendik WHERE id = "'.$param.'"');
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
            $this->db->where("kode_sekolah",$this->session->userdata('npsn'));
            //$this->db->where("kode_sekolah","20211510");
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
            $hasil = $this->db->query('insert into '.$this->_table.' select "" as id,nama,nuptk,jk,tmp_lahir,tgl_lahir,nip,stat_kepegawaian,jenis_ptk,agama,alamat,rt,rw,dusun,desa,kecamatan,kode_pos,telepon,hp,email,tugas_tambahan,sk_cpns,tgl_cpns,sk_pengangkatan,tmt_pengangkatan,lembaga_pengangkatan,pangkat_gol,sumber_gaji,nama_ibu_kandung,status_perkawinan,nama_suami_istri,nip_suami_istri,pekerjaan_suami_istri,tmt_pns,lisensi_kepala_sekolah,pernah_diklat,keahlian_braile,keahlian_isyarat,npwp,nama_wajib_pajak,kewarganegaraan,bank,no_rek,nama_rek,nik,kode_sekolah, diklat_terakhir, pelaksana_keg, tgl_sertifikat, no_sertifikat from '.$this->table.' where kode_sekolah = "'.$kode_sekolah.'"');
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



    var $column_order2 = array('a.id',
        'a.nip',
        'a.nama',
        '4',
        'a.pangkat_gol',
        'a.kode_sekolah',
        'a.jenis_ptk'); 
    var $column_search2 = array('a.id',
        'a.nip',
        'a.nama',
        '4',
        'a.pangkat_gol',
        'a.kode_sekolah',
        'a.jenis_ptk');  
    var $order2 = array('nama' => 'asc'); // default order

    private function _get_datatables_query2()
    {
        $this->db->select('a.id,a.nip,a.nama,concat(a.tmp_lahir," ,",a.tgl_lahir) as ttl,a.pangkat_gol,a.kode_sekolah,a.jenis_ptk,a.nuptk');
        $this->db->join("v_umurtendik b",'on a.id = b.id ','inner');
        $this->db->from($this->_table.' a');

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
            $this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order2))
        {
            $order = $this->order2;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_filtered2()
    {
        $this->_get_datatables_query2();
        $this->_get_custom_field2();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_datatables2()
    {
        $this->_get_datatables_query2();
        $this->_get_custom_field2();

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function _get_custom_field2()
    {
        $where = array("a.kode_sekolah"=>$this->session->userdata('npsn'),"b.umur"=>"58");
        $this->db->where($where);
    }
    public function count_all2()
    {
        return $this->db->count_all_results($this->table);
    }

    public function getAllDatatendik($where=null)
    {
        $this->db->select('a.id,a.nip,a.nama,concat(a.tmp_lahir," ,",a.tgl_lahir) as ttl,a.pangkat_gol,a.kode_sekolah,a.jenis_ptk,a.nuptk');
        $this->db->join("v_umurtendik b",'on a.id = b.id ','inner');
        $this->db->from($this->_table.' a');
        $this->db->where($where);
        $hasil = $this->db->get();
        return $hasil->result();
    }

}