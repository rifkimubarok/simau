<?php

$this->load->library('fpdf');  

class PDF extends FPDF{
  function Header(){
  	$image = "assets/image/logo.png";
   $this->Image(base_url().'assets/image/logo.jpg',3,1,1.75); // logo
   
   $this->SetFont('Arial','','12'); // font yang digunakan
   // membuat cell dg panjang 19 dan align center 'C'
   $this->Cell(28,0.5,'PEMERINTAH PROVINSI JAWA BARAT',0,'C','C');
   $this->Ln();
   $this->Cell(28,0.5,'DINAS PENDIDIKAN',0,'C','C');
   $this->Ln();
   $this->SetFont('Arial','B','12'); // font yang digunakan
   $this->Cell(28,0.5,'BALAI PELAYANAN DAN PENGAWASAN PENDIDIKAN WILAYAH VII',0,'C','C');
   $this->SetFont('Arial','B','9');
   $this->Ln();
   $this->Cell(28,0.4,'Jalan Ir. H. Juanda, Ciamis, Jawa Barat - 46211',0,'C','C');
   $this->Ln();
   $this->Cell(28,0.3,'Telepon : (0265) 0000000',0,'C','C');
   $this->Ln();
   $this->Ln();
   $this->Ln();
   $this->Ln();
   $this->Line(1,3.65,28,3.65);
   $this->Line(1,3.70,28,3.70);
   $this->SetFillColor(192,192,192); // warna isi
   $this->SetTextColor(0,0,0); // warna teks untuk th
   $this->Cell(1.5);
   $this->SetFont('Arial','B','12');
   $this->cell(2,1,'Dokumen Laporan Guru Pensiun',0,'L','L');
   $this->Ln();
   $this->SetFont('Arial','B','9');
   $this->Cell(1,1,'No','TB',0,'C',1); // cell dengan panjang 1
   $this->Cell(5,1,'NIP/NUPTK','TB',0,'L',1); // cell dengan panjang 1
   $this->Cell(6.2,1,'Nama Lengkap','TB',0,'L',1); // cell dengan panjang 2
   $this->Cell(6,1,'Tmp, Tgl Lahir','TB',0,'L',1); // cell dengan panjang 3
   $this->Cell(3.9,1,'Pangkat','TB',0,'L',1); // cell dengan panjang 3
   $this->Cell(4.9,1,'Asal Sekolah','TB',0,'L',1); // cell dengan panjang 3
   // panjang cell bisa disesuaikan
  }

  function Footer(){
   $this->SetY(-2);
   $this->SetX(1);
   $this->Cell(1,1,'SIMPELDIK - BP3 WILAYAH VII.',0,0,'L');
   $this->Cell(0,1,$this->PageNo().' / {nb}',0,0,'C');
  } 
 }

 $pdf = new PDF('L','cm','A4');
 $pdf->Open();
 $pdf->AliasNbPages();
 $pdf->AddPage();

 $pdf->SetFont('Arial','','8');
 //perulangan untuk membuat tabel
 $no = 0;
 $pdf->Ln();
  $break = null;
 $newLine = null;
 foreach ($hasil as $cell) {
 	$no++;
  if($no%13 == 0){
    $break = $pdf->AddPage();
    $newLine = $pdf->ln();
  }else{
    $break = null;
    $newLine=null;
  }
   $pdf->Cell(1,1,$no,'B',0,'C'); // cell dengan panjang 1
   if($cell->nip != null){
   	$pdf->Cell(5,1,$cell->nip,'B',0,'L'); // cell dengan panjang 1
   }else{
   	$pdf->Cell(5,1,$cell->nuptk,'B',0,'L'); // cell dengan panjang 1
   }
   $pdf->Cell(6.2,1,$cell->nama,'B',0,'L'); // cell dengan panjang 2
   $pdf->Cell(6,1,$cell->ttl,'B',0,'L'); // cell dengan panjang 3
   $pdf->Cell(3.9,1,$cell->pangkat_gol,'B',0,'L'); // cell dengan panjang 3
   $pdf->Cell(4.9,1,$lib->getNameSekolah($cell->kode_sekolah),'B',0,'L');
  $pdf->Ln();
  $break;
   $newLine;
 }

 $pdf->Output('laporan.pdf','D');
?>