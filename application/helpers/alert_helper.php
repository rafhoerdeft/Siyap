<?php 
	
	if (!function_exists('alert_success')) {
		function alert_success($text){
			$CI = & get_instance();
			
			$alert =  "<div class='alert alert-rounded alert-success' id='alts'> 
		                    <i class='mdi mdi-check-circle'></i> <b>Success!</b> $text
		                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button>
		                </div>";
			$CI->session->set_flashdata('alert', $alert);
		}
	}

	if (!function_exists('alert_failed')) {
		function alert_failed($text){
			$CI = & get_instance();
			
			$alert =  "<div class='alert alert-rounded alert-danger' id='alts'> 
		                    <i class='mdi mdi-close-circle'></i> <b>Gagal!</b> $text
		                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button>
						</div>";
			$CI->session->set_flashdata('alert', $alert);
		}
	}

	if (!function_exists('alert_warning')) {
		function alert_warning($text){
			$CI = & get_instance();
			
			$alert =  "<div class='alert alert-rounded alert-warning' id='alts'> 
		                    <i class='mdi mdi-alert-circle'></i> <b>Peringatan!</b> $text
		                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button>
						</div>";
			$CI->session->set_flashdata('alert', $alert);
		}
	}

	if (!function_exists('show_alert')) {
		function show_alert(){
			$CI = & get_instance();
			return $CI->session->flashdata('alert');
		}
	}
?>