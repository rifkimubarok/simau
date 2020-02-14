<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rekapjwbpd extends CI_Controller{
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('managemen/Model_rekap','rekap');
	}

	public function index(){
		$this->template->display('managemen/rekap/index');
	}

	function listrekap(){
		$list = $this->rekap->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $rekap) {
            $no++;
            $row = array();
            $row[] = $no;
            if(isset($_POST['getkec']) && $_POST['getkec'] != ''){
                if(isset($_POST['getkab']) && $_POST['getkab'] != ''){
                    $row[] = $rekap->kecamatan;
                    $row[] = $rekap->namasekolah;
                }else{
                    $row[] = $this->rekap->getKab($rekap->kabupaten);
                    $row[] = $rekap->kecamatan;
                }
            }else{
                $row[] = $this->rekap->getKab($rekap->kabupaten);
                $row[] = $rekap->kecamatan;
            }
            $row[] = $rekap->indo;
            $row[] = $rekap->ipa;
            $row[] = $rekap->matematika;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rekap->count_filtered(),
            "recordsFiltered" => $this->rekap->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

    public function getKabupaten()
    {
        $hasil = $this->rekap->getKabupaten();
        $data['kabupaten'] = $hasil;
        echo json_encode($data);
    }

    public function getKecamatan()
    {
        $hasil = $this->rekap->getKecamatan();
        $data['kecamatan'] = $hasil;
        echo json_encode($data);
    }
}