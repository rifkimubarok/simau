<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Grafik extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
        if(($this->session->userdata('level') != '2') and ($this->session->userdata('level') != '1') ){
             redirect('Landing');
        }
        $this->load->library('Template');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->model('managemen/Model_infograf','graf');
        $this->load->library('Libkebutuhan');
    }

    function index(){
        redirect('managemen/');
    }

    function getUmurGuru($kode_sekolah = null)
    {
        if($kode_sekolah != null){
            $this->getUmurGuruparam($kode_sekolah);
        }else{
            $hasil = $this->graf->getUmurGuru1();

            $data = array();
            $name = array();
                $a = 25;
                $isi = array();
                for ($i=0; $i <= 8; $i++) {
                    $min = 18;
                    if($i!=0){
                        $min = $a -4;
                    }
                    
                    if($i==7){
                        
                        $row = array("name"=>'56 - 59',"data"=>array(intval($hasil->{'u59'})));
                    }else{
                        if($i==8){
                            $row = array("name"=>'60',"data"=>array(intval($hasil->{'u60'})));
                        }else{
                            $row = array("name"=>$min.' - '.$a,"data"=>array(intval($hasil->{'u'.$a})));
                        }
                    }
                    $isi[] = $row;
                    $a += 5;
                }

            $output['data'] = $isi;
            $output['label'] = array("Umur");;
            $output['sekolah'] = "";
            $output['xaxis'] = "";
            
            echo json_encode($output);
        }
    }

    function getAllGuru()
    {
         $hasil = $this->graf->getUmurGuruNoParam();

            $data = array();
            $name = array();
            foreach ($hasil as $umur) {
                $sekolah = $this->libkebutuhan->getNameSekolah($umur->kode_sekolah);
                $nilai = array();
                $b = 25;
                for ($i=0; $i <9 ; $i++) {                         
                        if($i==7){
                            $nilai[] = intval($umur->{'u59'});
                            /*$nilai[] = array("label"=>'u'.$b,'data'=>$umur->{'u59'});*/
                        }else{
                            
                            if($i==8){
                                $nilai[] = intval($umur->{'u60'});
                            }else{
                                $nilai[] = intval($umur->{'u'.$b});
                            }
                        }
                    $b += 5;
                }
                $row = array("name"=>$sekolah,"data"=>$nilai);
                $data[] = $row;
            }

            $output['data'] = $data;
            $output['label'] = $this->getUmurLabel();
            $output['sekolah'] = "";
            $output['xaxis'] = "Umur";
            
            echo json_encode($output);
    }

    function getUmurLabel()
    {
        $nilai = array();
        $b = 25;
        for ($i=0; $i <9 ; $i++) {                         
            $min = 18;
            if($i!=0){
                    $min = $b -4;
                }
                if($i==7){
                    $nilai[] = "55 - 59";
                    /*$nilai[] = array("label"=>'u'.$b,'data'=>$umur->{'u59'});*/
                }else{
                    
                    if($i==8){
                        $nilai[] = "60";
                    }else{
                        $nilai[] = $min.' - '.$b;
                    }
                }
            $b += 5;
        }
        return $nilai;
    }

    function getUmurGuruparam($kode_sekolah)
    {
        $where = array("kode_sekolah"=>$kode_sekolah);
        $hasil = $this->graf->getUmurGuru($where);

        $data = array();
        $name = array();
            $a = 25;
            $isi = array();
            for ($i=0; $i <= 8; $i++) {
                $min = 18;
                if($i!=0){
                    $min = $a -4;
                }
                
                if($i==7){
                    
                    $row = array("name"=>'56 - 59',"data"=>array(intval($hasil->{'u59'})));
                }else{
                    if($i==8){
                        $row = array("name"=>'60',"data"=>array(intval($hasil->{'u60'})));
                    }else{
                        $row = array("name"=>$min.' - '.$a,"data"=>array(intval($hasil->{'u'.$a})));
                    }
                }
                $isi[] = $row;
                $a += 5;
            }

        $output['data'] = $isi;
        $output['label'] = array("Umur");
        $output['sekolah'] = "- ".$this->libkebutuhan->getNameSekolah($hasil->kode_sekolah);
        $output['xaxis'] = "";
        echo json_encode($output);
    }

    function getUmurTendik($kode_sekolah=null)
    {
       if($kode_sekolah != null){
            $this->getUmurTendikParam($kode_sekolah);
        }else{
            $hasil = $this->graf->getUmurTendik1();

            $data = array();
            $name = array();
                $a = 25;
                $isi = array();
                for ($i=0; $i < 8; $i++) {
                    $min = 18;
                    if($i!=0){
                        $min = $a -4;
                    }
                    if($i==7){
                    $row = array("name"=>'56-58',"data"=>array(intval($hasil->{'u59'})));
                    }else{

                        $row = array("name"=>$min.' - '.$a,"data"=>array(intval($hasil->{'u'.$a})));
                    }
                    $isi[] = $row;
                    $a += 5;
                }

            $output['data'] = $isi;
            $output['label'] = array("Umur");;
            $output['sekolah'] = "";
            $output['xaxis'] = "";
            
            echo json_encode($output);
        }
    }

    public function getUmurTendikParam($kode_sekolah)
    {
        $where = array("kode_sekolah"=>$kode_sekolah);
        $hasil = $this->graf->getUmurTendik($where);

        $data = array();
        $name = array();
            $a = 25;
            $isi = array();
            for ($i=0; $i < 8; $i++) {
                $min = 18;
                if($i!=0){
                    $min = $a -4;
                }
                if($i==7){
                $row = array("name"=>'56-58',"data"=>array(intval($hasil->{'u59'})));
                }else{

                    $row = array("name"=>$min.' - '.$a,"data"=>array(intval($hasil->{'u'.$a})));
                }
                $isi[] = $row;
                $a += 5;
            }

        $output['data'] = $isi;
        $output['label'] = array("Umur");
        $output['sekolah'] = "- ".$this->libkebutuhan->getNameSekolah($hasil->kode_sekolah);
        $output['xaxis'] = "";
        echo json_encode($output);
    }

    public function getGrafikGolongan($kode_sekolah=null)
    {
        if($kode_sekolah!=null){
            $hasil = $this->graf->getGrafikGolongan($kode_sekolah);
            $data['sekolah'] = ' - '.$this->libkebutuhan->getNameSekolah($kode_sekolah);
        }else{
            $hasil = $this->graf->getGrafikGolongan();
            $data['sekolah'] = "";
        }
        $isi = array();
            $label = array();
            foreach ($hasil as $has) {
                $row = array("name"=>$has->gol,"data"=>array(intval($has->jumlah)));
                $isi[] = $row;
                $label[] = $has->gol;
            }
            $data['data'] = $isi;
            
            $data['label'] = $label;

            echo json_encode($data);
    }

    public function getGrafikGolonganTendik($kode_sekolah=null)
    {
        if($kode_sekolah!=null){
            $hasil = $this->graf->getGrafikGolonganTendik($kode_sekolah);
            $data['sekolah'] = ' - '.$this->libkebutuhan->getNameSekolah($kode_sekolah);
        }else{
            $hasil = $this->graf->getGrafikGolonganTendik();
            $data['sekolah'] = "";
        }
        $isi = array();
            $label = array();
            foreach ($hasil as $has) {
                $row = array("name"=>$has->gol,"data"=>array(intval($has->jumlah)));
                $isi[] = $row;
                $label[] = $has->gol;
            }
            $data['data'] = $isi;
            
            $data['label'] = $label;

            echo json_encode($data);
    }

}
?>