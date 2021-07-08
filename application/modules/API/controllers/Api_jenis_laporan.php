<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Api_jenis_laporan extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        echo "Api log_lapor";
    }
    
     public function tampil_jenis_laporan()
     {
        $id_kategori = $this->input->get('id_kategori');
        
        $tampil = $this->db->query("SELECT * FROM jenis_laporan WHERE id_kategori = '$id_kategori'")->result();
         echo json_encode($tampil);
     }


}

?>