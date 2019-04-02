<?php

/**
 * Description of Common
 *
 * @author HuyNV
 */
require_once APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Finance_api extends REST_Controller {

    function vouchers_get($date) {
        $this->load->model('contacts_model');

        // $input = array(
        //     'select' => 'id, name, course_code, price_purchace, paymment_method_rgt, provider_id',
        //     'where' => array(
        //         'date_receive_lakita' > strtotime('00:00:00 ' . $date),
        //         'date_receive_lakita' <= strtotime('23:59:59 ' . $date),
        //     )
        // );

        //$l8 = $this->contacts_model->load_all($input);

        $l8 = array('test' => 'ok');

        $this->response(json_encode($l8));
      
    }

}
