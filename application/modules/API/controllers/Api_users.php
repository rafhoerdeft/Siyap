<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Api_users extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('MasterData');

        $this->sms = $this->load->database('sms', TRUE);
         
    }

    function index() {
        echo "Api users";
    
    }



  public function cekEmail()
  {
    $email = $this->input->get('email');
    $cek = $this->db->query("SELECT count(email) AS jml_email,password FROM users WHERE email = '$email'")->result();

    $respon = array();
    if($cek[0]->jml_email >= 1)
    {
      $respon = array('response' => 1,
                      'password' => base64_decode($cek[0]->password));
      echo json_encode($respon);      
    }
    else
    {
      $respon = array('response' => 0 );
      echo json_encode($respon);  
    }

  }

   function emailSend()
   {
      $this->load->library("phpmailer_library");

        $fromEmail = "widhihandono7@gmail.com";
        $isiEmail = $this->input->post('password');

        $mail = $this->phpmailer_library->load();
        
        $mail->IsHTML(true);    // set email format to HTML
        $mail->IsSMTP();   // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = $fromEmail;  // alamat email kamu
        $mail->Password   = "bellawidhihandono9997";            // password GMail
        $mail->SetFrom('info@yourdomain.com', 'Biden');  //Siapa yg mengirim email
        $mail->Subject    = "Password Anda";
        $mail->Body       = $isiEmail;
        $toEmail = $this->input->post('email'); // siapa yg menerima email ini
        $mail->AddAddress($toEmail);
       
       $respon = array();
       
        if(!$mail->Send()) {

                    $respon['response'] = 0;
                    echo json_encode($respon);
            //echo json_encode("Eror: ".$mail->ErrorInfo);
        } else {
                    $respon['response'] = 1;
                    echo json_encode($respon);
        }
    }


    function randomString($length = 6) {
      $str = "";
      $characters = array_merge(range('0','9'));
      $max = count($characters) - 1;
      for ($i = 0; $i < $length; $i++) {
          $rand = mt_rand(0, $max);
          $str  .= $characters[$rand];
      }
      return $str;
    }

    public function tampil_users()
    {
      $users = $this->db->query('SELECT * FROM users')->result();
      echo json_encode($users);
    }


    public function kirimSms($noTelp='', $pesan=''){

        $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();

        $newID = $cek->Auto_increment;



        $data = array(

            'DestinationNumber' => $noTelp,

            'TextDecoded' => 'Password SIYAP anda: '.$pesan,

            'ID' => $newID,

            'MultiPart' => 'false',

            'CreatorID' => 'Damkar'

        );

        $table = 'outbox';

        $input_msg = $this->MasterData->inputData($data,$table);

        $respon = array();

        if ($input_msg) {
            $respon = array('response' => 1,
                            'pesan' => "Password berhasil dikirim ke nomor anda, Cek SMS" );
            //Succes
            echo json_encode($respon);

        }else{

            //Gagal Kirim Sms
            $respon = array('response' => 3,
                            'pesan' => "Password Gagal dikirim ke nomor anda");
            //Gagal
            echo json_encode($respon);

        }
    }


  public function sendToEmail($email='', $pesan='')
  {
  	$this->load->library("PHPMailer_library");

        $fromEmail = "kabmgl.diskominfo@gmail.com"; //isi dengan alamat gmail anda
        $isiEmail = "Password Presensi SIYAP anda: ".$pesan;

        $mail = $this->phpmailer_library->load();
        
        $mail->IsHTML(true);    // set email format to HTML
        $mail->IsSMTP();   // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = $fromEmail;  // alamat email kamu
        
        $mail->Password   = "diskominfob0r0budur123"; //isi dengan password gmail
        
        $mail->SetFrom('siyap@magelangkab.go.id', 'SIYAPApp');  //Siapa yg mengirim email
        $mail->Subject    = "Password Presensi SIYAP";
        $mail->Body       = $isiEmail;
        $toEmail = $email; // siapa yg menerima email ini
        $mail->AddAddress($toEmail);
       
       $respon = array();
       
        if(!$mail->Send()) {

        			//Gagal Kirim Email
                    $respon = array('response' => 5,
                    				'pesan' => "Gagal Kirim Password ke Email" );
                    echo json_encode($respon);
            //echo json_encode("Eror: ".$mail->ErrorInfo);
        } 
        else 
        {
        			//Berhasil Kirim Email
                    $respon = array('response' => 4,
                    				'pesan' => "Berhasil Kirim Password ke Email" );
                    //Succes
                    echo json_encode($respon);
        }
  }


    public function resetPassword_baru()
    {
      $data = json_decode(file_get_contents('php://input'));
      $no_hp = $data->no_hp;
      $email = $data->email;

      $pass = $this->randomString();
      $ps = md5($pass);
      
      $cek_nomor = $this->db->query("SELECT * FROM users WHERE no_hp = '$no_hp'")->num_rows();

      $respon = array();
      
      if($cek_nomor == 0)
      {
        //Nomor tidak ada
          $respon = array('response' => 2,
                          'pesan' => "Nomor tidak terdaftar, mohon masukkan nomor dengan benar !");
          echo json_encode($respon);
		
      }
      else if($cek_nomor > 0)
      {

			$cek_email = $this->db->query("SELECT * FROM users WHERE no_hp = '$no_hp' AND email = '$email'")->num_rows();
	        
	          if($cek_email == 0)
	          {
		         //Email tidak ada
		          $respon = array('response' => 6,
		                          'pesan' => "Email tidak terdaftar, mohon masukkan Email dengan benar !");
		          echo json_encode($respon);         	
	          }
	          else if($cek_email > 0)
	          {
		          $resetPass = $this->db->query("UPDATE users SET password = '$ps' WHERE no_hp = '$no_hp'");

		         	if($resetPass)
		              {

		                $this->kirimSms($no_hp, $pass);
		                $this->sendToEmail($email, $pass);
		                  // $respon = array('response' => 1,
		                  //                 'password'=>$pass );
		                  // echo json_encode($respon);
		              }
		              else
		              {
		                //Gagal Reset Password
		                  $respon = array('response' => 0,
		                                  'pesan' => "Gagal Reset Password !" );
		                  echo json_encode($respon);
		              }
	          }
      }
     

    }

        public function resetPassword_by_noHp()
    {
      $data = json_decode(file_get_contents('php://input'));
      $no_hp = $data->no_hp;
      $pass = $this->randomString();
      $ps = md5($pass);
      
      $cek_nomor = $this->db->query("SELECT * FROM users WHERE no_hp = '$no_hp'")->num_rows();

      $respon = array();
      
      if($cek_nomor == 0)
      {
        //Nomor tidak ada
          $respon = array('response' => 2,
                          'pesan' => "Nomor tidak terdaftar, mohon masukkan nomor dengan benar !");
          echo json_encode($respon);
		
      }
      else if($cek_nomor > 0)
      {

		          $resetPass = $this->db->query("UPDATE users SET password = '$ps' WHERE no_hp = '$no_hp'");

		         	if($resetPass)
		              {

		                $this->kirimSms($no_hp, $pass);
		                  // $respon = array('response' => 1,
		                  //                 'password'=>$pass );
		                  // echo json_encode($respon);
		              }
		              else
		              {
		                //Gagal Reset Password
		                  $respon = array('response' => 0,
		                                  'pesan' => "Gagal Reset Password !" );
		                  echo json_encode($respon);
		              }
	          
      }
     

    }



    public function resetPassword()
    {
      $no_hp = $this->input->post('no_hp');
      $pass = $this->randomString();
      $ps = md5($pass);
      
      $cek_nomor = $this->db->query("SELECT * FROM users WHERE no_hp = '$no_hp'")->num_rows();

      $respon = array();
      
      if($cek_nomor == 0)
      {
        //Nomor tidak ada
          $respon = array('response' => 2,
                          'pesan' => "Nomor tidak terdaftar, mohon masukkan nomor dengan benar !");
          echo json_encode($respon);
      }
      else if($cek_nomor > 0)
      {

          $resetPass = $this->db->query("UPDATE users SET password = '$ps' WHERE no_hp = '$no_hp'");

         if($resetPass)
              {

                // $this->kirimSms($no_hp, $pass);
                  $respon = array('response' => 1,
                                  'password'=>$pass );
                  echo json_encode($respon);
              }
              else
              {
                //Gagal Reset Password
                  $respon = array('response' => 0,
                                  'pesan' => "Gagal Reset Password !" );
                  echo json_encode($respon);
              }
      }
     
    }



    public function input_user_baru()
    {
      $data = json_decode(file_get_contents('php://input'));

      $nama = $data->nama;
      $password = $data->password;
      $no_hp = $data->no_hp;
      $email = $data->email;

        $data = array('id_role' => 3,
                          'nama' => $nama,
                          'password' => md5($password),
                          'no_hp' => $no_hp,
                          'email' => $email
                          );


     $cek_no_hp = $this->db->query("SELECT count(no_hp) as nilai_no_hp FROM users where no_hp = '$no_hp'")->row();


        $respon = array();
                
            if($cek_no_hp->nilai_no_hp >= 1)
            {
              $respon = array('response' => 2,
                              'pesan' => 'No. Hp sudah digunakan' );
              echo json_encode($respon);
            }
            else if($cek_no_hp->nilai_no_hp == 0)
            {

              $insert = $this->db->insert('users',$data);
                if($insert)
                {
                    $respon = array('response' => 1,
                                    'pesan' => 'Berhasil Registrasi',
                                    'id_user' => $this->db->insert_id());
                    echo json_encode($respon);      
                }
              else
                {
                  $respon = array('response' => 0,
                                  'pesan' => 'Gagal Input data Pengguna' );
                  echo json_encode($respon);  
                }    

            }     
    }


    public function input_users()
    {
    	// print_r($this->randomString());
    	// exit();

        $date = new DateTime('now');  

        $foto_encode = $this->input->post('foto');

        $foto = $date->format('ddMMyyyyHis').'.jpg';


        // $id_user = $this->input->post('id_user');
        $id_role = $this->input->post('id_role');
        $no_ktp = $this->input->post('no_ktp');
        $nama = $this->input->post('nama');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $username = $this->input->post('username');
        $password = $this->randomString();
        $no_hp = $this->input->post('no_hp');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $tgl_lahir = $this->input->post('tgl_lahir');

              $data = array('id_role' => $id_role,
                            'no_ktp' => $no_ktp,
                            'jenis_kelamin' => $jenis_kelamin,
                            'nama' => $nama,
                            'username' => $username,
                            'password' => md5($password),
                            'no_hp' => $no_hp,
                            'alamat' => $alamat,
                            'foto' => $foto,
                            'email' => $email,
                            'tgl_lahir' => $tgl_lahir
                            );


       $cek_no_hp = $this->db->query("SELECT count(no_hp) as nilai_no_hp FROM users where no_hp = '$no_hp'")->row();

       // $cek_no_ktp = $this->db->query("SELECT count(no_ktp) as nilai_no_ktp FROM users where no_ktp = '$no_ktp'")->result();
                       
       // $cek_username = $this->db->query("SELECT count(username) as nilai_us FROM users 
       //                        where username = '$username'")->result();

       // $cek_email = $this->db->query("SELECT count(email) as nilai_email FROM users 
       //                        where email = '$email'")->result();


          $respon = array();
                  
              if($cek_no_hp->nilai_no_hp >= 1)
              {
                $respon = array('response' => 2 );
                echo json_encode($respon);
              }
              else if($cek_no_hp->nilai_no_hp == 0)
              {

                $insert = $this->db->insert('users',$data);
                  if($insert)
                  {
                      json_encode($insert);
                      $respon = array('response' => 1,
                                      'password' => $password);

                       //Simpan Gambar Folder
                        file_put_contents('./assets/path_profile/'.$foto,base64_decode($foto_encode));
                      // $users = $this->db->query("SELECT nik from users order by nik desc limit 1 ")->result();
                      // $nik = $users[0]->nik;
                      // $respon = $this->db->query("SELECT * FROM users where nik = '$nik'")->result();
                      echo json_encode($respon);      
                  }
                else
                  {
                    $respon = array('response' => 0 );
                    echo json_encode($respon);  
                  }    

              }     
             
      }


    public function edit_user_baru()
    {
      $data = json_decode(file_get_contents('php://input'));

      $id_user = $data->id_user;
      $id_role = $data->id_role;
      $nama = $data->nama;
      $password = $data->password; //new Password
      $no_hp = $data->no_hp;
      $email = $data->email;

      $data = array();

      if($password == "" || $password == null)
      {
        $data = array(	'id_user' => $id_user,
        				'id_role' => $id_role,
                        'nama' => $nama,
                        'no_hp' => $no_hp,
                        'email' => $email
                          );
      }
      else
      {
      	$data = array(	'id_user' => $id_user,
        				'id_role' => $id_role,
                        'nama' => $nama,
                        'password' => md5($password),
                        'no_hp' => $no_hp,
                        'email' => $email
                          );
      }

            
       	$cek_data = $this->db->query("SELECT no_hp,id_user,email FROM users where id_user = '$id_user'");



            $respon = array();
        
        //Cek data
            if($cek_data->num_rows() > 0  )
            {

	       		// if($cek_data->row()->id_user == $id_user && $cek_data->row()->no_hp == $no_hp)
	       		// {
	       		// 	if($cek_data->row()->id_user == $id_user && $cek_data->row()->email == $email)
			       //  {   
			              $where = array('id_user' => $id_user );
			              $this->db->where($where);
			              $update = $this->db->update('users', $data);
			              if($update)
			              {
			              	    $respon = array('response' => 1,
												'id_user' => $id_user,
						        				'id_role' => $id_role,
						                        'nama' => $nama,
						                        'no_hp' => $no_hp,
						                        'email' => $email,
						                        'pesan' => "Sukses Simpan Perubahan"
			                    				);

				                echo json_encode($respon);    
			              }
			              else
			              {
			           		    $respon = array('response' => 0,
			           		    				'pesan' => "Gagal Simpan Perubahan" );
			                	echo json_encode($respon);   	
			              }
			       //  }
			       //  else if($cek_data->row()->id_user == $id_user && ($cek_data->row()->email == null || $cek_data->row()->email == ""))
			       //  {
			       //  	  $where = array('id_user' => $id_user );
			       //        $this->db->where($where);
			       //        $update = $this->db->update('users', $data);
			       //        if($update)
			       //        {
			       //        	    $respon = array('response' => 1,
										// 		'id_user' => $id_user,
						    //     				'id_role' => $id_role,
						    //                     'nama' => $nama,
						    //                     'no_hp' => $no_hp,
						    //                     'email' => $email,
						    //                     'pesan' => "Sukses Simpan Perubahan"
			       //              				);

				      //           echo json_encode($respon);    
			       //        }
			       //        else
			       //        {
			       //     		    $respon = array('response' => 0,
			       //     		    				'pesan' => "Gagal Simpan Perubahan" );
			       //          	echo json_encode($respon);   	
			       //        }
			       //  }
			       //  else
			       //  {
		        //    		    $respon = array('response' => 3,
		        //    		    				'pesan' => "Email Sudah digunakan oleh orang lain" );
		        //         	echo json_encode($respon);			        	
			       //  }      
		        // }
		        // else
		        // {
		        //    		    $respon = array('response' => 4,
		        //    		    				'pesan' => "No. Hp Sudah digunakan oleh orang lain" );
		        //         	echo json_encode($respon);   	
		        // }      
  
            }
            else
            {
		        $respon = array('response' => 2,
		           		    	'pesan' => "User tidak terdaftar" );
	        	echo json_encode($respon);
            }
    }


    public function edit_users()
    {
        $id_user = $this->input->post('id_user');
        $id_role = $this->input->post('id_role');
        $nama = $this->input->post('nama');
        $no_hp = $this->input->post('no_hp');
        $alamat = $this->input->post('alamat');

      //============Input foto==============================================================
        $date = new DateTime('now');  
        $foto_encode = $this->input->post('foto');
        $foto = $date->format('ddMMyyyyHis').$id_user.'.jpg';
      //======================================================================================

            $data = array(  'id_user' => $id_user,
                            'id_role' => $id_role,
                            'no_hp' => $no_hp,
                            'nama' => $nama,
                            'alamat' => $alamat,
                            'foto' => $foto
                        );
            
       $cek_no_hp = $this->db->query("SELECT count(no_hp) as nilai_no_hp FROM users where no_hp = '$no_hp'")->row();


            $respon = array();
        
        //Cek Nomor Hp
            if($cek_no_hp->nilai_no_hp > 0  )
            {

              $where = array('id_user' => $id_user );
              $this->db->where($where);
              $update = $this->db->update('users', $data);
              if($update)
              {
              	    $respon = array('response' => 1,
                    				'foto' => $foto,
                    				'nama' => $nama,
                    				'alamat' => $alamat,
                    				'no_hp' => $no_hp 
                    				);

	                    //Hapus Image
              	  $foto_sebelumnya = $this->input->post('foto_sebelumnya');
	             if($foto_sebelumnya == null || $foto_sebelumnya == "")
	             {
	               //Simpan Gambar Folder
	              file_put_contents('./assets/path_profile/'.$foto,base64_decode($foto_encode));

	             }
	             else
	             {
	             	$path = './assets/path_profile/'.$foto_sebelumnya;
	              	unlink($path);
	              
		               //Simpan Gambar Folder
		              file_put_contents('./assets/path_profile/'.$foto,base64_decode($foto_encode));
	
	             }
	              
	                // $users = $this->db->query("SELECT nik from users order by nik desc limit 1 ")->result();
	                // $nik = $users[0]->nik;
	                // $respon = $this->db->query("SELECT * FROM users where nik = '$nik'")->result();
	                echo json_encode($respon);    
              }
              else
              {
           		    $respon = array('response' => 0 );
                	echo json_encode($respon);   	
              }
  
            }
            else
            {
                $respon = array('response' => 0 );
                echo json_encode($respon);  
            }
    }

    public function delete_users()
    {
        $id_user = $this->input->post('id_user');
        $where = array('id_user' => $id_user );    
        $this->db->where($where);
        $delete = $this->db->delete('users');

        json_encode($delete);
    }


}
?>
