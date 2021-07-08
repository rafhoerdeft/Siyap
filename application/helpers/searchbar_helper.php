<?php 

    if (!function_exists('formSearch')) {
		function formSearch($tbl){
			$CI = & get_instance();
            $data = array(
              'table_name' => $tbl  
            );
			return $CI->load->view('search_data_table', $data);
		}
	}
    
?>