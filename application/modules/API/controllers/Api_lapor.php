<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Api_lapor extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('MasterData');

        $this->sms = $this->load->database('sms', TRUE);
    }

    function index() {
        echo "Api lapor";
    }
    

public function sendNotif_1()
    {

                // PUSH NOTIFIKASI
        $firebase_api = 'AIzaSyBM4c49Ru7OllpNiWiZxhnF-vLQIDfpmVw';

	            $topic = 'global';
	            
			            $requestData = array(
	                'title' => 'safasf',
	                'message' => 'fasfa'
	            );


        $fields = array(
            'to' => '/topics/'.$topic,
            'priority'=>'high',
            'data' => $requestData,
        );

        $url = 'https://fcm.googleapis.com/fcm/send';
 
        $headers = array(
            'Authorization: key=' . $firebase_api,
            'Content-Type: application/json'
        );
        
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarily
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
            $respon = array();
        $result = curl_exec($ch);

        if($result)
        {
         	$respon = array('response' => 1 );
         	// $this->db->query("UPDATE lapor SET status = 'diteruskan' WHERE id_lapor = '$id_lapor'");
         	echo  json_encode($respon);
        }
        else
        {
			$respon = array('response' => 0 );
			echo json_encode($respon);
        }

        // Close connection
        curl_close($ch);
    
    }


    public function sendNotif()
    {
    	$title = $this->input->post('title');
    	$alamat = $this->input->post('alamat');
    	$id_kategori = $this->input->post('id_kategori');    	    	
    	$nama_kategori = $this->input->post('nama_kategori');
    	$id_user = $this->input->post('id_user');
    	$latitude = $this->input->post('latitude');
    	$longitude = $this->input->post('longitude');
    	$image_lapor = $this->input->post('image_lapor');
    	$image_selfie = $this->input->post('image_selfie');
    	$tgl_lapor = $this->input->post('tgl_lapor');
        $jam = $this->input->post('jam');
    	$id_lapor = $this->input->post('id_lapor');
    	$keterangan = $this->input->post('keterangan');
    	$status = $this->input->post('status');
    	$nama_pelapor = $this->input->post('nama_pelapor');

        // $firebase_api = 'AAAAR2XTAuU:APA91bFWtwEBTCi3UTLiFIKKHPvCGcC2UdXBFuaxGMk0Ear5u6ekC02fZbRFI-_xRjmlaI5nv8ByNl6SS9_C19tL8Pbojn9Qyt_WkmVwbapNZKOeID6cukwAtS_7uNmjFlKIfDlBkC_M';
   
        $firebase_api = 'AAAAR2XTAuU:APA91bG1SEJeSoDPfThT_GeTkqd3lrdHc7sRVu-wRQhBHY96Vmp-3XRjZ_LeesuInsf-3mRx2QrZH7MHIeS9fl_iqHRB4brdavO0rZUf06xMNaYv1l8cosZSQKjOcqv_1ji_HWVlq1J3';

        $topic = 'petugas';

        $requestData = array(
            'title' => $title,
            'message' => $alamat,
            'id_kategori' => $id_kategori,
            'nama_kategori' => $nama_kategori,
            'id_user' => $id_user,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'alamat' => $alamat,
            'image_lapor' => $image_lapor,
            'image_selfie' => $image_selfie,
            'tgl_lapor' => $tgl_lapor,
            'id_lapor' => $id_lapor,
            'keterangan' => $keterangan,
            'status' => $status,
            'jam' => $jam,
            'nama_pelapor' => $nama_pelapor,
            'to_notif' =>"petugas"
        );

        // $requestData = array(
        //     'title' => 'Hello',
        //     'message' => 'cukkk'
        // );
        
        $fields = array(
            'to' => '/topics/'.$topic,
            'priority'=>'high',
            'notification' => $requestData,
        );

        $url = 'https://fcm.googleapis.com/fcm/send';
 
        $headers = array(
            'Authorization: key='.$firebase_api,
            'Content-Type: application/json'
        );
        
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarily
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
            $respon = array();
        $result = curl_exec($ch);

        if($result == TRUE)
        {
         	$respon = array('response' => 1 );
         	// $this->db->query("UPDATE lapor SET status = 'diteruskan' WHERE id_lapor = '$id_lapor'");
         	echo  json_encode($respon);
        }
        else
        {
			$respon = array('response' => 0 );
			echo json_encode($respon);
        }

        // Close connection
        curl_close($ch);
    
    }

	function distance($lat1, $lon1, $lat2, $lon2) {
	  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
	    return 0;
	  }
	  else {
	    $theta = $lon1 - $lon2;
	    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	    $dist = acos($dist);
	    $dist = rad2deg($dist);
	    $miles = $dist * 60 * 1.1515;

	      return ($miles * 1.609344)*1000;
	    
	  }
	}

    function distanceKm($lat1, $lon1, $lat2, $lon2) {
      if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
      }
      else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

          return ($miles * 1.609344);
        
      }
    }

//Tampil Laporan dengan jarak


public function tampil_laporan_coba()
    {
    	$id_kategori = $this->input->get('id_kategori');
        $lat = $this->input->get('lat');
        $lng = $this->input->get('lng');
        $offset = $this->input->get('offset'); //mulai dari
        $jumlah = $this->input->get('jumlah'); //jumlah yang akan ditampilkan
        $month = $this->input->get('month');
        $year = $this->input->get('year');
        $status = strtolower($this->input->get('status'));

        $lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori,jenis_laporan.nama_jenis_lap FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori JOIN jenis_laporan ON jenis_laporan.id_jenis_lap = lapor.id_jenis_lap WHERE lapor.id_kategori = '$id_kategori'
            AND (MONTH(lapor.tgl_lapor) = $month AND YEAR(lapor.tgl_lapor) = $year) AND lapor.status like '%$status%' order by lapor.tgl_lapor DESC LIMIT $offset,$jumlah")->result();

        // $cek_jml_lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,
        // 				kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = 
        // 				lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori WHERE 
        // 				lapor.id_kategori = '$id_kategori' order by tgl_lapor DESC")->num_rows();

        for($a=0;$a<count($lapor);$a++)
        {
           $laporan[] = array('id_lapor' => $lapor[$a]->id_lapor,
				           	'id_kategori' => $lapor[$a]->id_kategori,
				           	'id_user' => $lapor[$a]->id_user,
				           	'id_jenis_lap' => $lapor[$a]->id_jenis_lap,
           					'latitude' => $lapor[$a]->latitude,
                            'longitude' => $lapor[$a]->longitude,
				           	'alamat' => $lapor[$a]->alamat,
				           	'image_lapor' => $lapor[$a]->image_lapor,
				           	'image_selfie' => $lapor[$a]->image_selfie,
				           	'tgl_lapor' => $lapor[$a]->tgl_lapor,
				           	'status' => $lapor[$a]->status,
				           	'keterangan' => $lapor[$a]->keterangan,
				           	'waktu_selesai' => $lapor[$a]->waktu_selesai,
				           	'nama_pelapor' => $lapor[$a]->nama_pelapor,
				           	'no_hp' => $lapor[$a]->no_hp,
				           	'skpd' => $lapor[$a]->skpd,
				           	'nama_jenis_lap' => $lapor[$a]->nama_jenis_lap,
				           	'nama_kategori' => $lapor[$a]->nama_kategori,
                            'jarak' =>$this->distanceKm($lat,$lng,$lapor[$a]->latitude,$lapor[$a]->longitude) ); 
          
        }

        if(count($lapor) == 0)
        {
        	$laporan = array();
         echo json_encode($laporan);
        }
        else
        {
        	echo json_encode($laporan);
        }
        
    }

    public function tampil_laporan_by_alamat()
    {
        $id_kategori = $this->input->get('id_kategori');
        $cari = $this->input->get('cari');
        $offset = $this->input->get('offset'); //mulai dari
        $jumlah = $this->input->get('jumlah'); //jumlah yang akan ditampilkan

        $lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori,jenis_laporan.nama_jenis_lap FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori JOIN jenis_laporan ON jenis_laporan.id_jenis_lap = lapor.id_jenis_lap WHERE lapor.id_kategori = '$id_kategori'
            AND lapor.alamat like '%$cari%' order by lapor.tgl_lapor DESC LIMIT $offset,$jumlah")->result();

        // $cek_jml_lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,
        //              kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = 
        //              lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori WHERE 
        //              lapor.id_kategori = '$id_kategori' order by tgl_lapor DESC")->num_rows();

        for($a=0;$a<count($lapor);$a++)
        {
           $laporan[] = array('id_lapor' => $lapor[$a]->id_lapor,
                            'id_kategori' => $lapor[$a]->id_kategori,
                            'id_user' => $lapor[$a]->id_user,
                            'id_jenis_lap' => $lapor[$a]->id_jenis_lap,
                            'latitude' => $lapor[$a]->latitude,
                            'longitude' => $lapor[$a]->longitude,
                            'alamat' => $lapor[$a]->alamat,
                            'image_lapor' => $lapor[$a]->image_lapor,
                            'image_selfie' => $lapor[$a]->image_selfie,
                            'tgl_lapor' => $lapor[$a]->tgl_lapor,
                            'status' => $lapor[$a]->status,
                            'keterangan' => $lapor[$a]->keterangan,
                            'waktu_selesai' => $lapor[$a]->waktu_selesai,
                            'nama_pelapor' => $lapor[$a]->nama_pelapor,
                            'no_hp' => $lapor[$a]->no_hp,
                            'skpd' => $lapor[$a]->skpd,
                            'nama_jenis_lap' => $lapor[$a]->nama_jenis_lap,
                            'nama_kategori' => $lapor[$a]->nama_kategori,
                            'jarak' =>$this->distanceKm($lat,$lng,$lapor[$a]->latitude,$lapor[$a]->longitude) ); 
          
        }

        if(count($lapor) == 0)
        {
            $laporan = array();
         echo json_encode($laporan);
        }
        else
        {
            echo json_encode($laporan);
        }
        
    }


    public function tampil_laporan()
    {
    	$id_kategori = $this->input->get('id_kategori');
        $lat = $this->input->get('lat');
        $lng = $this->input->get('lng');
        $lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori,jenis_laporan.nama_jenis_lap FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori JOIN jenis_laporan ON jenis_laporan.id_jenis_lap = lapor.id_jenis_lap WHERE lapor.id_kategori = '$id_kategori' order by tgl_lapor DESC")->result();

        // $cek_jml_lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,
        // 				kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = 
        // 				lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori WHERE 
        // 				lapor.id_kategori = '$id_kategori' order by tgl_lapor DESC")->num_rows();

        for($a=0;$a<count($lapor);$a++)
        {
           $laporan[] = array('id_lapor' => $lapor[$a]->id_lapor,
				           	'id_kategori' => $lapor[$a]->id_kategori,
				           	'id_user' => $lapor[$a]->id_user,
				           	'id_jenis_lap' => $lapor[$a]->id_jenis_lap,
           					'latitude' => $lapor[$a]->latitude,
                            'longitude' => $lapor[$a]->longitude,
				           	'alamat' => $lapor[$a]->alamat,
				           	'image_lapor' => $lapor[$a]->image_lapor,
				           	'image_selfie' => $lapor[$a]->image_selfie,
				           	'tgl_lapor' => $lapor[$a]->tgl_lapor,
				           	'status' => $lapor[$a]->status,
				           	'keterangan' => $lapor[$a]->keterangan,
				           	'waktu_selesai' => $lapor[$a]->waktu_selesai,
				           	'nama_pelapor' => $lapor[$a]->nama_pelapor,
				           	'no_hp' => $lapor[$a]->no_hp,
				           	'skpd' => $lapor[$a]->skpd,
				           	'nama_jenis_lap' => $lapor[$a]->nama_jenis_lap,
				           	'nama_kategori' => $lapor[$a]->nama_kategori,
                            'jarak' =>$this->distanceKm($lat,$lng,$lapor[$a]->latitude,$lapor[$a]->longitude) ); 
          
        }

        if(count($lapor) == 0)
        {
        	$laporan = array();
         echo json_encode($laporan);
        }
        else
        {
        	echo json_encode($laporan);
        }
        
    }

    public function tampil_laporan_petugas()
    {
    	$id_kategori = $this->input->get('id_kategori');
        $lat = $this->input->get('lat');
        $lng = $this->input->get('lng');
        $lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori,jenis_laporan.nama_jenis_lap FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori JOIN jenis_laporan ON jenis_laporan.id_jenis_lap = lapor.id_jenis_lap WHERE lapor.id_kategori = '$id_kategori' AND (lapor.status = 'diteruskan' OR lapor.status = 'proses') order by tgl_lapor DESC")->result();

        $cek_jml_lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,
        	kategori.nama_kategori FROM lapor join users on users.id_user = lapor.id_user join 
        	kategori on kategori.id_kategori = lapor.id_kategori WHERE 
        	lapor.id_kategori = '$id_kategori' 
        	AND (lapor.status = 'diteruskan' OR lapor.status = 'proses') order by tgl_lapor DESC")->num_rows();

        for($a=0;$a<$cek_jml_lapor;$a++)
        {
           $laporan[] = array('id_lapor' => $lapor[$a]->id_lapor,
				           	'id_kategori' => $lapor[$a]->id_kategori,
				           	'id_user' => $lapor[$a]->id_user,
				           	'id_jenis_lap' => $lapor[$a]->id_jenis_lap,
           					'latitude' => $lapor[$a]->latitude,
                            'longitude' => $lapor[$a]->longitude,
				           	'alamat' => $lapor[$a]->alamat,
				           	'image_lapor' => $lapor[$a]->image_lapor,
				           	'image_selfie' => $lapor[$a]->image_selfie,
				           	'tgl_lapor' => $lapor[$a]->tgl_lapor,
				           	'status' => $lapor[$a]->status,
				           	'keterangan' => $lapor[$a]->keterangan,
				           	'waktu_selesai' => $lapor[$a]->waktu_selesai,
				           	'nama_pelapor' => $lapor[$a]->nama_pelapor,
				           	'no_hp' => $lapor[$a]->no_hp,
				           	'skpd' => $lapor[$a]->skpd,
				           	'nama_jenis_lap' => $lapor[$a]->nama_jenis_lap,
				           	'nama_kategori' => $lapor[$a]->nama_kategori,
                            'jarak' =>$this->distanceKm($lat,$lng,$lapor[$a]->latitude,$lapor[$a]->longitude) ); 
          
        }
         
        if($cek_jml_lapor == 0)
        {
        	$laporan = array();
         echo json_encode($laporan);
        }
        else
        {
        	echo json_encode($laporan);
        }
        
    }


 public function tampil_laporan_user_coba()
    {
    	$id_kategori = $this->input->get('id_kategori');
        $lat = $this->input->get('lat');
        $lng = $this->input->get('lng');
        $id_user = $this->input->get('id_user');
        $offset = $this->input->get('offset'); //mulai dari
        $jumlah = $this->input->get('jumlah'); //jumlah yang akan ditampilkan
        $lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori,jenis_laporan.nama_jenis_lap FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori JOIN jenis_laporan ON jenis_laporan.id_jenis_lap = lapor.id_jenis_lap WHERE lapor.id_kategori = $id_kategori AND 
        	lapor.id_user = $id_user order by tgl_lapor DESC LIMIT $offset,$jumlah")->result();

        // $cek_jml_lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori WHERE lapor.id_kategori = $id_kategori AND lapor.id_user = $id_user order by tgl_lapor DESC")->num_rows();

        for($a=0;$a<count($lapor);$a++)
        {
           $laporan[] = array('id_lapor' => $lapor[$a]->id_lapor,
				           	'id_kategori' => $lapor[$a]->id_kategori,
				           	'id_user' => $lapor[$a]->id_user,
				           	'id_jenis_lap' => $lapor[$a]->id_jenis_lap,
           					'latitude' => $lapor[$a]->latitude,
                            'longitude' => $lapor[$a]->longitude,
				           	'alamat' => $lapor[$a]->alamat,
				           	'image_lapor' => $lapor[$a]->image_lapor,
				           	'image_selfie' => $lapor[$a]->image_selfie,
				           	'tgl_lapor' => $lapor[$a]->tgl_lapor,
				           	'status' => $lapor[$a]->status,
				           	'keterangan' => $lapor[$a]->keterangan,
				           	'waktu_selesai' => $lapor[$a]->waktu_selesai,
				           	'nama_pelapor' => $lapor[$a]->nama_pelapor,
				           	'no_hp' => $lapor[$a]->no_hp,
				           	'skpd' => $lapor[$a]->skpd,
				           	'nama_jenis_lap' => $lapor[$a]->nama_jenis_lap,
				           	'nama_kategori' => $lapor[$a]->nama_kategori,
                            'jarak' =>$this->distanceKm($lat,$lng,$lapor[$a]->latitude,$lapor[$a]->longitude) ); 
          
        }

        if(count($lapor) == 0)
        {
        	$laporan = array();
         	echo json_encode($laporan);
        }
        else
        {
        	echo json_encode($laporan);
        }
        
    }


    public function tampil_laporan_user()
    {
    	$id_kategori = $this->input->get('id_kategori');
        $lat = $this->input->get('lat');
        $lng = $this->input->get('lng');
        $id_user = $this->input->get('id_user');
        $lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori,jenis_laporan.nama_jenis_lap FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori JOIN jenis_laporan ON jenis_laporan.id_jenis_lap = lapor.id_jenis_lap WHERE lapor.id_kategori = $id_kategori AND lapor.id_user = $id_user order by tgl_lapor DESC")->result();

        $cek_jml_lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori WHERE lapor.id_kategori = $id_kategori AND lapor.id_user = $id_user order by tgl_lapor DESC")->num_rows();

        for($a=0;$a<$cek_jml_lapor;$a++)
        {
           $laporan[] = array('id_lapor' => $lapor[$a]->id_lapor,
				           	'id_kategori' => $lapor[$a]->id_kategori,
				           	'id_user' => $lapor[$a]->id_user,
				           	'id_jenis_lap' => $lapor[$a]->id_jenis_lap,
           					'latitude' => $lapor[$a]->latitude,
                            'longitude' => $lapor[$a]->longitude,
				           	'alamat' => $lapor[$a]->alamat,
				           	'image_lapor' => $lapor[$a]->image_lapor,
				           	'image_selfie' => $lapor[$a]->image_selfie,
				           	'tgl_lapor' => $lapor[$a]->tgl_lapor,
				           	'status' => $lapor[$a]->status,
				           	'keterangan' => $lapor[$a]->keterangan,
				           	'waktu_selesai' => $lapor[$a]->waktu_selesai,
				           	'nama_pelapor' => $lapor[$a]->nama_pelapor,
				           	'no_hp' => $lapor[$a]->no_hp,
				           	'skpd' => $lapor[$a]->skpd,
				           	'nama_jenis_lap' => $lapor[$a]->nama_jenis_lap,
				           	'nama_kategori' => $lapor[$a]->nama_kategori,
                            'jarak' =>$this->distanceKm($lat,$lng,$lapor[$a]->latitude,$lapor[$a]->longitude) ); 
          
        }

        if($cek_jml_lapor == 0)
        {
        	$laporan = array();
         echo json_encode($laporan);
        }
        else
        {
        	echo json_encode($laporan);
        }
        
    }


    public function tampil_laporan_anda()
    {
        $lat = $this->input->get('lat');
        $lng = $this->input->get('lng');
        $id_user = $this->input->get('id_user');
        $offset = $this->input->get('offset');
        $jumlah = $this->input->get('jumlah');

        $lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori,jenis_laporan.nama_jenis_lap FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori JOIN jenis_laporan ON jenis_laporan.id_jenis_lap = lapor.id_jenis_lap WHERE lapor.id_user = $id_user order by tgl_lapor DESC LIMIT $offset,$jumlah")->result();

        // $cek_jml_lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori WHERE lapor.id_user = $id_user order by tgl_lapor DESC")->num_rows();

        for($a=0;$a<count($lapor);$a++)
        {
           $laporan[] = array('id_lapor' => $lapor[$a]->id_lapor,
				           	'id_kategori' => $lapor[$a]->id_kategori,
				           	'id_user' => $lapor[$a]->id_user,
				           	'id_jenis_lap' => $lapor[$a]->id_jenis_lap,
           					'latitude' => $lapor[$a]->latitude,
                            'longitude' => $lapor[$a]->longitude,
				           	'alamat' => $lapor[$a]->alamat,
				           	'image_lapor' => $lapor[$a]->image_lapor,
				           	'image_selfie' => $lapor[$a]->image_selfie,
				           	'tgl_lapor' => $lapor[$a]->tgl_lapor,
				           	'status' => $lapor[$a]->status,
				           	'keterangan' => $lapor[$a]->keterangan,
				           	'waktu_selesai' => $lapor[$a]->waktu_selesai,
				           	'nama_pelapor' => $lapor[$a]->nama_pelapor,
				           	'no_hp' => $lapor[$a]->no_hp,
				           	'skpd' => $lapor[$a]->skpd,
				           	'nama_jenis_lap' => $lapor[$a]->nama_jenis_lap,
				           	'nama_kategori' => $lapor[$a]->nama_kategori,
                            'jarak' =>$this->distanceKm($lat,$lng,$lapor[$a]->latitude,$lapor[$a]->longitude) ); 
          
        }
        
        if(count($lapor) == 0)
        {
        	$laporan = array();
         	echo json_encode($laporan);
        }
        else
        {
        	echo json_encode($laporan);
        }
        
    }


//=========================Cek Jarak Kirim Laporan, Suapaya Tidak Duplikasi Data=======================================
	public function cek_jarak($id_kategori,$latitude,$longitude)
	{
		$lapor = $this->db->query("SELECT * FROM lapor WHERE id_kategori = '$id_kategori' AND (status = 'masuk' || 
            status = 'proses' || status = 'diteruskan') ORDER BY tgl_lapor DESC");
		
		if($lapor->num_rows() > 0)
		{
			$jarak = $this->distance($latitude,$longitude,$lapor->row()->latitude,$lapor->row()->longitude);
			$cek_batas = $this->db->query("SELECT jarak FROM batas_jarak WHERE id_kategori = '$id_kategori'")->row();

			$respon = array();
			if($jarak > $cek_batas->jarak)
			{
				//bisa input Laporan, Karena jarak lebih dari batas
				return 1;
			}
			else
			{
				//Tidak Bisa Input Laporan karena kurang dari 100(batas) meter
				return 0;
			}
			
				
		}
		else
		{
				//bisa input Laporan, Karena belum ada data
				return 1;
		}
		
		
	}
//==============================================================================================================

    public function tampil_lapor_kategori()
    {
        $id_kategori = $this->input->get('id_kategori');
        $lapor = $this->db->query("SELECT * FROM lapor WHERE id_kategori = '$id_kategori'")->result();
        echo json_encode($lapor);
    }

    public function tampil_lapor()
    {
    	$id_kategori = $this->input->get('id_kategori');
        $lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori
        							WHERE lapor.id_kategori = '$id_kategori' order by tgl_lapor DESC")->result();
        echo json_encode($lapor);
    }

    public function tampil_lapor_petugas()
    {
    	$id_kategori = $this->input->get('id_kategori');
        $lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori
        							WHERE lapor.id_kategori = '$id_kategori' AND (lapor.status = 'diteruskan' OR lapor.status = 'proses') order by tgl_lapor DESC")->result();
        echo json_encode($lapor);
    }

    public function tampil_lapor_anda()
    {
    	$id_user = $this->input->get('id_user');
        $lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori
        							WHERE lapor.id_user = $id_user order by tgl_lapor DESC")->result();
        echo json_encode($lapor);
    }

    public function tampil_lapor_user()
    {
    	$id_kategori = $this->input->get('id_kategori');
    	$id_user = $this->input->get('id_user');
        $lapor = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori
         							WHERE lapor.id_kategori = $id_kategori AND lapor.id_user = $id_user order by tgl_lapor DESC")->result();
        echo json_encode($lapor);
    }

    // public function cek_jarak_laporan($lat_1,$lng_1,$lat_2,$lng_2)
    // {
    // 	$query = $this->db->query("SELECT * FROM lapor WHERE status = 'masuk' || status = 'proses'")
    // }

    public function input_laporan_baru()
    {
        $data = json_decode(file_get_contents('php://input'));
        
        $date = date("Y-m-d h:i:s");  

        $image_lapor_encode = $data->image_lapor;

        $image_lapor = date("ddMMyyyyHis").'laporan'.'.jpg';

        $image_selfie_encode = $data->image_selfie;

        $image_selfie = date("ddMMyyyyHis").'selfie'.'.jpg';
        // $image_lapor = rand().$date->format('ddMMyyyyHis').'laporan'.'.jpg';

        // $id_lapor = $this->input->post('id_lapor');
        $id_kategori = $data->id_kategori;
        $id_user = $data->id_user;
        $latitude = $data->latitude;
        $longitude = $data->longitude;
        $alamat = $data->alamat;
        $keterangan = $data->keterangan;
        $title = $keterangan;
        // $image_lapor = $this->input->post('image_lapor');
        // $image_selfie = $this->input->post('image_selfie');

        $data = array('id_kategori' => $id_kategori,
                        'id_user' => $id_user,
                        'id_jenis_lap'=> 13,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'alamat' => $alamat,
                        'image_lapor' => $image_lapor,
                        'image_selfie' => $image_selfie,
                        'tgl_lapor' => $date,
                        'keterangan' => $keterangan,
                        'status' => 'masuk'
                    );


        $response = array();

        if($this->cek_jarak($id_kategori,$latitude,$longitude) == 1)
        {

        $insert = $this->db->insert('lapor',$data);
        
	        if($insert)
	        {
				$lastId = $this->db->insert_id();

	            $select_user = $this->db->query("SELECT * FROM users WHERE id_user = '$id_user'")->row();
	            $select_laporan = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori WHERE id_lapor = '$lastId'")->row();


                $response = array('response' => 1,
                                    'pesan' => "Terkirim",
	                                'image_lapor' =>$image_lapor,
	                                'image_selfie' =>$image_selfie,
	                                'nama_pelapor' => $select_user->nama,
	                                'topic' => "petugas", //atau semua
	                                'to_notif' => "petugas", // atau semua
	                                'id_lapor' => $lastId );

	            file_put_contents('./assets/path_laporan/'.$image_lapor, base64_decode($image_lapor_encode));
	            file_put_contents('./assets/path_selfie/'.$image_selfie, base64_decode($image_selfie_encode));
	                // PUSH NOTIFIKASI
	            // $firebase_api = 'AAAAR2XTAuU:GV9Jm2u7rmsCe65wKzPTw5jtS38n2tVEGibCi2qbn1Td4PeBqJGy-rIwWj22TfETTOBvfoeVJCgVLMRu-KPti5OOOJG242QRFi3dgfSVKpc1B9idTEuN3cBScszNHP9sdnEr0BHyV8N1';

	            // $select = '*';
	            // $table = 'typesurat';
	            // $where = "id_typesurat = '$tipe'";
	            // $type_surat = $this->MasterData->getWhereData($select,$table,$where)->row()->type;

	            

	            
	            // $requestData = array(
	            //     'title' => $title,
	            //     'message' => $alamat,
	            //     'id_kategori' => $id_kategori,
	            //     'nama_kategori' => $select_laporan->nama_kategori,
	            //     'id_user' => $id_user,
	            //     'latitude' => $latitude,
	            //     'longitude' => $longitude,
	            //     'alamat' => $alamat,
	            //     'image_lapor' => $image_lapor,
	            //     'image_selfie' => $image_selfie,
	            //     'tgl_lapor' => $tgl_lapor,
	            //     'id_lapor' => $lastId,
	            //     'keterangan' => $keterangan,
	            //     'status' => $select_laporan->status,
	            //     'nama_pelapor' => $select_user->nama,
	            //     'skpd' => $select_laporan->skpd,
	            //     'to_notif'=>$to_notif
	            // );


	            // $requestData = array(
	            //     'title' => 'Hello',
	            //     'message' => 'cukkk'
	            // );
	            
	            // $fields = array(
	            //     'to' => '/topics/'.$topic,
	            //     'priority'=>'high',
	            //     'data' => $requestData,
	            // );

	            // $fields_admin = array(
	            //     'to' => '/topics/'.$topic_admin,
	            //     'priority'=>'high',
	            //     'data' => $requestData,
	            // );

	            // $url = 'https://fcm.googleapis.com/fcm/send';
	     
	            // $headers = array(
	            //     'Authorization: key=' . $firebase_api,
	            //     'Content-Type: application/json'
	            // );
	            
	            // Open connection
	            // $ch = curl_init();

	            // // Set the url, number of POST vars, POST data
	            // curl_setopt($ch, CURLOPT_URL, $url);

	            // curl_setopt($ch, CURLOPT_POST, true);
	            // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	            // // Disabling SSL Certificate support temporarily
	            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	            // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	            // // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields_admin));

	            // // Execute post
	            // $result = curl_exec($ch);
	            // // if($result === FALSE){
	            // //  die('Curl failed: ' . curl_error($ch));
	            // // }

	            // // Close connection
	            // curl_close($ch);

	            echo json_encode($response);
	        }
	        else
	        {
                $response = array('response' => 0,
                                    'pesan' => "Tidak Berhasil Terkirim" );

	            echo json_encode($response);
	        }
	    }
	    else
	    {
	    	//Sudah Ada Data Yang Sama(Sudahp ada yang input di lokasi tersebut)
                $response = array('response' => 2, 
                                    'pesan' => "Sudah ada Laporan di satu lokasi");

	            echo json_encode($response);
	    }
        
    }


    public function input_lapor()
    {
        $date = new DateTime('now');  

        $image_lapor_encode = $this->input->post('image_lapor');

        $image_lapor = $date->format('ddMMyyyyHis').'laporan'.'.jpg';

        $image_selfie_encode = $this->input->post('image_selfie');

        $image_selfie = $date->format('ddMMyyyyHis').'selfie'.'.jpg';
        // $image_lapor = rand().$date->format('ddMMyyyyHis').'laporan'.'.jpg';

        // $id_lapor = $this->input->post('id_lapor');
        $id_kategori = $this->input->post('id_kategori');
        $id_user = $this->input->post('id_user');
        $id_jenis_lap = $this->input->post('id_jenis_lap');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $alamat = $this->input->post('alamat');
        $tgl_lapor = $this->input->post('tgl_lapor');
        $keterangan = $this->input->post('keterangan');
        $title = $this->input->post('title');
        // $image_lapor = $this->input->post('image_lapor');
        // $image_selfie = $this->input->post('image_selfie');

        $data = array('id_kategori' => $id_kategori,
                        'id_user' => $id_user,
                        'id_jenis_lap'=>$id_jenis_lap,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'alamat' => $alamat,
                        'image_lapor' => $image_lapor,
                        'image_selfie' => $image_selfie,
                        'tgl_lapor' => $tgl_lapor,
                        'keterangan' => $keterangan,
                        'status' => 'masuk'
                    );


        $response = array();

        if($this->cek_jarak($id_kategori,$latitude,$longitude) == 1)
        {

        $insert = $this->db->insert('lapor',$data);
        
	        if($insert)
	        {
	            json_encode($insert);
				$lastId = $this->db->insert_id();

	            $select_user = $this->db->query("SELECT * FROM users WHERE id_user = '$id_user'")->row();
	            $select_laporan = $this->db->query("SELECT lapor.*,users.nama as nama_pelapor,users.no_hp,kategori.skpd,kategori.nama_kategori FROM lapor join users on users.id_user = lapor.id_user join kategori on kategori.id_kategori = lapor.id_kategori WHERE id_lapor = '$lastId'")->row();

				$cek_notif = $this->db->query("SELECT notif_admin FROM notif_admin WHERE id_kategori = '$id_kategori'")->row();
	            
                if($cek_notif->notif_admin == 'Admin')
                {
                    // $topic = $cek_notif->notif_admin;   
                    // $topic_admin = "Admin";
                    $topic_admin = "semua";
                    $topic = "semua";
                    $to_notif = "Admin_Pengawas";
                }
                else if($cek_notif->notif_admin == 'Semua')
                {
                    $topic = "semua";
                    // $topic_admin = "Admin";
                    $to_notif = "Petugas_Pengawas_Admin";
                }

	            $response = array('response' => 1,
	                                'image_lapor' =>$image_lapor,
	                                'image_selfie' =>$image_selfie,
	                                'nama_pelapor' => $select_user->nama,
	                                'topic' => $topic,
	                                'to_notif' => $to_notif,
	                                'id_lapor' => $lastId );

	            file_put_contents('./assets/path_laporan/'.$image_lapor, base64_decode($image_lapor_encode));
	            file_put_contents('./assets/path_selfie/'.$image_selfie, base64_decode($image_selfie_encode));
	                // PUSH NOTIFIKASI
	            // $firebase_api = 'AAAAR2XTAuU:APA91bFSi4vhBRcXmegH34nzLGbRhGqFGhbCi2qbn1Td4PeBqJGy-rIwWj22TfETTOBvfoeVJCgVLMRu-KPti5OOOJG242QiJuNx5qVHSHeQuILRI3xhTL45gkvk68qpdnEr0BHyV8N1';

	            // $select = '*';
	            // $table = 'typesurat';
	            // $where = "id_typesurat = '$tipe'";
	            // $type_surat = $this->MasterData->getWhereData($select,$table,$where)->row()->type;

	            

	            
	            // $requestData = array(
	            //     'title' => $title,
	            //     'message' => $alamat,
	            //     'id_kategori' => $id_kategori,
	            //     'nama_kategori' => $select_laporan->nama_kategori,
	            //     'id_user' => $id_user,
	            //     'latitude' => $latitude,
	            //     'longitude' => $longitude,
	            //     'alamat' => $alamat,
	            //     'image_lapor' => $image_lapor,
	            //     'image_selfie' => $image_selfie,
	            //     'tgl_lapor' => $tgl_lapor,
	            //     'id_lapor' => $lastId,
	            //     'keterangan' => $keterangan,
	            //     'status' => $select_laporan->status,
	            //     'nama_pelapor' => $select_user->nama,
	            //     'skpd' => $select_laporan->skpd,
	            //     'to_notif'=>$to_notif
	            // );


	            // $requestData = array(
	            //     'title' => 'Hello',
	            //     'message' => 'cukkk'
	            // );
	            
	            // $fields = array(
	            //     'to' => '/topics/'.$topic,
	            //     'priority'=>'high',
	            //     'data' => $requestData,
	            // );

	            // $fields_admin = array(
	            //     'to' => '/topics/'.$topic_admin,
	            //     'priority'=>'high',
	            //     'data' => $requestData,
	            // );

	            // $url = 'https://fcm.googleapis.com/fcm/send';
	     
	            // $headers = array(
	            //     'Authorization: key=' . $firebase_api,
	            //     'Content-Type: application/json'
	            // );
	            
	            // Open connection
	            // $ch = curl_init();

	            // // Set the url, number of POST vars, POST data
	            // curl_setopt($ch, CURLOPT_URL, $url);

	            // curl_setopt($ch, CURLOPT_POST, true);
	            // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	            // // Disabling SSL Certificate support temporarily
	            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	            // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	            // // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields_admin));

	            // // Execute post
	            // $result = curl_exec($ch);
	            // // if($result === FALSE){
	            // //  die('Curl failed: ' . curl_error($ch));
	            // // }

	            // // Close connection
	            // curl_close($ch);

	            echo json_encode($response);
	        }
	        else
	        {
	            $response = array('response' => 0 );

	            echo json_encode($response);
	        }
	    }
	    else
	    {
	    	//Sudah Ada Data Yang Sama(Sudah ada yang input di lokasi tersebut)
	            $response = array('response' => 2 );

	            echo json_encode($response);
	    }
        
    }


    public function log_lapor()
    {
    	$id_lapor = $this->input->post('id_lapor');
    	$id_user = $this->input->post('id_user');
    	$waktu_proses = $this->input->post('waktu_proses');
    	$waktu_selesai = $this->input->post('waktu_selesai');
		$status = $this->input->post('status');

		$data = array('id_lapor' => $id_lapor,
						'id_user' => $id_user,
						'waktu_proses' => $waktu_proses,
						'waktu_selesai' =>$waktu_selesai,
						'status' => $status 
					);

        $cek_jml_log_lapor = $this->db->query("SELECT * FROM log_lapor WHERE 
                                id_user = '$id_user' AND id_lapor = '$id_lapor'")->num_rows();

        $cek_log_lapor = $this->db->query("SELECT * FROM log_lapor WHERE 
                                id_user = '$id_user' AND id_lapor = '$id_lapor'")->row();

        $respon = array();
        
        if($cek_jml_log_lapor > 0)
        {
            $update = $this->db->query("UPDATE log_lapor SET waktu_proses = '$waktu_proses', 
                                        status = '$status' WHERE id_log = '$cek_log_lapor->id_log'");
        
            $respon = array('response' => 1,
                            'id_log' => $cek_log_lapor->id_log );
            echo json_encode($respon);    
        }
        else
        {
            $insert = $this->db->insert('log_lapor',$data);

            if($insert)
            {
                $last_id = $this->db->insert_id();
                $respon = array('response' => 1,
                                'id_log' => $last_id );
                echo json_encode($respon);
            }
            else
            {
                $respon = array('response' => 0 );
                echo json_encode($respon);  
            }    
        }
		
    }


    public function update_log_lapor()
    {
    	$id_log = $this->input->post('id_log');
        $id_lapor = $this->input->post('id_lapor');
    	$waktu_selesai = $this->input->post('waktu_selesai');
		$status = $this->input->post('status');

		$update = $this->db->query("UPDATE log_lapor SET waktu_selesai = '$waktu_selesai', status = '$status' WHERE id_log = '$id_log'");

		$respon = array();
		if($update)
		{
            $cek_jml_log_lapor = $this->db->query("SELECT * FROM log_lapor WHERE 
                                status = 'Diproses' AND id_lapor = '$id_lapor'")->num_rows();

            // $cek_log_lapor = $this->db->query("SELECT * FROM log_lapor WHERE 
            //                         id_user = '$id_user' AND id_lapor = '$id_lapor'")->row();
            

            if($cek_jml_log_lapor == 0)
            {
                $update_laporan = $this->db->query("UPDATE lapor SET status = 'selesai' WHERE id_lapor = '$id_lapor'");

            }


			$respon = array('response' => 1,
							'jml_log_lapor' => $cek_jml_log_lapor);
			echo json_encode($respon);
		}
		else
		{
			$respon = array('response' => 0 );
			echo json_encode($respon);	
		}
    }    

//==================Send Sms==========================================
    public function kirimSms_batal_laporan($noTelp='', $pesan=''){

        // $noTelp = $this->input->POST('noTelp');
        // $pesan = 'Laporan Anda pada Aplikasi SIYAP Dibatalkan. Alasan Laporan Anda Dibatalkan : '.$this->input->POST('pesan');

        $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
        $newID = $cek->Auto_increment;

        // menghitung jumlah pecahan
        $jmlSMS = ceil(strlen('Laporan Anda pada Aplikasi SIYAP Dibatalkan. Alasan Laporan Anda Dibatalkan : '.$pesan)/153);

        // memecah pesan asli
        $pecah  = str_split('Laporan Anda pada Aplikasi SIYAP Dibatalkan. Alasan Laporan Anda Dibatalkan : '.$pesan, 153);

        // proses penyimpanan ke tabel mysql untuk setiap pecahan
        $counts = 0;
        for ($i=1; $i<=$jmlSMS; $i++){
           // membuat UDH untuk setiap pecahan, sesuai urutannya
           $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);

           // membaca text setiap pecahan
           $msg = $pecah[$i-1];

           if ($i == 1){
                 // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
                $data = array(
                    'DestinationNumber' => $noTelp,
                    'UDH' => $udh,
                    'TextDecoded' => $msg,
                    'ID' => $newID,
                    'MultiPart' => 'true',
                    'CreatorID' => 'Siyap'
                );

                $table = 'outbox';
                $input_msg = $this->MasterData->sendMsg($data,$table);

           }else{
                // jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
                $data = array(
                    'UDH' => $udh,
                    'TextDecoded' => $msg,
                    'ID' => $newID,
                    'SequencePosition' => $i
                );

                $table = 'outbox_multipart';
                $input_msg = $this->MasterData->sendMsg($data,$table);
           }

            if ($input_msg) {
                $counts++;
            }          
        }

        if ($counts > 0) {
            //Berhasil Kirim Sms
            $respon = array('response_sms' => 1 );
            //Succes
            // echo json_encode($respon);
            return 1;

        }else{

            $respon = array('response_sms' => 0 );
            //Gagal
            // echo json_encode($respon);
            return 0;

        }
    }

//============================================================================    

    public function update_status_lapor()
    {
        $id_lapor = $this->input->post('id_lapor');
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        $waktu_batal = $this->input->post('waktu_batal');
        $no_hp = $this->input->post('no_hp');

        $data = array('id_lapor' =>$id_lapor,
                        'keterangan'=>$keterangan,
                        'waktu_batal'=>$waktu_batal );

        $cek_laporan = $this->db->query("SELECT * FROM lapor WHERE id_lapor = '$id_lapor'")->num_rows();

        // $cek_skpd = $tihs->db->query("SELECT kategori.skpd FROM lapor JOIN kategori on kategori.id_kategori = lapor.id_kategori                          WHERE id_lapor = '$id_lapor'")->row();

        $respon = array();
        
        if($cek_laporan > 0)
        {

            $update = $this->db->query("UPDATE lapor SET status = '$status' WHERE id_lapor = '$id_lapor'"); 

            if($update)
            {
                if($status == 'batal')
                {
                        //input ke tabel tunda_lapor
                    $insert = $this->db->insert('batal_lapor',$data);
                    
                    if($insert)
                    {
                        $respon = array('response' => 1,
                                        'response_sms' => $this->kirimSms_batal_laporan($no_hp,$keterangan));
                        
                        echo json_encode($respon);
                    }
                    else
                    {
                        //Tidak Berhasil kirim sms
                        $respon = array('response' => 2);
                        echo json_encode($respon);
                    }
                }
                else
                {
                    //Status Bukan tunda, berhasil update status, tapi tidak send sms
                        $respon = array('response' => 1);
                        echo json_encode($respon);
                }
                

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



    public function deleted_log_lapor()
    {
    	$id_log = $this->input->post('id_log');
        $id_lapor = $this->input->post('id_lapor');

		$cek_jml_log_lapor = $this->db->query("SELECT * FROM log_lapor WHERE id_log = '$id_log'")->num_rows();		
		$cek_log_lapor = $this->db->query("SELECT * FROM log_lapor WHERE id_log = '$id_log'")->row();



		$respon = array();

		if($cek_jml_log_lapor > 0)
		{
			if($cek_log_lapor->foto_kejadian != null || $cek_log_lapor->foto_kejadian != "")
			{
				$foto = explode(",", $cek_log_lapor->foto_kejadian);
				for($i=0; $i < count($foto)-1; $i++) { 

					unlink('./assets/path_kejadian/'.$foto[$i]);
				}

				$delete = $this->db->query("DELETE FROM log_lapor WHERE id_log = '$id_log'");

					if($delete)
					{
                                //untuk cek jumlah laporan yang di proses
                        $cek_jml_log = $this->db->query("SELECT * FROM log_lapor WHERE id_lapor = '$id_lapor'")->num_rows();
                        if($cek_jml_log == 0)
                        {
                            //update laporan
                            $update_lapor = $this->db->query("UPDATE lapor SET status = 'masuk' WHERE id_lapor = '$id_lapor'");

                            $respon = array('response_update_status' => 2,
                                            'response' => 1);
                            echo json_encode($respon);                     
                        }
                        else
                        {
                            //Gagal update laporan
                            $respon = array('response_update_status' => 3,
                                            'response' => 1);
                            echo json_encode($respon);
                        }
					}
					else
					{

						$respon = array('response' => 0 );
						echo json_encode($respon);	
					}
			}
			else
			{

				$delete = $this->db->query("DELETE FROM log_lapor WHERE id_log = '$id_log'");

					if($delete)
					{
                                                        //untuk cek jumlah laporan yang di proses
                        $cek_jml_log = $this->db->query("SELECT * FROM log_lapor WHERE id_lapor = '$id_lapor'")->num_rows();
                        if($cek_jml_log == 0)
                        {
                            //update laporan
                            $update_lapor = $this->db->query("UPDATE lapor SET status = 'masuk' WHERE id_lapor = '$id_lapor'");

                            $respon = array('response_update_status' => 2,
                                            'response' => 1);
                            echo json_encode($respon);                     
                        }
                        else
                        {
                            //Gagal update laporan
                            $respon = array('response_update_status' => 3,
                                            'response' => 1);
                            echo json_encode($respon);
                        }

					}
					else
					{
						$respon = array('response' => 0 );
						echo json_encode($respon);	
					}
			}
		}
		else
		{
				$respon = array('response' => 0 );
				echo json_encode($respon);	
		}

    }    
    

}

?>