<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('MasterData');
		$this->load->library('session');
    }

	public function index(){
		$this->session->sess_destroy();
		$this->load->view('Login');
	}

	public function cek_login() {
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$pass = md5($password);
		// $where = array(
		// 			'username' => $username,
		// 			'password' => md5($password)
		// 		);
		$where = "username = '$username' AND password = '$pass' OR no_hp = '$username' AND password = '$pass'";
		$hasil = $this->MasterData->getWhereDataAll('users',$where);
		// var_dump($hasil);
		if ($hasil->num_rows() == 1) {
			$id_role = $hasil->row()->id_role;

			$where = "id_role = $id_role";
			$dataRole = $this->MasterData->getWhereDataAll('role',$where)->row();
			$role = $dataRole->role;
			$id_kategori = $dataRole->id_kategori;
			
			foreach ($hasil->result() as $users) {
				$sess_data['id_user'] = $hasil->row()->id_user;
				$sess_data['nama_user'] = $hasil->row()->nama;
				$sess_data['username'] = $hasil->row()->username;
				$sess_data['id_kategori'] = $id_kategori;
				$sess_data['role'] = $role;
				$this->session->set_userdata($sess_data);
			}
			
			if ($id_kategori == null || $id_kategori == '') {
				echo "Admin";
			}else{
				$ptgs = strtok($role, " "); //untuk mengambil kata pertama
				if ($ptgs == 'Petugas') {
					echo "Gagal";
				}else{
					$where = "id_kategori = '$id_kategori'";
					$kategori = $this->MasterData->getWhereDataAll('kategori',$where)->row()->nama_kategori;
					echo $kategori;
				}
			}	
		}
		else {
			echo "Gagal";
		}
	}

	public function logout(){
		// Hapus semua data pada session
		$this->session->sess_destroy();

		// redirect ke halaman login	
		redirect('Login/index');
	}

}
