<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('MasterData');
		$this->load->library('session');
		$this->load->helper('text');
		$this->load->helper('encrypt');
		$this->load->model('M_berita');
		date_default_timezone_set('Asia/Jakarta');
		$this->get_visitor();
	}

	public function index_old()
	{
		$data['id_nav'] = 1;

		$select = 'count(usr.id_user) jml_user';
		$table = array(
			'users usr',
			'role'
		);
		// $data['jml_user'] = $this->MasterData->getSelectData($select,$table)->row()->jml_user;
		$where = "usr.id_role = role.id_role AND role = 'User'";
		$data['jml_user'] = $this->MasterData->getWhereData($select, $table, $where)->row()->jml_user;
		$this->load->view('Dashboard/header');
		$this->load->view('Dashboard/navigation', $data);
		$this->load->view('Dashboard/dashboard', $data);
		$this->load->view('Dashboard/footer');
	}

	public function index($kategori = 'Damkar')
	{
		$data['id_nav'] = 1;

		$thn = $this->input->GET('tahun');
		if ($thn == '') {
			$thn = date('Y');
		}

		$table = array(
			'lapor lap',
			'kategori ktg'
		);

		$select = array(
			'MONTH(lap.tgl_lapor) AS bulan',
			'WEEK(lap.tgl_lapor) AS minggu',
			'COUNT(lap.id_lapor) AS jml_lap'
		);
		$where = "lap.id_kategori = ktg.id_kategori AND
			    ktg.nama_kategori = '$kategori' AND
			    YEAR(lap.tgl_lapor) = '$thn'";
		$group = "MONTH(lap.tgl_lapor), WEEK(lap.tgl_lapor)";
		$by = "MONTH(lap.tgl_lapor), WEEK(lap.tgl_lapor)";
		$order = 'ASC';
		$data['lap_per_minggu'] = $this->MasterData->getWhereDataGroupOrder($select, $table, $group, $by, $order, $where)->result();

		$select = array(
			'MONTH(lap.tgl_lapor) AS bulan',
			'COUNT(lap.id_lapor) AS jml_lap'
		);
		$group = "MONTH(lap.tgl_lapor)";
		$by = "MONTH(lap.tgl_lapor)";
		$order = 'ASC';
		$data_lap = $this->MasterData->getWhereDataGroupOrder($select, $table, $group, $by, $order, $where)->result();

		if ($data_lap == null || $data_lap == '') {
			$data['data_lap'] = "Kosong";
		} else {
			$data['data_lap'] = $data_lap;
		}
		$data['tahun'] = $thn;

		$select = "YEAR(tgl_lapor) thn";
		$group = "YEAR(tgl_lapor)";
		$by = "YEAR(tgl_lapor)";
		$order = 'ASC';
		$data['data_thn'] = $this->MasterData->getDataGroupOrder($select, 'lapor', $group, $by, $order)->result();

		$data['menu'] = $this->MasterData->getData('kategori')->result();
		$data['kategori'] = $kategori;
		$this->load->view('Dashboard/header');
		$this->load->view('Dashboard/navigation', $data);
		$this->load->view('Dashboard/dashboard_leaf', $data);
		$this->load->view('Dashboard/footer');
	}

	public function dataLap($value = '')
	{
		$id_lap = $this->input->POST('id_lap');
		$kategori = $this->input->POST('kategori');

		$select = array(
			'lpr.tgl_lapor',
			'(SELECT usr.nama FROM users usr WHERE lpr.id_user = usr.id_user) nama_user'
		);
		$table = array(
			'kategori ktg',
			'lapor lpr'
		);
		$where = "lpr.id_kategori = ktg.id_kategori AND ktg.nama_kategori = '$kategori' AND lpr.id_lapor = '$id_lap'";
		$data = $this->MasterData->getWhereData($select, $table, $where)->row();
		echo json_encode($data);
		// $data['histori'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('status');
		session_destroy();
		redirect('login');
	}

	// ========================================================new interface================================================================

	public function home()
	{
		$data = [
			'visitor' => $this->M_berita->stat_visitor(),
			'berita' => $this->db->from('laporan_damkar ld')
				->join('lapor l', 'ld.id_lapor = l.id_lapor')
				->join('log_lapor ll', 'l.id_lapor = ll.id_lapor')
				->order_by('l.tgl_lapor', 'desc')->limit(5)->get()->result(),
			'content' => 'new_home',
			'active_menu' => 1,
		];
		$this->load->view('new_main', $data);
	}

	public function berita()
	{
		$cmdcari              =   $this->input->post('searchButton');
		if ($cmdcari) {
			$this->session->set_userdata('cari', $this->input->post('keyword'));
			$kunci  =   $this->input->post('keyword');
		} else {
			$kunci          =   $this->session->userdata('cari');
		}
		$key        =   $kunci;

		$this->load->helper('global');
		$limit    = 9;
		$offset   = 0;

		if (!empty($this->input->get('per_page')))
			$offset = $this->input->get('per_page');

		$data['keyword']        =  $kunci;
		$data['list_count']     = $this->M_berita->get_berita(true, null, null, $key);
		$data['berita']    		= $this->M_berita->get_berita(false, $limit, $offset, $key);
		$data['paging']         = SET_Pagination(base_url('Dashboard/berita'), $data['list_count'], $limit);
		$data['offset']         = $offset;

		$data['visitor'] 		= $this->M_berita->stat_visitor();
		$data['content']		= 'new_blog';
		$data['active_menu'] 	= 2;

		$this->load->view('new_main', $data);
	}

	public function detail_berita($id)
	{
		$data['laporan'] = $this->db->from('laporan_damkar ld')
			->join('lapor l', 'ld.id_lapor = l.id_lapor')
			->join('log_lapor ll', 'l.id_lapor = ll.id_lapor')
			->where('id_laporan_damkar', decode($id))
			->get()->row();

		$data['recent'] = $this->db->from('laporan_damkar ld')
			->join('lapor l', 'ld.id_lapor = l.id_lapor')
			->join('log_lapor ll', 'l.id_lapor = ll.id_lapor')
			->where('id_laporan_damkar !=' . decode($id))
			->limit(3)
			->get()->result();

		$foto = explode(",", $data['laporan']->foto_kejadian);

		$data['meta'] = [
			'title' => $data['laporan']->penyebab_kejadian,
			'image' => $foto[0]
		];

		$data['lightbox'] = true;

		$data['visitor'] 		= $this->M_berita->stat_visitor();
		$data['content'] = 'blog_detail';
		$data['active_menu'] 	= 2;

		$this->load->view('new_main', $data);
	}

	public function peta()
	{
		$kategori = 'Damkar';
		$data['kategori'] = $kategori;

		$data['visitor'] 		= $this->M_berita->stat_visitor();
		$data['map'] = true;
		$data['fancybox'] = true;
		$data['content'] = 'new_peta';
		$data['active_menu'] 	= 3;

		$this->load->view('new_main', $data);
	}

	public function statistik()
	{
		$kategori = 'Damkar';

		$thn = $this->input->GET('tahun');
		if ($thn == '') {
			$thn = date('Y');
		}

		$table = array(
			'lapor lap',
			'kategori ktg'
		);

		$select = array(
			'MONTH(lap.tgl_lapor) AS bulan',
			'WEEK(lap.tgl_lapor) AS minggu',
			'COUNT(lap.id_lapor) AS jml_lap'
		);
		$where = "lap.id_kategori = ktg.id_kategori AND
			    ktg.nama_kategori = '$kategori' AND
			    YEAR(lap.tgl_lapor) = '$thn'";
		$group = "MONTH(lap.tgl_lapor), WEEK(lap.tgl_lapor)";
		$by = "MONTH(lap.tgl_lapor), WEEK(lap.tgl_lapor)";
		$order = 'ASC';
		$data['lap_per_minggu'] = $this->MasterData->getWhereDataGroupOrder($select, $table, $group, $by, $order, $where)->result();

		$select = array(
			'MONTH(lap.tgl_lapor) AS bulan',
			'COUNT(lap.id_lapor) AS jml_lap'
		);
		$group = "MONTH(lap.tgl_lapor)";
		$by = "MONTH(lap.tgl_lapor)";
		$order = 'ASC';
		$data_lap = $this->MasterData->getWhereDataGroupOrder($select, $table, $group, $by, $order, $where)->result();

		if ($data_lap == null || $data_lap == '') {
			$data['data_lap'] = "Kosong";
		} else {
			$data['data_lap'] = $data_lap;
		}
		$data['tahun'] = $thn;

		$select = "YEAR(tgl_lapor) thn";
		$group = "YEAR(tgl_lapor)";
		$by = "YEAR(tgl_lapor)";
		$order = 'ASC';
		$data['data_thn'] = $this->MasterData->getDataGroupOrder($select, 'lapor', $group, $by, $order)->result();

		$data['visitor'] 		= $this->M_berita->stat_visitor();
		$data['content'] = 'new_statistik';
		$data['active_menu'] 	= 4;

		$this->load->view('new_main', $data);
	}

	function get_visitor()
	{
		$ip = $this->input->ip_address();
		$check = $this->db->get_where('visitor', [
			'ip' => $ip,
			'tanggal' => date('Y-m-d')
		]);
		if ($check->num_rows() > 0) {
			$hits = (int)$check->row('hits') + 1;
			$this->db->where('id', $check->row('id'))->update('visitor', ['hits' => $hits]);
		} else {
			$this->db->insert('visitor', [
				'ip' => $ip,
				'tanggal' => date('Y-m-d'),
				'hits' => 1
			]);
		}
	}
}
