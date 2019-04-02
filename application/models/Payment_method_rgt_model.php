<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contact_model
 *
 * @author CHUYEN
 */
class Payment_method_rgt_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'payment_method_rgt';
    }
    
      public function find_payment_method_rgt_desc($id) {
        $call_stt = 'Không có';
        $input2 = array();
        $input2['where'] = array('id' => $id);
        $result = $this->load_all($input2);
        if (!empty($result)) {
            $call_stt = $result[0]['method'];
        }
        return $call_stt;
    }

}
