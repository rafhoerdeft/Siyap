<?php 
	
	include_once APPPATH . '/third_party/PhpExcel/PHPExcel.php';
	
	// Panggil class PHPExcel nya
	$excel = new PHPExcel();

	// Settingan awal fil excel
	$excel->getProperties()->setCreator('MAS GANTENG')
							->setLastModifiedBy('&D')
							->setTitle("REKAPITULASI TEMUAN")
							->setSubject("MBUH")
							->setDescription("ENA ENA")
							->setKeywords("TEMUAN, INSPEKTORAT, REKAPITULASI");

	// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
	$style_col1 = array(
		'font' => array(
			'name'  => 'Calibri',
			'bold' => True,
			'size' => (11)
		), // Set font nya jadi bold
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_DOUBLE), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'b2cfff')
        )
	);

	$style_col2 = array(
		'font' => array(
			'name'  => 'Calibri',
			'bold' => True,
			'size' => (11)
		), // Set font nya jadi bold
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'b2cfff')
        )
	);

	// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
	$style_row1 = array(
		'font' => array(
			'name'  => 'Calibri',
			'bold' => FALSE,
			'size' => (11)
		), // Set font nya jadi bold
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		)
	);

	$style_row2 = array(
		'font' => array(
			'name'  => 'Calibri',
			'bold' => FALSE,
			'size' => (11)
		), // Set font nya jadi bold
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		)
	);

	$style_row3 = array(
		'font' => array(
			'name'  => 'Calibri',
			'bold' => True,
			'size' => (11)
		), // Set font nya jadi bold
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'b2cfff')
        )
	);

	$style_row4 = array(
		'font' => array(
			'name'  => 'Calibri',
			'bold' => True,
			'size' => (11)
		), // Set font nya jadi bold
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		)
	);

	$style_row5 = array(
		'font' => array(
			'name'  => 'Calibri',
			'bold' => True,
			'size' => (11)
		), // Set font nya jadi bold
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		)
	);

		$excel->setActiveSheetIndex(0)->setCellValue('M1', "Lampiran 2.");
		$excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(11);
		$excel->getActiveSheet()->getStyle('M1')->getFont()->setName('Calibri');
		$excel->getActiveSheet()->getStyle('M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$excel->getActiveSheet()->mergeCells('A2:M2');
		$excel->setActiveSheetIndex(0)->setCellValue('A2', "REKAPITULASI TEMUAN, REKOMENDASI DAN TINDAK LANJUT");
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Calibri');
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->getActiveSheet()->mergeCells('A3:M3');
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "HASIL PEMERIKSAAN INSPEKTORAT KABUPATEN MAGELANG");
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setName('Calibri');
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->getActiveSheet()->mergeCells('A5:A6');
		$excel->setActiveSheetIndex(0)->setCellValue('A5','No');
		// $excel->getActiveSheet()->getStyle()->getFont()->setColor()->setARGB(PHPExcel_Style_Color::ff3700);

		$excel->getActiveSheet()->mergeCells('B5:B6');
		$excel->setActiveSheetIndex(0)->setCellValue('B5','PKPT');

		$excel->getActiveSheet()->mergeCells('C5:C6');
		$excel->setActiveSheetIndex(0)->setCellValue('C5','Tmn');

		$excel->getActiveSheet()->mergeCells('D5:D6');
		$excel->setActiveSheetIndex(0)->setCellValue('D5','Rek');

		$excel->getActiveSheet()->mergeCells('E5:G5');
		$excel->setActiveSheetIndex(0)->setCellValue('E5','Status TL');

			$excel->setActiveSheetIndex(0)->setCellValue('E6','S');
			$excel->setActiveSheetIndex(0)->setCellValue('F6','D');
			$excel->setActiveSheetIndex(0)->setCellValue('G6','B');

		$excel->getActiveSheet()->mergeCells('H5:J5');
		$excel->setActiveSheetIndex(0)->setCellValue('H5','Kerugian Negara/Daerah');
		$excel->getActiveSheet()->getStyle('H5')->getAlignment()->setWrapText(true);

			$excel->setActiveSheetIndex(0)->setCellValue('H6','Nilai');
			$excel->setActiveSheetIndex(0)->setCellValue('I6','Ditarik');
			$excel->setActiveSheetIndex(0)->setCellValue('J6','Sisa');

		$excel->getActiveSheet()->mergeCells('K5:M5');
		$excel->setActiveSheetIndex(0)->setCellValue('K5','Kewajiban Setor Kepada Negara/Daerah');
		$excel->getActiveSheet()->getStyle('K5')->getAlignment()->setWrapText(true);

			$excel->setActiveSheetIndex(0)->setCellValue('K6','Nilai');
			$excel->setActiveSheetIndex(0)->setCellValue('L6','Ditarik');
			$excel->setActiveSheetIndex(0)->setCellValue('M6','Sisa');

		// Set Style
		$excel->getActiveSheet()->getStyle('A5:A6')->applyFromArray($style_col1);
		$excel->getActiveSheet()->getStyle('B5:B6')->applyFromArray($style_col1);
		$excel->getActiveSheet()->getStyle('C5:C6')->applyFromArray($style_col1);
		$excel->getActiveSheet()->getStyle('D5:D6')->applyFromArray($style_col1);

		$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col2);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col2);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col2);
		$excel->getActiveSheet()->getStyle('H5:J5')->applyFromArray($style_col2);
		$excel->getActiveSheet()->getStyle('K5:M5')->applyFromArray($style_col2);

		$excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_col1);
		$excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_col1);
		$excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_col1);
		$excel->getActiveSheet()->getStyle('H6')->applyFromArray($style_col1);
		$excel->getActiveSheet()->getStyle('I6')->applyFromArray($style_col1);
		$excel->getActiveSheet()->getStyle('J6')->applyFromArray($style_col1);
		$excel->getActiveSheet()->getStyle('K6')->applyFromArray($style_col1);
		$excel->getActiveSheet()->getStyle('L6')->applyFromArray($style_col1);
		$excel->getActiveSheet()->getStyle('M6')->applyFromArray($style_col1);

		// Set Repeat Header
		$excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1,6);

		// Data
		$no = 7;
		$Tahun = 2007;
		$excel->getActiveSheet()->getStyle('7')->getAlignment()->setWrapText(true);
		for ($i=0; $i < 100; $i++) { 
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$no, $i);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$no, $Tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$no, $Tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$no, $Tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$no, $Tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$no, $Tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$no, $Tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$no, $Tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$no, $Tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$no, $Tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$no, $Tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$no, $Tahun);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$no, $Tahun);

			$excel->getActiveSheet()->getStyle('A'.$no)->applyFromArray($style_row1);
			$excel->getActiveSheet()->getStyle('B'.$no)->applyFromArray($style_row1);
			$excel->getActiveSheet()->getStyle('C'.$no)->applyFromArray($style_row1);
			$excel->getActiveSheet()->getStyle('D'.$no)->applyFromArray($style_row1);
			$excel->getActiveSheet()->getStyle('E'.$no)->applyFromArray($style_row1);
			$excel->getActiveSheet()->getStyle('F'.$no)->applyFromArray($style_row1);
			$excel->getActiveSheet()->getStyle('G'.$no)->applyFromArray($style_row1);

			$excel->getActiveSheet()->getStyle('H'.$no)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('I'.$no)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('J'.$no)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('K'.$no)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('L'.$no)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('M'.$no)->applyFromArray($style_row2);

			$Tahun++;
			$no++;
		}	

		$excel->getActiveSheet()->mergeCells('A'.$no.':B'.$no);
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$no,'Jumlah');

		$excel->setActiveSheetIndex(0)->setCellValue('C'.$no,'0');
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$no,'0');
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$no,'0');
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$no,'0');
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$no,'0');
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$no,'0');
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$no,'0');
		$excel->setActiveSheetIndex(0)->setCellValue('J'.$no,'0');
		$excel->setActiveSheetIndex(0)->setCellValue('K'.$no,'0');
		$excel->setActiveSheetIndex(0)->setCellValue('L'.$no,'0');
		$excel->setActiveSheetIndex(0)->setCellValue('M'.$no,'0');

		// Set Style
		$excel->getActiveSheet()->getStyle('A'.$no.':B'.$no)->applyFromArray($style_row3);
		$excel->getActiveSheet()->getStyle('C'.$no)->applyFromArray($style_row4);
		$excel->getActiveSheet()->getStyle('D'.$no)->applyFromArray($style_row4);
		$excel->getActiveSheet()->getStyle('E'.$no)->applyFromArray($style_row4);
		$excel->getActiveSheet()->getStyle('F'.$no)->applyFromArray($style_row4);
		$excel->getActiveSheet()->getStyle('G'.$no)->applyFromArray($style_row4);
		$excel->getActiveSheet()->getStyle('H'.$no)->applyFromArray($style_row5);
		$excel->getActiveSheet()->getStyle('I'.$no)->applyFromArray($style_row5);
		$excel->getActiveSheet()->getStyle('J'.$no)->applyFromArray($style_row5);
		$excel->getActiveSheet()->getStyle('K'.$no)->applyFromArray($style_row5);
		$excel->getActiveSheet()->getStyle('L'.$no)->applyFromArray($style_row5);
		$excel->getActiveSheet()->getStyle('M'.$no)->applyFromArray($style_row5);

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("HASIL PEMERIKSAAN INSPEKTORAT");
		$excel->setActiveSheetIndex(0);

		// Set Footer Nomor Halaman
		$excel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R Halaman &P dari &N');
		$excel->getActiveSheet()->getHeaderFooter()->setEvenFooter('&R Halaman &P dari &N');

	// Proses file excel
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="HASIL PEMERIKSAAN INSPEKTORAT KABUPATEN MAGELANG.xlsx"'); // Set nama file excel nya
	header('Cache-Control: max-age=0');
	$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	$write->save('php://output');

 ?>