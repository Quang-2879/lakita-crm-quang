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
class Channel_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'channel';
    }

    public function find_channel_name($id) {
        $name = '';
        $input2 = array();
        $input2['where'] = array('id' => $id);
        $names = $this->load_all($input2);
        if (!empty($names)) {
            $name = $names[0]['name'];
        }
        return $name;
    }

}
