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
class Campaign_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'campaign';
    }
    
    
    public function find_campaign_name($id) {
        $name = '';
        $input2 = array();
        $input2['where'] = array('id' => $id);
        $campaigns = $this->load_all($input2);
        if (!empty($campaigns)) {
            $name = $campaigns[0]['name'];
        }
        return $name;
    }

}
