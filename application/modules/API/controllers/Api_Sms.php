<?php



include_once(APPPATH.'libraries/REST_Controller.php');



defined('BASEPATH') OR exit('No direct script access allowed');



class Api_Sms extends MX_Controller {



	function __construct() {

		parent::__construct();

        $this->load->model('MasterData');

        $this->sms = $this->load->database('sms', TRUE);

	}



    public function kirimSms($noTelp='', $pesan=''){

        // var_dump($noTelp.' '.$pesan);exit();
        $noTelp = $this->input->POST('noTelp');
        $pesan = $this->input->POST('pesan');

        // $conn   =   mysql_connect('localhost','root','magelang56511') or die('connection problem');

        // mysql_select_db('sms');

        

        // pesan asli

        //$pesan = ".......";



        // menghitung jumlah pecahan

        // $jmlSMS = ceil(strlen($pesan)/153);



        // // memecah pesan asli

        // $pecah  = str_split($pesan, 153);



        // // proses untuk mendapatkan ID record yang akan disisipkan ke tabel OUTBOX

        // $query = "SHOW TABLE STATUS LIKE 'outbox'";

        // $hasil = mysql_query($query);

        // $data  = mysql_fetch_array($hasil);

        // $newID = $data['Auto_increment'];



        // // proses penyimpanan ke tabel mysql untuk setiap pecahan

        // for ($i=1; $i<=$jmlSMS; $i++){

        //    // membuat UDH untuk setiap pecahan, sesuai urutannya

        //    $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);



        //    // membaca text setiap pecahan

        //    $msg = $pecah[$i-1];



        //    if ($i == 1)

        //    {

        //       // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX

        //       $query = "INSERT INTO outbox (DestinationNumber, UDH, TextDecoded, ID, MultiPart, CreatorID)

        //                 VALUES ('$noTelp', '$udh', '$msg', '$newID', 'true', 'Gammu')";

        //    }

        //    else

        //    {

        //       // jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART

        //       $query = "INSERT INTO outbox_multipart(UDH, TextDecoded, ID, SequencePosition)

        //                 VALUES ('$udh', '$msg', '$newID', '$i')";

        //    }



        //    // jalankan query

        //     mysql_query($query);            

        // }



        $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();

        $newID = $cek->Auto_increment;



        $data = array(

            'DestinationNumber' => $noTelp,

            'TextDecoded' => 'Password anda: '.$pesan,

            'ID' => $newID,

            'MultiPart' => 'false',

            'CreatorID' => 'Damkar'

        );

        $table = 'outbox';

        $input_msg = $this->MasterData->inputData($data,$table);

        $respon = array();

        if ($input_msg) {
            $respon = array('response' => 1 );
            //Succes
            echo json_encode($respon);

        }else{

            $respon = array('response' => 0 );
            //Gagal
            echo json_encode($respon);

        }
    }

    public function kirimSmsLong($noTelp='', $pesan=''){
        $noTelp = $this->input->POST('noTelp');
        $pesan = $this->input->POST('pesan');

        $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
        $newID = $cek->Auto_increment;

        // menghitung jumlah pecahan
        $jmlSMS = ceil(strlen($pesan)/153);

        // memecah pesan asli
        $pecah  = str_split($pesan, 153);

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
            $respon = array('response' => 1 );
            //Succes
            echo json_encode($respon);

        }else{

            $respon = array('response' => 0 );
            //Gagal
            echo json_encode($respon);

        }
    }


    public function kirimSms_KePelapor($noTelp='', $pesan=''){

        $noTelp = $this->input->POST('noTelp');
        $pesan = $this->input->POST('pesan');

        $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
        $newID = $cek->Auto_increment;

        // menghitung jumlah pecahan
        $jmlSMS = ceil(strlen($pesan)/153);

        // memecah pesan asli
        $pecah  = str_split($pesan, 153);

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


	public function input_pesan_ke_pelapor()
	{
		$id_lapor = $this->input->post('id_lapor');
		$tgl_pesan = $this->input->post('tgl_pesan');
		$pesan = $this->input->post('pesan');
		$noTelp = $this->input->post('noTelp');

		$data = array('id_lapor' =>$id_lapor,
						'tgl_pesan' =>$tgl_pesan,
						'pesan' =>$pesan	 
					);

		$insert = $this->db->insert('pesan_ke_pelapor',$data);

		$respon = array();
		if($insert)
		{
			$respon = array('response' => 1,
							'response_sms' => $this->kirimSms_KePelapor($noTelp,$pesan));
			echo json_encode($respon);
		}
		else
		{
			$respon = array('response' => 0 );
			echo json_encode($respon);	
		}
	}

}



