<?php

// use Jenssegers\Blade\Blade;

if (!function_exists('view')) {
    // function view($module, $view, $data = []) {
    //     $path = APPPATH.'modules/'.$module.'/views';
    //     $blade = new Blade($path, $path.'/cache');

    //     echo $blade->make($view, $data);
    // }

    function view($view, $data = [], $more = []) {
        $CI = &get_instance();
        // $CI->load->library('blade');
        
        return $CI->blade->set_data($more)
                         ->render($view, $data);
    }
}