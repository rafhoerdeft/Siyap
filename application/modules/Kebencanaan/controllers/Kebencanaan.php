<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kebencanaan extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('MasterData');
		$this->load->library('session');
		if ($this->session->userdata('role')!= "Operator Kebencanaan" AND $this->session->userdata('role')!= "Admin Kebencanaan") {
			redirect('Login/index');
		}
		date_default_timezone_set('Asia/Jakarta');
		$login_id = $this->session->userdata('id_user');
		$this->sms = $this->load->database('sms', TRUE);
		$this->id_kategori = $this->session->userdata('id_kategori');
    }

	public function index(){
		$data['id_nav'] = 1;

		$thn = $this->input->GET('tahun');
		if ($thn == '') {
			$thn = date('Y');
		}
		// JUMLAH USER APLIKASI 
		$select = 'count(usr.id_user) jml_user';
		$table = array(
			'users usr',
			'role'
		);
		$where = "usr.id_role = role.id_role AND role = 'User'";
		$data['user_pelapor'] = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_user;

		$where = "usr.id_role = role.id_role AND role = 'Petugas Kebencanaan'";
		$data['user_petugas'] = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_user;

		$where = "usr.id_role = role.id_role AND role = 'Admin Kebencanaan'";
		$data['user_admin'] = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_user;

		$data['total_user'] = $data['user_pelapor'] + $data['user_petugas'] + $data['user_admin'];

		// JUMLAH LAPORAN MASUK
		$select = 'count(lap.id_lapor) laporan';
		$table = array(
			'lapor lap',
			'kategori ktg'
		);
		$where = "date(tgl_lapor) = date(now()) AND lap.id_kategori = ktg.id_kategori AND ktg.nama_kategori = 'Kebencanaan'";
		$data['lap_harian'] = $this->MasterData->getWhereData($select,$table,$where)->row()->laporan;

		$where = "YEARWEEK(tgl_lapor) = YEARWEEK(NOW()) AND lap.id_kategori = ktg.id_kategori AND ktg.nama_kategori = 'Kebencanaan'";
		$data['lap_mingguan'] = $this->MasterData->getWhereData($select,$table,$where)->row()->laporan;

		$where = "MONTH(tgl_lapor) = MONTH(now()) AND YEAR(tgl_lapor) = YEAR(now()) AND lap.id_kategori = ktg.id_kategori AND ktg.nama_kategori = 'Kebencanaan'";
		$data['lap_bulanan'] = $this->MasterData->getWhereData($select,$table,$where)->row()->laporan;

		$where = "YEAR(tgl_lapor) = YEAR(now()) AND lap.id_kategori = ktg.id_kategori AND ktg.nama_kategori = 'Kebencanaan'";
		$data['lap_tahunan'] = $this->MasterData->getWhereData($select,$table,$where)->row()->laporan;

		// SELECT 
		//     MONTH(lap.tgl_lapor) AS bulan,
		// 	WEEK(lap.tgl_lapor) AS minggu,
		//     COUNT(lap.id_lapor) AS jml
		// FROM 
		// 	lapor lap, 
		//     kategori ktg 
		// WHERE
		// 	lap.id_kategori = ktg.id_kategori AND
		//     ktg.nama_kategori = 'Kebencanaan' AND
		//     YEAR(lap.tgl_lapor) = YEAR(now())
		// GROUP BY
		// 	MONTH(lap.tgl_lapor),
		//     WEEK(lap.tgl_lapor)
		// ORDER BY
		// 	MONTH(lap.tgl_lapor),
		// 	WEEK(lap.tgl_lapor)
		// ASC

		$select = array(
			'MONTH(lap.tgl_lapor) AS bulan',
			'WEEK(lap.tgl_lapor) AS minggu',
		    'COUNT(lap.id_lapor) AS jml_lap'
		);
		$where = "lap.id_kategori = ktg.id_kategori AND
			    ktg.nama_kategori = 'Kebencanaan' AND
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

		if ($data_lap == null || $data_lap == '') {
			$data['data_lap'] = "Kosong";
		}else{
			$data['data_lap'] = $data_lap;
		}
		$data['tahun'] = $thn;

		$select = "YEAR(tgl_lapor) thn";
		$group = "YEAR(tgl_lapor)";
		$by = "YEAR(tgl_lapor)";
		$order = 'ASC';
		$data['data_thn'] = $this->MasterData->getDataGroupOrder($select,'lapor',$group,$by,$order)->result();

		$this->load->view('Kebencanaan/header');
		$this->load->view('Kebencanaan/navigation', $data);
		$this->load->view('Kebencanaan/dashboard', $data);
		$this->load->view('Kebencanaan/footer');
	}

	public function trackLaporan($value=''){
		$data['id_nav'] = 2;

		$this->load->view('Kebencanaan/header');
		$this->load->view('Kebencanaan/navigation', $data);
		$this->load->view('Kebencanaan/track_leaf', $data);
		$this->load->view('Kebencanaan/footer');
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

        $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
        $newID = $cek->Auto_increment;

        // menghitung jumlah pecahan
        $jmlSMS = ceil(strlen($pesan)/153);

        // memecah pesan asli
        $pecah  = str_split($pesan, 153);

        // proses penyimpanan ke tabel mysql untuk setiap pecahan
        $counts = 0;
        for ($i=1; $i<=$jmlSMS; $i++){
           // membuat UDH untuk setiap pecahan, sesuai urutannya
           $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);

           // membaca text setiap pecahan
           $msg = $pecah[$i-1];

           if ($i == 1){
	             // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
           		$data = array(
		            'DestinationNumber' => $noTelp,
		            'UDH' => $udh,
		            'TextDecoded' => $msg,
		            'ID' => $newID,
		            'MultiPart' => 'true',
		            'CreatorID' => 'Siyap'
		        );

		        $table = 'outbox';
		        $input_msg = $this->MasterData->sendMsg($data,$table);

           }else{
              	// jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
            	$data = array(
		            'UDH' => $udh,
		            'TextDecoded' => $msg,
		            'ID' => $newID,
		            'SequencePosition' => $i
		        );

		        $table = 'outbox_multipart';
		        $input_msg = $this->MasterData->sendMsg($data,$table);
           }

           	if ($input_msg) {
	         	$counts++;
	        }          
        }

        if ($counts > 0) {
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

	public function showLap($value=''){
		$id = $this->input->post('id_lap');

		// var_dump($id);exit();

		// $select = '*';
		// $table = array(
		// 	'lapor lap',
		// 	'laporan_damkar ld'
		// );
		// $where = "lap.id_lapor = ld.id_lapor AND lap.id_lapor = '$id'";
		// $data = $this->MasterData->getWhereData($select,$table,$where)->row();

		$data_lapor = $this->db->query("SELECT *, (SELECT usr.nama FROM users usr WHERE lap.id_user = usr.id_user) AS nama_user, (SELECT usr.no_hp FROM users usr WHERE lap.id_user = usr.id_user) AS no_hp FROM lapor lap LEFT JOIN laporan_damkar ld ON lap.id_lapor = ld.id_lapor WHERE lap.id_lapor = '$id'")->row();

		$data_foto = $this->db->query("SELECT foto_kejadian FROM log_lapor WHERE id_lapor = '$id'")->result();

		$data = array(
			'lapor' => $data_lapor,
			'foto' => $data_foto
		);

		echo json_encode($data);
	}

	public function historiAduan($value=''){
		$data['id_nav'] = 3;

		// SELECT 
		// 	lpr.*,
		// 	(SELECT usr.nama FROM users usr WHERE lpr.id_user = usr.id_user) nama_user
		// FROM 
		// 	kategori ktg,
		// 	lapor lpr
		// WHERE 
		//     lpr.id_kategori = ktg.id_kategori AND 
		//     ktg.nama_kategori = 'Kebencanaan'

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
		$where = "lpr.id_kategori = ktg.id_kategori AND jl.id_jenis_lap = lpr.id_jenis_lap AND ktg.nama_kategori = 'Kebencanaan'";
		$order = 'DESC';
		$by = 'lpr.id_lapor';
		// $data['histori'] = $this->MasterData->getWhereData($select,$table,$where)->result();
		$data['histori'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		$this->load->view('Kebencanaan/header');
		$this->load->view('Kebencanaan/navigation', $data);
		$this->load->view('Kebencanaan/histori', $data);
		$this->load->view('Kebencanaan/footer');
	}	

	public function simpanLap($value=''){
		$input = $this->input->POST();

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
			'tindakan' => $input['tindakan']
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
		redirect(base_url().'Kebencanaan/historiAduan');
	}

	public function simpanLap2($value=''){
		$input = $this->input->POST();

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
			'ket_laporan' => $input['ket_kejadian']
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
		redirect(base_url().'Kebencanaan/historiAduan');
	}

	public function cetakLap($id=''){
		$data['laporan'] = $this->db->query("SELECT *, (SELECT usr.nama FROM users usr WHERE lap.id_user = usr.id_user) AS nama_user, (SELECT usr.no_hp FROM users usr WHERE lap.id_user = usr.id_user) AS no_hp FROM lapor lap LEFT JOIN laporan_damkar ld ON lap.id_lapor = ld.id_lapor WHERE lap.id_lapor = '$id'")->row();

		$data['photo']  = $this->db->query("SELECT foto_kejadian FROM log_lapor WHERE id_lapor = '$id'")->result();
		// var_dump($data);exit();
		
		$this->load->library('pdf');
		$this->load->view('Kebencanaan/cetak_laporan',$data);
	}

	public function cetakLap2($id=''){
		$data['laporan'] = $this->db->query("SELECT *, (SELECT usr.nama FROM users usr WHERE lap.id_user = usr.id_user) AS nama_user, (SELECT usr.no_hp FROM users usr WHERE lap.id_user = usr.id_user) AS no_hp FROM lapor lap LEFT JOIN laporan_damkar ld ON lap.id_lapor = ld.id_lapor WHERE lap.id_lapor = '$id'")->row();

		$data['photo']  = $this->db->query("SELECT foto_kejadian FROM log_lapor WHERE id_lapor = '$id'")->result();
		// var_dump($data);exit();
		
		$this->load->library('pdf');
		$this->load->view('Kebencanaan/cetak_laporan2',$data);
	}

	public function userApp($sess=''){
		$data['id_nav'] = 4;

		if ($sess == '') {
			$this->session->unset_userdata('alert');
		}
		// SELECT usr.* FROM users usr, role WHERE usr.id_role = role.id_role AND role.role LIKE '%Kebencanaan%'

		$where = "role like '%Kebencanaan%'";
		$data['role'] = $this->MasterData->getWhereDataAll('role',$where)->result();

		$select = array(
			'usr.*',
			'role.*'
		);
		$table = array(
			'users usr',
			'role'
		);
		$where = "usr.id_role = role.id_role AND role.role LIKE '%Kebencanaan%'";
		$order = 'DESC';
		$by = 'usr.id_user';
		$data['user'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		$this->load->view('Kebencanaan/header');
		$this->load->view('Kebencanaan/navigation', $data);
		$this->load->view('Kebencanaan/user_app', $data);
		$this->load->view('Kebencanaan/footer');
	}

	public function simpanUser($value=''){
		$input = $this->input->POST();
		$pass = md5($input['password']);

		$select = "COUNT(*) AS jml";
		$table = 'users';
		$where = "no_hp = '$input[no_hp]'";
		$cek = $this->MasterData->getWhereData($select,$table,$where)->row()->jml;

		if ($cek == 0) {
			$data = array(
				'id_role' => $input['role_user'],
				'password' => $pass,
				'nama' => $input['nama_user'],
				'jenis_kelamin' => $input['jk_user'],
				'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
				'alamat' => $input['almt_user'],
				'no_hp' => $input['no_hp'],
				'username' => $input['username']
			);
			$input_user = $this->MasterData->inputData($data,'users');

			if ($input_user) {
				$select = 'role';
				$where = "id_role = '$input[role_user]'";
				$namaRole = $this->MasterData->getWhereData($select,'role',$where)->row()->role;

				$noTelp = $input['no_hp'];
				$pesan = "Password SIYAP anda: ".$input['password']."\nAnda terdaftar sebagai ".$namaRole;

		        $cekID = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
		        $newID = $cekID->Auto_increment;

		        $data = array(
		            'DestinationNumber' => $noTelp,
		            'TextDecoded' => $pesan,
		            'ID' => $newID,
		            'MultiPart' => 'false',
		            'CreatorID' => 'Siyap'
		        );

		        $table = 'outbox';
		        $input_msg = $this->MasterData->sendMsg($data,$table);
		        $respon = array();

		        if ($input_msg) {
		        	$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Success!!</b> Data user berhasil ditambahkan.
	                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Kebencanaan/userApp/true');
		        }else{
		        	$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Tambah user gagal!!</b> Silahkan coba lagi.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Kebencanaan/userApp/true');
		        }
			}else{
				$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Tambah user gagal!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Kebencanaan/userApp/true');
			}
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Nomor HP sudah terdaftar!!</b> Silahkan ganti nomor HP lain.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/userApp/true');
		}
	}

	public function updateUser($value=''){
		$input = $this->input->POST();

		$select = "COUNT(*) AS jml";
		$table = 'users';
		$where = "no_hp = '$input[no_hp]'";
		$cekNomor = $this->MasterData->getWhereData($select,$table,$where)->row()->jml;

		if ($input['no_hp'] == $input['no_hp_old']) {
			if ($input['password'] == '' || $input['password'] == null) {
				$data = array(
					'id_role' => $input['role_user'],
					'nama' => $input['nama_user'],
					'jenis_kelamin' => $input['jk_user'],
					'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
					'alamat' => $input['almt_user'],
					'no_hp' => $input['no_hp'],
					'username' => $input['username']
				);
			}else{
				$data = array(
					'id_role' => $input['role_user'],
					'password' => md5($input['password']),
					'nama' => $input['nama_user'],
					'jenis_kelamin' => $input['jk_user'],
					'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
					'alamat' => $input['almt_user'],
					'no_hp' => $input['no_hp'],
					'username' => $input['username']
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

		        $table = 'outbox';
		        $input_msg = $this->MasterData->sendMsg($data,$table);
		        // $respon = array();

		         if ($input_msg) {
		         	$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Success!!</b> Data user berhasil diupdate.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Kebencanaan/userApp/true');
		         }else{
		         	$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Update user gagal!!</b> Silahkan coba lagi.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Kebencanaan/userApp/true');
		         }
			}else{
				$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Update user gagal!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Kebencanaan/userApp/true');
			}
		}else{
			if ($cekNomor == 0) {

				if ($input['password'] == '' || $input['password'] == null) {
					$data = array(
						'id_role' => $input['role_user'],
						'nama' => $input['nama_user'],
						'jenis_kelamin' => $input['jk_user'],
						'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
						'alamat' => $input['almt_user'],
						'no_hp' => $input['no_hp'],
						'username' => $input['username']
					);
				}else{
					$data = array(
						'id_role' => $input['role_user'],
						'password' => md5($input['password']),
						'nama' => $input['nama_user'],
						'jenis_kelamin' => $input['jk_user'],
						'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
						'alamat' => $input['almt_user'],
						'no_hp' => $input['no_hp'],
						'username' => $input['username']
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

			        $table = 'outbox';
			        $input_msg = $this->MasterData->sendMsg($data,$table);
			        // $respon = array();

			         if ($input_msg) {
			         	$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
			                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                                <b>Success!!</b> Data user berhasil diupdate.
			                              </div>';
						$this->session->set_userdata($sess);
						redirect(base_url().'Kebencanaan/userApp/true');
			         }else{
			         	$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
			                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                                <b>Update user gagal!!</b> Silahkan coba lagi.
			                              </div>';
						$this->session->set_userdata($sess);
						redirect(base_url().'Kebencanaan/userApp/true');
			         }
				}else{
					$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Update user gagal!!</b> Silahkan coba lagi.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Kebencanaan/userApp/true');
				}
			}else{
				$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Nomor HP sudah terdaftar!!</b> Silahkan ganti nomor HP lain.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Kebencanaan/userApp/true');
			}
		}
	}

	public function hapusUser($value=''){
		$id_user = $this->input->POST('id_user');

		$where = "id_user = '$id_user'";
		$hapus_user = $this->MasterData->deleteData($where,'users');

		if ($hapus_user) {
			echo 'Success';
		}else{
			echo 'Gagal';
		}
	}

	// Nomor Telepon SKPD ==========================================
	public function nomorTelp($sess=''){
		$data['id_nav'] = 5;

		if ($sess == '') {
			$this->session->unset_userdata('alert_nomor');
		}

		$data['nomor'] =$this->MasterData->getData('nomor_telpon')->result();

		$this->load->view('Kebencanaan/header');
		$this->load->view('Kebencanaan/navigation', $data);
		$this->load->view('Kebencanaan/nomor_telpon', $data);
		$this->load->view('Kebencanaan/footer');
	}

	public function simpanNomor($value=''){
		$input = $this->input->POST();

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
			redirect(base_url().'Kebencanaan/nomorTelp/true');
		}else{
			$sess['alert_nomor'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah nomor telepon gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/nomorTelp/true');
		}
	}

	public function updateNomor($value=''){
		$input = $this->input->POST();

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
			redirect(base_url().'Kebencanaan/nomorTelp/true');
		}else{
			$sess['alert_nomor'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update nomor telepon gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/nomorTelp/true');
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
		$where = "ktg.id_kategori = pesan.id_kategori AND nom.id_no_telp = pesan.id_no_telp AND ktg.nama_kategori like '%Kebencanaan%'";
		$order = 'DESC';
		$by = 'pesan.id_pesan';
		$data['pesan'] =$this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		$this->load->view('Kebencanaan/header');
		$this->load->view('Kebencanaan/navigation', $data);
		$this->load->view('Kebencanaan/pesan', $data);
		$this->load->view('Kebencanaan/footer');
	}

	public function kirimPesan($value=''){
		$input = $this->input->POST();
		$id_kategori = $this->session->userdata('id_kategori');

		$select = 'no_telp';
		$where = "id_no_telp = '$input[nomor]'";
		$noTelp = $this->MasterData->getWhereData($select,'nomor_telpon',$where)->row()->no_telp;

		$select = 'skpd';
		$where = "id_kategori = '$id_kategori'";
		$skpd = $this->MasterData->getWhereData($select,'kategori',$where)->row()->skpd;

		$pesan = "Pengirim : $skpd\n\n\n$input[pesan]\n\n(Dikirim melalui aplikasi SIYAP)";

        $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
        $newID = $cek->Auto_increment;

        // menghitung jumlah pecahan
        $jmlSMS = ceil(strlen($pesan)/153);

        // memecah pesan asli
        $pecah  = str_split($pesan, 153);

        // proses penyimpanan ke tabel mysql untuk setiap pecahan
        $counts = 0;
        for ($i=1; $i<=$jmlSMS; $i++){
           // membuat UDH untuk setiap pecahan, sesuai urutannya
           $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);

           // membaca text setiap pecahan
           $msg = $pecah[$i-1];

           if ($i == 1){
	             // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
           		$data = array(
		            'DestinationNumber' => $noTelp,
		            'UDH' => $udh,
		            'TextDecoded' => $msg,
		            'ID' => $newID,
		            'MultiPart' => 'true',
		            'CreatorID' => 'Siyap'
		        );

		        $table = 'outbox';
		        $input_msg = $this->MasterData->sendMsg($data,$table);

           }else{
              	// jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
            	$data = array(
		            'UDH' => $udh,
		            'TextDecoded' => $msg,
		            'ID' => $newID,
		            'SequencePosition' => $i
		        );

		        $table = 'outbox_multipart';
		        $input_msg = $this->MasterData->sendMsg($data,$table);
           }

           	if ($input_msg) {
	         	$counts++;
	        }          
        }

        // $data = array(
        //     'DestinationNumber' => $noTelp,
        //     'TextDecoded' => $pesan,
        //     'ID' => $newID,
        //     'MultiPart' => 'false',
        //     'CreatorID' => 'Siyap'
        // );

        // $table = 'outbox';
        // $input_msg = $this->MasterData->sendMsg($data,$table);
        // $respon = array();

        if ($counts > 0) {
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
				redirect(base_url().'Kebencanaan/pesan/true');
			}else{
				$sess['alert_pesan'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Pesan gagal dikirim!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Kebencanaan/pesan/true');
			}
        }else{
            $sess['alert_pesan'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Pesan gagal dikirim!!</b> Silahkan coba lagi.
	                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/pesan/true');
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
		$input = $this->input->POST();
		$id_kategori = $this->session->userdata('id_kategori');

		$select = 'no_telp';
		$where = "id_no_telp = '$input[nomor]'";
		$noTelp = $this->MasterData->getWhereData($select,'nomor_telpon',$where)->row()->no_telp;

		$select = 'skpd';
		$where = "id_kategori = '$id_kategori'";
		$skpd = $this->MasterData->getWhereData($select,'kategori',$where)->row()->skpd;

		$pesan = "Pengirim : $skpd\n\n\n$input[pesan]\n\n(Dikirim melalui aplikasi SIYAP)";

        $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
        $newID = $cek->Auto_increment;

        // menghitung jumlah pecahan
        $jmlSMS = ceil(strlen($pesan)/153);

        // memecah pesan asli
        $pecah  = str_split($pesan, 153);

        // proses penyimpanan ke tabel mysql untuk setiap pecahan
        $counts = 0;
        for ($i=1; $i<=$jmlSMS; $i++){
           // membuat UDH untuk setiap pecahan, sesuai urutannya
           $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);

           // membaca text setiap pecahan
           $msg = $pecah[$i-1];

           if ($i == 1){
	             // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
           		$data = array(
		            'DestinationNumber' => $noTelp,
		            'UDH' => $udh,
		            'TextDecoded' => $msg,
		            'ID' => $newID,
		            'MultiPart' => 'true',
		            'CreatorID' => 'Siyap'
		        );

		        $table = 'outbox';
		        $input_msg = $this->MasterData->sendMsg($data,$table);

           }else{
              	// jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
            	$data = array(
		            'UDH' => $udh,
		            'TextDecoded' => $msg,
		            'ID' => $newID,
		            'SequencePosition' => $i
		        );

		        $table = 'outbox_multipart';
		        $input_msg = $this->MasterData->sendMsg($data,$table);
           }

           	if ($input_msg) {
	         	$counts++;
	        }          
        }


        // $data = array(
        //     'DestinationNumber' => $noTelp,
        //     'TextDecoded' => $pesan,
        //     'ID' => $newID,
        //     'MultiPart' => 'false',
        //     'CreatorID' => 'Siyap'
        // );

        // $table = 'outbox';
        // $input_msg = $this->MasterData->sendMsg($data,$table);
        // $respon = array();

        if ($counts > 0) {
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
				redirect(base_url().'Kebencanaan/pesan/true');
			}else{
				$sess['alert_pesan'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Pesan gagal dikirim!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Kebencanaan/pesan/true');
			}
        }else{
        	$sess['alert_pesan'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Pesan gagal dikirim!!</b> Silahkan coba lagi.
	                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/pesan/true');
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
		$where = "ktg.id_kategori = jl.id_kategori AND ktg.nama_kategori like '%Kebencanaan%'";
		$by = 'jl.id_jenis_lap';
		$order = 'DESC';
		$data['kejadian'] =$this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

		$this->load->view('Kebencanaan/header');
		$this->load->view('Kebencanaan/navigation', $data);
		$this->load->view('Kebencanaan/jenis_kejadian', $data);
		$this->load->view('Kebencanaan/footer');
	}

	public function simpanKejadian($value=''){
		$input = $this->input->POST();
		$id_kategori = $this->session->userdata('id_kategori');

		$data = array(
			'id_kategori' => $id_kategori,
			'nama_jenis_lap' => $input['nama_jenis_lap']
		);
		$input_jenis = $this->MasterData->inputData($data,'jenis_laporan');

		if ($input_jenis) {
			$sess['alert_kejadian'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data jenis kejadian berhasil ditambahkan.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/jenisKejadian/true');
		}else{
			$sess['alert_kejadian'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah jenis kejadian gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/jenisKejadian/true');
		}
	}

	public function updateKejadian($value=''){
		$input = $this->input->POST();
		$id_kategori = $this->session->userdata('id_kategori');

		$data = array(
			'id_kategori' => $id_kategori,
			'nama_jenis_lap' => $input['nama_jenis_lap']
		);
		$where = "id_jenis_lap = '$input[id_jenis_lap]'";
		$update_kejadian = $this->MasterData->editData($where,$data,'jenis_laporan');

		if ($update_kejadian) {
			$sess['alert_kejadian'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data jenis kejadian berhasil diupdate.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/jenisKejadian/true');
		}else{
			$sess['alert_kejadian'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update jenis kejadian gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/jenisKejadian/true');
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
		$where = "ktg.id_kategori = not.id_kategori AND ktg.nama_kategori like '%Kebencanaan%'";
		$data['notif'] =$this->MasterData->getWhereData($select,$table,$where)->row();

		$this->load->view('Kebencanaan/header');
		$this->load->view('Kebencanaan/navigation', $data);
		$this->load->view('Kebencanaan/awal_notif', $data);
		$this->load->view('Kebencanaan/footer');
	}

	public function simpanAwalNotif($value=''){
		$input = $this->input->POST();
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
			redirect(base_url().'Kebencanaan/awalNotif/true');
		}else{
			$sess['alert_notif'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Simpan notif awal gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/awalNotif/true');
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
		$this->load->view('Kebencanaan/header');
		$this->load->view('Kebencanaan/navigation', $data);
		$this->load->view('Kebencanaan/nomor_darurat', $data);
		$this->load->view('Kebencanaan/footer');
	}

	public function simpanNomorDarurat($value=''){
		$input = $this->input->POST();

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
			redirect(base_url().'Kebencanaan/nomorDarurat/true');
		}else{
			$sess['alert_nom_dar'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah nomor darurat gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/nomorDarurat/true');
		}
	}

	public function updateNomorDarurat($value=''){
		$input = $this->input->POST();

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
			redirect(base_url().'Kebencanaan/nomorDarurat/true');
		}else{
			$sess['alert_nom_dar'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update nomor darurat gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/nomorDarurat/true');
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

		$this->load->view('Kebencanaan/header');
		$this->load->view('Kebencanaan/navigation', $data);
		$this->load->view('Kebencanaan/batas_jarak', $data);
		$this->load->view('Kebencanaan/footer');
	}

	public function simpanBatasJarak($value=''){
		$input = $this->input->POST();
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
			redirect(base_url().'Kebencanaan/batasJarak/true');
		}else{
			$sess['alert_batas'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Simpan batas jarak gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Kebencanaan/batasJarak/true');
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
