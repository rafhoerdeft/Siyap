<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Api_tunda_lapor extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('MasterData');

        $this->sms = $this->load->database('sms', TRUE);
    }

    function index() {
        echo "Api lapor";
    }
    



//==================Send Sms==========================================
    public function kirimSms_tunda_laporan($noTelp='', $pesan=''){

 		// $noTelp = $this->input->POST('noTelp');
        // $pesan = 'Laporan Anda pada Aplikasi SIYAP Ditunda. Alasan Laporan Anda Ditunda : '.$this->input->POST('pesan');

        $cek = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
        $newID = $cek->Auto_increment;

        // menghitung jumlah pecahan
        $jmlSMS = ceil(strlen('Laporan Anda pada Aplikasi SIYAP Ditunda. Alasan Laporan Anda Ditunda : '.$pesan)/153);

        // memecah pesan asli
        $pecah  = str_split('Laporan Anda pada Aplikasi SIYAP Ditunda. Alasan Laporan Anda Ditunda : '.$pesan, 153);

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

    public function update_status_lapor_tunda()
    {
    	$id_lapor = $this->input->post('id_lapor');
		$status = $this->input->post('status');
		$keterangan = $this->input->post('keterangan');
		$waktu_tunda = $this->input->post('waktu_tunda');
		$no_hp = $this->input->post('no_hp');

		$data = array('id_lapor' =>$id_lapor,
						'keterangan'=>$keterangan,
						'waktu_tunda'=>$waktu_tunda );

		$cek_laporan = $this->db->query("SELECT * FROM lapor WHERE id_lapor = '$id_lapor'")->num_rows();

		// $cek_skpd = $tihs->db->query("SELECT kategori.skpd FROM lapor JOIN kategori on kategori.id_kategori = lapor.id_kategori 							WHERE id_lapor = '$id_lapor'")->row();

		$respon = array();
		
		if($cek_laporan > 0)
		{

			$update = $this->db->query("UPDATE lapor SET status = '$status' WHERE id_lapor = '$id_lapor'");	

			if($update)
			{
				if($status == 'tunda')
				{
						//input ke tabel tunda_lapor
					$insert = $this->db->insert('tunda_lapor',$data);
					
					if($insert)
					{
						$respon = array('response' => 1,
										'response_sms' => $this->kirimSms_tunda_laporan($no_hp,$keterangan));
						
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


}

?>