<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_infograf extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function getKeadaanSekolah($tanggal)
    {
        $this->db->select('a.nama_sekolah,b.*');
        $this->db->from('ref_sekolah a');
        $this->db->join('rpt_keadaan_sekolah b','a.id = b.id_sekolah','INNER');
        $this->db->where('MONTH(b.tanggal) = MONTH("'.$tanggal.'") and YEAR(b.tanggal) = YEAR("'.$tanggal.'")');
        $this->db->order_by("b.id_sekolah","asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getUmurGuru($where)
    {
        $this->db->where($where);
        $hasil = $this->db->get('v_rangeumurguru');
        return $hasil->row();
    }

    public function getUmurGuruNoParam()
    {
        $hasil = $this->db->get('v_rangeumurguru');
        return $hasil->result();
    }

    public function getUmurGuru1()
    {
        $hasil = $this->db->query('SELECT sum(u25) as u25, sum(u30) as u30, sum(u35) as u35,sum(u40) as u40,sum(u45) as u45,sum(u50) as u50,sum(u55) as u55,sum(u59) as u59,sum(u60) as u60 from v_rangeumurguru');
        return $hasil->row();
    }

    public function getUmurTendik($where)
    {
        $this->db->where($where);
        $hasil = $this->db->get('v_rangeumurtendik');
        return $hasil->row();
    }

    public function getUmurTendik1()
    {
        $hasil = $this->db->query('SELECT sum(u25) as u25, sum(u30) as u30, sum(u35) as u35,sum(u40) as u40,sum(u45) as u45,sum(u50) as u50,sum(u55) as u55, sum(u59) as u59 from v_rangeumurtendik');
        return $hasil->row();
    }

    public function getGrafikGolongan($kode_sekolah =null)
    {
        if($kode_sekolah != null){
            $hasil = $this->db->query("SELECT b.gol,count(a.id) as jumlah FROM tbl_guru a RIGHT JOIN ref_gol b on a.pangkat_gol = b.gol and a.stat_kepegawaian = 'PNS' and a.kode_sekolah = '".$kode_sekolah."' GROUP BY 1");
        }else{
            $hasil = $this->db->query("SELECT b.gol,count(a.id) as jumlah FROM tbl_guru a RIGHT JOIN ref_gol b on a.pangkat_gol = b.gol and a.stat_kepegawaian = 'PNS' GROUP BY 1");
        }
        /*$select = 'b.gol , count(a.id) as jumlah';
        $this->db->select($select);
        $this->db->from('tbl_guru a');
        $this->db->join('ref_gol b','a.pangkat_gol = b.gol and a.stat_kepegawaian = "PNS"','RIGHT');
        $hasil = $this->db->get();*/
        return $hasil->result();
    }

    public function getGrafikGolonganTendik($kode_sekolah =null)
    {
        if($kode_sekolah != null){
            $hasil = $this->db->query("SELECT b.gol,count(a.id) as jumlah FROM tbl_tendik a RIGHT JOIN ref_gol b on a.pangkat_gol = b.gol and a.stat_kepegawaian = 'PNS' and a.kode_sekolah = '".$kode_sekolah."' GROUP BY 1");
        }else{
            $hasil = $this->db->query("SELECT b.gol,count(a.id) as jumlah FROM tbl_tendik a RIGHT JOIN ref_gol b on a.pangkat_gol = b.gol and a.stat_kepegawaian = 'PNS' GROUP BY 1");
        }
        /*$select = 'b.gol , count(a.id) as jumlah';
        $this->db->select($select);
        $this->db->from('tbl_guru a');
        $this->db->join('ref_gol b','a.pangkat_gol = b.gol and a.stat_kepegawaian = "PNS"','RIGHT');
        $hasil = $this->db->get();*/
        return $hasil->result();
    }
}