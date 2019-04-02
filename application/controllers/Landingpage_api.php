<?php

/**
 * Description of Common
 *
 * @author CHUYEN
 */
require_once APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Landingpage_api extends REST_Controller {

    function price_get($code) {
		/*
		$this->response(json_encode($code), 200);
		exit;
		if( strpos( $code, 'http://ketoantrutuyen.site/' ) !== false) {
           $code = str_replace('http://ketoantrutuyen.site/', '', $code);
         }
		  $this->response(json_encode($code), 200);
		   $this->response(json_encode($default), 200);
		exit;
		 */
		  // $default = array('course_code' =>"'".$code."'", 'price' => 495000, 'price_root' => 885000);
		  //$default = array('course_code' => $code);
		  // $this->response(json_encode($default), 200);
		//exit;
		  
        $this->load->model('landingpage_model');
        $input = array();
        $input['where'] = array('code' => $code);
        $price = $this->landingpage_model->load_all($input);
        if (!empty($price)) {
           $this->response(json_encode($price[0]), 200);
        }
		else {
            $default = array('course_code' => 'L999', 'price' => 495000, 'price_root' => 895000);
            $this->response(json_encode($default), 200);
        }
      
    }

    function ld_get() {
        $this->load->model('fb_landing_model');
        $input = array();
        $input['where'] = array('status' => 1);
        $price = $this->fb_landing_model->load_all($input);
        if (!empty($price)) {
            $this->response(json_encode($price), 200);
        }
    }

    function add_post() {
        $post = $this->input->post();
        $this->load->model('comment_fb_model');
        $this->comment_fb_model->insert($post);
    }

}
