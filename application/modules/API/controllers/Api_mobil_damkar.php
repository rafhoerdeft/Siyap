<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Api_mobil_damkar extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        echo "Api Mobil Damkar";
    }


    public function Get_Mobil_Damkar()
    {
        $data = json_decode(file_get_contents('php://input'));
        $id_regu = $data->id_regu;

        $mobil = $this->db->query("SELECT * FROM mobil_damkar mobil
                                JOIN regu_damkar regu ON regu.id_wmk = mobil.id_wmk
                                WHERE regu.id_regu = $id_regu")->result();
        $results = array(
            'response' => 1,
            'data'      => $mobil,
            'pesan' => "Berhasil mengambil data."
      );
        echo json_encode($results);
    }

    public function Get_User_Damkar()
    {
        $data = json_decode(file_get_contents('php://input'));
        $id_regu = $data->id_regu;

        // $user = $this->db->query('SELECT id_user,id_role,nama FROM users WHERE id_role=1')->result();
        $user = $this->db->query("SELECT u.* FROM users u WHERE u.id_regu IN 
                                (SELECT r.id_regu FROM regu_damkar r WHERE r.id_wmk=
                                (SELECT sub_r.id_wmk FROM regu_damkar sub_r WHERE sub_r.id_regu= $id_regu))")->result();
        $results = array(
            'response' => 1,
            'data'      => $user,
            'pesan' => "Berhasil mengambil data."
      );
        echo json_encode($results);
    }

    public function Get_Mobil_Damkar_Item()
    {
        
        $item = $this->db->query('SELECT 
                            mobil.id_mobil_item,
                            mobil.id_mobil,
                            mobil.id_item,
                            item.nama_item,
                            item.satuan_item,
                            mobil.jml_item
                            FROM mobil_item_damkar mobil 
                            JOIN item_damkar item 
                            ON mobil.id_item = item.id_item')->result();

                            $results = array(
                                'response' => 1,
                                'data'      => $item,
                                'pesan' => "Berhasil mengambil data."
                          );

        echo json_encode($results);

    }

    public function Get_Piket()
    {
        
        $data = json_decode(file_get_contents('php://input'));
        $id_mobil = $data->id_mobil;

        

        $piket = $this->db->query("SELECT piket.id_piket,
        piket.id_user,
        user.nama,
        piket.tgl_piket,
        piket.id_mobil,
        mobil.nama_mobil,
        mobil.no_plat_mobil
        FROM piket_damkar piket
        JOIN users user
        ON piket.id_user = user.id_user
        JOIN mobil_damkar mobil
        ON piket.id_mobil = mobil.id_mobil
        WHERE piket.id_mobil = $id_mobil
        AND (DATE(piket.tgl_piket) = (SELECT DATE(SUBDATE(NOW(),1))) 
        OR DATE(piket.tgl_piket) = (SELECT DATE(SUBDATE(NOW(),0))))")->result();

        // $piket = $this->db->query('SELECT piket.id_piket,
        //                         piket.id_user,
        //                         user.nama,
        //                         piket.tgl_piket,
        //                         piket.id_mobil,
        //                         mobil.nama_mobil,
        //                         mobil.no_plat_mobil
        //                         FROM piket_damkar piket
        //                         JOIN users user
        //                         ON piket.id_user = user.id_user
        //                         JOIN mobil_damkar mobil
        //                         ON piket.id_mobil = mobil.id_mobil')->result();

                    $results = array(
                        'response' => 1,
                        'data'      => $piket,
                        'pesan' => "Berhasil mengambil data."
                  );
        echo json_encode($results);
    }

    public function Get_Berita_Acara()
    {
        $berita = $this->db->query('SELECT id_berita_acara,
                                id_piket,
                                jml_kebakaran,
                                jml_bencana_lain,
                                jml_ambil_sarang_tawon,
                                jml_ambil_ular_lain,
                                kondisi_mobil,
                                kondisi_peralatan_lain
                                FROM berita_acara_damkar')->result();
                    $results = array(
                        'response' => 1,
                        'data'      => $berita,
                        'pesan' => "Berhasil mengambil data."
                  );
        echo json_encode($results);
    }

    public function Get_Cek_Mobil_Item()
    {
        $items = $this->db->query('SELECT id_cek,
                                id_mobil_item,
                                id_piket,
                                cek,
                                keterangan_cek,
                                tgl_cek
                                FROM cek_mobil_item_damkar')->result();
                        $results = array(
                            'response' => 1,
                            'data'      => $items,
                            'pesan' => "Berhasil mengambil data."
                      );
        echo json_encode($results);
    }

    public function Input_Piket()
    {
        $data = json_decode(file_get_contents('php://input'));
        $id_user = $data->id_user;
        $tgl_piket = $data->tgl_piket;
        $id_mobil = $data->id_mobil;

        // $id_user = $this->input->post('id_user');
        // $tgl_piket = $this->input->post('tgl_piket');
        // $id_mobil = $this->input->post('id_mobil');

        $data = array('id_user' => $id_user,
                        'tgl_piket'=>$tgl_piket,
                        'id_mobil' => $id_mobil
                    );

        $response = array();

        $insert = $this->db->insert('piket_damkar',$data);
        
	        if($insert)
	        {
	            json_encode($insert);
				$lastId = $this->db->insert_id();
	        
	            $response = array('response' => 1,
                                    'pesan' => 'Berhasil Input Data',
	                                'id_user' =>$id_user,
	                                'tgl_piket' => $tgl_piket,
	                                'id_mobil' => $id_mobil,
	                                'lastId' => $lastId );

	            echo json_encode($response);
	        }
	        else
	        {
	            $response = array('response' => 0, 
                                    'pesan' =>'Gagal Mengambil Data');

	            echo json_encode($response);
	        }
	
    }

    public function Input_Berita_Acara()
    {
        $id_piket = $this->input->post('id_piket');
        $jml_kebakaran = $this->input->post('jml_kebakaran');
        $jml_bencana_lain = $this->input->post('jml_bencana_lain');
        $jml_ambil_sarang_tawon = $this->input->post('jml_ambil_sarang_tawon');
        $jml_ambil_ular_lain = $this->input->post('jml_ambil_ular_lain');
        $kondisi_mobil = $this->input->post('kondisi_mobil');
        $kondisi_peralatan_lain = $this->input->post('kondisi_peralatan_lain');

        $data = array('id_piket' => $id_piket,
                        'jml_kebakaran'=>$jml_kebakaran,
                        'jml_bencana_lain'=>$jml_bencana_lain,
                        'jml_ambil_sarang_tawon'=>$jml_ambil_sarang_tawon,
                        'jml_ambil_ular_lain'=>$jml_ambil_ular_lain,
                        'kondisi_mobil'=>$kondisi_mobil,
                        'kondisi_peralatan_lain' => $kondisi_peralatan_lain
                    );

        $response = array();

        $insert = $this->db->insert('berita_acara_damkar',$data);
        
	        if($insert)
	        {
	            json_encode($insert);
				$lastId = $this->db->insert_id();
	        
	            $response = array('response' => 1,
                                    'pesan' => 'Berhasil Input Data',
	                                'id_piket' =>$id_piket,
	                                'jml_kebakaran' => $jml_kebakaran,
	                                'jml_bencana_lain' => $jml_bencana_lain,
                                    'jml_ambil_sarang_tawon' => $jml_ambil_sarang_tawon,
                                    'jml_ambil_ular_lain' => $jml_ambil_ular_lain,
                                    'kondisi_mobil' => $kondisi_mobil,
                                    'kondisi_peralatan_lain' => $kondisi_peralatan_lain,
	                                'lastId' => $lastId );

	            echo json_encode($response);
	        }
	        else
	        {
	            $response = array('response' => 0,
                                    'pesan' =>'Gagal Mengambil Data');

	            echo json_encode($response);
	        }
	
    }

    public function Input_Cek_Item_Mobil()
    {
        $id_mobil_item = $this->input->post('id_mobil_item');
        $id_piket = $this->input->post('id_piket');
        $cek = $this->input->post('cek');
        $keterangan_cek = $this->input->post('keterangan_cek');
        $tgl_cek = $this->input->post('tgl_cek');

        $data = array('id_mobil_item' => $id_mobil_item,
                        'id_piket'=>$id_piket,
                        'cek'=>$cek,
                        'keterangan_cek'=>$keterangan_cek,
                        'tgl_cek'=>$tgl_cek
                    );

        $response = array();

        $insert = $this->db->insert('cek_mobil_item_damkar',$data);
        
	        if($insert)
	        {
	            json_encode($insert);
				$lastId = $this->db->insert_id();
	        
	            $response = array('response' => 1,
                                    'pesan' => 'Berhasil Input Data',
	                                'lastId' => $lastId );

	            echo json_encode($response);
	        }
	        else
	        {
	            $response = array('response' => 0,
                                    'pesan' =>'Gagal Mengambil Data');

	            echo json_encode($response);
	        }
	
    }



}
?>