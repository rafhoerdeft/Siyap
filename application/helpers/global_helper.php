<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



if (!function_exists('SET_Pagination')) {

    function SET_Pagination($url, $count, $limit)

    {

        $APP = &get_instance();
        $APP->load->library('pagination');
        $config['base_url'] = $url;
        $config['total_rows'] = $count;
        $config['per_page'] = $limit;


        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;

        $config['cur_tag_open'] = '<li class="page-item"><a href="#" class="page-link current">';
        $config['cur_tag_close'] = '</a></li>';

        $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['next_link'] = '<i class="fa fa-angle-right"></i>';

        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '<li class="page-item">';

        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $config['reuse_query_string'] = true;
        $config['page_query_string'] = true;

        $APP->pagination->initialize($config);
        $pageno = ($APP->uri->segment(2) ? $APP->uri->segment(2) : 0);

        return array(
            'number' => $pageno,
            'link' => $APP->pagination->create_links()
        );
    }
}



if (!function_exists('pesan')) {
    function pesan()
    {
        $CI     = &get_instance();
        $notif  =    $CI->session->flashdata('notifikasi');
        $return =   '';
        if ($notif != '') {
            #Gagal...!#Username sudah ada...#danger
            $arr    = explode("#", $notif);
            $noted  =   $arr[0];
            $isi    =   $arr[1];
            $tipe   =   $arr[2];
            $return =
                '<div class="alert alert-block alert-' . $tipe . '">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>

                <p>
                    <strong>
                        <i class="ace-icon fa fa-check"></i>
                        ' . $noted . '
                    </strong>
                    ' . $isi . '
                </p>                                                    
            </div>';
        }
        return $return;
    }
}


if (!function_exists('kirimemail')) {
    function kirimemail($asal = '', $tujuan = '', $judul = '', $isi = '')
    {
        $CI     = &get_instance();

        $CI->load->library("PHPMailer_library");

        $mail = $CI->phpmailer_library->load();

        $mail->IsHTML(true);    // set email format to HTML
        $mail->IsSMTP();   // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = "rekatamadigital@gmail.com";

        $mail->Password   = "r3k4t4m4"; //isi dengan password gmail

        $mail->SetFrom($asal, "PATRIOT");
        $mail->Subject    = $judul;
        $mail->Body       = $isi;
        $mail->AddAddress($tujuan);

        if (!$mail->Send()) {
            return 0;
        } else {
            return 1;
        }
    }
}


// if(!function_exists('kirimemail')) {
//     function kirimemail($asal='',$tujuan='',$judul='',$isi=''){
//         $CI     =& get_instance();

//         $CI->load->library('email');
//         $config = Array(
//             'protocol' => 'smtp',
//             'smtp_host' => 'ssl://smtp.googlemail.com',
//             'smtp_port' => 587,
//             'smtp_user' => 'rekatamadigital@gmail.com',
//             'smtp_pass' => 'r3k4t4m4',
//             'mailtype'  => 'html',
//             'charset'   => 'iso-8859-1'
//         );
//         $CI->load->library('email', $config);
//         $CI->email->from($asal);
//         $CI->email->to($tujuan);
//         $CI->email->subject($judul);
//         $CI->email->message($isi);
//         if (!$CI->email->send())
//         {
//             // echo $CI->email->print_debugger();
//             return 0;
//         }else{
//             return 1;
//         }

//         // $CI     =& get_instance();
//         // $config = Array(
// 		// 	'protocol' => 'smtp',
// 		// 	'smtp_host' => 'ssl://smtp.googlemail.com',
// 		// 	'smtp_port' => 465,
// 		// 	'smtp_user' => 'diskominfo.kabmgl@gmail.com',
// 		// 	'smtp_pass' => 'b0r0budurdiskominfo',
// 		// 	'mailtype'  => 'html', 
// 		// 	'charset'   => 'iso-8859-1'
// 		// );

// 		// $CI->load->library('email', $config);
// 		// $CI->email->set_newline("\r\n");
// 		// $CI->email->from($asal, 'email');
// 		// $CI->email->to($tujuan, 'email');
// 		// $CI->email->subject($judul);

// 		// $CI->email->message($isi);
// 		// if ( ! $CI->email->send()) {
// 		// 	return 0;
// 		// }else{
// 		// 	return 1;
// 		// }
//     }
// }



if (!function_exists('cekfolder')) {
    function cekfolder($jenis = '')
    {
        $tahun             =    date('Y');
        $bulan          =   date('m');
        $cekpath1        =    dirname($_SERVER["SCRIPT_FILENAME"]) . "/dokumen/$jenis";
        if (!file_exists($cekpath1)) {
            mkdir($cekpath1, 0777, true);
            chmod($cekpath1, 0777);

            $myfile = fopen($cekpath1 . "/index.php", "w") or die("Unable to open file!");
            $txt = "larangan";
            fwrite($myfile, $txt);
            fclose($myfile);
        }

        $cekpath2         =    dirname($_SERVER["SCRIPT_FILENAME"]) . "/dokumen/$jenis/$tahun/";
        if (!file_exists($cekpath2)) {
            mkdir($cekpath2, 0777, true);
            chmod($cekpath2, 0777);
            $myfile = fopen($cekpath2 . "/index.php", "w") or die("Unable to open file!");
            $txt = "larangan";
            fwrite($myfile, $txt);
            fclose($myfile);
        }

        $cekpath3         =    dirname($_SERVER["SCRIPT_FILENAME"]) . "/dokumen/$jenis/$tahun/$bulan";
        if (!file_exists($cekpath3)) {
            mkdir($cekpath3, 0777, true);
            chmod($cekpath3, 0777);
            $myfile = fopen($cekpath3 . "/index.php", "w") or die("Unable to open file!");
            $txt = "larangan";
            fwrite($myfile, $txt);
            fclose($myfile);
        }

        return "/dokumen/$jenis/$tahun/$bulan/";
    }
}



if (!function_exists('todegree')) {
    function todegree($dec = 0)
    {
        // Converts decimal format to DMS ( Degrees / minutes / seconds ) 
        $vars = explode(".", $dec);
        $deg = $vars[0];
        $tempma = "0." . $vars[1];

        $tempma = $tempma * 3600;
        $min = floor($tempma / 60);
        $sec = $tempma - ($min * 60);

        return array("deg" => $deg, "min" => $min, "sec" => $sec);
    }
}
