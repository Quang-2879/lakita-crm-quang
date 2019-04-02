<?php

class Error extends CI_Controller {
    public function index($error = ''){
        $data['error'] = $error;
        $this->load->view('error/index', $data);
    }
}

