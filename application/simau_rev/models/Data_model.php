<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Data_model extends CI_Model {
 
    public $table = 'pegawai';
    public $id = 'id_pegawai';
    public $order = 'DESC';
 
    function __construct() {
        parent::__construct();
    }
 
    //ini untuk memasukkan kedalam tabel pegawai
    function loaddata($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'barang' => $dataarray[$i]['nama'],
                'jumlah' => $dataarray[$i]['tempat_lahir'],
                'satuan' => $dataarray[$i]['tanggal_lahir']
            );
            //ini untuk menambahkan apakah dalam tabel sudah ada data yang sama
            //apabila data sudah ada maka data di-skip
            // saya contohkan kalau ada data nama yang sama maka data tidak dimasukkan
            $this->db->where('nama', $this->input->post('nama'));            
            if ($cek) {
                $this->db->insert($this->table, $data);
            }
        }
