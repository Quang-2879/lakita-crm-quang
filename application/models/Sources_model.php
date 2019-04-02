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
class Sources_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'source';
    }
     function find_source_name($id) {
        $input2 = array();
        $input2['where'] = array('id' => $id);
        $sources = $this->load_all($input2);
        if (!empty($sources)) {
            return $sources[0]['name'];
        }
        return 0;
    }


}
