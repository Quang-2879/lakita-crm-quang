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
class Adset_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'adset';
    }
     public function find_adset_name($id) {
        $name = '';
        $input2 = array();
        $input2['where'] = array('id' => $id);
        $adsets = $this->load_all($input2);
        if (!empty($adsets)) {
            $name = $adsets[0]['name'];
        }
        return $name;
    }

}
