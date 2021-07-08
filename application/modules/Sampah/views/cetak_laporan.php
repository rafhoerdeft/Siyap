<?php
    // class Pdf_Dash extends FPDF{
    //     function SetDash($black=null, $white=null){
    //         if($black!==null)
    //             $s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
    //         else
    //             $s='[] 0 d';
    //         $this->_out($s);
    //     }
    // }

	$pdf = new FPDF('P','mm','A4');
    // membuat halaman baru
    $pdf->AddPage();

    // HEADER 
    // $location = base_url('assets/img/logo_kab_mgl.png');
    // $pdf->Image($location,30,12,18);

    // if ($arsip->acc != null || $arsip->acc != '') {
    //    $ass = $arsip->acc;
    // }else{
    //     $ass = $arsip->tujuan;
    // }

    $pdf->SetFont('Arial','B',14);
    $pdf->SetX($pdf->GetX());
    $pdf->Cell(190,7,'Laporan Kegiatan/Kejadian',0,1,'C');
   
    // $pdf->Cell(190,2,'',0,1,'C');
    // $pdf->SetX(52/2);
    // $pdf->Cell(160,0,'','T');
    // // $pdf->Cell(160,1,'',0,0);
    // $pdf->SetY($pdf->GetY() + 1);
    // $pdf->SetX(52/2);
    // $pdf->Cell(160,1,'','T','T','T','T');

     // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Ln();

    // $pdf->Cell(190,4,'',0,1,'C');
    // $pdf->SetFont('Arial','UB',12); //Set Style Underline Bold
    // $pdf->Cell(190,7,'LEMBAR DISPOSISI SURAT BUPATI',0,1,'C');

    // $pdf->Cell(190,3,'',0,1,'C');
    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Jenis Kejadian',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->jenis_kejadian,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Waktu Kejadian',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->Cell(120,7,date('d-m-Y', strtotime($laporan->tgl_lapor)).' pukul '.date('H:i', strtotime($laporan->tgl_lapor)),0,1,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Waktu Selesai',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->Cell(120,7,date('d-m-Y', strtotime($laporan->waktu_selesai)).' pukul '.date('H:i', strtotime($laporan->waktu_selesai)),0,1,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Alamat Kejadian',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->alamat,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Keterangan',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->keterangan,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Penyebab',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->penyebab_kejadian,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Nama Korban',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->nama_korban,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Alamat Korban',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->alamat_korban,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Saksi',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->saksi,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Kerugian',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->Cell(120,7,$laporan->kerugian,0,1,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Kronologi',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->kronologi,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Tindakan',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->tindakan,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Pelapor',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->Cell(120,7,$laporan->nama_user,0,1,'L');

    // $pdf->SetLineWidth(0.1);
    // $pdf->SetDash(1,1); //1mm on, 1mm off
    // $pdf->Line(58,62,185,62);

    $pdf->Cell(190,7,'',0,1,'C');
    $pdf->SetFont('Arial','',12);
    $pdf->SetX($pdf->GetX() + 130);
    $pdf->Cell(37,7,'Mengetahui',0,1,'C');
    $pdf->SetX($pdf->GetX() + 130);
    $pdf->Cell(37,17,'',0,1,'C');
    $pdf->SetX($pdf->GetX() + 130);
    $pdf->Cell(37,7,'(                        )',0,1,'C');


    // $rowNext = $pdf->getY();
    // if ($rowNext < 103) {
    //     $pdf->setY(103);
    // }
    // $pdf->Cell(190,3,'',0,1,'C');
    // $pdf->SetX($pdf->GetX() + 15);
    // $pdf->SetFont('Arial','',12);
    // $pdf->Cell(30,4,'Jenis',0,0,'L');
    // $pdf->Cell(5,4,':',0,0,'L');
    // $line = 0;
    // foreach ($tipeSurat as $key) {
    //     $line++;
    //     if ($line == 3) {
    //         $x = 1;
    //     }else{
    //         $x = 0;
    //     }

    //     if ($line == 4) {
    //         $pdf->Cell(190,3,'',0,1,'C');
    //         $pdf->SetX($pdf->GetX() + 50);
    //     }

    //     if ($key->id_typesurat == $arsip->id_typesurat) {
    //         $cek = '3';
    //     }else{
    //         $cek = '';
    //     }

    //     $pdf->SetDash();
    //     $pdf->SetFont('ZapfDingbats','',14);
    //     $pdf->Cell(4,4,$cek,1,0,'L');
    //     $pdf->SetFont('Arial','',12);
    //     $pdf->Cell(35,4,$key->type,0,$x,'L');
    // }

    // $pdf->SetY($pdf->GetY() + 6);
    // $pdf->SetX($pdf->GetX() + 15);
    // $pdf->Cell(30,8,'Disposisi untuk',0,0,'L');
    // $pdf->Cell(5,8,':',0,0,'L');
    // $pdf->MultiCell(127,8,$arsip->kepada,0,'L');

    // $pot = $pdf->GetY() - 1;
    // $pdf->SetLineWidth(0.1);
    // $pdf->SetDash(1,1); //1mm on, 1mm off
    // $pdf->Line(58,$pot,185,$pot);
    
    // $pdf->SetDash();
    // $pdf->SetY($pdf->GetY() + 5);
    // $pdf->SetX(52/2);
    // $pdf->Cell(160,1,'','T','T','T','T');

    // $pdf->Cell(190,3,'',0,1);
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetX($pdf->GetX() + 15);
    // $pdf->Cell(20,7,'Disposisi',0,0,'L');
    // $pdf->Cell(5,7,':',0,1,'L');
    // $pdf->Cell(190,1,'',0,1);
    // $pdf->SetX($pdf->GetX() + 15);
    // $pdf->MultiCell(190,8,$arsip->dispo,0,'L');

    // $file_dp = explode(',',$arsip->dispo_file);
    // foreach ($file_dp as $dispo) {
    //     if ($dispo != '') {
    //         $pdf->AddPage();
    //         $location = base_url('assets/disposisi/'.$dispo);
    //         $pdf->Image($location,15,12,180);
    //     }
    // }

    $pdf->Output();
?>