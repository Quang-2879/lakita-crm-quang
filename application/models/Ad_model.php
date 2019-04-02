<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staff_model
 *
 * @author CHUYEN
 */
class Ad_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'ad';
    }
    
        public function find_ad_name($id) {
        $name = '';
        $input2 = array();
        $input2['where'] = array('id' => $id);
        $ads = $this->load_all($input2);
        if (!empty($ads)) {
            $name = $ads[0]['name'];
        }
        return $name;
    }
}
