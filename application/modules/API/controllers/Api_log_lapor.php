<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Api_log_lapor extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        echo "Api log_lapor";
    }
    
     public function tampil_log_lapor()
     {
        $nama_kategori = $this->input->get('nama_kategori');
        $offset = $this->input->get('offset');
        $jumlah = $this->input->get('jumlah');
        
        $tampil = $this->db->query("SELECT log_lapor.*,users.nama as nama_petugas,kategori.id_kategori, kategori.nama_kategori,lapor.alamat FROM log_lapor JOIN lapor on lapor.id_lapor = log_lapor.id_lapor JOIN kategori on kategori.id_kategori = lapor.id_kategori join users on users.id_user = log_lapor.id_user WHERE kategori.nama_kategori = '$nama_kategori' order by log_lapor.waktu_proses 
            DESC LIMIT $offset,$jumlah")->result();
         
        echo json_encode($tampil);
     }

//=========Untuk masing - masing admin=================
    public function tampil_log_lapor_admin()
     {
        $nama_kategori = $this->input->get('nama_kategori');
        
        $tampil = $this->db->query("SELECT log_lapor.*,users.nama as nama_petugas,kategori.id_kategori, kategori.nama_kategori,lapor.alamat FROM log_lapor JOIN lapor on lapor.id_lapor = log_lapor.id_lapor JOIN kategori on kategori.id_kategori = lapor.id_kategori join users on users.id_user = log_lapor.id_user WHERE kategori.nama_kategori = '$nama_kategori'")->result();
         echo json_encode($tampil);
     }


    public function input_foto_kejadian()
    {
        $date = new DateTime('now');  

        $foto_laporan = "";

        $foto_kejadian_encode = $this->input->post('foto_kejadian');

        $foto = explode(",", $foto_kejadian_encode);

        for ($i=0; $i < count($foto)-1; $i++) { 

            $foto_kejadian = $date->format('ddMMyyyyHis').rand().'kejadian'.$i.'.jpg';
            //nama foto fix
            $foto_laporan = $foto_laporan.$foto_kejadian.",";
        }


        $id_log = $this->input->post('id_log');
        $keterangan = $this->input->post('keterangan');

        $cek_rows = $this->db->query("SELECT * FROM log_lapor WHERE id_log = '$id_log'")->num_rows();
        $cek_foto = $this->db->query("SELECT * FROM log_lapor WHERE id_log = '$id_log'")->row();

        $response = array();
        
        $nama_foto = explode(",", $foto_laporan);

        for ($i=0; $i < count($nama_foto)-1; $i++) { 

            file_put_contents('./assets/path_kejadian/'.$nama_foto[$i], base64_decode($foto[$i]));
        }

        $update = $this->db->query("UPDATE log_lapor SET foto_kejadian = '$foto_laporan', 
                                    keterangan = '$keterangan' WHERE id_log = '$id_log'");
                
            if($update)
            {

                $response = array('response' => 1);
                echo json_encode($response);
            }
            else
            {
                $response = array('response' => 0 );

                echo json_encode($response);
            }

    }


    public function input_log_lapor()
    {
        $date = new DateTime('now');  

        $foto_laporan = "";

        $foto_kejadian_encode = $this->input->post('foto_kejadian');

        $foto = explode(",", $foto_kejadian_encode);

        for ($i=0; $i < count($foto)-1; $i++) { 

            $foto_kejadian = $date->format('ddMMyyyyHis').rand().'kejadian'.$i.'.jpg';
            //nama foto fix
            $foto_laporan = $foto_laporan.$foto_kejadian.",";
        }


        $id_lapor = $this->input->post('id_lapor');
        $id_user = $this->input->post('id_user');
        $waktu_proses = $this->input->post('waktu_proses');
        $waktu_selesai = $this->input->post('waktu_selesai');
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');

        $data = array('id_lapor' => $id_lapor,
                        'id_user' => $id_user,
                        'waktu_proses' => $waktu_proses,
                        'waktu_selesai' => $waktu_selesai,
                        'status' => $status,
                        'foto_kejadian' => $foto_laporan, 
                        'keterangan' => $keterangan );

        $input = $this->db->insert('log_lapor',$data);

        $response = array();
        
        $nama_foto = explode(",", $foto_laporan);

        for ($i=0; $i < count($nama_foto)-1; $i++) { 

            file_put_contents('./assets/path_kejadian/'.$nama_foto[$i], base64_decode($foto[$i]));
        }
 
            if($input)
            {
                $response = array('response' => 1);
                echo json_encode($response);
            }
            else
            {
                $response = array('response' => 0 );

                echo json_encode($response);
            }

    }

}

?>