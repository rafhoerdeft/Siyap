<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Api_info extends CI_Controller {

    function __construct() {
        parent::__construct();
        
         
    }

    function index() {
        echo "Api info";
    
    }

  public function tampil_info()
  {
    $info = $this->db->query("SELECT * FROM informasi_app")->result();
    echo json_encode($info);
  }


  public function info_versi()
  {
    $info = $this->db->query("SELECT judul_info FROM informasi_app WHERE 
    							kategori_info = 'Update' ORDER BY tanggal_info DESC")->row();
    
    $respon = array('judul_info' =>$info->judul_info );
    echo json_encode($respon);
  }


    public function tampil_nomor()
  {
    $tampil_nomor = $this->db->query("SELECT nomor_darurat.*,kategori.nama_kategori as kategori FROM nomor_darurat JOIN kategori ON kategori.id_kategori = nomor_darurat.id_kategori")->result();
    echo json_encode($tampil_nomor);
  }

  public function tampil_slider()
  {
	    $tampil_slider = $this->db->query("SELECT * FROM slider")->result();
	    echo json_encode($tampil_slider);
  }
  


}
?>