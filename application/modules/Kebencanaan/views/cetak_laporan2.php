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
    $pdf->Cell(190,7,'LAPORAN KEJADIAN KEBAKARAN',0,1,'C');
   
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
    $pdf->Cell(37,7,'Lokasi',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->alamat,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Obyek Terbakar',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->obyek_terbakar,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Asal Api',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->asal_api,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Nama Pemilik',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->nama_korban,0,'L');

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
    $pdf->Cell(37,7,'Keterangan',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->MultiCell(120,7,$laporan->ket_laporan,0,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'Pelapor',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->Cell(120,7,$laporan->nama_user,0,1,'L');

    $pdf->SetX($pdf->GetX() + 15);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(37,7,'No. HP Pelapor',0,0,'L');
    $pdf->Cell(5,7,':',0,0,'L');
    $pdf->Cell(120,7,$laporan->no_hp,0,1,'L');

    // $pdf->SetLineWidth(0.1);
    // $pdf->SetDash(1,1); //1mm on, 1mm off
    // $pdf->Line(58,62,185,62);

    $pdf->Cell(190,20,'',0,1,'C');
    $pdf->SetFont('Arial','',12);
    $pdf->SetX($pdf->GetX() + 130);
    $pdf->Cell(37,7,'Mengetahui',0,1,'C');
    $pdf->SetX($pdf->GetX() + 130);
    $pdf->Cell(37,17,'',0,1,'C');
    $pdf->SetX($pdf->GetX() + 130);
    $pdf->Cell(37,7,'(                        )',0,1,'C');

    $pdf->AddPage();

    $pdf->SetFont('Arial','B',12);
    $pdf->SetX($pdf->GetX());
    $pdf->Cell(190,7,'FOTO KEJADIAN',0,1,'C');

    $files = array();
    foreach ($photo as $key) {
        $file_photo = explode(',', $key->foto_kejadian);

        foreach ($file_photo as $x) {
            if ($x != '') {
                $files[] = $x;
            }
        }
    }

    $col = 17;
    $row = 20;
    $cols = 0;
    $rows = 0;
    foreach ($files as $val) {

        if ($cols % 3 == 0 AND $cols != 0) {
            $row += 60;
            $col = 17;
            // $rows++;
        }

        if ($cols % 12 == 0 AND $cols != 0) {
            $pdf->AddPage();
            $col = 17;
            $row = 20;
        }
        
        $location = base_url('assets/path_kejadian/'.$val);
        $pdf->Image($location,$col,$row,55,55);

        $cols++;
        $col += 60;
    }

    $pdf->Output();
?>