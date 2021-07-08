<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Damkar extends CI_Controller {

	function __construct(){ 
		parent:: __construct();
		$this->load->model('MasterData');
		$this->load->helper('encrypt');
		$this->load->helper('wa');
		$this->load->library('session');
		if ($this->session->userdata('role')!= "Operator Damkar" AND $this->session->userdata('role')!= "Admin Damkar") {
			redirect('Login/index');
		}
		date_default_timezone_set('Asia/Jakarta');
		$this->login_id = $this->session->userdata('id_user');
		// $this->sms = $this->load->database('sms', TRUE);
		$this->id_kategori = $this->session->userdata('id_kategori');
    }

	public function index(){
		$data['id_nav'] = 1;

		$thn = $this->input->GET('tahun');
		if ($thn == '') {
			$thn = date('Y');
		}

		$bln = $this->input->GET('bulan');
		if ($bln == '') {
			if ($thn == date('Y')) {
				$bln = date('n');
			} else {
				$bln = 1;
			}
		}
		// JUMLAH USER APLIKASI 
		$select = 'count(usr.id_user) jml_user';
		$table = array(
			'users usr',
			'role'
		);
		$where = "usr.id_role = role.id_role AND role = 'User' AND role.id_kategori = 1";
		$data['user_pelapor'] = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_user;

		$where = "usr.id_role = role.id_role AND role = 'Petugas' AND role.id_kategori = 1";
		$data['user_petugas'] = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_user;

		$where = "usr.id_role = role.id_role AND role = 'Admin' AND role.id_kategori = 1";
		$data['user_admin'] = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_user;

		$data['total_user'] = $data['user_pelapor'] + $data['user_petugas'] + $data['user_admin'];

		// JUMLAH LAPORAN MASUK
		$select = 'count(lap.id_lapor) laporan';
		$table = array(
			'lapor lap',
			'kategori ktg'
		);
		$where = "date(tgl_lapor) = date(now()) AND lap.id_kategori = ktg.id_kategori AND ktg.nama_kategori = 'Damkar'";
		$data['lap_harian'] = $this->MasterData->getWhereData($select,$table,$where)->row()->laporan;

		$where = "YEARWEEK(tgl_lapor) = YEARWEEK(NOW()) AND lap.id_kategori = ktg.id_kategori AND ktg.nama_kategori = 'Damkar'";
		$data['lap_mingguan'] = $this->MasterData->getWhereData($select,$table,$where)->row()->laporan;

		$where = "MONTH(tgl_lapor) = MONTH(now()) AND YEAR(tgl_lapor) = YEAR(now()) AND lap.id_kategori = ktg.id_kategori AND ktg.nama_kategori = 'Damkar'";
		$data['lap_bulanan'] = $this->MasterData->getWhereData($select,$table,$where)->row()->laporan;

		$where = "YEAR(tgl_lapor) = YEAR(now()) AND lap.id_kategori = ktg.id_kategori AND ktg.nama_kategori = 'Damkar'";
		$data['lap_tahunan'] = $this->MasterData->getWhereData($select,$table,$where)->row()->laporan;

		$select = array(
			'MONTH(lap.tgl_lapor) AS bulan',
			'WEEK(lap.tgl_lapor) AS minggu',
		    'COUNT(lap.id_lapor) AS jml_lap'
		);
		$where = "lap.id_kategori = ktg.id_kategori AND
			    ktg.nama_kategori = 'Damkar' AND
			    YEAR(lap.tgl_lapor) = '$thn'";
		$group = "MONTH(lap.tgl_lapor), WEEK(lap.tgl_lapor)";
		$by = "MONTH(lap.tgl_lapor), WEEK(lap.tgl_lapor)";
		$order = 'ASC';
		$data['lap_per_minggu'] = $this->MasterData->getWhereDataGroupOrder($select,$table,$group,$by,$order,$where)->result();

		$select = array(
			'MONTH(lap.tgl_lapor) AS bulan',
		    'COUNT(lap.id_lapor) AS jml_lap'
		);
		$group = "MONTH(lap.tgl_lapor)";
		$by = "MONTH(lap.tgl_lapor)";
		$order = 'ASC';
		$data_lap = $this->MasterData->getWhereDataGroupOrder($select,$table,$group,$by,$order,$where)->result();

		$data['lap_per_bln_by_jenis'] = $this->db->query("SELECT 
															lap.id_jenis_lap,
															MONTH(lap.tgl_lapor) AS bulan, 
															jl.nama_jenis_lap,
															COUNT(lap.id_lapor) AS jml_lapor
														FROM lapor lap 
														LEFT JOIN jenis_laporan jl 
															ON lap.id_jenis_lap = jl.id_jenis_lap
														WHERE 
															MONTH(lap.tgl_lapor) = $bln AND 
															YEAR(lap.tgl_lapor) = '$thn'
														GROUP BY lap.id_jenis_lap")->result();

		$data['lap_per_thn_by_jenis'] = $this->db->query("SELECT 
															lap.id_jenis_lap,
															MONTH(lap.tgl_lapor) AS bulan,
															jl.nama_jenis_lap,
															COUNT(lap.id_lapor) AS jml_lapor
														FROM lapor lap 
														LEFT JOIN jenis_laporan jl 
															ON lap.id_jenis_lap = jl.id_jenis_lap
														WHERE 
															YEAR(lap.tgl_lapor) = '$thn'
														GROUP BY lap.id_jenis_lap, bulan
														ORDER BY bulan ASC")->result();

		$data['jenis_laporan'] = $this->MasterData->getWhereDataAll('jenis_laporan', "id_kategori = 1")->result();

		if ($data_lap == null || $data_lap == '') {
			$data['data_lap'] = "Kosong";
		}else{
			$data['data_lap'] = $data_lap;
		}
		$data['tahun'] = $thn;
		$data['bulan'] = $bln;

		$select = "YEAR(tgl_lapor) thn";
		$group = "YEAR(tgl_lapor)";
		$by = "YEAR(tgl_lapor)";
		$order = 'ASC';
		$data['data_thn'] = $this->MasterData->getDataGroupOrder($select,'lapor',$group,$by,$order)->result();

		view('pages/dashboard', $data);
	}

	public function trackLaporan($value=''){
		$data['id_nav'] = 2;

		view('pages/track_leaf', $data);
	}

	public function lapSelesai($value=''){
		// $this->load->library('Firebase');
		// include_once(APPPATH.'libraries/Firebase.php');

		$id_lap = $this->input->post('id_lap');
		$key = $this->input->post('key');

		// var_dump($id_lap);exit();

		$waktu_selesai = date('Y-m-d H:i:s');
		$where = "id_lapor = '$id_lap'";
		$data = array(
			'status' => 'selesai',
			'waktu_selesai' => $waktu_selesai
		);
		$table = 'lapor';
		$update_lap = $this->MasterData->editData($where,$data,$table);

		if ($update_lap) {
			$where = "id_lapor = '$id_lap'";
			$data = array(
				'status' => 'Selesai'
			);
			$table = 'log_lapor';
			$update_petugas = $this->MasterData->editData($where,$data,$table);

			if ($update_petugas) {
				echo "Success";
			}else{
				echo "Failed";
			}
			
		}else{
			echo "Failed";
		}
	}

	public function lapBatal($value=''){

		$id_lap = $this->input->post('id_lap');
		$ket = $this->input->post('ket');

		$select = array(
			'id_kategori',
			'id_user'
		);
		$where = "id_lapor = '$id_lap'";
		$dataLap = $this->MasterData->getWhereData($select,'lapor',$where)->row();

		$id_kategori = $dataLap->id_kategori;
		$id_user = $dataLap->id_user;

		$select = 'no_hp';
		$where = "id_user = '$id_user'";
		$noTelp = $this->MasterData->getWhereData($select,'users',$where)->row()->no_hp;

		$select = 'skpd';
		$where = "id_kategori = '$id_kategori'";
		$skpd = $this->MasterData->getWhereData($select,'kategori',$where)->row()->skpd;

		$pesan = "Pengirim : $skpd\n\n\nStatus laporan: Dibatalkan Admin\nKeterangan: $ket\n\n(Dikirim melalui aplikasi SIYAP)";

        // $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
        // $newID = $cek->Auto_increment;

        // menghitung jumlah pecahan
        // $jmlSMS = ceil(strlen($pesan)/153);

        // memecah pesan asli
        // $pecah  = str_split($pesan, 153);

        // proses penyimpanan ke tabel mysql untuk setiap pecahan
        // $counts = 0;
        // for ($i=1; $i<=$jmlSMS; $i++){
        //    // membuat UDH untuk setiap pecahan, sesuai urutannya
        //    $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);

        //    // membaca text setiap pecahan
        //    $msg = $pecah[$i-1];

        //    if ($i == 1){
	    //          // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
        //    		$data = array(
		//             'DestinationNumber' => $noTelp,
		//             'UDH' => $udh,
		//             'TextDecoded' => $msg,
		//             'ID' => $newID,
		//             'MultiPart' => 'true',
		//             'CreatorID' => 'Siyap'
		//         );

		//         // $table = 'outbox';
		// 		// $input_msg = $this->MasterData->sendMsg($data,$table);

        //    }else{
        //       	// jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
        //     	$data = array(
		//             'UDH' => $udh,
		//             'TextDecoded' => $msg,
		//             'ID' => $newID,
		//             'SequencePosition' => $i
		//         );

		//         $table = 'outbox_multipart';
		// 		// $input_msg = $this->MasterData->sendMsg($data,$table);
        //    }

        //    	if ($input_msg) {
	    //      	$counts++;
	    //     }          
		// }
		$input_msg = kirim_wa($noTelp, $pesan);

        if ($input_msg) {
        	$waktu_batal = date('Y-m-d H:i:s');
			$data = array(
				'id_lapor' => $id_lap,
				'keterangan' => $ket,
				'waktu_batal' => $waktu_batal
			);
			$batalkan = $this->MasterData->inputData($data,'batal_lapor');

			if ($batalkan) {
				$where = "id_lapor = '$id_lap'";
				$data = array(
					'status' => 'batal'
				);
				$table = 'lapor';
				$update_lap = $this->MasterData->editData($where,$data,$table);

				if ($update_lap) {
					echo "Success";
				}else{
					echo "Failed";
				}
			}else{
				echo "Failed";
			}
        }else{
        	echo "Failed";
        }
	}

	public function showLap($val=''){
		$id = $this->input->POST('id_lap');

		// var_dump($id);exit();

		// $select = '*';
		// $table = array(
		// 	'lapor lap',
		// 	'laporan_damkar ld'
		// );
		// $where = "lap.id_lapor = ld.id_lapor AND lap.id_lapor = '$id'";
		// $data = $this->MasterData->getWhereData($select,$table,$where)->row();

		$data_lapor = $this->db->query("SELECT lap.id_lapor, lap.alamat, lap.image_lapor, lap.image_selfie, lap.tgl_lapor, lap.status, lap.keterangan, lap.waktu_selesai, (SELECT usr.nama FROM users usr WHERE lap.id_user = usr.id_user) AS nama_user, (SELECT usr.no_hp FROM users usr WHERE lap.id_user = usr.id_user) AS no_hp, ld.jenis_kejadian, ld.penyebab_kejadian, ld.nama_korban, ld.alamat_korban, ld.saksi, ld.kerugian, ld.kronologi, ld.tindakan, ld.obyek_terbakar, ld.asal_api, ld.ket_laporan, ld.unit, ld.regu, ld.pos FROM lapor lap LEFT JOIN laporan_damkar ld ON lap.id_lapor = ld.id_lapor WHERE lap.id_lapor = '$id'")->row();

		$data_foto = $this->db->query("SELECT foto_kejadian FROM log_lapor WHERE id_lapor = '$id'")->result();
		$ket_kejadian = $this->db->query("SELECT keterangan FROM log_lapor WHERE id_lapor = '$id'")->result();
		$waktu_selesai = $this->db->query("SELECT waktu_selesai FROM log_lapor WHERE id_lapor = '$id' ORDER BY waktu_selesai ASC LIMIT 1")->result();

		$data = array(
			'lapor' => $data_lapor,
			'waktu' => $waktu_selesai,
			'foto' => $data_foto,
			'kronologi' => $ket_kejadian
		);

		echo json_encode($data);
	}
	// ==========================================================
	public function kejadianKebakaran($value=''){
		$data['id_nav'] = 11;
		$data['id_sub_nav'] = 11.1;

		$select = array(
			'lpr.*',
			'jl.*',
			'log.foto_kejadian',
			'(SELECT usr.nama FROM users usr WHERE lpr.id_user = usr.id_user) nama_user'
		);
		$table = array(
			'kategori ktg',
			'lapor lpr',
			'jenis_laporan jl',
			'log_lapor log',
		);
		$where 	= "lpr.id_kategori = ktg.id_kategori AND jl.id_jenis_lap = lpr.id_jenis_lap AND ktg.nama_kategori = 'Damkar' AND jl.grup_jenis = 'kebakaran' AND lpr.id_lapor = log.id_lapor AND log.status = 'Selesai'";
		$order 	= 'DESC';
		$by 	= 'lpr.id_lapor';
		// $data['histori'] = $this->MasterData->getWhereData($select,$table,$where)->result();
		// $data['histori'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		// $foot['data_kejadian'] = true;
		$data['jenis_lap'] = 'kebakaran';
		
		view('pages/kejadian_kebakaran', $data);
	}

	public function addKejadianKebakaran($value=''){
		$data['id_nav'] = 11;
		$data['id_sub_nav'] = 11.1;

		$data['form'] = 'add';

		$where = "id_kategori = 1 AND grup_jenis = 'kebakaran'";
		$data['jenis_kejadian'] = $this->MasterData->getWhereDataAll('jenis_laporan',$where)->result();

		$data['title_form'] = 'TAMBAH LAPORAN';

		view('pages/kejadian_kebakaran_form', $data);
	}

	public function editKejadianKebakaran($id=''){
		$data['id_nav'] = 11;
		$data['id_sub_nav'] = 11.1;

		$data['form'] = 'edit';

		$id_lapor = decode($id);

		$where = "id_kategori = 1 AND grup_jenis = 'kebakaran'";
		$data['jenis_kejadian'] = $this->MasterData->getWhereDataAll('jenis_laporan',$where)->result();

		$select = array(
			'lpr.*',
			'jl.*',
			'ld.*',
			'log.foto_kejadian',
			'(SELECT usr.nama FROM users usr WHERE lpr.id_user = usr.id_user) nama_user'
		);
		$table = array(
			'lapor lpr',
			'jenis_laporan jl',
			'log_lapor log',
			'laporan_damkar ld',
		);
		$where 	= "jl.id_jenis_lap = lpr.id_jenis_lap AND lpr.id_lapor = log.id_lapor AND ld.id_lapor = lpr.id_lapor AND lpr.id_lapor = $id_lapor";
		$data['laporan'] = $this->MasterData->getWhereData($select,$table,$where)->row_array();
		// var_dump($data['laporan']);exit();
		$data['id_lapor'] = $id;
		$data['title_form'] = 'UBAH LAPORAN';
		
		view('pages/kejadian_kebakaran_form', $data);
	}

	public function simpanKejadianKebakaran() {
		$input = html_escape($this->input->POST());
		
		if ($input) {

			$data_lapor = array(
				'id_kategori'	=> $this->id_kategori,
				'id_user'		=> $this->login_id,
				'id_jenis_lap' 	=> $input['jenis_kejadian'],
				'alamat' 		=> $input['almt_kejadian'],
				'tgl_lapor' 	=> date('Y-m-d H:i:s', strtotime($input['tgl_kejadian'].' '.$input['waktu_awal'])),
				'waktu_selesai' => date('Y-m-d H:i:s', strtotime($input['tgl_selesai'].' '.$input['waktu_akhir'])),
				'keterangan' 	=> $input['keterangan'],
				'status'		=> 'selesai',
			);

			$id_jenis_lap = $input['jenis_kejadian'];
			$where = "id_jenis_lap = $id_jenis_lap";
			$data_jenis_kejadian = $this->MasterData->getWhereDataAll('jenis_laporan',$where)->row()->nama_jenis_lap;

			$input_lapor = $this->MasterData->inputData($data_lapor,'lapor');

			if ($input_lapor) {
				$id_lapor = $this->db->insert_id();

				$size_file = 5120;
				$overwrite = false;
				$allow     = 'jpg|jpeg';
				$path_file = 'assets/path_kejadian';
				$new_path  = 'assets/path_kejadian';
				$width     = 750;
				$height    = 750;
				// $x         = 100;
				// $y         = 100;
				$watermark = '';

				$photos = array();

				if (isset($_FILES['foto_kejadian'])) {
					$fileupload = $_FILES['foto_kejadian'];
					foreach ($fileupload['name'] as $key => $val) {
						if ($val != null && $val != '') {
							$_FILES['foto_kejadian' . $key]['name']		= $fileupload['name'][$key];
							$_FILES['foto_kejadian' . $key]['type']		= $fileupload['type'][$key];
							$_FILES['foto_kejadian' . $key]['tmp_name']	= $fileupload['tmp_name'][$key];
							$_FILES['foto_kejadian' . $key]['error']		= $fileupload['error'][$key];
							$_FILES['foto_kejadian' . $key]['size']		= $fileupload['size'][$key];

							// $image_info = getimagesize($_FILES['foto_kejadian'.$key]['tmp_name']);
							// $image_width = $image_info[0];
							// $image_height = $image_info[1];

							$upload = upload_photo('foto_kejadian' . $key, $size_file, $overwrite, $path_file, $width, $height, FALSE, $new_path, $watermark);
							if ($upload['respons']) {
								array_push($photos, $upload['data']);
							}
						}
					}
				}

				$data_photos = implode(",", $photos);

				$data_log_lapor = array(
					'id_lapor' 		=> $id_lapor,
					'id_user'		=> $this->login_id,
					'waktu_proses'	=> date('Y-m-d H:i:s', strtotime($input['tgl_kejadian'].' '.$input['waktu_awal'])),
					'waktu_selesai'	=> date('Y-m-d H:i:s', strtotime($input['tgl_selesai'].' '.$input['waktu_akhir'])),
					'foto_kejadian'	=> $data_photos,
					'keterangan'	=> $input['keterangan'],
					'status'		=> 'Selesai',
				);

				$input_log_lapor = $this->MasterData->inputData($data_log_lapor,'log_lapor');

				if ($input_log_lapor) {
					$data_lap_damkar = array(
						'id_lapor' 			=> $id_lapor,
						'alamat_korban'		=> $input['almt_kejadian'],
						'jenis_kejadian'	=> $data_jenis_kejadian,
						'obyek_terbakar' 	=> $input['obyek_terbakar'],
						'nama_pelapor'		=> $input['pelapor'],
						'no_hp_pelapor'		=> $input['no_hp_pelapor'],
						'asal_api' 			=> $input['asal_api'],
						'nama_korban'		=> $input['nama_pemilik'],
						'kerugian' 			=> $input['kerugian'],
						'kronologi' 		=> $input['kronologi'],
						'ket_laporan' 		=> $input['ket_kejadian'],
						'unit' 				=> $input['unit'],
						'regu' 				=> $input['regu'],
						'pos' 				=> $input['pos']
					);

					$input_lap_damkar = $this->MasterData->inputData($data_lap_damkar,'laporan_damkar');

					if ($input_lap_damkar) {
						alert_success('Laporan kejadian berhasil disimpan.');
						redirect(base_url().'Damkar/kejadianKebakaran');
					} else {
						alert_failed('Laporan kejadian gagal disimpan.');
						redirect(base_url().'Damkar/addKejadianKebakaran');
					}
				}
			} else {
				alert_failed('Laporan kejadian gagal disimpan.');
				redirect(base_url().'Damkar/addKejadianKebakaran');
			}
		} else {
			alert_failed('Laporan kejadian gagal disimpan.');
			redirect(base_url().'Damkar/addKejadianKebakaran');
		}
	}

	public function updateKejadianKebakaran() {
		$input = html_escape($this->input->POST());
		
		if ($input) {

			$id_lapor = decode($input['id_lapor']);

			$data_lapor = array(
				// 'id_kategori'	=> $this->id_kategori,
				'id_user'		=> $this->login_id,
				'id_jenis_lap' 	=> $input['jenis_kejadian'],
				'alamat' 		=> $input['almt_kejadian'],
				'tgl_lapor' 	=> date('Y-m-d H:i:s', strtotime($input['tgl_kejadian'].' '.$input['waktu_awal'])),
				'waktu_selesai' => date('Y-m-d H:i:s', strtotime($input['tgl_selesai'].' '.$input['waktu_akhir'])),
				'keterangan' 	=> $input['keterangan'],
				'status'		=> 'selesai',
			);

			$id_jenis_lap = $input['jenis_kejadian'];
			$where = "id_jenis_lap = $id_jenis_lap";
			$data_jenis_kejadian = $this->MasterData->getWhereDataAll('jenis_laporan',$where)->row()->nama_jenis_lap;

			$where = "id_lapor = $id_lapor";
			$input_lapor = $this->MasterData->editData($where,$data_lapor,'lapor');

			if ($input_lapor) {

				$size_file = 5120;
				$overwrite = false;
				$allow     = 'jpg|jpeg';
				$path_file = 'assets/path_kejadian';
				$new_path  = 'assets/path_kejadian';
				$width     = 750;
				$height    = 750;
				// $x         = 100;
				// $y         = 100;
				$watermark = '';

				$photos = array();

				$data_photos_old = $this->MasterData->getDataWhere('log_lapor',$where)->row()->foto_kejadian;
				$data_photos_old_arr = explode(",", $data_photos_old);

				if (isset($_FILES['foto_kejadian'])) {
					$fileupload = $_FILES['foto_kejadian'];
					foreach ($fileupload['name'] as $key => $val) {
						$file_old = $input['foto_kejadian_old'][$key];
						if ($file_old == '' && $file_old == null) {
							if ($val != null && $val != '') {
								$_FILES['foto_kejadian' . $key]['name']		= $fileupload['name'][$key];
								$_FILES['foto_kejadian' . $key]['type']		= $fileupload['type'][$key];
								$_FILES['foto_kejadian' . $key]['tmp_name']	= $fileupload['tmp_name'][$key];
								$_FILES['foto_kejadian' . $key]['error']	= $fileupload['error'][$key];
								$_FILES['foto_kejadian' . $key]['size']		= $fileupload['size'][$key];

								// $image_info = getimagesize($_FILES['foto_kejadian'.$key]['tmp_name']);
								// $image_width = $image_info[0];
								// $image_height = $image_info[1];

								$upload = upload_photo('foto_kejadian' . $key, $size_file, $overwrite, $path_file, $width, $height, FALSE, $new_path, $watermark);
								if ($upload['respons']) {
									array_push($photos, $upload['data']);
								}
							}

						} else {
							array_push($photos, $file_old);
						}
					}
				}

				foreach ($data_photos_old_arr as $key) {
					$cek = 0;
					foreach ($photos as $val) {
						if ($key == $val) {
							$cek++;
						}
					}

					if ($cek == 0) {
						unlink('./assets/path_kejadian/'.$key);
					}
				}

				$data_photos = implode(",", $photos);

				$data_log_lapor = array(
					// 'id_lapor' 			=> $id_lapor,
					'id_user'		=> $this->login_id,
					'waktu_proses'	=> date('Y-m-d H:i:s', strtotime($input['tgl_kejadian'].' '.$input['waktu_awal'])),
					'waktu_selesai'	=> date('Y-m-d H:i:s', strtotime($input['tgl_selesai'].' '.$input['waktu_akhir'])),
					'foto_kejadian'	=> $data_photos,
					'keterangan'	=> $input['keterangan'],
					'status'		=> 'Selesai',
				);

				$input_log_lapor = $this->MasterData->editData($where,$data_log_lapor,'log_lapor');

				if ($input_log_lapor) {
					$data_lap_damkar = array(
						// 'id_lapor' 			=> $id_lapor,
						'alamat_korban'		=> $input['almt_kejadian'],
						'jenis_kejadian'	=> $data_jenis_kejadian,
						'obyek_terbakar' 	=> $input['obyek_terbakar'],
						'nama_pelapor'		=> $input['pelapor'],
						'no_hp_pelapor'		=> $input['no_hp_pelapor'],
						'asal_api' 			=> $input['asal_api'],
						'nama_korban'		=> $input['nama_pemilik'],
						'kerugian' 			=> $input['kerugian'],
						'kronologi' 		=> $input['kronologi'],
						'ket_laporan' 		=> $input['ket_kejadian'],
						'unit' 				=> $input['unit'],
						'regu' 				=> $input['regu'],
						'pos' 				=> $input['pos']
					);

					$input_lap_damkar = $this->MasterData->editData($where,$data_lap_damkar,'laporan_damkar');

					if ($input_lap_damkar) {
						alert_success('Laporan kejadian berhasil disimpan.');
						redirect(base_url().'Damkar/kejadianKebakaran');
					} else {
						alert_failed('Laporan kejadian gagal disimpan.');
						redirect(base_url().'Damkar/addKejadianKebakaran');
					}
				}
			} else {
				alert_failed('Laporan kejadian gagal disimpan.');
				redirect(base_url().'Damkar/addKejadianKebakaran');
			}
		} else {
			alert_failed('Laporan kejadian gagal disimpan.');
			redirect(base_url().'Damkar/addKejadianKebakaran');
		}
	}

	public function getDataKejadian($jenis = 'kebakaran') {
        if ($this->input->POST()) {
            $this->load->model("Data_tbl_histori_kejadian", "DataTable");
            $fetch_data = $this->DataTable->make_datatables($jenis);

			if ($jenis != 'kebakaran') {
				$link_edit = 'editKejadianLain';
			} else {
				$link_edit = 'editKejadianKebakaran';
			}

            $data = array();
            $i = $_POST['start'];
            foreach ($fetch_data as $val) {
                $btn = '';
				$foto = '';
                $i++;

                $btn_hapus = ' <button title="Hapus" class="btn btn-sm btn-danger waves-effect" 
								data-id="'.encode($val->id_lapor).'" 
								onclick="delLap(this)" 
								style="margin-bottom: 5px; width: 5px;">
									<i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">delete</i>
								</button> ';
                
                $btn_edit = ' <a href="'.base_url('Damkar/'.$link_edit.'/'.encode($val->id_lapor)) .'" 
							title="Edit" class="btn btn-sm bg-green waves-effect" 
							style="margin-bottom: 5px; width: 5px;">
								<i class="material-icons" 
								style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">border_color</i>
							</a> ';

                $btn_lap = ' <a href="'.base_url('Damkar/cetakLap2/'.$val->id_lapor).'" target="_blank" 
				title="Cetak Laporan" class="btn btn-sm bg-purple waves-effect"
				style="margin-bottom: 5px; width: 5px">
				<i class="material-icons"
					style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">assignment</i></a> ';

                $btn .= $btn_hapus;
                $btn .= $btn_edit;
                $btn .= $btn_lap;
				
				if ($val->foto_kejadian != null && $val->foto_kejadian != '') {
					$pic = explode(",", $val->foto_kejadian);
					$x = 0;
					foreach ($pic as $key => $file) {
						$x++;

						$foto .= '<a class="foto_kejadian" href="'.base_url().'assets/path_kejadian/'.$file.'" rel="'.$val->id_lapor.'">
									<button class="btn btn-sm btn-raised bg-deep-purple waves-effect" style="margin-bottom: 8px; font-size: 8pt; margin-left: -2px; width: 50px">
										<i class="material-icons" style="margin-bottom: 8px; font-size: 10pt; margin-left: -2px;">image</i> Foto '.$x.'</button></a><br>';
					}
				}

                $columns = array(
                    $i,
                    $btn,
                    $foto,
                    $val->waktu_lapor,
                    $val->alamat,
                    $val->keterangan,
                    $val->nama_jenis_lap,
                );

                $data[] = $columns;
            }
            $output = array(
                "draw"               =>     $_POST["draw"],
                "recordsTotal"       =>     $this->DataTable->get_all_data($jenis),
                "recordsFiltered"    =>     $this->DataTable->get_filtered_data($jenis),
                "data"               =>     $data
            );
            echo json_encode($output);
        }
    }

	// ====================================================

	public function kejadianLain($value=''){
		$data['id_nav'] = 11;
		$data['id_sub_nav'] = 11.2;

		$select = array(
			'lpr.*',
			'jl.*',
			'log.foto_kejadian',
			'(SELECT usr.nama FROM users usr WHERE lpr.id_user = usr.id_user) nama_user'
		);
		$table = array(
			'kategori ktg',
			'lapor lpr',
			'jenis_laporan jl',
			'log_lapor log',
		);
		$where 	= "lpr.id_kategori = ktg.id_kategori AND jl.id_jenis_lap = lpr.id_jenis_lap AND ktg.nama_kategori = 'Damkar' AND jl.grup_jenis = 'non_kebakaran' AND lpr.id_lapor = log.id_lapor AND log.status = 'Selesai'";
		$order 	= 'DESC';
		$by 	= 'lpr.id_lapor';
		// $data['histori'] = $this->MasterData->getWhereData($select,$table,$where)->result();
		// $data['histori'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		// $foot['data_kejadian'] = true;
		$data['jenis_lap'] = 'non_kebakaran';

		view('pages/kejadian_lain', $data);
	}

	public function addKejadianLain($value=''){
		$data['id_nav'] = 11;
		$data['id_sub_nav'] = 11.2;

		$data['form'] = 'add';

		$where = "id_kategori = 1 AND grup_jenis = 'non_kebakaran'";
		$data['jenis_kejadian'] = $this->MasterData->getWhereDataAll('jenis_laporan',$where)->result();
		
		$data['title_form'] = 'TAMBAH LAPORAN';
		
		view('pages/kejadian_lain_form', $data);
	}

	public function simpanKejadianLain() {
		$input = html_escape($this->input->POST());
		
		if ($input) {

			$data_lapor = array(
				'id_kategori'	=> $this->id_kategori,
				'id_user'		=> $this->login_id,
				'id_jenis_lap' 	=> $input['jenis_kejadian'],
				'alamat' 		=> $input['almt_kejadian'],
				'tgl_lapor' 	=> date('Y-m-d H:i:s', strtotime($input['tgl_kejadian'].' '.$input['waktu_awal'])),
				'waktu_selesai' => date('Y-m-d H:i:s', strtotime($input['tgl_selesai'].' '.$input['waktu_akhir'])),
				'keterangan' 	=> $input['keterangan'],
				'status'		=> 'selesai',
			);

			$id_jenis_lap = $input['jenis_kejadian'];
			$where = "id_jenis_lap = $id_jenis_lap";
			$data_jenis_kejadian = $this->MasterData->getWhereDataAll('jenis_laporan',$where)->row()->nama_jenis_lap;

			$input_lapor = $this->MasterData->inputData($data_lapor,'lapor');

			if ($input_lapor) {
				$id_lapor = $this->db->insert_id();

				$size_file = 5120;
				$overwrite = false;
				$allow     = 'jpg|jpeg';
				$path_file = 'assets/path_kejadian';
				$new_path  = 'assets/path_kejadian';
				$width     = 750;
				$height    = 750;
				// $x         = 100;
				// $y         = 100;
				$watermark = '';

				$photos = array();

				if (isset($_FILES['foto_kejadian'])) {
					$fileupload = $_FILES['foto_kejadian'];
					foreach ($fileupload['name'] as $key => $val) {
						if ($val != null && $val != '') {
							$_FILES['foto_kejadian' . $key]['name']		= $fileupload['name'][$key];
							$_FILES['foto_kejadian' . $key]['type']		= $fileupload['type'][$key];
							$_FILES['foto_kejadian' . $key]['tmp_name']	= $fileupload['tmp_name'][$key];
							$_FILES['foto_kejadian' . $key]['error']		= $fileupload['error'][$key];
							$_FILES['foto_kejadian' . $key]['size']		= $fileupload['size'][$key];

							// $image_info = getimagesize($_FILES['foto_kejadian'.$key]['tmp_name']);
							// $image_width = $image_info[0];
							// $image_height = $image_info[1];

							$upload = upload_photo('foto_kejadian' . $key, $size_file, $overwrite, $path_file, $width, $height, FALSE, $new_path, $watermark);
							if ($upload['respons']) {
								array_push($photos, $upload['data']);
							}
						}
					}
				}

				$data_photos = implode(",", $photos);

				$data_log_lapor = array(
					'id_lapor' 		=> $id_lapor,
					'id_user'		=> $this->login_id,
					'waktu_proses'	=> date('Y-m-d H:i:s', strtotime($input['tgl_kejadian'].' '.$input['waktu_awal'])),
					'waktu_selesai'	=> date('Y-m-d H:i:s', strtotime($input['tgl_selesai'].' '.$input['waktu_akhir'])),
					'foto_kejadian'	=> $data_photos,
					'keterangan'	=> $input['keterangan'],
					'status'		=> 'Selesai',
				);

				$input_log_lapor = $this->MasterData->inputData($data_log_lapor,'log_lapor');

				if ($input_log_lapor) {
					$data_lap_damkar = array(
						'id_lapor' 			=> $id_lapor,
						'alamat_korban'		=> $input['almt_korban'],
						'jenis_kejadian'	=> $data_jenis_kejadian,
						'penyebab_kejadian' => $input['penyebab_kejadian'],
						// 'obyek_terbakar' 	=> $input['obyek_terbakar'],
						'saksi' 			=> $input['saksi'],
						'nama_pelapor'		=> $input['pelapor'],
						'no_hp_pelapor'		=> $input['no_hp_pelapor'],
						// 'asal_api' 			=> $input['asal_api'],
						'nama_korban'		=> $input['nama_korban'],
						'kerugian' 			=> $input['kerugian'],
						'kronologi' 		=> $input['kronologi'],
						'tindakan' 			=> $input['tindakan'],
						// 'ket_laporan' 		=> $input['ket_kejadian'],
						'unit' 				=> $input['unit'],
						'regu' 				=> $input['regu'],
						'pos' 				=> $input['pos']
					);

					$input_lap_damkar = $this->MasterData->inputData($data_lap_damkar,'laporan_damkar');

					if ($input_lap_damkar) {
						alert_success('Laporan kejadian berhasil disimpan.');
						redirect(base_url().'Damkar/kejadianLain');
					} else {
						alert_failed('Laporan kejadian gagal disimpan.');
						redirect(base_url().'Damkar/addKejadianLain');
					}
				}
			} else {
				alert_failed('Laporan kejadian gagal disimpan.');
				redirect(base_url().'Damkar/addKejadianLain');
			}
		} else {
			alert_failed('Laporan kejadian gagal disimpan.');
			redirect(base_url().'Damkar/addKejadianLain');
		}
	}

	public function editKejadianLain($id=''){
		$data['id_nav'] = 11;
		$data['id_sub_nav'] = 11.2;

		$data['form'] = 'edit';

		$id_lapor = decode($id);

		$where = "id_kategori = 1 AND grup_jenis = 'non_kebakaran'";
		$data['jenis_kejadian'] = $this->MasterData->getWhereDataAll('jenis_laporan',$where)->result();

		$select = array(
			'lpr.*',
			'jl.*',
			'ld.*',
			'log.foto_kejadian',
			'(SELECT usr.nama FROM users usr WHERE lpr.id_user = usr.id_user) nama_user'
		);
		$table = array(
			'lapor lpr',
			'jenis_laporan jl',
			'log_lapor log',
			'laporan_damkar ld',
		);
		$where 	= "jl.id_jenis_lap = lpr.id_jenis_lap AND lpr.id_lapor = log.id_lapor AND ld.id_lapor = lpr.id_lapor AND lpr.id_lapor = $id_lapor";
		$data['laporan'] = $this->MasterData->getWhereData($select,$table,$where)->row_array();
		// var_dump($data['laporan']);exit();
		$data['id_lapor'] = $id;
		
		$data['title_form'] = 'UBAH LAPORAN';
		
		view('pages/kejadian_lain_form', $data);
	}

	public function updateKejadianLain() {
		$input = html_escape($this->input->POST());
		
		if ($input) {

			$id_lapor = decode($input['id_lapor']);

			$data_lapor = array(
				// 'id_kategori'	=> $this->id_kategori,
				'id_user'		=> $this->login_id,
				'id_jenis_lap' 	=> $input['jenis_kejadian'],
				'alamat' 		=> $input['almt_kejadian'],
				'tgl_lapor' 	=> date('Y-m-d H:i:s', strtotime($input['tgl_kejadian'].' '.$input['waktu_awal'])),
				'waktu_selesai' => date('Y-m-d H:i:s', strtotime($input['tgl_selesai'].' '.$input['waktu_akhir'])),
				'keterangan' 	=> $input['keterangan'],
				'status'		=> 'selesai',
			);

			$id_jenis_lap = $input['jenis_kejadian'];
			$where = "id_jenis_lap = $id_jenis_lap";
			$data_jenis_kejadian = $this->MasterData->getWhereDataAll('jenis_laporan',$where)->row()->nama_jenis_lap;

			$where = "id_lapor = $id_lapor";
			$input_lapor = $this->MasterData->editData($where,$data_lapor,'lapor');

			if ($input_lapor) {

				$size_file = 5120;
				$overwrite = false;
				$allow     = 'jpg|jpeg';
				$path_file = 'assets/path_kejadian';
				$new_path  = 'assets/path_kejadian';
				$width     = 750;
				$height    = 750;
				// $x         = 100;
				// $y         = 100;
				$watermark = '';

				$photos = array();

				$data_photos_old = $this->MasterData->getDataWhere('log_lapor',$where)->row()->foto_kejadian;
				$data_photos_old_arr = explode(",", $data_photos_old);

				if (isset($_FILES['foto_kejadian'])) {
					$fileupload = $_FILES['foto_kejadian'];
					foreach ($fileupload['name'] as $key => $val) {
						$file_old = $input['foto_kejadian_old'][$key];
						if ($file_old == '' && $file_old == null) {
							if ($val != null && $val != '') {
								$_FILES['foto_kejadian' . $key]['name']		= $fileupload['name'][$key];
								$_FILES['foto_kejadian' . $key]['type']		= $fileupload['type'][$key];
								$_FILES['foto_kejadian' . $key]['tmp_name']	= $fileupload['tmp_name'][$key];
								$_FILES['foto_kejadian' . $key]['error']	= $fileupload['error'][$key];
								$_FILES['foto_kejadian' . $key]['size']		= $fileupload['size'][$key];

								// $image_info = getimagesize($_FILES['foto_kejadian'.$key]['tmp_name']);
								// $image_width = $image_info[0];
								// $image_height = $image_info[1];

								$upload = upload_photo('foto_kejadian' . $key, $size_file, $overwrite, $path_file, $width, $height, FALSE, $new_path, $watermark);
								if ($upload['respons']) {
									array_push($photos, $upload['data']);
								}
							}

						} else {
							array_push($photos, $file_old);
						}
					}
				}

				foreach ($data_photos_old_arr as $key) {
					$cek = 0;
					foreach ($photos as $val) {
						if ($key == $val) {
							$cek++;
						}
					}

					if ($cek == 0) {
						unlink('./assets/path_kejadian/'.$key);
					}
				}

				$data_photos = implode(",", $photos);

				$data_log_lapor = array(
					// 'id_lapor' 			=> $id_lapor,
					'id_user'		=> $this->login_id,
					'waktu_proses'	=> date('Y-m-d H:i:s', strtotime($input['tgl_kejadian'].' '.$input['waktu_awal'])),
					'waktu_selesai'	=> date('Y-m-d H:i:s', strtotime($input['tgl_selesai'].' '.$input['waktu_akhir'])),
					'foto_kejadian'	=> $data_photos,
					'keterangan'	=> $input['keterangan'],
					'status'		=> 'Selesai',
				);

				$input_log_lapor = $this->MasterData->editData($where,$data_log_lapor,'log_lapor');

				if ($input_log_lapor) {
					$data_lap_damkar = array(
						// 'id_lapor' 			=> $id_lapor,
						'alamat_korban'		=> $input['almt_korban'],
						'jenis_kejadian'	=> $data_jenis_kejadian,
						'penyebab_kejadian' => $input['penyebab_kejadian'],
						// 'obyek_terbakar' 	=> $input['obyek_terbakar'],
						'saksi' 			=> $input['saksi'],
						'nama_pelapor'		=> $input['pelapor'],
						'no_hp_pelapor'		=> $input['no_hp_pelapor'],
						// 'asal_api' 			=> $input['asal_api'],
						'nama_korban'		=> $input['nama_korban'],
						'kerugian' 			=> $input['kerugian'],
						'kronologi' 		=> $input['kronologi'],
						'tindakan' 			=> $input['tindakan'],
						// 'ket_laporan' 		=> $input['ket_kejadian'],
						'unit' 				=> $input['unit'],
						'regu' 				=> $input['regu'],
						'pos' 				=> $input['pos']
					);

					$input_lap_damkar = $this->MasterData->editData($where,$data_lap_damkar,'laporan_damkar');

					if ($input_lap_damkar) {
						alert_success('Laporan kejadian berhasil disimpan.');
						redirect(base_url().'Damkar/kejadianLain');
					} else {
						alert_failed('Laporan kejadian gagal disimpan.');
						redirect(base_url().'Damkar/addKejadianLain');
					}
				}
			} else {
				alert_failed('Laporan kejadian gagal disimpan.');
				redirect(base_url().'Damkar/addKejadianLain');
			}
		} else {
			alert_failed('Laporan kejadian gagal disimpan.');
			redirect(base_url().'Damkar/addKejadianLain');
		}
	}

	public function hapusLaporan($val=''){
		$id_lapor = decode($this->input->POST('id_lapor'));

		$where = "id_lapor = '$id_lapor'";
		$hapus_lapor = $this->MasterData->deleteData($where,'lapor');

		if ($hapus_lapor) {
			$hapus_lapor_damkar = $this->MasterData->deleteData($where,'laporan_damkar');

			if ($hapus_lapor_damkar) {

				$data_photos = $this->MasterData->getWhereDataAll('log_lapor',$where)->row()->foto_kejadian;

				if ($data_photos != null && $data_photos != '') {
					$data_photos_arr = explode(",", $data_photos);

					foreach ($data_photos_arr as $key) {
						unlink('./assets/path_kejadian/'.$key);
					}
				}

				$hapus_log_lapor = $this->MasterData->deleteData($where,'log_lapor');

				if ($hapus_log_lapor) {
					echo 'Success';
				}
			} else {
				echo 'Gagal';
			}
		} else {
			echo 'Gagal';
		}
	}
	// ===========================================================

	public function historiAduan($value=''){
		$data['id_nav'] = 3;
		// $data['id_sub_nav'] = 3.2;

		$select = array(
			'lpr.*',
			'jl.*',
			'(SELECT usr.nama FROM users usr WHERE lpr.id_user = usr.id_user) nama_user'
		);
		$table = array(
			'kategori ktg',
			'lapor lpr',
			'jenis_laporan jl'
		);
		$where = "lpr.id_kategori = ktg.id_kategori AND jl.id_jenis_lap = lpr.id_jenis_lap AND ktg.nama_kategori = 'Damkar'";
		$order = 'DESC';
		$by = 'lpr.id_lapor';
		// $data['histori'] = $this->MasterData->getWhereData($select,$table,$where)->result();
		// $data['histori'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		$foot['data_histori'] = true;

		view('pages/histori', $data);
	}	

	public function getDataHistori() {
        if ($this->input->POST()) {
            $this->load->model("Data_tbl_histori_aduan", "DataTable");
            $fetch_data = $this->DataTable->make_datatables();

            $data = array();
            $i = $_POST['start'];
            foreach ($fetch_data as $val) {
                $btn = '';
				$foto = '';
                $i++;

				if ($val->status == 'selesai' || $val->status == 'batal') { 
					if ($val->status == 'batal') {
						$btn_lap = '<button title="Laporan Kejadian Lain-Lain" class="btn btn-sm bg-link waves-effect" style="margin-bottom: 5px; width: 5px;" disabled><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">assignment</i></button> 

						<button title="Laporan Kebakaran" class="btn btn-sm bg-link waves-effect" style="margin-bottom: 5px; width: 5px;" disabled><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">assignment</i></button> ';
					} else {
						$btn_lap = '<button title="Laporan Kejadian Lain-Lain" class="btn btn-sm bg-green waves-effect" onclick="addLap('.$val->id_lapor.', '.$val->nama_user.')" style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">assignment</i></button>

						<button title="Laporan Kebakaran" class="btn btn-sm bg-pink waves-effect" onclick="addLapKebakaran('.$val->id_lapor.', '.$val->nama_user.')" style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">assignment</i></button> ';
					}
					
					$btn_selesai = '<button title="Selesai" class="btn btn-sm bg-link waves-effect" disabled style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">check_circle</i></button> ';

					$btn_batal = '<button title="Batal" class="btn btn-sm bg-link waves-effect" disabled style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">cancel</i></button> ';
				} else { 
					$btn_lap = '<button title="Laporan Kejadian Lain-Lain" class="btn btn-sm bg-link waves-effect" style="margin-bottom: 5px; width: 5px;" disabled><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">assignment</i></button>

					<button title="Laporan Kebakaran" class="btn btn-sm bg-link waves-effect" style="margin-bottom: 5px; width: 5px;" disabled><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">assignment</i></button> ';
					
					$btn_selesai = '<button title="Selesai" class="btn btn-sm bg-orange waves-effect" style="margin-bottom: 5px; width: 5px;" onclick="lapSelesai('.$val->id_lapor.')"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">check_circle</i></button> ';

					if ($val->status == 'proses') {
						$btn_batal = '<button title="Batal" class="btn btn-sm bg-link waves-effect" disabled style="margin-bottom: 5px; width: 5px;"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">cancel</i></button> ';
					} else {
						$btn_batal = '<button title="Batal" class="btn btn-sm bg-red waves-effect" style="margin-bottom: 5px; width: 5px;" data-toggle="modal" data-target="#modal_batal" onclick="lapBatal('.$val->id_lapor.')"><i class="material-icons" style="font-size: 12pt; margin-top: -5px; margin-left: -5px;">cancel</i></button> ';
					}
				}

                // $btn .= $btn_lap;
				// $btn .= '<br>';
                $btn .= $btn_selesai;
                $btn .= $btn_batal;
				
				if($val->image_lapor != null && $val->image_lapor != ''){ 
					$foto .= '<a class="foto_kejadian" href="'.base_url().'assets/path_laporan/'.$val->image_lapor.'" rel="'.$val->id_lapor.'"><button class="btn btn-sm btn-primary waves-effect" style="width: 65px; margin-bottom: 5px;">Kejadian</button></a><br>';
				} if($val->image_selfie != null && $val->image_selfie != ''){  
					$foto .= '<a class="foto_kejadian" href="'.base_url().'assets/path_selfie/'.$val->image_selfie.'" rel="'.$val->id_lapor.'"><button class="btn btn-sm bg-pink waves-effect" style="width: 65px">Pelapor</button></a>';
				}

                $columns = array(
                    $i,
                    $btn,
                    $val->nama_user,
                    $val->alamat,
                    $val->keterangan,
                    $val->nama_jenis_lap,
                    $val->waktu_lapor,
                    $foto,
                    $val->status,
                );

                $data[] = $columns;
            }
            $output = array(
                "draw"               =>     $_POST["draw"],
                "recordsTotal"       =>     $this->DataTable->get_all_data(),
                "recordsFiltered"    =>     $this->DataTable->get_filtered_data(),
                "data"               =>     $data
            );
            echo json_encode($output);
        }
    }

	// ===========================================================
	public function simpanLap($value=''){
		$input = html_escape($this->input->POST());

		$select = 'count(*) as jml';
		$table =  'laporan_damkar';
		$where = "id_lapor = '$input[id_lapor]'";
		$cek = $this->MasterData->getWhereData($select,$table,$where)->row()->jml;

		$data_lapor = array(
			'alamat' => $input['almt_kejadian'],
			'tgl_lapor' => date('Y-m-d H:i:s', strtotime($input['tgl_kejadian'].' '.$input['waktu_awal'])),
			'waktu_selesai' => date('Y-m-d H:i:s', strtotime($input['tgl_selesai'].' '.$input['waktu_akhir'])),
			'keterangan' => $input['keterangan']
		);

		$data_lap_damkar = array(
			'id_lapor' => $input['id_lapor'],
			'jenis_kejadian' => $input['jenis_kejadian'],
			'penyebab_kejadian' => $input['penyebab_kejadian'],
			'nama_korban' => $input['nama_korban'],
			'alamat_korban' => $input['almt_korban'],
			'saksi' => $input['saksi'],
			'kerugian' => $input['kerugian'],
			'kronologi' => $input['kronologi'],
			'tindakan' => $input['tindakan'],
			'unit' => $input['unit'],
			'regu' => $input['regu'],
			'pos' => $input['pos']
		);

		if ($cek == 0) {
			$input_lap_damkar = $this->MasterData->inputData($data_lap_damkar,'laporan_damkar');

			$where = "id_lapor = '$input[id_lapor]'";
			$update_lapor = $this->MasterData->editData($where,$data_lapor,'lapor');
		}else{
			$where = "id_lapor = '$input[id_lapor]'";
			$update_lap_damkar = $this->MasterData->editData($where,$data_lap_damkar,'laporan_damkar');

			$update_lapor = $this->MasterData->editData($where,$data_lapor,'lapor');
		}

		// echo "<script>history.back(-1)</script>";
		redirect(base_url().'Damkar/historiAduan');
	}

	public function simpanLap2($value=''){
		$input = html_escape($this->input->POST());

		$select = 'count(*) as jml';
		$table =  'laporan_damkar';
		$where = "id_lapor = '$input[id_lapor]'";
		$cek = $this->MasterData->getWhereData($select,$table,$where)->row()->jml;

		$data_lapor = array(
			'alamat' => $input['almt_kejadian'],
			'tgl_lapor' => date('Y-m-d H:i:s', strtotime($input['tgl_kejadian'].' '.$input['waktu_awal'])),
			'waktu_selesai' => date('Y-m-d H:i:s', strtotime($input['tgl_selesai'].' '.$input['waktu_akhir'])),
			'keterangan' => $input['keterangan']
		);

		$data_lap_damkar = array(
			'id_lapor' => $input['id_lapor'],
			'obyek_terbakar' => $input['obyek_terbakar'],
			'asal_api' => $input['asal_api'],
			'nama_korban' => $input['nama_pemilik'],
			'kerugian' => $input['kerugian'],
			'kronologi' => $input['kronologi'],
			'ket_laporan' => $input['ket_kejadian'],
			'unit' => $input['unit'],
			'regu' => $input['regu'],
			'pos' => $input['pos']
		);

		if ($cek == 0) {
			$input_lap_damkar = $this->MasterData->inputData($data_lap_damkar,'laporan_damkar');

			$where = "id_lapor = '$input[id_lapor]'";
			$update_lapor = $this->MasterData->editData($where,$data_lapor,'lapor');
		}else{
			$where = "id_lapor = '$input[id_lapor]'";
			$update_lap_damkar = $this->MasterData->editData($where,$data_lap_damkar,'laporan_damkar');

			$update_lapor = $this->MasterData->editData($where,$data_lapor,'lapor');
		}

		// echo "<script>history.back(-1)</script>";
		redirect(base_url().'Damkar/historiAduan');
	}

	public function cetakLap($id=''){
		$data['laporan'] = $this->db->query("SELECT 
			lap.*, 
			(SELECT usr.nama FROM users usr WHERE lap.id_user = usr.id_user) AS nama_user, 
			(SELECT usr.no_hp FROM users usr WHERE lap.id_user = usr.id_user) AS no_hp, 
			ld.jenis_kejadian, 
			ld.penyebab_kejadian, 
			ld.nama_korban, 
			ld.alamat_korban, 
			ld.saksi, 
			ld.kerugian, 
			ld.kronologi, 
			ld.tindakan, 
			ld.obyek_terbakar, 
			ld.asal_api, 
			ld.ket_laporan, 
			ld.unit, 
			ld.regu, 
			ld.pos, 
			ld.nama_pelapor, 
			ld.no_hp_pelapor,
			logs.keterangan AS kets
		FROM lapor lap 
		LEFT JOIN laporan_damkar ld ON lap.id_lapor = ld.id_lapor 
		LEFT JOIN log_lapor logs ON lap.id_lapor = logs.id_lapor AND logs.status = 'Selesai'
		WHERE lap.id_lapor = '$id'")->row();

		$data['photo']  = $this->db->query("SELECT foto_kejadian FROM log_lapor WHERE id_lapor = '$id'")->result();
		// var_dump($data);exit();
		
		$this->load->library('pdf');
		$this->load->view('Damkar/cetak_laporan',$data);
	}

	public function cetakLap2($id=''){
		$data['laporan'] = $this->db->query("SELECT 
			*, 
			(SELECT usr.nama FROM users usr WHERE lap.id_user = usr.id_user) AS nama_user, 
			(SELECT usr.no_hp FROM users usr WHERE lap.id_user = usr.id_user) AS no_hp, 
			ld.jenis_kejadian, 
			ld.penyebab_kejadian, 
			ld.nama_korban, 
			ld.alamat_korban, 
			ld.saksi, 
			ld.kerugian, 
			ld.kronologi, 
			ld.tindakan, 
			ld.obyek_terbakar, 
			ld.asal_api, 
			ld.ket_laporan, 
			ld.unit, 
			ld.regu, 
			ld.pos, 
			ld.nama_pelapor, 
			ld.no_hp_pelapor,
			logs.keterangan AS kets
		FROM lapor lap 
		LEFT JOIN laporan_damkar ld ON lap.id_lapor = ld.id_lapor 
		LEFT JOIN log_lapor logs ON lap.id_lapor = logs.id_lapor AND logs.status = 'Selesai'
		WHERE lap.id_lapor = '$id'")->row();

		$data['photo']  = $this->db->query("SELECT foto_kejadian FROM log_lapor WHERE id_lapor = '$id'")->result();
		// var_dump($data);exit();
		
		$this->load->library('pdf');
		$this->load->view('Damkar/cetak_laporan2',$data);
	}

	// User App ====================================================

	public function userApp($sess=''){
		$data['id_nav'] = 4;

		$where = "id_kategori = 1";
		$data['role'] = $this->MasterData->getWhereDataAll('role',$where)->result_array();

		$id_role = $this->input->post('id_role');

		if ($id_role != null && $id_role != '' && !empty($id_role)) {
			$_SESSION['role_user'] = $id_role;
			$selected_role = $id_role;
		} else {
			if (isset($_SESSION['role_user']) && $_SESSION['role_user'] != null && $_SESSION['role_user'] != '') {
				$selected_role = $_SESSION['role_user'];
			} else {
				$selected_role = $data['role'][0]['id_role'];
			}
		}

		$data['selected_role'] = $selected_role;

		$select = array(
			'usr.*',
			'role.*',
			"(SELECT rg.id_wmk FROM regu_damkar rg WHERE rg.id_regu = usr.id_regu) id_wmk",
			"(SELECT wmk.nama_wmk FROM wmk_damkar wmk WHERE wmk.id_wmk = (SELECT rg.id_wmk FROM regu_damkar rg WHERE rg.id_regu = usr.id_regu)) nama_wmk",
			"(SELECT rg.nama_regu FROM regu_damkar rg WHERE rg.id_regu = usr.id_regu) nama_regu",
		);
		$table = array(
			'users usr',
			'role'
		);
		$where = "usr.id_role = role.id_role AND role.id_role = $selected_role";
		$order = 'DESC';
		$by = 'usr.id_user';
		$data['user'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		$data['wmk'] = $this->MasterData->getData('wmk_damkar')->result();

		view('pages/user_app', $data);
	}

	public function simpanUser($value=''){
		$input = html_escape($this->input->POST());
		$pass = md5($input['password']);

		$id_regu = (isset($_POST['regu']) && $_POST['regu'] != null)?$input['regu']:null;
		$jabatan = (isset($_POST['jabatan']) && $_POST['jabatan'] != null)?$input['jabatan']:null;

		$select = "COUNT(*) AS jml";
		$table = 'users';
		$where = "no_hp = '$input[no_hp]'";
		$cek = $this->MasterData->getWhereData($select,$table,$where)->row()->jml;

		if ($cek == 0) {
			$data = array(
				'id_role' => $input['role_user'],
				'id_regu' => $id_regu,
				'password' => $pass,
				'nama' => $input['nama_user'],
				'jenis_kelamin' => $input['jk_user'],
				'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
				'alamat' => $input['almt_user'],
				'no_hp' => $input['no_hp'],
				'username' => $input['username'],
				'jabatan' => $jabatan,
			);
			$input_user = $this->MasterData->inputData($data,'users');

			if ($input_user) {
				$select = 'role';
				$where = "id_role = '$input[role_user]'";
				$namaRole = $this->MasterData->getWhereData($select,'role',$where)->row()->role;

				$noTelp = $input['no_hp'];
				$pesan = "Password SIYAP anda: ".$input['password']."\nAnda terdaftar sebagai ".$namaRole;

		        // $cekID = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
		        // $newID = $cekID->Auto_increment;

		        // $data = array(
		        //     'DestinationNumber' => $noTelp,
		        //     'TextDecoded' => $pesan,
		        //     'ID' => $newID,
		        //     'MultiPart' => 'false',
		        //     'CreatorID' => 'Siyap'
		        // );

		        // $table = 'outbox';
				// $input_msg = $this->MasterData->sendMsg($data,$table);
				$input_msg = kirim_wa($noTelp, $pesan);
		        // $respon = array();

		        if ($input_msg) {
		        	$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Success!!</b> Data user berhasil ditambahkan.
	                              </div>';
					$this->session->set_flashdata($sess);
					redirect(base_url().'Damkar/userApp');
		        }else{
		        	$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Tambah user gagal!!</b> Silahkan coba lagi.
		                              </div>';
					$this->session->set_flashdata($sess);
					redirect(base_url().'Damkar/userApp');
		        }
			}else{
				$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Tambah user gagal!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_flashdata($sess);
				redirect(base_url().'Damkar/userApp');
			}
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Nomor HP sudah terdaftar!!</b> Silahkan ganti nomor HP lain.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/userApp');
		}
	}

	public function updateUser($value=''){
		$input = html_escape($this->input->POST());

		$id_regu = (isset($_POST['regu']) && $_POST['regu'] != null)?$input['regu']:null;
		$jabatan = (isset($_POST['jabatan']) && $_POST['jabatan'] != null)?$input['jabatan']:null;

		$select = "COUNT(*) AS jml";
		$table = 'users';
		$where = "no_hp = '$input[no_hp]'";
		$cekNomor = $this->MasterData->getWhereData($select,$table,$where)->row()->jml;

		if ($input['no_hp'] == $input['no_hp_old']) {
			if ($input['password'] == '' || $input['password'] == null) {
				$data = array(
					'id_role' => $input['role_user'],
					'id_regu' => $id_regu,
					'nama' => $input['nama_user'],
					'jenis_kelamin' => $input['jk_user'],
					'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
					'alamat' => $input['almt_user'],
					'no_hp' => $input['no_hp'],
					'username' => $input['username'],
					'jabatan' => $jabatan,
				);
			}else{
				$data = array(
					'id_role' => $input['role_user'],
					'id_regu' => $id_regu,
					'password' => md5($input['password']),
					'nama' => $input['nama_user'],
					'jenis_kelamin' => $input['jk_user'],
					'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
					'alamat' => $input['almt_user'],
					'no_hp' => $input['no_hp'],
					'username' => $input['username'],
					'jabatan' => $jabatan,
				);
			}
			
			$where = "id_user = '$input[id_user]'";
			$update_user = $this->MasterData->editData($where,$data,'users');

			if ($update_user) {
				$select = 'role';
				$where = "id_role = '$input[role_user]'";
				$namaRole = $this->MasterData->getWhereData($select,'role',$where)->row()->role;

				$noTelp = $input['no_hp'];
				if ($input['password'] != null || $input['password'] != '') {
					$pass  = $input['password'];
				}else{
					$pass  = 'masih sama seperti yang dahulu';
				}
				
				$pesan = "Password SIYAP anda: ".$pass."\nAnda terdaftar sebagai ".$namaRole;

		        // $cekID = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
		        // $newID = $cekID->Auto_increment;

		        // $data = array(
		        //     'DestinationNumber' => $noTelp,
		        //     'TextDecoded' => $pesan,
		        //     'ID' => $newID,
		        //     'MultiPart' => 'false',
		        //     'CreatorID' => 'Siyap'
		        // );

		        // $table = 'outbox';
				// $input_msg = $this->MasterData->sendMsg($data,$table);
				$input_msg = kirim_wa($noTelp, $pesan);
		        // $respon = array();

		         if ($input_msg) {
		         	$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Success!!</b> Data user berhasil diupdate.
		                              </div>';
					$this->session->set_flashdata($sess);
					redirect(base_url().'Damkar/userApp');
		         }else{
		         	$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Update user gagal!!</b> Silahkan coba lagi.
		                              </div>';
					$this->session->set_flashdata($sess);
					redirect(base_url().'Damkar/userApp');
		         }
			}else{
				$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Update user gagal!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_flashdata($sess);
				redirect(base_url().'Damkar/userApp');
			}
		}else{
			if ($cekNomor == 0) {

				if ($input['password'] == '' || $input['password'] == null) {
					$data = array(
						'id_role' => $input['role_user'],
						'id_regu' => $id_regu,
						'nama' => $input['nama_user'],
						'jenis_kelamin' => $input['jk_user'],
						'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
						'alamat' => $input['almt_user'],
						'no_hp' => $input['no_hp'],
						'username' => $input['username'],
						'jabatan' => $jabatan,
					);
				}else{
					$data = array(
						'id_role' => $input['role_user'],
						'id_regu' => $id_regu,
						'password' => md5($input['password']),
						'nama' => $input['nama_user'],
						'jenis_kelamin' => $input['jk_user'],
						'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
						'alamat' => $input['almt_user'],
						'no_hp' => $input['no_hp'],
						'username' => $input['username'],
						'jabatan' => $jabatan,
					);
				}
				
				$where = "id_user = '$input[id_user]'";
				$update_user = $this->MasterData->editData($where,$data,'users');

				if ($update_user) {
					$select = 'role';
					$where = "id_role = '$input[role_user]'";
					$namaRole = $this->MasterData->getWhereData($select,'role',$where)->row()->role;

					$noTelp = $input['no_hp'];
					if ($input['password'] != null || $input['password'] != '') {
						$pass  = $input['password'];
					}else{
						$pass  = 'masih sama seperti yang dahulu';
					}
					
					$pesan = "Password SIYAP anda: ".$pass."\nAnda terdaftar sebagai ".$namaRole;

			        $cekID = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
			        $newID = $cekID->Auto_increment;

			        $data = array(
			            'DestinationNumber' => $noTelp,
			            'TextDecoded' => $pesan,
			            'ID' => $newID,
			            'MultiPart' => 'false',
			            'CreatorID' => 'Siyap'
			        );

			        // $table = 'outbox';
					// $input_msg = $this->MasterData->sendMsg($data,$table);
					$input_msg = kirim_wa($noTelp, $pesan);
			        // $respon = array();

			         if ($input_msg) {
			         	$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
			                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                                <b>Success!!</b> Data user berhasil diupdate.
			                              </div>';
						$this->session->set_flashdata($sess);
						redirect(base_url().'Damkar/userApp');
			         }else{
			         	$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
			                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                                <b>Update user gagal!!</b> Silahkan coba lagi.
			                              </div>';
						$this->session->set_flashdata($sess);
						redirect(base_url().'Damkar/userApp');
			         }
				}else{
					$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Update user gagal!!</b> Silahkan coba lagi.
		                              </div>';
					$this->session->set_flashdata($sess);
					redirect(base_url().'Damkar/userApp');
				}
			}else{
				$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Nomor HP sudah terdaftar!!</b> Silahkan ganti nomor HP lain.
	                              </div>';
				$this->session->set_flashdata($sess);
				redirect(base_url().'Damkar/userApp');
			}
		}
	}

	public function hapusUser($value=''){
		$id_user = $this->input->POST('id_user');

		$where = "id_user = '$id_user'";
		$hapus_user = $this->MasterData->deleteData($where,'users');

		if ($hapus_user) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Success!!</b> Data user berhasil dihapus.
	                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Success';
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Hapus user gagal!!</b> Silahkan coba lagi.
		                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Gagal';
		}
	}

	public function getDataRegu() {
		if ($this->input->POST()) {
            $id_wmk = $this->input->POST('id_wmk');
            $where = "id_wmk = '$id_wmk'";
            $data = $this->MasterData->getDataWhere('regu_damkar', $where)->result();
            if ($data) {
                $result = array(
                    'response' => true,
                    'data' => $data
                );
            } else {
                $result = array(
                    'response' => false
                );
            }
        } else {
            $result = array(
                'response' => false
            );
        }
        echo json_encode($result);
	}

	// Nomor Telepon SKPD ==========================================
	public function nomorTelp($sess=''){
		$data['id_nav'] = 5;

		if ($sess == '') {
			$this->session->unset_userdata('alert_nomor');
		}

		$data['nomor'] = $this->MasterData->getDataDesc('nomor_telpon', 'id_no_telp')->result();

		view('pages/nomor_telpon', $data);
	}

	public function simpanNomor($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'nama_no_telp' => $input['kontak'],
			'no_telp' => $input['nomor']
		);
		$input_nomor = $this->MasterData->inputData($data,'nomor_telpon');

		if ($input_nomor) {
			$sess['alert_nomor'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data nomor telepon berhasil ditambahkan.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/nomorTelp/true');
		}else{
			$sess['alert_nomor'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah nomor telepon gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/nomorTelp/true');
		}
	}

	public function updateNomor($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'nama_no_telp' => $input['kontak'],
			'no_telp' => $input['nomor']
		);
		$where = "id_no_telp = '$input[id_no_telp]'";
		$update_nomor = $this->MasterData->editData($where,$data,'nomor_telpon');

		if ($update_nomor) {
			$sess['alert_nomor'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data nomor telepon berhasil diupdate.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/nomorTelp/true');
		}else{
			$sess['alert_nomor'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update nomor telepon gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/nomorTelp/true');
		}
	}

	public function hapusNomor($value=''){
		$id_no_telp = $this->input->POST('id_no_telp');

		$where = "id_no_telp = '$id_no_telp'";
		$hapus_nomor = $this->MasterData->deleteData($where,'nomor_telpon');

		if ($hapus_nomor) {
			echo 'Success';
		}else{
			echo 'Gagal';
		}
	}

	// ========================================================

	// Pesan ==========================================
	public function pesan($sess=''){
		$data['id_nav'] = 6;

		if ($sess == '') {
			$this->session->unset_userdata('alert_pesan');
		}

		$data['nomor'] =$this->MasterData->getData('nomor_telpon')->result();

		$select = '*';
		$table = array(
			'kategori ktg',
			'nomor_telpon nom',
			'pesan'
		);
		$where = "ktg.id_kategori = pesan.id_kategori AND nom.id_no_telp = pesan.id_no_telp AND ktg.nama_kategori like '%Damkar%'";
		$order = 'DESC';
		$by = 'pesan.id_pesan';
		$data['pesan'] =$this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		view('pages/pesan', $data);
	}

	public function kirimPesan($value=''){
		$input = html_escape($this->input->POST());
		$id_kategori = $this->session->userdata('id_kategori');

		$select = 'no_telp';
		$where = "id_no_telp = '$input[nomor]'";
		$noTelp = $this->MasterData->getWhereData($select,'nomor_telpon',$where)->row()->no_telp;

		$select = 'skpd';
		$where = "id_kategori = '$id_kategori'";
		$skpd = $this->MasterData->getWhereData($select,'kategori',$where)->row()->skpd;

		$pesan = "Pengirim : $skpd\n\n\n$input[pesan]\n\n(Dikirim melalui aplikasi SIYAP)";

        // $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
        // $newID = $cek->Auto_increment;

        // menghitung jumlah pecahan
        // $jmlSMS = ceil(strlen($pesan)/153);

        // memecah pesan asli
        // $pecah  = str_split($pesan, 153);

        // proses penyimpanan ke tabel mysql untuk setiap pecahan
        // $counts = 0;
        // for ($i=1; $i<=$jmlSMS; $i++){
        //    // membuat UDH untuk setiap pecahan, sesuai urutannya
        //    $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);

        //    // membaca text setiap pecahan
        //    $msg = $pecah[$i-1];

        //    if ($i == 1){
	    //          // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
        //    		$data = array(
		//             'DestinationNumber' => $noTelp,
		//             'UDH' => $udh,
		//             'TextDecoded' => $msg,
		//             'ID' => $newID,
		//             'MultiPart' => 'true',
		//             'CreatorID' => 'Siyap'
		//         );

		//         // $table = 'outbox';
		// 		// $input_msg = $this->MasterData->sendMsg($data,$table);
		// 		$input_msg = kirim_wa($noTelp, $pesan);

        //    }else{
        //       	// jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
        //     	$data = array(
		//             'UDH' => $udh,
		//             'TextDecoded' => $msg,
		//             'ID' => $newID,
		//             'SequencePosition' => $i
		//         );

		//         $table = 'outbox_multipart';
		// 		// $input_msg = $this->MasterData->sendMsg($data,$table);
		// 		$input_msg = kirim_wa($noTelp, $pesan);
        //    }

        //    	if ($input_msg) {
	    //      	$counts++;
	    //     }          
        // }

        // $data = array(
        //     'DestinationNumber' => $noTelp,
        //     'TextDecoded' => $pesan,
        //     'ID' => $newID,
        //     'MultiPart' => 'false',
        //     'CreatorID' => 'Siyap'
        // );

        // $table = 'outbox';
		// $input_msg = $this->MasterData->sendMsg($data,$table);
		$input_msg = kirim_wa($noTelp, $pesan);
        // $respon = array();

        if ($input_msg) {
            $data = array(
				'id_no_telp' => $input['nomor'],
				'id_kategori' => $id_kategori,
				'pesan' => $input['pesan'],
				'tgl_pesan' => date('Y-m-d H:i:s')
			);
			$input_pesan = $this->MasterData->inputData($data,'pesan');

			if ($input_pesan) {
				$sess['alert_pesan'] = '<div class="alert alert-success alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Success!!</b> Pesan telah berhasil dikirim.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Damkar/pesan/true');
			}else{
				$sess['alert_pesan'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Pesan gagal dikirim!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Damkar/pesan/true');
			}
        }else{
            $sess['alert_pesan'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Pesan gagal dikirim!!</b> Silahkan coba lagi.
	                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/pesan/true');
        }
	}

	public function showEditPesan($value=''){
		$id_pesan = $this->input->POST('id_pesan');

		$select = 'pesan';
		$where = "id_pesan = $id_pesan";
		$data_pesan = $this->MasterData->getWhereData($select,'pesan',$where)->row();

		echo json_encode($data_pesan);
	}

	public function updatePesan($value=''){
		$input = html_escape($this->input->POST());
		$id_kategori = $this->session->userdata('id_kategori');

		$select = 'no_telp';
		$where = "id_no_telp = '$input[nomor]'";
		$noTelp = $this->MasterData->getWhereData($select,'nomor_telpon',$where)->row()->no_telp;

		$select = 'skpd';
		$where = "id_kategori = '$id_kategori'";
		$skpd = $this->MasterData->getWhereData($select,'kategori',$where)->row()->skpd;

		$pesan = "Pengirim : $skpd\n\n\n$input[pesan]\n\n(Dikirim melalui aplikasi SIYAP)";

        // $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
        // $newID = $cek->Auto_increment;

        // menghitung jumlah pecahan
        // $jmlSMS = ceil(strlen($pesan)/153);

        // memecah pesan asli
        // $pecah  = str_split($pesan, 153);

        // proses penyimpanan ke tabel mysql untuk setiap pecahan
        // $counts = 0;
        // for ($i=1; $i<=$jmlSMS; $i++){
        //    // membuat UDH untuk setiap pecahan, sesuai urutannya
        //    $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);

        //    // membaca text setiap pecahan
        //    $msg = $pecah[$i-1];

        //    if ($i == 1){
	    //          // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
        //    		$data = array(
		//             'DestinationNumber' => $noTelp,
		//             'UDH' => $udh,
		//             'TextDecoded' => $msg,
		//             'ID' => $newID,
		//             'MultiPart' => 'true',
		//             'CreatorID' => 'Siyap'
		//         );

		//         // $table = 'outbox';
		// 		// $input_msg = $this->MasterData->sendMsg($data,$table);
		// 		$input_msg = kirim_wa($noTelp, $pesan);

        //    }else{
        //       	// jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
        //     	$data = array(
		//             'UDH' => $udh,
		//             'TextDecoded' => $msg,
		//             'ID' => $newID,
		//             'SequencePosition' => $i
		//         );

		//         $table = 'outbox_multipart';
		// 		// $input_msg = $this->MasterData->sendMsg($data,$table);
		// 		$input_msg = kirim_wa($noTelp, $pesan);
        //    }

        //    	if ($input_msg) {
	    //      	$counts++;
	    //     }          
        // }


        // $data = array(
        //     'DestinationNumber' => $noTelp,
        //     'TextDecoded' => $pesan,
        //     'ID' => $newID,
        //     'MultiPart' => 'false',
        //     'CreatorID' => 'Siyap'
        // );

        // $table = 'outbox';
		// $input_msg = $this->MasterData->sendMsg($data,$table);
		$input_msg = kirim_wa($noTelp, $pesan);
        // $respon = array();

        if ($input_msg) {
        	$data = array(
				'id_no_telp' => $input['nomor'],
				'id_kategori' => $id_kategori,
				'pesan' => $input['pesan'],
				'tgl_pesan' => date('Y-m-d H:i:s')
			);
			$where = "id_pesan = '$input[id_pesan]'";
			$update_pesan = $this->MasterData->editData($where,$data,'pesan');

			if ($update_pesan) {
				$sess['alert_pesan'] = '<div class="alert alert-success alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Success!!</b> Pesan telah berhasil dikirim.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Damkar/pesan/true');
			}else{
				$sess['alert_pesan'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Pesan gagal dikirim!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Damkar/pesan/true');
			}
        }else{
        	$sess['alert_pesan'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Pesan gagal dikirim!!</b> Silahkan coba lagi.
	                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/pesan/true');
        }
	}

	public function hapusPesan($value=''){
		$id_pesan = $this->input->POST('id_pesan');

		$where = "id_pesan = '$id_pesan'";
		$hapus_pesan = $this->MasterData->deleteData($where,'pesan');

		if ($hapus_pesan) {
			echo 'Success';
		}else{
			echo 'Gagal';
		}
	}

	// ========================================================

	// Jenis Kejadian =========================================
	public function jenisKejadian($sess=''){
		$data['id_nav'] = 7;

		if ($sess == '') {
			$this->session->unset_userdata('alert_kejadian');
		}

		$select = '*';
		$table = array(
			'kategori ktg',
			'jenis_laporan jl'
		);
		$where = "ktg.id_kategori = jl.id_kategori AND ktg.nama_kategori like '%Damkar%'";
		$by = 'jl.id_jenis_lap';
		$order = 'DESC';
		$data['kejadian'] =$this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		view('pages/jenis_kejadian', $data);
	}

	public function simpanKejadian($value=''){
		$input = html_escape($this->input->POST());
		$id_kategori = $this->session->userdata('id_kategori');

		$data = array(
			'id_kategori' 		=> $id_kategori,
			'nama_jenis_lap' 	=> $input['nama_jenis_lap'],
			'grup_jenis' 		=> $input['grup_jenis'],
		);
		$input_jenis = $this->MasterData->inputData($data,'jenis_laporan');

		if ($input_jenis) {
			$sess['alert_kejadian'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data jenis kejadian berhasil ditambahkan.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/jenisKejadian/true');
		}else{
			$sess['alert_kejadian'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah jenis kejadian gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/jenisKejadian/true');
		}
	}

	public function updateKejadian($value=''){
		$input = html_escape($this->input->POST());
		$id_kategori = $this->session->userdata('id_kategori');

		$data = array(
			'id_kategori' 		=> $id_kategori,
			'nama_jenis_lap' 	=> $input['nama_jenis_lap'],
			'grup_jenis' 		=> $input['grup_jenis'],
		);
		$where = "id_jenis_lap = '$input[id_jenis_lap]'";
		$update_kejadian = $this->MasterData->editData($where,$data,'jenis_laporan');

		if ($update_kejadian) {
			$sess['alert_kejadian'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data jenis kejadian berhasil diupdate.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/jenisKejadian/true');
		}else{
			$sess['alert_kejadian'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update jenis kejadian gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/jenisKejadian/true');
		}
	}

	public function hapusKejadian($value=''){
		$id_jenis_lap = $this->input->POST('id_jenis_lap');

		$where = "id_jenis_lap = '$id_jenis_lap'";
		$hapus_jenis = $this->MasterData->deleteData($where,'jenis_laporan');

		if ($hapus_jenis) {
			echo 'Success';
		}else{
			echo 'Gagal';
		}
	}

	// ========================================================

	// Awal notifikasi masuk ==================================
	public function awalNotif($sess=''){
		$data['id_nav'] = 8;

		if ($sess == '') {
			$this->session->unset_userdata('alert_notif');
		}

		$select = '*';
		$table = array(
			'notif_admin not',
			'kategori ktg'
		);
		$where = "ktg.id_kategori = not.id_kategori AND ktg.nama_kategori like '%Damkar%'";
		$data['notif'] =$this->MasterData->getWhereData($select,$table,$where)->row();

		view('pages/awal_notif', $data);
	}

	public function simpanAwalNotif($value=''){
		$input = html_escape($this->input->POST());
		$id_kategori = $this->session->userdata('id_kategori');

		$where = "id_kategori = '$id_kategori'";
		$cek = $this->MasterData->getWhereData('*','notif_admin',$where)->num_rows();

		$data = array(
			'id_kategori' => $id_kategori,
			'notif_admin' => $input['notif']
		);

		if ($cek == 0) {
			$input_notif = $this->MasterData->inputData($data,'notif_admin');
		}else{
			$input_notif = $this->MasterData->editData($where,$data,'notif_admin');
		}

		if ($input_notif) {
			$sess['alert_notif'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data notif awal berhasil disimpan.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/awalNotif/true');
		}else{
			$sess['alert_notif'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Simpan notif awal gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/awalNotif/true');
		}
	}
	// ========================================================

	// Nomor Darurat ==========================================
	public function nomorDarurat($sess=''){
		$data['id_nav'] = 9;

		if ($sess == '') {
			$this->session->unset_userdata('alert_nom_dar');
		}

		$data['kategori'] =$this->MasterData->getData('kategori')->result();

		$select = '*';
		$table = array(
			'nomor_darurat nom',
			'kategori ktg'
		);
		$where = "nom.id_kategori = ktg.id_kategori AND ktg.id_kategori = '$this->id_kategori'";
		$by = 'id_nomor_darurat';
		$order = 'DESC';
		$data['nomor'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		$this->load->view('Damkar/header');
		$this->load->view('Damkar/navigation', $data);
		$this->load->view('Damkar/nomor_darurat', $data);
		$this->load->view('Damkar/footer');
	}

	public function simpanNomorDarurat($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'id_kategori' => $this->id_kategori,
			'nomor' => $input['nomor'],
			'alamat' => $input['alamat']
		);
		$input_nomor = $this->MasterData->inputData($data,'nomor_darurat');

		if ($input_nomor) {
			$sess['alert_nom_dar'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data nomor darurat berhasil ditambahkan.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/nomorDarurat/true');
		}else{
			$sess['alert_nom_dar'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah nomor darurat gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/nomorDarurat/true');
		}
	}

	public function updateNomorDarurat($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'id_kategori' => $this->id_kategori,
			'nomor' => $input['nomor'],
			'alamat' => $input['alamat']
		);
		$where = "id_nomor_darurat = '$input[id_nomor_darurat]'";
		$update_nomor = $this->MasterData->editData($where,$data,'nomor_darurat');

		if ($update_nomor) {
			$sess['alert_nom_dar'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data nomor darurat berhasil diupdate.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/nomorDarurat/true');
		}else{
			$sess['alert_nom_dar'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update nomor darurat gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/nomorDarurat/true');
		}
	}

	public function hapusNomorDarurat($value=''){
		$id_nomor_darurat = $this->input->POST('id_nomor_darurat');

		$where = "id_nomor_darurat = '$id_nomor_darurat'";
		$hapus_nomor = $this->MasterData->deleteData($where,'nomor_darurat');

		if ($hapus_nomor) {
			echo 'Success';
		}else{
			echo 'Gagal';
		}
	}

	// ========================================================

	//KEPALA DAMKAR ===========================================
	public function kepalaDamkar($sess=''){
		$data['id_nav'] = 14;

		$select = '*';
		$table = 'user_kepala';
		$where = "id_kepala = 1";
		$by = 'id_kepala';
		$order = 'DESC';
		$data['kepala'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		
		view('pages/kepala_damkar', $data);
	}

	public function simpanKepalaDamkar($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'nama_kepala'		=> $input['nama'],
			'jabatan_kepala'	=> $input['jabatan'],
			'nip_kepala' 		=> $input['nip'],
		);
		$input = $this->MasterData->inputData($data,'user_kepala');

		if ($input) {
			$sess['show_alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Success!!</b> Data kepala damkar berhasil disimpan.
									</div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/kepalaDamkar');
		}else{
			$sess['show_alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Tambah kepala damkar gagal!!</b> Silahkan coba lagi.
									</div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/kepalaDamkar');
		}
	}

	public function updateKepalaDamkar($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'nama_kepala'		=> $input['nama'],
			'jabatan_kepala'	=> $input['jabatan'],
			'pangkat_kepala'	=> $input['pangkat'],
			'nip_kepala' 		=> $input['nip'],
		);
		$where = "id_kepala = '$input[id_kepala]'";
		$update = $this->MasterData->editData($where,$data,'user_kepala');

		if ($update) {
			$sess['show_alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Success!!</b> Data kepala damkar berhasil disimpan.
									</div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/kepalaDamkar');
		}else{
			$sess['show_alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Update kepala damkar gagal!!</b> Silahkan coba lagi.
									</div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/kepalaDamkar');
		}
	}

	public function hapusKepalaDamkar($value=''){
		$id_kepala = $this->input->POST('id_kepala');

		$where = "id_kepala = '$id_kepala'";
		$hapus = $this->MasterData->deleteData($where,'user_kepala');

		if ($hapus) {
			$sess['show_alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Success!!</b> Data kepala damkar berhasil dihapus.
									</div>';
			$this->session->set_flashdata($sess);
			echo 'Success';
		}else{
			$sess['show_alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Hapus kepala damkar gagal!!</b> Silahkan coba lagi.
									</div>';
			$this->session->set_flashdata($sess);
			echo 'Gagal';
		}
	}
 
	// ========================================================

	//KEPALA DAMKAR ===========================================
	public function piketDamkar($sess=''){
		$data['id_nav'] = 15;

		$data['piket'] = $this->db->query("SELECT 
				pd.id_piket,
				pd.id_user,
				pd.tgl_piket,
				pd.id_mobil,
				usr.nama AS ketua_regu,
				wd.nama_wmk,
				md.nama_mobil,
				md.no_plat_mobil,
				md.id_wmk,
				bad.id_berita_acara,
				bad.jml_kebakaran,
				bad.jml_bencana_lain,
				bad.jml_ambil_sarang_tawon,
				bad.jml_ambil_ular_lain,
				bad.kondisi_mobil,
				bad.kondisi_peralatan_lain,
				GROUP_CONCAT(cm.id_mobil_item SEPARATOR ';') as id_mobil_item,
				-- GROUP_CONCAT(cm.cek SEPARATOR ';') as cek_mobil_item,
				-- GROUP_CONCAT(IF((cm.keterangan_cek='' OR cm.keterangan_cek IS NULL), '-', cm.keterangan_cek) SEPARATOR ';') as keterangan_cek,
				-- GROUP_CONCAT(id.nama_item SEPARATOR ';') as nama_item,
				-- GROUP_CONCAT(id.satuan_item SEPARATOR ';') as satuan_item,
				-- GROUP_CONCAT(mid.jml_item SEPARATOR ';') as jml_item,
				IF((SELECT COUNT(pk.id_piket) FROM piket_damkar pk WHERE pk.lanjutan = pd.id_piket) > 0, true, false) as lanjutan,
				IFNULL((SELECT pk.id_user FROM piket_damkar pk WHERE pk.lanjutan = pd.id_piket), '') as user_lanjutan
			FROM piket_damkar pd 
			LEFT JOIN users usr ON pd.id_user = usr.id_user
			LEFT JOIN berita_acara_damkar bad ON pd.id_piket = bad.id_piket
			LEFT JOIN cek_mobil_item_damkar cm ON pd.id_piket = cm.id_piket
			LEFT JOIN mobil_damkar md ON pd.id_mobil = md.id_mobil
			LEFT JOIN wmk_damkar wd ON md.id_wmk = wd.id_wmk
			LEFT JOIN mobil_item_damkar mid ON cm.id_mobil_item = mid.id_mobil_item
			LEFT JOIN item_damkar id ON mid.id_item = id.id_item
			GROUP BY pd.id_piket
			ORDER BY pd.id_piket DESC
		")->result();

		$data['user'] = $this->db->query("SELECT 
			us.*,
			IFNULL((SELECT rd.nama_regu FROM regu_damkar rd WHERE rd.id_regu = us.id_regu), '') regu,
			IFNULL((SELECT wd.nama_wmk FROM wmk_damkar wd WHERE wd.id_wmk = (SELECT rd.id_wmk FROM regu_damkar rd WHERE rd.id_regu = us.id_regu)), '') wmk,
			IFNULL((SELECT rd.id_wmk FROM regu_damkar rd WHERE rd.id_regu = us.id_regu), '') id_wmk
		FROM users us
		WHERE us.id_role = 2 AND us.jabatan LIKE '%ketua%'")->result();

		$data['mobil'] = $this->db->SELECT(array('md.*', "(SELECT wmk.nama_wmk FROM wmk_damkar wmk WHERE wmk.id_wmk = md.id_wmk) as nama_wmk"))->order_by('id_wmk','ASC')->order_by('nama_mobil','ASC')->GET('mobil_damkar md')->result();

		// echo json_encode($data['mobil']);exit();
		
		view('pages/piket_damkar', $data);
	}

	public function simpanPiketDamkar($value=''){
		$post = html_escape($this->input->POST());

		$data = array(
			// 'lanjutan'		=> $post['id'],
			'id_user'		=> $post['user'],
			'tgl_piket' 	=> date('Y-m-d H:i:s', strtotime($post['tgl_piket'])),
			'id_mobil' 		=> $post['mobil'],
		);
		$input = $this->MasterData->inputData($data,'piket_damkar');

		if ($input) {
			$sess['show_alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Success!!</b> Data piket damkar berhasil disimpan.
									</div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/piketDamkar');
		}else{
			$sess['show_alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Tambah data pikat gagal!!</b> Silahkan coba lagi.
									</div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/piketDamkar');
		}
	}

	public function updatePiketDamkar($value=''){
		$post = html_escape($this->input->POST());

		$data = array(
			'id_user'		=> $post['user'],
			'tgl_piket' 	=> date('Y-m-d H:i:s', strtotime($post['tgl_piket'])),
			'id_mobil' 		=> $post['mobil'],
		);
		$where = "id_piket = '$post[id]'";
		$update = $this->MasterData->editData($where,$data,'piket_damkar');

		if ($update) {
			$sess['show_alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Success!!</b> Data piket damkar berhasil disimpan.
									</div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/piketDamkar');
		}else{
			$sess['show_alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Update data piket gagal!!</b> Silahkan coba lagi.
									</div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/piketDamkar');
		}
	}

	public function hapusPiketDamkar($value=''){
		$id_piket = $this->input->POST('id');

		$where = "id_piket = '$id_piket'";
		$hapus = $this->MasterData->deleteData($where,'piket_damkar');

		if ($hapus) {
			$sess['show_alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Success!!</b> Data berhasil dihapus.
									</div>';
			$this->session->set_flashdata($sess);
			echo 'Success';
		}else{
			$sess['show_alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<b>Hapus data gagal!!</b> Silahkan coba lagi.
									</div>';
			$this->session->set_flashdata($sess);
			echo 'Gagal';
		}
	}

	public function simpanLanjutan($value=''){
		$post = html_escape($this->input->POST());

		if ($post) {
			$data = array(
				'lanjutan'		=> $post['id'],
				'id_user'		=> $post['user'],
				'tgl_piket' 	=> date('Y-m-d H:i:s', strtotime($post['tgl_piket'])),
				'id_mobil' 		=> $post['mobil'],
			);
			if ($post['lanjutan']) {
				$where = "lanjutan = ".$post['id'];
				$input = $this->MasterData->editData($where, $data, 'piket_damkar');
			} else {
				$input = $this->MasterData->inputData($data, 'piket_damkar');
			}
	
			if ($input) {
				$cetak = $this->cetakWord($post['id']);

				$sess['show_alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<b>Success!!</b> Data piket berhasil disimpan.
										</div>';
				$this->session->set_flashdata($sess);

				if ($cetak) {
					echo $cetak;
					redirect(base_url().'Damkar/piketDamkar');
				}
			} else {
				$sess['show_alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<b>Tambah piket gagal!!</b> Silahkan coba lagi.
										</div>';
				$this->session->set_flashdata($sess);
				redirect(base_url().'Damkar/piketDamkar');
			}
		}
	}

	function cetakWord($id_piket = 0) {
		$this->load->helper('tanggal');

		$piket1 = $this->db->query("SELECT 
				pd.id_piket,
				pd.tgl_piket,
				usr.nama AS ketua_regu,
				rd.nama_regu,
				wd.nama_wmk,
				md.nama_mobil,
				md.no_plat_mobil,
				bad.jml_kebakaran,
				bad.jml_bencana_lain,
				bad.jml_ambil_sarang_tawon,
				bad.jml_ambil_ular_lain,
				bad.kondisi_mobil,
				bad.kondisi_peralatan_lain
			FROM piket_damkar pd 
			LEFT JOIN users usr ON pd.id_user = usr.id_user
			LEFT JOIN berita_acara_damkar bad ON pd.id_piket = bad.id_piket
			LEFT JOIN mobil_damkar md ON pd.id_mobil = md.id_mobil
			LEFT JOIN wmk_damkar wd ON md.id_wmk = wd.id_wmk
			LEFT JOIN regu_damkar rd ON usr.id_regu = rd.id_regu
			WHERE pd.id_piket = $id_piket
		")->row_array();

		$piket2 = $this->db->query("SELECT 
				pd.id_piket,
				pd.tgl_piket,
				usr.nama AS ketua_regu,
				rd.nama_regu
			FROM piket_damkar pd 
			LEFT JOIN users usr ON pd.id_user = usr.id_user
			LEFT JOIN berita_acara_damkar bad ON pd.id_piket = bad.id_piket
			LEFT JOIN regu_damkar rd ON usr.id_regu = rd.id_regu
			WHERE pd.lanjutan = $id_piket
		")->row_array();

		$kepala = $this->MasterData->getData('user_kepala')->row_array();

		$item = $this->db->query("SELECT
				id.nama_item,
				id.satuan_item,
				mid.jml_item,
				cm.cek,
				IF((cm.keterangan_cek='' OR cm.keterangan_cek IS NULL), '-', cm.keterangan_cek) as ket_item
			FROM cek_mobil_item_damkar cm 
			LEFT JOIN mobil_item_damkar mid ON cm.id_mobil_item = mid.id_mobil_item
			LEFT JOIN item_damkar id ON mid.id_item = id.id_item
			WHERE cm.id_piket = $id_piket
		")->result_array();

		$count_row = 0;
		if (count($item) <= 35) {
			$nama_file = "BERITA_ACARA_1";
			$count_row = 35;
		} else {
			$nama_file = "BERITA_ACARA_2";
			$count_row = 70;
		}

		$array_hari	 = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
		'September','Oktober', 'November','Desember');
		$hari_terima = $array_hari[date('N', strtotime($piket2['tgl_piket']))];
		$tgl_terima  = date('d', strtotime($piket2['tgl_piket']));
		$bln_terima  = $array_bulan[date('n', strtotime($piket2['tgl_piket']))];
		$thn_terima  = date('Y', strtotime($piket2['tgl_piket']));

		$lokasi_wmk  = 'Kota Mungkid';
		$wmk = str_replace('POS ', '', $piket1['nama_wmk']);
		if ($wmk != 'Induk') {
			$lokasi_wmk = $wmk;
		}

		$document = file_get_contents(FCPATH . 'assets/document/' . $nama_file . ".rtf");

		$document = str_replace("#LOKASI_WMK", $lokasi_wmk, $document);
		$document = str_replace("#WMK", $piket1['nama_wmk'], $document);
		$document = str_replace("#NAMA_MOBIL", $piket1['nama_mobil'], $document);
		$document = str_replace("#PLAT_MOBIL", $piket1['no_plat_mobil'], $document);
		$document = str_replace("#PIHAK1", $piket1['ketua_regu'], $document);
		$document = str_replace("#PIHAK2", $piket2['ketua_regu'], $document);
		$document = str_replace("#REGU1", $piket1['nama_regu'], $document);
		$document = str_replace("#REGU2", $piket2['nama_regu'], $document);
		$document = str_replace("#HARI_TERIMA", $hari_terima, $document);
		$document = str_replace("#TGL_TERIMA", $tgl_terima, $document);
		$document = str_replace("#BLN_TERIMA", $bln_terima, $document);
		$document = str_replace("#THN_TERIMA", $thn_terima, $document);
		$document = str_replace("#TGL_PIKET", formatTanggalTtd($piket1['tgl_piket']), $document);
		$document = str_replace("#TGL_CETAK", formatTanggalTtd($piket2['tgl_piket']), $document);
		$document = str_replace("#JML_BAKAR", $piket1['jml_kebakaran'], $document);
		$document = str_replace("#JML_BENCANA", $piket1['jml_bencana_lain'], $document);
		$document = str_replace("#JML_TAWON", $piket1['jml_ambil_sarang_tawon'], $document);
		$document = str_replace("#JML_ULAR", $piket1['jml_ambil_ular_lain'], $document);
		$document = str_replace("#KONDISI_MOBIL", $piket1['kondisi_mobil'], $document);
		$document = str_replace("#KONDISI_ALAT", $piket1['kondisi_peralatan_lain'], $document);
		$document = str_replace("#NAMA_KEPALA", $kepala['nama_kepala'], $document);
		$document = str_replace("#JABATAN", $kepala['jabatan_kepala'], $document);
		$document = str_replace("#PANGKAT", $kepala['pangkat_kepala'], $document);
		$document = str_replace("#NIP_KEPALA", $kepala['nip_kepala'], $document);

		// echo json_encode($item);exit();

		for ($i=0; $i < $count_row; $i++) { 
			$x = $i+1;
			$document = str_replace("[NAMA_ITEM".$x."]", (isset($item[$i])?$item[$i]['nama_item']:''), $document);
			$document = str_replace("[JML_ITEM".$x."]", (isset($item[$i])?$item[$i]['jml_item'].' '.$item[$i]['satuan_item']:''), $document);

			if (isset($item[$i])) {
				if ($item[$i]['cek'] == 1) {
					$document = str_replace("[ADA".$x."]", 'V', $document);
					$document = str_replace("[TIDAK".$x."]", '', $document);
				} else {
					$document = str_replace("[ADA".$x."]", '', $document);
					$document = str_replace("[TIDAK".$x."]", 'V', $document);
				}
			} else {
				$document = str_replace("[ADA".$x."]", '', $document);
				$document = str_replace("[TIDAK".$x."]", '', $document);
			}
			
			$document = str_replace("[KET_ITEM".$x."]", (isset($item[$i])?$item[$i]['ket_item']:''), $document);
		}

        header("Content-type: application/msword");
        header("Content-disposition: inline; filename=Serah Terima Piket Regu ".$piket1['nama_regu']." ".$piket1['nama_wmk']." (" .date('d-m-Y', strtotime($piket1['tgl_piket'])). ").doc");
        header("Content-length: " . strlen($document));
        // echo $document;
		return $document;
	}
 
	// ========================================================

	//WMK =====================================================
	public function dataWmk($sess=''){
		$data['id_nav'] = 9;

		// if ($sess == '') {
		// 	$this->session->unset_userdata('alert_wmk');
		// }

		$select = '*';
		$table = 'wmk_damkar';
		$where = "status = 1";
		$by = 'id_wmk';
		$order = 'DESC';
		$data['wmk'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		
		view('pages/data_wmk', $data);
	}

	public function simpanWmk($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'nama_wmk'   => $input['nama'],
			'nomor_wmk'  => $input['nomor'],
			'alamat_wmk' => $input['alamat'],
			'status'	 => 1,
		);
		$input = $this->MasterData->inputData($data,'wmk_damkar');

		if ($input) {
			$sess['alert_wmk'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data WMK berhasil ditambahkan.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/dataWmk');
		}else{
			$sess['alert_wmk'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah WMK gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/dataWmk');
		}
	}

	public function updateWmk($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'nama_wmk'   => $input['nama'],
			'nomor_wmk'  => $input['nomor'],
			'alamat_wmk' => $input['alamat'],
			'status'	 => 1,
		);
		$where = "id_wmk = '$input[id_wmk]'";
		$update = $this->MasterData->editData($where,$data,'wmk_damkar');

		if ($update) {
			$sess['alert_wmk'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data WMK berhasil diupdate.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/dataWmk');
		}else{
			$sess['alert_wmk'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update WMK gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/dataWmk');
		}
	}

	public function hapusWmk($value=''){
		$id_wmk = $this->input->POST('id_wmk');

		$where = "id_wmk = '$id_wmk'";
		$hapus = $this->MasterData->deleteData($where,'wmk_damkar');

		if ($hapus) {
			$sess['alert_wmk'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data WMK berhasil dihapus.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Success';
		}else{
			$sess['alert_wmk'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Hapus WMK gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Gagal';
		}
	}
 
	// ========================================================

	//Mobil Damkar ============================================
	public function reguDamkar(){
		$data['id_nav'] = 13;

		$select = array(
			'rd.*',
			"(SELECT wd.nama_wmk FROM wmk_damkar wd WHERE wd.id_wmk = rd.id_wmk) nama_wmk",
			"(SELECT COUNT(usr.id_user) FROM users usr WHERE usr.id_regu = rd.id_regu GROUP BY usr.id_regu) jml_anggota",
		);
		$table = 'regu_damkar rd';
		$where = "rd.id_regu > 0";
		$by = 'rd.id_regu';
		$order = 'DESC';
		$data['regu'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		$data['wmk'] = $this->MasterData->getData('wmk_damkar')->result();

		view('pages/regu_damkar', $data);
	}

	public function simpanReguDamkar($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'id_wmk'   		=> $input['wmk'],
			'nama_regu'  	=> $input['nama'],
		);

		$input = $this->MasterData->inputData($data,'regu_damkar');

		if ($input) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Regu berhasil ditambahkan.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/reguDamkar');
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah Regu gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/reguDamkar');
		}
	}

	public function updateReguDamkar($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'id_wmk'   		=> $input['wmk'],
			'nama_regu'  	=> $input['nama'],
		);
		$where = "id_regu = '$input[id_regu]'";
		$update = $this->MasterData->editData($where,$data,'regu_damkar');

		if ($update) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Regu berhasil diupdate.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/reguDamkar');
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update Regu gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/reguDamkar');
		}
	}

	public function hapusReguDamkar($value=''){
		$id_regu = $this->input->POST('id_regu');

		$where = "id_regu = '$id_regu'";
		$hapus = $this->MasterData->deleteData($where,'regu_damkar');

		if ($hapus) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Regu berhasil dihapus.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Success';
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Hapus Regu gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Gagal';
		}
	}
 
	// ========================================================

	// Anggota Damkar =========================================

	public function anggotaRegu($id=''){
		$data['id_nav'] = 13;

		$id_regu = decode($id);

		$select = array(
			'rd.*',
			"(SELECT wd.nama_wmk FROM wmk_damkar wd WHERE wd.id_wmk = rd.id_wmk) nama_wmk",
		);
		$table = 'regu_damkar rd';
		$where = "rd.id_regu = $id_regu";
		$data['regu'] = $this->MasterData->getWhereData($select,$table,$where)->row();

		$select = array(
			'usr.*',
		);
		$table = 'users usr';
		$where = "id_regu = $id_regu";
		$by = 'id_user';
		$order = 'DESC';
		$data['anggota'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		$select = array(
			'us.*',
			"IFNULL((SELECT rd.nama_regu FROM regu_damkar rd WHERE rd.id_regu = us.id_regu), '') regu",
			"IFNULL((SELECT wd.nama_wmk FROM wmk_damkar wd WHERE wd.id_wmk = (SELECT rd.id_wmk FROM regu_damkar rd WHERE rd.id_regu = us.id_regu)), '') wmk",
		);
		$table = "users us";
		$where = "us.id_role = 2";
		$data['user'] = $this->MasterData->getWhereData($select ,$table,$where)->result();

		$data['id_regu'] = $id_regu;

		view('pages/anggota_regu', $data);
	}

	public function simpanAnggotaRegu($id=''){
		$input = html_escape($this->input->POST());

		$id_regu = decode($id);
		$id_user = $input['user'];

		$data = array(
			'id_regu' => $id_regu,
			'jabatan' => $input['jabatan'],
		);
		$where = "id_user = $id_user";
		$input = $this->MasterData->editData($where, $data, 'users');

		if ($input) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data anggota regu berhasil ditambahkan.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/anggotaRegu/'.encode($id_regu));
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah anggota regu gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/anggotaRegu/'.encode($id_regu));
		}
	}

	public function updateAnggotaRegu($id=''){
		$input = html_escape($this->input->POST());

		$id_regu = decode($id);
		$id_user = $input['user'];

		$data = array(
			'id_regu' => $id_regu,
			'jabatan' => $input['jabatan'],
		);
		$where = "id_user = $id_user";
		$input = $this->MasterData->editData($where, $data, 'users');

		if ($input) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data anggota regu berhasil ditambahkan.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/anggotaRegu/'.encode($id_regu));
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah anggota regu gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/anggotaRegu/'.encode($id_regu));
		}
	}

	public function hapusAnggotaRegu($value=''){
		$id_user = decode($this->input->POST('id_user'));

		$where = "id_user = '$id_user'";
		$data = array(
			'id_regu' => null,
		);
		$hapus = $this->MasterData->editData($where, $data, 'users');

		if ($hapus) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Anggota berhasil dihapus.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Success';
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Hapus Anggota gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Gagal';
		}
	}

	// ========================================================

	//Mobil Damkar ============================================
	public function mobilDamkar(){
		$data['id_nav'] = 12;
		$data['id_sub_nav'] = 12.1;

		$select = array(
			'md.*',
			"(SELECT wd.nama_wmk FROM wmk_damkar wd WHERE wd.id_wmk = md.id_wmk) nama_wmk",
			"(SELECT COUNT(mid.id_mobil_item) FROM mobil_item_damkar mid WHERE mid.id_mobil = md.id_mobil) jml_item",
		);
		$table = 'mobil_damkar md';
		$where = "md.id_mobil > 0";
		$by = 'md.id_mobil';
		$order = 'DESC';
		$data['mobil'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		$data['wmk'] = $this->MasterData->getData('wmk_damkar')->result();

		view('pages/mobil_damkar', $data);
	}

	public function simpanMobilDamkar($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'id_wmk'   		=> $input['wmk'],
			'nama_mobil'  	=> $input['nama'],
			'no_plat_mobil' => $input['nomor'],
		);

		$input = $this->MasterData->inputData($data,'mobil_damkar');

		if ($input) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Mobil berhasil ditambahkan.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/mobilDamkar');
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah Mobil gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/mobilDamkar');
		}
	}

	public function updateMobilDamkar($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'id_wmk'   		=> $input['wmk'],
			'nama_mobil'  	=> $input['nama'],
			'no_plat_mobil' => $input['nomor'],
		);
		$where = "id_mobil = '$input[id_mobil]'";
		$update = $this->MasterData->editData($where,$data,'mobil_damkar');

		if ($update) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Mobil berhasil diupdate.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/mobilDamkar');
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update Mobil gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/mobilDamkar');
		}
	}

	public function hapusMobilDamkar($value=''){
		$id_mobil = $this->input->POST('id_mobil');

		$where = "id_mobil = '$id_mobil'";
		$hapus = $this->MasterData->deleteData($where,'mobil_damkar');

		if ($hapus) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Mobil berhasil dihapus.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Success';
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Hapus Mobil gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Gagal';
		}
	}
 
	// ========================================================

	//Item Damkar ============================================
	public function alatDamkar(){
		$data['id_nav'] = 12;
		$data['id_sub_nav'] = 12.2;

		$select = '*';
		$table = 'item_damkar';
		$where = "id_item > 0";
		$by = 'id_item';
		$order = 'DESC';
		$data['alat'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		view('pages/alat_damkar', $data);
	}

	public function simpanAlatDamkar($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'nama_item' => $input['nama'],
			'satuan_item' => $input['satuan'],
		);

		$input = $this->MasterData->inputData($data,'item_damkar');

		if ($input) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Alat berhasil ditambahkan.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/alatDamkar');
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah Alat gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/alatDamkar');
		}
	}

	public function updateAlatDamkar($value=''){
		$input = html_escape($this->input->POST());

		$data = array(
			'nama_item' => $input['nama'],
			'satuan_item' => $input['satuan'],
		);
		
		$where = "id_item = '$input[id_item]'";
		$update = $this->MasterData->editData($where,$data,'item_damkar');

		if ($update) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Alat berhasil diupdate.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/alatDamkar');
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update Alat gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/alatDamkar');
		}
	}

	public function hapusAlatDamkar($value=''){
		$id_item = $this->input->POST('id_item');

		$where = "id_item = '$id_item'";
		$hapus = $this->MasterData->deleteData($where,'item_damkar');

		if ($hapus) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Alat berhasil dihapus.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Success';
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Hapus Alat gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Gagal';
		}
	}
 
	// ========================================================

	//Item Damkar ============================================
	public function itemMobil($id=''){
		$data['id_nav'] = 12;
		$data['id_sub_nav'] = 12.1;

		$id_mobil = decode($id);

		$select = '*';
		$table = 'mobil_damkar';
		$where = "id_mobil = $id_mobil";
		$data['mobil'] = $this->MasterData->getWhereData($select,$table,$where)->row();

		$select = array(
			'mid.*',
			"(SELECT nama_item it FROM item_damkar it WHERE it.id_item = mid.id_item) nama_item",
			"(SELECT satuan_item it FROM item_damkar it WHERE it.id_item = mid.id_item) satuan_item",
		);
		$table = 'mobil_item_damkar mid';
		$where = "id_mobil = $id_mobil";
		$by = 'id_mobil_item';
		$order = 'DESC';
		$data['item_mobil'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		$select = array(
			'it.*',
			"(SELECT COUNT(mid.id_item) as jml FROM mobil_item_damkar mid WHERE mid.id_item = it.id_item AND id_mobil = $id_mobil) sedia",
		);
		$table = "item_damkar it";
		$data['item'] = $this->MasterData->getSelectData($select,$table)->result();

		$data['id_mobil'] = $id_mobil;

		view('pages/item_mobil', $data);
	}

	public function simpanItemMobil($id=''){
		$input = html_escape($this->input->POST());

		$id_mobil = decode($id);

		$data = array(
			'id_mobil' => $id_mobil,
			'id_item'  => $input['item'],
			'jml_item' => $input['jml'],
		);

		$input = $this->MasterData->inputData($data,'mobil_item_damkar');

		if ($input) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Item Mobil berhasil ditambahkan.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/itemMobil/'.$id);
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah Item Mobil gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/itemMobil/'.$id);
		}
	}

	public function updateItemMobil($id=''){
		$input = html_escape($this->input->POST());

		$id_mobil = decode($id);

		$data = array(
			'id_mobil' => $id_mobil,
			'id_item'  => $input['item'],
			'jml_item' => $input['jml'],
		);
		
		$where = "id_mobil_item = '$input[id_mobil_item]'";
		$update = $this->MasterData->editData($where,$data,'mobil_item_damkar');

		if ($update) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Item Mobil berhasil diupdate.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/itemMobil/'.$id);
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update Item Mobil gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			redirect(base_url().'Damkar/itemMobil/'.$id);
		}
	}

	public function hapusItemMobil($value=''){
		$id_mobil_item = $this->input->POST('id_mobil_item');

		$where = "id_mobil_item = '$id_mobil_item'";
		$hapus = $this->MasterData->deleteData($where,'mobil_item_damkar');

		if ($hapus) {
			$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data Item Mobil berhasil dihapus.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Success';
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Hapus Item Mobil gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_flashdata($sess);
			echo 'Gagal';
		}
	}
 
	// ========================================================

	// Batas Jarak ==================================
	public function batasJarak($sess=''){
		$data['id_nav'] = 10;

		if ($sess == '') {
			$this->session->unset_userdata('alert_batas');
		}

		$select = '*';
		$table = array(
			'batas_jarak batas'
		);
		$where = "batas.id_kategori = '$this->id_kategori'";
		$data['batas'] =$this->MasterData->getWhereData($select,$table,$where)->row();

		view('pages/batas_jarak', $data);
	}

	public function simpanBatasJarak($value=''){
		$input = html_escape($this->input->POST());
		$id_kategori = $this->id_kategori;

		$where = "id_kategori = '$id_kategori'";
		$cek = $this->MasterData->getWhereData('*','batas_jarak',$where)->num_rows();

		$data = array(
			'id_kategori' => $id_kategori,
			'jarak' => $input['batas_jarak']
		);

		if ($cek == 0) {
			$input_jarak = $this->MasterData->inputData($data,'batas_jarak');
		}else{
			$input_jarak = $this->MasterData->editData($where,$data,'batas_jarak');
		}

		if ($input_jarak) {
			$sess['alert_batas'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data batas jarak berhasil disimpan.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/batasJarak/true');
		}else{
			$sess['alert_batas'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Simpan batas jarak gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Damkar/batasJarak/true');
		}
	}
	// ========================================================


	public function changePassword(){
		$id = $this->input->POST('id');
		$pass = md5($this->input->POST('newPass'));
		// var_dump($pass, $id);

		$data = array('password'=>$pass);
		$where = "id_user='$id'";
		$edit = $this->MasterData->editData($where,$data,'users');
		if ($edit) {
			echo "Success";
		}else{
			echo "Gagal";
		}
	}

	public function validPassword(){
		$id = $this->input->POST('id');
		$pass = md5($this->input->POST('pass'));

		$select = 'password';
		$where = "id_user='$id' AND password='$pass'";
		$data = $this->MasterData->getWhereData($select,'users',$where);
		$count = $data->num_rows();
		if ($count>0) {
			echo "Valid";
		}else{
			echo "No Valid";
		}
	}

	public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('status');
		session_destroy();
		redirect('login');
	}
}
