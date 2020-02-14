<?php
class Libkebutuhan {
    protected $_ci;
    private $_table = 'v_ltrbangunan';
    function __construct()
    {
        $this->_ci =&get_instance();
    }

    function getFieldPerkakas($id_perkakas){
        $hasil = "";
        if($id_perkakas == "1"){
            $hasil = "bangku";
        }else if($id_perkakas == "2"){
            $hasil = "meja_murid";
        }else if($id_perkakas == "3"){
            $hasil = "kursi_murid";
        }else if($id_perkakas == "4"){
            $hasil = "lemari";
        }else if($id_perkakas == "5"){
            $hasil = "meja_guru";
        }else if($id_perkakas == "6"){
            $hasil = "kursi_guru";
        }else if($id_perkakas == "7"){
            $hasil = "papan_tulis";
        }else if($id_perkakas == "8"){
            $hasil = "kursi_tamu";
        }else if($id_perkakas == "9"){
            $hasil = "rak_buku";
        }

        return $hasil;
    }

    public function getBulan($item)
    {
        $bulan = array("","JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");
        return $bulan[$item];
    }

    public function getBulanlow($item)
    {
        $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        return $bulan[$item];
    }

    public function getTglIndonesia($date){
        $tgl = date("d", strtotime($date));
        $bulan = $this->getBulanlow(intval(date("m",strtotime($date))));
        $tahun = date("Y", strtotime($date));
        return $tgl." ".$bulan." ".$tahun;
    }

    public function getJabatan($id){
        if($id == "1"){
            echo "Kep. Sek.";
        }else if($id == "2" || $id == "5"){
            echo "Guru Kelas";
        }else if($id == "3" || $id == "4"){
            echo "Guru Bidang";
        }else if($id == "6"){
            echo "Penjaga Sekolah";
        }else{
            echo "TU";
        }
    }

    public function getDataBangunan($noTrans){
        $this->_ci->db->where('id_trans',$noTrans);
        $cetak = $this->_ci->db->get($this->_table);
        return $cetak->result();
    }

    public function getNameSekolah($kode_sekolah)
    {
        $this->_ci->db->where('npsn',$kode_sekolah);
        $hasil = $this->_ci->db->get('tbl_sekolah');
        $data = $hasil->row();
        return $data->namasekolah;
    }

    public function getNameKabupaten($kab)
    {
        $this->_ci->db->where('kabupaten',$kab);
        $hasil = $this->_ci->db->get('tbl_sekolah');
        $data = $hasil->row();
        return $data->kabupaten;
    }

    public function getNamaKecamatan($kec)
    {
        $this->_ci->db->where('kecamatan',$kec);
        $hasil = $this->_ci->db->get('tbl_sekolah');
        $data = $hasil->row();
        return $data->kecamatan;
    }
    // public function getstatus($kode_sekolah)
    // {
    //     $this->_ci->db->where('status',$kode_sekolah);
    //     $hasil = $this->_ci->db->get('tbl_sekolah');
    //     $data = $hasil->row();
    //     return $data->namasekolah;
    // }
}
?>