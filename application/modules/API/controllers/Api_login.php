<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Api_login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        echo "Api Login";
    }


    public function Login_Baru()
    {
        
            $data = json_decode(file_get_contents('php://input'));

            $no_hp = $data->no_hp;
            $pass = md5($data->password);
            
            $result = array();
            $cek_no_hp = $this->db->query("SELECT users.nama,users.email,users.no_hp,users.id_role,users.id_user,users.id_regu,
                                            kategori.nama_kategori,kategori.id_kategori,
                                            role.role FROM users JOIN role ON users.id_role = role.id_role JOIN 
                                            kategori ON kategori.id_kategori = role.id_kategori WHERE no_hp = $no_hp");
            
            if($cek_no_hp->num_rows() > 0)//ada data
            {

              $cek_password = $this->db->query("SELECT users.nama,users.email,users.no_hp,users.id_role,users.id_user,users.id_regu,
                                                kategori.nama_kategori,kategori.id_kategori,
                                                role.role FROM users JOIN role ON users.id_role = role.id_role 
                                                JOIN kategori ON kategori.id_kategori = role.id_kategori
                                                WHERE
                                                    no_hp = '$no_hp'
                                                AND password = '$pass'");

              if($cek_password->num_rows() > 0)//login succes
              {
                $user = $cek_password->row();
                  $result = array('response' => 1,
                                  'id_role' =>$user->id_role,
                                  'id_user' =>$user->id_user,
                                  'role' =>explode(" ", $user->role)[0],
                                  'id_kategori' => $user->id_kategori,
                                  'nama_kategori' => $user->nama_kategori,
                                  'nama' => $user->nama,
                              	  'email' => $user->email,
                                  'no_hp' => $user->no_hp,
                                  'id_regu' => $user->id_regu,
                                  'pesan' => 'Berhasil Login');
              }
              else
              {
                //password Salah
                  $result = array('response' => 2,
                                  'pesan' => 'Password Salah');
              }

              
            }
            else
            {
              //Belum ada Username / No Hp
                $result = array('response' => 0,
                                'pesan' => 'Anda Belum Terdaftar');
              
            }

            echo json_encode($result);  

    }


    public function LoginApi()
    {
        if(isset($_POST['no_hp']) && isset($_POST['password']))
        {
            //$idUser = $_POST['idUser'];
            $no_hp = $_POST['no_hp'];
            $pass = md5($_POST['password']);
            
            $result = array();
            $cek_no_hp = $this->db->query("SELECT users.*,kategori.nama_kategori,kategori.id_kategori,
                                            role.role FROM users JOIN role ON users.id_role = role.id_role JOIN 
                                            kategori ON kategori.id_kategori = role.id_kategori WHERE no_hp = $no_hp");
            
            if($cek_no_hp->num_rows() > 0)//ada data
            {

              $cek_password = $this->db->query("SELECT users.*,kategori.nama_kategori,kategori.id_kategori,
                                                role.role FROM users JOIN role ON users.id_role = role.id_role 
                                                JOIN kategori ON kategori.id_kategori = role.id_kategori
                                                WHERE
                                                    no_hp = '$no_hp'
                                                AND password = '$pass'");

              if($cek_password->num_rows() > 0)//login succes
              {
                $user = $cek_password->row();
                  $result = array('response' => 1,
                                  'id_role' =>$user->id_role,
                                  'id_user' =>$user->id_user,
                                  'role' =>explode(" ", $user->role)[0],
                                  'id_kategori' => $user->id_kategori,
                                  'nama_kategori' => $user->nama_kategori,
                                  'nama' => $user->nama,
                              	  'foto' => $user->foto,
                              	  'no_hp' => $user->no_hp,
                              	  'alamat' => $user->alamat);
              }
              else
              {
                //password Salah
                  $result = array('response' => 2);
              }

              
            }
            else
            {
              //Belum ada Username / No Hp
                $result = array('response' => 0);
              
            }

            echo json_encode($result);  
       
        } 

    }


    public function CekRegistrasi()
    {
      $email = $this->input->post("email");
      $noHp = $this->input->post("no_hp");
      $user = $this->m_api_login->CekRegistrasi($email, $noHp)->result();
      if($user)
      {
        $respon = array('email' => $user[0]->email,
                        'noHp' => $user[0]->noHp 
                        );
        echo json_encode($respon);
      }
      else
      {
        $respon = array('email' => '0' , 
                        'noHp' => '0' 
                        );
        echo json_encode($respon);
      }
    }

}
?>