<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Guru extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status')==false or $this->session->userdata('level') != '7' and $this->session->userdata('level') != '8') {
            redirect('Landing');
        }
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('managemen/Model_guru','guru');
		$this->load->library('Libkebutuhan');
	}

	 function index(){
		$this->template->display("managemen/guru/listguru");
	}

    function info(){
        $this->template->display("managemen/grafik/grafikUmurGuru");
    }

    function infoDoc(){
        $this->template->display("managemen/dokumen/listguru");
    }

	function infoGrafPangkat(){
		$this->template->display("managemen/grafik/grafikPangkat");
	}

    function infoBerkala(){
        $this->template->display("managemen/dokumen/listguruberkala");
    }

	function infoPangkat(){
		$this->template->display("managemen/dokumen/listgurupangkat");
	}

	function cetak_dokumen($kode_sekolah=null)
	{
		if($kode_sekolah!= null){
			$where = array("b.umur"=>"60","a.kode_sekolah"=>$kode_sekolah);
			$data['hasil'] = $this->guru->getAllDataGuru($where);
			/*$this->load->view('managemen/dokumen/print/gurudoc',$data);*/
			define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$data['logo']  = $this->config->item('logo_path');
			$data['fpdf'] = $this->load->library('fpdf');
			$lib = $this->libkebutuhan;
			$data['lib'] = $lib;
			$this->load->view('managemen/dokumen/print/gurudoc', $data);
		}else{
			$where = array("b.umur"=>"60");
            $data['hasil'] = $this->guru->getAllDataGuru($where);
            /*$this->load->view('managemen/dokumen/print/gurudoc',$data);*/
            define('FPDF_FONTPATH',$this->config->item('fonts_path'));
            $data['logo']  = $this->config->item('logo_path');
            $data['fpdf'] = $this->load->library('fpdf');
            $lib = $this->libkebutuhan;
            $data['lib'] = $lib;
            $this->load->view('managemen/dokumen/print/gurudoc', $data);
		}
	}

    function cetak_excel($kode_sekolah=null)
    {
        $inputFileName = './assets/files/formatOutputGuruPensiun.xlsx';
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
            $where = array("b.umur"=>"60","a.kode_sekolah"=>$kode_sekolah);
        }else{
            $where = array("b.umur"=>"60");
        }
        $hasil = $this->guru->getAllDataGuru($where);
        foreach ($hasil as $dataguru) {
            $no++;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            if($dataguru->nip != null){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $dataguru->nip, PHPExcel_Cell_DataType::TYPE_STRING);
            }else{
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $dataguru->nuptk, PHPExcel_Cell_DataType::TYPE_STRING);
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $dataguru->nama);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $dataguru->ttl);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $dataguru->pangkat_gol);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $this->libkebutuhan->getNameSekolah($dataguru->kode_sekolah));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $dataguru->jenis_ptk);

            $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $numrow ++;
        }

        $filename = urlencode("DokumenLaporanGuruPensiun".time().".xls");
               
              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache
 
            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
            $objWriter->save('php://output');
    }

    function cetak_excelberkala()
    {
        $inputFileName = './assets/files/formatOutputBerkalaGuru.xlsx';
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
        $hasil = $this->guru->getAllDataBerkala();
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

        $filename = urlencode("DokumenLaporanNaikBerkalaGuru".time().".xls");
               
              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache
 
            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
            $objWriter->save('php://output');
    }

    function cetak_excelpangkat()
    {
        $inputFileName = './assets/files/formatOutputPangkatGuru.xlsx';
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
        $hasil = $this->guru->getAllDataPangkat();
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

        $filename = urlencode("DokumenLaporanPangkatBerkalaGuru".time().".xls");
               
              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache
 
            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
            $objWriter->save('php://output');
    }

	function listguru(){
		$list = $this->guru->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $guru) {
            $no++;
            $id = "'".$guru->id."'";
            $row = array();
            $row[] = $no;
            if($guru->nip != '' || $guru->nip != null){
            	$row[] = $guru->nip;
            }else{
            	$row[] = $guru->nuptk;
            }
            $row[] = $guru->nama;
            $row[] = $guru->jk;
            $row[] = $guru->stat_kepegawaian;
            $row[] = $guru->jenis_ptk;
            $row[] = $this->libkebutuhan->getNameSekolah($guru->kode_sekolah);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->guru->count_filtered(),
            "recordsFiltered" => $this->guru->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

    public function listGuruPensi()
    {
        $list = $this->guru->get_datatables1();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $guru) {
            $no++;
            $id = "'".$guru->id."'";
            $row = array();
            $row[] = $no;
            if($guru->nip != '' || $guru->nip != null){
                $row[] = $guru->nip;
            }else{
                $row[] = $guru->nuptk;
            }
            $row[] = $guru->nama;
            $row[] = $guru->ttl;
            $row[] = $guru->pangkat_gol;
            $row[] = $this->libkebutuhan->getNameSekolah($guru->kode_sekolah);
            $row[] = $guru->jenis_ptk;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->guru->count_filtered1(),
            "recordsFiltered" => $this->guru->count_filtered1(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function listguruberkala()
    {
        $list = $this->guru->get_datatables2();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $guru) {
            $no++;
            $id = "'".$guru->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $guru->nip;
            $row[] = $guru->nama;
            $row[] = $guru->pangkat_gol;
            $row[] = $this->libkebutuhan->getNameSekolah($guru->kode_sekolah);
            $row[] = $guru->tmt_berkala;
            $row[] = $guru->tgl_berkala;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->guru->count_filtered2(),
            "recordsFiltered" => $this->guru->count_filtered2(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

	public function listgurupangkat()
	{
		$list = $this->guru->get_datatables3();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $guru) {
            $no++;
            $id = "'".$guru->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $guru->nip;
            $row[] = $guru->nama;
            $row[] = $guru->pangkat_gol;
            $row[] = $this->libkebutuhan->getNameSekolah($guru->kode_sekolah);
            $row[] = $guru->tmt_pangkat;
            $row[] = $guru->tgl_pangkat;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->guru->count_filtered3(),
            "recordsFiltered" => $this->guru->count_filtered3(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
}