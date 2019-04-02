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
class Landingpage_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'landingpage';
    }
}
