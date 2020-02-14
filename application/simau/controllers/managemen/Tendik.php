<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Tendik extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status')==false) {
            redirect('Landing');
        }
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('managemen/Model_tendik','tendik');
		$this->load->library('Libkebutuhan');
	}

	 function index(){
		$this->template->display("managemen/tendik/listtendik");
	}

	function info(){
		$this->template->display("managemen/grafik/grafikUmurTendik");
	}

    function infoGrafPangkat(){
        $this->template->display("managemen/grafik/grafikPangkatTendik");
    }

	function infoDoc(){
		$this->template->display("managemen/dokumen/listtendik1");
	}

    function infoBerkala(){
        $this->template->display("managemen/dokumen/listtendikberkala");
    }

	function infoPangkat(){
		$this->template->display("managemen/dokumen/listtendikpangkat");
	}

	function cetak_dokumen($kode_sekolah=null)
    {
        if($kode_sekolah!= null){
            $where = array("b.umur"=>"58","a.kode_sekolah"=>$kode_sekolah);
            $data['hasil'] = $this->tendik->getAllDatatendik($where);
            /*$this->load->view('managemen/dokumen/print/tendikdoc',$data);*/
            define('FPDF_FONTPATH',$this->config->item('fonts_path'));
            $data['logo']  = $this->config->item('logo_path');
            $data['fpdf'] = $this->load->library('fpdf');
            $lib = $this->libkebutuhan;
            $data['lib'] = $lib;
            $this->load->view('managemen/dokumen/print/tendikdoc', $data);
        }else{
            $where = array("b.umur"=>"58");
            $data['hasil'] = $this->tendik->getAllDatatendik($where);
            /*$this->load->view('managemen/dokumen/print/tendikdoc',$data);*/
            define('FPDF_FONTPATH',$this->config->item('fonts_path'));
            $data['logo']  = $this->config->item('logo_path');
            $data['fpdf'] = $this->load->library('fpdf');
            $lib = $this->libkebutuhan;
            $data['lib'] = $lib;
            $this->load->view('managemen/dokumen/print/tendikdoc', $data);
        }
    }

    function cetak_excel($kode_sekolah=null)
    {
        $inputFileName = './assets/files/formatOutputTendikPensiun.xlsx';
        $inputFileType = IOFactory::identify($inputFileName);
        $objReader = IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $objPHPExcel->setActiveSheetIndex(0);
        $numrow = 10;
        $no = 0;
        if($kode_sekolah!=null){
            $where = array("b.umur"=>"58","a.kode_sekolah"=>$kode_sekolah);
        }else{
            $where = array("b.umur"=>"58");
        }
        $hasil = $this->tendik->getAllDatatendik($where);
        foreach ($hasil as $datatendiks) {
            $no++;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            if($datatendiks->nip != null){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $datatendiks->nip, PHPExcel_Cell_DataType::TYPE_STRING);
            }else{
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $datatendiks->nuptk, PHPExcel_Cell_DataType::TYPE_STRING);
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $datatendiks->nama);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $datatendiks->ttl);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $datatendiks->pangkat_gol);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $this->libkebutuhan->getNameSekolah($datatendiks->kode_sekolah));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $datatendiks->jenis_ptk);

            $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $numrow ++;
        }

        $filename = urlencode("DokumenLaporanTendikPensiun".time().".xls");
               
              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache
 
            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
            $objWriter->save('php://output');
    }



    function cetak_excelberkala()
    {
        $inputFileName = './assets/files/formatOutputBerkalaTendik.xlsx';
        $inputFileType = IOFactory::identify($inputFileName);
        $objReader = IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $objPHPExcel->setActiveSheetIndex(0);
        $numrow = 10;
        $no = 0;
        $hasil = $this->tendik->getAllDataBerkala();
        foreach ($hasil as $dataguru) {
            $no++;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $dataguru->nip, PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $dataguru->nama);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $dataguru->pangkat_gol);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $this->libkebutuhan->getNameSekolah($dataguru->kode_sekolah));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $dataguru->tmt_berkala);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $dataguru->tgl_berkala);

            $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $numrow ++;
        }

        $filename = urlencode("DokumenLaporanNaikBerkalaTendik".time().".xls");
               
              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache
 
            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
            $objWriter->save('php://output');
    }

    function cetak_excelpangkat()
    {
        $inputFileName = './assets/files/formatOutputPangkatTendik.xlsx';
        $inputFileType = IOFactory::identify($inputFileName);
        $objReader = IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $objPHPExcel->setActiveSheetIndex(0);
        $numrow = 10;
        $no = 0;
        $hasil = $this->tendik->getAllDataPangkat();
        foreach ($hasil as $dataguru) {
            $no++;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $dataguru->nip, PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $dataguru->nama);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $dataguru->pangkat_gol);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $this->libkebutuhan->getNameSekolah($dataguru->kode_sekolah));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $dataguru->tmt_pangkat);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $dataguru->tgl_pangkat);

            $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $numrow ++;
        }

        $filename = urlencode("DokumenLaporanPangkatBerkalaTendik".time().".xls");
               
              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache
 
            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
            $objWriter->save('php://output');
    }
    
	function listTendik(){
		$list = $this->tendik->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $tendik) {
            $no++;
            $id = "'".$tendik->id."'";
            $row = array();
            $row[] = $no;
            if($tendik->nip != '' || $tendik->nip != null){
            	$row[] = $tendik->nip;
            }else{
            	$row[] = $tendik->nuptk;
            }
            $row[] = $tendik->nama;
            $row[] = $tendik->jk;
            $row[] = $tendik->stat_kepegawaian;
            $row[] = $tendik->jenis_ptk;
            $row[] = $this->libkebutuhan->getNameSekolah($tendik->kode_sekolah);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tendik->count_filtered(),
            "recordsFiltered" => $this->tendik->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	public function listTendikPensiun()
	{
		$list = $this->tendik->get_datatables1();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $tendik) {
            $no++;
            $id = "'".$tendik->id."'";
            $row = array();
            $row[] = $no;
            if($tendik->nip != '' || $tendik->nip != null){
            	$row[] = $tendik->nip;
            }else{
            	$row[] = $tendik->nuptk;
            }
            $row[] = $tendik->nama;
            $row[] = $tendik->ttl;
            $row[] = $tendik->pangkat_gol;
            $row[] = $this->libkebutuhan->getNameSekolah($tendik->kode_sekolah);
            $row[] = $tendik->jenis_ptk;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tendik->count_filtered1(),
            "recordsFiltered" => $this->tendik->count_filtered1(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	public function getstatus(){
		$data['status'] = $this->tendik->getstatus();
		echo json_encode($data);
	}



    public function listtendikberkala()
    {
        $list = $this->tendik->get_datatables2();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $tendik) {
            $no++;
            $id = "'".$tendik->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $tendik->nip;
            $row[] = $tendik->nama;
            $row[] = $tendik->pangkat_gol;
            $row[] = $this->libkebutuhan->getNameSekolah($tendik->kode_sekolah);
            $row[] = $tendik->tmt_berkala;
            $row[] = $tendik->tgl_berkala;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tendik->count_filtered2(),
            "recordsFiltered" => $this->tendik->count_filtered2(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

	public function listtendikpangkat()
	{
		$list = $this->tendik->get_datatables3();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $tendik) {
            $no++;
            $id = "'".$tendik->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $tendik->nip;
            $row[] = $tendik->nama;
            $row[] = $tendik->pangkat_gol;
            $row[] = $this->libkebutuhan->getNameSekolah($tendik->kode_sekolah);
            $row[] = $tendik->tmt_pangkat;
            $row[] = $tendik->tgl_pangkat;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tendik->count_filtered3(),
            "recordsFiltered" => $this->tendik->count_filtered3(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
    function getSekolah()
    {
        if(isset($_GET['kab']) && !isset($_GET['jenjang'])){
            $data['sekolah'] = $this->tendik->getSekolah($_GET['kab'], null);
        }elseif(isset($_GET['kab']) && isset($_GET['jenjang'])){
            $data['sekolah'] = $this->tendik->getSekolah($_GET['kab'], $_GET['jenjang']);
        }elseif(!isset($_GET['kab']) && isset($_GET['jenjang'])){
            $data['sekolah'] = $this->tendik->getSekolah(null, $_GET['jenjang']);
        }else{
            $data['sekolah'] = $this->tendik->getSekolah();
        }
        echo json_encode($data);
    }
}