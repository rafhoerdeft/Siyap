<?php

class Uploader {
    protected $pdf_object;
    protected $xls_object;

    public $upload_path = '';
    protected $config;

    public function __construct() {
        $this->pdf_object = new Pdf_Upload();
        $this->xls_object = new Xls_Upload();
    }

    public function pdf() {
        $this->pdf_object->config['upload_path'] = $this->upload_path;
        return $this->pdf_object;
    }

    public function xls() {
        $object = new Xls_Upload();
        $object->config['upload_path'] = $this->upload_path;
        return $object;
    }

    public function img() {
        $object = new Img_Upload();
        $object->config['upload_path'] = $this->upload_path;
        return $object;
    }

}

class FileUpload
{
    protected $_ci;
    public $config;

    public function __construct() {
        $this->_ci = & get_instance();
        $this->config = [
            'remove_spaces'    => true,
            'encrypt_name'     => true,
            'max_size'         => 50000,
            'file_ext_tolower' => true,
        ];
    }

    public function uploadFile() {
        $process = $this->_setProcessMsg(true);

        $config = $this->config;

        $this->_ci->load->library('upload', $config);
        $uploader = $this->_ci->upload;

        # post field
        if (!isset($config['post_field'])) {
            $process = $this->_setProcessMsg(false, 'File empty');
        }

        # upload directory
        if ($process['status']) {
            if (!isset($config['upload_path'])) {
                $process = $this->_setProcessMsg(false, 'Upload directory not set');
            }
            if ($process['status']) {
                $upload_path = $config['upload_path'];
                if (!is_dir($upload_path)) {
                    if (!mkdir($upload_path, 0777, true)) {
                        $process = $this->_setProcessMsg(false, 'Access Denied');
                    }
                }
            }
        }

        if ($process['status']) {
            if (!$uploader->do_upload($config['post_field'])) {
                $process = $this->_setProcessMsg(false, $uploader->display_errors('', ''));
            } else {
                $process = $this->_setProcessMsg(true, $uploader->data());
            }
        }

        return $process;
    }

    function _setProcessMsg($status, $msg = null) {
        return [
            'status'    => $status,
            'msg'       => $msg,
        ];
    }
}

class Pdf_Upload extends FileUpload
{
    protected $_options;

    public function __construct() {
        parent::__construct();

        $this->config['allowed_types'] = 'pdf|PDF';
    }

    public function upload($post_field) {
        $this->config['post_field'] = $post_field;
        return $this->uploadFile();
    }
}

class Xls_Upload extends FileUpload
{
    protected $_options;

    public function __construct() {
        parent::__construct();

        $this->config['allowed_types'] = 'xls|xlsx|XLS|XLSX';
    }

    public function upload($post_field) {
        $this->config['post_field'] = $post_field;
        return $this->uploadFile();
    }
}

class Img_Upload extends FileUpload
{
    protected $_options;

    public function __construct() {
        parent::__construct();

        $this->config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG';
    }

    public function upload($post_field) {
        $this->config['post_field'] = $post_field;
        return $this->uploadFile();
    }
}