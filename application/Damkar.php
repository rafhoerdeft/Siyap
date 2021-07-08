<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Damkar extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('MasterData');
		$this->load->library('session');
		if ($this->session->userdata('role')!= "Operator Damkar") {
			redirect('Login/index');
		}
		date_default_timezone_set('Asia/Jakarta');
		$login_id = $this->session->userdata('id_user');
    }

	public function index_old(){
		$data['id_nav'] = 1;

		$select = 'count(usr.id_user) jml_user';
		$table = array(
			'users usr',
			'role'
		);
		// $data['jml_user'] = $this->MasterData->getSelectData($select,$table)->row()->jml_user;
		$where = "usr.id_role = role.id_role AND role = 'User'";
		$data['jml_user'] = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_user;
		$this->load->view('Damkar/header');
		$this->load->view('Damkar/navigation', $data);
		$this->load->view('Damkar/dashboard', $data);
		$this->load->view('Damkar/footer');
	}

	public function index($value=''){
		$data['id_nav'] = 2;

		$this->load->view('Damkar/header');
		$this->load->view('Damkar/navigation', $data);
		$this->load->view('Damkar/track_damkar', $data);
		$this->load->view('Damkar/footer');
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

		$data = $this->db->query("SELECT *, (SELECT usr.nama FROM users usr WHERE lap.id_user = usr.id_user) AS nama_user FROM lapor lap LEFT JOIN laporan_damkar ld ON lap.id_lapor = ld.id_lapor WHERE lap.id_lapor = '$id'")->row();

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
		//     ktg.nama_kategori = 'Damkar'

		$select = array(
			'lpr.*',
			'(SELECT usr.nama FROM users usr WHERE lpr.id_user = usr.id_user) nama_user'
		);
		$table = array(
			'kategori ktg',
			'lapor lpr'
		);
		$where = "lpr.id_kategori = ktg.id_kategori AND ktg.nama_kategori = 'Damkar'";
		$order = 'DESC';
		$by = 'lpr.id_lapor';
		// $data['histori'] = $this->MasterData->getWhereData($select,$table,$where)->result();
		$data['histori'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		$this->load->view('Damkar/header');
		$this->load->view('Damkar/navigation', $data);
		$this->load->view('Damkar/histori', $data);
		$this->load->view('Damkar/footer');
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
		redirect(base_url().'Damkar/historiAduan');
	}

	public function cetakLap($id=''){
		$data['laporan'] = $this->db->query("SELECT *, (SELECT usr.nama FROM users usr WHERE lap.id_user = usr.id_user) AS nama_user FROM lapor lap LEFT JOIN laporan_damkar ld ON lap.id_lapor = ld.id_lapor WHERE lap.id_lapor = '$id'")->row();

		// var_dump($data);exit();
		
		$this->load->library('pdf');
		$this->load->view('Damkar/cetak_laporan',$data);
	}

	public function userApp($value=''){
		$data['id_nav'] = 4;

		// SELECT usr.* FROM users usr, role WHERE usr.id_role = role.id_role AND role.role LIKE '%Damkar%'

		$where = "role like '%Damkar%'";
		$data['role'] = $this->MasterData->getWhereDataAll('role',$where)->result();

		$select = array(
			'usr.*',
			'role.*'
		);
		$table = array(
			'users usr',
			'role'
		);
		$where = "usr.id_role = role.id_role AND role.role LIKE '%Damkar%'";
		$order = 'DESC';
		$by = 'usr.id_user';
		$data['user'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		$this->load->view('Damkar/header');
		$this->load->view('Damkar/navigation', $data);
		$this->load->view('Damkar/user_app', $data);
		$this->load->view('Damkar/footer');
	}

	public function simpanUser($value=''){
		$input = $this->input->POST();

		$data = array(
			'id_role' => $input['role_user'],
			'password' => $input['password'],
			'nama' => $input['nama_user'],
			'jenis_kelamin' => $input['jk_user'],
			'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
			'alamat' => $input['almt_user'],
			'no_hp' => $input['no_hp']
		);
		$input_user = $this->MasterData->inputData($data,'users');

		if ($input_user) {
			redirect(base_url().'Damkar/userApp');
		}else{
			alert('Tambah user gagal!! Silahkan coba lagi.');
			redirect(base_url().'Damkar/userApp');
		}
	}

	public function updateUser($value=''){
		$input = $this->input->POST();

		if ($input['password'] == '' || $input['password'] == null) {
			$data = array(
				'id_role' => $input['role_user'],
				'nama' => $input['nama_user'],
				'jenis_kelamin' => $input['jk_user'],
				'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
				'alamat' => $input['almt_user'],
				'no_hp' => $input['no_hp']
			);
		}else{
			$data = array(
				'id_role' => $input['role_user'],
				'password' => md5($input['password']),
				'nama' => $input['nama_user'],
				'jenis_kelamin' => $input['jk_user'],
				'tgl_lahir' => date('Y-m-d', strtotime($input['tgl_lhr'])),
				'alamat' => $input['almt_user'],
				'no_hp' => $input['no_hp']
			);
		}
		
		$where = "id_user = '$input[id_user]'";
		$update_user = $this->MasterData->editData($where,$data,'users');

		if ($update_user) {
			redirect(base_url().'Damkar/userApp');
		}else{
			alert('Update user gagal!! Silahkan coba lagi.');
			redirect(base_url().'Damkar/userApp');
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
