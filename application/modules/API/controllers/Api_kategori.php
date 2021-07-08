<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Api_kategori extends CI_Controller {

    function __construct() {
        parent::__construct();
        
         
    }

    function index() {
        echo "Api kategori";
    
    }

  public function tampil_kategori()
  {
    $nama_kategori = $this->input->get('nama_kategori');
    $kategori = $this->db->query("SELECT * FROM kategori WHERE nama_kategori like '%$nama_kategori%' AND tampil = 'true'")->result();
    echo json_encode($kategori);
  }
  

  public function getAddress()
  {
    $respon = array('asd' => 1,
                    'as' =>2,
                    'data'=> array('asd' => 1,
                    'as' =>2 ) );

     echo json_encode($respon);
  }

  function callAPI($method, $url, $data){
   $curl = curl_init();

   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'APIKEY: 111111111111111111111',
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}

}
?>