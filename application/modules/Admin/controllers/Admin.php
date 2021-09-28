<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('MasterData');
		$this->load->library('session');
		$this->load->helper('encrypt');
		$this->load->helper('wa');
		
		date_default_timezone_set('Asia/Jakarta');
		$this->login_id = $this->session->userdata('id_user');
		// $this->sms = $this->load->database('sms', TRUE);
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

		$where = "usr.id_role = role.id_role AND role like '%Petugas%'";
		$data['user_petugas'] = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_user;

		$where = "usr.id_role = role.id_role AND role like '%Admin%'";
		$data['user_admin'] = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_user;

		$data['total_user'] = $data['user_pelapor'] + $data['user_petugas'] + $data['user_admin'];

		
		$table = 'kategori ktg';
		$where = "ktg.tampil = 'true'";
		$select = "count(ktg.id_kategori) kategori_aktif";
		$data['jml_ktg_aktif'] = $this->MasterData->getWhereData($select,$table,$where)->row()->kategori_aktif;

		$where = "ktg.tampil = 'false'";
		$select = "count(ktg.id_kategori) kategori_non";
		$data['jml_ktg_non'] = $this->MasterData->getWhereData($select,$table,$where)->row()->kategori_non;

		view('pages/dashboard', $data);
	}

	// KATEGORI =================================================
	public function kategori($sess=''){
		$data['id_nav'] = 2;

		if ($sess == '') {
			$this->session->unset_userdata('alert_kategori');
		}

		$table = 'kategori';
		$order = 'id_kategori';
		$data['kategori'] = $this->MasterData->getDataDesc($table, $order)->result();
		
		view('pages/kategori', $data);
	}

	public function simpanKategori($value=''){
		$input = $this->input->POST();

		$config['upload_path']          = './assets/path_menu';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 1000;
		$config['overwrite']			= true;
		$config['file_name']			= $input['nama_kategori'];
		// $config['space_remove']			= true;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;
		// $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
 
		$this->load->library('upload', $config);

		if ($this->input->POST()) {
			if ($this->upload->do_upload('gambar')){
				$data_file = $this->upload->data();

				$data = array(
					'nama_kategori' => $input['nama_kategori'],
					'skpd' => $input['skpd'],
					'gambar' => $data_file['file_name'],
					'tampil' => $input['tampil']
				);
				$input_kategori = $this->MasterData->inputData($data,'kategori');

				if ($input_kategori) {
					$sess['alert_kategori'] = '<div class="alert alert-success alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Success!!</b> Data kategori berhasil ditambahkan.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Admin/kategori/true');
				}else{
					$sess['alert_kategori'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Tambah kategori gagal!!</b> Silahkan coba lagi.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Admin/kategori/true');
				}
			}
		}
	}

	public function updateKategori($value=''){
		$input = $this->input->POST();

		$select = 'gambar';
		$where = "id_kategori = '$input[id_kategori]'";
		$files = $this->MasterData->getWhereData($select,'kategori',$where)->row()->gambar;

		$config['upload_path']          = './assets/path_menu';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 1000;
		$config['overwrite']			= true;
		$config['file_name']			= $input['nama_kategori'];
		// $config['space_remove']			= true;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;
		// $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

		if ($this->input->POST()) {
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('gambar')){
				unlink(APPPATH.'../assets/path_menu/'.$files);
				$data_file = $this->upload->data();

				$data = array(
					'nama_kategori' => $input['nama_kategori'],
					'skpd' => $input['skpd'],
					'gambar' => $data_file['file_name'],
					'tampil' => $input['tampil']
				);
			}else{
				$data = array(
					'nama_kategori' => $input['nama_kategori'],
					'skpd' => $input['skpd'],
					'tampil' => $input['tampil']
				);
			}

			$where = "id_kategori = '$input[id_kategori]'";
			$update_kategori = $this->MasterData->editData($where,$data,'kategori');

			if ($update_kategori) {
				$sess['alert_kategori'] = '<div class="alert alert-success alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Success!!</b> Data kategori berhasil diupdate.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Admin/kategori/true');
			}else{
				$sess['alert_kategori'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Update kategori gagal!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Admin/kategori/true');
			}
		}
	}

	public function hapusKategori($value=''){
		$id_kategori = $this->input->POST('id_kategori');

		$select = 'gambar';
		$where = "id_kategori = '$id_kategori'";
		$files = $this->MasterData->getWhereData($select,'kategori',$where)->row()->gambar;

		$where = "id_kategori = '$id_kategori'";
		$hapus_user = $this->MasterData->deleteData($where,'kategori');

		if ($hapus_user) {
			unlink(APPPATH.'../assets/path_menu/'.$files);
			echo 'Success';
		}else{
			echo 'Gagal';
		}
	}
	// ==========================================================

	// Informasi Aplikasi =======================================
	public function infoApp($sess=''){
		$data['id_nav'] = 3;

		if ($sess == '') {
			$this->session->unset_userdata('alert_info');
		}

		$table = 'informasi_app';
		$order = 'id_info';
		$data['informasi'] = $this->MasterData->getDataDesc($table, $order)->result();
		
		view('pages/info_app', $data);
	}

	public function simpanInfo($value=''){
		$input = $this->input->POST();

		$data = array(
			'kategori_info' => $input['kategori_info'],
			'judul_info' => $input['judul_info'],
			'isi_konten' => $input['isi_konten'],
			'tanggal_info' => date('Y-m-d', strtotime($input['tanggal_info']))
		);
		$input_info = $this->MasterData->inputData($data,'informasi_app');

		if ($input_info) {
			$sess['alert_info'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data informasi berhasil ditambahkan.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/infoApp/true');
		}else{
			$sess['alert_info'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah informasi gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/infoApp/true');
		}
	}

	public function updateInfo($value=''){
		$input = $this->input->POST();

		$data = array(
			'kategori_info' => $input['kategori_info'],
			'judul_info' => $input['judul_info'],
			'isi_konten' => $input['isi_konten'],
			'tanggal_info' => date('Y-m-d', strtotime($input['tanggal_info']))
		);
		$where = "id_info = '$input[id_info]'";
		$update_info = $this->MasterData->editData($where,$data,'informasi_app');

		if ($update_info) {
			$sess['alert_info'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data informasi berhasil diupdate.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/infoApp/true');
		}else{
			$sess['alert_info'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update informasi gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/infoApp/true');
		}
	}

	public function showEditInfo($value=''){
		$id = $this->input->POST('id_info');

		$select = '*';
		$table = 'informasi_app';
		$where = "id_info = '$id'";
		$data_info = $this->MasterData->getWhereData($select,$table,$where)->row();

		echo json_encode($data_info);
	}

	public function hapusInfo($value=''){
		$id_info = $this->input->POST('id_info');

		$where = "id_info = '$id_info'";
		$hapus_info = $this->MasterData->deleteData($where,'informasi_app');

		if ($hapus_info) {
			echo 'Success';
		}else{
			echo 'Gagal';
		}
	}
	// ==========================================================


	// User Aplikasi ============================================
	public function userApp($sess=''){
		$data['id_nav'] = 4;

		if ($sess == '') {
			$this->session->unset_userdata('alert');
		}
		// SELECT usr.* FROM users usr, role WHERE usr.id_role = role.id_role AND role.role LIKE '%Admin%'

		$data['role'] = $this->MasterData->MasterData->getWhereDataOrder('*','role',"role NOT LIKE '%Sampah%' AND role NOT LIKE '%Kebencanaan%'",'id_role','DESC')->result();

		$select = array(
			'usr.*',
			'role.*'
		);
		$table = array(
			'users usr',
			'role'
		);
		$where = "usr.id_role = role.id_role";
		$order = 'DESC';
		$by = 'usr.id_user';
		$data['user'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		
		view('pages/user_app', $data);
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

		        if ($input_msg) {
		        	$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Success!!</b> Data user berhasil ditambahkan.
	                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Admin/userApp/true');
		        }else{
		        	$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Tambah user gagal!!</b> Silahkan coba lagi.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Admin/userApp/true');
		        }
			}else{
				$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Tambah user gagal!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Admin/userApp/true');
			}
		}else{
			$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Nomor HP sudah terdaftar!!</b> Silahkan ganti nomor HP lain.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/userApp/true');
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

		         if ($input_msg) {
		         	$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Success!!</b> Data user berhasil diupdate.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Admin/userApp/true');
		         }else{
		         	$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Update user gagal!!</b> Silahkan coba lagi.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Admin/userApp/true');
		         }
			}else{
				$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Update user gagal!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Admin/userApp/true');
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

			         if ($input_msg) {
			         	$sess['alert'] = '<div class="alert alert-success alert-dismissible" role="alert">
			                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                                <b>Success!!</b> Data user berhasil diupdate.
			                              </div>';
						$this->session->set_userdata($sess);
						redirect(base_url().'Admin/userApp/true');
			         }else{
			         	$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
			                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                                <b>Update user gagal!!</b> Silahkan coba lagi.
			                              </div>';
						$this->session->set_userdata($sess);
						redirect(base_url().'Admin/userApp/true');
			         }
				}else{
					$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Update user gagal!!</b> Silahkan coba lagi.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Admin/userApp/true');
				}
			}else{
				$sess['alert'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Nomor HP sudah terdaftar!!</b> Silahkan ganti nomor HP lain.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Admin/userApp/true');
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
	// =========================================================


	// Roler User ==============================================
	public function roleUser($sess=''){
		$data['id_nav'] = 5;

		if ($sess == '') {
			$this->session->unset_userdata('alert_role');
		}

		$data['kategori'] =$this->MasterData->getData('kategori')->result();

		$select = '*';
		$table = array(
			'role',
			'kategori ktg'
		);
		$where = "role.id_kategori = ktg.id_kategori AND role.role NOT LIKE '%Sampah%' AND role.role NOT LIKE '%Kebencanaan%'";
		$by = 'id_role';
		$order = 'DESC';
		$data['role'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		
		view('pages/role_user', $data);
	}

	public function simpanRole($value=''){
		$input = $this->input->POST();

		$data = array(
			'id_kategori' => $input['kategori'],
			'role' => $input['role']
		);
		$input_role = $this->MasterData->inputData($data,'role');

		if ($input_role) {
			$sess['alert_role'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data role user berhasil ditambahkan.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/roleUser/true');
		}else{
			$sess['alert_role'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah role user gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/roleUser/true');
		}
	}

	public function updateRole($value=''){
		$input = $this->input->POST();

		$data = array(
			'id_kategori' => $input['kategori'],
			'role' => $input['role']
		);
		$where = "id_role = '$input[id_role]'";
		$update_info = $this->MasterData->editData($where,$data,'role');

		if ($update_info) {
			$sess['alert_role'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data role user berhasil diupdate.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/roleUser/true');
		}else{
			$sess['alert_role'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update role user gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/roleUser/true');
		}
	}

	public function hapusRole($value=''){
		$id_role = $this->input->POST('id_role');

		$where = "id_role = '$id_role'";
		$hapus_role = $this->MasterData->deleteData($where,'role');

		if ($hapus_role) {
			echo 'Success';
		}else{
			echo 'Gagal';
		}
	}

	// ========================================================


	// Nomor Darurat ==========================================
	public function nomorDarurat($sess=''){
		$data['id_nav'] = 6;

		if ($sess == '') {
			$this->session->unset_userdata('alert_nomor');
		}

		$data['kategori'] =$this->MasterData->getData('kategori')->result();

		$select = '*';
		$table = array(
			'nomor_darurat nom',
			'kategori ktg'
		);
		$where = "nom.id_kategori = ktg.id_kategori";
		$by = 'id_nomor_darurat';
		$order = 'DESC';
		$data['nomor'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		$this->load->view('Admin/header');
		$this->load->view('Admin/navigation', $data);
		$this->load->view('Admin/nomor_darurat', $data);
		$this->load->view('Admin/footer');
	}

	public function simpanNomor($value=''){
		$input = $this->input->POST();

		$data = array(
			'id_kategori' => $input['kategori'],
			'nomor' => $input['nomor'],
			'alamat' => $input['alamat']
		);
		$input_nomor = $this->MasterData->inputData($data,'nomor_darurat');

		if ($input_nomor) {
			$sess['alert_nomor'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data nomor darurat berhasil ditambahkan.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/nomorDarurat/true');
		}else{
			$sess['alert_nomor'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Tambah nomor darurat gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/nomorDarurat/true');
		}
	}

	public function updateNomor($value=''){
		$input = $this->input->POST();

		$data = array(
			'id_kategori' => $input['kategori'],
			'nomor' => $input['nomor'],
			'alamat' => $input['alamat']
		);
		$where = "id_nomor_darurat = '$input[id_nomor_darurat]'";
		$update_nomor = $this->MasterData->editData($where,$data,'nomor_darurat');

		if ($update_nomor) {
			$sess['alert_nomor'] = '<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Success!!</b> Data nomor darurat berhasil diupdate.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/nomorDarurat/true');
		}else{
			$sess['alert_nomor'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <b>Update nomor darurat gagal!!</b> Silahkan coba lagi.
                              </div>';
			$this->session->set_userdata($sess);
			redirect(base_url().'Admin/nomorDarurat/true');
		}
	}

	public function hapusNomor($value=''){
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


	// Slider Aplikasi ========================================
	public function sliderApp($sess=''){
		$data['id_nav'] = 7;

		if ($sess == '') {
			$this->session->unset_userdata('alert_slider');
		}

		$table = 'slider';
		$order = 'id_slider';
		$data['slider'] = $this->MasterData->getDataDesc($table, $order)->result();
		$this->load->view('Admin/header');
		$this->load->view('Admin/navigation', $data);
		$this->load->view('Admin/slider', $data);
		$this->load->view('Admin/footer');
	}

	public function simpanSlider($value=''){
		$input = $this->input->POST();

		$config['upload_path']          = './assets/path_slider';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 1000;
		$config['overwrite']			= true;
		$config['file_name']			= $input['nama_slider'];
		// $config['space_remove']			= true;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;
		// $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
 
		$this->load->library('upload', $config);

		if ($this->input->POST()) {
			if ($this->upload->do_upload('gambar')){
				$data_file = $this->upload->data();

				$data = array(
					'nama_slider' => $input['nama_slider'],
					'file_slider' => $data_file['file_name']
				);
				$input_slider = $this->MasterData->inputData($data,'slider');

				if ($input_slider) {
					$sess['alert_slider'] = '<div class="alert alert-success alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Success!!</b> Data slider berhasil ditambahkan.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Admin/sliderApp/true');
				}else{
					$sess['alert_slider'] = '<div class="alert alert-danger alert-dismissible" role="alert">
		                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                <b>Tambah slider gagal!!</b> Silahkan coba lagi.
		                              </div>';
					$this->session->set_userdata($sess);
					redirect(base_url().'Admin/sliderApp/true');
				}
			}
		}
	}

	public function updateSlider($value=''){
		$input = $this->input->POST();

		$select = 'file_slider';
		$where = "id_slider = '$input[id_slider]'";
		$files = $this->MasterData->getWhereData($select,'slider',$where)->row()->file_slider;
		// var_dump($files);exit();
		$config['upload_path']          = './assets/path_slider';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 1000;
		$config['overwrite']			= true;
		$config['file_name']			= $input['nama_slider'];
		// $config['space_remove']			= true;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;
		// $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

		if ($this->input->POST()) {
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('gambar')){
				unlink(APPPATH.'../assets/path_slider/'.$files);
				$data_file = $this->upload->data();

				$data = array(
					'nama_slider' => $input['nama_slider'],
					'file_slider' => $data_file['file_name']
				);
			}else{
				$data = array(
					'nama_slider' => $input['nama_slider']
				);
			}

			$where = "id_slider = '$input[id_slider]'";
			$update_slider = $this->MasterData->editData($where,$data,'slider');

			if ($update_slider) {
				$sess['alert_slider'] = '<div class="alert alert-success alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Success!!</b> Data slider berhasil diupdate.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Admin/sliderApp/true');
			}else{
				$sess['alert_slider'] = '<div class="alert alert-danger alert-dismissible" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                <b>Update slider gagal!!</b> Silahkan coba lagi.
	                              </div>';
				$this->session->set_userdata($sess);
				redirect(base_url().'Admin/sliderApp/true');
			}
		}
	}

	public function hapusSlider($value=''){
		$id_slider = $this->input->POST('id_slider');

		$select = 'file_slider';
		$where = "id_slider = '$id_slider'";
		$files = $this->MasterData->getWhereData($select,'slider',$where)->row()->file_slider;

		$where = "id_slider = '$id_slider'";
		$hapus_slider = $this->MasterData->deleteData($where,'slider');

		if ($hapus_slider) {
			unlink(APPPATH.'../assets/path_slider/'.$files);
			echo 'Success';
		}else{
			echo 'Gagal';
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
